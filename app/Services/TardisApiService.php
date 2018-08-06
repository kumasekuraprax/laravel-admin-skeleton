<?php

namespace App\Services;

use SantosAlan\ApiMagic\ApiMagic;
use Illuminate\Encryption\Encrypter;

class TardisApiService extends ApiMagic
{

    protected $host = 'https://tardis.madeiramadeira.com.br';

    protected $prefix = '/api';


    public function routes()
    {
        return $this->element('rotas')->rhroutes('POST');
    }


    public static function crypt($tokenEncrypt, $request)
    {
        return self::encrypter($tokenEncrypt)
                    ->encrypt(json_encode($request));
    }

    public static function decrypt($tokenEncrypt, $response)
    {
        return json_decode(self::encrypter($tokenEncrypt)
                    ->decrypt($response));
    }

    private static function encrypter($token)
    {
        return new Encrypter(md5($token), 'AES-256-CBC');
    }



}