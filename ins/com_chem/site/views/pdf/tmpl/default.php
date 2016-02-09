<?php // no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.document.document');

//require_once(JPATH_ROOT.DS.'libraries/joomla/document/pdf/pdf.php');
require_once(JPATH_SITE.DS.'components/com_chem/tcpdf/config/tcpdf_config.php');
require_once(JPATH_SITE.DS.'components/com_chem/tcpdf/tcpdf.php');



$sdf_obj = $this->request[0];

define('RECORD_DELIMITER', "$$$$");
define('FIELD_DELIMITER', ">  ");

$mapping_fields  = array('id' => 'id',
    'molecular_formula' => 'Formula',
    'mol_weigh' => 'Mol Weight',
    'mdl_form' => 'mdl_form',
    'cat_number' => 'Catalog_number',
    'purity' => 'Purity',
    'molecular_formula' => 'Molecular_Formula',
    'mass' => 'Available_from_stock',
    'cas_number' => 'CAS_number',
    'mdl_number' => 'MDL_number',
    'smiles' => 'SMILES',
    'status' => 'Status',
    'iupac_name' => 'iupac_name',
    'price1mg' => 'price1mg',
    'price2mg' => 'price2mg',
    'price3mg' => 'price3mg',
    'price4mg' => 'price4mg',
    'price5mg' => 'price5mg',
    'price10mg' => 'price10mg',
    'price15mg' => 'price15mg',
    'price20mg' => 'price20mg',
    'price25mg' => 'price25mg',
    'price5mmol' => 'price5umol',
    'price10mmol' => 'price10umol',
    'price20mmol' => 'price20umol');


$known_mime_types=array(
    "pdf" => "application/pdf",
    "txt" => "text/plain",
    "sdf" => "text/plain",
    "html" => "text/html",
    "htm" => "text/html",
    "exe" => "application/octet-stream",
    "zip" => "application/zip",
    "doc" => "application/msword",
    "xls" => "application/vnd.ms-excel",
    "ppt" => "application/vnd.ms-powerpoint",
    "gif" => "image/gif",
    "png" => "image/png",
    "jpeg"=> "image/jpg",
    "jpg" =>  "image/jpg",
    "php" => "text/plain"
);

$content = $sdf_obj->mdl_form.PHP_EOL;
    foreach (get_object_vars($sdf_obj) as $f => $v) {
        if($mapping_fields[$f] !== 'mdl_form') $content .= ">  <". $mapping_fields[$f].">" . PHP_EOL . $v . PHP_EOL . PHP_EOL ;
    }
$content .= RECORD_DELIMITER;

$filename = $sdf_obj->cat_number.'.pdf';
//header("Pragma: public"); // required
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Cache-Control: private",false); // required for certain browsers
//header("Content-Type: " . $known_mime_types['sdf'] );
//// change, added quotes to allow spaces in filenames, by Rajkumar Singh
//header("Content-Disposition: attachment; filename=\"".$filename."\";" );
////header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
//header("Content-Transfer-Encoding: binary");
//header("Content-Length: ".strlen($content));

//echo $content;



//        $html = "test of the <b>PDF</b> file generator";
//
//        $pdf = new JDocumentPDF();
//        $pdf->setTitle("test");
////        $pdf->setTitle($title);
//        $pdf->setName('The Test');
//        $pdf->setDescription("CV automaticaly generated at http://strongcv.com");
//        $pdf->setMetaData('keywords', "free CV builder");
//        $pdf->setBuffer($content);
//        $data = $pdf->render();

////Output new PDF file
//        header('Content-type: application/pdf');
////        header("Content-Disposition: attachment; filename={$_POST[filename]}");
//        header("Content-Disposition: attachment; filename={$filename}");
//        echo $data;
//////////////////////////////////

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($filename);
$pdf->SetSubject('Material Safety Data Sheet - '.$filename);
$pdf->SetKeywords($filename);

// set default header data
$pdf->SetHeaderData('', 0, 'Material Safety Data Sheet - '.$filename, "Product Name: ".$sdf_obj->iupac_name."\nData Printed: ". date("d.m.Y"), array(0,64,255), array(0,64,128));
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//    require_once(dirname(__FILE__).'/lang/eng.php');
//    $pdf->setLanguageArray($l);
//}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
//$html = <<<EOD
$html = '<h1 style="text-align:center">Material Safety Data Sheet</h1>

<h2>1 - Product and Company Information</h2>
<p>Product Name: '. $sdf_obj->iupac_name .'<br/>
Product Number: '.$sdf_obj->cat_number .'<br/>
Company: Otava Chemicals<br/>
Phone: +1-416-549-8030<br/>
Fax: +1-866-881-9921</p>

<h2>2 - Composition/Information on Ingredients</h2>
<p>Product Name: '.$sdf_obj->iupac_name .'<br/>
CAS#: '.(($sdf_obj->cas_number) ? $sdf_obj->cas_number : 'N/A') .'<br/>
Formula: '. (($sdf_obj->molecular_formula) ? $sdf_obj->molecular_formula : 'N/A') .'<br/>
Molecular Weight: '. (($sdf_obj->mol_weigh) ? $sdf_obj->mol_weigh : 'N/A') .'</p>

<h2>3 - Hazards Identification</h2>
<p>Physical/chemical hazards:Nonflammable, nonexplosive,<br/>
Human health hazards:Data not available<br/>
Environmental hazards:No environmental hazards have been reported.</p>

