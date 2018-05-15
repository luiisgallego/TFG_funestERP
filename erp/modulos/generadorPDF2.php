<?php ob_start(); ?>

<html><body>Hola</body></html>

<?php
// DOMPDF
require_once '../dompdf/autoload.inc.php';      // include autoloader
use Dompdf\Dompdf;

$dompdf = new Dompdf();                     // instantiate and use the dompdf class
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();                           // Render the HTML as PDF
$dompdf->setPaper('A4');                // (Optional) Setup the paper size and orientation
$pdf = $dompdf->output();
$filename = 'Esquela.pdf';
$dompdf->stream($filename, array("Attachment" => 0));     // Output the generated PDF to Browser

?>