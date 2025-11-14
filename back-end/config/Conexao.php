<?php
class Conexao {
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=while_play;charset=utf8",
                    "root",
                    ""      // senha aqui
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
