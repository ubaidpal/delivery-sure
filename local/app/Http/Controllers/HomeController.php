<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\SendEmail;
use App\Http\Requests;
use App\Repositories\DashBoardRepository;
use App\Repositories\UserRepository;
use App\Traits\OrderDetailsTrait;
use Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Repositories\Criteria\OpenedJobs;
use Repositories\OrderRepository as Order;

class HomeController extends Controller
{
    use OrderDetailsTrait;
    protected $user_id;
    protected $user;
    protected $is_api;
    /**
     * @var \Repositories\OrderRepository
     */
    private $order;
    /**
     * @var \App\Repositories\DashBoardRepository
     */
    private $dashBoard;
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * @var \App\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Repositories\OrderRepository $order
     * @param \App\Repositories\DashBoardRepository $dashBoard
     */
    public function __construct(Request $request, Order $order, DashBoardRepository $dashBoard, UserRepository $userRepository) {
        $this->user_id   = $request[ 'middleware' ][ 'user_id' ];
        $this->user      = $request[ 'middleware' ][ 'user' ];
        $this->is_api    = $request[ 'allData' ][ 'is_api' ];
        $this->order     = $order;
        $this->dashBoard = $dashBoard;

        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(\Auth::check()) {
            /*if($this->user->is('retailer')) {
                if(empty($this->user->business_address) || empty($this->user->business_name) || empty($this->user->business_phone)) {
                    return redirect('profile-setting');
                }
            }*/
            if($this->user->is('delivery.man')) {
                if(empty($this->user->address) || empty($this->user->profile_photo_url)) {
                    return redirect('profile-setting');
                }
            }

            /*if($this->user->is('purchaser')) {
                if(empty($this->user->address) || empty($this->user->profile_photo_url)) {
                    return redirect('profile-setting');

                }
            }*/

            if($this->user->is('purchaser')) {
                // $view = 'purchaser';
                return redirect()->route('find-driver');
            } elseif($this->user->is('delivery.man')) {
                //$view = 'rider';
                return redirect()->route('dashboard');
            } else {
                //$view = 'retailer';
                return redirect()->route('find-driver');
            }
            //return view('dashboard.'.$view);
        } else {
            //return redirect()->route('dashboard');
            //$this->dashboard();
            return view('welcome');
        }
    }

    public function deliveryDriver() {
        $data[ 'title' ] = 'Delivery person';
        return view('dashboard.rider', $data);
    }

    public function retailer() {
        $data[ 'title' ] = 'Retailer';
        return view('dashboard.retailer', $data);
    }

    public function purchaser() {
        $data[ 'title' ] = 'Purchaser';
        return view('dashboard.purchaser', $data);
    }

    public function dashboard($page = 10) {

         $data[ 'jobs' ]    = $this->order->allOpenedJobs($this->user_id, $page);

        $data[ 'markers' ] = $this->dashBoard->markersPositions($data[ 'jobs' ]);

        if(isset($this->request->fullScreen) && !empty($this->request->fullScreen)) {
            $data[ 'driverMarkers' ] = $this->dashBoard->markersPositions($data[ 'jobs' ]);
            return view('full-screen-map.drivers', $data);
        }

        $data[ 'categories' ] = $this->dashBoard->getCategoriesDetail();
        $data[ 'budget' ]     = $this->dashBoard->getBudgetRange();
        //echo '<tt><pre>'; print_r($data); die;
        if($this->is_api) {
            $jobs = $this->dashBoard->parseData($data);
            return \Api::success(['results' => $jobs,'markers'=>  $data[ 'markers' ]]);
        }
        return view('dashboard.dashboard', $data);
    }

