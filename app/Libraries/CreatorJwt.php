<?php
namespace App\Libraries;
//application/libraries/CreatorJwt.php
// require APPPATH . '/libraries/JWT.php';
use App\Libraries\JWT;
class CreatorJwt
{
    /*************This function generate token private key**************/ 
    PRIVATE $key = "1234567890qwertyuiopmnbvcxzasdfghjkl"; 
    public function GenerateToken($userId, $email, $phone)
    {
        $data      = array(
            'id'                => $userId,
            'email'             => $email,
            'phone'             => $phone,
            'exp'               => time() + (30 * 24 * 60 * 60) // 30 days
        );
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }    
   /*************This function DecodeToken token **************/
    public function DecodeToken($token)
    {          
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }
}