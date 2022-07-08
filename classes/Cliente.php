<?php

require_once 'Conexao.php';

class Cliente{

    public $id;
    public $nome;
    public $cpfcnpj;
    public $telefone;
    public $observacao;
    public $datacadastro;

    public function __construct($id = false){
        if($id){
            $this->id = $id;
            $this->carregar();
        }
    }

    public function listar()
    {
        $sql = "select * from cliente order by nome";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll();
        
    }

    public function inserir ()
    {
        $sql = "insert into cliente(nome, cpfcnpj, telefone, observacao, datacadastro) values (:nome, :cpfcnpj, :telefone, :observacao, :datacadastro)";

        $conexao = Conexao::getConexao();

        $ps = $conexao->prepare($sql);
        $ps->bindValue(':nome', $this->nome);
        $ps->bindValue(':cpfcnpj', $this->cpfcnpj);
        $ps->bindValue(':telefone', $this->telefone);
        $ps->bindValue(':observacao', $this->observacao);
        $ps->bindValue(':datacadastro', $this->datacadastro);

        $resultado = $ps->execute();
        if($resultado == 0){
            throw new Exception("Erro ao inserir registro.");
            return false;
        }
        return true;
    }

    public function carregar(){
        $sql = "select * from cliente where id = {$this->id}";
        $conexao = Conexao::getConexao(); // Os dois pontos são utilizadas caso a função seja STATIC
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        foreach($lista as $linha){
            $this->nome = $linha['nome']; 
            $this->cpfcnpj = $linha['cpfcnpj']; 
            $this->telefone = $linha['telefone'];
            $this->observacao = $linha['observacao'];
            $this->datacadastro = $linha['datacadastro'];
        }
    }

    public function atualizar(){
        $sql = "update cliente
                    set nome = '{$this->nome}',
                        cpfcnpj = '{$this->cpfcnpj}',
                        telefone = '{$this->telefone}',
                        observacao = '{$this->observacao}',
                        datacadastro = '{$this->datacadastro}'
                where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);
        header('location: cliente-listar.php'); //Redirecionamento após atualizar - após clicar no botão salvar

    }

    public function excluir(){
        $sql = "delete from cliente where id = {$this->id}";
        $conexao = Conexao::getConexao();
        $conexao->exec($sql);

        header("location: cliente-listar.php");

    }
}
