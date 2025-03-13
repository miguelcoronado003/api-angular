<?php
class DbConn{
    public static function connection(){
        try {
            $hostname = "localhost";
            $port = "3306";
            $database = "db";
            $username = "root";
            $password = "";
            $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>
