<?php 
    class koneksi{
        function __construct(){
            $this->db = new mysqli('localhost','root','','inventaris');
        }
        // query login
        public function login($table,$where){
            $query = $this->db->query("SELECT * FROM $table WHERE $where AND $where");
            $data = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }

        // ----------------------
        // query sql dml
        // ----------------------
        public function sum($kolom,$nama,$tabel){
            $query = $this->db->query("SELECT SUM($kolom) AS $nama FROM $tabel");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function count($nama,$tabel){
            $query = $this->db->query("SELECT COUNT(*) AS $nama FROM $tabel");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function sumPinjam($kolom,$nama,$tabel,$where){
            $query = $this->db->query("SELECT SUM($kolom) AS $nama FROM $tabel WHERE $where");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function deleteData($tabel,$where){
            $query = $this->db->query("DELETE FROM $tabel WHERE $where");
            if($query == true){
                return true;
            }else{
                return false;
            }
        }
        public function updateData($tabel,$kolom,$where){
            $query = $this->db->query("UPDATE $tabel SET $kolom WHERE $where");
            if($query == true){
                return true;
            }else{
                return false;
            }
        }
        public function insertData($tabel,$kolom,$values){
            $query = $this->db->query("INSERT INTO $tabel($kolom) VALUES($values)");
            if($query == true){
                return true;
            }else{
                return false;
            }
        }
        public function getAll($tabel){
            $query = $this->db->query("SELECT * FROM $tabel");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getId($tabel,$where){
            $query = $this->db->query("SELECT * FROM $tabel WHERE $where");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getIdPinjam($where){
            $query = $this->db->query("CALL getIdInvent($where)");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function limitBarang($mulai,$perPage){
            $query = $this->db->query("SELECT tb_inventaris.id_inventaris,tb_inventaris.nama,tb_inventaris.stok,tb_inventaris.kode_inventaris,tb_inventaris.tanggal_register,tb_inventaris.keterangan,tb_inventaris.kondisi,tb_ruang.nama_ruang,tb_jenis.nama_jenis,tb_petugas.nama_petugas FROM tb_inventaris INNER join tb_ruang on tb_ruang.id_ruang = tb_inventaris.id_ruang INNER join tb_jenis on tb_jenis.id_jenis = tb_inventaris.id_jenis INNER join tb_petugas on tb_petugas.id_petugas = tb_inventaris.id_petugas LIMIT $mulai,$perPage");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function search($where,$like){
            $query = $this->db->query("SELECT tb_inventaris.id_inventaris,tb_inventaris.nama,tb_inventaris.stok,tb_inventaris.kode_inventaris,tb_inventaris.tanggal_register,tb_inventaris.keterangan,tb_inventaris.kondisi,tb_ruang.nama_ruang,tb_jenis.nama_jenis,tb_petugas.nama_petugas FROM tb_inventaris INNER join tb_ruang on tb_ruang.id_ruang = tb_inventaris.id_ruang INNER join tb_jenis on tb_jenis.id_jenis = tb_inventaris.id_jenis INNER join tb_petugas on tb_petugas.id_petugas = tb_inventaris.id_petugas WHERE $where LIKE '%".$like."%'");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        // ----------------------
        // kumpulan sql relasi
        // ----------------------
        public function getRelasiPinjam(){
            $query = $this->db->query("SELECT tb_peminjaman.id_peminjaman,tb_pegawai.nama_petugas,tb_inventaris.nama,tb_peminjaman.tanggal_pinjam,tb_peminjaman.tanggal_kembali,tb_peminjaman.jumlah,tb_peminjaman.status_peminjaman from tb_peminjaman inner join tb_inventaris on tb_inventaris.id_inventaris = tb_peminjaman.id_inventaris inner join tb_pegawai on tb_pegawai.id_pegawai = tb_peminjaman.id_pegawai");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getRelasiBarang(){
            $query = $this->db->query("SELECT tb_inventaris.id_inventaris,tb_inventaris.nama,tb_inventaris.stok,tb_inventaris.kode_inventaris,tb_inventaris.tanggal_register,tb_inventaris.keterangan,tb_inventaris.kondisi,tb_ruang.nama_ruang,tb_jenis.nama_jenis,tb_petugas.nama_petugas FROM tb_inventaris INNER join tb_ruang on tb_ruang.id_ruang = tb_inventaris.id_ruang INNER join tb_jenis on tb_jenis.id_jenis = tb_inventaris.id_jenis INNER join tb_petugas on tb_petugas.id_petugas = tb_inventaris.id_petugas");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getRelasiLaporan($bulan){
            $tahun = date('Y');
            $query = $this->db->query("SELECT tb_pegawai.nama_petugas,tb_inventaris.nama,tb_detail_pinjam.jumlah,tb_detail_pinjam.tanggal_pinjam,tb_detail_pinjam.tanggal_kembali FROM tb_detail_pinjam RIGHT join tb_inventaris on tb_inventaris.id_inventaris = tb_detail_pinjam.id_inventaris inner join tb_pegawai on tb_pegawai.id_pegawai = tb_detail_pinjam.id_pegawai WHERE MONTH(tb_detail_pinjam.tanggal_pinjam) = $bulan AND YEAR(tb_detail_pinjam.tanggal_pinjam) = $tahun");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getRelasiAkun(){
            $query = $this->db->query("SELECT tb_petugas.id_petugas,tb_pegawai.nip,tb_petugas.nama_petugas,tb_pegawai.alamat,tb_petugas.username,tb_petugas.password,tb_level.nama_level from tb_petugas inner join tb_level on tb_level.id_level = tb_petugas.id_level inner join tb_pegawai on tb_pegawai.id_pegawai = tb_petugas.id_petugas");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
        public function getRelasiAkunId($where){
            $query = $this->db->query("SELECT tb_pegawai.nip,tb_petugas.nama_petugas,tb_pegawai.alamat,tb_petugas.username,tb_petugas.password,tb_level.nama_level from tb_petugas inner join tb_level on tb_level.id_level = tb_petugas.id_level inner join tb_pegawai on tb_pegawai.id_pegawai = tb_petugas.id_petugas WHERE $where");
            $data  = array();
            foreach($query as $x){
                $data[] = $x;
            }
            return $data;
        }
    }
?>