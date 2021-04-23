<?php

namespace App\Http\Controllers;

use App\Conversation;

use App\Traits\UploadAttachment;
use Illuminate\Support\Facades\Input;
use Repositories\MessageRepository as Message;
use App\Repositories\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller
{
    use UploadAttachment;
    //use GenerateThumb;
    private $data;
    private $user_id;
    private $is_api;
    /**
     * @var Message
     */
    private $messageRepository;
    /**
     * @var UserRepository
     */
    private $usersRepository;

    public function __construct(Request $middleware, Message $messageRepository, UserRepository $usersRepository) {
        $this->user_id = $middleware[ 'middleware' ][ 'user_id' ];
        @$this->data->user = $middleware[ 'middleware' ][ 'user' ];
        $this->is_api            = $middleware[ 'allData' ][ 'is_api' ];
        $this->messageRepository = $messageRepository;
        $this->usersRepository   = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conv_id = NULL) {

        $data = $this->messageRepository->get_conversations($this->user_id, $conv_id);
        //$data[ 'counter' ] = $this->messageRepository->message_counter($this->user_id);
        $conversations = $this->conversations_data($data);
        if($this->is_api) {

            return \Api::success_list($conversations);
        }
        $convs[ 'conversations' ]      = $conversations;

        $convs[ 'messages' ]           = (isset($data[ 'messages' ]) ? $data[ 'messages' ] : '');
        $convs[ 'users' ]              = (isset($data[ 'users' ]) ? $data[ 'users' ] : '');
        $convs[ 'first_conversation' ] = (isset($data[ 'first_conversation' ]) ? $data[ 'first_conversation' ] : '');
        $convs[ 'conv_id' ]            = $data[ 'conv_id' ];
        unset($data);

        $convs[ 'title' ] = $this->data->user->display_name . ' | Messages';
        //echo '<tt><pre>'; print_r($convs); die;
        return view('messages.message_center', $convs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if($request->has('conv_id')) {
            $conv_id  = $this->messageRepository->decodeId($request[ 'conv_id' ]);
            $response = $this->messageRepository->is_conv_open($conv_id);
            if($response['closed'] == 1) {
                if($this->is_api) {
                    return \Api::other_error($response['msg']);
                } else {
                    return array('is_closed' => 1, 'msg' => $response['msg']);
                }

            }
        }

        $value          = $request->file('attachment');
        $file[ 'data' ] = [];
        if(!empty($value)) {
            $file = $this->upload_attachment($value, $this->user_id);

            if($file == 'invalid_file') {
                if($this->is_api()) {
                    return \Api::other_error('Invalid File Type');
                }
                return 'invalid_file';
            }
            $file[ 'data' ][ 'file_type' ] = $this->messageRepository->get_file_type($file[ 'data' ][ 'extension' ]);
            $request[ 'file_id' ]          = $file[ 'file_id' ];
        }

        $user_id = $this->user_id;
        /*if ($this->is_api) {
            $user_id = $request['sender_id'];
        }*/
        $data = $conv_data = $this->messageRepository->save_message($request, $user_id);

        if(!empty($value) && $this->is_api) {

            if(in_array(strtolower($file[ 'data' ][ 'extension' ]), $this->getAllowedVideoFiles())) {
                $path = \Config::get('constants_activity.ATTACHMENT_VIDEO_URL_MOD');
            } else {
                $path = \Config::get('constants_activity.ATTACHMENT_URL');
            }

            $url      = $path . $file[ 'data' ][ 'storage_path' ] . '?type=' . urlencode($file[ 'data' ][ 'mime_type' ]);
            $fileName = $file[ 'data' ][ "name" ];
            if($this->is_api) {
                return \Api::success_data(['body' => $request->body, 'url' => $url, 'file_name' => $fileName, 'sender_id' => $user_id, 'created_at' => Carbon::now(),]);
            }

        }
        if(isset($request[ 'members' ])) {
            $conv_id = $data[ 'convId' ];
            if($this->is_api) {
                return \Api::success_list($this->messageRepository->getConvMessages($conv_id, 1));
            }

            $data                    = $this->messageRepository->get_messages($this->user_id, $conv_id);
            $data[ 'conv_detail' ]   = Conversation::findOrNew($conv_id);
            $data[ 'members' ]       = $request[ 'members' ];
            $response[ 'messages' ]  = view('messages.conversation-messages', $data)->render();
            $data[ 'body' ]          = $request[ 'body' ];
            $response[ 'conv_head' ] = view('messages.conversation-head', $data)->render();

            $response[ 'conv_id' ] = $conv_id;

            return $response;
        }

        if($this->is_api) {
            return \Api::success(['data' => $request->except(['access_token', 'middleware']), 'attachment' => $file[ 'data' ]]);
        }

        return $this->successResponse($request->except(['middleware', 'allData']), $conv_data, $file[ 'data' ]);
        //return view('messages.new-message', ['data' => $request->all(), 'attachment' => $file[ 'data' ]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $conv_id) {
        //$user = $this->usersRepository->get_user($id)->id;

        $data = $this->messageRepository->get_messages($id, $conv_id);

        $result = view('messages.thread-messages', $data)->render();

        //$result['conv_type'] = $data['conv_type'];

        return $result;
        //return view('messages.conversation-messages', $data);
    }

    public function get_messages($userId = NULL, $conv_id = NULL) {
        //$user     = $this->usersRepository->get_user($userId)->id;
        //$data     = $this->messageRepository->get_messages($user, $conv_id);
        if($this->is_api) {
            if(!Input::has('conv_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('conv_id');
            $conv_id = \Hashids::connection('message')->decode($id )[ 0 ];
        }
        $data[ 'messages' ]     = $this->get_group_messages($conv_id, 1, 'ASC');
        $data[ 'conversation' ] = $this->messageRepository->get_conv_by_id($conv_id);
        $members                = $this->messageRepository->getUsersInConvs($conv_id);
        if($this->is_api) {
            if($members[ 1 ]->id == $this->user_id) {
                $data[ 'me' ]    = $this->messageRepository->get_user_api_detail($members[ 1 ]->id);
                $data[ 'other' ] = $this->messageRepository->get_user_api_detail($members[ 0 ]->id);
            } else {
                $data[ 'me' ]    = $this->messageRepository->get_user_api_detail($members[ 0 ]->id);
                $data[ 'other' ] = $this->messageRepository->get_user_api_detail($members[ 1 ]->id);
            }

            $convData = $data[ 'messages' ];

            return \Api::success([
                    'messages'             => $convData,
                    'conv_id'             => \HashId::encode($conv_id, 'message'),
                    'conversation_detail' => $data[ 'conversation' ],
                    'me'                  => $data[ 'me' ],
                    'other'               => $data[ 'other' ]

                ]
            );
        }

        if($data[ 'conversation' ]->type == 'group') {
            $data[ 'title' ] = $data[ 'conversation' ]->title;
        } else {
            $members = $this->messageRepository->getUsersInConvs($conv_id);
            foreach ($members as $row) {
                if($row->id != $this->user_id) {
                    $data[ 'title' ] = User::findOrNew($row->id)->displayname;
                }
            }
        }

        return view('messages.thread', $data);

    }

    public function update(Request $request) {
        $conv_id = $request[ 'conv_id' ];
        $name    = $request[ 'name' ];
        $this->messageRepository->update_name($conv_id, $name, $this->user_id);
    }

    public function create_group(Request $request) {
        if($this->is_api) {
            if(!$request->has('users')) {
                return \Api::invalid_param();
            }
        }
        $conv_id = $this->messageRepository->make_group($request, $this->user_id);
        if($this->is_api) {
            return \Api::success(['data' => $conv_id]);
        }

        return $conv_id;
    }

    public function add_member_to_group(Request $request) {
        if($this->is_api) {
            if(!$request->has('member') || !$request->has('conv_id')) {
                return \Api::invalid_param();
            }
        }
        $members      = $request[ 'member' ];
        $conversation = $request[ 'conv_id' ];

        $members = $this->messageRepository->add_member_to_group($members, $conversation);

        if($this->is_api) {
            $data[ 'participants' ] = $members;

            return \Api::success(['data' => $data]);
        }

        return $members;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function get_thread(Request $request) {
        $page = isset($request[ 'page' ]) ? $request[ 'page' ] : 1;

        if($this->is_api) {
            if(!$request->has('group_id') && !($request->has('user_1') && $request->has('user_2'))) {
                return \Api::invalid_param();
            }
        }

        if(isset($request[ 'group_id' ])) {
            $messages = $this->get_group_messages($request[ 'group_id' ], $page);
            if($this->is_api) {
                if(!empty($messages)) {
                    return \Api::success(['data' => $messages, 'count' => count($messages)]);
                } else {
                    return \Api::success_with_message('Detail not found');
                }
            }

            return \Response::json($messages);
        }

        $messages = $this->getMessagesByTwoUsers($page);
        if($this->is_api) {
            return \Api::success(['data' => $messages, 'count' => count($messages)]);
        }

        return \Response::json($messages);
    }

    public function get_user_detail() {
        if($this->is_api) {
            if(!\Input::has('users')) {
                return \Api::invalid_param();
            }
        }
        $users = \Input::get('users');

        $detail = $this->messageRepository->get_user_detail($users);

        if($this->is_api) {
            return \Api::success(['results' => $detail]);
        }

        return $detail;
    }

    public function get_friends_detail() {
        $user_id = $this->user_id;
        if(\Input::has('user_id')) {
            $user_id = \Input::get('user_id');
        }

        $detail = $this->messageRepository->get_friends($user_id);
        if($this->is_api) {
            return \Api::success(['results' => $detail]);
        }

        return $detail;
    }

    public function getUserByID() {
        $user_id              = \Input::get('user_id');
        $user                 = User::whereUsername($user_id)->orWhere('id', $user_id)->first();
        $row[ 'user_id' ]     = $user->user_id;
        $row[ 'displayname' ] = $user->displayname;
        $row[ 'profile_pic' ] = \Kinnect2::get_photo_path($user->photo_id);
        $row[ 'user_type' ]   = $user->user_type;//($user->user_type == \Config::get('constants.REGULAR_USER')?'kinnector':'brand');
        return $row;
    }

    public function get_conv_name() {
        if(!\Input::has('conv_id')) {
            return \Api::invalid_param();
        }
        $conv_id                   = \Input::get('conv_id');
        $conv_name[ 'group_name' ] = $this->messageRepository->get_conv_name($conv_id);
        if($this->is_api) {
            return \Api::success_data($conv_name);
        }

        return $conv_name;
    }

    public function saveTimeZone($TZ) {
        $this->messageRepository->saveTimeZone($TZ, $this->user_id);

        return redirect('messages');
    }

    private function conversations_data($data) {
        $all = [];
        foreach ($data[ 'conversation' ] as $item) {

            $row[ 'id' ] = $item->getId();
            $row[ 'conv_id' ] = $row['id'];
            if($this->is_api) {
                $row[ 'id' ] = [\Hashids::connection('orders')->encode($row[ 'id' ])];
            }
            $row[ 'type' ]                = $data[ 'conv_data' ][ $item->getId() ]->type;
            $row[ 'title' ]               = $data[ 'conv_data' ][ $item->getId() ]->title;
            $row[ 'last_message' ]        = $item->getLastMessage()->getContent() == '?-empty-?' ? '' : $item->getLastMessage()->getContent();
            $row[ 'last_message_sender' ] = $item->getLastMessage()->getSender();
            $row[ 'conv_for' ] = $item->getConvFor();
            $row[ 'file_meta' ]           = $this->messageRepository->attachment_detail($item->getLastMessage()
                                                                                             ->getFile());
            //$row[ 'time' ]                = $data[ 'conv_data' ][ $item->getId() ]->created_at;
            $row[ 'time' ]        = $item->getLastMessage()->getCreated();
            $row[ 'participant' ] = $this->get_participants_detail($item->getAllParticipants(), $data);
            $all[]                = $row;
        }

        return $all;
    }

    /**
     * @param $allParticipants
     * @param $data
     *
     * @return array
     */
    private function get_participants_detail($allParticipants, $data) {
        $all             = [];
        $row             = [];
        $allParticipants = array_diff($allParticipants, [$this->user_id]);
        foreach ($allParticipants as $participant) {
            $row[ 'id' ]          = $data[ 'users' ][ $participant ]->id;
            $row[ 'name' ]        = $data[ 'users' ][ $participant ]->display_name;
            $row[ 'user_type' ]   = $data[ 'users' ][ $participant ]->user_type;
            $row[ 'profile_url' ] = $data[ 'users' ][ $participant ]->username;
            $row[ 'profile_pic' ] = getImage($data[ 'users' ][ $participant ]->profile_photo_url,'41x41');

            $all[ $data[ 'users' ][ $participant ]->id ] = $row;
        }

        return $row;
    }

    private function get_group_messages($group_id, $page, $order = 'DESC') {
        \TBMsg::markReadAllMessagesInConversation($group_id, $this->user_id);

        return $this->messageRepository->getConvMessages($group_id, $page, $order);
    }

    private function getMessagesByTwoUsers($page) {
        $user_1  = \Input::get('user_1');
        $user_2  = \Input::get('user_2');
        $conv_id = $this->messageRepository->getConversationByTowUsers($user_1, $user_2);

        return $this->get_group_messages($conv_id, $page);

    }

    public function all_participants() {
        if(!\Input::has('conv_id')) {
            return \Api::invalid_param();
        }

        $conv_id = \Input::get('conv_id');
        $users   = $this->messageRepository->getUsersInConversation($conv_id);
        $users   = User::whereIn('id', $users)->get();
        return \Api::success_list($this->get_all_participants_detail($users));

    }

    private function get_all_participants_detail($users) {
        $all = [];
        //$allParticipants = array_diff($users, [$this->user_id]);
        foreach ($users as $participant) {
            $row[ 'id' ]          = $participant->id;
            $row[ 'name' ]        = $participant->displayname;
            $row[ 'user_type' ]   = $participant->user_type;
            $row[ 'profile_url' ] = $participant->username;
            $row[ 'profile_pic' ] = \Kinnect2::getPhotoUrl($participant->photo_id, $participant->id, 'user', 'thumb_normal');

            $all[] = $row;
        }
        return $all;
    }

    private function successResponse($data, $conv_data, $file) {
        return [
            'message_body'    => $data[ 'body' ],
            'conv_id'         => $conv_data[ 'convId' ],
            'file_data'       => $file,
            'profile_picture' => getImage($this->data->user->profile_photo_url),
            'time'            => Carbon::parse(Carbon::now())->format("Y-m-d H:i:s")
        ];
    }

    public function contactBidder($id = NULL, $orderId = NULL) {
        if($this->is_api) {
            if(!Input::has('bidder_id') || !Input::has('order_id')) {
                 return \Api::invalid_param();
            }
            $id      = Input::get('bidder_id');
            $orderId = Input::get('order_id');
        }

        $id      = \HashId::deCode($id, 'message');
        $orderId = \HashId::deCode($orderId, 'orders');
        $conv_id = $this->messageRepository->getConversationByOrderId($id, $this->user_id, $orderId);
       // echo '<tt><pre>'; print_r($conv_id); die;
        if(!$conv_id) {
            $data    = $this->messageRepository->createConversation($users_ids = array($this->user_id, $id), $this->user_id, 'couple', $orderId);
            $conv_id = $data[ 'convId' ];
            $this->messageRepository->addMessageToConversation($conv_id, $this->user_id, $data = ['body' => '?-empty-?', 'file_id' => NULL]);
        }
        if($this->is_api) {
            Input::merge(['conv_id' => \HashId::encode( $conv_id,'message')]);
            return $this->get_messages($id, $conv_id);
        }
        return $this->index($conv_id);


    }

    public function updateMessages(Request $request) {
        $convId = \Hashids::connection('message')->decode($request->conv_id)[ 0 ];
        $data   = $this->messageRepository->get_messages($this->user_id, $convId);
        return $messages = view('messages.thread-messages', $data)->render();
    }

}
