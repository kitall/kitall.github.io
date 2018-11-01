<!DOCTYPE html>
<?php
    session_start();

    $link_venda = "../venda/index.php";

    //Login
    $logado = false;
    if(empty($_SESSION['user']))
    {
        header("Loation: ../login/");
        exit;
    }

    $logado = true;
    $login_usr = $_SESSION['user'];
    $login_email = $_SESSION['email'];

    //Random product
    include("../php/connect.php");
    
    $sql = "SELECT * FROM p_produtos 
        WHERE excluido=FALSE AND qtd>0
        ORDER BY RANDOM() LIMIT 1";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0) 
    {
        while ($prod = pg_fetch_array($res)) 
        {
            $rand_nome = $prod['nome'];
            $rand_preco = $prod['preco'];
            $rand_img = $prod['link_img'];
            $rand_id = $prod['id_prod'];
        }
        
        pg_close($conectar);
        
        $link_venda .= "?id_prod=$rand_id";
    }
    else
    {
        echo "Erro no SELECT!";
        pg_close($conectar);
        exit;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Meu Perfil</title>

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/presentation.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/kit.css">
    
    <link rel="icon" type="../image/png" href="favicon.png">
	<link rel="manifest" href="../manifest.json">
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
                                                            ?><h2><a href="" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php
                                                        }
                                                        else
                                                        {
                                                            echo "Erro!";
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
                                            ?><h2><a href="" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php
                                        }
                                        else
                                        {
                                            echo "Erro!";
                                        }
                                    ?>
								</div>
							</div>
						</li>
						<li>
							<div class="cesta">
								<a href="../carrinho/index.php" title="Essas são suas compras">
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
            
            <div class="perfil">
                <div class="perfilContent">
                    <div class="perfilPresent">
                        <div class="perfilPresentContent">
                            <div class="presentName">
                                <div class="presentNameContent">
                                    <p>Logado como:</p>
                                    <?php echo "<h2>$login_usr</h2>"; ?>
                                </div>
                            </div>

                            <div class="presentEmail">
                                <div class="presentEmailContent">
                                    <?php echo "<h4>$login_email</h4>"; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="perfilBottom">
                        <div class="perfilBottomContent">
                            <div class="perfilProd">
                                <div class="perfilProdContent">
                                    <div class="perfilProdTitle">
                                        <h3>Produto Especial pra Você!</h3>
                                    </div>
                                    <div class="perfilProds">
                                        <div class="kitCatalogo">
                                            <div class="kitProdPerfil">
                                                <div class="kitProdImage">
                                                    <?php echo "<img src='$rand_img' alt='$rand_nome'>"; ?>
                                                </div>
                                                <div class="kitProdText">
                                                    <div class="kitProdInfo">
                                                        <h3>
                                                            <?php echo $rand_nome; ?>
                                                        </h3>
                                                    </div>

                                                    <div class="kitProdPrice">
                                                        <?php echo "<h4>R$ $rand_preco</h4>"; ?>
                                                    </div>

                                                    <div class="kitProdBtnContent">
                                                        <div class="btnSubmit">
                                                            <?php 
                                                                $link = "window.location.href='$link_venda'";
                                                            
                                                                echo "<input type='submit' value='Comprar' onclick=".$link.">";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="perfilOpts">
                                <div class="perfilOptsContent">
                                    <div class="perfilOptsTitle">
                                        <h3>Configurações</h3>
                                    </div>

                                    <div class="perfilOptsList">
                                        <li>
                                            <a href="editar_perfil/">Editar meu Perfil</a>
                                        </li>
                                        <li>
                                            <a href="../php/logout.php">Sair</a>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <br><br>

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
                                                                    if($logado)
                                                                    {
                                                                        ?><h2><a href="" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "Erro!";
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
                                                        ?><h2><a href="" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php
                                                    }
                                                    else
                                                    {
                                                        echo "Erro!";
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
</html>