<h2>4 - First Aid Measures</h2>
<p>If swallowed, wash out mouth with water provided person is conscious. Call a physician. If inhaled, remove to fresh air. If not
breathing give artificial respiration. If breathing is difficult, give oxygen In case of contact, immediately wash skin with soap an
copious amounts of water. In case of contact, immediately flush eyes with copious amounts of water for at least 15 minutes.</p>


<h2>5 - Fire Fighting Measures</h2>

<p>Extinguishing media:<br/>
    &nbsp;&nbsp;Water spray<br/>
    &nbsp;&nbsp;Carbon dioxide, dry chemical powder or appropriate foam.<br/>
Unusual fire and explosions hazards<br/>
    &nbsp;&nbsp;Emits toxic fumes under fire conditions.<br/>

Special firefighting procedures:<br/>
    &nbsp;&nbsp;Wear self-contained breathing apparatus and<br/>
    &nbsp;&nbsp;protective clothing to prevent contact with skin and eyes.</p>

<h2>6 - Accidental Release Measures</h2>
<p>Wear respirator, chemical safety goggles, rubber boots and heavy rubber gloves.<br/>
Sweep up, place in a bag and hold for waste disposal.<br/>
Avoid raising dust. Ventilate area and wash spill site after material pickup is complete.</p>


<h2>7 - Handling and Storage</h2>
<p>HANDLING: Directions for Safe Handling: Do not breathe vapour. Avoid contact with eyes, skin, and clothing.
Avoid prolonged or repeated exposure.</p>
<p>STORAGE: at room temperature</p>
<p>SPECIAL REQUIREMENTS: -</p>

<h2>8 - Exposure Controls / Personal Protection</h2>
<p>Safety shower and eye bath. Mechanical exhaust required.<br/>
Wash thoroughly after handling. Wash contaminated clothing before reuse.<br/>
Avoid contact with eyes, skin and clothing. Avoid prolonged or repeated exposure.<br/>
Avoid inhalation. NIOSH/MSHA-approved respirator.<br/>
Compatible chemical-resistant gloves. Chemical safety goggles.<br/>
Keep tightly closed. Store in a dry place at room temperature.</p>

<h2>9 - Physical and Chemical Properties</h2>

<p>Physical State: Light yellow powder<br/>
Odour: Almost odourless<br/>
Melting Point: '.(($sdf_obj->melting_point) ? $sdf_obj->melting_point : 'N/A') .'<br/>
Boiling Point: '.(($sdf_obj->boiling_point) ? $sdf_obj->boiling_point : 'N/A') .'</p>



<h2>10 - Stability and Reactivity</h2>

<p>STABILITY
Stable: Stable under normal temperatures and pressures.<br/>
Conditions of Instability: -<br/>
Materials to Avoid: Strong oxidizing agents, Strong acids.<br/>
HAZARDOUS DECOMPOSITION PRODUCTS<br/>
Hazardous Decomposition Products: Carbon monoxide, Carbon dioxide, Nitrogen oxides, Fluorine compounds.<br/>
HAZARDOUS POLYMERIZATION<br/>
Hazardous Polymerization: Will not occur</p>

<h2>11 - Toxicological Information</h2>

<p>No toxicological information is available on the product<br/>
Acute effects:<br/>
&nbsp;&nbsp;May cause skin irritation.<br/>
&nbsp;&nbsp;May cause eye irritation.<br/>
&nbsp;&nbsp;Material may be irritating to mucous membranes and upper respiratory tract.<br/>
&nbsp;&nbsp;May be harmful by inhalation, ingestion, or skin absorption.<br/>
To the best of our knowledge, the chemical, physical and toxicological properties have not been thoroughly investigated.</p>

<h2>12 - Ecological Information</h2>
<p>No environmental hazards have been reported</p>

<h2>13 - Disposal Considerations</h2>
<p>SUBSTANCE DISPOSAL<br/>
Contact a licensed professional waste disposal service to dispose of this material. Dissolve or mix the material with a
combustible solvent and burn in a chemical incinerator equipped with an afterburner and scrubber. Observe all federal, state,
and local environmental regulations.</p>

<h2>14 - TRANSPORTATION DATA</h2>
<p>Not regulated per U.S. DOT, IATA or IMO.<br/>
Proper Shipping Name: None<br/>
Non-Hazardous for Transport: This substance is considered to be non-hazardous for transport.<br/>
IATA<br/>
Non-Hazardous for Air Transport: This substance is considered to be non-hazardous for air transport.</p>

<h2>15 - REGULATORY DATA</h2>
<p>U.S. Federal Regulations: This product is not currently regulated by SARA/EPCRA<br/>
TSCA: No. R&D Use Only</p>

<h2>16 - OTHER INFORMATION</h2>

<p>Otava has compiled the information and recommendations contained in this Material Safety Data Sheet from sources
believed to be reliable and to represent the most reasonable current opinion on the subject when the MSDS was prepared.
While the above information is believed to be accurate, no warranty, guaranty, or representation is made as to the correctness
or sufficiency of the information and the information is intended only as a guide. Otava shall not be held liable for any damage resulting from handling or
from contact with this product. The user of this product must decide what safety measures are necessary to safely use this product, either alone or in combination with other products, and determine environmental regulatory compliance obligations under any applicable Federal or State Laws.</p>';
//EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($filename, 'D');

//============================================================+
// END OF FILE
//============================================================+

exit();

?>

