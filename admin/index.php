<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="../css/admin.css">
	<link rel="stylesheet" href="../css/footer.css">
	
	<link rel="icon" type="image/png" href="../favicon.png">
	<link rel="manifest" href="../manifest.json">

	<title>Kitall? Administrativo</title>
</head>

<body>
	<div class="main">
		<div class="index-struct">
			<div class="header" id="topo">
				<div class="logo">
					<a href="../">
						<img src="../imgs/KITALL.png" alt="Kitall?">
					</a>
				</div>

				<div class="menu show">
					<ul>
						<li id="active">
							<a href="">Estoque</a>
						</li>
						<li>
							<a href="cadastro/">Cadastro de Produtos</a>
						</li>
						<li>
							<a href="capital/">Aquisição / Integralização</a>
						</li>
						<li>
                            <a href="estatisticas/index.php">Estatísticas</a>
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
                                <a href="">Estoque</a>
                            </li>
                            <li>
                                <a href="cadastro/">Cadastro de Produtos</a>
                            </li>
                            <li>
                                <a href="capital/">Aquisição / Integralização</a>
                            </li>
                            <li>
                                <a href="estatisticas/">Estatísticas</a>
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
												<a href="../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa">
                                                   <img src="../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
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
                                <a href="../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa" class="img_relatorio">
                                   <img src="../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
                                </a>
                            </div>
                        </li>
                    </ul>
				</div>				
			</div>
			
			<div class="featProducts">
				<div class="prod_admin_mom">
                    <?php
                    include "../php/connect.php";

                    $sql = "SELECT * FROM p_produtos ORDER BY id_prod;";
                    $res = pg_query($conectar, $sql);
                    $qtd = pg_num_rows($res);
                    if($qtd > 0)
                    {
                        $i = 1;
                        while ($prod = pg_fetch_array($res)) 
                        {
                            //Salva as propriedades do produto
                            $id = $prod['id_prod'];
                            $nome = $prod['nome'];
                            $preco = $prod['preco'];
                            $custo = $prod['custo'];
                            $qtd = $prod['qtd'];
                            $descricao = $prod['descricao'];
                            $link_img = $prod['link_img'];
                            $excluido = $prod['excluido'];
                            
                            //Salva suas propriedades para enviar para a alteração
                            $to_send = "id=$id&nome=$nome&qtd=$qtd&preco=$preco&excluido=$excluido&descricao=$descricao&custo=$custo&link_img=$link_img";
                                    //não pode tabular porque ele envia os espaços do tab

                            //Mostra o produto
                            echo "<div class='prod_admin'><center><a href='alteracao/index.php?".$to_send."'>
                                <img src='".$link_img."' width='250' height='250'>
                                  </center></a>";
                            echo "<br><b>Codigo</b> = ".$id;
                            echo "<br><b>Nome</b> = ".$nome;
                            echo "<br><b>Preco</b> = ".$preco;
                            echo "<br><b>Custo</b> = ".$custo;
                            echo "<br><b>Estoque</b> = ".$qtd;
                            echo "<br><b>Descrição</b> = <i>".$descricao."</i>";
                            if($excluido == "t")
                                echo "<br><b>Excluido</b> = Sim";
                            else
                                echo "<br><b>Excluido</b> = Nao";
                            
                            echo "</div>";
                        }
                    }
                    else
                    {
                        echo "Nao foi encontrado nenhum produto! :(";
                        exit;
                    }
                ?>
				</div>
			</div>
			
			<div class="footer">
				<div class="footerContent">
					<div class="footerMenu">
						<div class="footerMenuContent">
							<div class="menuFooter show">
								<ul>
                                   <li>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   </li>
                                    <li id="active">
                                        <a href="">Estoque</a>
                                    </li>
                                    <li>
                                        <a href="cadastro/">Cadastro de Produtos</a>
                                    </li>
                                    <li>
                                        <a href="capital/">Aquisição / Integralização</a>
                                    </li>
                                    <li>
                                        <a href="estatisticas/">Estatísticas</a>
                                    </li>
                                </ul>
							</div>

							<div class="menuFooterMobile showMobile">
								<button class="menuFooterMobileButton" onclick="menuFooterDropdown()">
									▲
								</button>

								<div class="menuFooterMobileContent_dois">
									<ul>
										<li id="active">
                                            <a href="">Estoque</a>
                                        </li>
                                        <li>
                                            <a href="cadastro/">Cadastro de Produtos</a>
                                        </li>
                                        <li>
                                            <a href="capital/">Aquisição / Integralização</a>
                                        </li>
                                        <li>
                                            <a href="estatisticas/">Estatísticas</a>
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
                                                        <a href="../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa">
                                                           <img src="../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
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
                                            <a href="../php/generate_pdf.php" target="_blank" title="Fluxo de Caixa" class="img_relatorio">
                                               <img src="../imgs/estatisticas.png" id="relatorio" alt="Relatorio" height="50px">
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
</html>