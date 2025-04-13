<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Evento</title>
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
        #nomeevento-counter, #descricao-counter {
        display: block;
        margin-top: 5px;
        color: #6c757d;
    }
    </style>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
</head>
<body>
<?php include_once "header.php" ?>
    <br>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Evento</h1></legend>
            <form action="action_evento.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nomeevento">Nome do evento</label>
                    <input type="text" class="form-control" id="nomeevento" name="nomeevento" maxlength="1000" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nomeevento" ></span>
                    <small id="nomeevento-counter" class="form-text text-muted">0/1000 caracteres</small>
                </div>
                <div class="form-group">
                    <label for="nometitular">Nome do titular do evento</label>
                    <input type="text" class="form-control" id="nometitular" name="nometitular" placeholder="Informe o Sobrenome">
                    <span class="msg-erro msg-nometitular" ></span>
                </div>
                <div class="form-group">
                    <label for="descricao">descrição</label>
                    <br>
                    <textarea name="descricao" id="descricao" cols="90" rows="20" maxlength="5000"></textarea>
                    <span class="msg-erro msg-descricao"></span>
                    <small id="descricao-counter" class="form-text text-muted">0/5000 caracteres</small>
                </div>
                
                <!-- <div class="form-group">
                <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">Selecione o Status</option>
                        <option value="aguardando">Aguardando Aceitação</option>
                        <option value="acontecera">Irá acontecer</option>
                        <option value="recusado">Recusado</option>
                        <option value="feito">Feito</option>
                        <option value="cancelado">Cancelado</option>
                    </select>

                    <span class="msg-erro msg-status"></span>
                </div> -->
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="data" class="form-control" id="data" maxlength="10" name="data">
                    <span class="msg-erro msg-data"></span>
                </div>

                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
                    <span class="msg-erro msg-celular"></span>
                </div>
                
                <div class="form-group">
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexevento.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/cadastroevento.js"></script>

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
        const nomeEventoInput = document.getElementById('nomeevento');
        const nomeEventoCounter = document.getElementById('nomeevento-counter');
        const descricaoTextarea = document.getElementById('descricao');
        const descricaoCounter = document.getElementById('descricao-counter');

        nomeEventoInput.addEventListener('input', function() {
            const currentLength = nomeEventoInput.value.length;
            nomeEventoCounter.textContent = `${currentLength}/1000 caracteres`;
        });

        descricaoTextarea.addEventListener('input', function() {
            const currentLength = descricaoTextarea.value.length;
            descricaoCounter.textContent = `${currentLength}/5000 caracteres`;
        });
    });
</script>
</body>
</html>