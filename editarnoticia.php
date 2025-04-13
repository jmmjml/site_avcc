<?php
    require 'bd/conexao.php';

    // Recebe o id do noticia via GET
    $id_noticia = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_noticia) && is_numeric($id_noticia)):

        // Captura os dados do noticia solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM artigos WHERE id = :id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':id', $id_noticia);
        $stm -> execute();
        $noticia = $stm->fetch(PDO::FETCH_OBJ);       
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Notícia</title>
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
    <?php include_once "header.php" ?>
    <br>
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Notícia</h1></legend>
            <?php if(empty($noticia)):?>
                <h3 class="text-center text-danger">Notícia não encontrada!</h3>
            <?php else: ?>
                <form action="action_noticia.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?=$noticia->art_titulo?>" placeholder="Informe o Titulo">
                        <span class="msg-erro msg-titulo"></span>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="hypeople">
                           <input type="file" class="form-control" id="foto" name="foto" placeholder="Adicione a foto">
                           <div  id="eueu"class="eueu"><img src="<?=$noticia->art_foto?>" alt="foto noticia"></div>
                           <br>
                           <input type="checkbox" checked id="manter" name="manter"><p>Manter foto</p>
                        </div>
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    <div class="form-group">
                    <label for="texto">Texto</label>
                    <br>
                    <textarea name="texto" id="texto" cols="90" rows="20" maxlength="5000" ><?=$noticia->art_texto?></textarea>
                    <span class="msg-erro msg-texto"></span>
                </div>
                    
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$noticia->id?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexnoticia.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/cadastronoticia.js"></script>
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