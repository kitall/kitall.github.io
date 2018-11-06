<?php
session_start();

if (empty($_SESSION['user'])) {
    header("Location: ../../");

    exit;
}

$logado = true;

$id = $_SESSION['user_id'];
$user = $_SESSION['user'];
$email = $_SESSION['email'];

    //---------------------------------------------------------

include("../../php/connect.php");
    
    //Pegar os dados do Cliente
$sql = "SELECT * FROM c_cliente
        WHERE id_usuario='$id';";
$res = pg_query($conectar, $sql);
$qtd = pg_num_rows($res);
if ($qtd > 0) {
    while ($usuario = pg_fetch_array($res)) {
        $nome = $usuario['nome'];
        $sobrenome = $usuario['sobrenome'];
        $sexo = $usuario['sexo'];
        $data_nsac = $usuario['data_nasc'];
        $celular = $usuario['celular'];
    }
} else {
    echo "Erro no SELECT dados do cliente!";
    pg_close($conectar);
    exit;
}

    //Pegar os dados do Endereço
$endereco = false;

$sql = "SELECT * FROM c_endereco
        WHERE id_usuario='$id';";
$res = pg_query($conectar, $sql);
$qtd = pg_num_rows($res);
if ($qtd > 0) {
    $endereco = true;

    while ($ender = pg_fetch_array($res)) {
        $endereco_select = $ender['endereco'];
        $numero = $ender['numero'];
        $complemento = $ender['complemento'];
        $bairro = $ender['bairro'];
        $cep = $ender['cep'];
        $cidade = $ender['cidade'];
        $estado = $ender['estado'];
        $pais = $ender['pais'];
    }
} else {
    pg_close($conectar);
}
?>

<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/presentation.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/search.css">
    <link rel="stylesheet" href="../../css/perfil.css">
    <link rel="stylesheet" href="../../css/kit.css">
    <link rel="stylesheet" href="../../css/cadastro.css">
    
    <title>Edite seu Perfil</title>
</head>

