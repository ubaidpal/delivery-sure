<?php
/**
 * Created by PhpStorm.
 * User: ubaid.ullah
 * Date: 6/8/2016
 * Time: 11:28 AM
 * File Name    : WebServerResponse.php
 */

namespace App\Classes;

class WebServerResponse
{
    public function _get_error_message($code) {
        return config('constants_api.ERROR_MESSAGES.' . $code);
    }

    public function _get_error_code($code) {
        return config('constants_api.ERROR_CODES.' . $code);
    }

    public function _get_success_message($code) {
        return config('constants_api.SUCCESS_MESSAGES.' . $code);
    }

    public function invalid_param($msg = NULL) {
        if(empty($msg)) {
            $msg = \Api::_get_error_message('INVALID_PARAM');
        }
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('INVALID_PARAM'),
            'msg'        => $msg
        ];

        return $this->response($params);
    }

    public function response(array $params, $response = NULL) {

        $data[ 'status' ]     = $params[ 'status' ];
        $data[ 'error_code' ] = $params[ 'error_code' ];
        $data[ 'message' ]    = $params[ 'msg' ];
        if($response) {
            $data[ 'content' ] = $response;
        } else {
            $data[ 'content' ][ 'data' ] = $response;
        }
        $data[ 'content' ]['base_url'] = url('/');
        return \Response::json($data);
    }

    public function access_denied() {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('ACCESS_DENIED'),
            'msg'        => \Api::_get_error_message('ACCESS_DENIED')
        ];

        return $this->response($params);
    }

    public function item_deleted() {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('DELETED'),
            'msg'        => \Api::_get_error_message('DELETED')
        ];

        return $this->response($params);
    }

    public function success_with_message($msg = NULL) {
        if(!$msg) {
            $msg = \Api::_get_success_message('SUCCESS');
        }
        $params = [
            "status"     => 0,
            'error_code' => 0,
            'msg'        => $msg
        ];

        return $this->response($params);
    }

    public function detail_not_found() {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('DETAIL_NOT_FOUND'),
            'msg'        => \Api::_get_error_message('DETAIL_NOT_FOUND')
        ];

        return $this->response($params);

    }

    public function result_not_found() {
        $params            = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('RESULT_NOT_FOUND'),
            'msg'        => \Api::_get_error_message('RESULT_NOT_FOUND')
        ];
        $data[ 'results' ] = [];
        return $this->response($params, $data);

    }

    public function invalid_access_token() {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('TOKEN_EXPIRED'),
            'msg'        => \Api::_get_error_message('TOKEN_EXPIRED')
        ];

        return $this->response($params);

    }

    public function already_done($msg) {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('ALREADY_DONE'),
            'msg'        => $msg
        ];

        return $this->response($params);

    }
    public function already_rated($msg) {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('ALREADY_RATED'),
            'msg'        => $msg
        ];

        return $this->response($params);

    }

    public function other_error($msg) {
        $params = [
            "status"     => 1,
            'error_code' => \Api::_get_error_code('OTHER_ERROR'),
            'msg'        => $msg
        ];

        return $this->response($params);

    }

    public function time_line_posts($data) {
        $get_data = '';
        if(isset($data[ 'posts' ])) {
            $get_data = $data[ 'posts' ];
            unset($data[ 'posts' ]);
        } elseif(isset($data[ 'comments' ])) {
            $get_data = $data[ 'comments' ];
            unset($data[ 'comments' ]);
        }
        $data[ 'results' ] = $get_data;

        return $this->success($data);
    }

    public function success($data) {
        $params = [
            "status"     => 0,
            'error_code' => 0,
            'msg'        => ""
        ];

        if(isset($data[ 'results' ])) {
            if(empty($data[ 'results' ])) {
                return $this->result_not_found();
            }
        }
        if(isset($data[ 'data' ])) {
            if(empty($data[ 'data' ])) {
                return $this->detail_not_found();
            }
        }
        return $this->response($params, $data);
    }

    public function success_data($data) {
        $params = [
            "status"     => 0,
            'error_code' => 0,
            'msg'        => ""
        ];

        return $this->response($params, ['data' => $data]);
    }

    public function success_list($data) {
        $params = [
            "status"     => 0,
            'error_code' => 0,
            'msg'        => ""
        ];

        return $this->response($params, ['results' => $data]);
    }

    public function _response_data($data) {
        return ($data);
    }

    public function _get_status_change_error($withdrawal) {
        return config('info', 'You can not cancel request in ' . $withdrawal->status . ' state');
    }

}
