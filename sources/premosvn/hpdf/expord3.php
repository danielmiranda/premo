<?php
/**
 * Logiciel : exemple d'utilisation de HTML2PDF
 * 
 * Convertisseur HTML => PDF
 * Distribué sous la licence LGPL. 
 *
 * @author		Laurent MINGUET <webmaster@html2pdf.fr>
 * 
 * isset($_GET['vuehtml']) n'est pas obligatoire
 * il permet juste d'afficher le résultat au format HTML
 * si le paramètre 'vuehtml' est passé en paramètre _GET
 */
ini_set('max_execution_time', 86400);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once dirname(__FILE__).'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

include(dirname(__FILE__)."/../_serv/zconect.php");

try {
    ob_start();
    include dirname(__FILE__).'/expord3b.php';
    $content = ob_get_clean();
    $newfile = dirname(__FILE__).'/ordfiles/ord3-'.trim($ordcli).'.pdf';
    $html2pdf = new Html2Pdf('P','letter','en', false, 'ISO-8859-15',array(0, 0, 0, 0));
    $html2pdf->setDefaultFont('helvetica');
    $html2pdf->writeHTML($content);
    $html2pdf->output($newfile,'Fi');
    $datrfq = Array ( "ord_genpdf" => 1 );
    $db->where ('ord_id', $rfqid);
    $updb = $db->update ('orders', $datrfq);
} catch (Html2PdfException $e) {
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

