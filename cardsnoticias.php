

<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, art_foto, art_titulo, art_texto, art_datapost FROM artigos order by id DESC';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $noticias = $stm->fetchAll(PDO::FETCH_OBJ);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, art_foto, art_titulo, art_texto, art_datapost FROM artigos WHERE art_titulo LiKE :art_titulo ORDER BY id DESC';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':art_titulo', $termo. '%');
    $stm->execute();
    $noticias = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>

<?php include_once "header.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">    
    <title>Notícias</title>
    <!-- link do css do bootstraponline -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link do css do bootstrap na maquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <!-- link css do bootstrap da barra de pesquisa -->
    <link rel="stylesheet" href="css/navbar-fixed.css">
    <!-- link css customizado -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        #nomeUsu{
            color: #ffffff;
        }
        /* img{
            height: 2rem;
            width: 2rem;
            border-radius: 90rem;
        } */
        /* .col{
            width: 9rem;
        } */
        .meumeu{
            height: 30rem;
        }
        .botao1 {
            color: white;
            font-weight: 400;
            background-color: #6e096e;
            width: 180px;
            height: 40px;
            border-radius: 5px;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
            border-color: #6e096e;
            transition: background-color 0.3s ease, transform 0.3s ease;
            align-items: center;
            text-align: center;
            justify-content: center;
            font-weight: bold
            }

            .botao1:hover {
            background-color: #ff8210;
            border-color: #ff8210;
            transform: scale(1.05);
            }
            .feature-icon-small {
    width: 3rem;
    height: 3rem;
}
.btn-purple {
    background-color: #600160;
    border-color: #600160;
    color: #fff;
    padding: 10px 30px;
    font-size: 18px;
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
    </style>
</head>
<body>
<br>
    <div class="container">
        <fieldset>
        <form action="" method="get" id="form-contato" class="">
                <h2><label for="termo" class="control-label">Barra de pesquisa</label></h2>
                <br>
                <div class="">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="Informe o Título da Notícia" style="border-color: #000000; width: 100%;">
                </div>
                <br>
                    <button style="font-weight: bold; font-size:20px" type="submit" class="botao1">Pesquisar</button>
                
            </form>
            <!-- CabeÃ§alho da Listagem -->
            <legend><h1>Listagem de Notícias</h1></legend>
            
            <div class="clearfix"></div>
                <?php if(!empty($noticias)):?>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?php
                         foreach($noticias as $noticia):
                            
                            
                            // Convertendo a string da data para um objeto DateTime
                            $data_original = $noticia->art_datapost;
                            $data_obj = DateTime::createFromFormat('Y-m-d H:i:s', $data_original);
                            
                            // Formatando a data para o formato dia-mes-ano
                            $data_formatada = $data_obj->format('d/m/Y');
                        ?>
                        
                                <a style="text-decoration: none;" href="noticiaaberta.php?id=<?=$noticia->id?>">
                                    <div class="col meumeu">
                                        <div class="card shadow-sm meumeu">
                                            <img src="<?=$noticia->art_foto?>" alt="" width="100%" height="225" style="border-radius: 0.3rem;">
                                            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
                                            <div style="align-items: center;justify-content:center; text-align:center; font-size:15px" class="card-body">
                                                <h2 class="card-text" style="text-align: center;text-decoration: none;"><?=$noticia->art_titulo?></h2>
                                                <button class="botao1">Ler Mais</button>
                                            </div>
                                            <p style="text-align: end;"><?=$data_formatada?></p>
                                        </div>
                                    </div>
                                </a>
                        <?php endforeach;?>
                    </div>
    
                <?php else: ?>
                    <!-- Mensagem caso nao exista colaboradores ou nao encontrado -->
                    <h3 class="text-center text-primary">Não encontramos as notícias!</h3>
                <?php endif; ?>
            </div>
        </fieldset>

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
          <p class="text-body-secondary">Siga-nos nas nossas redes sociais para ficar por dentro das nossas ações,
            eventos e campanhas. Através delas, você pode interagir conosco, compartilhar suas histórias e se inspirar
            em iniciativas que fazem a diferença na vida de muitas pessoas.

          </p>
          <a href="areadodoador.php" class="btn btn-purple"> Faça uma doação </a>
        </div>

        <div class="col">
          <div class="row row-cols-1 row-cols-sm-2 g-4">
            <div class="col d-flex flex-column gap-2">
              <a href="javascript:void(0)" class="link_whatsapp2" data-celular="">
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
    </div>
    <script type="text/javascript" src="js/cadastronoticia.js"></script>
    
    <!-- JS do bootstrap online -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const usernamePlaceholder = document.getElementById("nomeUsu");
        
        // Verifica se o usuário está logado
        const isLoggedIn = <?php echo isset($_SESSION["nome"]) ? "true" : "false"; ?>;
        
        if (isLoggedIn) {
            const username = "<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : ""; ?>";
            usernamePlaceholder.innerHTML = `Olá, `+username+`!`; // Exibe o nome de usuário
        } else {
            usernamePlaceholder.innerHTML = "";
            // alert('nada conectado'); // Deixa em branco se não estiver logado
        }
    });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const whatsappLinks = document.querySelectorAll('.link_whatsapp2');

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
</body>
</html>