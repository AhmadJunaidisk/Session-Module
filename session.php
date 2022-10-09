<?php 

class Session {

    private static $Skey = [];
    private static $SVal = [];

    public static function Buat(array $arg) {
        if(is_array($arg)) {
            foreach(array_keys($arg) as $key) {
                self::$Skey[] = $key;
            } foreach($arg as $key) {
                self::$SVal[] = $key;
            } for($i=0; $i<count(self::$Skey); $i++) {
                $_SESSION[self::$Skey[$i]] = self::$SVal[$i];
            } 
        } else {
            $_SESSION[$arg] = $arg;
        }
        return new static;
    }

    public function Encrypt() {
        for($i=0; $i < count(self::$SVal); $i++) {
            if(is_bool($_SESSION[self::$Skey[$i]])) {
                $_SESSION[self::$Skey[$i]] = self::$SVal[$i];
            } else {
                $_SESSION[self::$Skey[$i]] = md5(self::$SVal[$i]);
            }
        }
    }

}
?>
