<?php
    session_start();

	$selorder = true;
    $getOrder = "mais";

	if(isset($_POST['order']))
    {        
		$getOrder = $_POST['order'];

		$selorder = true;
	}

    //----------------------------------------

    if($getOrder == "mais")
        $sql = "SELECT nome, SUM(saida)
            FROM f_fluxoestoque 
            INNER JOIN p_produtos ON f_fluxoestoque.id_prod = p_produtos.id_prod
            GROUP BY nome ORDER BY sum DESC
            "; //LIMIT 4

    else if($getOrder == "fluxo")
        $sql = "SELECT dia AS nome, MAX(saldoatual) AS sum FROM f_fluxocaixa
            GROUP BY dia
            ORDER BY dia";
    else if($getOrder == "entrada")
        $sql = "SELECT dia AS nome, MAX(entrada) AS sum FROM f_fluxocaixa
            GROUP BY dia
            ORDER BY dia";
    else if($getOrder == "venda")
        $sql = "SELECT id_prod, preco, nome FROM p_produtos
            ORDER BY RANDOM() LIMIT 1";

    if($selorder)
    {
        include "../../php/connect.php";
        
        $static = array();
        
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if ($qtd > 0) 
        {
            if($getOrder == "venda")
            {
                $st = pg_fetch_array($res);
        
                $id = $st['id_prod'];
                $preco = $st['preco'];
                $nome = $st['nome'];
                
                $sql = "SELECT dia AS nome, MAX(saida) AS sum FROM f_fluxoestoque
                    WHERE id_prod='$id'
                    GROUP BY dia
                    ORDER BY dia";
                $res = pg_query($conectar, $sql);
            }

            $i = 0;
            while ($st = pg_fetch_array($res)) 
            {
                $static[$i] = array();
                
                $static[$i][0] = $st['nome'];
                $static[$i][1] = $st['sum'];
                
                $i++;
            }
            
            pg_close($conectar);
        }
        else
        {
            echo "sql error!";
            
            pg_close($conectar);
            
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="../../css/admin.css">
	<link rel="stylesheet" href="../../css/footer.css">
	<link rel="stylesheet" href="../../css/cadastro.css">
	
    <link rel="stylesheet" href="../../css/chart.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
	<link rel="icon" type="image/png" href="../../favicon.png">
	<link rel="manifest" href="../../manifest.json">
	
	<script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            <?php 
                if($getOrder == "mais")
                {
            ?>
                // PIE CHART - PRODUTOS MAIS VENDIDOS
                 var data = new google.visualization.DataTable();
                 data.addColumn('string', 'Topping');
                 data.addColumn('number', 'Slices');
                 data.addRows([
                 <?php 
                    for($i=0; $i<sizeof($static); $i++)
                    {
                        echo "['".$static[$i][0]."', ".$static[$i][1]."],";
                    }
                ?>
                 ]);

                 var options = {
                     'title': "Produtos mais Vendidos",
                     'width': 650,
                     'height': 350,
                     'backgroundColor': 'none',
                     'fontSize': 13,
                     'titleTextStyle': {
                         'fontSize': 18
                     }
                 }

                 var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                 chart.draw(data, options);
            
            <?php 
                }
                else if($getOrder == "fluxo")
                {

            ?>

                // LINE CHART - FLUXO DE CAIXA
                 var data = google.visualization.arrayToDataTable([
                     ['Dia', 'Saldo'],
                 <?php 
                    $lim = sizeof($static) - 1;
                    
                    for($i=0; $i<$lim; $i++)
                        echo "['".$static[$i][0]."', ".$static[$i][1]."],";
                    
                    echo "['".$static[$lim][0]."', ".$static[$lim][1]."]";
                ?>
                 ]);

                 var options = {
                     'title': "Saldo (por dia)",
                     'width': 650,
                     'height': 350,
                     'backgroundColor': 'none',
                     'fontSize': 13,
                     'titleTextStyle': {
                         'fontSize': 18
                     }
                 }

                 var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                 chart.draw(data, options);
            
            <?php
                }
                else if($getOrder == "entrada")
                {

            ?>

                // LINE CHART - ENTRADA P DIA
                 var data = google.visualization.arrayToDataTable([
                     ['Dia', 'Entrada'],
                     <?php 
                        $lim = sizeof($static) - 1;

                        for($i=0; $i<$lim; $i++)
                            echo "['".$static[$i][0]."', ".$static[$i][1]."],";

                        echo "['".$static[$lim][0]."', ".$static[$lim][1]."]";
                    ?>
                 ]);

                 var options = {
                     'title': "Valor arrecadado (por dia)",
                     'width': 650,
                     'height': 350,
                     'backgroundColor': 'none',
                     'fontSize': 13,
                     'titleTextStyle': {
                         'fontSize': 18
                     }
                 }

                 var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                 chart.draw(data, options);
            
            <?php
                }
                else if($getOrder == "venda")
                {
                    
            ?>

                // BAR CHART - VENDA PRODUTO P DIA
                var data = google.visualization.arrayToDataTable([
                    ['Dia', 'Quantidade', 'Valor (R$)'],
                    <?php 
                        $lim = sizeof($static) - 1;

                        for($i=0; $i<$lim; $i++)
                            echo "['".$static[$i][0]."', ".$static[$i][1].", ".$preco*$static[$i][1]."],";

                        echo "['".$static[$lim][0]."', ".$static[$i][1].", ".$preco*$static[$i][1]."]";
                    ?>
                ]);

                <?php
                    echo "
                var options = {
                    'title': 'Venda de $nome (por dia)',
                    'width': 650,
                    'height': 350,
                    'backgroundColor': 'none',
                    'fontSize': 13,
                    'titleTextStyle': {
                        'fontSize': 18
                    },
                    'legend': {
                        position: 'bottom'
                    }
                }"; 
                ?>

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            
            <?php
                }
            ?>
        }
    </script>

	<title>Movimento de Capital</title>
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
						<li id="active">
                            <a href="">Estatísticas</a>
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
                            <li id="active">
                                <a href="">Estatísticas</a>
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
           
            <div class="charts">
                <div class="chart">
                   <div class="orderBar">
							<div class="orderOrg">
								<div class="order">
									<form id="myform" method="post">
										<input type="hidden" name="search" value="<?php echo $prod_name; ?>">

										<select name="order" onchange="change()">
											<option value="mais" <?php if($selorder && $getOrder == "mais") echo "selected"; ?>>Mais Vendidos</option>
											<option value="fluxo" <?php if($selorder && $getOrder == "fluxo") echo "selected"; ?>>Fluxo por Dia</option>
											<option value="entrada" <?php if($selorder && $getOrder == "entrada") echo "selected"; ?>>Entrada por Dia</option>
											<option value="venda" <?php if($selorder && $getOrder == "venda") echo "selected"; ?>>Venda por Dia</option>
										</select>
										
									</form>
								</div>
							</div>
						</div>
                      
                       <!-- charts -->
                    <div id="chart_div" class="gchart"></div>
                </div>
            </div>
			
            <br><br><br>
			
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
                                    <li id="active">
                                        <a href="">Estatísticas</a>
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
                                        <li id="active">
                                            <a href="">Estatísticas</a>
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

<script>
    function change()
    {
        document.getElementById("myform").submit();
    }
</script>
</html>