<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/6/2016
 * Time: 9:31 PM
 */
namespace App\Repositories;

use App\Http\Requests;
use App\Transaction;
use App\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\WithdrawalMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ManagementRepository
{

    public function getAvailableBalance($user_id) {
        $debit   = Transaction::where('user_id', $user_id)->where('transaction_type', 'debit')->whereStatus(1)->sum('amount');
        $credit  = Transaction::where('user_id', $user_id)->where('transaction_type', 'credit')->whereStatus(1)->sum('amount');
        $balance = $credit - $debit;
        return $balance;
    }

    public function getPendingAmount($user_id) {
        $pending_amount = Withdrawal::where('seller_id', $user_id)->where('status', 'pending')->sum('amount');
        return $pending_amount;
    }

    public function getDemeDatFee() {
        $fee_percentage = 10;
        return $fee_percentage;
    }

    public function getDefaultWithdrawalMethod($user_id) {
        $method = WithdrawalMethod::where('is_default', 1)
                                  ->select(['id', 'seller_id'])
                                  ->where('seller_id', $user_id)
                                  ->first();
        if(empty($method->id)) {
            $method = WithdrawalMethod::where('seller_id', $user_id)
                                      ->select(['id', 'seller_id'])
                                      ->first();
        }
        return @$method->id;
    }

    public function demeDatFee() {
        $fee_percentage = 10;
        return $fee_percentage;
    }

    public function statement($user_id, $type) {

        if(Input::has('to')) {
            $to = Carbon::parse(Input::get('to'))->format('Y-m-d H:i:s');
        } else {
            $to = Carbon::now();
        }

        if(Input::has('from')) {
            $from = Carbon::parse(Input::get('from'))->format('Y-m-d H:i:s');
        } else {
            $from = Carbon::now()->subDay(30);
        }
        $data[ 'transactions' ] = $this->get_transactions($user_id, $from, $to, $type);

        $data[ 'earning' ]           = $this->totalEarning($user_id);

        $data[ 'beginning_balance' ] = $this->beginning_balance($user_id, $from);
        $data[ 'from' ]              = $from;
        $data[ 'to' ]                = $to;
        $data[ 'transaction_type' ]  = $type;

        return $data;
    }

    private function get_transactions($user_id, $from, $to, $type) {
        $query = Transaction::whereUserId($user_id)
                            ->where('created_at', '>', $from)
                            ->where('created_at', '<', $to)
                            ->orderBy('created_at', 'DESC')
                            ->whereStatus(1);
        if(!empty($type)) {
            $query->where('transaction_type', 'like', $type);
        }
        return $query->get();
    }

    private function totalEarning($store_id) {
        return $this->getAvailableBalance($store_id);
    }

    private function beginning_balance($store_id, $from) {
        //return StoreOrder::where('seller_id', $store_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->sum('total_price');
        $earning = Transaction::where('user_id', $store_id)
                              ->where('type', \Config::get("constant_settings.STATEMENT_TYPES.SALE"))
                              ->where('created_at', '<', $from)
                              ->whereStatus(1)
                              ->sum('amount');

        $withdraw = Transaction::where('user_id', $store_id)
                               ->where('type', '!=', \Config::get("constant_settings.STATEMENT_TYPES.SALE"))
                               ->where('created_at', '<', $from)
                               ->whereStatus(1)
                               ->sum('amount');
        return $earning - $withdraw;
    }

    public function getPangingWithdrawal($userID) {
        return Withdrawal::where('seller_id', $userID)
                         ->where(function ($q) {
                             $q->where('status', 'pending');
                             $q->orwhere('status', 'processing');
                         })
                         ->first();
    }
}
