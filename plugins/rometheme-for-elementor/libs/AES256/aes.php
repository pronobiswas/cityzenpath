<?php

namespace Rometheme;

use RomeTheme;

if(!class_exists('RomeTheme\AES256')) {
    class AES256 {
        private $key;
        private $iv;
    
        public function __construct($key, $iv) {
            $this->key = hash('sha256', $key, true);
            $this->iv = substr(hash('sha256', $iv, true), 0, 16); // Mengambil 16 byte pertama dari hash IV
        }
    
        public function encrypt($data) {
            $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv);
            return base64_encode($encryptedData);
        }
    
        public function decrypt($data) {
            $encryptedData = base64_decode($data);
            return openssl_decrypt($encryptedData, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv);
        }
    
    }
}