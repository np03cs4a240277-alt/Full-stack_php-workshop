<?php 

 $server = 'localhost';
 $username ='root';
 $password = '';
 $database = 'school_db';


 try{
      $object=[
          PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES=> false
         ];
      $pdo = new PDO("mysql:host=$server;dbname=$database;",$username, $password,$object);
      return $pdo;
 }catch(PDOException $e){
     die("Connection Failed". $e->getMessage());
 }

?>