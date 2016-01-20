<?php // no direct access
    defined('_JEXEC') or die('Restricted access');

   // JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
    JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');
JHTML::_('stylesheet', 'chem.css', 'components/com_chem/assets/');


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
        <?php echo $this->escape($this->params->get('page_title')); ?>
    </div>
<?php endif; ?>

<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

    <div id="list_of_prop">

    <h4><?php echo $this->request[0]->iupac_name?></h4>
        <table class="molecula_property">
<!--            <tr><th colspan="2">--><?php //echo $this->request[0]->iupac_name;?><!--</th></tr>-->
            <tr><td>Catalog #</td><td><?php echo $this->request[0]->cat_number;?></td></tr>
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
                    echo '<tr><td>Purity</td><td>'.$this->request[0]->purity.'</td></tr>';
            ?>
        </table>

    </div>

    <div id="formula_price">
        <p><a href="http://peter-ertl.com/jsme/index.html" target="_blank">"JSME Molecular Editor By B. Bienfait and P. Ertl"</a></p>
         <div id="jsme_container">

    </div>

        <div id="podval">

            <div class="navigate">
                <a href="/?option=<?php echo $option;?>&id=<?php echo $this->request[0]->cat_number;?>&task=getsdf" >Download SDF</a> &nbsp; <a href="/?option=<?php echo $option;?>&id=<?php echo $this->request[0]->cat_number;?>&task=getpdf">Download PDF</a>
            </div>

            <?php
                if(!is_null($this->request[0]->status) && $this->request[0]->status == 'virtual')
                    echo '<div class="mass"><p>Synthesis on request</p></div>';

                if(!is_null($this->request[0]->status) && $this->request[0]->status == 'in stock')
                    echo '<div class="mass"><p>Available from stock ' . $this->request[0]->mass . ' mg</p></div>';
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
            if(!is_null($this->request[0]->price1mg) && $this->request[0]->price1mg !== '0')
                echo '<tr><td>1 mg</td><td>'.$this->request[0]->price1mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price2mg) && $this->request[0]->price2mg !== '0')
                echo '<tr><td>2 mg</td><td>'.$this->request[0]->price2mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price3mg) && $this->request[0]->price3mg !== '0')
                echo '<tr><td>3 mg</td><td>'.$this->request[0]->price3mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price4mg) && $this->request[0]->price4mg !== '0')
                echo '<tr><td>4 mg</td><td>'.$this->request[0]->price4mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price5mg) && $this->request[0]->price5mg !== '0')
                echo '<tr><td>5 mg</td><td>'.$this->request[0]->price5mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price10mg) && $this->request[0]->price10mg !== '0')
                echo '<tr><td>10 mg</td><td>'.$this->request[0]->price10mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price15mg) && $this->request[0]->price15mg !== '0')
                echo '<tr><td>15 mg</td><td>'.$this->request[0]->price15mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price20mg) && $this->request[0]->price20mg !== '0')
                echo '<tr><td>20 mg</td><td>'.$this->request[0]->price20mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price25mg) && $this->request[0]->price25mg !== '0')
                echo '<tr><td>25 mg</td><td>'.$this->request[0]->price25mg.'&nbsp;'.$valuta.'</td></tr>';

//            if(!is_null($this->request[0]->price15mg) && $this->request[0]->price15mg !== '0')
//                echo '<tr><td>15 mg</td><td>'.$this->request[0]->price15mg.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price5mmol) && $this->request[0]->price5mmol !== '0')
                echo '<tr><td>5 mmol</td><td>'.$this->request[0]->price5mmol.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price10mmol) && $this->request[0]->price10mmol !== '0')
                echo '<tr><td>10 mmol</td><td>'.$this->request[0]->price10mmol.'&nbsp;'.$valuta.'</td></tr>';

            if(!is_null($this->request[0]->price20mmol) && $this->request[0]->price20mmol !== '0')
                echo '<tr><td>20 mmol</td><td>'.$this->request[0]->price20mmol.'&nbsp;'.$valuta.'</td></tr>';
            ?>

        </table>
    </div>
    </div>
    <?php


//    foreach($this->request[0] as $k => $v){
//        echo '<b>' . $k . '</b> : ' . $v . '</br>';
//    }



    //        foreach($this->request as $obj) :
    //            foreach($obj as $k => $v){
    //                echo '<b>' . $k . '</b> : ' . $v . '</br>';
    //            }
    //            echo '</br>';
    //        endforeach;
    //

    ?>
    <div id="text" style="display: none;">
        <textarea id="jme_output" rows="20" cols="80"><?php echo $this->request[0]->mdl_form;?></textarea>
<!--        <button type="button" onclick="alert(jsmeApplet.smiles())">Show SMILES</button>-->
<!--        <button id="readmol" type="button" onclick="readMOLFromTextArea()">Read Mol</button>-->
    </div>

    <div class="otstup"></div>



</div>