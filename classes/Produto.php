<?php

require_once 'Conexao.php';

class Produto{

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
        $sql = "select * from produto order by nome";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll();
        
    }

    public function inserir ()
    {
        $sql = "insert into produto(nome,descricao, status) values (:nome, :descricao, :status)";

        $conexao = Conexao::getConexao();

        $ps = $conexao->prepare($sql);
        $ps->bindValue(':nome', $this->nome);
        $ps->bindValue(':descricao', $this->descricao);
        $ps->bindValue(':status', $this->status);

        $resultado = $ps->execute();
        if($resultado == 0){
            throw new Exception("Erro ao inserir registro.");
            return false;
        }
        return true;

    }

    public function carregar(){
        $sql = "select * from produto where id = {$this->id}";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        foreach($lista as $linha){
            $this->nome = $linha['nome']; 
            $this->descricao = $linha['descricao']; 
            $this->status = $linha['status'];
            $this->data = $linha['data'];
        }
    }

    public function atualizar(){
        $sql = "update produto
                    set nome = '{$this->nome}',
                        descricao = '{$this->descricao}',
                        status = '{$this->status}'
                where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);
        header('location: produto-listar.php'); //Redirecionamento após atualizar - após clicar no botão salvar

    }

    public function excluir(){
        $sql = "delete from produto where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);

        header("location: produto-listar.php");

    }
}
