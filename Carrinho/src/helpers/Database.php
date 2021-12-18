<?php

namespace src\helpers;

use Exception;
use PDO;
use PDOException;

class Database{

       private static $ligacao;

    // ============================================================
    private static function ligar(){
        // ligar à base de dados
        self::$ligacao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // debug
        self::$ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // ============================================================
    private static function desligar(){
        // desliga-se da base de dados
        self::$ligacao = null;
    }

    // ============================================================
    // CRUD
    // ============================================================
    public static function select($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução SELECT
        if(!preg_match("/^SELECT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução SELECT.');
        }

        // liga
         self::ligar();

        $resultados = null;

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = self::$ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $executar = self::$ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        self::desligar();

        // devolve os resultados obtidos
        return $resultados;
    }

    // ============================================================
    public static function insert($sql, $parametros =null){

        $sql = trim($sql);

        // verifica se é uma instrução INSERT
        if(!preg_match("/^INSERT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução INSERT.');
        }

        // liga
        self::ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = self::$ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = self::$ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        self::desligar();
    }

    // ============================================================
    public static function update($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução UPDATE
        if(!preg_match("/^UPDATE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução UPDATE.');
        }

        // liga
        self::ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = self::$ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = self::$ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        self::desligar();
    }

    // ============================================================
    public static function delete($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução DELETE
        if(!preg_match("/^DELETE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução DELETE.');
        }

        // liga
        self::ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = self::$ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = self::$ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        self::desligar();
    }
}