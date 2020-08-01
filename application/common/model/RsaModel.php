<?php
namespace app\common\model;

/**
 * @IDE         PHPStorm
 * @Author      Richard.Ge
 * @Datetime    2018-04-11 10:21
 * @DESC
 */
class RsaModel
{
    const RSA_ALGORITHM_KEY = "RSA";
    const SIGN_ALGORITHM_KEY = "MD5withRSA";
    const RSA_PUBLIC_KEY = "RSAPublicKey";
    const RSA_PRIVATE_KEY = "RSAPrivateKey";

    const KEY_SIZE = 1024;
    const MAX_ENCRYPT_PLAIN_TEXT_LENGTH = 117;
    const MAX_DECRYPT_CIPHER_TEXT_LENGTH = 128;

    /**
     * @param $data
     * @param $publicKey
     */
    public static function encryptDataByPublicKey($content,$publicKey){
        $res = openssl_get_publickey($publicKey);
        $plainData = str_split($content, 117);
        $ret = '';
        foreach($plainData as $chunk){
            openssl_public_encrypt ($chunk, $crypted, $res);//openssl_private_decrypt($chunk,$decrypted,$p);//私钥解密
            $ret .= $crypted;
        }
        //openssl_public_encrypt ($content, $crypted, $res);
        openssl_free_key($res);
        return base64_encode($ret);
    }

    /**
     * @param $data
     * @param $privateKey
     */
    public static function encryptDataByPrivateKey($data,$privateKey){
        $p = openssl_pkey_get_private( $privateKey );
        openssl_sign ( $data, $signature, $p , OPENSSL_ALGO_MD5);
        openssl_free_key ( $p );
        return base64_encode( $signature );
    }

    /**
     * 对方公约解密
     * @param $crypted
     * @param $publicKey
     * @return mixed
     */
    public static function decryptDataByPublicKey($crypted,$publicKey){
        $p = openssl_pkey_get_public( $publicKey );
        openssl_public_decrypt( base64_decode($crypted) ,$decrypted,$p);
        openssl_free_key( $p );
        return $decrypted;
    }

    /**
     * 己方私钥解密
     * @param $crypted
     * @param $privateKey
     * @return mixed
     */
    public static function decryptDataByPrivateKey($crypted,$privateKey){
        $p = openssl_pkey_get_private( $privateKey );
        $plainData = str_split(base64_decode($crypted), 128);
        $ret = '';
        foreach($plainData as $chunk){
            $decryptionOk = openssl_private_decrypt($chunk,$decrypted,$p);//私钥解密
            if($decryptionOk === false){
                return false;
            }
            $ret .= $decrypted;
        }
        openssl_free_key( $p );
        return $ret;
    }

    /**
     * @param $data
     * @param $privateKey
     */
    public static function signDigestByPrivateKey($data = '',$privateKey){
        $p = openssl_pkey_get_private( $privateKey );
        openssl_sign ( $data, $signature, $p , OPENSSL_ALGO_MD5);
        openssl_free_key ( $p );
        return base64_encode(base64_encode($signature));
    }

    /**
     * @param $data
     * @param $publicKey
     * @param $sign
     * @return bool
     */
    public static function verifySignByPublicKey($data,$publicKey,$sign){
        $p = openssl_pkey_get_public ( $publicKey ) ;
        $verify = openssl_verify ( $data, base64_decode(base64_decode($sign)), $p , OPENSSL_ALGO_MD5);
        openssl_free_key ( $p );
        return $verify > 0;
    }

    /**
     * @param string $privateKey 私钥字符串
     * @return string 更正私钥格式
     */
    public static function privateKey($privateKey) {
        $pem = chunk_split($privateKey,64,"\n");
        $pem = "-----BEGIN RSA PRIVATE KEY-----\n".$pem."-----END RSA PRIVATE KEY-----\n";
        return $pem;
    }

    /**
     * @param string $publicKey 公钥字符串
     * @return string 更正公钥格式
     */
    public static function publicKey($publicKey) {
        $pem = chunk_split($publicKey,64,"\n");
        $pem = "-----BEGIN PUBLIC KEY-----\n".$pem."-----END PUBLIC KEY-----\n";
        return $pem;
    }

}