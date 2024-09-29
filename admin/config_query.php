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
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_users WHERE username ='$username'");
        return $data;
    }

    public function tampil_data_landing()
    {
        $hasil = array();

        $data = mysqli_query($this->koneksi, "SELECT id_artikel, header, judul_artikel, isi_artikel, status_publish, tba.created_at, tba.update_at, name, tba.id_users FROM tb_artikel tba JOIN tb_users tbu ON tba.id_users = tbu.id_users WHERE status_publish = 'publish'");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }

        return $hasil;
    }

    public function tampil_data()
    {
        $hasil = array();

        $data = mysqli_query($this->koneksi, "SELECT id_artikel, header, judul_artikel, isi_artikel, status_publish, tba.created_at, tba.update_at, name, tba.id_users FROM tb_artikel tba JOIN tb_users tbu ON tba.id_users = tbu.id_users");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }

        return $hasil;
    }

    public function tambah_data($header, $judul_artikel, $isi_artikel, $status_publish, $id_users) {
        $datetime = date("Y-m-d H:i:s");

        $insert = mysqli_query($this->koneksi, "INSERT INTO tb_artikel (header, judul_artikel, isi_artikel, status_publish, id_users, created_at) VALUES ('$header', '$judul_artikel', '$isi_artikel', '$status_publish', '$id_users', '$datetime')") or die(mysqli_error($this->koneksi));

        return $insert;
    }

    //Function mengambil data berdasarkan id artikel
    public function get_by_id($id_artikel)
    {
        $query = mysqli_query($this->koneksi, "SELECT id_artikel, header, judul_artikel, isi_artikel, status_publish, tba.created_at,
            tba.update_at, name, tba.id_users FROM tb_artikel tba join tb_users tbu on tba.id_users = tbu.id_users
            where id_artikel = '$id_artikel' ") or die(mysqli_error($this->koneksi));
        return $query->fetch_array();
    }

    //Function Edit Data
    public function update_data($header, $judul_artikel, $isi_artikel, $status_publish, $id_artikel, $id_users)
    {
        $datetime = date("Y-m-d H:i:s");
        if ($header == 'not_set') {
            $query = mysqli_query($this->koneksi, "UPDATE tb_artikel set judul_artikel = '$judul_artikel', isi_artikel ='$isi_artikel',
            status_publish = '$status_publish', id_users = '$id_users', update_at = '$datetime' where id_artikel ='$id_artikel'") or
                die(mysqli_error($this->koneksi));
            return $query;
        } else {
            $query = mysqli_query($this->koneksi, "UPDATE tb_artikel set header = '$header', judul_artikel = '$judul_artikel',
            isi_artikel ='$isi_artikel',status_publish = '$status_publish', id_users = '$id_users', update_at = '$datetime'
            where id_artikel ='$id_artikel'") or die(mysqli_error($this->koneksi));
            return $query;
        }
    }

    public function delete_data($id_artikel) {
        $query = mysqli_query($this->koneksi, "DELETE FROM tb_artikel WHERE id_artikel = '$id_artikel'") or die(mysqli_error($this->koneksi));
        return $query;
    }
}