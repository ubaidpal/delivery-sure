<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 14-Nov-16 1:13 PM
 * File Name    : AuthorizeNet.php
 */

namespace App\Classes;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeNet
{
    private $transactionKey;
    private $apiName;

    /**
     * AuthorizeNet constructor.
     */
    public function __construct() {

    }

    public function pay($data, $amount, $user, $orderDetail) {
        define("AUTHORIZENET_LOG_FILE", "phplog");

// Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->getApiName());
        $merchantAuthentication->setTransactionKey($this->getTransactionKey());
        $refId = 'ref' . time();

// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($data[ 'number' ]);
        $creditCard->setExpirationDate($data[ 'year' ] . '-' . $data[ 'month' ]);
        $creditCard->setCardCode($data[ 'cvc' ]);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create the Bill To info
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($user->display_name);
        $billto->setLastName("");
        $billto->setCompany("");
        $billto->setAddress($user->address);
        $billto->setCity($user->city);
        $billto->setState($user->state);
        $billto->setZip($user->post_code);
        $billto->setCountry($user->city);

        // Create Order Detail
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber(\HashId::encode($orderDetail->id, 'orders'));
        $order->setDescription($orderDetail->order_description);

        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setBillTo($billto);
        $transactionRequestType->setPayment($paymentOne);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response   = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        if($response != NULL) {
            $tresponse = $response->getTransactionResponse();
            if(($tresponse != NULL) && ($tresponse->getResponseCode() == "1")) {
                $transData[ 'auth_code' ]     = $tresponse->getAuthCode();
                $transData[ 'trans_id' ]      = $tresponse->getTransId();
                $transData[ 'account_type' ]  = $tresponse->getAccountType();
                $transData[ 'message' ]       = $tresponse->getMessages()[ 0 ]->getDescription();
                $transData[ 'card_number' ]   = $tresponse->getAccountNumber();
                $transData[ 'amount' ]        = $amount;
                $transData[ 'paymentStatus' ] = 'SUCCESS';
                $transData[ 'error' ]         = 0;

            } elseif(($tresponse != NULL) && ($tresponse->getErrors() != NULL)) {
//echo '<tt><pre>'; print_r($tresponse); die;
                $transData[ 'message' ] = $tresponse->getErrors()[ 0 ]->getErrorText();
                $transData[ 'error' ]   = 1;
            } else {

                $transData[ 'message' ] = "Credit Card ERROR :  Invalid response\n";
                $transData[ 'error' ]   = 1;

            }
        } else {
            $transData[ 'message' ] = "Credit card Null response returned";
            $transData[ 'error' ]   = 1;
        }
        return $transData;
    }

    /**
     * @return string
     */
    public function getApiName() {
        return \Config::get('constant_settings.PAYMENT_GATEWAY.AUTHORIZE_NET.LOGIN_ID');
    }

    /**
     * @return string
     */
    public function getTransactionKey() {
        return \Config::get('constant_settings.PAYMENT_GATEWAY.AUTHORIZE_NET.TRANSACTION_KEY');
    }

}
