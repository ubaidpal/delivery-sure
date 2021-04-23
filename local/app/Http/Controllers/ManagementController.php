<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\ManagementRepository;
use App\Withdrawal;
use App\WithdrawalMethod;
use App\BankAccount;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use Illuminate\Support\Facades\Validator;

class ManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user_id              = NULL;
    protected $ManagementRepository = NULL;
    protected $is_api;
    private   $user;

    public function __construct(Request $request, ManagementRepository $managementRepository) {

        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'allData' ][ 'is_api' ];
        $this->is_api  = $request[ 'allData' ][ 'is_api' ];

        $this->ManagementRepository = $managementRepository;
        $this->is_api               = $request[ 'allData' ][ 'is_api' ];

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function getBankAccount() {

        $data                  = [];
        $data[ 'url_user_id' ] = $this->user_id;

        $method = WithdrawalMethod::where(['seller_id' => $this->user_id, 'method' => 'bank'])->first();

        $bank           = BankAccount::firstOrNew(['store_withdrawal_method_id' => @$method->id]);
        $data[ 'bank' ] = $bank;

        $countries           = Country::lists('name', 'iso');
        $data[ 'countries' ] = $countries;

        if($this->is_api) {

            if($bank->id === NULL) {
                $data[ 'bank' ] = new \stdClass();
                $data[ 'countries' ];
                return \Api::success($data);
            } else {
                return \Api::success($data);
            }

        }
        return view('withdraw.add_bank', $data);

    }

    public function addBankAccount(Request $request) {
        if($this->is_api) {
            $validator = Validator::make($request->all(), [
                'full_name'                 => 'required|max:50',
                'permanent_billing_address' => 'required',
                //'temp_billing_address'      => 'required',
                //'temp_billing_address_2'    => 'required',
                'city'                      => 'required',
                'state'                     => 'required|max:4',
                'post_code'                 => 'required',
                'country'                   => 'required',
                'account_number'            => 'required',
                'iban_number'               => 'required|max:34',
                'swift_code'                => 'required',
                'bank_name'                 => 'required',
                'bank_branch_city'          => 'required',
                'branch_country'            => 'required',
            ]);

            if($validator->fails()) {
                return \Api::invalid_param();
            }
        } else {
            $this->validate($request, [
                'full_name'                 => 'required|max:50',
                'permanent_billing_address' => 'required',
                //'temp_billing_address'      => 'required',
                //'temp_billing_address_2'    => 'required',
                'city'                      => 'required',
                'state'                     => 'required|max:4',
                'post_code'                 => 'required',
                'country'                   => 'required',
                'account_number'            => 'required',
                'iban_number'               => 'required|max:34',
                'swift_code'                => 'required',
                'bank_name'                 => 'required',
                'bank_branch_city'          => 'required',
                'branch_country'            => 'required',
            ]);
        }
        $wmObj = new WithdrawalMethod();

        $method = $wmObj->firstOrNew(['seller_id' => $this->user_id, 'method' => 'bank']);

        if(empty($method->id)) {
            $method->seller_id = $this->user_id;
            $method->method    = 'bank';
            $method->save();
        }

        $bank = BankAccount::whereStoreWithdrawalMethodId(@$method->id)->first();

        if(empty($bank)) {
            $bank = new BankAccount();
        }

        $bank->store_withdrawal_method_id = $method->id;
        $bank->user_id                    = $this->user_id;
        $bank->account_title              = $request->get('full_name');
        $bank->permanent_billing_address  = $request->get('permanent_billing_address');
        $bank->temp_billing_address       = $request->get('temp_billing_address');
        $bank->temp_billing_address_2     = $request->get('temp_billing_address_2');
        $bank->city                       = $request->get('city');
        $bank->country_code               = $request->get('country');
        $bank->state                      = $request->get('state');
        $bank->post_code                  = $request->get('post_code');
        //$bank->country_code               = $request->get('country_code');
        $bank->account_number           = $request->get('account_number');
        $bank->iban_number              = $request->get('iban_number');
        $bank->swift_code               = $request->get('swift_code');
        $bank->bank_name                = $request->get('bank_name');
        $bank->bank_branch_country_code = $request->get('bank_branch_country_code');
        $bank->bank_branch_city         = $request->get('bank_branch_city');
        $bank->bank_branch_country_code = $request->get('branch_country');
        $bank->save();

        if($this->is_api) {
            return \Api::success_data($bank);
        }

        return redirect('/withdrawls');
    }

    public function requestWithdrawal() {
        $data   = [];
        $method = WithdrawalMethod::where(['seller_id' => $this->user_id, 'method' => 'bank'])
                                  ->select(['id'])
                                  ->first();

        $bank = BankAccount::where(['store_withdrawal_method_id' => @$method->id])
                           ->select(['id'])
                           ->first();

        $data[ 'bank' ] = $bank;

        $data[ 'available_balance' ] = $this->ManagementRepository->getAvailableBalance($this->user_id);
        $data[ 'pending_amount' ]    = $this->ManagementRepository->getPendingAmount($this->user_id);
        $data[ 'fee_percentage' ]    = $this->ManagementRepository->getDemeDatFee();

        $pending = $this->ManagementRepository->getPangingWithdrawal($this->user_id);

        if(!empty($pending)) {
            $method       = WithdrawalMethod::where('id', $pending->withdrawal_method_id)
                                            ->select(['method'])
                                            ->first();
            $pending->method = @$method->method;

        }

        $data[ 'pending_withdrawals' ] = $pending;
        $data[ 'pending' ] = $pending;
        $data[ 'url_user_id' ]         = $this->user_id;

        if($this->is_api) {
            return \Api::success_list($data);
        }
        return view('withdraw/withdrawls', $data);
    }

    public function sendWithdrawalRequest(Request $request) {
        $pending = $this->ManagementRepository->getPangingWithdrawal($this->user_id);
        if(!empty($pending)) {
            if($this->is_api) {
                if($pending->status != 'pending') {
                    return \Api::other_error('You have one withdrawal request in ' . $pending->status);
                } else {
                    return \Api::other_error('You have one pending withdrawal request');
                }
            }
            return redirect()->back()->with('error', 'You have one pending withdrawal request');
        }
        $payment_type   = Input::get('payment_type');
        $pending_amount = $this->ManagementRepository->getPendingAmount($this->user_id);
        $available_balance = $this->ManagementRepository->getAvailableBalance($this->user_id);
        if($payment_type == 'partial') {
            $amount = Input::get('amount');
            $amountAvailAble = $available_balance - $pending_amount;
            if($this->is_api) {
                if(!Input::has('amount')){
                    return \Api::invalid_param();
                }elseif($amount > $available_balance - $pending_amount ){

                    return \Api::other_error("Amount must be less than or equal to $amountAvailAble");
                }
            }else{
                $this->validate($request, [
                    'amount' => 'required|max:' .$amountAvailAble
                ]);
            }

        } else {
            $amount = $available_balance - $pending_amount;
        }
        $store_withdrawal_mehtod_id = $this->ManagementRepository->getDefaultWithdrawalMethod($this->user_id);
        if(empty($store_withdrawal_mehtod_id)) {
            if($this->is_api) {
                return \Api::other_error('Please add withdrawal method first');
            }
            redirect('/withdrawals')->with('info', 'Please add withdrawal method first');
        }

        $sqrObj                       = new Withdrawal();
        $sqrObj->amount               = $amount;
        $sqrObj->seller_id            = $this->user_id;
        $sqrObj->fee_percentage       = $this->ManagementRepository->demeDatFee();
        $sqrObj->withdrawal_method_id = $store_withdrawal_mehtod_id;
        $sqrObj->type                 = $payment_type;
        $sqrObj->status               = 'pending';
        $sqrObj->save();

        if($this->is_api) {
            return \Api::success($sqrObj);
        }
        return redirect('/withdrawls');

    }

    public function cancelWithdrawalRequest($withdrawal_id = NULL) {
        if($this->is_api) {
            $withdrawal_id = Input::get('id');
        }

        $withdrawal = Withdrawal::where('id', $withdrawal_id)->where('seller_id', $this->user_id)->first();
        if(empty($withdrawal)){
            return \Api::other_error('Withdrawal request not found');
        }
        if($withdrawal->status != 'pending') {
            if($this->is_api) {
                return \Api::other_error('You can not cancel request in ' . $withdrawal->status . ' state');
            }
            return Redirect::back()->with('info', 'You can not cancel request in ' . $withdrawal->status . ' state');
        }
        if(!empty($withdrawal->id)) {
            $withdrawal->status = 'canceled';
            $withdrawal->save();

        }
        if($this->is_api) {
            return \Api::success_with_message('Withdrawal request canceled successfully');
        }
        return Redirect::back();
    }

    public function statement(Request $request) {

        $transaction_type = Input::get('transaction_type');
        $data             = $this->ManagementRepository->statement($this->user_id, $transaction_type);
        // echo '<tt><pre>'; print_r($data);
        if($this->is_api) {
            return \Api::success($data);
        }
        return view('pages.statements', $data);
    }

    public function getAvailableBalance() {
        $available_balance           = $this->ManagementRepository->getAvailableBalance($this->user_id);
        $available_balance           = '$' . number_format($available_balance, 2);
        $data[ 'available_balance' ] = $available_balance;
        return \Api::success($data);

    }
}
