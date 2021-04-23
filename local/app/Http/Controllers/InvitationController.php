<?php

namespace App\Http\Controllers;

use App\Order;
use App\Traits\Favourites;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Repositories\InvitationRepository;

/**
 * @property  user
 */
class InvitationController extends Controller
{
    //
    protected $invitation;
    protected $request;
    private   $is_api;
    private   $user_id;
    private   $user;
    use Favourites;

    /**
     * InvitationController constructor.
     *
     * @param \Repositories\InvitationRepository $invitation
     */
    public function __construct(InvitationRepository $invitation, Request $request) {
        $this->invitation = $invitation;
        $this->request    = $request;
        $this->user_id    = $request[ 'middleware' ][ 'user_id' ];
        $this->user       = $request[ 'middleware' ][ 'user' ];
        $this->is_api     = $request[ 'allData' ][ 'is_api' ];
    }

    public function index() {
        $data[ 'title' ]       = 'All invitations';
        $data[ 'invitations' ] = $this->invitation->getInvitations($this->user_id, 'order');
        if($this->is_api) {
            $invitations = $this->invitation->parseInvitations($data[ 'invitations' ], $this->user_id);

            return \Api::success_list($invitations);
        }
        return view('invitations.invitations', $data);
    }

    public function getJobs($driverId = NULL) {

        if($this->is_api) {
            if(!Input::has('driverId')) {
                return \Api::invalid_param();
            }
            $driverId = Input::get('driverId');
        }
        $data[ 'jobs' ]           = $this->invitation->getMyJobs($this->user_id);
        $driverId                 = \Hashids::connection('favourite')->decode($driverId)[ 0 ];
        $data[ 'invitedDrivers' ] = $this->invitation->getInvitedDrivers($this->user_id, $driverId, 'order');
        $data[ 'driver' ]         = User::find($driverId);
        if($this->is_api) {
            $jobs = $this->invitation->parseJobsForInvitation($data);

            return \Api::success(['results' => $jobs, 'driver' => $this->invitation->userDetail($data[ 'driver' ])]);
        }
        return view('invitations.invite', $data);
    }

    public function sendInvitation() {
        if($this->is_api) {
            if(!$this->request->has('driver_id') || !$this->request->has('jobs')) {
                return \Api::invalid_param();
            }
        }

        $jobs     = $this->request->jobs;
        $driverId = $this->request->driver_id;
        if(empty($jobs) or empty($driverId)) {
            //return FALSE;
            if($this->is_api) {
                return \Api::other_error('Select at least one job to invitation');
            }
            return redirect()->back()->with('error', 'Select at least one job to invitation');
        }
        $this->invitation->sendInvitation($jobs, $driverId, $this->user_id, 'order');
        if($this->is_api) {
            return \Api::success_with_message('Invitation sent successfully');
        }

        return redirect()->back()->with('success', 'Invitation sent successfully');
    }

    public function sendJobInvitation() {

        if($this->is_api) {
            if(!$this->request->has('drivers') || !$this->request->has('order_id')) {
                return \Api::invalid_param();
            }
        }
        $drivers = $this->request->drivers;
        $job_id  = $this->request->job_id;
        if(empty($drivers) or empty($drivers)) {
            if($this->is_api) {
                return \Api::other_error('Select at least one driver to invitation');
            }
            return redirect()->back()->with('error', 'Select at least one driver to invitation');
        }
        $this->invitation->sendJobInvitation($drivers, $job_id, $this->user_id, 'order');
        if($this->is_api) {
            return \Api::success_with_message('Invitation sent successfully');
        }
        return redirect()->back()->with('success', 'Invitation sent successfully');
    }

    public function cancelInvitation($id = NULL) {
        if($this->is_api){
            if (!Input::has('invitation_id')) {
                if ($this->is_api) {
                    return \Api::invalid_param();
                }
            }
            $id = Input::get('invitation_id');
            $id = \HashId::deCode($id, 'favourite');
        }
        if(!$this->is_api){
            $id = \Hashids::connection('favourite')->decode($id)[ 0 ];
        }

        $this->invitation->cancelInvitation($id);
        if($this->is_api) {
            return \Api::success_with_message('Invitation cancel successfully');
        }
        return redirect()->back();
    }

    public function getFavourites($id = NULL) {

        if($this->is_api) {
            if(!$this->request->has('order_id')) {
                return \Api::invalid_param();
            }
            $id = $this->request->order_id;
        }
        $id            = \HashId::deCode($id, 'favourite');
        $data[ 'job' ] = Order::find($id);
        if(empty($data[ 'job' ])) {
            if($this->is_api) {
                return \Api::detail_not_found();
            }
        }
        $invitations       = $this->invitation->getAllSendInvitation($id, 'order');
        $data[ 'drivers' ] = $this->skipSentFavourites($this->user_id, 'user', $invitations);
        if($this->is_api) {
            $drivers = $this->invitation->parseDrivers($data);

            return \Api::success(['results' => $drivers, 'job' => $data[ 'job' ]]);
        }
        // echo '<tt><pre>'; print_r( $data['drivers'] ); die;
        return view('invitations.job-invitation', $data);
    }
}
