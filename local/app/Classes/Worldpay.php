<?php

namespace App\Classes;

use PhpSpec\Exception\Exception;
use App\Classes\WorldpayException;

class Worldpay
{

    /**
     * Library variables
     * */

    private        $service_key       = "";
    private        $timeout           = 65;
    private        $disable_ssl       = TRUE;
    private        $endpoint          = 'https://api.worldpay.com/v1/';
    private static $use_external_JSON = FALSE;
    private        $order_types       = array('ECOM', 'MOTO', 'RECURRING');

    private static $errors = array(
        "ip"                  => "Invalid parameters",
        "cine"                => "php_curl was not found",
        "to"                  => "Request timed out",
        "nf"                  => "Not found",
        "apierror"            => "API Error",
        "uanv"                => "Worldpay is currently unavailable, please try again later",
        "contact"             => "Error contacting Worldpay, please try again later",
        'ssl'                 => 'You must enable SSL check in production mode',
        'verify'              => 'Worldpay not verifiying SSL connection',
        'orderInput'          => array(
            'token'            => 'No token found',
            'orderDescription' => 'No order_description found',
            'amount'           => 'No amount found, or it is not a whole number',
            'currencyCode'     => 'No currency_code found',
            'name'             => 'No name found',
            'billingAddress'   => 'No billing_address found',
        ),
        'notificationPost'    => 'Notification Error: Not a post',
        'notificationUnknown' => 'Notification Error: Cannot be processed',
        'refund'              => array(
            'ordercode' => 'No order code entered',
        ),
        'capture'             => array(
            'ordercode' => 'No order code entered',
        ),
        'json'                => 'JSON could not be decoded',
        'key'                 => 'Please enter your service key',
        'sslerror'            => 'Worldpay SSL certificate could not be validated',
        'timeouterror'        => 'Gateway timeout - possible order failure. Please review the order in the portal to confirm success.',
    );

    /**
     * Library constructor
     * @param string $service_key
     *  Your worldpay service key
     * @param int    $timeout
     *  Connection timeout length
     * */
    public function __construct($service_key = FALSE, $timeout = FALSE) {
        if ($service_key == FALSE) {
            self::onError("key");
        }
        $this->service_key = $service_key;

        if ($timeout !== FALSE) {
            $this->timeout = $timeout;
        }

        if (!function_exists("curl_init")) {
            self::onError("cine");
        }

        //
    }

