<?php 
    require_once '../model/cliente.php'; 
    require_once '../model/funcionario.php';
    require_once '../model/quarto.php';
    require_once '../model/reserva.php';   
    $objCliente       = new Cliente();    
    $objQuarto        = new Quarto();
    $objFuncionario   = new Funcionario(); 
    $objView          = new Reserva();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head></head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
      require_once 'menu.php';
    ?>  
<div class="container">
  <div class="row">
        <?php 
            $query = "SELECT * FROM vw_listareserva";
            $stmt = $objView->runQuery($query);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($rowView = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php print $rowView['descricao'] ?>
                            </div>
                            <div class="panel-body">
                                <label for="">ID do Quarto</label>
                                <?php print $rowView['id_quarto'] ?>
                                <br/>
                                <label for="">Nome do Cliente</label>
                                <?php print $rowView['Nome Cliente'] ?>
                                <br/>
                                <label for="">Nome do Funcionário: </label>
                                <?php print $rowView['Nome Funcionario'] ?>
                                <br/>
                                <label for="">Data Inicial: </label>
                                <?php print $rowView['data_ini'] ?>
                                <br/>
                                <label for="">Valor do Quarto: </label>
                                <?php print $rowView['valor'] ?>
                                <br/>
                                <label for="">Total a Pagar: </label>
                                <?php print ($rowView['qtd_dias'] * $rowView['valor']) ?>
                                <br/>
                                <label for="">Quantidade de Dias: </label>
                                <?php print $rowView['qtd_dias'] ?>
                                <br/>
                            </div>
                        </div>            
                    </div>
        <?php            
                }
            }
        ?>
  </div>
</div>

<!-- Modal Cadastrar Reserva-->
<div id="myModalCadastrarReserva" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: black; color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nova Reserva</h4>
      </div>
      <div class="modal-body">
        <form action="../control/ctr_reserva.php" method="POST">
            <input type="hidden" name="insert" value="1">
            <input type="hidden" id="quarto_id" name="txtQuarto">
            <div class="form-group">
              <label for="nome">Funcionario:</label>
              <select name="txtFuncionario" id="txtFuncionario" class="form-control">
                  <?php 
                        $queryF = "SELECT * FROM funcionario";      
                        $stmtF = $objFuncionario->runQuery($queryF);
                        $stmtF->execute();
                        if($stmtF->rowCount() > 0){
                            while($rowFuncionario = $stmtF->fetch(PDO::FETCH_ASSOC)){                                
                  ?>
                                <option value="<?php print $rowFuncionario['id'] ?>"><?php print $rowFuncionario['nome'] ?></option>
                  <?php                   
                            }
                        }
                  ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nome">Cliente:</label>
              <select name="txtCliente" id="txtCliente" class="form-control">
                  <?php 
                        $queryC = "SELECT * FROM cliente";      
                        $stmtC = $objCliente->runQuery($queryC);
                        $stmtC->execute();
                        if($stmtC->rowCount() > 0){
                            while($rowCliente = $stmtC->fetch(PDO::FETCH_ASSOC)){                                
                  ?>
                                <option value="<?php print $rowCliente['id'] ?>"><?php print $rowCliente['nome'] ?></option>
                  <?php                   
                            }
                        }
                  ?>
              </select>
            </div>
            <div class="form-group">
              <label for="idade">Data inicio:</label>
              <input type="date" name="txtData_ini" id="txtData_ini" class="form-control">
            </div>            
            <div class="form-group">
              <label for="idade">Qtd Dias:</label>
              <input type="number" name="txtDias" id="txtDias" class="form-control" required>
            </div>            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>      
      </div>     
    </div>

  </div>
</div>
<!-- Modal FIM Cadastrar Reserva-->

<script>
    $('#myModalCadastrarReserva').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var recipientid = button.data('quartoid');

        var modal = $(this)
        modal.find('modal-title').text('Nova Reserva');
        modal.find('#quarto_id').val(recipientid);
    })
</script>

</body>
</html>