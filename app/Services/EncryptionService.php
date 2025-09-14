<?php

namespace App\Services;

use Exception;

class EncryptionService
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc";
    private $CIPHER_KEY_LEN = 16;

    /**
     * Decrypt AES-GCM encrypted data from JavaScript
     */
    public function decryptAesGcm($passphrase, $jsonString): string
    {
        $json = json_decode($jsonString, true);

        if (!isset($json['ct'], $json['iv'], $json['s'])) {
            throw new Exception("Invalid encrypted payload");
        }

        // Decode base64 data
        $cipherTag = base64_decode($json['ct']);
        $iv = base64_decode($json['iv']);
        $salt = base64_decode($json['s']);

        // Extract tag and ciphertext
        $tag = substr($cipherTag, -16);
        $ciphertext = substr($cipherTag, 0, -16);

        // Derive key using PBKDF2
        $key = hash_pbkdf2("sha256", $passphrase, $salt, 100000, 32, true);

        // Decrypt using AES-256-GCM
        $plaintext = openssl_decrypt(
            $ciphertext,
            'aes-256-gcm',
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        if ($plaintext === false) {
            throw new Exception("Decryption failed or data tampered");
        }

        return $plaintext;
    }

    /**
     * Decrypt CryptoJS AES encrypted data
     */
    public function cryptoJsAesDecrypt($passphrase, $jsonString): array
    {
        $jsondata = json_decode($jsonString, true);

        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase . $salt;
        
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        
        return json_decode($data, true);
    }

    /**
     * Encrypt data using AES-128-CBC
     */
    public function encrypt($key, $iv, $data): string
    {
        // Ensure key is correct length
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad($key, $this->CIPHER_KEY_LEN, "0");
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($key, 0, $this->CIPHER_KEY_LEN);
        }

        $encryptedData = openssl_encrypt(
            $data, 
            $this->OPENSSL_CIPHER_NAME, 
            $key, 
            OPENSSL_RAW_DATA, 
            $iv
        );

        return base64_encode($encryptedData);
    }

    /**
     * Decrypt data using AES-128-CBC
     */
    public function decrypt($key, $iv, $data): string
    {
        // Ensure key is correct length
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad($key, $this->CIPHER_KEY_LEN, "0");
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($key, 0, $this->CIPHER_KEY_LEN);
        }

        $decryptedData = openssl_decrypt(
            base64_decode($data), 
            $this->OPENSSL_CIPHER_NAME, 
            $key, 
            OPENSSL_RAW_DATA, 
            $iv
        );

        return $decryptedData;
    }

    /**
     * Generate secure random string
     */
    public function generateSecureRandom($length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Hash password securely
     */
    public function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    /**
     * Verify password hash
     */
    public function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}