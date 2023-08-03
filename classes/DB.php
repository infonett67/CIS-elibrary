<?php

class DB{
    private $databaseHost;
    private $databaseName;
    private $databaseUsername;
    private $databasePassword;
    private $charset;


    protected function connect(){
        $this->databaseHost = 'localhost';
        $this->databaseName = 'cis_lib';
        $this->databaseUsername = 'root';
        $this->databasePassword = '';
        $this->charset = 'utf8mb4';

        $dsn = "mysql:host={$this->databaseHost};dbname={$this->databaseName}";

        try {
            $conn = new PDO($dsn,$this->databaseUsername,$this->databasePassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            echo "good to go";
        } catch (PDOException $th) {
            echo "connection failed" . $th->getMessage();
        }

    }


}
?>