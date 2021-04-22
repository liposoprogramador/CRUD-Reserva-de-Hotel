<?php

    require_once 'db.php';

    class Funcionario{
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



        public function insert($nome, $telefone){
            try{
                $sql = "INSERT INTO funcionario(nome, telefone)
                VALUES(:nome, :telefone)";

                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome); // atribuir os valores aos parametros
                $stmt->bindparam(":telefone", $telefone);
                $stmt->execute(); //executa a instrução SQL no banco de dados
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        public function update($nome, $telefone, $id){
            try{
                $sql = "UPDATE funcionario SET
                        nome = :nome, telefone = :telefone
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":telefone", $telefone);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        } 

        public function delete($id){
            try{
                $sql = "DELETE FROM funcionario WHERE id = :id";
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