<!DOCTYPE html>

<?php
    try 
    {
        $prod_name = $_GET['search'];
        
        include "../php/connect_prod.php";

        $sql = "SELECT * FROM produtos WHERE nome = '$prod_name' AND excluido = 'f'";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);

        if ($qtd <= 0) 
        {
            $sql = "SELECT * FROM produtos WHERE nome LIKE '%$prod_name%' AND excluido = 'f'";
            $res = pg_query($conectar, $sql);
            $qtd = pg_num_rows($res);

            if ($qtd <= 0) //erro
            {
                $state = 0;
                pg_close();
            } 
            else //similares
            {
                $state = 1;
                //Já está lá em baixo
//                while ($prod = pg_fetch_array($res)) 
//                {
//                    $id = $prod['id'];
//                    $nome = $prod['nome'];
//                    $preco = $prod['preco'];
//                    $qtd = $prod['qtd'];
//                    $link_img = $prod['link_img'];
//                }
            }
        } 
        else 
        {
            $state = 2;
            // $prod = pg_fetch_array($res);
            // $id = $prod['id'];
            // $nome = $prod['nome'];
            // $preco = $prod['preco'];
            // $qtd = $prod['qtd'];
            // $link_img = $prod['link_img'];
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
											<div class="entrar">
												<div>
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
									<h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
            
            <div class="catalogo">

                <?php 
                switch($state) 
                {
                    case 0:
                        ?>
                            <h1>Nenhum produto foi encontrado!</h1>
                            <br><br><br>
                            <h2>Tente novamente com outros termos</h2>

                            <h1 class="gig">:(</h1>
                        <?php
                        break;

                    case 1:
                        ?>
                        <div class="catalogoProds">
                            <div class="prods">
                                
                                <?php
                                while ($prod = pg_fetch_array($res)) 
                                {
                                    $id = $prod['id'];
                                    $nome = $prod['nome'];
                                    $preco = $prod['preco'];
                                    $qtd = $prod['qtd'];
                                    $link_img = $prod['link_img'];

                                    $emEstoque = $qtd > 0;

                                    ?>

                                    <div class="prod">
                                        <div class="prodImage">
                                            <div class="prodImg">
                                                <img src="<?php echo $link_img; ?>" alt="<?php echo $nome; ?>">
                                            </div>
                                        </div>
                                        <div class="prodText">
                                            <div class="prodTextContent">
                                                <div class="prodInfo">
                                                    <h3>
                                                    <?php echo $nome; ?>
                                                    </h3>
                                                    <div>
                                                    <?php echo $preco; ?>
                                                    </div>
                                                </div>
                                                <div class="prodBtn  <?php if ($emEstoque) echo "emEstoque";
                                                                    else echo "semEstoque"; ?>">
                                                    <a href="" class="standby"><?php if ($emEstoque) echo "EM ESTOQUE";
                                                                                else echo "INDISPONÍVEL"; ?></a>
                                                    <a href="" class="active"><?php if ($emEstoque) echo "COMPRAR";
                                                                                else echo "VISUALIZAR"; ?></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                }
                                ?>
                                 
                            </div>
                        </div>
                        <?php
                        pg_close();
                        break;

                    case 2:

                        ?> 
                            <script>
                                alert("A página de visualização individual ainda está sendo desenvolvida.\n\nAgradecemos a compreensão.");
                            </script>
                        <?php

                        header("Location: ../");

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
																<h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
												<h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href="../cadastro/" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../js/search.js"></script>

</html>