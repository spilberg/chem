<?php // no direct access
    defined('_JEXEC') or die('Restricted access');

    JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
    JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');


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


?>

<script>
    //this function will be called after the JavaScriptApplet code has been loaded.
    function jsmeOnLoad() {
        jsmeApplet = new JSApplet.JSME("jsme_container", "<?php echo $this->params->get('jsme_height');?>px", "<?php echo $this->params->get('jsme_width');?>px", {
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

    <div id="jsme_container">

    </div>

    <div id="text" style="display: none;">
        <textarea id="jme_output" rows="20" cols="80"><?php echo $this->request[0]->mdl_form;?></textarea>
<!--        <button type="button" onclick="alert(jsmeApplet.smiles())">Show SMILES</button>-->
<!--        <button id="readmol" type="button" onclick="readMOLFromTextArea()">Read Mol</button>-->
    </div>

    <div>
        <?php
        foreach($this->request as $obj) :
         foreach($obj as $k => $v){
                echo '<b>' . $k . '</b> : ' . $v . '</br>';
            }
        echo '</br>';
        endforeach;
        ?>
    </div>

</div>