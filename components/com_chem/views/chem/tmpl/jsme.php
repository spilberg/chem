<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php
    JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');

    JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');
?>



<script>
    //this function will be called after the JavaScriptApplet code has been loaded.
    function jsmeOnLoad() {
        jsmeApplet = new JSApplet.JSME("jsme_container", "380px", "340px", {
            "options" : "oldlook,depict,nopaste,border,nostar,polarnitro,noquery,nohydrogens"
        });
        readMOLFromTextArea();
    }

    function readMOLFromTextArea() {
        var mol = document.getElementById("jme_output").value;
        jsmeApplet.readMolFile(mol);
    }
</script>

<?php if ($this->params->get( 'show_page_title', 1)) : ?>
    <div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
        <?php echo $this->escape($this->params->get('page_title')); ?>
    </div>
<?php endif; ?>
<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
    <!-- --->

   <div id="jsme_container"></div><div id="text"><textarea id="jme_output" rows="20" cols="80"><?php echo $this->request[0]->mdl_form;?></textarea></div>

   <button type="button" onclick="alert(jsmeApplet.smiles())">Show SMILES</button>
    <button id="readmol" type="button" onclick="readMOLFromTextArea()">Read Mol</button>



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