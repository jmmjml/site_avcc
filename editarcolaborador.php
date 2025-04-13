<?php
    require 'bd/conexao.php';

    // Recebe o id do colaborador via GET
    $id_colaborador = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_colaborador) && is_numeric($id_colaborador)):

        // Captura os dados do colaborador solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM colaboradores WHERE col_id = :col_id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':col_id', $id_colaborador);
        $stm -> execute();
        $colaborador = $stm->fetch(PDO::FETCH_OBJ);       

        if(!empty($colaborador)):

            // Formata a data no formato nacional
            $array_data = explode('-', $colaborador->col_datanasc);
            $data_formatada = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
        endif;
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Colaborador</title>
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
    
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<?php include_once "header.php" ?>
<br>
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Colaborador</h1></legend>
            <?php if(empty($colaborador)):?>
                <h3 class="text-center text-danger">Colaborador não encontrado!</h3>
            <?php else: ?>
                <form action="action_colaborador.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$colaborador->col_nome?>" placeholder="Informe o Nome">
                        <span class="msg-erro msg-nome"></span>
                    </div>
                    <div class="form-group">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?=$colaborador->col_sobrenome?>" placeholder="Informe o Sobrenome">
                        <span class="msg-erro msg-sobrenome" ></span>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?=$colaborador->col_cpf?>" placeholder="Informe o CPF">
                        <span class="msg-erro msg-cpf"></span>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" maxlength="14" name="senha" value="<?=$colaborador->col_senha?>" placeholder="Informe a Senha">
                        <span class="msg-erro msg-senha"></span>
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <select class="form-control" name="cargo" id="cargo">
                            <option value="<?=$colaborador->col_cargo?>"><?=$colaborador->col_cargo?></option>
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
                        <input type="data_nascimento" class="form-control" id="data_nascimento" maxlength="10" name="data_nascimento" value="<?=$data_formatada?>">
                        <span class="msg-erro msg-data"></span>
                    </div>
                    <div class="form-group">
                        <label for="disponibilidade">Disponível?</label>
                        <select class="form-control" name="disponibilidade" id="disponibilidade">
                            <option value="<?=$colaborador->col_disponibilidade?>"><?=$colaborador->col_disponibilidade?></option>
                            <option value="Sim">Sim</option>
                            <option value="Nao">Não</option>
                        </select>
                        <span class="msg-erro msg-disponibilidade"></span>
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$colaborador->col_celular?>" placeholder="Informe o Celular">
                        <span class="msg-erro msg-celular"></span>
                    </div>
                
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="hypeople">
                           <input type="file" class="form-control" id="foto" name="foto" placeholder="Adicione a foto">
                           <div  id="eueu"class="eueu"><img src="<?=$colaborador->col_foto?>" alt="foto colaborador"></div>
                           <br>
                           <input type="checkbox" checked id="manter" name="manter"><p>Manter foto</p>
                        </div>
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$colaborador->col_id?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexcolaborador.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/cadastrocolaborador.js"></script>
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