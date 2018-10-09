<?php
    /*FALTA FINALIZARRR A COMRPRA*/

    session_start();

    $logado = false;
    if (empty($_SESSION['user'])) //Teste de sessão
    {
        header("Location: ../login/index.php");
        exit;
    }

    if(!empty($_SESSION['carrinho']) && $qtd_comprada > 0)
    {
        array_push($_SESSION['carrinho_id'], $_SESSION['id_venda']);

        array_push($_SESSION['carrinho_qtd'], (string)$qtd_comprada);

        array_push($_SESSION['carrinho_preco'], $_SESSION['preco_venda']);
        
        array_push($_SESSION['carrinho_estoque'], $_SESSION['estoque_venda']);

        $_SESSION['carrinho'] += 1;
    }
    else if(empty($_SESSION['carrinho_id']) && $qtd_comprada > 0)
    {
        $_SESSION['carrinho_id'] = array($_SESSION['id_venda']);

        $_SESSION['carrinho_qtd'] = array((string)$qtd_comprada);

        $_SESSION['carrinho_preco'] = array($_SESSION['preco_venda']);
        
        $_SESSION['carrinho_estoque'] = array($_SESSION['estoque_venda']);

        $_SESSION['carrinho'] = 1;
    }
?>
      
<?php
    //Mostra o conteúdo carrinho

    $qtd = $_SESSION['carrinho'];
    echo "<h1>Quantidade no carrinho atual = $qtd</h1>"; 

    if($qtd > 0)
    {
        echo "<br><h2>Produtos do carrinho:</h2>"; 
        
        $carrinho_id = $_SESSION['carrinho_id'];
        $carrinho_qtd = $_SESSION['carrinho_qtd'];
        $carrinho_preco = $_SESSION['carrinho_preco'];
            
        for($i = 0; $i < $qtd; $i++)
        { 
            echo "<br>id = ".$carrinho_id[$i];
            echo "<br>qtd = ".$carrinho_qtd[$i];
            echo "<br>preco = ".$carrinho_preco[$i];
            echo "<br><br>---------------------------------<br>";
        }    
    }

    echo "<br><br>";
    if($qtd > 0)
    {
        echo "<h3><a href='../php/vender.php'>Finalizar compra</a></h3>";
        echo "<br><br>"; 
    }
?>
<br>
<br>
<a href="../index.php">Voltar p/ home</a>

<!-- ABAIXO CÓDIGO HTML  -->

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
                        <a href="">
                            <img src="../imgs/KITALL.png" alt="Kitall?">
                        </a>
                    </div>
    
                    <div class="menu show">
                        <ul>
                            <li id="active">
                                <a href="">Home</a>
                            </li>
                            <li>
                                <a href="">Monte seu Kit</a>
                            </li>
                            <li>
                                <a href="">Produtos</a>
                            </li>
                            <li>
                                <a href="">Quem Somos</a>
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
                                    <a href="">Monte seu Kit</a>
                                </li>
                                <li>
                                    <a href="">Produtos</a>
                                </li>
                                <li>
                                    <a href="">Quem Somos</a>
                                </li>
                                <li id="btns">
                                    <div class="btns showBtnsMobile">
                                        <ul>
                                            <li>
                                                <div class="pesquisa">
                                                    <a href="" title="Pesquisar">
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

<div class="carrinho">
        <div class="carrinhoContent">
            <div class="carrinhoTitle">

                <div class="carrinhoTitleTxt">
                    <h1>Carrinho de Compras</h1>
                </div>

            </div>

            <div class="carrinhoProdsBox">
                <div class="carrinhoProdsBoxContent">
                    <div class="carrinhoProd">
                        <div class="carrinhoProdImage">
                            <div class="carrinhoProdImageContent">
                                <img src="../imgs/produtos/borracha1.png" alt="">
                            </div>
                        </div>

                        <div class="carrinhoProdName">
                            <div class="carrinhoProdNameContent">
                                <h3>Borracha Mercur</h3>
                            </div>
                        </div>

                        <div class="carrinhoProdPreco">
                            <div class="carrinhoProdPrecoContent">
                                <div class="carrinhoProdPrecoTxt">
                                    <div class="prodPrice">R$2,00 </div>
                                </div>
                            </div>
                        </div>

                        <div class="carrinhoProdQuantidade">
                            <div class="carrinhoProdQuantidadeContent">
                                <div class="carrinhoProdQuantidadeInput">
                                    <input type="number" min="1" value="1" max="10">
                                </div>
                            </div>

                        </div>

                        <div class="carrinhoProdRemover">
                            <div class="carrinhoProdRemoverContent">
                                <a href="">Remover</a>
                            </div>
                        </div>
                    </div>
                    <div class="carrinhoProd">
                        <div class="carrinhoProdImage">
                            <div class="carrinhoProdImageContent">
                                <img src="../imgs/produtos/bloco_de_notas1.png" alt="">
                            </div>
                        </div>

                        <div class="carrinhoProdName">
                            <div class="carrinhoProdNameContent">
                                <h3>Porta Post-it</h3>
                            </div>
                        </div>

                        <div class="carrinhoProdPreco">
                            <div class="carrinhoProdPrecoContent">
                                <div class="carrinhoProdPrecoTxt">
                                    <div class="prodPrice">R$1,00 </div>
                                </div>
                            </div>
                        </div>

                        <div class="carrinhoProdQuantidade">
                            <div class="carrinhoProdQuantidadeContent">
                                <div class="carrinhoProdQuantidadeInput">
                                    <input type="number" min="1" value="1" max="10">
                                </div>
                            </div>

                        </div>

                        <div class="carrinhoProdRemover">
                            <div class="carrinhoProdRemoverContent">
                                <a href="">Remover</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="carrinhoFinalizar">
                <div class="carrinhoFinalizarContent">
                    <div class="carrinhoSubtotal">
                        <div class="carrinhoSubtotalContent">
                            <h2>Subtotal (2 itens): R$ 3,00</h2>
                        </div>
                    </div>
                    <div class="carrinhoBtn">
                        <div class="carrinhoBtnContent">
                            <div class="btnSubmit">
                                <input type="submit" name="subCadastro" value="Finalizar Compra">
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
                                            <a href="">Home</a>
                                        </li>
                                        <li>
                                            <a href="">Monte seu Kit</a>
                                        </li>
                                        <li>
                                            <a href="">Produtos</a>
                                        </li>
                                        <li>
                                            <a href="">Quem Somos</a>
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
                                                <a href="">Home</a>
                                            </li>
                                            <li>
                                                <a href="">Monte seu Kit</a>
                                            </li>
                                            <li>
                                                <a href="">Produtos</a>
                                            </li>
                                            <li>
                                                <a href="">Quem Somos</a>
                                            </li>
                                            <li id="btns">
                                                <div class="btns showBtnsMobile">
                                                    <ul>
                                                        <li>
                                                            <div class="pesquisa">
                                                                <a href="" title="Pesquisar">
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