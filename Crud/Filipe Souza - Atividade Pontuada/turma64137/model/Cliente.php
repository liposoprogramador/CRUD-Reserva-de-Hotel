<?php

    require_once 'db.php';

    class Cliente{
        private $conn;

        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runQuery($sql){ //preparar o sql pra ser usado/executado
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }



        public function insert($nome, $idade, $sexo){
            try{
                $sql = "INSERT INTO cliente(nome, idade, sexo)
                VALUES(:nome, :idade, :sexo)";

                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome); // atribuir os valores aos parametros
                $stmt->bindparam(":idade", $idade);
                $stmt->bindparam(":sexo", $sexo);
                $stmt->execute(); //executa a instrução SQL no banco de dados
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($nome, $idade, $sexo, $id){
            try{
                $sql = "UPDATE cliente SET
                        nome = :nome, idade = :idade, sexo = :sexo
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":idade", $idade);
                $stmt->bindparam(":sexo", $sexo);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }                
        public function delete($id){
            try{
                $sql = "DELETE FROM cliente WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        

        public function redirect($url){
            header("Location: $url");
        }
    }
    

?> 