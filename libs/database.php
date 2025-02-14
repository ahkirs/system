<?php

class Database{
    private $conexion;
    private $driver;
    private $port;
    private $host;
    private $user;
    private $pass;
    private $db;
    private $charset;

    public function __construct(){
        $this->driver = 'mysql';
        $this->host = 'localhost';
        $this->port = '3306';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'luncheria_db';
        $this->charset = 'utf8_spanish_ci';

    }

    public function conectar(){

      $DRIVER = $this->driver;
      $PORT = $this->port;
      $HOST= $this->host;
      $USER= $this->user;
      $PASS= $this->pass;
      $DB= $this->db;
      $CHARSET = $this->charset;

      $sql_mode= "SET @@global.sql_mode := replace(@@global.sql_mode, 'ONLY_FULL_GROUP_BY', '')";
      $time_names = "SET lc_time_names = 'es_VE'";
      $set_names = "SET NAMES 'UTF8'";
      try{
        $this->conexion = new PDO("{$DRIVER}:host={$HOST}:{$PORT};dbname={$DB};{$CHARSET}",
                                        "{$USER}","{$PASS}");
        $this->conexion->exec($sql_mode);
        $this->conexion->exec($time_names);
        $this->conexion->exec($set_names);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              
        return $this->conexion;

      }catch(PDOException $e){
        echo 'PDO exception thrown: '.$e->getMessage();

      }
      
    }
}

?>