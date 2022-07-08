<?php

require_once 'Conexao.php';

class ProdutoCategoria{

    public $id;
    public $nome;
    public $descricao;
    public $status;
    public $data;

    public function __construct($id = false){
        if($id){
            $this->id = $id;
            $this->carregar();
        }
    }

    public function listar()
    {
        $sql = "select * from produtocategoria order by nome";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll();
        
    }

    public function inserir ()
    {
        $sql = "insert into produtocategoria(nome) values (:nome)";

        $conexao = Conexao::getConexao();

        $ps = $conexao->prepare($sql);
        $ps->bindValue(':nome', $this->nome);

        $resultado = $ps->execute();
        if($resultado == 0){
            throw new Exception("Erro ao inserir registro.");
            return false;
        }
        return true;
    }

    public function carregar(){
        $sql = "select * from produtocategoria where id = {$this->id}";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        foreach($lista as $linha){
            $this->nome = $linha['nome']; 
        }
    }

    public function atualizar(){
        $sql = "update produtocategoria
                    set nome = '{$this->nome}'
                where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);
        header('location: produtocategoria-listar.php'); //Redirecionamento após atualizar - após clicar no botão salvar

    }

    public function excluir(){
        $sql = "delete from produtocategoria where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);

        header("location: produtocategoria-listar.php");

    }
}
