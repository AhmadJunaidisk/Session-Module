<?php 

class Session {

    private $Skey = [];
    private $SVal = [];

    function __Construct() {
        session_start();
    }

    public function Buat(array $arg) {
        if(is_array($arg)) {
            foreach(array_keys($arg) as $key) {
                $this->Skey[] = $key;
            } foreach($arg as $key) {
                $this->SVal[] = $key;
            } for($i=0; $i<count($this->Skey); $i++) {
                $_SESSION[$this->Skey[$i]] = $this->SVal[$i];
            } 
        } else {
            $_SESSION[$arg] = $arg;
        }
        return $this;
    }

    public function Cek() {
        header("Content-type: Application/json");
        if(empty($_SESSION)) {
            Err::Respon([
                "data" => [
                    "status" => 404,
                    "pesan" => "Session kosong"
                ]
            ]);
        } else {
            echo json_encode($_SESSION, JSON_PRETTY_PRINT);
        }
    }

    public function Unset(string $arg) {
        unset($_SESSION[$arg]);
    }

    public function Hapus() {
        $_SESSION = [];
        session_destroy();
    }

    public function Encrypt() {
        for($i=0; $i < count($this->SVal); $i++) {
            $_SESSION[$this->Skey[$i]] = md5($this->SVal[$i]);
        }
    }

}

class Err {

    public static function Respon(array $arg) {
        header("Content-type: Application/json");
        echo json_encode($arg, JSON_PRETTY_PRINT);
    }

}

/** 
* Membuat Session lebih dari satu
*/
(new Session)->Buat([
  "username" => "Ahmad Junaidi",
  "status" => "online"
]);

/** 
* Membuat Session lebih dari satu sekaligus terenskripsi md5
*/
(new Session)->Buat([
  "username" => "Ahmad Junaidi",
  "status" => "online"
])->Encrypt();

/** 
* Menghapus session dengan method hapus ( ini sama dengan destroy() )
*/
(new Session)->Hapus()

/** 
* Menghapus session dengan method unset ( ini sama dengan unset() )
*/
(new Session)->unset("username");

?>
