<?php
	class Aes {
		private $privateKey = "bkhd625202f9149e";
		private $iv = "bkhd5efd3f6060e2";

		public function __construct()
		{

		}

		public function encrypt($data)
		{
			$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->privateKey, 
										$data, MCRYPT_MODE_CBC, $this->iv);  
			return base64_encode($encrypted); 
		}

		public function decrypt($data)
		{
			$encryptedData = base64_decode($data);  
			$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->privateKey, 
										$encryptedData, MCRYPT_MODE_CBC, $this->iv);  
			return $decrypted;
		}
	}
?>