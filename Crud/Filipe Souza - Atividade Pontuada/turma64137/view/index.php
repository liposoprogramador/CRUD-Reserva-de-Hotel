<!-- Equipe: Filipe Souza e Kaled Barreto -->
<?php 
    require_once '../model/cliente.php'; 
    require_once '../model/funcionario.php';
    require_once '../model/quarto.php';   
    $objCliente       = new Cliente();    
    $objQuarto        = new Quarto();
    $objFuncionario   = new Funcionario(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
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

<div class="jumbotron text-center">
    <h1>Chernotel</h1>
    <p>Atividade Pontuada - Filipe Souza Alves e Kaled Freire Barreto</p>
</div>

<div class="container">
  <div class="row">
        <?php 
            $query = "SELECT * FROM quarto WHERE status = 'Livre'";
            $stmt = $objQuarto->runQuery($query);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($rowQuarto = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php print $rowQuarto['descricao'] ?>
                            </div>
                            <div class="panel-body">
                                <label for="">Status do Quarto: </label>
                                <?php print $rowQuarto['status'] ?>
                                <br/>
                                <label for="">Valor do Quarto: </label>
                                <?php print $rowQuarto['valor'] ?>
                                <br/>
                                <label for="">Número do Quarto</label>
                                <?php print $rowQuarto['id'] ?>
                                <br/>
                                <button 
                                    class="btn btn-primary" type="button"
                                    data-toggle="modal" data-target="#myModalCadastrarReserva"
                                    data-quartoid="<?php print $rowQuarto['id'] ?>">
                                    Reserva
                                </button>
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