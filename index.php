<!DOCTYPE html>
    
<?php
    session_start();

    $logado = false;
    if (!empty($_SESSION['user'])) //Teste de sessão
    {
        $logado = true;
        $carrinho = $_SESSION['carrinho'];
    }

    $able = true;
	$ind = -1;
	$numm = 0;
    $prod_padrao = array(
        array("Bloco de Notas", "Anote tudo o que precisa ser transformado e melhorado.", "imgs/produtos/bloco_de_notas.png"),
        array("Caneta Azul BIC", "A caneta que é sinônimo de qualidade conhecida no mundo inteiro!", "imgs/produtos/caneta.png"),
        array("Porta Post-It (4)", "O Porta Post-It da Kitall?, além de ser bonito é de extrema qualidade, pronto para te ajudar nos estudos do colégio e anotações do dia-a-dia venha e experimente Kitall?", "imgs/produtos/porta_postit_4.png")
    );

    $num_rand = array(0, 0, 0);
    try 
    {
        include "php/connect.php";

        $sql = "SELECT id_prod FROM p_produtos 
                    WHERE excluido=FALSE AND qtd>0
                    ORDER BY RANDOM() LIMIT 3";

        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if ($qtd > 0) 
        {
            $i = 0;
            while ($prod = pg_fetch_array($res)) 
            {
                $num_rand[$i] = $prod['id_prod'];
                $i++;
            }
        }
    } 
    catch (Exception $e) 
    {
        // echo $e->getMessage();

        $able = false;
    }
?>

<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">


	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/presentation.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/search.css">
	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="manifest" href="manifest.json">

	<title>Kitall?</title>
</head>

