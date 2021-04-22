<?php 
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();

    if(isset($_POST['insert'])){        
        $nome  = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];     
        if($objFuncionario->insert($nome, $telefone)){
            $objFuncionario->redirect('../view/funcionario.php');
        }
    }

    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        if($objFuncionario->delete($id)){
            $objFuncionario->redirect('../view/funcionario.php');
        }
    }

    if(isset($_POST['txtEditar'])){
        $id = $_POST['txtEditar'];
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        if($objFuncionario->update($nome, $telefone, $id)){
            $objFuncionario->redirect('../view/funcionario.php');
        }      
    }
?>