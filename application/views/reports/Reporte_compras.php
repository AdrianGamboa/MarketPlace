<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font


// add a page
$pdf->AddPage();

$sheading = <<<EOD
    <h3>Reporte de Compras Realizadas</h3>
EOD;
$pdf->writeHTMLCell(0,0,'','',$sheading,0,1,0,true,'C',true);
$pdf->Ln(8);

$table = '<table style="border:2px solid gray">';
$table .= '<tr>
            <th style="border:2px solid gray">Producto</th>
            <th style="border:2px solid gray">Descripción</th>
            <th style="border:2px solid gray">Unidades</th>
            <th style="border:2px solid gray">Precio Unitario</th>
            <th style="border:2px solid gray">Costo Envio</th>
            <th style="border:2px solid gray">Total</th>
            <th style="border:2px solid gray">Titular Tarjeta</th>
            <th style="border:2px solid gray">Número Tarjeta</th>
            </tr>';
foreach($compras as $obtenidos){
    $table .= '<tr>
                <td style="border:2px solid gray">'.$obtenidos['nombre'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['descripcion'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['cantidad'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['precio'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['costo_envio'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['total'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['titular_tarjeta'].'</td>
                <td style="border:2px solid gray">'.$obtenidos['numero_tarjeta'].'</td>
                </tr>';

}
$table .= '</table>';
$pdf->writeHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('Compras.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
