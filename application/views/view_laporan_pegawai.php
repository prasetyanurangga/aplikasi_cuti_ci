<?php 

$this->load->library('Opentbs');
// Create a new TBS instance and load OpenTBS plugin
$tbs = new clsTinyButStrong;
$tbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

// Useful for debugging purposes. Displays the errors
$tbs->NoErr = false;

// Set the template report path. In this case we're using docx but we could be using odt, xlsx or ods


$templatePath = dirname(__FILE__).'/pegawai.docx';

global $lain_lain;

$lain_lain[] = array('tanggal' =>  date("Y-m-d"));

// Load the template to TBS
$tbs->LoadTemplate($templatePath, OPENTBS_ALREADY_UTF8);

$tbs->MergeBlock('a',$verif);
$tbs->MergeBlock('b',$pegawai);
$tbs->MergeBlock('c',$lain_lain);

foreach ($pegawai as $key => $value) {
	$id = $value["nip"];
}

// Fill a mock array with the data we want in the final document. In a real application
// this would come from a database or any other storage system or user input.


// After the merge we simply save the document in a given location or output it to the user.
$processedPath = 'laporan_cuti-'.$id.'-'.date("Y-m-d").'-'.date("h:i:s").'.pdf';
$tbs->Show(OPENTBS_DOWNLOAD, $processedPath);
 ?>