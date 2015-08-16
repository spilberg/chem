<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php
    JHTML::_('stylesheet', 'chem.css', 'components/com_chem/views/assets/');
    JHTML::_('script', 'rainbow-custom.min.js', 'components/com_chem/marvin/js/lib/rainbow/');
    JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
    JHTML::_('script', 'promise-1.0.0.min.js', 'components/com_chem/marvin/gui/lib/');
    JHTML::_('script', 'marvinjslauncher.js', 'components/com_chem/marvin/js/');
?>

<style>
    iframe#marvinjs-iframe {
        width: 0;
        height: 0;
        display: initial;
        position: absolute;
        left: -1000;
        top: -1000;
        margin: 0;
        padding: 0;
    }
</style>

<?php
$ddd1 = "\n\n\n\n"
    . " 14 15  0  0  0  0  0  0  0  0999 V2000\n"
    . "    0.5089    7.8316    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    1.2234    6.5941    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    1.2234    7.4191    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "   -0.2055    6.5941    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "   -0.9200    7.8316    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    0.5089    5.3566    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "   -0.2055    7.4191    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    0.5089    6.1816    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "   -0.9200    6.1816    0.0000 O   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    0.5089    8.6566    0.0000 O   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    2.4929    7.0066    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    2.0080    7.6740    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    2.0080    6.3391    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "    2.2630    8.4586    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
    . "  1  7  1  0  0  0  0\n" . "  8  2  1  0  0  0  0\n"
    . "  1  3  1  0  0  0  0\n" . "  2  3  2  0  0  0  0\n"
    . "  7  4  1  0  0  0  0\n" . "  4  8  1  0  0  0  0\n"
    . "  4  9  2  0  0  0  0\n" . "  7  5  1  0  0  0  0\n"
    . "  8  6  1  0  0  0  0\n" . "  1 10  2  0  0  0  0\n"
    . "  3 12  1  0  0  0  0\n" . "  2 13  1  0  0  0  0\n"
    . " 13 11  2  0  0  0  0\n" . " 12 11  1  0  0  0  0\n"
    . " 12 14  1  0  0  0  0\n" . "M  END\n";

//$ddd = "\n\n\n 14 15  0  0  0  0  0  0  0  0999 V2000\n"
//    . "    0.5089    7.8316    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n";
//print_r($this->chemoptions);

//echo "</br> Text: " . $ddd1;
//echo "</br> unserialise: " . base64_encode($ddd1);
//echo "</br> unserialise: " . base64_decode(base64_encode($ddd1));
?>
<!--<textarea id="molsource-box1">--><?php //echo $ddd1;?><!--</textarea>-->
<textarea id="molsource-box" style="display:none;"><?php echo $this->request[0]->mdl_form;?></textarea>
<script>

    var caffeineSource = "\n\n\n"
        + " 14 15  0  0  0  0  0  0  0  0999 V2000\n"
        + "    0.5089    7.8316    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    1.2234    6.5941    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    1.2234    7.4191    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "   -0.2055    6.5941    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "   -0.9200    7.8316    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    0.5089    5.3566    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "   -0.2055    7.4191    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    0.5089    6.1816    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "   -0.9200    6.1816    0.0000 O   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    0.5089    8.6566    0.0000 O   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    2.4929    7.0066    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    2.0080    7.6740    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    2.0080    6.3391    0.0000 N   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "    2.2630    8.4586    0.0000 C   0  0  0  0  0  0  0  0  0  0  0  0\n"
        + "  1  7  1  0  0  0  0\n" + "  8  2  1  0  0  0  0\n"
        + "  1  3  1  0  0  0  0\n" + "  2  3  2  0  0  0  0\n"
        + "  7  4  1  0  0  0  0\n" + "  4  8  1  0  0  0  0\n"
        + "  4  9  2  0  0  0  0\n" + "  7  5  1  0  0  0  0\n"
        + "  8  6  1  0  0  0  0\n" + "  1 10  2  0  0  0  0\n"
        + "  3 12  1  0  0  0  0\n" + "  2 13  1  0  0  0  0\n"
        + " 13 11  2  0  0  0  0\n" + " 12 11  1  0  0  0  0\n"
        + " 12 14  1  0  0  0  0\n" + "M  END\n";

    var marvin;
    $(document).ready(function handleDocumentReady (e) {
        // load marvin namespace in a separate frame to avoid css conflict
        // the display attribute of this iframe cannot be "none", but you can hide it somewhere
        $('body').append($('<iframe>', { id: "marvinjs-iframe", src: "/components/com_chem/marvin/marvinpack.html"}));
        // wait for the reference of marvin namespace from the iframe
        MarvinJSUtil.getPackage("#marvinjs-iframe").then(function (marvinNameSpace) {
            // the reference to the namespace is arrived but there is no guaranty that its initalization has been finished
            // because of it, wait till the ready state to be sure the whole API is available
            marvinNameSpace.onReady(function() {
                marvin = marvinNameSpace;
                initControl();
                $("#createButton").click();
            });
        },function (error) {
            alert("Cannot retrieve marvin instance from iframe:"+error);
        });


    });

    function initControl() {
       // $("#molsource-box").val(caffeineSource);

        $("#createButton").on("click", function() {
            var settings = {
                'carbonLabelVisible' : '<?php echo $this->chemoptions->carbonLabelVisible; ?>' ,
                'cpkColoring' :  '<?php echo $this->chemoptions->cpkColoring; ?>',
                'implicitHydrogen' :  '<?php echo $this->chemoptions->implicitHydrogen; ?>',
                'displayMode' : '<?php echo $this->chemoptions->displayMode; ?>',
                'background-color': '<?php echo $this->chemoptions->bgrcolor; ?>',
                'zoomMode' : '<?php echo $this->chemoptions->zoomMode; ?>',
                'width' : '<?php echo $this->chemoptions->width; ?>',
                'height' : '<?php echo $this->chemoptions->height; ?>'
            };
//            var settings = {
//                'carbonLabelVisible' : $("#chbx-carbonVis").is(':checked'),
//                'cpkColoring' : $("#chbx-coloring").is(':checked'),
//                'implicitHydrogen' : $("#implicittype").val(),
//                'displayMode' : $("#displayMode").val(),
//                'background-color': $('#bg').val(),
//                'zoomMode' : $("#zoommode").val(),
//                'width' : parseInt($("#w").val(), 10),
//                'height' : parseInt($("#h").val(), 10),
//                'fff' : ''
//            };
            var dataUrl = marvin.ImageExporter.molToDataUrl($("#molsource-box").val(),"image/png",settings);
//            var dataUrl = marvin.ImageExporter.molToDataUrl(fff,"image/png",settings);
            $("#image").attr("src", dataUrl);

            $("#imageContainer").css("display", "inline-block");
            $("#wait").css("display", "none");

        });
    }
