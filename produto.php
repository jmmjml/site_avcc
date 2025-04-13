<?php include_once "header.php" ?>
<?php
    require 'bd/conexao.php';

    // Recebe o id do produto via GET
    $id_produto = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_produto) && is_numeric($id_produto)):

        // Captura os dados do produto solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM produtos WHERE pro_id = :pro_id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':pro_id', $id_produto);
        $stm -> execute();
        $produto = $stm->fetch(PDO::FETCH_OBJ);       
    endif;
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Bazar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
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

        .btn-purple {
        background-color: #600160; /* Cor de fundo roxa */
        border-color: #600160; /* Cor de borda roxa */
        color: #fff; /* Cor de texto branca */
        padding: 10px 30px; /* Espaçamento interno */
        font-size: 18px; /* Tamanho da fonte */
        border-radius: 5px;
        transition: background-color 0.3s ease;
      }

      .btn-purple:hover {
        background-color: #480048; /* Cor de fundo roxa escura ao passar o mouse */
        border-color: #480048; /* Cor de borda roxa escura ao passar o mouse */
        color: #fff;
      }

    </style>
</head>
<body>
    


    <main>
        <?php if(empty($produto)):?>
            <h3 class="text-center text-danger">Produto não encontrado!</h3>
        <?php else: ?>
        <div class="container py-4">
            <div class="p-4 mb-3 bg-body-tertiary" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
                <div class="container-fluid py-4">
                    <div class="row featurette">
                        <div class="col-md-5">
                            <img src="<?=$produto->pro_foto?>" alt="Imagem de <?=$produto->pro_nome?>" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-7">
                            <h2 class="featurette-heading fw-normal lh-1" style="margin-top: 40px;"><?=$produto->pro_nome?></h2>
                            <p class="lead">Clique no botão "Tenho interesse" abaixo para ser redirecionado diretamente ao nosso WhatsApp. Lá você pode tirar dúvidas, confirmar disponibilidade e finalizar sua compra de forma rápida e prática.</p>
                            <p style="font-size: 40px;">R$<?=$produto->pro_valor?></p>
                            <a href="javascript:void(0)" class="link_whatsapp" data-celular="">
                                <button class="btn btn-lg btn-purple">
                                    <span>Tenho interesse</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappLinks = document.querySelectorAll('.link_whatsapp');
            
            whatsappLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const celular = this.getAttribute('data-celular');
                    const ddd = celular.substring(0, 2);
                    const numero = celular.substring(2);
                    const mensagem = "Olá, gostaria de mais informações sobre o produto <?=$produto->pro_nome?>";
                    const url = `https://wa.me/5518988271135?text=${encodeURIComponent(mensagem)}`;
                    
                    window.open(url, '_blank');
                });
            });
        });
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>