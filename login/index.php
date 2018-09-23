<!DOCTYPE html>

<?php
	session_start();
	try
	{
		include "../php/connect_compartilhado.php";

		if(isset($_POST['subLogin'])){
			$user = $_POST['user'];
			$pass = $_POST['senha'];
	
			if(strpos($user, '@')){
				$searchcolumn = "email";
			}
			else{
				$searchcolumn = "login";
			}
	
			$sql = "SELECT * FROM usuario WHERE $searchcolumn = '$user'";
				
			$res = pg_query($conectar, $sql);
			$lin = pg_num_rows($res);
			if($lin > 0)
			{
				$userbd = pg_fetch_array($res);
				$senha = $userbd['senha'];
				
				if($senha == md5($pass))
				{
					$_SESSION['user'] = $user;
					$_SESSION['senha'] = $senha;
	
					header("Location: ../profile");
				}
				else
				{
					?> <script>
						alert("Senha incorreta!");
					</script>
					<?php
				}
			}
			else
			{
				pg_close($conectar);
				?> <script>
					alert("Usuário inexistente!");
				</script>
				<?php
			}
		}
	} catch(Exception $e) {
		?> <script>
			alert(<?php echo $e->getMessage(); ?>);
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

	<title>Faça seu Login</title>
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
											<div class="entrar">
												<div>
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<h2><a href="" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/index.html" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
									<a href=""><img id="user" src="" alt="Usuário"></a>
								</div>
								<div>
									<h2><a href="" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/index.html" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
			<div class="login">

				<div class="loginContent">
					<h3>Entre em sua conta</h3>
					<form action="" method="post">
						<div class="signin">
							<div class="username">
								<div>
									<label>Usuário ou email</label>
								</div>
								<div>
									<input type="text" name="user">
								</div>
							</div>
							<div class="password">
								<div class="lblSenha">
									<label for="">Senha</label>
									<label for="" id="recu" tabindex="-1"><a href="" tabindex="-1">Esqueceu sua senha?</a></label>
								</div>
								<div>
									<input type="password" name="senha">
								</div>
							</div>
							<div class="btnLogin">
								<input type="submit" name="subLogin" value="Entrar">
							</div>
						</div>
					</form>
					<div class="signup">
						<h4>Novo aqui? <a href="../cadastro/index.html">Crie sua conta</a></h4>

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
											<a href="../index.html">Home</a>
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
																<h2><a href="" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/index.html" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
												<a href=""><img id="user" src="" alt="Usuário"></a>
											</div>
											<div>
												<h2><a href="" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/index.html" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
<script type="text/javascript" src="../js/header.js"></script>
<script type="text/javascript" src="../js/footerMenu.js"></script>
<link rel="manifest" href="../config/manifest.json">
<script src="../config/app.js"></script>

</html>