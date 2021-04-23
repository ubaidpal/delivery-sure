<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Repositories\PrivacyRepository;

class PrivacyController extends Controller
{
    //
    private $user_id;
    private $user;
    private $is_api;
    /**
     * @var \Repositories\PrivacyRepository
     */
    private $privacy;
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * PrivacyController constructor.
     *
     * @param \Repositories\PrivacyRepository $privacy
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(PrivacyRepository $privacy, Request $request) {
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'allData' ][ 'is_api' ];
        $this->privacy = $privacy;
        $this->request = $request;
    }

    public function index() {
        $data['title'] = 'Privacy Settings';
        $data['privacy_settings'] = $this->privacy->getPrivacySettings($this->user_id);

        return view('profile.privacy-settings', $data);
    }

    public function save() {
        $data = $this->request->except(['middleware','users', 'allData', '_token']);
        $this->privacy->save($data, $this->user_id);
        return  redirect()->back()->with('success', 'Privacy settings saved successfully');
    }
}
