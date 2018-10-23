<!--
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ADM PAGE</title>
</head>
<body>
    <h1>Willkommen Sie!</h1>
    <p>Pagina dos admins queridos da 'kitall?'</p>
    <br>
    <table border="0">
        <tr>
            <td>
                <button onclick="window.location.href='estoque/'">Estoque</button>
            </td>
        </tr>
        <tr>
            <td>
                <button onclick="window.location.href='cadastro/'">Cadastro de Produtos</button>
            </td>
        </tr>
        <tr>
            <td>
                <button onclick="window.location.href='aquisicao/'">Aquisição de Produtos</button>
            </td>
            <td>
                <button onclick="window.location.href='integralizacao'">Integralização de Capital</button>
            </td>
        </tr>
        <tr>
            <td>
                <button onclick="window.location.href='../php/generate_pdf.php'">Relatório de Vendas</button>
            </td>
        </tr>
    </table>
    <br>
    <a href="../index.php">Go Back</a>
</body>
</html>
-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="../css/admin.css">
	
	<link rel="icon" type="image/png" href="../favicon.png">
	<link rel="manifest" href="../manifest.json">

	<title>Kitall Administrativo</title>
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
							<a href="../">Estoque</a>
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

				<div class="menuMobile showMobile">
					<button class="menuMobileButton" onclick="menuDropdown(true)">
						▼
					</button>

					<div class="menuMobileContent">
						<ul>
							<li id="active">
                                <a href="../">Estoque</a>
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
				<div class="featProductsContent">
                    <?php
                    include "../php/connect.php";

                    $sql = "SELECT * FROM p_produtos ORDER BY id_prod;";
                    $res = pg_query($conectar, $sql);
                    $qtd = pg_num_rows($res);
                    if($qtd > 0)
                    {
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

                            //Mostra o produto
                            echo "<div><img src='".$link_img."' width='250' height='250'>";
                            echo "<br><b>Codigo</b> = ".$id;
                            echo "<br><b>Nome</b> = ".$nome;
                            echo "<br><b>Preco</b> = ".$preco;
                            echo "<br><b>Custo</b> = ".$custo;
                            echo "<br><b>Estoque</b> = ".$qtd;
                            echo "<br><b>Descrição</b> = <i>".$descricao."</i>";
                            if($excluido == "t")
                                echo "<br>Excluido = Sim";
                            else
                                echo "<br>Excluido = Nao";

                            //Salva suas propriedades para enviar para a alteração
                            $to_send = "id=$id&nome=$nome&qtd=$qtd&preco=$preco&excluido=$excluido&descricao=$descricao&custo=$custo&link_img=$link_img";
                                    //não pode tabular porque ele envia os espaços do tab

                            echo "<br><a href='../alteracao/index.php?".$to_send."'>Editar Produto</a></div>";
                            echo "<br>----------------------------------------------------------------------<br>";
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
			
			<!--
			<div class="footer">
				<div class="footerContent">
					<div class="footerMenu">
						<div class="footerMenuContent">
							<div class="menuFooter show">
								<ul>
                                    <li id="active">
                                        <a href="../">Estoque</a>
                                    </li>
                                    <li>
                                        <a href="cadastro/">Cadastro de Produtos</a>
                                    </li>
                                    <li>
                                        <a href="capital/">Aquisição / Integralização</a>
                                    </li>
                                    <li>
                                        <a href="../php/generate_pdf.php">Fluxo de Caixa</a>
                                    </li>
                                </ul>
							</div>

							<div class="menuFooterMobile showMobile">
								<button class="menuFooterMobileButton" onclick="menuFooterDropdown()">
									▲
								</button>

								<div class="menuFooterMobileContent">
									<ul>
										<li id="active">
                                            <a href="../">Estoque</a>
                                        </li>
                                        <li>
                                            <a href="cadastro/">Cadastro de Produtos</a>
                                        </li>
                                        <li>
                                            <a href="capital/">Aquisição / Integralização</a>
                                        </li>
                                        <li>
                                            <a href="../php/generate_pdf.php">Fluxo de Caixa</a>
                                        </li>
										<li id="btns">
											<div class="btns showBtnsMobile">
												Administrador
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="btns showBtns">
								<ul>
									<li>
										<div class="entrar_admin">
										    Administrador
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
			</div>-->
		</div>
	</div>
</body>
</html>