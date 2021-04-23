<?php

namespace App\Http\Controllers;

use App\Traits\Favourites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Repositories\FavouriteRepository as Favourite;

class FavouriteController extends Controller
{
    use Favourites;
    protected $user_id;
    protected $user;
    protected $is_api;
    /**
     * @var \Repositories\FavouriteRepository
     */
    private $favourite;
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * FavouriteController constructor.
     *
     * @param \Repositories\FavouriteRepository $favourite
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Favourite $favourite, Request $request) {

        $this->favourite = $favourite;
        $this->request   = $request;
        $this->user_id   = $request[ 'middleware' ][ 'user_id' ];
        $this->user      = $request[ 'middleware' ][ 'user' ];
        $this->is_api    = $request[ 'allData' ][ 'is_api' ];
    }

    public function index($fullScreen = NULL) {
        if($this->user->is('delivery.man')) {
            return redirect()->back()->with('error', 'You cannot place an order');
        }
        $data[ 'title' ]   = 'Find Driver';
        $data[ 'drivers' ] = $this->favourite->getDrivers();

        $data[ 'driverMarkers' ] = $this->favourite->driverMarkers($data[ 'drivers' ]);

        // Show Map in full screen
        if(!is_null($fullScreen)) {
            return view('full-screen-map.drivers', $data);
        }

        $data[ 'driversPages' ] = $data[ 'drivers' ];
        //$data[ 'drivers' ]      = $this->favourite->orderByRating($data[ 'drivers' ]);
        $data[ 'favourites' ] = $this->favourite->getFavourites($this->user_id);
        if(!is_null($fullScreen)) {

        }

        if($this->is_api) {
            $drivers = $this->favourite->parseDrivers($data);
            return \Api::success(['results' => $drivers, 'markers' => $data[ 'driverMarkers' ]]);
        }
        return view('favourites.drivers-list', $data);
    }

    public function favouritesDriver() {
        $data[ 'title' ]   = 'Favourite Driver';
        $data[ 'drivers' ] = $this->favourite->getFavDrivers($this->user_id);

        $data[ 'favourites' ] = $this->favourite->getFavourites($this->user_id);
        if($this->is_api) {
            $drivers[ 'drivers' ] = $this->favourite->parseFavoriteDrivers($data[ 'drivers' ]);
            return \Api::success($drivers);
        }
        return view('favourites.purchaser-list', $data);
    }

    public function addFavourite() {

        if($this->is_api) {
            if(!Input::has('userId')) {
                return \Api::invalid_param();
            }
        }
        $userId = $this->request->get('userId');
        $userId = \Hashids::connection('favourite')->decode($userId)[ 0 ];
        if($this->request->type == 'add') {
            $data = [
                'object_type' => 'user',
                'object_id'   => $userId,
            ];
            $this->addToFavourite($data, $this->user_id);
            if($this->is_api) {
                return \Api::success_with_message('Driver added to favorite');
            }
            return 1;
        } else {
            $this->removeFavouritesByUserId($userId, $this->user_id, 'user');
            if($this->is_api) {
                return \Api::success_with_message('Driver removed from favorite');
            }
            return 2;
        }
    }

    public function searchDriver($fullScreen = NULL) {

        $data = $this->request->except('middleware');
        //$driver = $this->request->search;
        // $radius = $this->request->radius;
        if($this->is_api) {
            if($this->request->has('radius')) {
                if(!$this->request->has('latitude') || !$this->request->has('longitude')) {
                    return \Api::invalid_param();
                }
            }
        }
        $data[ 'drivers' ]       = $this->favourite->searchDrivers($data);
        $data[ 'driverMarkers' ] = $this->favourite->driverMarkers($data[ 'drivers' ]);
        // Show Map in full screen
        if(isset($this->request->fullScreen) && !empty($this->request->fullScreen)) {
            return view('full-screen-map.drivers', $data);
        }

        $data[ 'driversPages' ] = $data[ 'drivers' ];
        //$data[ 'drivers' ]      = $this->favourite->orderByRating($data[ 'drivers' ]);
        $data[ 'favourites' ] = $this->favourite->getFavourites($this->user_id);
        // $data[ 'key' ]        = $driver;
        if($this->is_api) {
            $data = $this->favourite->parseDrivers($data);
            return \Api::success_list($data);
        }
        $data[ 'filter' ] = $data;
        return view('favourites.drivers-list', $data);
    }

}
