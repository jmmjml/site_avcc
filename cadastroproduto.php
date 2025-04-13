<!DOCTYPE html>
<html lang="en">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php include_once "header.php" ?>
    <br>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Produto</h1></legend>
            <form action="action_produto.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="disponibilidade">Quantidade</label>
                    <input type="text" class="form-control" id="disponibilidade" name="disponibilidade" placeholder="A disponibilidade do produto">
                    <span class="msg-erro msg-disponibilidade" ></span>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de doação</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="">Selecione o tipo de doação</option>
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
                    <label for="foto">Foto</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Adicione a foto">
                        <div  id="eueu"class="eueu"></div>
                    </div>
                    <span class="msg-erro msg-foto"></span>
                </div>

                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Informe o Valor">
                    <span class="msg-erro msg-valor" ></span>
                </div>
                <div class="form-group">
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexpro.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/cadastroproduto.js"></script>

    <!-- jquery -->
    <script
      src='https://code.jquery.com/jquery-3.2.1.slim.js'
      integrity='sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg='
      crossorigin='anonymous'
    ></script>

    <!---link do js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
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