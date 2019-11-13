<?php
    // require('phpToPDF.php');
    // ob_start();
    // include('printInvoice.php');
    // $my_html = ob_get_clean();

    // $pdf_options = array(
    //   "source_type" => 'html',
    //   "source" => $my_html,
    //   "action" => 'view',
    //   "save_directory" => 'my_pdfs',
    //   "file_name" => 'my_filename.pdf');

    // phptopdf($pdf_options);
?>

<?php
error_reporting('E_ALL');
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
ob_start();
$html = include("printInvoice.php");
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('Roll Paper 80 X 297 mm', 'portrait');
$dompdf->setPaper('Roll Paper', 'portrait');
$dompdf->render();
$dompdf->stream("Invoice-reciept",array("Attachment"=>0));

//echo $html; die;
?>