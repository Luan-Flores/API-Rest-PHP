<?php
class DB {
    public static function connect(){
        $host='';
        $user='root';
        $pass='';
        $base='api';

        return new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);
    }
}