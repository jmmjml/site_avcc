<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php
include("bd/conexao.php")
?>

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Cadastrar Evento</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/heroes/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    #btn1 {
      background-color: #480048;
      font-weight: 600;
      border-color: #480048;
      height: 45px;
      border-radius: 5px;
      color: white;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, background-color 0.3s;
    }

    #btn1:hover {
      transform: scale(1.1);
      background-color: transparent;
      border-color: #ff8210;
      color: #ff8210;
    }

    .msg-erro {
      color: red;
    }

    .box-mensagem-crud {
      margin-top: 10px;
    }

    fieldset {
      margin: 1% auto;
    }

    table {
      margin-top: 20px;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="css/heroes.css" rel="stylesheet">
</head>

<body>
  <?php include_once "header.php" ?>



  <main>
    <br>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Cadastre um Evento</h1>
          <p class="col-lg-10 fs-5"> Traga a felicidade aos membros da associação com alguma atividade, aceitamos shows, apresentações e atividades. 
            <br>
            Após o cadastro, o evento será avaliado e aprovado pela administração, assim que possível você receberá uma mensagem com a confirmação do evento ou pedindo mais informações.
        </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form action="action_evento.php" method="post" id="form-contato" enctype='multipart/form-data' class="p-4 p-md-5 border rounded-3 bg-body-tertiary" style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" maxlength="1000" id="nomeevento" name="nomeevento" placeholder="Nome do Evento">
                <label for="floatingInput">Nome do evento</label>
                <span class="msg-erro msg-nomeevento"></span>
                <small id="nomeevento-counter" class="form-text text-muted">0/1000 caracteres</small>
              </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nometitular" name="nometitular" placeholder="Nome do Titular do evento">
              <label for="floatingInput">Nome do titular do evento</label>
              <span class="msg-erro msg-nometitular"></span>
            </div>
            <div class="form-group">
                    <label for="descricao">descrição</label>
                    <br>
                    <textarea name="descricao" id="descricao" cols="35" rows="10" maxlength="5000"></textarea>
                    <span class="msg-erro msg-descricao"></span>
                    <small id="descricao-counter" class="form-text text-muted">0/5000 caracteres</small>
                </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="data" name="data" maxlength="10" placeholder="dd/mm/aaaa">
              <label for="floatingInput">Data Prevista</label>
              <span class="msg-erro msg-data"></span>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="celular" maxlength="13" name="celular" placeholder="(99)99999-9999">
              <label for="floatingInput">Celular</label>
              <span class="msg-erro msg-celular"></span>
            </div>
            <input type="hidden" name="acao" value="incluir">
            <button id="btn1" class="w-100" type="submit">Cadastrar</button>
            <br>
            <br>
            <a href="index.php" class="btn btn-danger pull-right w-100">Voltar</a>
            <hr class="my-4">
            <small class="text-body-secondary">Clicando em cadastrar você estará concordando com os termos de uso.</small>
          </form>
        </div>

      </div>
    </div>
  </main>

  <script src="js/cadastrocolaborador.js"></script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
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