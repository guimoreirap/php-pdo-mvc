<?php
require_once 'config.php';

class Conexao
{
    public static function getConexao()
    {
        return new PDO( 
            DB_DRIVER . ":host=" .DB_HOST . ";
            dbname=" . DB_NOME, DB_USUARIO, DB_SENHA );
    }
}
