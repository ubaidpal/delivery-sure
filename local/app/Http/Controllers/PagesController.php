<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller\View;
use App\place_order;
use League\Flysystem\Config;

class pagesController extends Controller
{

    public function hello() {
        return view('pages.hello');
    }

    public function index() {
        return view('pages.index');
    }

    public function index_new() {
        return view('pages.index_new');
    }

    public function dashboard() {
        return view('pages.dashboard');
    }

    public function add_bank() {
        return view('pages.add_bank');
    }

    public function order() {
        return view('order');

    }

    public function bidder_view() {
        return view('pages.bidder_view');
    }

    public function change_password() {
        return view('pages.change_password');
    }

    public function job_detail() {
        return view('pages.job_detail');
    }

    public function job_in_progress() {
        return view('pages.job_in_progress');
    }

    public function job_in_progress_depart() {
        return view('pages.job_in_progress_depart');
    }

    public function job_in_progress_feedback() {
        return view('pages.job_in_progress_feedback');
    }

    public function message_center() {
        return view('pages.message_center');
    }

    public function my_jobs() {
        return view('pages.my_jobs');
    }

    public function my_orders() {
        return view('pages.my_orders');
    }

    public function notifications() {
        return view('pages.notifications');
    }

    public function place_an_order() {
        return view('pages.place_an_order');
    }

    public function profile_setting() {
        return view('pages.profile_setting');
    }

    public function statements() {
        return view('pages.statements');
    }
    public function mapRoute() {
        return view('pages.map-route');
    }
    public function withdrawls() {
        return view('pages.withdrawls');
    }

    public function profile_setting_feedback() {
        return view('pages.profile_setting_feedback');
    }

    public function index_driver() {
        return view('pages.index_driver');
    }

    public function index_purchaser() {
        return view('pages.index_purchaser');
    }

    public function index_retailer() {
        return view('pages.index_retailer');
    }

    public function signup() {
        return view('pages.signup');
    }

    public function rider_profile() {
        return view('pages.rider_profile');
    }

    public function drivers_list() {
        return view('pages.drivers_list');
    }

    public function popups() {
        return view('pages.popups');
    }

    public function order_summary() {
        return view('pages.order_summary');
    }

    public function getProfileD($id) {
        return User::whereId($id)->with(['ratings.order' => function ($query) {
            $query->withOutGlobalScopes();
        }])->orderBy('updated_at', 'DESC')->first();
    }

    public function getProfile($id = NULL) {
        if(\Auth::check()) {
            return redirect()->route('profile', [$id]);
        }
        $userId = \HashId::deCode($id,'favourite');
        $data['user_id'] = $userId;

        $data[ 'userData' ] = $this->getProfileD($userId);
        //$data[ 'favourite' ] = $this->userRepository->checkFavourite($id, 15);
        $data[ 'title' ] = $data[ 'userData' ]->display_name . ' Profile';

        return view('profile.profile', $data);
    }
}

?>
