<?php // no direct access
defined('_JEXEC') or die('Restricted access');

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

$filename = $sdf_obj->cat_number.'.sdf';
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: " . $known_mime_types['sdf'] );
// change, added quotes to allow spaces in filenames, by Rajkumar Singh
header("Content-Disposition: attachment; filename=\"".$filename."\";" );
//header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($content));
echo $content;

exit();

?>

