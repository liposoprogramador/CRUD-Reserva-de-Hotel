<?php 
    require_once '../model/reserva.php';
    require_once '../model/quarto.php';
    $objReserva = new Reserva();
    $objQuarto  = new Quarto();

    if(isset($_POST['insert'])){
        $quarto      = $_POST['txtQuarto'];
        $funcionario = $_POST['txtFuncionario'];
        $cliente     = $_POST['txtCliente'];
        $data_ini    = $_POST['txtData_ini'];
        $dias        = $_POST['txtDias'];        
        if($objReserva->insert($funcionario, $quarto, $cliente, $data_ini, $dias)){
            $objQuarto->updateStatus('Ocupado', $quarto);
            $objReserva->redirect('../view/index.php');
        }
    }

?>