<!DOCTYPE html>

<?php
    session_start();

	$logado = false;
	if (!empty($_SESSION['user'])) //Teste de sessão
    {
        $logado = true;
        $carrinho = $_SESSION['carrinho'];
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
	<link rel="stylesheet" href="../css/sobre.css">

	<title>Quem Somos</title>
</head>

<body>

	<div class="main">
		<div class="basic-struct">

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
							<a href="../montar_kit/">Monte seu Kit</a>
						</li>
						<li>
							<a href="../produtos/">Produtos</a>
						</li>
						<li id="active">
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
								<a href="../montar_kit/">Monte seu Kit</a>
							</li>
							<li>
								<a href="../produtos/">Produtos</a>
							</li>
							<li id="active">
								<a href="">Quem Somos</a>
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
												<a href="../carrinho/" title="Essas são suas compras">
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
									<form action="../pesquisa/">
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
								<a href="../carrinho/" title="Essas são suas compras">
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
            
			<div class="sobre">
				<div class="sobreContent">
					<div class="sobreTitle">
						<div class="sobreTitleContent">
							<h1>Quem Somos</h1>
						</div>
					</div>

					<div class="sobreTxt">
						<div class="sobreTxtContent">
							<p class="desc">
								O objetivo da Kitall? é aprender com cada desafio e oferecer os melhores resultados possíveis. Nos interessamos pelo aprimoramento dos processos e da comunicação em equipe, sempre aprendendo com nossos erros e resolvendo problemas de forma racional e criativa.
							</p>
							<p>
								As Canetas, os Blocos de Notas, os Portas Post-Its, e todos os outros produtos são comprados com os melhores fornecedores e guardados com o melhor cuidado, garantindo a praticidade e a qualidade dos produtos que você compra aqui, com a gente!
							</p>
							<p class="catch">
								Produtos simples, mas não simplórios, vendidos de maneira prática, mas não breve, com um atendimento atencioso, mas não insistente.
							</p>

						</div>
					</div>

					<div class="sobreImg">
						<div class="sobreImgContent">
							<img src="../imgs/equipe.jpg" alt="">
							<p><b>A equipe Kitall?</b><br>André, Bella, Carolina, Estevão e Marcos (da esquerda à direita)</p>
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
										<a href="../">Home</a>
									</li>
									<li>
										<a href="../montar_kit/">Monte seu Kit</a>
									</li>
									<li>
										<a href="../produtos/">Produtos</a>
									</li>
									<li id="active">
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
											<a href="../montar_kit/">Monte seu Kit</a>
										</li>
										<li>
											<a href="../produtos/">Produtos</a>
										</li>
										<li id="active">
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
												<form action="../pesquisa/">
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