<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notícia</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/custom.css">
    <style>
        .eueu{
            width: 10rem;
            height: 10rem;
            border-radius: 2rem;
            border-color: #000000;
            border-style: solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .jk{
            width: 9rem;
            height: 9rem;
            border-radius: 2rem;
        }
        .hypeople{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items:center;
        }
        #titulo-counter, #texto-counter {
            display: block;
            margin-top: 5px;
            color: #6c757d;
        }
    </style>
</head>
<body>
<?php include_once "header.php" ?>
    <br>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Notícia</h1></legend>
            <form action="action_noticia.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" maxlength="86" placeholder="Informe o Título da notícia">
                    <span class="msg-erro msg-titulo" ></span>
                    <small id="titulo-counter" class="form-text text-muted">0/86 caracteres</small>
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
                    <label for="texto">Texto</label>
                    <br>
                    <textarea name="texto" id="texto" cols="90" rows="20" maxlength="2000"></textarea>
                    <span class="msg-erro msg-texto"></span>
                    <small id="texto-counter" class="form-text text-muted">0/2000 caracteres</small>
                </div>

                <div class="form-group">
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexnoticia.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/cadastrocolaborador.js"></script>

    <!---link do js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const TituloInput = document.getElementById('titulo');
            const TituloCounter = document.getElementById('titulo-counter');
            const textoTextarea = document.getElementById('texto');
            const textoCounter = document.getElementById('texto-counter');

            TituloInput.addEventListener('input', function() {
                const currentLength = TituloInput.value.length;
                TituloCounter.textContent = `${currentLength}/86 caracteres`;
            });

            textoTextarea.addEventListener('input', function() {
                const currentLength = textoTextarea.value.length;
                textoCounter.textContent = `${currentLength}/2000 caracteres`;
            });
        });
    </script>
</body>
</html>