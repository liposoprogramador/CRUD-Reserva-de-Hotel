<?php 
    require_once '../model/cliente.php';
    $objCliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Cliente</title>
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
            <a href="#" data-toggle="modal" data-target="#myModalCadastrar">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Sexo</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $sql = "SELECT * FROM cliente";
            $stmt = $objCliente->runQuery($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($rowCliente = $stmt->fetch(PDO::FETCH_ASSOC)){            
        ?>            
        <tr>
            <td><?php print $rowCliente['nome'] ?></td>
            <td><?php print $rowCliente['idade'] ?></td>
            <td><?php print $rowCliente['sexo'] ?></td>
            <td>
            <a href="#">
                <span class="glyphicon glyphicon-pencil"
                data-toggle="modal" data-target ="#myModalEditar"
                data-clienteid="<?php print $rowCliente['id']?>"
                data-clientenome="<?php print $rowCliente['nome'] ?>"
                data-clienteidade="<?php print $rowCliente['idade'] ?>">
                </span>
                </a>
            </td>
            <td>
                <a href="../control/ctr_cliente.php?delete_id=<?php print $rowCliente['id'] ?>">
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

<!-- Modal Cadastrar Cliente-->
<div id="myModalCadastrar" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header" style="background-color: black; color: white;">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Novo Cliente</h4>
    </div>
    <div class="modal-body">
        <form action="../control/ctr_cliente.php" method="POST">
            <input type="hidden" name="insert" value="1">
            <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome">
            </div>
            <div class="form-group">
            <label for="idade">Idade:</label>
            <input type="number" class="form-control" id="txtIdade" name="txtIdade">
            </div>
            <div class="form-group">
            <label for="idade">Sexo:</label>
            <select name="txtSexo" id="txtSexo" class="form-control">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
            </div>            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>      
    </div>     
    </div>

</div>
</div>
<!-- Modal FIM Cadastrar Cliente-->

<!-- Modal Editar Cliente-->
<div id="myModalEditar" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header" style="background-color: black; color: white;">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Novo Cliente</h4>
    </div>
    <div class="modal-body">
        <form action="../control/ctr_cliente.php" method="POST">
            <input type="hidden" name="txtEditar" id="recipient-id">
            <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome">
            </div>
            <div class="form-group">
            <label for="idade">Idade:</label>
            <input type="number" class="form-control" id="txtIdade" name="txtIdade">
            </div>
            <div class="form-group">
            <label for="idade">Sexo:</label>
            <select name="txtSexo" id="txtSexo" class="form-control">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
            </div>            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>      
    </div>     
    </div>
</div>
</div>
<!-- Modal FIM Editar Cliente-->

<script>
    $('#myModalEditar').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid'); 
        var recipientnome = button.data('clientenome');
        var recipientidade = button.data('clienteidade');

        var modal = $(this)
        modal.find('.modal-title').text('Editar Cliente');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#txtNome').val(recipientnome);
        modal.find('#txtIdade').val(recipientidade);
    })
</script>
</body>
</html>