<?php

/**
 ** ------------------------------------------------------------------------------
 ** Simple Encryption Functions - Using Mcrypt Functions in PHP
 ** ------------------------------------------------------------------------------
 ** @Author - Joseph V. Guevara Jr.
 ** @Created Since - May 24, 2006
 ** @Report Bugs - blowfish920@yahoo.com, jguevara920@hotmail.com
 **
 **DON'T UNDERSTAND THIS BUT IT LOOKS SOPHISTICATED!

class CRYPTO  {

	var $encType = MCRYPT_RIJNDAEL_256;
    var $encMode = MCRYPT_MODE_ECB;
    var $encRand = MCRYPT_RAND;

    /* Creating blocksize */
    function Size()
	{
       $iv_size = mcrypt_get_iv_size($this->encType, $this->encMode);
		return mcrypt_create_iv($iv_size, $this->encRand);
	}

    /* Converting a key to MD5 Hash - ugh! im paranoid  */
    function SecretKey($data) { return md5($data); }

    /* Converting Binary Data to Hexadecimal Data */
    function HexFromBin($data) { return bin2hex($data); }

    /* Conveting Hexadecimal Data to Binary Data */
    function BinFromHex($data) { return pack('H' . strlen($data), $data); }

    /* Encrypt the Data */
    function EncryptString($data)
	{
		$string = mcrypt_encrypt($this->encType, $this->SecretKey($data), $data, $this->encMode, $this->Size());
		return $this->HexFromBin($string);
	}

    /* Decrypt the Data */
    function DecryptString($data_enc,$data)
	{
		return trim(mcrypt_decrypt($this->encType, $this->SecretKey($data), $this->BinFromHex($data_enc), $this->encMode, $this->Size()));
	}

}

?>