</script>

<?php if ($this->params->get( 'show_page_title', 1)) : ?>
    <div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
        <?php echo $this->escape($this->params->get('page_title')); ?>
    </div>
<?php endif; ?>
<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
    <!-- --->
    <noscript>
        <div>
            <p>Your web browser must have JavaScript enabled in order for this application to display correctly.</p>
        </div>
    </noscript>
    <!-- <iframe src="../marvinpack.html" id="marvinjs-iframe" width="100" height="100"></iframe>-->
    <div id="convertStructureInputHeader" class="table-layout">
        <!-- li><span>Carbon labels</span><input type="checkbox" id="chbx-carbonVis" /></li>
        <li><span>CPK coloring</span><input type="checkbox" id="chbx-coloring" checked="checked" /></li>
        <li><span>Implicit Hydrogens</span>
            <select id="implicittype" name="unittype">
                <option value="ALL">ALL</option>
                <option value="OFF">OFF</option>
                <option value="HETERO">HETERO</option>
                <option value="TERMINAL_AND_HETERO" selected>TERMINAL_AND_HETERO</option>
            </select>
        </li>
        <li><span>Display Mode</span>
            <select id="displayMode" name="unittype">
                <option value="WIREFRAME" selected>wireframe</option>
                <option value="BALLSTICK">ball and stick</option>
            </select>
        </li>
        <li><span>Zoom Mode</span>
            <select id="zoommode" name="unittype">
                <option value="fit">fit</option>
                <option value="autoshrink">autoshrink</option>
            </select>
        </li>
        <li><span>Width:</span><input id="w" type="number" name="quantity" min="1" value="300" /></li>
        <li><span>Height:</span><input id="h" type="number" name="quantity" min="1" value="300" /></li>
        <li><span>Background Color:</span><input id="bg" type="color" name="bg" value="#ffffff"/></li -->
        <input id="createButton" type="button" value="Create Image" style="float: right; margin-top: 1em; visibility: hidden;"/>
    </div>
<!--    <textarea id="molsource-box">--><?php //echo $ddd1;?><!--</textarea>-->
    <div id="wait"><h2>Please wait...</h2></div>
    <div id="imageContainer" class="left10" style="display: none;">

        <img id="image" class="bordered" />
    </div>

    <!-- -->


<!--    --><?php //foreach($this->request as $obj) :
//     foreach($obj as $k => $v){
//            echo $k . ' : ' . $v . '</br>';
//        }
//    echo '</br>';
//    endforeach; ?>

<?php

$chem = $this->request[0];


?>

</div>