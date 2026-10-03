<?php

    class Mahasiswa_models {
        private $dbh;

        private $stmt;

        public function __construct()
        {
            $dsn = 'mysql:host=webdev-php-mysql;dbname=webmvc';

            try{
                $this->dbh=new PDO(dsn:$dsn, username:'root', password:'root');
            }catch(PDOException $e){
                die($e-> getMessage());
            }
        }


        public function getAllMahasiswa():mixed {
            $this -> stmt = $this -> dbh -> prepare(query: 'SELECT * FROM mahasiswa');
            $this -> stmt ->execute();
            
            return $this -> stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>