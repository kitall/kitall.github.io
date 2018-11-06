<!DOCTYPE html>
<?php
session_start();

$kit = 0;

    //Teste de sessão
if (empty($_SESSION['user'])) {
    $_SESSION['buffer'] = "montekit";

    header("Location: ../login/");

    exit;
}

$carrinho = $_SESSION['carrinho'];
$logado = true;

$order = "nome";

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

    //Teste se adicionou algum produto
if (!empty($_POST['id'])) {
    if (!empty($_SESSION['kit'])) //ja existem produtos
    {
        array_push($_SESSION['kit_id'], (int)$_POST['id']);

        array_push($_SESSION['kit_nome'], $_POST['nome']);

        array_push($_SESSION['kit_preco'], (float)$_POST['preco']);

        $_SESSION['kit'] += 1;
    } else //criou o kit
    {
        $_SESSION['kit_id'] = array((int)$_POST['id']);

        $_SESSION['kit_nome'] = array($_POST['nome']);

        $_SESSION['kit_preco'] = array((float)$_POST['preco']);

        $_SESSION['kit'] = 1;
    }
}

    //Carrega o kit (se houver)
$tem_kit = false;
if (!empty($_SESSION['kit'])) {
    $tem_kit = true;
    $kit = $_SESSION['kit'];

    $kit_id = $_SESSION['kit_id'];
    $kit_nome = $_SESSION['kit_nome'];
    $kit_preco = $_SESSION['kit_preco'];
}


    //Produtos
include "../php/connect.php";

$sql = "SELECT * FROM p_produtos 
        WHERE excluido = 'f' AND qtd > 0 ORDER BY $order";
$res = pg_query($conectar, $sql);
$qtd = pg_num_rows($res);

if ($qtd <= 0) {
    $able = false;
    pg_close($conectar);
}
?>

<html>
<head>
    <title>Monte seu Kit</title>
    
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
						<li id="active">
							<a href="">Monte seu Kit</a>
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
                                <a href="../index.php">Home</a>
                            </li>
                            <li id="active">
                                <a href="">Monte seu Kit</a>
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
                <div class="kitContent">
                    <div class="kitTitle">
                        <h1>Monte seu Kit</h1>
                    </div>

                    <div class="kitKit">
                        <div class="kitKitView">
                            <div class="kitKitTitle">
                                <h3>Meu Kit</h3>
                            </div>

                            <div class="kitKitQtde">
                                <p><?php 
                                    echo "$kit ";
                                    if ($kit > 1) echo "itens";
                                    else echo "item"; ?></p>
                            </div>

                            <div class="kitKitBtn" onclick="kitDropdown()">
                                <p class="kitKitBtnP">▼</p>
                            </div>
                        </div>
                        <div class="kitKitDrop">
                            <div class="kitKitDropContent">
                                <table class="kitKitProds">
                               <?php 
                                if ($tem_kit) {
                                    $subtotal = 0;
                                    $link_finaliza = "window.location.href='../php/kit_para_carrinho.php'";

                                    for ($i = 0; $i < $kit; $i++) {
                                        $nome = $kit_nome[$i];
                                        $preco = $kit_preco[$i];
                                        $id = $kit_id[$i];

                                        $subtotal += $preco;

                                        $link = "window.location.href='../php/remove_kit.php?remove=$i'";
                                        ?>
                                    <tr>
                                        <td class="p10 kitKitProdsRemover">
                                            <?php echo "<div class='trash icon' title='Remover $nome do Kit' onclick=" . $link . "></div>"; ?>
                                        </td>
                                        <td class="kitKitProdsNome p10">
                                            <?php echo $nome; ?>
                                        </td>
                                        <td class="p10">
                                            <?php echo "R$ $preco"; ?>
                                        </td>
                                    </tr>
                                <?php

                            } //for

                            ?>
                                    <tr>
                                        <td colspan="3" class="kitKitProdsHr kitKitProdsP0">
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p10">

                                        </td>

                                        <td class="kitKitProdsNome p10">
                                            Subtotal:
                                        </td>

                                        <td class="p10">
                                            <?php echo "R$ $subtotal"; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="p10">
                                            <div class="btnSubmit">
                                                <?php echo "<input type='submit' value='Finalizar Compra' onclick=" . $link_finaliza . ">"; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php

                            } else {
                                ?>
                                    <tr>
                                        <td colspan="3" class="p10">
                                            Nenhum produto no seu Kit!<br>:(
                                        </td>
                                    </tr>
                                <?php

                            }
                            ?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="kitOrder">
                        <form action="" id="frmOrder">
                            <select name="order" id="selOrder" onchange="frmOrderSubmit()">
                                <option value="alf" <?php if ($selorder) {
                                                        if ($getOrder == "alf") echo "selected";
                                                    } else echo "selected"; ?>>Ordem Alfabética</option>
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
                                   <form action="../montar_kit/index.php" method="post">
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
                                                <h4><?php echo "R$ $preco"; ?></h4>
                                            </div>

                                            <div class="kitProdBtnContent">
                                                <div class="btnSubmit">
                                                   <?php
                                                    echo "<input type='hidden' name='id' value='$id' class='sumido' readonly>";
                                                    echo "<input type='hidden' name='nome' value='$nome' class='sumido' readonly>";
                                                    echo "<input type='hidden' name='preco' value='$preco' class='sumido' readonly>";
                                                    ?>
                                                    <input type="submit" value="Adicionar ao Kit">
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
                                    <li id="active">
                                        <a href="">Monte seu Kit</a>
                                    </li>
                                    <li>
                                        <a href="../produtos/index.php">Produtos</a>
                                    </li>
                                    <li>
                                        <a href="../quem_somos/index.html">Quem Somos</a>
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
                                            <a href="../index.php">Home</a>
                                        </li>
                                        <li id="active">
                                            <a href="">Monte seu Kit</a>
                                        </li>
                                        <li>
                                            <a href="../produtos/index.php">Produtos</a>
                                        </li>
                                        <li>
                                            <a href="../quem_somos/index.html">Quem Somos</a>
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

<script type="text/javascript" src="../js/kit.js"></script>

</html>