<?php
class DB {
    public static function connect(){
        $host   = "dpg-d2hhdrjipnbc73dqvf50-a.oregon-postgres.render.com";
        $port   = "5432";
        $user   = "banco1_ezys_user";
        $pass   = "Vckemrx37TjQjFfIv4obZFGJ56aRZwKW"; // senha do Render
        $dbname = "banco1_ezys";

        try {
            $pdo = new PDO(
                "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require",
                $user,
                $pass
            );
            // Opcional: modo de erros com exceção
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }
    }
}
