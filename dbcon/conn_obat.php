<?php
    class DbConnect{
        public function DBConnect(){
			$dbhost = 'localhost'; // hostname
			$dbname = 'db_obat'; // nama database
			$dbuser = 'root'; // username mysql
            $dbpass = '';  // password mysql

			try {
				$dbConn = new PDO("mysql:host=$dbhost;dbname=$dbname", 
										$dbuser, 
										$dbpass);

				$dbConn->exec("set names utf8");
                $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return  $dbConn;
			}
			catch (PDOException $e) {
				return 'Koneksi Gagal: ' . $e->getMessage();
			}
		}
	}
	
?>

