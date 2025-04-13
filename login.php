<?php
// Conectar ao banco de dados
require 'bd/conexao.php';
$conexao = conexao::getInstance();
$indo = true;

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $celular = (isset($_POST['celular'])) ? str_replace(array('-', ' '), '', $_POST['celular']) : '';
  $senha = $_POST["senha"];

  $conexao = conexao::getInstance();
  $sql = "SELECT col_id, col_nome, col_foto, col_cargo FROM colaboradores WHERE col_celular = '$celular' AND col_senha = '$senha'";
  $stm = $conexao->prepare($sql);
  $stm->execute();
  $colaboradores = $stm->fetchAll(PDO::FETCH_OBJ);
  // Verificar as credenciais no banco de dados
    // Armazenar um flag na sessão
  if (!empty($colaboradores)) {
    // Login bem-sucedido
    $indo = true;
    $colaborador = $colaboradores[0]; // Acessa o primeiro elemento do array
    session_start();
    $_SESSION["nome"] = $colaborador->col_nome;
    $_SESSION["foto"] = $colaborador->col_foto;
    $_SESSION["cargo"] = $colaborador->col_cargo;
    header("Location: index.php"); // Redirecionar para a página de dashboard
  } else {
    $indo = false;
  }
}
?>
<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Entrar</title>

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
  </style>


  <!-- Custom styles for this template -->
  <link href="css/heroes.css" rel="stylesheet">
</head>

<body>
  <?php include_once "header.php" ?>

  <main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Você Voltou!!</h1>
          <p class="col-lg-10 fs-5" style="text-align: justify;">Seja bem-vindo de volta! Estamos muito contentes por tê-lo conosco novamente. Ao fazer login, você se conecta diretamente com uma rede de solidariedade e esperança. Juntos, podemos fazer a diferença!</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <span id="indo"></span>
          <br><br>
          <form id="login-form" action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-body-tertiary" style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" maxlength="13" required id="celular" name="celular" placeholder="name@example.com">
              <label for="floatingInput celular">Celular</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" required id="senha" name="senha" placeholder="senha">
              <label for="floatingPassword senha">Senha</label>
            </div>
            <button id="btn1" class="w-100" type="submit">Entrar</button>
            <hr class="my-4">
            <small class="text-body-secondary">Caso você não tenha uma conta, <a href="cadastro.php" style="text-decoration: none;">Clique aqui</a> para efetuar seu cadastro. <br><br>Clicando em entrar você estará concordando com os termos de uso.</small>
          </form>
        </div>

      </div>
    </div>
  </main>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/login.js"></script>
  <script>
    var indo = <?php echo $indo ?>
    console.log(indo)
    if (!indo) {
      document.getElementById("indo").innerHTML = "Credenciais Inválidas"
      document.getElementById("indo").style.backgroundColor = ["rgba(255, 0, 0, 0.403)"]
      document.getElementById("indo").style.color = ["#000"]
      document.getElementById("indo").style.paddingLeft = ["1rem"]
      document.getElementById("indo").style.paddingRight = ["1rem"]
      document.getElementById("indo").style.paddingTop = ["1rem"]
      document.getElementById("indo").style.paddingBottom = ["1rem"]
      document.getElementById("indo").style.marginTop = ["-1rem"]
      document.getElementById("indo").style.marginBottom = ["1rem"]
      document.getElementById("indo").style.borderRadius = ["1rem"]
    }
  </script>
  <script>
    /* Função para formatar dados conforme parâmetro enviado, CPF, DATA, TELEFONE e CELULAR */
    function mascaraTexto(t, mask) {
      var i = t.value.length;
      var saida = mask.substring(1, 0);
      var texto = mask.substring(i);

      if (texto.substring(0, 1) != saida) {
        t.value += texto.substring(0, 1);
      }
    }
  </script>
</body>

</html>