<body>

	<div class="main">
		<div class="index-struct">

			<div class="header" id="topo">
				<div class="logo">
					<a href="">
						<img src="imgs/KITALL.png" alt="Kitall?">
					</a>
				</div>

				<div class="menu show">
					<ul>
						<li id="active">
							<a href="">Home</a>
						</li>
						<li>
							<a href="montar_kit/index.html">Monte seu Kit</a>
						</li>
						<li>
							<a href="produtos/index.php">Produtos</a>
						</li>
						<li>
							<a href="quem_somos">Quem Somos</a>
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
								<a href="index.php">Home</a>
							</li>
							<li>
								<a href="montar_kit/index.html">Monte seu Kit</a>
							</li>
							<li>
								<a href="produtos/index.php">Produtos</a>
							</li>
							<li>
								<a href="quem_somos">Quem Somos</a>
							</li>
							<li id="btns">
								<div class="btns showBtnsMobile">
									<ul>
										<li>
											<div class="pesquisa">
												<a href="pesquisa/index.php" title="Pesquisar">
													<div>
														<img src="" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
													</div>
												</a>
											</div>
										</li>
										<li>
											<div class="entrar">
												<div>
													<a href="login/index.php"><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/"
														 title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
												</div>
											</div>
										</li>
										<li>
											<div class="cesta">
												<a href="carrinho/index.php" title="Essas são suas compras">
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
										<img src="imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
									</div>
								</a>
								<div class="searchBar">
									<form action="pesquisa/">
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
									<a href="login/"><img id="user" src="" alt="Usuário"></a>
								</div>
								<div>
								    <?php
                                        if($logado)
                                        {
                                            ?><h2><a href="minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                        }
                                        else
                                        {
                                            ?><h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                        } 
                                    ?>
								</div>
							</div>
						</li>
						<li>
							<div class="cesta">
								<a href="carrinho/index.php" title="Essas são suas compras">
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
			<div class="presentation">
				<img src="imgs/paperwork.jpg" alt="">

				<div class="presentOrganize">
					<div class="presentTxtBtn">
						<div class="presentTxt">
							<h1>MONTE</h1>
							<h1 style="font-weight: bold">SEU KIT</h1>
						</div>
						<div class="presentBtn">
							<button class="btnKitall bold" onclick="window.location.href='produtos/index.php'">Kitall?</button>
						</div>
					</div>
				</div>
			</div>
			<div class="featProducts">
				<div class="featProductsContent">
					<div class="featProduct textOnLeft">
						<?php
					$ind++;
					if ($able) 
                    {
						$numm = $num_rand[$ind];
						$sql = "SELECT * FROM p_produtos WHERE id_prod=$numm";

						$res = pg_query($conectar, $sql);
						$qtd = pg_num_rows($res);
						if ($qtd > 0) 
                        {
							while ($prod = pg_fetch_array($res)) 
                            {
								$nome = $prod['nome'];
								$descricao = $prod['descricao'];
								$link_img = $prod['link_img'];
							}
						} 
                        else 
                        {
							$nome = $prod_padrao[$ind][0];
							$descricao = $prod_padrao[$ind][1];
							$link_img = $prod_padrao[$ind][2];
						}
					} 
                    else 
                    {
						$nome = $prod_padrao[$ind][0];
						$descricao = $prod_padrao[$ind][1];
						$link_img = $prod_padrao[$ind][2];
					}
					?>
							<div class="featProductText">
				            <?php
                                echo "<h2>$nome</h2>";
                                echo "<p>$descricao</p>";
							?>
							</div>
							<div class="featProductImg">
								<?php echo "<a href='venda/index.php?id_prod=$numm'><img src='$link_img' alt='300'></a>" ?>
							</div>
					</div>
					<div class="featProduct textOnRight">
				    <?php
                        $ind++;
                                
                        if ($able) 
                        {
                            $numm = $num_rand[$ind];
                            $sql = "SELECT * FROM p_produtos WHERE id_prod=$numm";

                            $res = pg_query($conectar, $sql);
                            $qtd = pg_num_rows($res);
                            if ($qtd > 0) 
                            {
                                while ($prod = pg_fetch_array($res)) 
                                {
                                    $nome = $prod['nome'];
                                    $descricao = $prod['descricao'];
                                    $link_img = $prod['link_img'];
                                }
                            } 
                            else 
                            {
                                $nome = $prod_padrao[$ind][0];
                                $descricao = $prod_padrao[$ind][1];
                                $link_img = $prod_padrao[$ind][2];
                            }
                        } 
                        else 
                        {
                            $nome = $prod_padrao[$ind][0];
                            $descricao = $prod_padrao[$ind][1];
                            $link_img = $prod_padrao[$ind][2];
                        }
					?>
						<div class="featProductText">
				        <?php
                            echo "<h2>$nome</h2>";
                            echo "<p>$descricao</p>";
						?>
						</div>
						<div class="featProductImg">
							<?php echo "<a href='venda/index.php?id_prod=$numm'><img src='$link_img' alt='300'></a>" ?>
						</div>
					</div>
					<div class="featProduct textOnLeft">
				    <?php
                        $ind++;
                        if ($able) 
                        {
                            $numm = $num_rand[$ind];
                            $sql = "SELECT * FROM p_produtos WHERE id_prod=$numm";

                            $res = pg_query($conectar, $sql);
                            $qtd = pg_num_rows($res);
                            if ($qtd > 0) 
                            {
                                while ($prod = pg_fetch_array($res)) 
                                {
                                    $nome = $prod['nome'];
                                    $descricao = $prod['descricao'];
                                    $link_img = $prod['link_img'];
                                }
                            } 
                            else 
                            {
                                $nome = $prod_padrao[$ind][0];
                                $descricao = $prod_padrao[$ind][1];
                                $link_img = $prod_padrao[$ind][2];
                            }
                        } 
                        else 
                        {
                            $nome = $prod_padrao[$ind][0];
                            $descricao = $prod_padrao[$ind][1];
                            $link_img = $prod_padrao[$ind][2];
					    }
					?>

						<div class="featProductText">
				        <?php
						  echo "<h2>$nome</h2>";
						  echo "<p>$descricao</p>";
						?>
						</div>
						<div class="featProductImg">
							<?php echo "<a href='venda/index.php?id_prod=$numm'><img src='$link_img' alt='300'></a>" ?>
						</div>
					</div>
				</div>
			</div>
			<div class="video">
				<div class="presentVideoOrganizer">
					<div class="presentVideoGrid">
						<div class="presentVideo">
							<iframe src="https://www.youtube.com/embed/AbmZeLv3Qc4?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media"
							 allowfullscreen></iframe>
						</div>
						<div class="presentVideoDescription">
							<h2>Dicas de materiais para você adquirir na Kitall?</h2>
							<p>A Kitall? oferece os melhores produtos para você montar o seu kit como e onde quiser. Com o melhor preço você
								economiza com qualidade.
								Agora você não precisa mais sair de casa! A Kitall? foi desenvolvida para facilitar a sua vida, te
								proporcionando os melhores produtos no conforto do seu sofá!</p>
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
									<li id="active">
										<a href="">Home</a>
									</li>
									<li>
										<a href="montar_kit/index.html">Monte seu Kit</a>
									</li>
									<li>
										<a href="produtos/index.php">Produtos</a>
									</li>
									<li>
										<a href="quem_somos/">Quem Somos</a>
									</li>
								</ul>
							</div>

							<div class="menuFooterMobile showMobile">
								<button class="menuFooterMobileButton" onclick="menuFooterDropdown()">
									▲
								</button>

								<div class="menuFooterMobileContent">
									<ul>
										<li id="active">
											<a href="">Home</a>
										</li>
										<li>
											<a href="montar_kit/index.html">Monte seu Kit</a>
										</li>
										<li>
											<a href="produtos/index.php">Produtos</a>
										</li>
										<li>
											<a href="quem_somos">Quem Somos</a>
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
																<a href="login/"><img id="user" src="" alt="Usuário"></a>
															</div>
															<div>
																<?php
                                                                    if($logado)
                                                                    {
                                                                        ?><h2><a href="minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                                                    } 
                                                                ?>
															</div>
														</div>
													</li>
													<li>
														<div class="cesta">
															<a href="carrinho/index.php" title="Essas são suas compras">
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
													<img src="imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
												</div>
											</a>
											<div class="footerSearchBar">
												<form action="pesquisa/">
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
												<a href="login/"><img id="user" src="" alt="Usuário"></a>
											</div>
											<div>
												<?php
                                                    if($logado)
                                                    {
                                                        ?><h2><a href="minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php
                                                    }
                                                    else
                                                    {
                                                        ?><h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2><?php 
                                                    } 
                                                ?>
											</div>
										</div>
									</li>
									<li>
										<div class="cesta">
											<a href="carrinho/index.php" title="Essas são suas compras">
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
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/footerMenu.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/search.js"></script>



</html>