<body>
<div class="main">
		<div class="index-struct">

			<div class="header" id="topo">
				<div class="logo">
					<a href="../../index.php">
						<img src="imgs/KITALL.png" alt="Kitall?">
					</a>
				</div>

				<div class="menu show">
					<ul>
						<li>
							<a href="../../">Home</a>
						</li>
						<li>
							<a href="../../montar_kit/">Monte seu Kit</a>
						</li>
						<li>
							<a href="../../produtos/">Produtos</a>
						</li>
						<li>
							<a href="../../quem_somos/">Quem Somos</a>
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
								<a href="../../">Home</a>
							</li>
							<li>
								<a href="../../montar_kit/">Monte seu Kit</a>
							</li>
							<li>
								<a href="../../produtos/">Produtos</a>
							</li>
							<li>
								<a href="../../quem_somos/">Quem Somos</a>
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
											<div class="entrar" <?php if ($logado) echo 'style="grid-template-columns:1fr 2fr;"' ?>>
												<div>
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<?php
            if ($logado) {
                ?><h2><a href="../" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php

                                                                                                                                            } else {
                                                                                                                                                echo "Erro!";
                                                                                                                                            }
                                                                                                                                            ?>
												</div>
											</div>
										</li>
										<li>
											<div class="cesta">
												<a href="../../carrinho/index.php" title="Essas são suas compras">
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
										<img src="../../imgs/search_icon.png" id="search" alt="Pesquisa" title="Clique aqui para pesquisar algo!">
									</div>
								</a>
								<div class="searchBar">
									<form action="../../pesquisa/">
										<div class="searchField">
											<input type="search" name="search" class="searchInput" placeholder="Pesquise" required>
										</div>
										<div class="searchSubmit">
											<button type="submit" id="subSearchBtn" title="Pesquisar!"><img src="../../imgs/search_icon.png" alt="" id="search"></button>
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
            ?><h2><a href="../" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php

                                                                                                                            } else {
                                                                                                                                echo "Erro!";
                                                                                                                            }
                                                                                                                            ?>
								</div>
							</div>
						</li>
						<li>
							<div class="cesta">
								<a href="../../carrinho/index.php" title="Essas são suas compras">
									<div>
										<img src="../../carrinho/index.php" id="cesta" alt="Cesta">
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
            
            <div class="double_row_grid">
                <div class="perfilPresent">
                    <div class="perfilPresentContent">
                        <div class="presentName">
                            <div class="presentNameContent">
                                <p>Logado como:</p>
                                <?php echo "<h2>$user</h2>"; ?>
                            </div>
                        </div>

                        <div class="presentEmail">
                            <div class="presentEmailContent">
                                <?php echo "<h4>$email</h4>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cadastro">
                    <div class="cadastroContent">
                        <form action="../../php/alt_cad.php" method="post" id="cadastro">
                            <div class="campos">
                                <h1>Edite sua conta</h1>

                                <div class="logGroup">
                                    <h2>Dados Pessoais</h2>
                                    <hr>

                                    <div class="campo">
                                        <div>
                                            <div class="lblCampo"><label>Nome*</label></div>
                                        </div>
                                        <?php echo "<input type='text' name='nome' placeholder='ex.: Albert' autofocus maxlength='30'
                                            required title='Insira seu nome!' value='$nome'>"; ?>
                                        <div class="descCampo" id="nome">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="campo">
                                        <div>
                                            <div class="lblCampo"><label>Sobrenome*</label></div>
                                        </div>
                                        <?php echo "<input type='text' name='sobrenome' placeholder='ex.: Einstein' maxlength='40' required
                                            title='Insira seu sobrenome!' value='$sobrenome'>"; ?>
                                        <div class="descCampo" id="sobrenome">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="campo">
                                        <div>
                                            <div class="lblCampo"><label>Sexo*</label></div>
                                        </div>
                                        <br>
                                        <div class="selectSexo" title="Insira seu sexo!">
                                        <?php 
                                        if ($sexo == 'M') { ?>
                                            <input type="radio" name="sexo" value="M" id="sexoM" required checked><label for="sexoM">Masculino</label>
                                            <input type="radio" name="sexo" value="F" id="sexoF"><label for="sexoF">Feminino</label>
                                            <input type="radio" name="sexo" value="N" id="sexoN"><label for="sexoN">Prefiro
                                                não dizer</label>
                                        <?php 
                                    } else if ($sexo == 'F') { ?>
                                            <input type="radio" name="sexo" value="M" id="sexoM" required><label for="sexoM">Masculino</label>
                                            <input type="radio" name="sexo" value="F" id="sexoF" checked><label for="sexoF">Feminino</label>
                                            <input type="radio" name="sexo" value="N" id="sexoN"><label for="sexoN">Prefiro
                                                não dizer</label>
                                        <?php 
                                    } else { ?>
                                            <input type="radio" name="sexo" value="M" id="sexoM" required><label for="sexoM">Masculino</label>
                                            <input type="radio" name="sexo" value="F" id="sexoF"><label for="sexoF">Feminino</label>
                                            <input type="radio" name="sexo" value="N" id="sexoN" checked><label for="sexoN">Prefiro
                                                não dizer</label>
                                        <?php 
                                    } ?>
                                        </div>
                                        <div class="descCampo" id="sexo">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="campo">
                                        <div>
                                            <div class="lblCampo"><label>Data de Nascimento*</label></div>
                                        </div>
                                        <?php echo "<input type='date' name='data_nasc' max='2018-10-08' min='1910-01-01' maxlenght='10'
                                            required title='Insira sua data de nascimento!' value='$data_nsac'>"; ?>
                                        <div class="descCampo" id="data_nasc">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="campo">
                                        <div>
                                            <div class="lblCampo"><label>Celular ou Telefone*</label></div>
                                        </div>
                                        <?php echo "<input type='text' name='celular' placeholder='ex.: 14987626754' required title='Insira seu número de celular ou telefone!'
                                            value='$celular''>"; ?>
                                        <div class='descCampo' id='celular'>
                                            <p>Insira sem qualquer formatação.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="logGroup contato">
                                    <h2>Informações de Entrega</h2>
                                    <hr>

                                    <div class="double_31_grid">
                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Endereço</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='endereco' placeholder='ex.: R. João de Barro' title='Insira a rua ou avenida de sua casa!' 
                                                value='$endereco_select'>"; ?>
                                            <div class="descCampo" id="endereco">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Número</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='numero' placeholder='ex.: 10-21' title='Insira o número de sua casa!' 
                                                value='$numero'>"; ?>
                                            <div class="descCampo" id="numero">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="double_11_grid">
                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Complemento</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='complemento' placeholder='ex.: Portão 3, Apto. 12' title='Insira, se houver, o complemento de seu endereço!'
                                                value='$complemento'>"; ?>
                                            <div class="descCampo" id="complemento">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Bairro</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='bairro' placeholder='ex.: Jardim dos Pinheiros' title='Insira seu bairro!'
                                                value='$bairro'>"; ?>
                                            <div class="descCampo" id="bairro">
                                                <p></p>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="double_21_grid">
                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Cidade</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='cidade' placeholder='ex.: Bauru' title='Insira sua cidade!'
                                                value='$cidade'>"; ?>
                                            <div class="descCampo" id="cidade">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>CEP</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='cep' placeholder='ex.: 11235-813' title='Insira seu CEP!'
                                                value='$cep'>"; ?>
                                            <div class="descCampo" id="cep">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="double_12_grid">
                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>Estado</label></div>
                                            </div>
                                            <select name="estado" title="Insira seu estado!">
                                                <option value="" disabled>Unidade Federativa</option>
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                                <option value="AP">Amapá</option>
                                                <option value="AM">Amazonas</option>
                                                <option value="BA">Bahia</option>
                                                <option value="CE">Ceará</option>
                                                <option value="DF">Distrito Federal</option>
                                                <option value="ES">Espirito Santo</option>
                                                <option value="GO">Goiás</option>
                                                <option value="MA">Maranhão</option>
                                                <option value="MT">Mato Grosso</option>
                                                <option value="MS">Mato Grosso do Sul</option>
                                                <option value="MG">Minas Gerais</option>
                                                <option value="PA">Pará</option>
                                                <option value="PB">Paraíba</option>
                                                <option value="PR">Paraná</option>
                                                <option value="PE">Pernambuco</option>
                                                <option value="PI">Piauí</option>
                                                <option value="RJ">Rio de Janeiro</option>
                                                <option value="RN">Rio Grande do Norte</option>
                                                <option value="RS">Rio Grande do Sul</option>
                                                <option value="RO">Rondônia</option>
                                                <option value="RR">Roraima</option>
                                                <option value="SC">Santa Catarina</option>
                                                <?php echo "<option value='SP' selected>São Paulo</option>"; ?>
                                                <option value="SE">Sergipe</option>
                                                <option value="TO">Tocantins</option>
                                            </select>
                                            <div class="descCampo" id="estado">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="campo">
                                            <div>
                                                <div class="lblCampo"><label>País</label></div>
                                            </div>
                                            <?php echo "<input type='text' name='pais' placeholder='ex.: Brasil' title='Insira seu país!'
                                                value='$pais'>"; ?>
                                            <div class="descCampo" id="pais">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div>
                                    <label class="qMarkText">
                                        <label class="qMarkContent" id="showContato">?</label>
                                    </label>
                                <?php if ($endereco) { ?>
                                    <label href="" class="lblCampo showContato" onclick="showContatoAlt()">Suas Informações Entrega:</label>
                                <?php 
                            } else { ?>
                                    <label href="" class="lblCampo showContato" onclick="showContatoAlt()">Deseja preencher as
                                        Informações de Entrega?</label>
                                    <label class="moreInfo" id="moreShowContato">
                                        Você pode preenchê-las quando for finalizar a compra, se preferir.
                                    </label>
                                <?php 
                            } ?>
                                </div>

                                <input type="hidden" name="isContatoShown" id="isContatoShown">

                                <div class="logGroup">
                                    <div class="btnCadastro">
                                        <input type="submit" name="subCadastro" value="Atualizar meus dados">
                                    </div>
                                    <div class="btnCadastro2">
                                        <input type="button" name="subCadastro" value="Cancelar / Voltar" onclick="window.location.href='../'">
                                    </div>
                                </div>
                            </div>
                        </form>
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
										<a href="../../index.php">Home</a>
									</li>
									<li>
										<a href="../../montar_kit/">Monte seu Kit</a>
									</li>
									<li>
										<a href="../../produtos/">Produtos</a>
									</li>
									<li>
										<a href="../../quem_somos/">Quem Somos</a>
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
											<a href="../../">Home</a>
										</li>
										<li>
											<a href="../../montar_kit/">Monte seu Kit</a>
										</li>
										<li>
											<a href="../../produtos/">Produtos</a>
										</li>
										<li>
											<a href="../../quem_somos/">Quem Somos</a>
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
                    ?><h2><a href="../" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php

                                                                                                                                                        } else {
                                                                                                                                                            echo "Erro!";
                                                                                                                                                        }
                                                                                                                                                        ?>
															</div>
														</div>
													</li>
													<li>
														<div class="cesta">
															<a href="../../carrinho/index.php" title="Essas são suas compras">
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
												<form action="../../pesquisa/">
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
                ?><h2><a href="../" title="Minha conta."><?php echo $_SESSION['user']; ?></a></h2><?php

                                                                                                                                        } else {
                                                                                                                                            echo "Erro!";
                                                                                                                                        }
                                                                                                                                        ?>
											</div>
										</div>
									</li>
									<li>
										<div class="cesta">
											<a href="../../carrinho/index.php" title="Essas são suas compras">
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
<script type="text/javascript" src="../../js/main.js"></script>

</html>