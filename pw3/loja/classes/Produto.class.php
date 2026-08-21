<?php

class Produto{
    private $id_produto;
    private $nome;
    private $descricao;
    private $valor;   
    private $pdo;


    public function conecta(){
        $dns    = "mysql:dbname=loja2_db;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO1($dns,$dbUser,$dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function enviarProduto($nome, $descricao, $valor, $fotos = array()){
        #inserir produto na tabela produtos
        #===================================

        $sql = "INSERT INTO produtos SET nome_produto = :p, valor_ = :v, descricao = :d";
        $sql = $this->pdo->prepare($sql);
        $sql ->bindValue(":p", $nome);
        $sql ->bindValue(":v", $valor);
        $sql ->bindValue(":d", $descricao);       

        $sql->execute();
        $id_produto = $this->pdo->LastInsertId();

        #inserir Imagem na tabela imagens
        #====================================

        if(count ($fotos) > 0){
            for($i = 0; $i < count($fotos); $i++){
                $nome_foto = $foto[$i];
                $sql = "INSERT INTO imagens (nome_imagem, fk_id_produto) VALUES (:n, :fk)";
                $sql = $this->pdo->prepare($sql);

                $sql->bindValue(":n", $nome_foto);
                $sql->bindValue(":fk", $id_produto);
                $sql->execute();
            }
        }
    }
}



