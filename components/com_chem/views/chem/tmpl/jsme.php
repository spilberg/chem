<?php // no direct access
    defined('_JEXEC') or die('Restricted access');

   // JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
    JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');
    JHTML::_('stylesheet', 'chem.css', 'components/com_chem/assets/');
    JHTML::_('script','jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/');
    JHTML::_('script','modal.js', 'components/com_chem/assets/');
//JLoader::import('com_chem.kcaptcha.kcaptcha','components' , 'components.');
//unset($_SESSION['captcha_keystring']);
//$session = & JFactory::getSession();
//$captcha = new KCAPTCHA();

//$session->set('captcha_keystring', 'qqw223');



//if($session->get('captcha_keystring'))

//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


    $jsme_param =   $this->params->get('jsme_xbutton').','.
                    $this->params->get('jsme_rbutton').','.
                    $this->params->get('jsme_atommovebutton').','.
                    $this->params->get('jsme_hydrogens').','.
                    $this->params->get('jsme_keephs').','.
                    $this->params->get('jsme_keephs1').','.
                    $this->params->get('jsme_noquery').','.
                    $this->params->get('jsme_autoez').','.
                    $this->params->get('jsme_canonize').','.
                    $this->params->get('jsme_stereo').','.
                    $this->params->get('jsme_reaction').','.
                    $this->params->get('jsme_multipart').','.
                    $this->params->get('jsme_polarnitro').','.
                    $this->params->get('jsme_number').','.
                    $this->params->get('jsme_star').','.
                    $this->params->get('jsme_depict').','.
                    $this->params->get('jsme_paste').','.
                    $this->params->get('jsme_border').','.
                    $this->params->get('jsme_look');

$valuta = $this->params->get('valuta');

$enablesendme = $this->params->get('enablesendme');

?>

<script>
    //this function will be called after the JavaScriptApplet code has been loaded.
    function jsmeOnLoad() {
        jsmeApplet = new JSApplet.JSME("jsme_container", "<?php echo $this->params->get('jsme_width');?>px", "<?php echo $this->params->get('jsme_height');?>px",  {
//            "options" : "oldlook,depict,nopaste,border,nostar,polarnitro,noquery,nohydrogens"
            "options" : "<?php echo $jsme_param; ?>"
        });
        readMOLFromTextArea();
    }

    function readMOLFromTextArea() {
        var mol = document.getElementById("jme_output").value;
        jsmeApplet.readMolFile(mol);
    }
</script>

<?php if ($this->params->get( 'show_page_title')) : ?>
        <div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
        <?php //echo $this->escape($this->params->get('page_title')); ?>
        <?php echo $this->request[0]->iupac_name; ?>
    </div>
<?php endif; ?>

<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

    <div id="list_of_prop" style="width: auto;">
<!--        <h4>--><?php ////echo $this->request[0]->iupac_name?><!--</h4>-->

        <p><a href="http://peter-ertl.com/jsme/index.html" target="_blank">"JSME Molecular Editor By B. Bienfait and P. Ertl"</a></p>
        <div id="jsme_container" style="float: none;">
        </div>
        <div id="res"></div>
        <div class="navigate">
            <a class="strsearch" href="/?option=<?php echo $option;?>&id=<?php echo $this->request[0]->cat_number;?>&task=getsdf" >Download SDF</a> &nbsp;
            <a class="strsearch" href="/?option=<?php echo $option;?>&id=<?php echo $this->request[0]->cat_number;?>&task=getpdf">Generate MSDS</a> &nbsp;
            <a class="strsearch" id='btnSndReq' href="#">Send request</a>
        </div>
