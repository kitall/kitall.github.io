<?php
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $qtd = $_GET['qtd'];
    $preco = $_GET['preco'];
    $custo = $_GET['custo'];
    $descricao = $_GET['descricao'];
    $link_img = $_GET['link_img'];
    $excluido = $_GET['excluido'];
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    
	<link rel="stylesheet" href="../../css/admin.css">
	<link rel="stylesheet" href="../../css/footer.css">
	<link rel="stylesheet" href="../../css/alteracao.css">
	
	<link rel="icon" type="image/png" href="../../favicon.png">
	<link rel="manifest" href="../../manifest.json">

	<title>Alteração de Produto</title>
</head>
<body>

	<div class="main">
		<div class="index-struct">
            <div class="header" id="topo">
				<div class="logo">
					<a href="../../">
						<img src="../imgs/KITALL.png" alt="Kitall?">
					</a>
				</div>

				<div class="menu show">
					<ul>
						<li>
							<a href="../">Estoque</a>
						</li>
						<li>
							<a href="../cadastro/">Cadastro de Produtos</a>
						</li>
						<li>
							<a href="../capital/">Aquisição / Integralização</a>
						</li>
						<li>
                            <a href="../estatisticas/">Estatísticas</a>
                        </li>
					</ul>
				</div>

				<div class="menuMobile showMobile">
					<button class="menuMobileButton" onclick="menuDropdown(true)">
						▼
					</button>

					<div class="menuMobileContent">
						<ul>
							<li>
                                <a href="../">Estoque</a>
                            </li>
                            <li>
                                <a href="../cadastro/">Cadastro de Produtos</a>
                            </li>
                            <li>
                                <a href="../capital/">Aquisição / Integralização</a>
                            </li>
                            <li>
                                <a href="../estatisticas/">Estatísticas</a>
                            </li>
							<li id="btns">
								<div class="btns showBtnsMobile">
									<ul>
										<li>
											<div class="entrar">
												<div>
													<a href=""><img id="user" src="" alt="Usuário"></a>
												</div>
												<div>
													<h2><a href="">Administrador</a></h2>
												</div>
											</div>
										</li>
										<li>
											<div class="cesta">
												<a href="../../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa">
                                                   <img src="../../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
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
                            <div class="entrar">
                                <div>
                                    <a href=""><img id="user" src="" alt="Usuário"></a>
                                </div>
                                <div>
                                    <h2><a href="">Administrador</a></h2>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="cesta">
                                <a href="../../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa" class="img_relatorio">
                                   <img src="../../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
                                </a>
                            </div>
                        </li>
                    </ul>
				</div>				
			</div>
            
            <form action="../../php/alt_prod.php" method="post">
                <div class="produto">
                    <div class="produtoContent">
                       
                        <div class="produtoImg">
                            <div class="produtoImgContent">
                                <?php
                                    echo "<img src='$link_img' alt=''>";
                                ?>
                            </div>
                        </div>
                        
                        <div class="produtoID">
                            <div class="produtoIDContent">
                                <?php
                                    echo "ID: <input type='number' value='$id' name='id' readonly>";
                                ?>
                            </div>
                        </div>
                        
                        <div class="produtoName">
                            <div class="produtoNameContent">
                                <div>
                                    <?php echo "Nome: <input type='text' name='nome' value='$nome' class='texto1'>"; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="produtoQtde">
                            <div class="produtoQtdeContent">
                                <div>
                                    <?php echo "Quantidade: <input type='number' name='qtd' value='$qtd' class='numero'>" ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="produtoPreco">
                            <div class="produtoPrecoContent">
                                <div class="prodPrice">
                                    <?php echo "Preço (R$): <input type='number' name='preco' value='$preco' class='numero'>" ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="produtoCusto">
                            <div class="produtoCustoContent">
                                <div>
                                    <?php echo "Custo de Fabricação (R$): <input type='number' name='custo' value='$custo' class='numero'>" ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="produtoDescricao">
                            <div class="produtoDescricaoContent">
                                <div>
                                    <?php echo "Descrição: <input type='text' name='descricao' value='$descricao' class='texto2'>"; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="produtoLink">
                            <div class="produtoLinkContent">
                                <div>
                                    <?php echo "Link da imagem: <input type='text' name='link_img' value='$link_img' class='texto3'>"; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="produtoExcluido">
                            <div class="produtoExcluidoContent">
                                <div>
                                   Excluído? &nbsp;&nbsp;&nbsp;
                                    <div class="selectExclusao">
                                       <?php
                                            if($excluido == 'f' || $excluido == 'F')
                                            {
                                        ?>
                                            <input type="radio" name="exclusao" value="0" id="exNao" required checked><label for="exNao">Não</label>
                                            <input type="radio" name="exclusao" value="1" id="exSim"><label for="exSim">Sim</label>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                            <input type="radio" name="exclusao" value="0" id="exNao" required><label for="exNao">Não</label>
                                            <input type="radio" name="exclusao" value="1" id="exSim" checked><label for="exSim">Sim</label>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="produtoFinalizar">
                            <div class="produtoFinalizarContent">
                                <div class="btnSubmitDois">
                                   <input type='submit' name='subProduto' value='Alterar'>
                                   &nbsp;
                                   <button type="button" name="cancelaProduto" value="Cancelar" onclick="location.href='../';">Cancelar</button>
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
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   </li>
                                    <li>
                                        <a href="../">Estoque</a>
                                    </li>
                                    <li>
                                        <a href="../cadastro/">Cadastro de Produtos</a>
                                    </li>
                                    <li>
                                        <a href="../capital/">Aquisição / Integralização</a>
                                    </li>
                                    <li>
                                        <a href="../estatisticas/">Estatísticas</a>
                                    </li>
                                </ul>
							</div>

							<div class="menuFooterMobile showMobile">
								<button class="menuFooterMobileButton" onclick="menuFooterDropdown()">
									▲
								</button>

								<div class="menuFooterMobileContent_dois">
									<ul>
										<li>
                                            <a href="../">Estoque</a>
                                        </li>
                                        <li>
                                            <a href="../cadastro/">Cadastro de Produtos</a>
                                        </li>
                                        <li>
                                            <a href="../capital/">Aquisição / Integralização</a>
                                        </li>
                                        <li>
                                            <a href="../estatisticas/">Estatísticas</a>
                                        </li>
										<div class="btns showBtnsMobile">
                                            <ul>
                                                <li>
                                                    <div class="entrar">
                                                        <div>
                                                            <a href=""><img id="user" src="" alt="Usuário"></a>
                                                        </div>
                                                        <div>
                                                            <h2><a href="">Administrador</a></h2>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cesta">
                                                        <a href="../../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa">
                                                           <img src="../../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
									</ul>
								</div>
							</div>
							<div class="btns showBtns">
								<ul>
                                    <li>
                                        <div class="entrar">
                                            <div>
                                                <a href=""><img id="user" src="" alt="Usuário"></a>
                                            </div>
                                            <div>
                                                <h2><a href="">Administrador</a></h2>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cesta">
                                            <a href="../../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa" class="img_relatorio">
                                               <img src="../../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
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
								<h2>Acesso as Redes Sociais:</h2>
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
<!-- scripts deletados da pag de "Venda" -->
</html>