    public function showMoreJob($page = 10) {
        $nextR = $page + 10;
        $jobs  = $this->order->viewMoreJobs($this->user_id, $page);
        $html  = '';
        $html  = '<div style="display:none" id="' . $nextR . '" class="nextR"></div>';
        if(count($jobs) > 0) {
            $data['jobs'] = $jobs;
            $html .= view('jobs.list-box', $data)->render();
        } else {
            $html .= '<div class="job-item">No more jobs found</div>';

        }
        /*if(count($jobs)> 2) {
            $html .= '<div class="btn-center-block">';
            $html .= '<a href="javascript:void(0);" class="btn btn-white show_more">SHOW MORE</a>';
            $html .= '</div>';
        }*/
        $html .= '</div>';
        if(count($jobs) > 0) {
            $data = ['html' => $html, 'showMore' => 1];
            return $data;
        } else {
            $data = ['html' => $html, 'showMore' => 0];
            return $data;
        }
    }

    public function viewMoreCategory($page = 5) {
        $take = 5;
        if($page == 10) {
            $skip = 5;
        } else {
            $skip = $page - $take;
        }
        $nextRecords = $page + 5;

        $categories = Category::orderBy('name', 'ASC')->select('id', 'name', 'class')->skip($skip)->take($take)->get();
        $html       = '';
        // $html .= '<div style="display: none;" id="'.$nextRecords.'" class="nextRecords"></div> <div class="h3">Categories</div>';
        foreach ($categories as $category) {
            $html .= '<div class="categories-list-item">';
            $html .= '<div class="categories-item-icon ' . $category->class . '"></div>';
            $html .= '<div class="categories-item-name">' . $category->name . '</div>';
            $html .= '<div class="checkbox-container"><input type="checkbox" name="categories[]" value="' . $category->id . '"></div>';
            $html .= '</div>';
        }
        //$html .= ' <div class="btn-center-block">';
        // $html .= '<a class="btn btn-link pageSort"  href="#">Show more categories</a>';
        // $html .= '</div>';

        return $html;
    }

    public function quickView(Request $request, $id = NULL) {
        if($this->is_api) {
            if(!$request->has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];


        $data[ 'job' ]   = $this->order->find($id);
        $data[ 'items' ] = $data[ 'job' ]->items;
        $data[ 'owner' ] = $data[ 'job' ]->owner;
        $data['category'] = $data['job']->category;
        $data[ 'myBid' ] = $this->dashBoard->myBid($id, $this->user_id);
        if($this->is_api) {
            $data = $this->dashBoard->parseSingleItem($data);
            return \Api::success_data($data);
        }

        return view('dashboard.job-quick-view', $data);
    }

    public function filter(Request $request) {

        $data[ 'budget' ] = $this->dashBoard->getBudgetRange();

         $data[ 'jobs' ]    = $this->dashBoard->filter($request->except(['allData', 'middleware']), $this->user_id);

        $data[ 'markers' ] = $this->dashBoard->markersPositions($data[ 'jobs' ]);

        if(isset($request->fullScreen) && !empty($request->fullScreen)) {
            $data[ 'driverMarkers' ] = $this->dashBoard->markersPositions($data[ 'jobs' ]);
            return view('full-screen-map.drivers', $data);
        }

        if($this->is_api) {
            $orders = $this->parseData($data);
            return \Api::success(['results' => $orders, 'markers' => $data[ 'markers' ]]);
        }
        $data[ 'categories' ]    = $this->dashBoard->getCategoriesDetail();
        $data[ 'filter' ]        = $request->except(['allData', 'middleware']);
        $data[ 'allCategories' ] = 1;

        return view('dashboard.dashboard', $data);
        //echo '<tt><pre>'; print_r($request->all()); die;
    }

    public function contactUs(Request $request) {
        $emailData = array(
            'subject'      => 'Contact Us',
            'message'      => $request->message,
            'from'         => $request->email,
            'name'         => $request->name,
            'phone_number' => $request->phone,
            'template'     => 'contact-us',
            'to'           => \Config::get('constant_settings.CONTACT_US_EMAIL'),
        );

        \Event::fire(new SendEmail($emailData));
        return redirect()->back();
    }

    public function subscribe(Request $request) {
        $this->dashBoard->subscribe($request);
        return redirect()->back();
    }

    public function terms() {

        return view('terms');
    }
    public function privacyPolicy() {
        return view('privacy-policy');
    }

}
