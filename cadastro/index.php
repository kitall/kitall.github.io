<?php
    session_start();

    if (!empty($_SESSION['user'])) //Teste de sessão
    {
        //Redireciona pois não se pode fazer o seu cadastro estando logado
        //O usuario tentou entrar manualmente
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['subCadastro'])) 
    {
        //Dados do cadastro obrigatório
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $sexo = $_POST['sexo'];
        $data_nasc = $_POST['data_nasc'];
        $celular = $_POST['celular'];

        $login = $_POST['login'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Dados do endereço de entrega
        if ($_POST['isContatoShown'] == "false")
            $verEndereco = false;
        else
            $verEndereco = true;
        
        if($verEndereco)
        {
            $endereco = $_POST['endereco'];
            $numero = $_POST['numero'];
            $complemento = $_POST['complemento'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $cep = $_POST['cep'];
            $estado = $_POST['estado'];
            $pais = $_POST['pais'];
        }
        
        include "../php/connect.php";
        include "../php/email/email.php";
        
        //testa se o login ja existe
        $sql = "SELECT * FROM c_usuario
            WHERE login='$login' OR email='$email';";

        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);
        if($qtd > 0)
        {
            echo "LOGIN ou EMAIL já existente!";

            echo "<br><br><a href='index.php'>Tentar novamente</a>";

            exit;
        }

        $senha = md5($senha);
        $sql = "INSERT INTO c_usuario(id_usuario, login, email, senha, excluido) 
            VALUES (DEFAULT, '$login', '$email', '$senha', 'n');";

        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);
        if ($qtd <= 0)
        {
            echo "Erro no CADASTRO do usuário<br>";

            pg_close($conectar);

            header("Location: ../");
            exit;
        }

        //--------------------------------------------------------------------

        $sql = "SELECT id_usuario FROM c_usuario WHERE email='$email';";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if ($qtd <= 0) 
        {
            echo "Erro na CONSULTA do usuário!";

            pg_close($conectar);

            header("Location: ../");
            exit;
        }

        //Pega o id cadastrado anteriormente
        $prod = pg_fetch_array($res);
        $id = $prod['id_usuario'];

        //-----------------------------------------------------------

        //Cadastro do cliente
        $sql = "INSERT INTO c_cliente(id_usuario, nome, sobrenome, sexo, data_nasc, celular, excluido)
                VALUES('$id', '$nome', '$sobrenome', '$sexo', '$data_nasc', '$celular', 'n');";

        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);

        if ($qtd <= 0) //ERRO
        {
            ?> 
                <script>
                    alert("Algo deu errado ao tentar realizar o cadastro!");
                    window.location.reload();
                </script>
            <?php

            apagaUsuario($id);

            pg_close($conectar);

            exit;
        } 

        mandaEmail($email, $nome, 1); //EMAIL DE CONFIRMAÇÃO DE CADASTRO

        //------------------------------------------------------

        //Cadastro dos dados de entrega
        if ($verEndereco) 
        {
            include("../php/cad_endereco_cli.php");

            if ($complemento != null) //complemento = sim
                cadastrar_endereco($id, $endereco, $numero, $complemento, $bairro, $cep, $cidade, $estado, $pais, TRUE, 1); 
            else //complemento = nao
                cadastrar_endereco($id, $endereco, $numero, $complemento, $bairro, $cep, $cidade, $estado, $pais, FALSE, 1);
        }

        //Tudo OK
        pg_close($conectar);

        //LOGAR 
        $_SESSION['user'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['carrinho'] = 0;

        header("Location: ../");
    }

    function apagaUsuario($user_id)
    {
        while (true) {
            $sql = "DELETE FROM c_usuario WHERE id_usuario = $user_id";
            $res = pg_query($conectar, $sql);
            $qtd = pg_affected_rows($res);
            if ($qtd > 0)
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/presentation.css">
    <link rel="stylesheet" href="../css/login.css">
	<link rel="stylesheet" href="../css/search.css">

    <title>Crie sua conta!</title>
</head>

<body>
    <div class="main">
        <div class="index-struct">

            <div class="header" id="topo">
                <div class="logo">
                    <a href="../">
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
                                                    <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                                </div>
                                                <div>
                                                    <h2><a href="../login/" title="Entre em sua conta!">Entre</a>
                                                        ou <a href="" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
                                                        <h2>0</h2>
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
                                    <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                </div>
                                <div>
                                    <h2><a href="../login/" title="Entre em sua conta!">Entre</a> ou <a href=""
                                            title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
                                        <h2>0</h2>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="cadastro">
                
                <div class="cadastroContent">
                    <form action="" method="post" id="cadastro">
                    <div class="campos">
                        <h1>Crie sua conta</h1>
                        
                            <div class="logGroup">
                                <h2>Dados Pessoais</h2>
                                <hr>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Nome*</label></div>
                                    </div>
                                    <input type="text" name="nome" placeholder="ex.: Albert" autofocus maxlength="30" required title="Insira seu nome!">
                                    <div class="descCampo" id="nome">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Sobrenome*</label></div>
                                    </div>
                                    <input type="text" name="sobrenome" placeholder="ex.: Einstein" maxlength="40" required title="Insira seu sobrenome!">
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
                                        <input type="radio" name="sexo" value="M" id="sexoM" required><label for="sexoM">Masculino</label>
                                        <input type="radio" name="sexo" value="F" id="sexoF"><label for="sexoF">Feminino</label>
                                        <input type="radio" name="sexo" value="N" id="sexoN"><label for="sexoN">Prefiro
                                            não dizer</label>
                                    </div>
                                    <div class="descCampo" id="sexo">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Data de Nascimento*</label></div>
                                    </div>
                                    <input type="date" name="data_nasc" max="2018-10-08" min="1910-01-01" maxlenght="10" required title="Insira sua data de nascimento!">
                                    <div class="descCampo" id="data_nasc">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Celular ou Telefone*</label></div>
                                    </div>
                                    <input type="text" name="celular" placeholder="ex.: 14987626754" required title="Insira seu número de celular ou telefone!">
                                    <div class="descCampo" id="celular">
                                        <p>Insira sem qualquer formatação.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="logGroup">
                                <h2>Conta</h2>
                                <hr>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Login*</label></div>
                                    </div>
                                    <input type="text" name="login" placeholder="ex.: albEinstein123" pattern="[^@\x22]+" required title="Insira seu login!">
                                    <div class="descCampo" id="login">
                                        <p>O nome de usuário que utilizará para entrar em sua conta. Não pode conter '@'.</p>
                                    </div>
                                </div>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Email*</label></div>
                                    </div>
                                    <input type="text" name="email" placeholder="ex.: albert@einstein.com" required title="Insira seu email!">
                                    <div class="descCampo" id="email">
                                        <p>Seu email será verificado.</p>
                                    </div>
                                </div>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Senha*</label></div>
                                    </div>
                                    <input type="password" name="senha" placeholder="ex.: ********" required title="Insira sua senha!">
                                    <div class="descCampo" id="senha">
                                        <p></p>
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
                                    <input type="text" name="endereco" placeholder="ex.: R. João de Barro" title="Insira a rua ou avenida de sua casa!">
                                    <div class="descCampo" id="endereco">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Número</label></div>
                                    </div>
                                    <input type="text" name="numero" placeholder="ex.: 10-21" title="Insira o número de sua casa!">
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
                                    <input type="text" name="complemento" placeholder="ex.: Portão 3, Apto. 12" title="Insira, se houver, o complemento de seu endereço!">
                                    <div class="descCampo" id="complemento">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>Bairro</label></div>
                                    </div>
                                    <input type="text" name="bairro" placeholder="ex.: Jardim dos Pinheiros" title="Insira seu bairro!">
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
                                    <input type="text" name="cidade" placeholder="ex.: Bauru" title="Insira sua cidade!">
                                    <div class="descCampo" id="cidade">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="campo">
                                    <div>
                                        <div class="lblCampo"><label>CEP</label></div>
                                    </div>
                                    <input type="text" name="cep" placeholder="ex.: 11235-813" title="Insira seu CEP!">
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
                                        <option value="" disabled selected>Unidade Federativa</option>
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
                                        <option value="SP">São Paulo</option>
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
                                    <input type="text" name="pais" placeholder="ex.: Brasil" title="Insira seu país!">
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
                            <label href="" class="lblCampo showContato" onclick="showContato()">Deseja preencher as
                                Informações de Entrega?</label>
                            <label class="moreInfo" id="moreShowContato">
                                Você pode preenchê-las quando for finalizar a compra, se preferir.
                            </label>
                        </div>

                        <input type="hidden" name="isContatoShown" id="isContatoShown">

                        <div class="logGroup">
                            <div class="btnCadastro">
                                <input type="submit" name="subCadastro" value="Criar uma conta">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="info">
                        <div class="infoContent">
                            <div class="vantagens">
                                <h3>Você vai amar sua conta!</h3>

                                <div class="itensVantagens">
                                    <ul>
                                        <li>
                                            <b>Monte</b> seus <b>Kits</b>
                                        </li>

                                        <li>
                                            <b>Adicione</b> itens ao <b>Carrinho de Compras</b>
                                        </li>

                                        <li>
                                            <b>Acesse</b> os outros sites de <b>E-Commerce</b>
                                        </li>
                                    </ul>
                                </div>

                                <div class="destaquesVantagens">
                                    <ul>
                                        <li>
                                            <b>Conheça</b> diversos produtos
                                        </li>

                                        <li>
                                            <b>Salve</b> compras para depois
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="signinInfo">
                                <h4>Já tem uma conta? <a href="../login/">Clique aqui.</a></h4>

                            </div>
                        </div>
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
                                                                <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                                            </div>
                                                            <div>
                                                                <h2><a href="../login/" title="Entre em sua conta!">Entre</a>
                                                                    ou
                                                                    <a href="" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
                                                                    <h2>0</h2>
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
                                                <a href="../login/"><img id="user" src="" alt="Usuário"></a>
                                            </div>
                                            <div>
                                                <h2><a href="../login/" title="Entre em sua conta!">Entre</a>
                                                    ou
                                                    <a href="" title="Cadastre-se em nosso site!">Cadastre-se</a></h2>
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
                                                    <h2>0</h2>
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
                                <p>@2018<br>por André Creppe, Bella Barreira, Carolina Alborgheti, Estevão Rolim e
                                    Marcos Lira</p>
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
<script type="text/javascript" src="../js/dateInput.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../js/search.js"></script>
</html>