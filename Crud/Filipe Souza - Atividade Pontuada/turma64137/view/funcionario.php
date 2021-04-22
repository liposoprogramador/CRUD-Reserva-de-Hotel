<?php 
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Funcionário</title>
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
    <table class="table table-striped">
        <thead>
        <tr>
          <th colspan="5">
              <a href="#" data-toggle="modal" data-target="#myModalCadastrarFuncionario">
                  <span class="glyphicon glyphicon-plus"></span>
              </a>
          </th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $sql = "SELECT * FROM funcionario";
            $stmt = $objFuncionario->runQuery($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($rowFuncionario = $stmt->fetch(PDO::FETCH_ASSOC)){            
        ?>            
        <tr>
            <td><?php print $rowFuncionario['nome'] ?></td>
            <td><?php print $rowFuncionario['telefone'] ?></td>
            
            <td>
                <a href="#">
                    <span class="glyphicon glyphicon-pencil"
                        data-toggle="modal" data-target="#myModalEditarFuncionario"
                        data-funcionarioid="<?php print $rowFuncionario['id'] ?>"
                        data-funcionarionome="<?php print $rowFuncionario['nome'] ?>"
                        data-funcionariotelefone="<?php print $rowFuncionario['telefone'] ?>">
                    </span>
                </a>
            </td>
            <td>
                <a href="../control/ctr_funcionario.php?delete_id=<?php print $rowFuncionario['id']?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
            </tr>  
        <?php 
                }
            }
        ?>
        </tbody>
    </table>
</div>
</div>

<!-- Modal Cadastrar funcionario-->
<div id="myModalCadastrarFuncionario" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header" style="background-color: black; color: white;">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Novo funcionario</h4>
    </div>
    <div class="modal-body">
        <form action="../control/ctr_funcionario.php" method="POST">
            <input type="hidden" name="insert" value="1">
            <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome">
            </div>
            <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="number" class="form-control" id="txtTelefone" name="txtTelefone">
            </div>
            <div class="form-group">
            </div>            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>      
    </div>     
    </div>

</div>
</div>
<!-- Modal FIM Cadastrar Funcionario-->

<!-- Modal Editar Funcionario-->
<div id="myModalEditarFuncionario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: black; color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Novo Funcionario</h4>
      </div>
      <div class="modal-body">
        <form action="../control/ctr_funcionario.php" method="POST">
            <input type="hidden" name="txtEditar" id="recipient-id">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="txtNome" name="txtNome">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="number" class="form-control" id="txtTelefone" name="txtTelefone">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>      
      </div>     
    </div>

  </div>
</div>
<!-- Modal FIM Editar Funcionario-->

<script>
  $('#myModalEditarFuncionario').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var recipientid = button.data('funcionarioid'); 
        var recipientnome = button.data('funcionarionome');
        var recipienttelefone = button.data('funcionariotelefone');

        var modal = $(this)
        modal.find('.modal-title').text('Editar Funcionario');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#txtNome').val(recipientnome);
        modal.find('#txtTelefone').val(recipienttelefone);

  })
</script>


</body>
</html>