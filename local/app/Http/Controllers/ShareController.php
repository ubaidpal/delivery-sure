<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 15-Oct-16 4:18 PM
 * File Name    : ShareController.php
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\Traits\UserDetail;
use App\User;
use Illuminate\Http\Request;
use Repositories\ShareRepository;

class ShareController extends Controller
{
    use UserDetail;
    private $user;
    private $user_id;
    private $request;
    private $is_api;
    private $share;

    /**
     * ShareController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Repositories\ShareRepository $share
     */
    public function __construct(Request $request, ShareRepository $share) {
        $this->request = $request;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'allData' ][ 'is_api' ];
        $this->share   = $share;
    }

    public function index($id) {
        $id = \HashId::deCode($id,'favourite');
        $data['purchasers'] = $this->share->getPurchasers($this->user_id, $id, $this->request->all());
        $data['driver'] = User::find($id);
        return view('share.purchasers-list', $data);
    }

    public function getPurchasers() {
        $data = $this->share->getPurchasers($this->user_id,$this->request->query, $this->request->all(), $this->is_api);
        if($this->is_api){
            $data = $this->parseUserDetail($data);
            return \Api::success_list($data);
        }
        return $data;
    }

    public function shareDriver() {
        $purchasers = [];
        if($this->is_api){
            if(!$this->request->has('purchasers_id') || !$this->request->has('driver_id')){
                return \Api::invalid_param();
            }
            $purchasers = $this->request->get('purchasers_id');
        }

        if(!$this->is_api){
            $purchasers = $this->request->get('purchasers_id' );
            $purchasers = explode(',', $purchasers);
        }
        $data = $this->request->all();
        $this->share->shareDriver($data, $this->user_id, $purchasers);
        if($this->is_api){
            return \Api::success_with_message('Shared successfully');
        }
        return redirect()->back()->with('success', 'Shared successfully');
    }

    public function getDrivers($id) {
         $id = \HashId::deCode($id,'favourite');
        $data['purchasers'] = $this->share->getDrivers($this->user_id, $id, $this->request->all());
        $data['job'] = Order::find($id);

        return view('share.drivers-list', $data);
    }
    public function getDriversAll() {
        $data = $this->share->getDrivers($this->user_id,$this->request->query, $this->request->all(), $this->is_api);
        if($this->is_api){
            $data = $this->parseUserDetail($data);
            return \Api::success_list($data);
        }
        return $data;
    }
    public function shareJobs() {
        $drivers = [];
        if($this->is_api){
            if(!$this->request->has('drivers_id') || !$this->request->has('job_id')){
                return \Api::invalid_param();
            }
            $drivers = $this->request->get('drivers_id');
        }
        if(!$this->is_api){
            $drivers = $this->request->get('drivers_id');
            $drivers = explode(',', $drivers);
        }
        $data = $this->request->all();
        $this->share->shareJobs($data, $this->user_id,$drivers);
        if($this->is_api){
            return \Api::success_with_message('Shared successfully');
        }
        return redirect()->back()->with('success', 'Shared successfully');
    }

    private function parseUserDetail($data) {
        $users = [];
        foreach ($data as $item) {
            $users[] = $this->userBasicData($item);
        }
        return $users;
    }
}
