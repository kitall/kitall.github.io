<!DOCTYPE html>
    
<?php
    session_start();

	$able = true;
	$ind = -1;
	$prod_padrao = array(
        array("Caderno de Anotações", "Anote tudo o que precisa ser transformado e melhorado.", "imgs/notebook.jpg"), 
	    array("Borracha de Lápis e Caneta", "Para corrigir os erros e aprender com eles.", "imgs/eraser.jpg"), 
	    array("Porta Post-It", "Aqui fica tudo o você precisa lembrar e fazer.", "imgs/postit.jpg")
    );

	$num_rand = array(0, 0, 0);
	try
	{
		include "php/connect_prod.php";
		
		$sql = "SELECT id FROM produtos WHERE excluido=FALSE
					ORDER BY RANDOM()
					LIMIT 3";

		$res = pg_query($conectar, $sql);
		$qtd = pg_num_rows($res);
		if ($qtd > 0) 
        {
			$i = 0;
			while ($prod = pg_fetch_array($res))
            {
				$num_rand[$i] = $prod['id'];
				$i++;
			}
		}
	}
    catch(Exception $e)
    {
    ?> 
       <script>
           alert("<?php echo $e->getMessage(); ?>");
        </script>
    <?php

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
													<a href="login/"><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/"
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
														<h2>3</h2>
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
									<h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
										<h2>3</h2>
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
							<button class="btnKitall bold">Kitall?</button>
						</div>
					</div>
				</div>
			</div>
			<div class="featProducts">
				<div class="featProductsContent">
					<div class="featProduct textOnLeft">
						<?php
							$ind++;
					if($able){
						$numm = $num_rand[$ind];
						$sql = "SELECT * FROM produtos WHERE id=$numm";

						$res = pg_query($conectar, $sql);
						$qtd = pg_num_rows($res);
						if ($qtd > 0) {
							while ($prod = pg_fetch_array($res)) {
								$nome = $prod['nome'];
								$descricao = $prod['descricao'];
								$link_img = $prod['link_img'];
							}
						} else {
							$nome = $prod_padrao[$ind][0];
							$descricao = $prod_padrao[$ind][1];
							$link_img = $prod_padrao[$ind][2];
						}
					}
					else{
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
							<?php

						?>
							<div class="featProductImg">
								<?php echo "<img src='$link_img' alt='300'>" ?>
							</div>
							<?php
						?>
					</div>
					<div class="featProduct textOnRight">
						<?php
						$ind++;
					if($able){
						$numm = $num_rand[$ind];
						$sql = "SELECT * FROM produtos WHERE id=$numm";

						$res = pg_query($conectar, $sql);
						$qtd = pg_num_rows($res);
						if ($qtd > 0) {
							while ($prod = pg_fetch_array($res)) {
								$nome = $prod['nome'];
								$descricao = $prod['descricao'];
								$link_img = $prod['link_img'];
							}
						} else {
							$nome = $prod_padrao[$ind][0];
							$descricao = $prod_padrao[$ind][1];
							$link_img = $prod_padrao[$ind][2];
						}
					}
					else{
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
							<?php echo "<img src='$link_img' alt='300'>" ?>
						</div>
					</div>
					<div class="featProduct textOnLeft">
						<?php
							$ind++;
						if($able){
							$numm = $num_rand[$ind];
							$sql = "SELECT * FROM produtos WHERE id=$numm";

							$res = pg_query($conectar, $sql);
							$qtd = pg_num_rows($res);
							if ($qtd > 0) {
								while ($prod = pg_fetch_array($res)) {
									$nome = $prod['nome'];
									$descricao = $prod['descricao'];
									$link_img = $prod['link_img'];
								}
							} else {
								$nome = $prod_padrao[$ind][0];
								$descricao = $prod_padrao[$ind][1];
								$link_img = $prod_padrao[$ind][2];
							}
						}
						else{
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
							<?php echo "<img src='$link_img' alt='300'>" ?>
						</div>
					</div>
				</div>
			</div>
			<div class="presentVideo">
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
																<a href="login/"><img id="user" src="" alt="Usuário"></a>
															</div>
															<div>
																<h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/"
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
																	<h2>3</h2>
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
												<h2><a href="login/" title="Entre em sua conta!">Entre</a> ou <a href="cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
													<h2>3</h2>
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
									<a href="" id="aface"><img src="imgs/facebook.png" id="face" alt="">
										<div></div>
									</a>
									<a href="" id="ainsta"><img src="imgs/instagram.png" id="insta" alt="">
										<div></div>
									</a>
									<a href="" id="atwitter"><img src="imgs/twitter.png" id="twitter" alt="">
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

</html>