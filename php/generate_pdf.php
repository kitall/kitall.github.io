<?php
    require("pdf/fpdf.php");

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('../imgs/KITALL.png',10,9,50);
            $this->SetFont('Arial','B',15);
                    
            $this->Cell(130);
            $this->SetFont('Arial','b',20);
            $this->Cell(55,8,"Fluxo de Caixa",0,0,'C');
            $this->Ln();
            
            $this->Cell(130);
            $this->SetFont('Arial','i',9);
            $this->Cell(53, 6, "Gerado eletronicamente em ".date("d/m/y (G:i)"), 0, 0, 'C');

            $this->Ln(19);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            $this->SetFont('Arial','I',10);
            
            $this->Cell(0,10,'Kitall?@2018 - Andre Creppe, Bella Barreira, Carolina Alborgheti, Estevao Rolim, Marcos Lira',0,0,'C');
        }
        
        function FluxoDeCaixa_Header($header)
        {
            $this->SetFont('Arial','b',16);
            
            // Header
            foreach($header as $col)
                $this->Cell(37, 8, $col, 1, 0, 'C');
            
            $this->Ln(8);
        }
        
        function FluxoDeCaixa_Linhas($data)
        {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($data); $i++)
            {
                for($j=0; $j<5; $j++)
                {
                    $this->Cell(37, 8, $data[$i][$j], 1, 0, 'C');
                }
                
                $this->Ln();
            }
        }
        
        function FluxoDeCaixa_Total($total_ent, $total_sai)
        {
            //$this->Ln(3);
            
            $this->SetFont('Arial','b',13);
            
            $this->Cell(37);
            
            $this->Cell(37,8,"Total",1,0,'C');
            $this->Cell(37,8, number_format((float)$total_ent, 2, '.', ''), 1,0,'C');
            $this->Cell(37,8, number_format((float)$total_sai, 2, '.', ''), 1,0,'C');
            $this->Cell(37,8,number_format((float)$total_ent-$total_sai, 2, '.', ''), 1,0,'C');
            
            $this->Ln();
        }
    }

    //------------------------------------------------
    //Pegar do banco o fluxo de caixa
    include("connect.php");
    
    $sql = "SELECT * FROM f_fluxocaixa;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0)
    {
        $i = 1;
        $total_ent = 0;
        $total_sai = 0;
        
        while($fluxo = pg_fetch_array($res))
        {
            $dia = $fluxo['dia'];
            $descricao = $fluxo['descricao'];
            $entrada = $fluxo['entrada'];
            $saida = $fluxo['saida'];
            $saldo = $fluxo['saldoatual'];
            
            if($descricao == "Aquisicao de produtos")
                $descricao = "Compra produtos";
            if($descricao == "Venda de produtos")
                $descricao = "Venda produtos";
            
            if($i == 1)
                $data = array(array("$dia", "$descricao", "$entrada", "$saida", "$saldo"));
            else
                array_push($data, array("$dia", "$descricao", "$entrada", "$saida", "$saldo"));
            
            $i++;
            $total_ent += $entrada;
            $total_sai += $saida;
        }
    }
    else
    {
        echo "Erro na execução do SQL!";
        exit;
    }

    $header = array('Data', 'Descricao', 'Entrada', 'Saida', 'Saldo');
    
    //PDF Generator
    $pdf = new PDF();
    $pdf->AliasNbPages();
    //New Page
    $pdf->AddPage();
        //Cabeçalho
        $pdf->FluxoDeCaixa_Header($header);
        //Linhas
        $pdf->FluxoDeCaixa_Linhas($data);
        //Total
        $pdf->FluxoDeCaixa_Total($total_ent, $total_sai);
    //Show
    $pdf->Output();
?>