<!DOCTYPE html>
<?php
    $id = $_GET['id_prod'];

    session_start();
    
    //---------------------------------------------------

    $logado = false;
    if (!empty($_SESSION['user'])) //Teste de sessão
    {
        $logado = true;
        $carrinho = $_SESSION['carrinho'];
    }

    //------------------------------------------------

    include "../php/connect.php";

    $sql = "SELECT * FROM p_produtos WHERE id_prod=$id";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0) 
    {
        while ($prod = pg_fetch_array($res)) 
        {
            $nome = $prod['nome'];
            $descricao = $prod['descricao'];
            $link_img = $prod['link_img'];
            $preco = $prod['preco'];
            $qtd = $prod['qtd'];

            $_SESSION['id_venda'] = $prod['id_prod'];
            $_SESSION['preco_venda'] = $preco;
            $_SESSION['estoque_venda'] = $qtd;
            $_SESSION['nome_venda'] = $nome;
            $_SESSION['link_venda'] = $link_img;
        }
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
    <link rel="stylesheet" href="../css/produto.css">

	<title>Adicionar ao carrinho?</title>
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
							<a href="../quem_somos/">Monte seu Kit</a>
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
<form action="../carrinho/index.php" method="post">

			<div class="produto">
        <div class="produtoContent">
            <div class="produtoImg">
                <div class="produtoImgContent">
                    <?php
                        echo "<img src='$link_img' alt=''>";
                        //echo "<img src='$link_img' alt=''>";
                    ?>
                </div>
            </div>

            <div class="produtoName">
                <div class="produtoNameContent">
                    <div><?php echo $nome; ?></div>
                </div>
            </div>

            <div class="produtoPreco">
                <div class="produtoPrecoContent">
                    <div class="prodPrice">
						<?php
                            echo "<br>R$  $preco";
                        ?>
                    </div>
                </div>
            </div>

            <div class="produtoQtde">
				<?php
					if($qtd >= 1){
						?>
						<div class="produtoQtdeContent">
							<div>
								<b>Quantidade:</b>
							</div>
							<div class="produteQtdeInput">
								<?php
									echo "<input type='number' name='qtd' max='$qtd' min='1' size='10' required>"; 
								?>
							</div>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="produtoQtdeContent">
							<div>
								<h3>Produto indisponível! :(</h3>
							</div>
						</div>
						<?php
					}
					?>
                
            </div>

            <div class="produtoFinalizar">
                <div class="produtoFinalizarContent">
                    <div class="btnSubmit">
                        <?php 
                            if($qtd >= 1) 
                            {
                                echo "<input type='submit' name='subProduto' value='Adicionar ao Carrinho'>";
							}
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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
										<a href="../produtos/>Produtos</a>
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