<?php 
    require_once '../model/Cliente.php';
    $objCliente = new Cliente();

    if(isset($_POST['insert'])){        
        $nome  = $_POST['txtNome'];
        $idade = $_POST['txtIdade'];
        $sexo  = $_POST['txtSexo'];       
        if($objCliente->insert($nome, $idade, $sexo)){
            $objCliente->redirect('../view/cliente.php');
        }
    }

    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        if($objCliente->delete($id)){
            $objCliente->redirect('../view/cliente.php');
        }
    }
    
    if(isset($_POST['txtEditar'])){
        $id = $_POST['txtEditar'];
        $nome = $_POST['txtNome'];
        $idade = $_POST['txtIdade'];
        $sexo = $_POST['txtSexo'];
        if($objCliente->update($nome, $idade, $sexo, $id)){
            $objCliente->redirect('../view/cliente.php');
        }      
    }
?>