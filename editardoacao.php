<?php
    require 'bd/conexao.php';

    // Recebe o id do doação via GET
    $id_doacao = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_doacao) && is_numeric($id_doacao)):

        // Captura os dados do doação solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM doacoes WHERE doa_id = :doa_id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':doa_id', $id_doacao);
        $stm -> execute();
        $doacao = $stm->fetch(PDO::FETCH_OBJ);
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Doação</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<?php include_once "header.php"?>
<br>
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Doação</h1></legend>
            <?php if(empty($doacao)):?>
                <h3 class="text-center text-danger">Doação não encontrado!</h3>
            <?php else: ?>
                <form action="action_doacao.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$doacao->doa_nome?>" placeholder="Informe o Nome">
                        <span class="msg-erro msg-nome"></span>
                    </div>

                    <div class="form-group">
                        <label for="nomedoador">Nome do Doador</label>
                        <input type="text" class="form-control" id="nomedoador" name="nomedoador" value="<?=$doacao->doa_nomedoador?>" placeholder="Informe o Nome do Doador">
                        <span class="msg-erro msg-nome"></span>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de doação</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="<?=$doacao->doa_tipo?>"><?=$doacao->doa_tipo?></option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="produto">Produto</option>
                        </select>
                        <span class="msg-erro msg-tipo"></span>
                    </div>
                    
                <div class="form-group" id="tipovalor">
                    <label for="valor">Valor</label>
                    <input type="number" class="form-control" id="valor" name="valor" value="<?=$doacao->doa_valor?>" placeholder="Informe o Valor">
                    <span class="msg-erro msg-valor" ></span>
                </div>
                
                    
                    
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$doacao->doa_id?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexdoa.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/cadastrodoacao.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/ajax.js"></script>
    <script>
        $(document).ready(function() {
            $('#tipovalor').hide(); // Oculta o input inicialmente

            $('#tipo').change(function() {
                if ($(this).val() == 'dinheiro') {
                    $('#tipovalor').show(); // Mostra o input quando a opção 2 for selecionada
                } else {
                    $('#tipovalor').hide(); // Oculta o input para outras opções
                }
            });
        });
    </script>
    <!-- jquery -->
    <script
      src='https://code.jquery.com/jquery-3.2.1.slim.js'
      integrity='sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg='
      crossorigin='anonymous'
    ></script>
</body>
</html>