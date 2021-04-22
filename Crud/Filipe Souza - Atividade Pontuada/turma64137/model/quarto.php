<?php

    require_once 'db.php';

    class Quarto{
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



        public function insert($descricao, $status, $valor){
            try{
                $sql = "INSERT INTO quarto(descricao, status, valor)
                VALUES(:descricao, :status, :valor)";

                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":descricao", $descricao); // atribuir os valores aos parametros
                $stmt->bindparam(":status", $status);
                $stmt->bindparam(":valor", $valor);
                $stmt->execute(); //executa a instrução SQL no banco de dados
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        public function update($descricao, $status, $valor, $id){
            try{
                $sql = "UPDATE quarto SET
                        descricao = :descricao, status = :status, valor = :valor
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":descricao", $descricao);
                $stmt->bindparam(":status", $status);
                $stmt->bindparam(":valor", $valor);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        } 

        public function delete($id){
            try{
                $sql = "DELETE FROM quarto WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function updateStatus($status, $id){
            try{
                $sql = "UPDATE quarto SET
                        status = :status
                        where id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":status", $status);
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