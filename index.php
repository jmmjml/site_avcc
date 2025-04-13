<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

  $conexao = conexao::getInstance();
  $sql = 'SELECT id, art_foto, art_titulo, art_texto, art_datapost FROM artigos order by art_titulo';
  $stm = $conexao->prepare($sql);
  $stm->execute();
  $noticias = $stm->fetchAll(PDO::FETCH_OBJ);

else:

  //Executa uma consulta baseada no termo de pesquisa passado como parametro
  $conexao = conexao::getInstance();
  $sql = 'SELECT id, art_foto, art_titulo, art_texto, art_datapost FROM artigos WHERE art_titulo LiKE :art_titulo';
  $stm = $conexao->prepare($sql);
  $stm->bindValue(':art_titulo', $termo . '%');
  $stm->execute();
  $noticias = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
// $conexao = conexao::getInstance();
// $sql = 'SELECT MAX(id) AS maior_id FROM artigos';
// $stmt = $conexao->prepare($sql);
// $stmt->execute();
// $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($resultado) {
//     $maior_id = $resultado['maior_id'];
//     echo "O maior ID é: " . $maior_id;
// } else {
//     echo "Não foram encontrados registros.";
// }
?>
<?php include_once "header.php" ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">


<head>
  <script src="../assets/js/color-modes.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>AVCC</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/carousel.css" rel="stylesheet">
  <link href="headers.css" rel="stylesheet">
  <link rel="stylesheet" href="features.css">
  <link rel="stylesheet" href="css/features.css">
  <style>
    .banner {
      background-color: #480048;
      padding: 40px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-top: 50px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .card {
      background-color: #f8f9fa;
      border: none;
      padding: 30px;
      margin-top: 50px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .card h2 {
      font-size: 48px;
      color: #480048;
      font-weight: bold;

    }

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

    header {
      background-color: #480048;
    }

    .nav-item {
      position: relative;
    }

    .nav-link {
      display: block;
      color: #000;
      text-decoration: none;
      padding: 10px 15px;
      transition: background-color 0.3s ease;
    }

    .nav-link:hover {
      background-color: #ddd;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #f8f9fa;
      list-style: none;
      padding: 0;
      margin: 0;
      min-width: 160px;
      border: 1px solid #ddd;
      border-radius: 4px;
      opacity: 0;
      transition: opacity 0.3s ease, transform 0.3s ease;
      transform: translateY(-10px);
    }

    nav {
      position: relative;
      z-index: 10;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .nav-item:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }

    .dropdown-item {
      padding: 10px 15px;
      text-decoration: none;
      color: #000;
      display: block;
      transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
      background-color: #ddd;
    }

    .featurette {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      background-color: #f7f7f7;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 1100px;
      margin: 0 auto;
    }

    .featurette-image {
      margin: 0 auto;
    }

    .featurette-heading,
    .lead {
      text-align: left;
    }

    .bd-placeholder-img {
      transition: transform 0.3s ease-in-out;
    }

    .bd-placeholder-img:hover {
      transform: scale(1.1);
    }

    .hidden {
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.5s ease-in-out;
    }

    .aparece {
      opacity: 1;
      transform: translateY(0);
      transition: all 0.5s ease-in-out;
    }

    .btn-purple {
      background-color: #600160;
      /* Cor de fundo roxa */
      border-color: #600160;
      /* Cor de borda roxa */
      color: #fff;
      /* Cor de texto branca */
      padding: 10px 30px;
      /* Espaçamento interno */
      font-size: 18px;
      /* Tamanho da fonte */
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-purplee {
      background-color: #f7f7f7;
      border-color: #600160;
      color: #480048;
      /* Cor de texto branca */
      padding: 10px 30px;
      /* Espaçamento interno */
      font-size: 18px;
      /* Tamanho da fonte */
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-purplee:hover {
      background-color: #480048;
      /* Cor de fundo roxa escura ao passar o mouse */
      border-color: #480048;
      /* Cor de borda roxa escura ao passar o mouse */
      color: #fff;
    }

    .btn-purple:hover {
      background-color: #480048;
      /* Cor de fundo roxa escura ao passar o mouse */
      border-color: #480048;
      /* Cor de borda roxa escura ao passar o mouse */
      color: #fff;
    }

    .btn-purple span {
      margin-right: 10px;
      /* Espaçamento entre o texto e o ícone */
    }

    .btn-purple i {
      font-size: 18px;
      /* Tamanho do ícone */
      vertical-align: middle;
      /* Alinhamento vertical do ícone */
    }


    .animate-logo {
      animation: logo-animation 2s ease-in-out infinite;
    }

    .feature-icon-small {
      width: 3rem;
      height: 3rem;
    }
      .carousel-item img {
    width: 100%; /* Garantir que a largura da imagem ocupe 100% */
    height: 100%; /* Altura automática para manter a proporção */
    object-fit: cover; /* Ajustar a imagem para cobrir o espaço, mantendo a proporção */
  }

  @media (max-width: 768px) {
    .carousel-item img {
      /* Se necessário, defina uma altura mínima para telas menores */
      min-height: 300px; /* Ajuste o valor conforme necessário */
    }
    .carousel-item img {
    display: none; /* Oculta a imagem original */
  }

  .carousel-item {
    background-size: cover;
    background-position: center;
  }

  /* Imagem padrão (desktop) */
  .carousel-item:nth-child(1) {
    background-image: url('img/banner.png');
  }

  .carousel-item:nth-child(2) {
    background-image: url('img/banner2.png');
  }

  .carousel-item:nth-child(3) {
    background-image: url('img/banner3.png');
  }

  /* Imagem para telas menores que 768px */
  @media (max-width: 768px) {
    .carousel-item:nth-child(1) {
      background-image: url('img/banner-mobile.png'); /* Nova imagem para tela pequena */
    }

    .carousel-item:nth-child(2) {
      background-image: url('img/banner2-mobile.png'); /* Nova imagem para tela pequena */
    }

    .carousel-item:nth-child(3) {
      background-image: url('img/banner3-mobile.png'); /* Nova imagem para tela pequena */
    }


  }
  }
  </style>
  <script>
  // Função para trocar as imagens do carrossel dependendo da largura da tela
  function trocarImagens() {
    var larguraTela = window.innerWidth;
    
    // Identificar os slides do carrossel
    var itensCarrossel = document.querySelectorAll('.carousel-item');
    
    // Imagens para telas maiores que 768px
    var imagensDesktop = ['img/banner.png', 'img/banner2.png', 'img/banner3.png'];
    // Imagens para telas menores que 768px
    var imagensMobile = ['img/banner-mobile.png', 'img/banner2-mobile.png', 'img/banner3-mobile.png'];
    
    // Se a largura for maior que 768px, usa as imagens para desktop
    var imagensParaUsar = (larguraTela > 768) ? imagensDesktop : imagensMobile;

    // Aplicar a imagem de fundo para cada item do carrossel
    for (var i = 0; i < itensCarrossel.length; i++) {
      itensCarrossel[i].style.backgroundImage = 'url(' + imagensParaUsar[i] + ')';
      itensCarrossel[i].style.backgroundSize = 'cover';
      itensCarrossel[i].style.backgroundPosition = 'center';
    }
  }

  // Chama a função ao carregar a página
  window.onload = trocarImagens;

  // Chama a função ao redimensionar a janela
  window.onresize = trocarImagens;
</script>
  <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
</head>

<body style="background-color: #f7f9f9;">


  <main>

<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- Imagem de fundo será definida pelo JavaScript -->
    </div>
    <div class="carousel-item">
      <!-- Imagem de fundo será definida pelo JavaScript -->
    </div>
    <div class="carousel-item">
      <!-- Imagem de fundo será definida pelo JavaScript -->
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>


    <div class="container marketing">

      <div class="container">
        <h1 class="titulos hidden">Sobre nós</h1>

        <div class="box hidden"> </div>
      </div>
      <div class="row">
        <div class="col-lg-4 hidden">

        </div>
      </div>

      <div class="row">
  <div class="col-md-12">
    <div class="featurette hidden">
      <div class="col-md-6" style="margin-right: 20px;">
        <h2 class="featurette-heading fw-normal lh-1" style="margin-top: 20px; font-family: Libre Franklin, sans-serif;">
          Associação Venceslauense de Combate ao Câncer
        </h2>
        <p class="lead" style="margin-top: 10px; text-align: justify;">
          Olá! Somos a Associação Venceslauense de Combate ao Câncer, uma organização sem fins lucrativos dedicada a apoiar indivíduos e famílias afetadas pelo câncer. Nossa missão é fornecer recursos, assistência e solidariedade para ajudar nossos membros a enfrentar o diagnóstico e tratamento do câncer com dignidade e esperança.
        </p>
        <a href="quemsomos.php" style="text-decoration: none;">
          <button class="btn btn-lg btn-purple">
            <span>Saiba Mais</span>
            <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </button>
        </a>
      </div>
      <div class="col-md-4 d-none d-md-block">
        <img src="img/fachadaavcc.jpg" alt="" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 400x400" preserveAspectRatio="xMidYMid slice" focusable="false" style="border-radius: 15px;">
      </div>
    </div>
  </div>
</div>

      <div class="container px-4 py-5" id="custom-cards">
        <div class="container">
          <h1 class="titulos">Mantenha-se informado</h1>

          <div class="box2"> </div>
        </div>
        <div class="row">
          <div class="col-lg-4">

          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <a href="novembroazul.php" style="text-decoration:none; color: black">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

              <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0">Novembro Azul: Uma Campanha pela Saúde Masculina</h3>
                <div class="mb-1 text-body-secondary">27/09/2024</div>
                <p class="card-text mb-auto">A saúde do homem é um tema que deve ser abordado com seriedade.</p>
                <a href="novembroazul.php" class="icon-link gap-1 icon-link-hover stretched-link">
                  Continue lendo
                  <svg class="bi">
                    <use xlink:href="#chevron-right" />
                  </svg>
                </a>
              </div>
              <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
     aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
    <title>Novembro Azul</title>
    <image href="img/novembroazul.png" width="100%" height="100%" />
    <text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
</svg>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-6">
          <a href="outubrorosa.php" style="text-decoration:none;color: black">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0">Outubro Rosa: Um mês dedicado à saúde da mulher
                </h3>
                <div class="mb-1 text-body-secondary">27/09/2024</div>
                <p class="mb-auto">A saúde da mulher é um tema que deve ser abordado com seriedade. </p>
                <a href="outubrorosa.php" class="icon-link gap-1 icon-link-hover stretched-link">
                  Continue lendo
                  <svg class="bi">
                    <use xlink:href="#chevron-right" />
                  </svg>
                </a>
              </div>
              <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
     aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
    <title>Outubro Rosa</title>
    <image href="img/outubrorosa.png" width="100%" height="100%" />
    <text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
</svg>
              </div>
            </div>
          </a>
          </div>
        </div>

        <a href="cardsnoticias.php">
          <div class="text-center mb-4">
            <button type="button" class="btn btn-lg btn-purplee">Confira mais Notícias</button>
          </div>
        </a>

        <div class="container banner" style="max-width: 1920px;">
    <div class="row">
        <div class="col-md-5">
            <img src="img/logodeitada.png" style="width: 100%; height: auto;" alt="Erro ao exibir a Logo">
        </div>
        <div class="col-md-7" style="color: #f7f7f7; font-family: Libre Franklin, sans-serif; font-size: 30px; margin-top: 30px;">
            Saiba como ajudar a AVCC ⇩
        </div>
    </div>
</div>


        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <h2>DOAÇÕES</h2>
                <p style="text-align: justify;">As doações são fundamentais para nossa associação no combate ao câncer. Elas garantem tratamentos,
                  exames e apoio a pacientes. Contribua e ajude a salvar vidas com sua
                  solidariedade.ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ</p>
                <a style="text-decoration: none; color: white;" href="areadodoador.php">
                  <button class="btn-purple">
                    Confira
                  </button>
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <h2>EVENTOS</h2>
                <p style="text-align: justify;">Realizamos eventos para nossos membros como palestras e shows além de campanhas para arrecadar fundos
                  e conscientizar sobre o câncer. Tem uma ideia? Você pode sugerir novos eventos e participar ativamente
                  dessa luta. ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ</p>
                <a href="cadastroevt.php">
                  <button class="btn-purple"> Cadastre um Evento </button>
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <h2>BAZAR</h2>
                <p style="text-align: justify;">Nosso bazar oferece roupas variadas a preços acessíveis, e toda a renda é destinada aos pacientes.
                  Temos uma grande variedade de roupas, desde peças casuais até roupas mais elegantes, todas em ótimo
                  estado e a preços acessíveis.</p>
                <a style="text-decoration: none; color: white;" href="bazar.php">
                  <button class="btn-purple">
                    Confira
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>





  </main>

  <div class="text-secondary px-4 py-5 text-center" style=" background-image: linear-gradient(#480048, #750075);">
    <div class="py-5">
      <h1 class="display-5 fw-bold text-white">Juntos podemos fazer a diferença</h1>
      <div class="col-lg-6 mx-auto">
        <p class="mb-4" style="color: #f7f7f7; text-align: justify; font-size: 20px;">Junte-se a nós nessa luta! Juntos,
          podemos promover a conscientização, oferecer suporte e, acima de tudo, fazer a diferença na vida de muitas
          pessoas. A sua participação é fundamental para que possamos avançar e transformar desafios em conquistas.
          Vamos criar um futuro mais iluminado e cheio de esperança!
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <a href="cadastro.php" type="button" class="btn btn-outline-light btn-lg px-4 me-sm-3">Seja um contribuinte da
            AVCC</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container px-4 py-5" id="custom-cards">
    <div class="container">
      <h1 class="titulos">Entre em Contato</h1>

      <div class="box2"> </div>
    </div>
    <div class="row">
      <div class="col-lg-4">

      </div>
    </div>

    <div class="container px-4 py-5">


      <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
        <div class="col d-flex flex-column align-items-start gap-2">
          <h2 class="fw-bold text-body-emphasis">Como nos Encontrar</h2>
          <p class="text-body-secondary" style="text-align: justify;">Siga-nos nas nossas redes sociais para ficar por dentro das nossas ações,
            eventos e campanhas. Através delas, você pode interagir conosco, compartilhar suas histórias e se inspirar
            em iniciativas que fazem a diferença na vida de muitas pessoas.

          </p>
          <a href="areadodoador.php" class="btn btn-purple"> Faça uma doação </a>
        </div>

        <div class="col">
          <div class="row row-cols-1 row-cols-sm-2 g-4">
            <div class="col d-flex flex-column gap-2">
              <a href="javascript:void(0)" class="link_whatsapp" data-celular="">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 rounded-3"
                  style="background-color: #750075;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-telephone" viewBox="0 0 16 16" style="color: white;">
                    <path
                      d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                  </svg>
                </div>
              </a>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Telefone</h4>
              <p class="text-body-secondary">(18)98827-1135
              </p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <div id="maps-link"
                class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 rounded-3"
                style="background-color: #750075;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pin-map"
                  viewBox="0 0 16 16" style="color: white;">
                  <path fill-rule="evenodd"
                    d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                  <path fill-rule="evenodd"
                    d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                </svg>
              </div>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Endereço</h4>
              <p class="text-body-secondary">Rua Regente Feijó, nº 68, Centro, Presidente Venceslau - SP</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <div id="instagram-link"
                class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 rounded-3"
                style="background-color: #750075;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                  class="bi bi-instagram" viewBox="0 0 16 16" style="color: white;">
                  <path
                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
              </div>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Instagram</h4>
              <p class="text-body-secondary">@avcc.pv</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <div id="facebook-link"
                class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 rounded-3"
                style="background-color: #750075;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                  class="bi bi-facebook" viewBox="0 0 16 16" style="color: white;">
                  <path
                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                </svg>
              </div>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Facebook</h4>
              <p class="text-body-secondary">AVCC-Associação Venceslauense de Combate ao Câncer.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Página Inicial</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link px-2 text-body-secondary">Login</a></li>
          <li class="nav-item"><a href="faq.php" class="nav-link px-2 text-body-secondary">FAQs</a></li>
          <li class="nav-item"><a href="quemsomos.php" class="nav-link px-2 text-body-secondary">Sobre Nós</a></li>
        </ul>
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">

          </a>
          <span class="mb-3 mb-md-0 text-body-secondary">&copy; Associação Venceslauense de Combate ao Câncer</span>
        </div>

        <ul class="nav col-md-12 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/avcc.pv/"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram"
                viewBox="0 0 16 16">
                <path
                  d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
              </svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/avcc.pv/"><svg class="bi"
                width="24" height="24">
                <use xlink:href="#instagram" />

              </svg></a></li>

        </ul>
      </footer>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $(document).ready(function () {
        $(window).scroll(function () {
          var altura = $(window).scrollTop();
          var elementos = $('.hidden');
          var alturaElementos = [];

          elementos.each(function () {
            alturaElementos.push($(this).offset().top);
          });

          for (var i = 0; i < elementos.length; i++) {
            if (altura > alturaElementos[i] - 500) {
              elementos.eq(i).removeClass('hidden');
              elementos.eq(i).addClass('aparece');
            }
          }
        });
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const whatsappLinks = document.querySelectorAll('.link_whatsapp');

        whatsappLinks.forEach(link => {
          link.addEventListener('click', function () {
            const celular = this.getAttribute('data-celular');
            const ddd = celular.substring(0, 2);
            const numero = celular.substring(2);
            const mensagem = "Olá, gostaria de mais informações sobre a Associação";
            const url = `https://wa.me/5518988271135?text=${encodeURIComponent(mensagem)}`;

            window.open(url, '_blank');
          });
        });
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const instagramLink = document.getElementById('instagram-link');
        instagramLink.addEventListener('click', function () {
          window.location.href = 'https://www.instagram.com/avcc.pv/';
        });
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const facebookLink = document.getElementById('facebook-link');
        facebookLink.addEventListener('click', function () {
          window.location.href = 'https://www.facebook.com/p/AVCC-Associa%C3%A7%C3%A3o-Venceslauense-de-Combate-ao-C%C3%A2ncer-100089969850200/?_rdr';
        });
      });
      document.addEventListener('DOMContentLoaded', function () {
        const mapsLink = document.getElementById('maps-link');
        mapsLink.addEventListener('click', function () {
          window.location.href = 'https://www.google.com/maps/search/?api=1&query=Rua+Regente+Feijó,+nº+68,+Centro,+Presidente+Venceslau+-+SP';
        });
      });
    </script>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    const usernamePlaceholder = document.getElementById("nomeUsu");
    const cliente = document.getElementById("cliente");

    // Verifica se o usuário está logado
    const isLoggedIn = <?php echo isset($_SESSION["nome"]) ? "true" : "false"; ?>;

    if (isLoggedIn) {
      const username = "<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : ""; ?>";
      usernamePlaceholder.innerHTML = `Olá, ` + username + `!`; // Exibe o nome de usuário
    } else {
      usernamePlaceholder.innerHTML = "";
      // alert('nada conectado'); // Deixa em branco se não estiver logado
    }
  });
</script>
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>
</body>

</html>