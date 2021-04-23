<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Repositories\Admin\FlagRepository;

class FlagController extends Controller
{
    private $request;
    private $user_id;
    private $user;
    /**
     * @var \Repositories\Admin\FlagRepository
     */
    private $flag;

    /**
     * FlagController constructor.
     *
     * @param \Repositories\Admin\FlagRepository $flag
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(FlagRepository $flag, Request $request) {
        $this->request = $request;
        $this->user_id = \Auth::user()->id;
        $this->user    = \Auth::user();
        $this->flag = $flag;
    }

    public function index() {
        $data[ 'title' ]   = 'All Flagged Reports';
        $data[ 'reports' ] = $this->flag->getAllReports();
        return view('admin.flags.all-reports', $data);
    }
}
