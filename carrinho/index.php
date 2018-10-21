<!--FALTA FINALIZARRR A COMRPRA*/   -->
<?php
    session_start();

    include "../php/connect.php";

    $logado = true;
    if (empty($_SESSION['user'])) //Teste de sessão
    {
        $logado = false;
        
        header("Location: ../login/index.php");
        exit;
    }

    $qtd_comprada = $_POST['qtd'];

    if(!empty($_SESSION['carrinho']) && $qtd_comprada > 0) //adiciona ao carrinho
    {
        array_push($_SESSION['carrinho_link'], $_SESSION['link_venda']);
        
        array_push($_SESSION['carrinho_id'], $_SESSION['id_venda']);

        array_push($_SESSION['carrinho_qtd'], (string)$qtd_comprada);

        array_push($_SESSION['carrinho_preco'], $_SESSION['preco_venda']);
        
        array_push($_SESSION['carrinho_estoque'], $_SESSION['estoque_venda']);
        
        array_push($_SESSION['carrinho_nome'], $_SESSION['nome_venda']);

        $_SESSION['carrinho'] += 1;
    }
    else if(empty($_SESSION['carrinho_id']) && $qtd_comprada > 0) //cria o carrinho
    {
        $_SESSION['carrinho_id'] = array($_SESSION['id_venda']);

        $_SESSION['carrinho_qtd'] = array((string)$qtd_comprada);

        $_SESSION['carrinho_preco'] = array($_SESSION['preco_venda']);
        
        $_SESSION['carrinho_estoque'] = array($_SESSION['estoque_venda']);
        
        $_SESSION['carrinho_nome'] = array($_SESSION['nome_venda']);
        
        $_SESSION['carrinho_link'] = array($_SESSION['link_venda']);
        
        $_SESSION['carrinho'] = 1;
    }

    $produtos = false;

    $carrinho = $_SESSION['carrinho'];

    if($carrinho > 0)
    {
        $carrinho_id = $_SESSION['carrinho_id'];
        $carrinho_qtd = $_SESSION['carrinho_qtd'];
        $carrinho_preco = $_SESSION['carrinho_preco'];
        $carrinho_nome = $_SESSION['carrinho_nome'];
        $carrinho_link = $_SESSION['carrinho_link'];
        
        $preco_total = 0;
        
        $produtos = true;   
    }
?>
<!DOCTYPE html> 
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/presentation.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/search.css">
        <link rel="stylesheet" href="../css/carrinho.css">
    
        <title>Carrinho de Compras - Kitall?</title>
    </head>
    
    <body>
    
        <div class="main">
            <div class="index-struct">
    
                <div class="header" id="topo">
                    <div class="logo">
                        <a href="../index.php">
                            <img src="../imgs/KITALL.png" alt="Kitall?">
                        </a>
                    </div>
    
                    <div class="menu show">
                        <ul>
                            <li id="active">
                                <a href="../index.php">Home</a>
                            </li>
                            <li>
                                <a href="../montar_kit/index.html">Monte seu Kit</a>
                            </li>
                            <li>
                                <a href="../produtos/index.php">Produtos</a>
                            </li>
                            <li>
                                <a href="../quem_somos/">Quem Somos</a>
                            </li>
                        </ul>
                    </div>
    
                    <div class="menuMobile showMobile">
                        <button class="menuMobileButton" onclick="menuDropdown(true)">
                            ▼
                        </button>
    
                        <div class="menuMobileContent">
                            <ul>
                                <li id="active">
                                    <a href="">Home</a>
                                </li>
                                <li>
                                    <a href="../montar_kit/index.html">Monte seu Kit</a>
                                </li>
                                <li>
                                    <a href="../produtos/index.php">Produtos</a>
                                </li>
                                <li>
                                    <a href="../quem_somos/">Quem Somos</a>
                                </li>
                                <li id="btns">
                                    <div class="btns showBtnsMobile">
                                        <ul>
                                            <li>
                                                <div class="pesquisa">
                                                    <a href="../pesquisa/index.php" title="Pesquisar">
                                                        <div>
                                                            <img src="" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="entrar">
                                                    <div>
                                                        <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                                    </div>
                                                    <div>
                                                        <h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/"
                                                             title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cesta">
                                                    <a href="" title="Essas são suas compras">
                                                        <div>
                                                            <img src="" id="cesta" alt="Cesta">
                                                        </div>
                                                        <div>
                                                            <?php 
                                                                if ($logado) //Teste de sessão
                                                                {
                                                                    echo "<h2>".$carrinho."</h2>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<h2>0</h2>"; //SEM CARRINHO
                                                                }
                                                            ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="btns showBtns">
                        <ul>
                            <li>
                                <div class="pesquisa">
                                    <a title="Pesquisar" onclick="searchDropdown()" class="searchButton">
                                        <div>
                                            <img src="../imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
                                        </div>
                                    </a>
                                    <div class="searchBar">
                                        <form action="../pesquisa/index.php" method="get">
                                            <div class="searchField">
                                                <input type="search" name="search" class="searchInput" placeholder="Pesquise" required>
                                            </div>
                                            <div class="searchSubmit">
                                                <button type="submit" id="subSearchBtn" title="Pesquisar!"><img src="../imgs/search_icon.png" alt="" id="search"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="entrar">
                                    <div>
                                        <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                    </div>
                                    <div>
                                        <?php
                                            if($logado)
                                            {
                                                ?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                            }
                                            else
                                            {
                                                ?><h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                            } 
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="cesta">
                                    <a href="" title="Essas são suas compras">
                                        <div>
                                            <img src="" id="cesta" alt="Cesta">
                                        </div>
                                        <div>
                                            <?php 
                                                if ($logado) //Teste de sessão
                                                {
                                                    echo "<h2>".$carrinho."</h2>";
                                                }
                                                else
                                                {
                                                    echo "<h2>0</h2>"; //SEM CARRINHO
                                                }
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>				
                </div>

