<?php

namespace App\Helpers;

class Fawry
{
    public $merchantCode;

    public $securityKey;

    public function __construct()
    {
        $this->merchantCode = config('fawry.merchant_code');

        $this->securityKey = config('fawry.security_key');
    }

    public function endpoint($uri)
    {
        return config('fawry.debug') ?
            'https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/' . $uri :
            'https://www.atfawry.com/ECommerceWeb/Fawry/' . $uri;
    }

    public function createCardToken($cardNumber, $expiryYear, $expiryMonth, $cvv, $user)
    {
        $result =  $this->post(
            $this->endpoint("cards/cardToken"), [
                "merchantCode" => $this->merchantCode,
                "customerProfileId" => md5($user->id),
                "customerMobile" => $user->phone,
                "customerEmail" => $user->email,
                "cardNumber" => $cardNumber,
                "expiryYear" => $expiryYear,
                "expiryMonth" => $expiryMonth,
                "cvv" => $cvv
            ]
        );

        return $result;
    }

    public function deleteCardToken($user, $cardToken)
    {

        $result = $this->delete(
            $this->endpoint("cards/cardToken"), [
                'merchantCode' => $this->merchantCode,
                'customerProfileId' => md5($user->id),
                'cardToken' => $cardToken, 
                'signature' => hash(
                    'sha256',
                    $this->merchantCode.
                    md5($user->id).
                    $cardToken.
                    $this->securityKey
                )
            ]
        );

        return $result;
    }

    public function listCustomerTokens($user)
    {
        $res = $this->get(
            $this->endpoint("cards/cardToken"), [
                'merchantCode' => $this->merchantCode,
                'customerProfileId' => md5($user->id),
                'signature' => hash('sha256', $this->merchantCode.md5($user->id).$this->securityKey),
            ]
        );

        if($res->statusCode == 9950)
            return [];

        return $res->cards; 
    }

    private function chargeItems($cart)
    {
        $chargeItems = [];
        foreach($cart as $product){
            $chargeItems[] = [
                "itemId" => md5(123456),
                "description" => $product->{lang('name')},
                "price" => $product->price,
                "quantity" => $product->pivot->quantity 
            ];
        }

        return $chargeItems;
    }

    public function charge($merchantRefNum, $cardToken, $user, $description = null)
    {

        $signature = hash(
            'sha256',
            $this->merchantCode.
            $merchantRefNum.
            md5($user->id).
            'CARD'.
            number_format($user->totalPrice(), 2, '.', '').
            $cardToken.
            $this->securityKey
        ); 

        return $this->post(
            $this->endpoint("payments/charge"), [
                'merchantCode' => $this->merchantCode,
                'merchantRefNum' => $merchantRefNum,
                'customerProfileId' => md5($user->id),
                'customerMobile' => $user->phone,
                'customerEmail' => $user->email,
                'paymentMethod' => 'CARD',
                'amount' => number_format($user->totalPrice(), 2, '.', ''),
                'currencyCode' => 'EGP',
                'description' => $description,
                'chargeItems' => $this->chargeItems($user->cart),
                'cardToken' => $cardToken,
                'signature' => $signature
            ]
        );
    }

    public function get($url, $data)
    {
        $params = '';
        foreach($data as $key=>$value)
            $params .= $key.'='.$value.'&';

        $params = trim($params, '&');

        $ch = curl_init($url."?".$params);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return json_decode(curl_exec($ch));
    }

    public function post($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data)))
        );

        return json_decode(curl_exec($ch));
    }

    public function delete($url, $data)
    {
        $params = '';
        foreach($data as $key=>$value)
            $params .= $key.'='.$value.'&';

        $params = trim($params, '&');

        $ch = curl_init($url."?".$params);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return json_decode(curl_exec($ch));
    }
}
