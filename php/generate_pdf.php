<?php
    require("pdf/fpdf.php");

    class PDF extends FPDF
    {
        //Formatação padrão
        function Header()
        {
            $this->Image('../imgs/KITALL.png',10,9,50);
        }
        function Footer()
        {
            $this->SetY(-15);
            
            $this->Cell(68);
            $this->SetFont('Arial','b',10);
            $this->Cell(53, 8, "Gerado eletrônicamente em ".date("d/m/y (G:i)"), 0, 0, 'C');
            
            $this->Ln(5);
            
            $this->SetFont('Arial','i',10);
            
            $this->Cell(0,10,'Kitall?@2018 - André Creppe, Bella Barreira, Carolina Alborgheti, Estevão Rolim, Marcos Lira',0,0,'C');
        }
        
        //Formatação - intro
        function Intro()
        {
            $this->Ln(100);
            
            $this->SetFont('Arial','b',30);
            
            $this->Cell(85);
            $this->Cell(20,9,"Relatório de venda",0,0,'C');
            
            $this->Ln(30);
            
            $this->Cell(85);
            $this->Cell(20,9,"Semana do Colégio",0,0,'C');
            
            $this->Ln(10);
            
            $this->SetFont('Arial', '', 20);
            $this->Cell(85);
            $this->Cell(20,9,"(08/10/18 - 10/10/18)",0,0,'C');
        }
        
        //Formatação - fluxo de caixa
        function FluxoCaixa_Top($header)
        {
            $this->SetFont('Arial','b',20);
            
            $this->Cell(130);
            $this->Cell(55,9,"Fluxo de Caixa",1,0,'C');
           
            $this->Ln(26);
            
            $this->SetFont('Arial','b',16);
            
            // Header
            $this->SetFillColor(144,255,0);
            foreach($header as $col)
                $this->Cell(37, 8, $col, 1, 0, 'C', true);
            
            $this->Ln(8);
        }
        function FluxoCaixa_Linhas($data)
        {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($data); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                if($i%2 == 1)
                    $this->SetFillColor(220,220,220);
                else
                    $this->SetFillColor(255,255,255);
                
                for($j=0; $j<5; $j++)
                {
                    $this->Cell(37, 8, $data[$i][$j], 1, 0, 'C', true);
                }
                
                $this->Ln();
            }
        }
        function FluxoCaixa_Total($total_ent, $total_sai)
        {            
            $this->SetFont('Arial','b',13);
            $this->SetFillColor(144,255,0);
            
            $this->Cell(37);
            
            $this->Cell(37,8,"Total",1,0,'C', true);
            $this->Cell(37,8, number_format((float)$total_ent, 2, '.', ''), 1,0,'C', true);
            $this->Cell(37,8, number_format((float)$total_sai, 2, '.', ''), 1,0,'C', true);
            $this->Cell(37,8, number_format((float)$total_ent-$total_sai, 2, '.', ''), 1,0,'C', true);
            
            $this->Ln(11);
            
            $this->SetFont('Arial', 'i', 10);
            $this->Cell(185);
            $this->Cell(2,1, "*valores expressos em Reais (R$)", 0, 0, 'R');
            
            $this->Ln();
        }
        
        //Demonstração de Resultado
        function Demonstracao($header, $data)
        {
            $this->SetFont('Arial','b',20);
            
            $this->Cell(97);
            $this->Cell(97,9,"Demonstração de Resultado",1,0,'C');
           
            $this->Ln(26);
            
            $this->SetFont('Arial','b',16);
            
            $this->Cell(38);
            $this->SetFillColor(144,255,0);
            foreach($header as $col)
                $this->Cell(37, 8, $col, 1, 0, 'C', true);
            
            $this->Ln(8);
            
            $this->SetFont('Arial','',13);
            $this->SetFillColor(255, 255, 255);
            
            for($i=0; $i<count($data); $i++)
            {
                $this->Cell(38);
                
                if($i%2 == 1)
                    $this->SetFillColor(220,220,220);
                else
                    $this->SetFillColor(255,255,255);
                
                for($j=0; $j<3; $j++)
                {
                    $this->Cell(37, 8, $data[$i][$j], 1, 0, 'C', true);
                }
                
                $this->Ln(8);
            }
            
            $bruto = 0.00;
            $gasto = 0.00;
            for($i=0; $i<count($data); $i++)
            {
                $bruto += $data[$i][1];
                $gasto += $data[$i][2];
            }
            
            $lucro = $bruto - $gasto;
            
            $this->SetFillColor(144,255,0);
            $this->SetFont('Arial', 'b', 13);
            
            $this->Cell(38);
            $this->Cell(37, 8, 'Totais', 1, 0, 'C', true);
            $this->Cell(37, 8, number_format((float)$bruto, 2, '.', ''), 1, 0, 'C', true);
            $this->Cell(37, 8, number_format((float)$gasto, 2, '.', ''), 1, 0, 'C', true);
            
            $this->Ln(8);
            
            $this->Cell(38);
            $this->Cell(74, 8, 'Lucro Líquido*', 1, 0, 'C', true);
            $this->Cell(37, 8, number_format((float)$lucro, 2, '.', ''), 1, 0, 'C', true);
            
            $this->Ln(8);
            
            $this->SetFillColor(177,244,90);
            
            $this->Cell(38);
            $this->Cell(74, 8, 'Lucratividade (%)', 1, 0, 'C', true);
            $this->Cell(37, 8, number_format((float)(($lucro*100)/$bruto), 2, '.', ''), 1, 0, 'C', true);
            
            $this->Ln(11);
            
            $this->SetFont('Arial', 'i', 10);
            $this->Cell(147);
            $this->Cell(2,1, "*valores expressos em Reais (R$)", 0, 0, 'R');
        }
        
        //Formatação - estoque
        function FluxoEstoque_Top($header)
        {
            $this->Cell(120);
            $this->SetFont('Arial','b',20);
            $this->Cell(65,9,"Fluxo de Estoque",1,0,'C');
           
            $this->Ln(26);
            
            $this->SetFont('Arial','b',16);
            $this->SetFillColor(144,255,0);
            
            // Header
            $i = 0;
            foreach($header as $col)
            {
                if($i == 2)
                    $this->Cell(20, 8, $col, 1, 0, 'C', true);
                else
                    $this->Cell(34, 8, $col, 1, 0, 'C', true);
                $i++;
            }
            
            $this->Ln(8);
        }
        function FluxoEstoque_Linhas($data)
        {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($data); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                if($i%2 == 1)
                    $this->SetFillColor(220,220,220);
                else
                    $this->SetFillColor(255,255,255);
                
                for($j=0; $j<6; $j++)
                {
                    if($j == 2)
                        $this->Cell(20, 8, $data[$i][$j], 1, 0, 'C', true);
                    else
                        $this->Cell(34, 8, $data[$i][$j], 1, 0, 'C', true);
                }
                
                $this->Ln();
            }
        }
        function RelacaoProduto($data)
        {            
            $this->Cell(110);
            $this->SetFont('Arial','b',20);
            $this->Cell(78,9,"Relação dos Produtos",1,0,'C');
           
            $this->Ln(26);
            
            $this->SetFont('Arial','b',15);
            $this->SetFillColor(144,255,0);
            
            $this->Cell(45);
            $this->Cell(30,8,'ID',1,0,'C', true);
            $this->Cell(70,8,'Nome',1,0,'C', true);
            
            $this->Ln();
            
            $this->SetFont('Arial', '', 13);
            
            for($i=0; $i<count($data); $i++)
            {
                //Quebra pagina?
                if($i == 29)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                if($i%2 == 1)
                    $this->SetFillColor(220,220,220);
                else
                    $this->SetFillColor(255,255,255);
                
                $this->Cell(45);
                for($j=0; $j<2; $j++)
                {
                    if($j == 0)
                        $this->Cell(30, 8, $data[$i][$j], 1, 0, 'C', true);
                    else
                        $this->Cell(70, 8, $data[$i][$j], 1, 0, 'C', true);
                }
                
                $this->Ln();
            }
        }
        function FluxoEstoque_Estatisticas($movimento)
        {
            
        }
    }

    /*----------------------------------------------------------------------------*/
    include("connect.php");

    //Dados -> Fluxo de Caixa 
    $sql = "SELECT * FROM f_fluxocaixa
        ORDER BY id_fluxocaixa;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0)
    {
        $i = 1;
        $total_ent_f = 0;
        $total_sai_f = 0;
        
        while($fluxo = pg_fetch_array($res))
        {
            $dia = $fluxo['dia'];
                $dia = date("d-m-Y", strtotime($dia));
            $descricao = $fluxo['descricao'];
            $entrada = $fluxo['entrada'];
            $saida = $fluxo['saida'];
            $saldo = $fluxo['saldoatual'];
            
            //Arrumar as strings
            if($descricao == "Aquisicao de produtos")
                $descricao = "Compra produtos";
            if($descricao == "Venda de produtos")
                $descricao = "Venda produtos";
            if($descricao == "Integralizacao")
                $descricao = "Inregralização";
            
            if($i == 1)
                $data_fluxo = array(array("$dia", "$descricao", "$entrada", "$saida", "$saldo"));
            else
                array_push($data_fluxo, array("$dia", "$descricao", "$entrada", "$saida", "$saldo"));
            
            $i++;
            $total_ent_f += $entrada;
            $total_sai_f += $saida;
        }
    }
    else
    {
        pg_close($conectar);
        
        echo "Erro na execucao do SQL (Fluxo de Caixa)!";
        exit;
    }

    //Dados -> Estoque 
    $sql = "SELECT * FROM f_fluxoestoque
        ORDER BY id_fluxoestoque;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0)
    {
        $i = 1;
        $total_ent_e = 0;
        $total_sai_e = 0;
        
        while($estoque = pg_fetch_array($res))
        {
            $dia = $estoque['dia'];
                $dia = date("d-m-Y", strtotime($dia));
            $descricao = $estoque['descricao'];
            $id = $estoque['id_prod'];
            $entrada = $estoque['entrada'];
            $saida = $estoque['saida'];
            $saldo = $estoque['qtdatual'];
            
            //Arrumar a string
            if($descricao == "Reposicao")
                $descricao = "Reposição";
            
            if($i == 1)
                $data_estoque = array(array("$dia", "$descricao", "$id", "$entrada", "$saida", "$saldo"));
            else
                array_push($data_estoque, array("$dia", "$descricao", "$id", "$entrada", "$saida", "$saldo"));
            
            $i++;
            $total_ent_e += $entrada;
            $total_sai_e += $saida;
        }
    }
    else
    {
        pg_close($conectar);
        
        echo "Erro na execucao do SQL (Fluxo de Estoque)!";
        exit;
    }
    
    //Dados -> Produto
    $sql = "SELECT id_prod, nome FROM p_produtos
        ORDER BY id_prod;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd > 0)
    {
        $i = 1;
        
        while($produto = pg_fetch_array($res))
        {
            $id_prod = $produto['id_prod'];
            $nome = $produto['nome'];
            
            if($i == 1)
                $data_produto = array(array("$id_prod", "$nome"));
            else
                array_push($data_produto, array("$id_prod", "$nome"));
            
            $i++;
        }
    }
    else
    {
        pg_close($conectar);
        
        echo "Erro na execucao do SQL (Produto)!";
        exit;
    }

    //Ganho por dia
    $sql = "SELECT dia, SUM(entrada) AS entrada, SUM(saida) AS saida FROM f_fluxocaixa
        WHERE dia >= '2018-10-06'
        GROUP BY dia ORDER BY dia;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd > 0)
    {
        $i = 1;
        
        while($produto = pg_fetch_array($res))
        {
            $dia = $produto['dia'];
            $entrada = $produto['entrada'];
            $saida = $produto['saida'];
            
            if($i == 1)
                $soma = array(array("$dia", "$entrada", "$saida"));
            else
                array_push($soma, array("$dia", "$entrada", "$saida"));
            
            $i++;
        }
    }
    else
    {
        pg_close($conectar);
        
        echo "Erro na execucao do SQL (SUM[entrada])!";
        exit;
    }

    pg_close($conectar);

    /*--------------------------------------------------------------------------------------------*/
    
    $header_fluxo = array('Data', 'Descrição', 'Entrada*', 'Saída*', 'Saldo*');
    $header_estoque = array('Data', 'Descrição', 'ID', 'Entrada', 'Saída', 'Saldo');
    $header_demonstracao = array('Data', 'Receitas*', 'Despesas*');
    
    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Intro();

    //Fluxo de Caixa
    $pdf->AddPage();
        $pdf->FluxoCaixa_Top($header_fluxo);
        $pdf->FluxoCaixa_Linhas($data_fluxo);
        $pdf->FluxoCaixa_Total($total_ent_f, $total_sai_f);
    
    //Demonstração de Resultado
    $pdf->AddPage();
        $pdf->Demonstracao($header_demonstracao, $soma);

    //Fluxo do Estoque
    $pdf->AddPage();
        $pdf->FluxoEstoque_Top($header_estoque);
        $pdf->FluxoEstoque_Linhas($data_estoque);
    //Relação de produtos
    $pdf->AddPage();
        $pdf->RelacaoProduto($data_produto);

    //Show
    $pdf->Output('I', 'Kitall_Fluxos.pdf');
?>