<?php 

require_once('../../conexao.php');

$id = $_GET['id'];

if($relatorio_pdf != 'Sim'){
	echo file_get_contents($url_local."sistema/rel/rel_comprovante.php?id=".$id);
	exit();
}


//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper(array(0, 0, 497.64, 700), 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(file_get_contents($url_local."sistema/rel/rel_comprovante.php?id=".$id));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'comprovante.pdf',
array("Attachment" => false)
);


?>