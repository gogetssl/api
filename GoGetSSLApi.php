<?php

/**
 * Use any way you want. Free for all
 *
 * @version 1.1
 * */
error_reporting(E_ALL);
ini_set('display_errors', 'on');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

define('DEBUG', 'TRUE');

//define('DEBUG', 'FALSE');

class GoGetSSLApi {

    protected $apiUrl = 'https://my.gogetssl.com/api';
    protected $key;
    protected $lastStatus;
    protected $lastResponse;

    public function __construct($key = null, $apiUrl = null) {
        $this->key = isset($key) ? $key : null;
    }

    public function auth($user, $pass) {
        $response = $this->call('/auth/', array(), array(
            'user' => $user,
            'pass' => $pass
                ));

        if (!empty($response ['key'])) {
            $this->key = $response ['key'];
            return $response;
        }

        return false;
    }

    public function addSslSan($orderId, $count) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        if ($count) {
            $postData ['order_id'] = $orderId;
            $postData ['count'] = $count;
        }

        return $this->call('/orders/add_ssl_san_order/', $getData, $postData);
    }

    public function cancelSSLOrder($orderId, $reason) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }
        $postData ['order_id'] = $orderId;
        $postData ['reason'] = $reason;

        return $this->call('/orders/cancel_ssl_order/', $getData, $postData);
    }

    public function changeDcv($orderId, $data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }
        return $this->call('/orders/ssl/change_dcv/' . (int) $orderId, $getData, $data);
    }

    public function changeValidationEmail($orderId, $data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/ssl/change_validation_email/' . (int) $orderId, $getData, $data);
    }

    public function setKey($key) {
        if ($key) {
            $this->key = $key;
        }
    }

    public function setUrl($url) {
        $this->apiUrl = $url;
    }

    /*
     * Decode CSR
     */

    public function decodeCSR($csr, $brand = 1, $wildcard = 0) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        if ($csr) {
            $postData ['csr'] = $csr;
            $postData ['brand'] = $brand;
            $postData ['wildcard'] = $wildcard;
        }

        return $this->call('/tools/csr/decode/', $getData, $postData);
    }

    /*
     * Get Domain Emails List
     */

    public function getWebServers($type) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/tools/webservers/' . (int) $type, $getData);
    }
    
    public function getDomainAlternative($csr = null) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        $postData ['csr'] = $csr;

        return $this->call('/tools/domain/alternative/', $getData, $postData);
    }

    /*
     * Get Domain Emails List
     */

    public function getDomainEmails($domain) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        if ($domain) {
            $postData ['domain'] = $domain;
        }

        return $this->call('/tools/domain/emails/', $getData, $postData);
    }

    public function getDomainEmailsForGeotrust($domain) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        if ($domain) {
            $postData ['domain'] = $domain;
        }

        return $this->call('/tools/domain/emails/geotrust', $getData, $postData);
    }

    /**
     * @deprecated
     * @return mixed
     * @throws GoGetSSLAuthException
     */
    public function getAllProductPrices() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/all_prices/', $getData);
    }

    /**
     * @deprecated
     * @return mixed
     * @throws GoGetSSLAuthException
     */
    public function getAllProducts() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/', $getData);
    }
    
    public function getProduct($productId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/ssl/' . $productId, $getData);
    }
    
    public function getProducts() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/ssl/', $getData);
    }

    /**
     * @deprecated
     * @param int $productId
     * @return array
     * @throws GoGetSSLAuthException
     */
    public function getProductDetails($productId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/details/' . $productId, $getData);
    }

    /**
     * @deprecated
     * @param int $productId
     * @return array
     * @throws GoGetSSLAuthException
     */
    public function getProductPrice($productId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/price/' . $productId, $getData);
    }

    public function getUserAgreement($productId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/products/agreement/' . $productId, $getData);
    }

    public function getAccountBalance() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/balance/', $getData);
    }

    public function getAccountDetails() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/', $getData);
    }

    public function getTotalOrders() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/total_orders/', $getData);
    }

    public function getAllInvoices() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/invoices/', $getData);
    }

    public function getUnpaidInvoices() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/invoices/unpaid/', $getData);
    }

    public function getTotalTransactions() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/account/total_transactions/', $getData);
    }

    public function addSSLOrder1($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/add_ssl_order1/', $getData, $data);
    }
    
    public function addSSLOrder($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/add_ssl_order/', $getData, $data);
    }

    public function addSSLRenewOrder($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/add_ssl_renew_order/', $getData, $data);
    }

    public function reIssueOrder($orderId, $data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/ssl/reissue/' . (int) $orderId, $getData, $data);
    }

    public function activateSSLOrder($orderId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/ssl/activate/' . (int) $orderId, $getData);
    }
    
    public function addSandboxAccount($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/accounts/sandbox/add/', $getData, $data);        
    }

    public function getOrderStatus($orderId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/status/' . (int) $orderId, $getData);
    }

    public function comodoClaimFreeEV($orderId, $data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/ssl/comodo_claim_free_ev/' . (int) $orderId, $getData, $data);
    }

    public function getOrderInvoice($orderId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/invoice/' . (int) $orderId, $getData);
    }

    public function getUnpaidOrders() {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/list/unpaid/', $getData);
    }

    public function resendEmail($orderId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }
        return $this->call('/orders/ssl/resend_validation_email/' . (int) $orderId, $getData);
    }

    public function resendValidationEmail($orderId) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/orders/ssl/resend_validation_email/' . (int) $orderId, $getData);
    }

    public function getCSR($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/tools/csr/get/', $getData, $data);
    }

    public function generateCSR($data) {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        } else {
            $getData = array(
                'auth_key' => $this->key
            );
        }

        return $this->call('/tools/csr/generate/', $getData, $data);
    }

    protected function call($uri, $getData = array(), $postData = array(), $forcePost = false, $isFile = false) {        
        $url = $this->apiUrl . $uri;
        if (!empty($getData)) {
            foreach ($getData as $key => $value) {
                $url .= (strpos($url, '?') !== false ? '&' : '?') . urlencode($key) . '=' . rawurlencode($value);
            }
        }

        $post = !empty($postData) || $forcePost ? true : false;
        $c = curl_init($url);
        if ($post) {
            curl_setopt($c, CURLOPT_POST, true);
        }

        $queryData = '';
        if (!empty($postData)) {
            $queryData = $isFile ? $postData : http_build_query($postData);
            curl_setopt($c, CURLOPT_POSTFIELDS, $queryData);
        }

        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($c);

        if (DEBUG == 'TRUE') {
            echo "\n\n";
            echo "===============\n";
            echo __FILE__ . "\n";
            echo "===============\n\n";
            echo "url = " . $url . "\n\n";
            echo "queryData = " . urldecode($queryData) . "\n\n";
            echo "getData = \n";
            print_r($getData) . "\n\n";
            echo "postData = \n";
            print_r($postData) . "\n\n";
            echo "result GoGetSslApi = \n";
            print_r(json_decode($result, true));
            echo "\n\n";
        }

        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
        $this->lastStatus = $status;
        $this->lastResponse = json_decode($result, true);
        return $this->lastResponse;
    }

    public function getLastStatus() {
        return $this->lastStatus;
    }

    public function getLastResponse() {
        return $this->lastResponse;
    }

}

class GoGetSSLAuthException extends Exception {

    public function __construct() {
        parent::__construct('Please authorize first');
    }

}
