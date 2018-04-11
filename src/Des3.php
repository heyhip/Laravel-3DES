<?php
namespace laraveldes3;

/**
 * Class Des3
 * @package des3
 */
class Des3 {
    /**
     * @var string
     */
    var $key = 'ABCDEFGHIJKLMNOPQRSTUVWX';

    /**
     * @var string
     */
    var $iv = '12345678';

    /**
     * Des3 constructor.
     * @param string|null $key
     * @param string|null $iv
     */
    public function __construct(string $key=null, string $iv=null)
    {
        if (strlen($key) != 24){
            throw new \Exception("DES3_KEY长度错误，长度为24");
        }
        if (strlen($iv) != 8){
            throw new \Exception("DES3_IV长度错误，长度为8");
        }
        $this->key = $key;
        $this->iv = $iv;
    }

    /**
     * @param $input
     * @return string
     */
    public function encrypt($input){
        $size = @mcrypt_get_block_size(MCRYPT_3DES,MCRYPT_MODE_CBC);
        $input = $this->pkcs5_pad($input, $size);
        $key = str_pad($this->key,24,'0');
        $td = @mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        if( $this->iv == '' )
        {
            $iv = @mcrypt_create_iv (@mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        }
        else
        {
            $iv = $this->iv;
        }
        @mcrypt_generic_init($td, $key, $iv);
        $data = @mcrypt_generic($td, $input);
        @mcrypt_generic_deinit($td);
        @mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    /**
     * @param $encrypted
     * @return bool|string
     */
    function decrypt($encrypted){
        $encrypted = base64_decode($encrypted);
        $key = str_pad($this->key,24,'0');
        $td = @mcrypt_module_open(MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        if( $this->iv == '' )
        {
            $iv = @mcrypt_create_iv (@mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        }
        else
        {
            $iv = $this->iv;
        }
        $ks = @mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = @mdecrypt_generic($td, $encrypted);
        @mcrypt_generic_deinit($td);
        @mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }

    /**
     * @param $text
     * @param $blocksize
     * @return string
     */
    function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * @param $text
     * @return bool|string
     */
    function pkcs5_unpad($text){
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    /**
     * @param $data
     * @return string
     */
    function PaddingPKCS7($data) {
        $block_size = @mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC);
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char),$padding_char);
        return $data;
    }
}