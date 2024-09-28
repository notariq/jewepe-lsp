<?php
// membuat class dengan nama database
class database
{
    var $host = 'localhost';
    var $username = "root";
    var $password = "";
    var $database = "db_lsp_emading";
    var $koneksi = "";


    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database Gagal : " . mysqli_connect_error();
        }
    }


    //Get Data tb_users
    public function get_data_users($username)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_user WHERE username ='$username'");


        return $data;
    }
}
