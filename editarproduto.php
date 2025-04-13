<?php include_once "header.php"?>
<?php
    require 'bd/conexao.php';

    // Recebe o id do produto via GET
    $id_produto = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_produto) && is_numeric($id_produto)):

        // Captura os dados do produto solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM produtos WHERE pro_id = :pro_id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':pro_id', $id_produto);
        $stm -> execute();
        $produto = $stm->fetch(PDO::FETCH_OBJ);       
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Produto</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <style>
        .eueu{
            height: 8rem;
            width: 8rem;
            border-radius: 9px;
        }
        img{
            height: 100%;
            width: 100%;
            border-radius: 9px;
        }
    </style>
</head>
<body>
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Produto</h1></legend>
            <?php if(empty($produto)):?>
                <h3 class="text-center text-danger">Produto não encontrado!</h3>
            <?php else: ?>
                <form action="action_produto.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$produto->pro_nome?>" placeholder="Informe o Nome">
                        <span class="msg-erro msg-nome"></span>
                    </div>

                    <div class="form-group">
                        <label for="disponibilidade">Disponibilidade</label>
                        <input type="disponibilidade" class="form-control" id="disponibilidade" name="disponibilidade" value="<?=$produto->pro_disponibilidade?>" placeholder="Informe a Disponibilidade">
                        <span class="msg-erro msg-disponibilidade"></span>
                    </div>

                    <div class="form-group">
                    <label for="tipo">Tipo de doação</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="<?=$produto->pro_tipo?>"><?=$produto->pro_tipo?></option>
                        <option value="CamisaseCamisetas">Camisas e Camisetas</option>
                        <option value="Vestidos">Vestidos</option>
                        <option value="Saias">Saias</option>
                        <option value="Calcas">Calças</option>
                        <option value="Bermudas">Bermudas</option>
                        <option value="Calcados">Calçados</option>
                        <option value="Acessorios">Acessórios</option>
                        <option value="Utensilios">Utensílios</option>
                        <option value="Movel">Móvel</option>
                    </select>
                    <span class="msg-erro msg-tipo"></span>
                </div>
                    
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="valor" class="form-control" id="valor" name="valor" value="<?=$produto->pro_valor?>" placeholder="Informe o Valor">
                        <span class="msg-erro msg-valor"></span>
                    </div>
                
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="hypeople">
                           <input type="file" class="form-control" id="foto" name="foto" placeholder="Adicione a foto">
                           <div  id="eueu"class="eueu"><img src="<?=$produto->pro_foto?>" alt="foto colaborador"></div>
                           <br>
                           <input type="checkbox" checked id="manter" name="manter"><p>Manter foto</p>
                        </div>
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$produto->pro_id?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexpro.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/cadastroproduto.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
     <!-- jquery -->
     <script
      src='https://code.jquery.com/jquery-3.2.1.slim.js'
      integrity='sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg='
      crossorigin='anonymous'
    ></script>
    <!-- Imagens aparecer -->
    <script>
    var imagem1 = document.getElementById('foto');
        function previewImage1() {
            var input = document.getElementById('foto');
            var preview = document.getElementById('eueu');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Imagem" class="jk">';
            };

            reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = '';
            }
        }

    imagem1.onchange = previewImage1
    </script>
</body>
</html>