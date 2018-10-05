<?php
    require("pdf/fpdf.php");

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('../imgs/KITALL.png',10,9,50);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Line Break
                    
            $this->Cell(130);
            $this->SetFont('Arial','b',20);
            $this->Cell(55,10,"Fluxo de Caixa",1,0,'C');

            $this->Ln(20);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',10);
            // Page number
            $this->Cell(0,10,'Kitall?@2018 - Andre Creppe, Bella Barreira, Carolina Alborgheti, Estevao Rolim, Marcos Lira',0,0,'C');
        }
        
        // Simple table
        function FluxoDeCaixa($header, $data)
        {
            $this->SetFont('Arial','b',16);
            
            // Header
            foreach($header as $col)
                $this->Cell(37, 7, $col, 1, 0, 'C');
            
            $this->Ln(7);
            
            $this->SetFont('Arial','',14);
            
            // Data
            foreach($data as $row)
            {
                foreach($row as $col)
                    $this->Cell(37, 6, $col, 1, 0, 'C');
                
                $this->Ln();
            }
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
        while($fluxo = pg_fetch_array($res))
        {
            
        }
    }

    else
    {
        echo "Erro na execução do SQL!";
        exit;
    }


    $header = array('Data', 'Descricao', 'Entrada', 'Saida', 'Saldo');

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->FluxoDeCaixa($header, $data);
    $pdf->Output();
?>