<br/>

    </div>

    <div id="formula_price" style="width: auto;">


        <div id="podval">



            <?php
            if(!is_null($this->request[0]->status) && $this->request[0]->status == 'virtual')
                echo '<div class="mass red"><p>Synthesis on request</p></div>';

            if(!is_null($this->request[0]->status) && $this->request[0]->status == 'in stock')
                echo '<div class="mass green"><p>Available from stock, ' . $this->request[0]->mass . ' mg</p></div>';
            ?>

            <table class="molecula_property">
                <!--            --><?php
                //            if(!is_null($this->request[0]->price1mg ))
                //                echo '<tr><td>1 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price1mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price2mg))
                //                echo '<tr><td>2 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price2mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price3mg))
                //                echo '<tr><td>3 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price3mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price4mg))
                //                echo '<tr><td>4 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price4mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price5mg))
                //                echo '<tr><td>5 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price5mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price10mg))
                //                echo '<tr><td>10 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price10mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price15mg))
                //                echo '<tr><td>15 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price15mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price20mg))
                //                echo '<tr><td>20 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price20mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price25mg))
                //                echo '<tr><td>25 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price25mg.'</td></tr>';
                //
                //            //if(!is_null($this->request[0]->price15mg))
                //            //    echo '<tr><td>15 mg</td><td>'.$valuta.'</td><td>'.$this->request[0]->price15mg.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price5mmol))
                //                echo '<tr><td>5 mmol</td><td>'.$valuta.'</td><td>'.$this->request[0]->price5mmol.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price10mmol))
                //                echo '<tr><td>10 mmol</td><td>'.$valuta.'</td><td>'.$this->request[0]->price10mmol.'</td></tr>';
                //
                //            if(!is_null($this->request[0]->price20mmol))
                //                echo '<tr><td>20 mmol</td><td>'.$valuta.'</td><td>'.$this->request[0]->price20mmol.'</td></tr>';
                //            ?>

                <?php
                if(!is_null($this->request[0]->status) && $this->request[0]->status !== 'virtual') {
                    if (!is_null($this->request[0]->price1mg) && $this->request[0]->price1mg !== '0')
                        echo '<tr><td>1 mg</td><td>' . $this->request[0]->price1mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price2mg) && $this->request[0]->price2mg !== '0')
                        echo '<tr><td>2 mg</td><td>' . $this->request[0]->price2mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price3mg) && $this->request[0]->price3mg !== '0')
                        echo '<tr><td>3 mg</td><td>' . $this->request[0]->price3mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price4mg) && $this->request[0]->price4mg !== '0')
                        echo '<tr><td>4 mg</td><td>' . $this->request[0]->price4mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price5mg) && $this->request[0]->price5mg !== '0')
                        echo '<tr><td>5 mg</td><td>' . $this->request[0]->price5mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price10mg) && $this->request[0]->price10mg !== '0')
                        echo '<tr><td>10 mg</td><td>' . $this->request[0]->price10mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price15mg) && $this->request[0]->price15mg !== '0')
                        echo '<tr><td>15 mg</td><td>' . $this->request[0]->price15mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price20mg) && $this->request[0]->price20mg !== '0')
                        echo '<tr><td>20 mg</td><td>' . $this->request[0]->price20mg . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price25mg) && $this->request[0]->price25mg !== '0')
                        echo '<tr><td>25 mg</td><td>' . $this->request[0]->price25mg . '</td><td>'.$valuta.'</td></tr>';