    /**
     * Gets the client IP by checking $_SERVER
     * @return string
     * */
    private function getClientIp() {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    /**
     * Checks if variable is a float
     * @param float $number
     * @return bool
     * */
    private function isFloat($number) {
        return !!strpos($number, '.');
    }

    /**
     * Checks order input array for validity
     * @param array $order
     * */
    private function checkOrderInput($order) {
        $errors = array();
        if (empty($order) || !is_array($order)) {
            self::onError('ip');
        }
        if (!isset($order['token'])) {
            $errors[] = self::$errors['orderInput']['token'];
        }
        if (!isset($order['orderDescription'])) {
            $errors[] = self::$errors['orderInput']['orderDescription'];
        }
        if (!isset($order['amount']) || ($order['amount'] > 0 && $this->isFloat($order['amount']))) {
            $errors[] = self::$errors['orderInput']['amount'];
        }
        if (!isset($order['currencyCode'])) {
            $errors[] = self::$errors['orderInput']['currencyCode'];
        }
        if (!isset($order['name'])) {
            $errors[] = self::$errors['orderInput']['name'];
        }
        if (!isset($order['billingAddress'])) {
            $errors[] = self::$errors['orderInput']['billingAddress'];
        }

        if (count($errors) > 0) {
            self::onError('ip', implode(', ', $errors));
        }
    }

    /**
     * Sends request to Worldpay API
     * @param string $action
     * @param string $json
     * @param bool   $expectResponse
     * @param string $method
     * @return string JSON string from Worldpay
     * */
    private function sendRequest($action, $json = FALSE, $expectResponse = FALSE, $method = 'POST') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint . $action);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);

        $arch = (bool)((1 << 32) - 1) ? 'x64' : 'x86';

        $clientUserAgent = 'os.name=' . php_uname('s') . ';os.version=' . php_uname('r') . ';os.arch=' .
            $arch . ';lang.version=' . phpversion() . ';lib.version=v1.7;' .
            'api.version=v1;lang=php;owner=worldpay';

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $this->service_key",
                "Content-Type: application/json",
                "X-wp-client-user-agent: $clientUserAgent",
                "Content-Length: " . strlen($json),
            )
        );
        // Disabling SSL used for localhost testing
        if ($this->disable_ssl === TRUE) {
            if (substr($this->service_key, 0, 1) != 'T') {
                self::onError('ssl');
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        }

        $result = curl_exec($ch);
        $info   = curl_getinfo($ch);
        $err    = curl_error($ch);
        $errno  = curl_errno($ch);
        curl_close($ch);

        // Curl error
        if ($result === FALSE) {
            if ($errno === 60) {
                self::onError('sslerror', FALSE, $errno, NULL, $err);
            } elseif ($errno === 28) {
                self::onError('timeouterror', FALSE, $errno, NULL, $err);
            } else {
                self::onError('uanv', FALSE, $errno, NULL, $err);
            }
        }

        if (substr($result, -1) != '}') {
            $result = substr($result, 0, -1);
        }

        // Decode JSON
        $response = self::handleResponse($result);

        // Check JSON has decoded correctly
        if ($expectResponse && ($response === NULL || $response === FALSE)) {
            self::onError('uanv', self::$errors['json'], 503);
        }

        // Check the status code exists
        if (isset($response["httpStatusCode"])) {

            if ($response["httpStatusCode"] != 200) {
                self::onError(
                    FALSE,
                    $response["message"],
                    $info['http_code'],
                    $response['httpStatusCode'],
                    $response['description'],
                    $response['customCode']
                );

            }

        } elseif ($expectResponse && $info['http_code'] != 200) {
            // If we expect a result and we have an error
            self::onError('uanv', self::$errors['json'], 503);

        } elseif (!$expectResponse) {

            if ($info['http_code'] != 200) {
                self::onError('apierror', $result, $info['http_code']);
            } else {
                $response = TRUE;
            }
        }

        return $response;
    }


    /**
     * Create Worldpay APM order
     * @param array $order
     * @return array Worldpay order response
     * */
    public function createApmOrder($order = array()) {

        $this->checkOrderInput($order);

        $defaults = array(
            'deliveryAddress' => NULL,
            'billingAddress'  => NULL,
            'successUrl'      => NULL,
            'pendingUrl'      => NULL,
            'failureUrl'      => NULL,
            'cancelUrl'       => NULL,
        );

        $order = array_merge($defaults, $order);

        $obj = array(
            "token"             => $order['token'],
            "orderDescription"  => $order['orderDescription'],
            "amount"            => $order['amount'],
            "currencyCode"      => $order['currencyCode'],
            "name"              => $order['name'],
            "billingAddress"    => $order['billingAddress'],
            "deliveryAddress"   => $order['deliveryAddress'],
            "customerOrderCode" => $order['customerOrderCode'],
            "successUrl"        => $order['successUrl'],
            "pendingUrl"        => $order['pendingUrl'],
            "failureUrl"        => $order['failureUrl'],
            "cancelUrl"         => $order['cancelUrl'],
        );

        if (isset($order['statementNarrative'])) {
            $obj['statementNarrative'] = $order['statementNarrative'];
        }
        if (!empty($order['settlementCurrency'])) {
            $obj['settlementCurrency'] = $order['settlementCurrency'];
        }
        if (!empty($order['customerIdentifiers'])) {
            $obj['customerIdentifiers'] = $order['customerIdentifiers'];
        }

        $json = json_encode($obj);

        $response = $this->sendRequest('orders', $json, TRUE);

        if (isset($response["orderCode"])) {
            //success
            return $response;
        } else {
            self::onError("apierror");
        }
    }


    /**
     * Create Worldpay order
     * @param array $order
     * @return array Worldpay order response
     * */
    public function createOrder($order = array()) {
        $this->checkOrderInput($order);

        $defaults = array(
            'orderType'       => 'ECOM',
            'billingAddress'  => NULL,
            'deliveryAddress' => NULL,
            'is3DSOrder'      => FALSE,
            'authoriseOnly'   => FALSE,
            'redirectURL'     => FALSE,
        );

        $order = array_merge($defaults, $order);

        $obj = array(
            "token"             => $order['token'],
            "orderDescription"  => $order['orderDescription'],
            "amount"            => $order['amount'],
            "is3DSOrder"        => ($order['is3DSOrder']) ? TRUE : FALSE,
            "currencyCode"      => $order['currencyCode'],
            "name"              => $order['name'],
            "orderType"         => (in_array($order['orderType'], $this->order_types)) ? $order['orderType'] : 'ECOM',
            "authorizeOnly"     => ($order['authoriseOnly']) ? TRUE : FALSE,
            "billingAddress"    => $order['billingAddress'],
            "deliveryAddress"   => $order['deliveryAddress'],
            "customerOrderCode" => $order['customerOrderCode'],
        );

        if ($obj['is3DSOrder']) {
            $_SESSION['worldpay_sessionid'] = uniqid();
            $obj['shopperIpAddress']        = $this->getClientIp();
            $obj['shopperSessionId']        = $_SESSION['worldpay_sessionid'];
            $obj['shopperUserAgent']        = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $obj['shopperAcceptHeader']     = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
        }

        if (isset($order['statementNarrative'])) {
            $obj['statementNarrative'] = $order['statementNarrative'];
        }
        if (!empty($order['settlementCurrency'])) {
            $obj['settlementCurrency'] = $order['settlementCurrency'];
        }
        if (!empty($order['customerIdentifiers'])) {
            $obj['customerIdentifiers'] = $order['customerIdentifiers'];
        }

        $json     = json_encode($obj);
        $response = $this->sendRequest('orders', $json, TRUE);

        if (isset($response["orderCode"])) {
            //success
            return $response;
        } else {
            self::onError("apierror");
        }
    }

    /**
     * Authorise Worldpay 3DS Order
     * @param string $orderCode
     * @param string $responseCode
     * */
    public function authorise3DSOrder($orderCode, $responseCode) {
        $json = json_encode(array(
            "threeDSResponseCode" => $responseCode,
            "shopperSessionId"    => $_SESSION['worldpay_sessionid'],
            "shopperAcceptHeader" => $_SERVER['HTTP_ACCEPT'],
            "shopperUserAgent"    => $_SERVER['HTTP_USER_AGENT'],
            "shopperIpAddress"    => $this->getClientIp(),
        ));

        return $this->sendRequest('orders/' . $orderCode, $json, TRUE, 'PUT');
    }

    /**
     * Capture Authorized Worldpay Order
     * @param string $orderCode
     * @param string $amount
     * */
    public function captureAuthorisedOrder($orderCode = FALSE, $amount = NULL) {
        if (empty($orderCode) || !is_string($orderCode)) {
            self::onError('ip', self::$errors['capture']['ordercode']);
        }

        if (!empty($amount) && is_numeric($amount)) {
            $json = json_encode(array('captureAmount' => "{$amount}"));
        } else {
            $json = FALSE;
        }

        $this->sendRequest('orders/' . $orderCode . '/capture', $json, !!$json);
    }

    /**
     * Cancel Authorized Worldpay Order
     * @param string $orderCode
     * */
    public function cancelAuthorisedOrder($orderCode = FALSE) {
        if (empty($orderCode) || !is_string($orderCode)) {
            self::onError('ip', self::$errors['capture']['ordercode']);
        }

        $this->sendRequest('orders/' . $orderCode, FALSE, FALSE, 'DELETE');
    }

    /**
     * Refund Worldpay order
     * @param bool $orderCode
     * @param null $amount
     */
    public function refundOrder($orderCode = FALSE, $amount = NULL) {
        if (empty($orderCode) || !is_string($orderCode)) {
            self::onError('ip', self::$errors['refund']['ordercode']);
        }

        if (!empty($amount) && is_numeric($amount)) {
            $json = json_encode(array('refundAmount' => "{$amount}"));
        } else {
            $json = FALSE;
        }

        $this->sendRequest('orders/' . $orderCode . '/refund', $json, FALSE);
    }

    /**
     * Get a Worldpay order
     * @param string $orderCode
     * @return array Worldpay order response
     * */
    public function getOrder($orderCode = FALSE) {
        if (empty($orderCode) || !is_string($orderCode)) {
            self::onError('ip', self::$errors['orderInput']['token']);
        }
        $response = $this->sendRequest('orders/' . $orderCode, FALSE, TRUE, 'GET');

        if (!isset($response["orderCode"])) {
            self::onError("apierror");
        }

        return $response;
    }

    /**
     * Get card details from Worldpay token
     * @param string $token
     * @return array card details
     * */
    public function getStoredCardDetails($token = FALSE) {
        if (empty($token) || !is_string($token)) {
            self::onError('ip', self::$errors['orderInput']['token']);
        }
        $response = $this->sendRequest('tokens/' . $token, FALSE, TRUE, 'GET');

        if (!isset($response['paymentMethod'])) {
            self::onError("apierror");
        }

        return $response['paymentMethod'];
    }

    /**
     * Disable SSL Check ~ Use only for testing!
     * @param bool $disable
     * */
    public function disableSSLCheck($disable = FALSE) {
        $this->disable_ssl = $disable;
    }


    /**
     * Set timeout
     * @param int $timeout
     * */
    public function setTimeout($timeout = 3) {
        $this->timeout = $timeout;
    }

    /**
     * Handle errors
     * @param        string -error_key $error
     * @param string $message
     * @param string $code
     * @param string $httpStatusCode
     * @param string $description
     * @param string $customCode
     * */
    public static function onError(
        $error = FALSE,
        $message = FALSE,
        $code = NULL,
        $httpStatusCode = NULL,
        $description = NULL,
        $customCode = NULL
    ) {

        $error_message = ($message) ? $message : '';
        if ($error) {
            $error_message = self::$errors[$error];
            if ($message) {
                $error_message .= ' - ' . $message;
            }
        }

        if (version_compare(phpversion(), '5.3.0', '>=')) {
            throw new WorldpayException(
                $error_message,
                $code,
                NULL,
                $httpStatusCode,
                $description,
                $customCode
            );
        } else {
            throw new Exception(
                $error_message,
                $code
            );
        }
    }

    /**
     * Use external library to do JSON decode
     * @param bool $external
     * */
    public function setExternalJSONDecode($external = FALSE) {
        self::$use_external_JSON = $external;
    }

    /**
     * Handle response object
     * @param string $response
     * */
    public static function handleResponse($response) {
        // Backward compatiblity for JSON
        if (!function_exists('json_encode') || !function_exists('json_decode') || self::$use_external_JSON) {
            require_once('JSON.php');
        }
        if (self::$use_external_JSON) {
            return json_decode_external($response, TRUE);
        } else {
            return json_decode($response, TRUE);
        }
    }
}
