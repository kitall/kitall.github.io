<!DOCTYPE html>

<?php
session_start();

$logado = false;
$state = 0;
$order = "nome";

$getOrder = " ";

$selorder = false;

$link_venda = "../venda/index.php?id_prod=";

if (isset($_GET['order'])) {
	$getOrder = $_GET['order'];

	if ($getOrder == "alf") {
		$order = "nome";
	} else if ($getOrder == "men") {
		$order = "preco ASC";
	} else {
		$order = "preco DESC";
	}

	$selorder = true;
}

if (!empty($_SESSION['user'])) //Teste de sessão
{
	$logado = true;
	$carrinho = $_SESSION['carrinho'];
}

try {
	$prod_name = $_GET['search'];

	$lower_prod_name = strtolower($prod_name);

	include "../php/connect.php";

	$sql = "SELECT * FROM p_produtos WHERE lower(nome) = '$lower_prod_name' AND excluido = 'f'";
	$res = pg_query($conectar, $sql);
	$qtd = pg_num_rows($res);

	if ($qtd <= 0) {
		$sql = "SELECT * FROM p_produtos WHERE lower(nome) LIKE '%$lower_prod_name%' AND excluido = 'f' ORDER BY $order";
		$res = pg_query($conectar, $sql);
		$qtd = pg_num_rows($res);

		if ($qtd <= 0) {
                //ERRO
			$state = 0;

			pg_close($conectar);
		} else {
                //Pesquisa por Similaridade
			$state = 1;
		}
	} else {
            //Pesquisa Específica 
		$state = 1;
	}
} catch (Exception $e) {
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
	<link rel="stylesheet" href="../css/kit.css">

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
							<a href="../">Home</a>
						</li>
						<li>
							<a href="../montar_kit/">Monte seu Kit</a>
						</li>
						<li>
							<a href="../produtos/">Produtos</a>
						</li>
						<li>
							<a href="../quem_somos/">Quem Somos</a>
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
								<a href="../">Home</a>
							</li>
							<li>
								<a href="../montar_kit/">Monte seu Kit</a>
							</li>
							<li>
								<a href="../produtos/">Produtos</a>
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
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<?php
												if ($logado) {
													?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php

																																																																																																											} else {
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
														echo "<h2>" . $carrinho . "</h2>";
													} else {
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
								if ($logado) {
									?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php

																																																																																																							} else {
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
										echo "<h2>" . $carrinho . "</h2>";
									} else {
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
				<div class="kit">
				<?php 
			switch ($state) {
				case 0:
						// nenhum produto encontrado

					?>

						 <div class="kitContent">
            				<div class="kitTitle">
								<h1>Nenhum produto encontrado</h1>
								<h2>para a pesquisa de "<?php echo $prod_name; ?>"</h2>
								<h1>:C</h1>
							</div>
						</div>

						<?php
					break;

				case 1:
					?>
						<div class="kitContent">
							<div class="kitTitle">
								<h1>Produtos encontrados</h1>
								<h2>para a pesquisa de "<?php echo $prod_name; ?>"</h2>
							</div>

							<div class="prodsKit">
							</div>

							<div class="kitOrder">
								<form action="" id="frmOrder">
									<select name="order" id="selOrder" onchange="frmOrderSubmit()">
										<option value="alf" <?php if ($selorder && $getOrder == "alf") echo "selected"; ?>>Ordem Alfabética</option>
										<option value="men" <?php if ($selorder && $getOrder == "men") echo "selected"; ?>>Menor Preço ↑</option>
										<option value="mai" <?php if ($selorder && $getOrder == "mai") echo "selected"; ?>>Maior Preço ↓</option>
									</select>
								</form>
							</div>

							<div class="kitCatalogo">
								<div class="kitProds">
									<?php
								while ($prod = pg_fetch_array($res)) {
									$id = $prod['id_prod'];
									$nome = $prod['nome'];
									$preco = $prod['preco'];
									$qtd = $prod['qtd'];
									$link_img = $prod['link_img'];

									?> 
									<div class="kitProd">
										<!-- <form action="../montar_kit/" method="post"> -->
										<form action="../venda/" method="get">
											<div class="kitProdImage">
												<?php echo "<img src='$link_img' alt='$nome'>"; ?> 
											</div>
											<div class="kitProdText">
												<div class="kitProdInfo">
													<h3>
														<?php echo $nome; ?> 
													</h3>
												</div>

												<div class="kitProdPrice">
													<h4>
														<?php echo "R$ $preco"; ?> 
													</h4>
												</div>

												<div class="kitProdBtnContent">
													<div class="btnSubmit">
														<?php
													echo "<input type='hidden' name='id_prod' value='$id' class='sumido' readonly>";
															//echo "<input type='hidden' name='nome' value='$nome' class='sumido' readonly>";
															//echo "<input type='hidden' name='preco' value='$preco' class='sumido' readonly>";
													?> 
														<input type="submit" value="Comprar">
													</div>
												</div>
											</div>
										</form>
									</div>
									<?php 
							} ?> 
								</div>
							</div>
						</div>
						<?php
					break;
			}
			?>
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
										<a href="../montar_kit/">Monte seu Kit</a>
									</li>
									<li>
										<a href="../produtos/">Produtos</a>
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
											<a href="../montar_kit/">Monte seu Kit</a>
										</li>
										<li>
											<a href="../produtos/">Produtos</a>
										</li>
										<li>
											<a href="../quem_somos/">Quem Somos</a>
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
															if ($logado) {
																?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php

																																																																																																														} else {
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
																	echo "<h2>" . $carrinho . "</h2>";
																} else {
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
											if ($logado) {
												?><h2><a href="../minha_conta/" title="Minha conta."> <?php echo $_SESSION['user']; ?> </a></h2><?php

																																																																																																										} else {
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
													echo "<h2>" . $carrinho . "</h2>";
												} else {
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
								<h2>Entre em Contato!</h2>
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