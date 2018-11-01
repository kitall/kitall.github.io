<?php
    session_start();
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
    <div class="double_row_grid">
        <div class="perfilPresent">
            <div class="perfilPresentContent">
                <div class="presentName">
                    <div class="presentNameContent">
                        <p>logado como:</p>
                        <h2>João Ferreira</h2>
                    </div>
                </div>

                <div class="presentEmail">
                    <div class="presentEmailContent">
                        <h4>joao@emaildojoao.com</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="cadastro">
            <div class="cadastroContent">
                <form action="" method="post" id="cadastro">
                    <div class="campos">
                        <h1>Edite sua conta</h1>

                        <div class="logGroup">
                            <h2>Dados Pessoais</h2>
                            <hr>

                            <div class="campo">
                                <div>
                                    <div class="lblCampo"><label>Nome*</label></div>
                                </div>
                                <input type="text" name="nome" placeholder="ex.: Albert" autofocus maxlength="30"
                                    required title="Insira seu nome!">
                                <div class="descCampo" id="nome">
                                    <p></p>
                                </div>
                            </div>
                            <div class="campo">
                                <div>
                                    <div class="lblCampo"><label>Sobrenome*</label></div>
                                </div>
                                <input type="text" name="sobrenome" placeholder="ex.: Einstein" maxlength="40" required
                                    title="Insira seu sobrenome!">
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
                                <input type="date" name="data_nasc" max="2018-10-08" min="1910-01-01" maxlenght="10"
                                    required title="Insira sua data de nascimento!">
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
                                <input type="text" name="login" placeholder="ex.: albEinstein123" pattern="[^@\x22]+"
                                    required title="Insira seu login!">
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
            </div>

        </div>
    </div>
</body>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="../../js/main.js"></script>

</html>