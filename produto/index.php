<!DOCTYPE html>

<?php
    session_start();

	$logado = false;
	$state = 0;
	$order = "nome";

	$getOrder = " ";

	$selorder = false;

    $link_venda = "../venda/index.php?id_prod=";

	if(isset($_GET['order']))
    {
		$getOrder = $_GET['order'];

		if($getOrder == "alf")
        {
			$order = "nome";
		}
		else if($getOrder == "men")
        {
			$order = "preco ASC";
		}
		else 
        {
			$order = "preco DESC";
		}

		$selorder = true;
	}

    if (!empty($_SESSION['user'])) //Teste de sessão
    {
        $logado = true;
        $carrinho = $_SESSION['carrinho'];
    }

    try 
    {
        $prod_name = $_GET['search'];
		
		$lower_prod_name = strtolower($prod_name);
		
        include "../php/connect.php";

        $sql = "SELECT * FROM p_produtos WHERE lower(nome) = '$lower_prod_name' AND excluido = 'f'";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);

        if ($qtd <= 0) 
        {
            $sql = "SELECT * FROM p_produtos WHERE lower(nome) LIKE '%$lower_prod_name%' AND excluido = 'f' ORDER BY $order";
            $res = pg_query($conectar, $sql);
            $qtd = pg_num_rows($res);
            
            if ($qtd <= 0)
            {
                //ERRO
                $state = 0;

                pg_close();
            } 
            else
            {
                //Pesquisa por Similaridade
                $state = 1;
            }
        } 
        else 
        {
            //Pesquisa Específica 
            $state = 2;

            pg_close();
        }
    } 
    catch (Exception $e) 
    {
    ?> 
        <script>
            alert("<?php echo $e->getMessage(); ?>");
        </script>
    <?php

    }
?>

<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">


	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/footer.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/presentation.css">
	<link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/search.css">
	<link rel="stylesheet" href="../css/catalogo.css">

	<title>Resultados da Pesquisa</title>
</head>

<body>

	<div class="main">
		<div class="index-struct">

			<div class="header" id="topo">
				<div class="logo">
					<a href="../index.php">
						<img src="imgs/KITALL.png" alt="Kitall?">
					</a>
				</div>

				<div class="menu show">
					<ul>
						<li>
							<a href="../index.php">Home</a>
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
					<button class="menuMobileButton" onclick="menuDropdown()">
						▼
					</button>

					<div class="menuMobileContent">
						<ul>
							<li>
								<a href="../index.php">Home</a>
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
											<div class="entrar" <?php if($logado) echo 'style="grid-template-columns:1fr 2fr;"'?>>
												<div>
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<?php
                                                        if($logado)
                                                        {
                                                            ?><h2><a href="../minha_conta/" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php
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
												<a href="../carrinho/index.php" title="Essas são suas compras">
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
									<form action="">
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
									<a href=""><img id="user" src="" alt="Usuário"></a>
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
										<img src="../carrinho/index.php" id="cesta" alt="Cesta">
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
            
			<div class="produto">
        <div class="produtoContent">
            <div class="produtoImg">
                <div class="produtoImgContent">
                    <img src="../imgs/produtos/lapis_verde.png" alt="">
                </div>
            </div>

            <div class="produtoName">
                <div class="produtoNameContent">
                    <div>Lápis Verde</div>
                </div>
            </div>

            <div class="produtoPreco">
                <div class="produtoPrecoContent">
                    <div class="prodPrice">R$1,00 </div>
                </div>
            </div>

            <div class="produtoQtde">
                <div class="produtoQtdeContent">
                    <div>
                        Quantidade:
                    </div>
                    <div class="produteQtdeInput">
                        <input type="number" min="1" value="1" max="10" title="Quantidade">
                    </div>
                </div>
            </div>

            <div class="produtoFinalizar">
                <div class="produtoFinalizarContent">
                    <div class="btnSubmit">
                        <input type="submit" name="subProduto" value="Adicionar ao Carrinho">
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
											<a href="../">Home</a>
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
																<a href=""><img id="user" src="" alt="Usuário"></a>
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
															<a href="../carrinho/index.php" title="Essas são suas compras">
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
										<div class="pesquisaFooter">
											<a title="Pesquisar" onclick="footerSearchDropdown()" class="footerSearchButton">
												<div>
													<img src="imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
												</div>
											</a>
											<div class="footerSearchBar">
												<form action="">
													<div class="searchField">
														<input type="search" name="search" class="searchInput" placeholder="Pesquise" required>
													</div>
													<div class="searchSubmit">
														<button type="submit" id="subSearchBtn" title="Pesquisar!"><img src="imgs/search_icon.png" alt="" id="search"></button>
													</div>
												</form>
											</div>
										</div>
									</li>
									<li>
										<div class="entrar">
											<div>
												<a href=""><img id="user" src="" alt="Usuário"></a>
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
											<a href="../carrinho/index.php" title="Essas são suas compras">
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
									<a href="https://www.facebook.com/kitallCTI" id="aface" target="_blank"><img src="imgs/facebook.png" id="face" alt="">
										<div></div>
									</a>
									<a href="https://www.instagram.com/kitallcti/" id="ainsta" target="_blank"><img src="imgs/instagram.png" id="insta" alt="">
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