<?php
    
class Connection{

    /*
     * Variáveis responsáveis por controlar as propriedades,
     * Parâmetros do banco de dados
     */
    
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $bd = "tcc_web";

    /*
     * Variável utilizada para armazenar a variável de conexão com o  * banco de dados;
     */
    private static $conn;

    /*
     *
     */
    public static function getConexao(){
        if(!isset(self::$conn)){
            self::$conn = new PDO("mysql:host=" . self::$host.";dbname=".self::$bd,self::$user,self::$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }   
        
        return self::$conn;
    }
}

?>