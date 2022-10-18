<?php

namespace Helper;

class Coinpayments
{
    static function deposit($req = array())
    {
        return Coinpayments::action('create_transaction', $req);
    }
    static function action($cmd, $req = array())
    {
        $public_key = CP_PUBLIC_KEY;
        $private_key = CP_PRIVATE_KEY;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json';
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        if ($data !== FALSE) {
            $dec = (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) ? json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING) : json_decode($data, TRUE);
            if ($dec !== NULL && count($dec))
                return $dec;
            return array('error' => 'Unable to parse JSON result (' . json_last_error() . ')');
        }
        return array('error' => 'cURL error: ' . curl_error($ch));
    }
    static function balances($req = array()){
        return Coinpayments::action('balances', $req);
    }
    static function rates($req = array()){
        return Coinpayments::action('rates', $req);
    }
    static function getAddress($req = array()){
        return Coinpayments::action('get_callback_address', $req);
    }
    static function sendFunds($req = array()){
        return Coinpayments::action('create_withdrawal', $req);
    }
}