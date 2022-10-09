Tools sederhana membuat Session di PHP Native

1.Cara Membuat Session lebih dari satu

Session::buat([
  "username" => "Ahmad Junaidi",
  "status" => "online",
  "isloggedin" => true
]);

2. Cara Membuat Session lebih dari satu ditambah method encrypt(md5)

Session::buat([
  "username" => "Ahmad Junaidi",
  "status" => "online",
  "isloggedin" => true
])->Encrypt();
