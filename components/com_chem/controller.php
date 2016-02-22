<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
jimport('joomla.document.pdf.pdf');


class ChemController extends JController
{
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
        parent::display();
    }

    /**
     * Method for downloqd sdf file
     */
    function getsdf(){

        $model = $this->getModel('chem');

        $id = JRequest::getVar('id',null,'', 'string');

        $model->getChem($id);

        $chem = $model->getChem($id);

        $sdf_obj = $chem[0];

        if($sdf_obj->cat_number == null) $mainframe->redirect('index.php' );

        define('RECORD_DELIMITER', "$$$$");
        define('FIELD_DELIMITER', ">  ");

        $mapping_fields  = array('id' => 'id',
            'molecular_formula' => 'Formula',
            'mol_weigh' => 'Mol_Weight',
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

        $content = "\n".ltrim($sdf_obj->mdl_form).PHP_EOL;
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
//        header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".strlen($content));

        echo $content;

        exit();
  }

    /**
     * Method for download pdf file
     */
    function getpdf() {

        $model = $this->getModel('chem');

        $id = JRequest::getVar('id',null,'', 'string');

        $model->getChem($id);

        // Create the view
        $view = & $this->getView('pdf', 'html');

        $chem = $model->getChem($id);

        $sdf_obj = $chem[0];

        if($sdf_obj->cat_number == null) $mainframe->redirect('index.php' );

         $view->assignRef('request', $chem);


         $view->display();
    }

    /**
     * Method prepare and send emails to admin and user
     *
     */
    function sendrequest(){
        $component = & JComponentHelper::getComponent('com_chem');
        $params = new JParameter($component->params);
        $emailfrom[0] = $params->get('emailfrom');
        $emailfrom[1] = $params->get('nameemailfrom');
        $adminemail = $params->get('adminemail');
        $emailsubject = $params->get('emailsubject');
//        $tablecss = $params->get('tablecss');

        $name = JRequest::getVar('name', null, '', 'string');
        $company = JRequest::getVar('company', null, '', 'string');
        $email = JRequest::getVar('email', null, '', 'string');
        $sendme = JRequest::getVar('sendme', 'off', '', 'string');
        $message = JRequest::getVar('message', null, '', 'string');
        $keystring = JRequest::getVar('keystring', null, '', 'string');

        $session = & JFactory::getSession();
        $captcha_keystring = $session->get('captcha_keystring');

        $body = '<table border="1" style="border-collapse: collapse;"><tr><td style="padding: 3px;">Name: </td><td style="padding: 3px;">'.$name.'</td></tr><tr><td style="padding: 3px;">Company: </td><td style="padding: 3px;">'.$company.'</td></tr>
<tr><td style="padding: 3px;">Email: </td><td style="padding: 3px;">'.$email.'</td></tr><tr><td style="padding: 3px;">Yuor message: </td><td style="padding: 3px;">'.$message.'</td></tr></table>';

//        if(count($_POST)>0){
            if(isset($captcha_keystring) && $captcha_keystring === $keystring){
                if($sendme == 'on')
                    $this->sendRequetQuote($emailfrom,$email,$emailsubject, $body);

                if ($this->sendRequetQuote($emailfrom,$adminemail,$emailsubject, $body)) {
                    echo "<p>Thank you! Your request has been sent to admin. We will contact you.<p>";
                } else {
                    echo "<p>Error. Please contact administrator.<p>";
                }
            }else{
                echo "<p>Sorry! Your request has not sent. You need refresh your browser for new request.<p>";
            }
//        }

        $session->clear('captcha_keystring');

        exit;
    }

    /**
     * Get picture for captcha
     */
    function getcap(){
        JLoader::import('com_chem.kcaptcha.kcaptcha','components' , 'components.');
        $session = & JFactory::getSession();

        $captcha = new KCAPTCHA();

        // save captcha key in session
        $session->set('captcha_keystring', $captcha->getKeyString());

        exit;
    }

    /**
     * Method for send letter
     *
     * @param $from
     * @param $recipient
     * @param $subject
     * @param $body
     * @return mixed
     */
    function sendRequetQuote($from, $recipient, $subject, $body){

        $jmail = JFactory::getMailer();
        $mail = $jmail::getInstance();

        $mail->isHTML(true);
        $mail->ClearAddresses();
        $mail->setSender($from);
        $mail->setSubject($subject);
        $mail->setBody($body);
        $mail->addRecipient($recipient);

        return $mail->Send();

    }

}

