<?php

class JwtToken
{
    private static $secret_key = 'doctor_phone_secret_key_2024';
    
    public static function encode($payload)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload);
        
        $base64UrlHeader = self::base64UrlEncode($header);
        $base64UrlPayload = self::base64UrlEncode($payload);
        
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret_key, true);
        $base64UrlSignature = self::base64UrlEncode($signature);
        
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
    
    public static function decode($token)
    {
        $tokenParts = explode('.', $token);
        
        if (count($tokenParts) !== 3) {
            return null;
        }
        
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signatureProvided = $tokenParts[2];
        
        $base64UrlHeader = self::base64UrlEncode($header);
        $base64UrlPayload = self::base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret_key, true);
        $base64UrlSignature = self::base64UrlEncode($signature);
        
        if ($base64UrlSignature !== $signatureProvided) {
            return null;
        }
        
        return json_decode($payload, true);
    }
    
    private static function base64UrlEncode($text)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
    }
}