//            if(!is_null($this->request[0]->price15mg) && $this->request[0]->price15mg !== '0')
//                echo '<tr><td>15 mg</td><td>'.$this->request[0]->price15mg.'&nbsp;'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price5mmol) && $this->request[0]->price5mmol !== '0')
                        echo '<tr><td>5 mmol</td><td>' . $this->request[0]->price5mmol . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price10mmol) && $this->request[0]->price10mmol !== '0')
                        echo '<tr><td>10 mmol</td><td>' . $this->request[0]->price10mmol . '</td><td>'.$valuta.'</td></tr>';

                    if (!is_null($this->request[0]->price20mmol) && $this->request[0]->price20mmol !== '0')
                        echo '<tr><td>20 mmol</td><td>' . $this->request[0]->price20mmol . '</td><td>'.$valuta.'</td></tr>';
                }
                ?>

            </table>
        </div>
    </div>
    <br/>
    <table class="molecula_property">
        <tr><td width="15%">Catalog #</td><td><?php echo $this->request[0]->cat_number;?></td></tr>
        <?php
        if(!is_null($this->request[0]->cas_number) && $this->request[0]->cas_number !== '')
            echo '<tr><td>CAS-number</td><td>'.$this->request[0]->cas_number.'</td></tr>';

        if(!is_null($this->request[0]->mdl_number) && $this->request[0]->mdl_number !== '')
            echo '<tr><td>MDL-number</td><td>'.$this->request[0]->mdl_number.'</td></tr>';

        if(!is_null($this->request[0]->molecular_formula) && $this->request[0]->molecular_formula !== '')
            echo '<tr><td>Formula</td><td>'.$this->request[0]->molecular_formula.'</td></tr>';

        if(!is_null($this->request[0]->mol_weigh) && $this->request[0]->mol_weigh !== '')
            echo '<tr><td>Molecular Weight</td><td>'.$this->request[0]->mol_weigh.'</td></tr>';

        if(!is_null($this->request[0]->smiles) && $this->request[0]->smiles !== '')
            echo '<tr><td>SMILES</td><td>'.$this->request[0]->smiles.'</td></tr>';

        if(!is_null($this->request[0]->status) && $this->request[0]->status !== '')
            echo '<tr><td>Status</td><td>'.$this->request[0]->status.'</td></tr>';

        if(!is_null($this->request[0]->purity) && $this->request[0]->purity !== '')
            echo '<tr><td>Purity</td><td>'.$this->request[0]->purity.'%</td></tr>';
        ?>
    </table>

    <div id="text" style="display: none;">
        <textarea id="jme_output" rows="20" cols="80"><?php echo $this->request[0]->mdl_form;?></textarea>
<!--        <button type="button" onclick="alert(jsmeApplet.smiles())">Show SMILES</button>-->
<!--        <button id="readmol" type="button" onclick="readMOLFromTextArea()">Read Mol</button>-->
    </div>

    <div class="otstup"></div>



</div>

<div class="wrapper"></div>
<div class="form-action">
    <img class="close" alt="Закрити" src="components/com_chem/assets/closebox.png">

    <form id="reqform" onsubmit="return false;">
        <div class="block">
            <p>* required fields</p>
            <input required type="text" id="name" name="name" placeholder="Name *" /><br/>
            <input type="text" id="company" name="company" placeholder="Company" /><br/>
            <input required type="email" id="email" name="email" placeholder="Email *"/>
            <p>Your message:</p>
            <textarea id="message" name="message" rows="3"><?php echo $this->request[0]->cat_number . "\nRequested quantity: ";?></textarea><br/>
           <?php if($enablesendme) { ?>
               <label for="sendme" ><input type = "checkbox" name = "sendme" id = "sendme" > Please send me a copy of my request by Email </label >
           <?php } ?>
            <p class="green" style="display: none; font-weight: bold;" id="notes">А copy of this request will be sent to your email. If you can`t find it, please check the spam folder.
            </p>

            <p><img id="imgcaptcha" src="/?option=<?php echo $option;?>&task=getcap&<?php echo session_name()?>=<?php echo session_id()?>&rand=">
            <img id="reloadcaptcha" src="/administrator/images/reload.png"/></p>

            <input required type="text" id="keystring" name="keystring" placeholder="Enter the text as shown above" value=""/>

            <input type="hidden" name="cat_number" value="<?php echo $this->request[0]->cat_number;?>" />
        </div>
        <div class="block">
            <span id="errormsg">&nbsp;</span>
            <button type="button" id="btnSubmit" class="strsearch">Send Request</button>
        </div>
    </form>

</div>


<?php //echo "<pre>"; var_dump($_SESSION); echo "<hr/>"; var_dump($session->get('captcha_keystring')); echo "</pre>"; //exit; ?>