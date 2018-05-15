<?php
// DOMPDF
require_once '../dompdf/autoload.inc.php';      // include autoloader
use Dompdf\Dompdf;                              // reference the Dompdf namespace

function generarPDF($dir) {

    $dompdf = new Dompdf();                     // instantiate and use the dompdf class
    $html = file_get_contents($dir);            // Cargamos el contenido HTML
    $dompdf->loadHtml($html);

    //file_put_contents (__DIR__."/SOMELOG2.log" , print_r($html, TRUE).PHP_EOL, FILE_APPEND );

    $dompdf->setPaper('A4');                // (Optional) Setup the paper size and orientation
    $dompdf->render();                           // Render the HTML as PDF
    $dompdf->stream("Esquela.pdf");     // Output the generated PDF to Browser
}



generarPDF("documentos/plantillaEsquela.php");

?>