<div class="carrinho">
        <div class="carrinhoContent">
            <div class="carrinhoTitle">

                <div class="carrinhoTitleTxt">
                    <h1>Carrinho de Compras</h1>
                </div>

            </div>
            <div class="carrinhoProdsBox">
                <div class="carrinhoProdsBoxContent">
                   <?php
                    if($produtos)
                    {
                        for($i = 0; $i < $carrinho; $i++)
                        { 
                            $id = $carrinho_id[$i];
                            $qtd_prod = $carrinho_qtd[$i];
                            $preco = $carrinho_preco[$i];
                            $nome =  $carrinho_nome[$i];
                            $link = $carrinho_link[$i];
                           
                            $preco_total += ($preco*$qtd_prod);
                    
                    ?>
                    <div class="carrinhoProd">
                        <div class="carrinhoProdImage">
                            <div class="carrinhoProdImageContent">
                                <?php echo "<img src='$link' alt=''>"; ?>
                            </div>
                        </div>

                        <div class="carrinhoProdName">
                            <div class="carrinhoProdNameContent">
                                <?php echo "<h3>$nome</h3>"; ?>
                            </div>
                        </div>

                        <div class="carrinhoProdPreco">
                            <div class="carrinhoProdPrecoContent">
                                <div class="carrinhoProdPrecoTxt">
                                    <div class="prodPrice"><?php echo "R$ $preco"; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="carrinhoProdQuantidade">
                            <div class="carrinhoProdQuantidadeContent">
                                <div class="carrinhoProdQuantidadeInput">
                                    <?php echo "<input type='number' value='$qtd_prod' readonly>"; ?>
                                </div>
                            </div>

                        </div>

                        <div class="carrinhoProdRemover">
                            <div class="carrinhoProdRemoverContent">
                                <?php echo "<a href='../php/remove_item.php?remove=$i'>Remover</a>"; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                            
                         }
                        echo "<a href='../index.php'>Adicionar mais produtos</a>";
                    }
                    else
                    {
                        echo "<h2>Seu carrinho está vazio!</h2>";
                        echo "<br><br><br>";
                        echo "<a href='../index.php'>Compre produtos agora!</a>";
                    }
            
                    ?>

                </div>
            </div>

            <div class="carrinhoFinalizar">
                <div class="carrinhoFinalizarContent">
                    <div class="carrinhoSubtotal">
                        <div class="carrinhoSubtotalContent">
                            <?php
                                if($carrinho > 0)
                                    echo "<h2>Subtotal ($carrinho): R$ $preco_total</h2>";
                                else
                                    echo "<h2>Subtotal ($carrinho): R$ 0.00</h2>";
                            ?>
                        </div>
                    </div>
                    <div class="carrinhoBtn">
                        <div class="carrinhoBtnContent">
                            <div class="btnSubmit">
                                <form action="../php/vender.php">
                                    <?php 
                                    if($carrinho > 0)
                                        echo "<input type='submit' name='subCadastro' value='Finalizar Compra'>";
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

                <div class="footer">
                    <div class="footerContent">
                        <div class="footerMenu">
                            <div class="footerMenuContent">
    
                                <div class="menuFooter show">
                                    <ul>
                                        <li>
                                            <a href="../index.php">Home</a>
                                        </li>
                                        <li>
                                            <a href="../montar_kit/index.html">Monte seu Kit</a>
                                        </li>
                                        <li>
                                            <a href="../produtos/index.php">Produtos</a>
                                        </li>
                                        <li>
                                            <a href="../quem_somos/">Quem Somos</a>
                                        </li>
                                    </ul>
                                </div>
    
                                <div class="menuFooterMobile showMobile">
                                    <button class="menuFooterMobileButton" onclick="menuFooterDropdown()">
                                        ▲
                                    </button>
    
                                    <div class="menuFooterMobileContent">
                                        <ul>
                                            <li>
                                                <a href="../">Home</a>
                                            </li>
                                            <li>
                                                <a href="../montar_kit/index.html">Monte seu Kit</a>
                                            </li>
                                            <li>
                                                <a href="../produtos/index.php">Produtos</a>
                                            </li>
                                            <li>
                                                <a href="../quem_somos/">Quem Somos</a>
                                            </li>
                                            <li id="btns">
                                                <div class="btns showBtnsMobile">
                                                    <ul>
                                                        <li>
                                                            <div class="pesquisa">
                                                                <a href="../pesquisa/index.php" title="Pesquisar">
                                                                    <div>
                                                                        <img src="" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="entrar">
                                                                <div>
                                                                    <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                                                </div>
                                                                <div>
                                                                    <?php
                                                                        if($logado)
                                                                        {
                                                                            ?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?><h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                                                        } 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="cesta">
                                                                <a href="" title="Essas são suas compras">
                                                                    <div>
                                                                        <img src="" id="cesta" alt="Cesta">
                                                                    </div>
                                                                    <?php 
                                                                        if ($logado) //Teste de sessão
                                                                        {
                                                                            echo "<h2>".$carrinho."</h2>";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "<h2>0</h2>"; //SEM CARRINHO
                                                                        }
                                                                    ?>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="btns showBtns">
                                    <ul>
                                        <li>
                                            <div class="pesquisaFooter">
                                                <a title="Pesquisar" onclick="footerSearchDropdown()" class="footerSearchButton">
                                                    <div>
                                                        <img src="../imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
                                                    </div>
                                                </a>
                                                <div class="footerSearchBar">
                                                    <form action="pesquisa/">
                                                        <div class="searchField">
                                                            <input type="search" name="search" class="searchInput" placeholder="Pesquise" required>
                                                        </div>
                                                        <div class="searchSubmit">
                                                            <button type="submit" id="subSearchBtn" title="Pesquisar!"><img src="../imgs/search_icon.png" alt="" id="search"></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="entrar">
                                                <div>
                                                    <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                                </div>
                                                <div>
                                                    <?php
                                                        if($logado)
                                                        {
                                                            ?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                                        }
                                                        else
                                                        {
                                                            ?><h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                                        } 
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cesta">
                                                <a href="" title="Essas são suas compras">
                                                    <div>
                                                        <img src="" id="cesta" alt="Cesta">
                                                    </div>
                                                    <div>
                                                        <?php 
                                                            if ($logado) //Teste de sessão
                                                            {
                                                                echo "<h2>".$carrinho."</h2>";
                                                            }
                                                            else
                                                            {
                                                                echo "<h2>0</h2>"; //SEM CARRINHO
                                                            }
                                                        ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
    
                        <div class="footerContato">
                            <div class="footerContatoContent">
                                <div class="footerContatoTxt">
                                    <h2>Entre em <a class="bold" href="">Contato</a>!</h2>
                                </div>
                                <div class="footerContatoIcons">
                                    <div class="footerContatoIconsContent">
                                        <a href="https://www.facebook.com/kitallCTI" id="aface" target="_blank"><img src="../imgs/facebook.png" id="face" alt="">
                                            <div></div>
                                        </a>
                                        <a href="https://www.instagram.com/kitallcti/" id="ainsta" target="_blank"><img src="../imgs/instagram.png" id="insta" alt="">
                                            <div></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="footerTopo">
                            <div class="footerTopoContent">
                                <a href="#topo">Voltar ao Topo</a>
                            </div>
                        </div>
    
                        <div class="footerIntegrantes">
                            <div class="footerIntegrantesContent">
                                <hr>
                                <div class="footerIntegrantesNomes">
                                    <p>@2018<br>por André Creppe, Bella Barreira, Carolina Alborgheti, Estevão Rolim e Marcos Lira</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    
        </div>
    
    
    
    </body>
    
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/header.js"></script>
    <script type="text/javascript" src="../js/footerMenu.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/search.js"></script>
    
    
    
    </html>