<?php

class Db {

    private static $host = 'localhost';
    // private static $nameTampon = 'tampon';
    private static $nameTampon = 'tampon3';
    // private static $namePresta = 'prestashop';
    private static $namePresta = 'prestashop_og';
    private static $user = 'root';
    // private static $pass = 'AbpH6Mv5F6cQe';
    private static $pass = '';
    private static $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
    private static $language = 'set names utf8';

    // Connexion
    private static $pdoTampon;
    private static $pdoPresta;
    private static $pdo;

    public static function PDO_T(){
        if (self::$pdoTampon === null){
                try {
                    self::$pdoTampon = new PDO(
                        'mysql:host='.self::$host.'; dbname='. self::$nameTampon, self::$user, self::$pass, self::$options);
                        self::$pdoTampon->exec(self::$language);
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                    }
        }
        return self::$pdoTampon;
    }

    public static function PDO_P(){
        if (self::$pdoPresta === null){
                try {
                    self::$pdoPresta = new PDO(
                        'mysql:host='.self::$host. '; dbname='. self::$namePresta, self::$user, self::$pass, self::$options);
                        self::$pdoPresta->exec(self::$language);
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                    }
        }
        return self::$pdoPresta;
    } 

    public static function PdoGenerique(){
        if (self::$pdo == null){
                try {
                    
                    self::$pdo = new PDO(
                        'mysql:host='.self::$host , self::$user , self::$pass);
                    } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                    }
        }
        return self::$pdo;
    }
}