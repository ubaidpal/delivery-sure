<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\UserRepository;
use App\Services\StorageManager;
use App\Traits\Cropper;
use App\Traits\GenerateThumb;
use App\User;
use App\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

class UserController extends Controller
{

    use Cropper;
    use GenerateThumb;
    protected $userRepository;
    protected $is_api;
    protected $user_id;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, Request $middleware) {
        //$this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->user_id        = $middleware[ 'middleware' ][ 'user_id' ];
        $this->user           = $middleware[ 'middleware' ][ 'user' ];
        $this->is_api         = $middleware[ 'allData' ][ 'is_api' ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data[ 'user' ] = $this->user;

        $data[ 'documents' ] = $this->user->documents->keyBy('type');
        $data[ 'countries' ] = $this->userRepository->getCountries();
        $data[ 'vehicles' ]  = $this->user->vehicles;
       // $data[ 'vehicle_types' ]  = VehicleType::pluck('name','id')->toArray();
       // echo '<tt><pre>'; print_r($data[ 'vehicle_types' ]); die;
       // $data[ 'vehicle_types' ] = $this->parseVehicles( $data[ 'vehicle_types' ]);
       // echo '<tt><pre>'; print_r($data[ 'vehicle_types' ]); die;

        if($this->is_api) {
            $arr           = '';
            $arr[ 'user' ] = [
                'profile_photo_url' => getImage($data[ 'user' ][ 'profile_photo_url' ]),
                'id'                => $data[ 'user' ][ 'id' ],
                'username'          => $data[ 'user' ][ 'username' ],
                'first_name'        => $data[ 'user' ][ 'first_name' ],
                'last_name'         => $data[ 'user' ][ 'last_name' ],
                'display_name'      => $data[ 'user' ][ 'display_name' ],
                'gender'            => $data[ 'user' ][ 'gender' ],
                'active'            => $data[ 'user' ][ 'active' ],
                'email'             => $data[ 'user' ][ 'email' ],
                'country'           => $data[ 'user' ][ 'country' ],
                'city'              => $data[ 'user' ][ 'city' ],
                'state'             => $data[ 'user' ][ 'state' ],
                'about_me'          => $data[ 'user' ][ 'about' ],
                'postcode'          => $data[ 'user' ][ 'post_code' ],
                'phone_number'      => $data[ 'user' ][ 'phone_number' ],
                'address'           => $data[ 'user' ][ 'address' ],
                'latitude'          => $data[ 'user' ][ 'latitude' ],
                'longitude'         => $data[ 'user' ][ 'longitude' ],
                'user_type'         => $data[ 'user' ][ 'user_type' ],
                'driver_type'       => $data[ 'user' ][ 'driver_type' ],
                'business_address'  => $data[ 'user' ][ 'business_address' ],
                'business_name'     => $data[ 'user' ][ 'business_name' ],
                'business_phone'    => $data[ 'user' ][ 'business_phone' ],
                'business_lat'      => $data[ 'user' ][ 'business_lat' ],
                'business_lng'      => $data[ 'user' ][ 'business_lng' ],
                'lift_weight'       => $data[ 'user' ][ 'lift_weight' ],
                'approval_comment'  => $data[ 'user' ][ 'approval_comment' ],
                'dob'               => $data[ 'user' ][ 'dob' ],
                'license_number'    => $data[ 'user' ][ 'license_number' ],
                'documents'         => $this->arrangeImageUrl($data[ 'user' ][ 'documents' ])
            ];

            $arr[ 'countries' ] = $this->userRepository->getCountries();
            $arr[ 'vehicles' ]  = $data[ 'vehicles' ];
            return \Api::success_list($arr);

        }
        return view('profile.profile_setting', $data);
    }

    public function arrangeImageUrl($data) {
        $arr = '';
        foreach ($data as $documents) {
            $arr[] = array('id'      => $documents[ 'id' ], 'document_url' => getImage($documents[ 'document_url' ]),
                           'user_id' => $documents[ 'user_id' ], 'status' => $documents[ 'status' ], 'type' => $documents[ 'type' ],
                           'reason'  => $documents[ 'reason' ]);
        }
        return $arr;
    }

    public function updateProfile(Request $request) {
        //return \Api::success_data($request->all());
        if(count($request->vehicle) >= 2){
            return [
                'error' => 1,
                'message'=> 'You can add only 2 vehicles'
            ];
        }
        if($this->is_api && !$request->has('upload')) {
            $validator = Validator::make($request->all(), [
                'first_name'   => 'required',
                //'last_name'    => 'required',
                'gender'       => 'required',
                'country'      => 'required',
                'phone_number' => 'required',
                'address'      => 'required',
                'username'     => 'required|max:25',
            ]);

            if($validator->fails()) {
                return \Api::invalid_param();
            }
        } elseif(!$this->is_api) {
            $this->validate($request, [
                'first_name'   => 'required',
                //'last_name'    => 'required',
                'gender'       => 'required',
                'country'      => 'required',
                'phone_number' => 'required',
                'address'      => 'required',
                'username'     => 'required|max:25',
            ]);
        }
        $checkUserName = $this->userRepository->checkUsername($request->username, $this->user_id);
        if($checkUserName > 0) {
            if($this->is_api) {
                return \Api::other_error('Username already taken');
            }
            return redirect()->back()->with('error', 'Username already taken')->withInput();
        }

        if($this->is_api) {
            if(!$request->has('upload')) {
                $data[ 'profile' ] = $this->userRepository->updateProfile($request, $this->user_id);
            } else {
                $data[ 'images' ] = $this->apiFileUpload($request);
                return \Api::success_with_message('Uploaded Successfully');
            }

            return \Api::success_with_message('profile updated successfully.');
        }
        $this->userRepository->updateProfile($request, $this->user_id);

        return redirect('profile-setting/');
    }

    public function apiFileUpload($request) {

        $user = User::find($this->user_id);
        if(isset($request->profile_photo)) {
            $file        = $request->profile_photo;
            $folder_path = 'local/storage/app/profile_photos';
            $image       = $file;
            $filename    = time() . str_random(20) . '.' . $image->getClientOriginalExtension();

            Image::make($image->getRealPath())->save($folder_path . '/' . $filename);

            $folder_path = 'local/storage/app/profile_photos/41x41';
            Image::make($image->getRealPath())->resize(41, 41)->save($folder_path . '/' . $filename);
            $folder_path = 'local/storage/app/profile_photos/61x61';
            Image::make($image->getRealPath())->resize(61, 61)->save($folder_path . '/' . $filename);
            $folder_path = 'local/storage/app/profile_photos/254x254';
            Image::make($image->getRealPath())->resize(254, 254)->save($folder_path . '/' . $filename);

            $user->profile_photo_url = "profile_photos/" . $filename;
            $user->save();

        }
        if(isset($request->nic_front_picture)) {

            $file        = $request->nic_front_picture;
            $folder_path = 'local/storage/app/delivery_persons_documents';

            $image    = $file;
            $filename = time() . str_random(20) . '.' . $image->getClientOriginalExtension();

            Image::make($image->getRealPath())->save($folder_path . '/' . $filename);

            $data[ 'document-path' ] = "delivery_persons_documents/" . $filename;
            $data[ 'type' ]          = 1;
            $this->userRepository->updateDocument($data, $this->user_id);

            //$user->save();

        }
        if(isset($request->nic_back_picture)) {

            $file        = $request->nic_back_picture;
            $folder_path = 'local/storage/app/delivery_persons_documents';

            $image    = $file;
            $filename = time() . str_random(20) . '.' . $image->getClientOriginalExtension();

            Image::make($image->getRealPath())->save($folder_path . '/' . $filename);

            $data[ 'document-path' ] = "delivery_persons_documents/" . $filename;
            $data[ 'type' ]          = 2;
            $this->userRepository->updateDocument($data, $this->user_id);

        }
        if(isset($request->driving_license)) {

            $file = $request->driving_license;

            $folder_path = 'local/storage/app/delivery_persons_documents';

            $image    = $file;
            $filename = time() . str_random(20) . '.' . $image->getClientOriginalExtension();

            Image::make($image->getRealPath())->save($folder_path . '/' . $filename);

            $data[ 'document-path' ] = "delivery_persons_documents/" . $filename;
            $data[ 'type' ]          = 3;
            $this->userRepository->updateDocument($data, $this->user_id);

        }

        if(isset($request->commercial_driving_license)) {

            $file        = $request->commercial_driving_license;
            $folder_path = 'local/storage/app/delivery_persons_documents';

            $image    = $file;
            $filename = time() . str_random(20) . '.' . $image->getClientOriginalExtension();

            Image::make($image->getRealPath())->save($folder_path . '/' . $filename);

            $data[ 'document-path' ] = "delivery_persons_documents/" . $filename;
            $data[ 'type' ]          = 4;
            $this->userRepository->updateDocument($data, $this->user_id);

        }

        return \Api::success($user);

    }

    public function deleteVehicle(Request $request) {
        if($this->is_api) {
            if(!$request->has('vehicle_id')) {
                return \Api::invalid_param();
            }
            $id = $request->vehicle_id;
        } else {
            $id = $request->id;
        }
        $data = $this->userRepository->deleteVehicle($id, $this->user_id);
        if($this->is_api) {
            if($data[ 'error' ] == 1) {
                return \Api::other_error($data[ 'msg' ]);
            }
            return \Api::success_with_message($data[ 'msg' ]);
        }
        return $data;
    }

    public function addVehicle(Request $request) {
        if($this->is_api) {
            $validator = Validator::make($request->all(), [
                'color'   => 'required',
                'make'       => 'required',
                'model'      => 'required',
                'plate_number' => 'required',
                'year'      => 'required',
            ]);
            if($validator->fails()) {
                return \Api::invalid_param(implode(',',$validator->errors()->all()));
            }
        }
        $data = $this->userRepository->saveVehicle($this->user_id, $request->all());

        return \Api::success_with_message('Vehicle added successfully');
    }
    function array_to_object($array) {
        return (object)$array;
    }

    public function savePhoto(Request $request) {

        $user = User::find($this->user_id);
        $data = [];
        if($request->itemId == 'profile_photo') {
            $data = $this->crop('profile_photos', $request);
            $this->profileThumbs($data, \Config::get('constant_settings.PROFILE_IMAGE.SMALL_IMAGE.HEIGHT'), \Config::get('constant_settings.PROFILE_IMAGE.SMALL_IMAGE.WIDTH'), 'profile_photos', '41x41');

            $this->profileThumbs($data, \Config::get('constant_settings.PROFILE_IMAGE.MEDIUM_IMAGE.HEIGHT'), \Config::get('constant_settings.PROFILE_IMAGE.MEDIUM_IMAGE.WIDTH'), 'profile_photos', '61x61');

            $this->profileThumbs($data, \Config::get('constant_settings.PROFILE_IMAGE.LARGE_IMAGE.HEIGHT'), \Config::get('constant_settings.PROFILE_IMAGE.LARGE_IMAGE.WIDTH'), 'profile_photos', '254x254');

            $this->profileThumbs($data, \Config::get('constant_settings.PROFILE_IMAGE.X_LARGE_IMAGE.HEIGHT'), \Config::get('constant_settings.PROFILE_IMAGE.X_LARGE_IMAGE.WIDTH'), 'profile_photos', '500x500');

            $user->profile_photo_url = $data[ 'result' ];
            $user->save();

        }

        if($request->itemId == 'nic_front_picture') {
            $data                    = $this->crop('delivery_persons_documents', $request);
            $data[ 'document-path' ] = $data[ 'result' ];
            $data[ 'type' ]          = \Config::get('constant_settings.DOCUMENT-TYPES.FRONT_PICTURE');
            $this->userRepository->updateDocument($data, $this->user_id);
        }

        if($request->itemId == 'nic_back_picture') {
            $data                    = $this->crop('delivery_persons_documents', $request);
            $data[ 'document-path' ] = $data[ 'result' ];
            $data[ 'type' ]          = \Config::get('constant_settings.DOCUMENT-TYPES.BACK_PICTURE');
            $this->userRepository->updateDocument($data, $this->user_id);
        }

        if($request->itemId == 'driving_license') {
            $data                    = $this->crop('delivery_persons_documents', $request);
            $data[ 'document-path' ] = $data[ 'result' ];
            $data[ 'type' ]          = \Config::get('constant_settings.DOCUMENT-TYPES.LICENSE_PICTURE');
            $this->userRepository->updateDocument($data, $this->user_id);
        }

        if($request->itemId == 'commercial_driving_license') {
            $data                    = $this->crop('delivery_persons_documents', $request);
            $data[ 'document-path' ] = $data[ 'result' ];
            $data[ 'type' ]          = \Config::get('constant_settings.DOCUMENT-TYPES.COMMERCIAL_LICENSE_PICTURE');
            $this->userRepository->updateDocument($data, $this->user_id);
        }

        $data[ 'image_path' ] = $data[ 'result' ];
        $data[ 'result' ]     = url('photo/' . $data[ 'result' ]);
        return $data;
    }

    public function getPhoto($type, $name, $imageType = NULL) {
        $sm = new StorageManager();

        $file = $sm->getFile($type, $name, $imageType);

        return response()->make($file)->header('Content-Type', urldecode($type));
    }

    public function updateUserType(Request $request) {
        $user = User::find($this->user_id);

        if(isset($request->user_type)) {
            $user->user_type = $request->user_type;

            $user->save();
            $user->detachAllRoles();
            $user->attachRole(\Config::get('constant_settings.USER_ROLES.' . $request->user_type));
            $user->detachAllPermissions();
            if($request->user_type == \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN')) {
                $user->attachPermission(2);
            }

            return 1;
        }

        return 0;
    }

    public function getFeedbacks() {
        if($this->user->is('delivery.man')) {
            return $this->getJobsFeedbacks();
        }
        $data[ 'title' ]  = 'My Feedbacks';
        $data[ 'orders' ] = $this->userRepository->getFeedbacks($this->user_id);
        //echo '<tt><pre>'; print_r($data[ 'orders' ]);
        return view('feedback.index', $data);
    }

    public function getJobsFeedbacks() {
        $data[ 'title' ]  = 'My Feedbacks';
        $data[ 'orders' ] = $this->userRepository->getJobsFeedbacks($this->user_id);
        //echo '<tt><pre>'; print_r($data[ 'orders' ]);

        return view('feedback.jobs-feedback', $data);
    }

    public function getDeliveryApiJobsFeedbacks() {

        $orders = $this->userRepository->getJobsFeedbacks($this->user_id);
        $arr    = '';

        foreach ($orders as $order) {

            $myFeedback = $this->userRepository->getApiFeedbacks($this->user_id, $order->id);
            if(empty($myFeedback)) {
                $feedback = NULL;
                $status   = 'pending';
            } else {
                $feedback = $this->userRepository->getApiFeedbacks($order->owner->id, $order->id);
                $status   = 'active';
            }

            $arr[] = array(
                'id'                => \Hashids::connection('orders')->encode($order->id),
                'order_id'          => $order->id,
                'title'             => $order->title,
                'status'            => $status,
                'description'       => $order->order_description,
                'owner'             => $this->userRepository->userDetail($order->owner),
                'driverFeedback'    => $this->userRepository->getApiFeedbacks($this->user_id, $order->id),
                'purchaserFeedBack' => $feedback
            );
        }

        return \Api::success_list($arr);

    }

    public function getPurchaserApiJobsFeedbacks() {

        $orders = $this->userRepository->getFeedbacks($this->user_id);
        $arr    = '';

        foreach ($orders as $order) {
            $myFeedback = $this->userRepository->getApiFeedbacks($this->user_id, $order->id);
            if(empty($myFeedback)) {
                $feedback = NULL;
                $status   = 'pending';
            } else {

                $feedback = $this->userRepository->getApiFeedbacks($order->delivery_driver_id, $order->id);
                $status   = 'active';
            }
            $arr[] = array(
                'id'                => \Hashids::connection('orders')->encode($order->id),
                'title'             => $order->title,
                'status'            => $status,
                'description'       => $order->order_description,
                'owner'             => $this->userRepository->userDetail($order->owner),
                'purchaserFeedBack' => $myFeedback,
                'driverFeedback'    => $feedback
            );
        }

        /* $object = (object)$arr;
         $data['orders'] = $object;*/

        return \Api::success_list($arr);
    }

    public function dashboard($page = 5) {
        $data[ 'pageNumber' ] = $page + 5;

        if($page == 5) {
            $data[ "pageNumber" ] = 5;
        }

        $data[ 'categories' ] = Category::orderBy('name', 'DESC')->select('id', 'name', 'class')->paginate($data[ "pageNumber" ]);
        return view('dashboard.dashboard', $data);
    }

    public function changePassword() {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request) {

        if($this->is_api) {
            $validation = Validator::make($request->all(), [
                'old_password'       => 'required',
                'password'           => 'required|min:6|different:old_password',
                'conformed_password' => 'required|min:7|same:password',
            ]);
            if($validation->fails()) {
                return \Api::invalid_param();
            }
        } else {
            $this->validate($request, [
                'old_password'       => 'required',
                'password'           => 'required|min:6|different:old_password',
                'conformed_password' => 'required|min:6|same:password',
            ]);
        }

        $oldPassword      = Input::get('old_password');
        $id               = $this->user_id;
        $user             = User::find($id);
        $current_password = $user->password;
        $new_password     = Input::get('password');
        $confirm_password = Input::get('conformed_password');

        if(\Hash::check($oldPassword, $current_password)) {

            if($new_password != $confirm_password) {
                if($this->is_api) {
                    return \Api::other_error('New password and conformed password does not match');
                }

                return redirect()->back()->withErrors('New password and conformed password does not match');
            } else {

                $user->password = bcrypt($new_password);
                $user->save();
                if($this->is_api) {
                    return \Api::success_with_message();
                }

                //\Auth::logout();
                //return \Redirect::to('/');
                return redirect()->back()->with('success', 'You have successfully changed your password.');
            }
        } else {
            if($this->is_api) {
                return \Api::other_error('Old password is incorrect');
            }

            return redirect()->back()->withErrors('Old password is incorrect');
        }
    }

    public function getProfile(Request $request,$id = NULL) {
        if($this->is_api){
            if(!$request->has('user_id')){
                return \Api::invalid_param();
            }
            $id = $request->get('user_id');
        }
        $id                  = \Hashids::connection('favourite')->decode($id)[ 0 ];

        $data[ 'userData' ]  = $this->userRepository->getProfile($id);
        $data[ 'favourite' ] = $this->userRepository->checkFavourite($id, $this->user_id);
        $data[ 'title' ]     = $data[ 'userData' ]->display_name . ' Profile';
        if($data['userData']->is('delivery.man')){
            $data['vehicles'] = $data['userData']->vehicles;
        }

        if($this->is_api){
            $data = $this->userRepository->parseProfileData($data);
            unset($data['ratings']);
            return \Api::success_data($data);
        }

        if(\Auth::check()) {
            return view('profile.show-profile', $data);

        } else {
            return view('profile.profile', $data);

        }
    }

    public function quickView($id) {
        $userId = \Hashids::connection('favourite')->decode($id)[ 0 ];

        $data[ 'driver' ]    = $this->userRepository->quickProfile($userId);
        $data[ 'favourite' ] = $this->userRepository->checkFavourite($userId, $this->user_id);
//echo '<tt><pre>'; print_r($data); die;
        return view('profile.quick-profile-view', $data);
    }

    public function accessToken(Request $request) {
        $accessToken = $request->token;
        $this->userRepository->accessToken($accessToken);
        return redirect()->back()->with('error', 'Token Mismatch!');
    }

    public function checkUsername(Request $request) {
        $username = $request->get('username');
        $id       = NULL;
        if($request->has('id')) {
            $id = $request->get('id');
        }

        return $data = $this->userRepository->checkUsername($username, $id);
    }

    public function contactUs() {
        return view('contact-us');
    }

    public function contactUsPost(Request $request) {
        $rules = [
            'message' => 'required'
        ];
        if(!\Auth::check()) {
            $rules[ 'email' ] = 'required|email';
            $rules[ 'name' ]  = 'required';
            $data[ 'email' ]  = $request->email;
            $data[ 'name' ]   = $request->name;
            $data[ 'phone' ]  = $request->phone;
        } else {
            $data[ 'email' ] = $this->user->email;
            $data[ 'name' ]  = $this->user->display_name;
            $data[ 'phone' ] = $this->user->phone_number;
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            if($this->is_api) {
                $messages = implode(', ', $validator->errors->all());
                return \Api::invalid_param($messages);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $request = $request->all();
        $this->userRepository->contactUs($request, $data);

        return redirect()->back()->with('success', 'Email sent successfully. We will contact you soon. Thanks');
    }

    private function parseVehicles($vehicle_types, $parentId = 0) {

        $vehicles = array();
        foreach ($vehicle_types as $element) {
            $branch = array();
            if ($element['parent'] != 0) {

                $vehicles[$element['parent']][] = $element['id'];
            }else{
                $vehicles[$element['id']] = $element['name'];
               // $vehicles[] = $branch;
               // echo '<tt><pre>'; print_r($branch); die;

            }
        }
        return $vehicles;
    }
}
