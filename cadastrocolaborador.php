<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Colaborador</title>
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
    </style>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
</head>
<body>
<?php include_once "header.php" ?>
    <br>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Colaborador</h1></legend>
            <form action="action_colaborador.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Informe o Sobrenome">
                    <span class="msg-erro msg-sobrenome" ></span>
                </div><div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" maxlength="14" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                    <span class="msg-erro msg-cpf" ></span>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" maxlength="14" name="senha" placeholder="Informe a Senha">
                    <span class="msg-erro msg-senha"></span>
                </div>
                <div class="form-group">
                <label for="cargo">Cargo</label>
                    <select class="form-control" name="cargo" id="cargo">
                        <option value="">Selecione o Cargo</option>
                        <option value="Presidente">Presidente</option>
                        <option value="Vice Presidente">Vice Presidente</option>
                        <option value="Tesoureiro">Tesoureiro</option>
                        <option value="Secretario">Secretário</option>
                        <option value="Diretor Social">Diretor Social</option>
                        <option value="Diretor de Patrimonio">Diretor de Patrimonio</option>
                        <option value="Diretor de Promoção">Diretor de Promoção</option>
                        <option value="Diretor de Convênio">Diretor de Convênio</option>
                        <option value="Conselheiro Fiscal">Conselheiro Fiscal</option>
                        <option value="Associados">Associados</option>
                        <option value="Suplentes">Suplentes</option>
                        <option value="Visitador">Visitador</option>
                        <option value="Colaborador">Colaborador</option>
                    </select>

                    <span class="msg-erro msg-cargo"></span>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="data_nascimento" class="form-control" id="data_nascimento" maxlength="10" name="data_nascimento">
                    <span class="msg-erro msg-data"></span>
                </div>
                <div class="form-group">
                <label for="disponibilidade">Disponível?</label>
                    <select class="form-control" name="disponibilidade" id="disponibilidade">
                        <option value="">Selecione a disponibilidade</option>
                        <option value="Sim">Sim</option>
                        <option value="Nao">Não</option>
                    </select>
                    <span class="msg-erro msg-disponibilidade"></span>
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
                    <span class="msg-erro msg-celular"></span>
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
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexcolaborador.php" class="btn btn-danger pull-right">Voltar</a>
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
</body>
</html>