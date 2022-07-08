<?php

require_once 'Conexao.php';

class Usuario{

    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct($id = false){
        if($id){
            $this->id = $id;
            $this->carregar();
        }
    }

    public function listar()
    {
        $sql = "select * from usuario order by id";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll();
        
    }

    public function inserir ()
    {
        $sql = "insert into usuario(nome, email, senha) values (:nome, :email, :senha)";

        $conexao = Conexao::getConexao();

        $ps = $conexao->prepare($sql);
        $ps->bindValue(':nome', $this->nome);
        $ps->bindValue(':email', $this->email);
        $ps->bindValue(':senha', $this->senha);

        $resultado = $ps->execute();
        if($resultado == 0){
            throw new Exception("Erro ao inserir registro.");
            return false;
        }
        return true;
    }

    public function carregar(){
        $sql = "select * from usuario where id = {$this->id}";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        foreach($lista as $linha){
            $this->nome = $linha['nome']; 
            $this->email = $linha['email']; 
            $this->senha = $linha['senha'];
        }
    }

    public function atualizar(){
        $sql = "update usuario
                    set nome = '{$this->nome}',
                        email = '{$this->email}',
                        senha = '{$this->senha}'
                where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);
        header('location: usuario-listar.php'); //Redirecionamento após atualizar - após clicar no botão salvar

    }

    public function excluir(){
        $sql = "delete from usuario where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);

        header("location: usuario-listar.php");

    }
}
