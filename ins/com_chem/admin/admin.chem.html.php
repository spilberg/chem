<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.utilities.date');

class HTML_chem {

    function showMolecules( &$rows, &$pageNav, $option, &$lists )
    {
        $user =& JFactory::getUser();

        //var_dump($rows);

        //Ordering allowed ?
        $ordering = ($lists['order'] == 'cd.ordering');

        JHTML::_('behavior.tooltip');
        ?>
        <form action="index.php?option=com_chem" method="post" name="adminForm">

            <table>
                <tr>
                    <td align="left" width="100%">
                        <?php echo JText::_( 'Filter' ); ?>:
                        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
                        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
<!--                        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();">--><?php //echo JText::_( 'Reset' ); ?><!--</button>-->
                        <button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
                    </td>
                    <td nowrap="nowrap">
                        <?php
//                        echo $lists['catid'];
//                        echo $lists['state'];
                        ?>
                    </td>
                </tr>
            </table>

            <table class="adminlist">
                <thead>
                <tr>
                    <th width="10" rowspan="2">
                        <?php echo JText::_( 'Num' ); ?>
                    </th>

                    <th width="10" class="title" rowspan="2">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
                    </th>

                    <th width="1%" nowrap="nowrap" rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'ID', 'ch.id', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>

                    <th rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'Catalog number', 'ch.cat_number', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>

                    <th class="title" rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'Molecular Weight', 'ch.mol_weigh', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>

                    <th class="title" nowrap="nowrap" rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'Available from stock', 'ch.mass', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>

                    <th colspan="12">Price</th>
                </tr>
                <tr>
                    <th>
                        <?php echo JTEXT::_('1 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('2 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('3 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('4 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('5 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('10 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('15 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('20 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('25 mg' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('5 mmol' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('10 mmol' ); ?>
                    </th>
                    <th>
                        <?php echo JTEXT::_('20 mmol' ); ?>
                    </th>

                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="18">
                        <?php echo $pageNav->getListFooter(); ?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $k = 0;
                for ($i=0, $n=count($rows); $i < $n; $i++) {
                    $row = $rows[$i];

                    $link 		= JRoute::_( 'index.php?option=com_chem&task=edit&cid[]='. $row->cat_number );

                    $checked 	= JHTML::_('grid.checkedout',   $row, $i );
                    $access 	= JHTML::_('grid.access',   $row, $i );
                    $published 	= JHTML::_('grid.published', $row, $i );

//                    $row->cat_link 	= JRoute::_( 'index.php?option=com_categories&section=com_contact_details&task=edit&type=other&cid[]='. $row->catid );
//                    $row->user_link	= JRoute::_( 'index.php?option=com_users&task=editA&cid[]='. $row->user_id );
                    ?>
                    <tr class="<?php echo "row$k"; ?>">
                        <td>
                            <?php echo $pageNav->getRowOffset( $i ); ?>
                        </td>

                        <td>
                            <?php echo $checked; ?>
                        </td>

                        <td align="center">
                            <?php echo $row->id; ?>
                        </td>


                        <td align="center">
<!--                            --><?php
//                            if (JTable::isCheckedOut($user->get ('id'), $row->checked_out )) :
//                                echo htmlspecialchars($row->cat_number);
//                            else :
//                                ?>
<!--                                <span class="editlinktip hasTip" title="--><?php //echo JText::_( 'Edit Element' );?><!--::--><?php //echo htmlspecialchars($row->cat_number); ?><!--">-->
<!--						<a href="--><?php //echo $link; ?><!--">-->
<!--                            --><?php //echo htmlspecialchars($row->cat_number); ?><!--</a> </span>-->
<!--                            --><?php
//                            endif;
//                            ?>

                            <a href="<?php echo $link; ?>">
                                <?php echo htmlspecialchars($row->cat_number); ?></a> </span>
                        </td>

                        <td align="center">
                            <?php echo $row->mol_weigh; ?>
                        </td>

                        <td align="center">
                            <?php echo $row->mass;?>
                        </td>


                        <td align="center">
                            <?php echo $row->price1mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price2mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price3mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price4mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price5mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price10mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price15mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price20mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price25mg;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price5mmol;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price10mmol;?>
                        </td>

                        <td align="center">
                            <?php echo $row->price20mmol;?>
                        </td>

                    </tr>
                    <?php
                    $k = 1 - $k;
                }
                ?>
                </tbody>
            </table>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

//    function editMolecule( &$row, &$lists, $option, &$params ) {
    function editMolecule( &$row, $option ) {

        JRequest::setVar( 'hidemainmenu', 1 );

        JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
        JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');


        JHTML::_('behavior.tooltip');
        jimport('joomla.html.pane');
        // TODO: allowAllClose should default true in J!1.6, so remove the array when it does.
// TODO: дописать проверку заполненых полей
        ?>
        <script language="javascript" type="text/javascript">
            <!--
            function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    submitform( pressbutton );
                    return;
                }

                // TODO: write validation field before submit дописать проверку формы перед отправкой
                // do field validation
//                if ( form.name.value == "" ) {
//                    alert( "<?php //echo JText::_( 'You must provide a name.', true ); ?>//" );
//                } else if ( form.catid.value == 0 ) {
//                    alert( "<?php //echo JText::_( 'Please select a Category.', true ); ?>//" );
//                } else {
//                    submitform( pressbutton );
//                }

                submitform( pressbutton );
            }
            //-->
        </script>


        <script>
            //this function will be called after the JavaScriptApplet code has been loaded.
            function jsmeOnLoad() {
                jsmeApplet = new JSApplet.JSME("jsme_container", "380px", "340px", {
            "options" : "oldlook,nopaste,border,nostar,polarnitro,noquery,nohydrogens"
//                    "options" : "<?php //echo $jsme_param; ?>//"
                });
                readMOLFromTextArea();
            }

            function readMOLFromTextArea() {
                var mol = document.getElementById("mdl_form").value;
                jsmeApplet.readMolFile(mol);
            }
        </script>

        <form action="index.php" method="post" name="adminForm">

            <div class="col width-60">

                <fieldset class="adminform">
                    <legend><?php echo JText::_( 'Information' ); ?></legend>

                    <table class="admintable">

                        <?php if ($row->id) { ?>
                            <tr>
                                <td class="key">
                                    <label>
                                        <?php echo JText::_( 'ID' ); ?>:
                                    </label>
                                </td>
                                <td>
                                    <strong><?php echo $row->id;?></strong>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="key">
                                <label for="cat_number">
                                    <?php echo JText::_( 'Catalog number'); ?>:
                                </label>
                            </td>
                            <td>
                                <?php if($row->cat_number){ ?>
                                <strong><?php echo $row->cat_number; ?></strong>

                                <?php } else { ?>
                                    <input class="inputbox" type="text" name="cat_number" id="cat_number" size="60" maxlength="255" value="" />
                                <?php } ?>
                            </td>
                        </tr>


                        <tr>
                            <td class="key">
                                <label for="mol_weigh">
                                    <?php echo JText::_( 'Molecular Weight'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="mol_weigh" id="mol_weigh" size="60" maxlength="255" value="<?php echo $row->mol_weigh; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="mass">
                                    <?php echo JText::_( 'Available from stock'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="mass" id="mass" size="60" maxlength="255" value="<?php echo $row->mass; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="cas_number">
                                    <?php echo JText::_( 'CAS-Number'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="cas_number" id="cas_number" size="60" maxlength="255" value="<?php echo $row->cas_number; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="mdl_number">
                                    <?php echo JText::_( 'MDL-number'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="mdl_number" id="mdl_number" size="60" maxlength="255" value="<?php echo $row->mdl_number; ?>" />
                            </td>
                        </tr>


                        <tr>
                            <td class="key">
                                <label for="boiling_point">
                                    <?php echo JText::_( 'Boiling point'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="boiling_point" id="boiling_point" size="60" maxlength="255" value="<?php echo $row->boiling_point; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="melting_point">
                                    <?php echo JText::_( 'Melting point'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="melting_point" id="melting_point" size="60" maxlength="255" value="<?php echo $row->melting_point; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="mdl_form">
                                    <?php echo JText::_( 'mdl_form'); ?>:
                                </label>
                            </td>
                            <td>
                                <textarea name="mdl_form" id="mdl_form" rows="15" cols="70" class="inputbox"><?php echo $row->mdl_form; ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="purity">
                                    <?php echo JText::_( 'Purity'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="purity" id="purity" size="60" maxlength="255" value="<?php echo $row->purity; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="smiles">
                                    <?php echo JText::_( 'Smiles'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="smiles" id="smiles" size="60" maxlength="255" value="<?php echo $row->smiles; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="status">
                                    <?php echo JText::_( 'Status'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="status" id="status" size="60" maxlength="255" value="<?php echo $row->status; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="molecular_formula">
                                    <?php echo JText::_( 'Molecular formula'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="molecular_formula" id="molecular_formula" size="60" maxlength="255" value="<?php echo $row->molecular_formula; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="iupac_name">
                                    <?php echo JText::_( 'IUPAC name'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="iupac_name" id="iupac_name" size="60" maxlength="255" value="<?php echo $row->iupac_name; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key" ><?php echo JText::_( 'Prices'); ?>:</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price1mg">
                                    <?php echo JText::_( '1 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price1mg" id="price1mg" size="60" maxlength="255" value="<?php echo $row->price1mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price2mg">
                                    <?php echo JText::_( '2 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price2mg" id="price2mg" size="60" maxlength="255" value="<?php echo $row->price2mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price3mg">
                                    <?php echo JText::_( '3 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price3mg" id="price3mg" size="60" maxlength="255" value="<?php echo $row->price3mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price4mg">
                                    <?php echo JText::_( '4 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price4mg" id="price4mg" size="60" maxlength="255" value="<?php echo $row->price4mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price5mg">
                                    <?php echo JText::_( '5 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price5mg" id="price5mg" size="60" maxlength="255" value="<?php echo $row->price5mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price10mg">
                                    <?php echo JText::_( '10 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price10mg" id="price10mg" size="60" maxlength="255" value="<?php echo $row->price10mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price15mg">
                                    <?php echo JText::_( '15 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price15mg" id="price15mg" size="60" maxlength="255" value="<?php echo $row->price15mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price20mg">
                                    <?php echo JText::_( '20 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price20mg" id="price20mg" size="60" maxlength="255" value="<?php echo $row->price20mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price25mg">
                                    <?php echo JText::_( '25 mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price25mg" id="price25mg" size="60" maxlength="255" value="<?php echo $row->price25mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price5mmol">
                                    <?php echo JText::_( '5 mmol'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price5mmol" id="price5mmol" size="60" maxlength="255" value="<?php echo $row->price5mmol; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price10mmol">
                                    <?php echo JText::_( '10 mmol'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price10mmol" id="price10mmol" size="60" maxlength="255" value="<?php echo $row->price10mmol; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price20mmol">
                                    <?php echo JText::_( '20 mmol'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price20mmol" id="price20mmol" size="60" maxlength="255" value="<?php echo $row->price20mmol; ?>" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <div class="col width-40">
                <fieldset class="adminform">
                    <legend><?php echo JText::_( 'Molecule' ); ?></legend>
                    <div id="jsme_container"></div>
                    <button id="readmol" type="button" onclick="readMOLFromTextArea()">Read Mol</button>
                </fieldset>
            </div>
            <div class="clr"></div>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="cat_number" value="<?php echo $row->cat_number; ?>" />

            <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

    function aboutComponent(){
    ?>
        <form action="index.php" method="post" name="adminForm">
            <p>This is Component view chemical elements for joomla 1.5 (no legacy mode!)
                <br />This component is specifically designed for "SigmaSoft"
                To display molecule chemical element used
                JSME: a free molecule editor in JavaScript
                <br />
                Copyright (c) 2013, Novartis Institutes for BioMedical Research Inc and Bruno Bienfait<br/>
                <a href="license.txt">license.txt</a> contains text of the BSD license under which the JSME is distributed.<br/>
                B. Bienfait and P. Ertl, <a href="http://www.jcheminf.com/content/5/1/24"><b>JSME: a free molecule editor in JavaScript</b></a>, J. Cheminformatics 5:24 (2013)
            </p>
            <p>For create PDF document using TCPDF. TCPDF is a PHP class for generating PDF files on-the-fly without requiring external extensions.<br/>
                Version: 6.2.11, Release date: 2015-08-02, Author:	Nicola Asuni<br/><br/>
                Copyright (c) 2002-2015: Nicola Asuni, Tecnick.com LTD, www.tecnick.com</p>
            <p>Programming by Nick Korbut.<br/>
                email: <a href="mailto:nick.korbut@gmail.com">nick.korbut@gmail.com</a>
            </p>


        </form>
    <?php
    }

    function showLogFile($filecontent){
        ?>
        <form action="index.php" method="post" name="adminForm">
            <textarea rows="20" cols="150"><?php echo htmlspecialchars($filecontent);?></textarea>
        </form>
        <?php
    }

    function exportDB($option){
        ?>

        <script language="javascript" type="text/javascript">
            <!--
            function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    // submitform( pressbutton );
                    return;
                }

                // do field validation
                if ( form.filetodelete.value == '' && form.itemtodelete.value == '' ) {
                    alert( "<?php echo JText::_( 'For export list of records You can select file with list or write catalog numbers in field below.', true ); ?>" );
//                } else if (  ) {
//                    alert( "<?php //echo JText::_( 'Please select a Category.', true ); ?>//" );
                } else {
                    submitform( pressbutton );
                }

                //submitform( pressbutton );
            }
            //-->
        </script>

        <form action="index.php" method="post" enctype="multipart/form-data" name="adminForm">

            <p>For export list of records You can select file with list or write catalog numbers in field below.</br>
                One catalog number in one line.</p>
            <p>You can choose both methods. In this case data in file and data in text field will be concatenated. </p>

            <p>Select file: <input type="file" name="filetodelete"/></p>
            <p>or/and insert each item in each line.</p>
            <textarea id="itemtodelete" name="itemtodelete" cols="50" rows="8" class="inputbox"></textarea>
            <p>If You ready press button "Export DB".</p>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php

    }

    function exportDBProcess($todelete){
       // var_dump($todelete); exit;
        global $mainframe;

        $header_string = '';
                $export_string = '';
                $all_string = '';
//                $rec = $todelete[0];
                foreach($todelete[0] as $key => $value ){
                    if($key !== 'mdl_form')
                        $header_string .= $key .';';
                }
        $header_string = rtrim($header_string, ';');
                $header_string .= "\n";
//                echo rtrim($header_string, ';') . "\n";

                for($i= 0; $i < count($todelete); $i++){
                    $rec = $todelete[$i];
                    //var_dump($rec); exit;
                    foreach($rec as $key => $value ){
                        if($key !== 'mdl_form')
                        $export_string .= $value .';';
                    }
                    $all_string .= rtrim($export_string, ';') . "\n";
                    $export_string = '';
//                      echo trim($todelete[$i]) . '<br/>';
                    //echo $row->delRec(trim($todelete[$i])) . '<br/>';
                }
//
                header('Content-Description: File Transfer');
                header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0, max-age=1');
                //header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
                header('Pragma: public');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
                header('Content-Type: text/csv');
                $name = gmdate('D_d_M_Y_H:i:s').'.csv';
                header('Content-Disposition: inline; filename="'.basename($name).'"');
                echo $header_string . $all_string;

exit;
       // $mainframe->redirect( "index.php?option=com_chem", 'Records has been Exported!' );
                ?>
                 <!--        <form action="index.php" method="post" name="adminForm">-->
<!--            <p>It is a process ...</p>-->
<!--            <p>-->
<!--            </p>-->
<!--            <p>Operation is completed!</p>-->
<!---->
<!--            <input type="hidden" name="option" value="com_chem" />-->
<!--            <input type="hidden" name="task" value="" />-->
<!--            --><?php //echo JHTML::_( 'form.token' ); ?>
<!--        </form>-->
    <?php
    }

    function importDB($option){

        ?>

        <script language="javascript" type="text/javascript">
            <!--
            function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    // submitform( pressbutton );
                    return;
                }

                // do field validation
                if ( form.filetodelete.value == '' ) {
                    alert( "<?php echo JText::_( 'You must select a file.', true ); ?>" );
//                } else if (  ) {
//                    alert( "<?php //echo JText::_( 'Please select a Category.', true ); ?>//" );
                } else {
                    submitform( pressbutton );
                }

                //submitform( pressbutton );
            }
            //-->
        </script>
<table class="adminform" border="0">
        <tr><td width="30%" valign="top"><form action="index.php" method="post" enctype="multipart/form-data" name="adminForm">
            <p>For start import process select file with data and press button "ImportDB"</p>

            <p>Select file: <input type="file" name="filetodelete"/></p>
            <p>and presss button "ImportDB"</p>

            <p>Remember! This process can take a long time. Please be patient</p>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    </td>
    <td valign="top">
        <h3>Remember!</h3>
        <p>For correct import framework to a website, image data must be appropriately formatted and it must include the following fields:
        <ul>
            <li>id</li>
            <li>Formula</li>
            <li>Mol Weight</li>
            <li>Catalog_number</li>
            <li>Purity</li>
            <li>Molecular_Formula</li>
            <li>Available_from_stock</li>
            <li>CAS_number</li>
            <li>MDL_number</li>
            <li>Boiling_point</li>
            <li>Melting_point</li>
            <li>SMILES</li>
            <li>Status</li>
            <li>iupac_name</li>
            <li>price1mg</li>
            <li>price2mg</li>
            <li>price3mg</li>
            <li>price4mg</li>
            <li>price5mg</li>
            <li>price10mg</li>
            <li>price15mg</li>
            <li>price20mg</li>
            <li>price25mg</li>
            <li>price5umol</li>
            <li>price10umol</li>
            <li>price20umol</li>

        </ul>
        </p>
    </td>
    </tr>
</table>
    <?php

    }

    function importDBProcess($array_chem_object){



        $date_start = new JDate('now');

        $row =& JTable::getInstance('chem', 'Table');


//        echo "<pre>";
//        print_r($row);
//        echo "<pre>"; exit;

        for($j = 0; $j < count($array_chem_object); $j++){

            if($array_chem_object[$j]->cat_number) {

                if (!$row->bind($array_chem_object[$j])) {
                    JError::raiseError(500, $row->getError());
                }

//                 if (!$row->check()) {
//                     JError::raiseError(500, $row->getError() );
//                 }

                if (!$row->storeDB()) {
                    JError::raiseError(500, $row->getError());
                }



                echo "Insert of update element with cat_number: " . $array_chem_object[$j]->cat_number . "<br/>";
            } else { echo 'Not find Catalog_number in record. Please check input file for correct field names. <br/>';}


        }
        $date_end = new JDate('now');

        echo 'Processing ' . count($array_chem_object) . 'rows, elapsed '.$date_end->_date - $date_start->_date .' seconds';
//
//        var_dump($date_start->_date);
//
//
//        echo "<br/>";
//
//        var_dump($date_end);

    }

    function pakageDelete($option){
       // JRequest::setVar( 'hidemainmenu', 1 );
        ?>

        <script language="javascript" type="text/javascript">
            <!--
            function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                   // submitform( pressbutton );
                    return;
                }

                // do field validation
                if ( form.filetodelete.value == '' && form.itemtodelete.value == '' ) {
                    alert( "<?php echo JText::_( 'For delete list of records You can select file with list or write catalog numbers in field below.', true ); ?>" );
//                } else if (  ) {
//                    alert( "<?php //echo JText::_( 'Please select a Category.', true ); ?>//" );
                } else {
                    submitform( pressbutton );
                }

                //submitform( pressbutton );
            }
            //-->
        </script>

        <form action="index.php" method="post" enctype="multipart/form-data" name="adminForm">

            <p>For delete list of records You can select file with list or write catalog numbers in field below.</br>
                One catalog number in one line.</p>
            <p>You can choose both methods. In this case data in file and data in text field will be concatenated. </p>

            <p>Select file: <input type="file" name="filetodelete"/></p>
            <p>or/and insert each item in each line.</p>
            <textarea id="itemtodelete" name="itemtodelete" cols="50" rows="8" class="inputbox"></textarea>
            <p>If You ready press button "Delete Package".</p>

            <p style="color:red;">WARNING! If you want delete all records in your Data base, use this link
                <a href="/administrator/index.php?option=com_chem&task=deleteallrecords">Delete All Records</a>
                Remembe, after delete you can not return back. It is not a time machine. :-)</p>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

    function pakageDeleteProcess($todelete){
        // JRequest::setVar( 'hidemainmenu', 1 );
        $row =& JTable::getInstance('chem', 'Table');
        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>It is a process ...</p>
            <p><?php
                                for($i= 0; $i < count($todelete); $i++){
                //                      echo trim($todelete[$i]) . '<br/>';
                                    echo $row->delRec(trim($todelete[$i])) . '<br/>';
                                    }
                                ?>
            </p>
            <p>Operation is completed!</p>

            <input type="hidden" name="option" value="com_chem" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

    function allDeleteProcess($todelete){
        // JRequest::setVar( 'hidemainmenu', 1 );
        $row =& JTable::getInstance('chem', 'Table');
        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>It is a process ...</p>
            <p><?php
                echo $row->delAllRecord( $todelete);
                //                for($i= 0; $i < count($todelete); $i++){
                ////                      echo trim($todelete[$i]) . '<br/>';
                //                    echo $row->delRec(trim($todelete[$i])) . '<br/>';
                //                    }
                //                ?>
            </p>
            <p>Operation is completed!</p>

            <input type="hidden" name="option" value="com_chem" />
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

    function showFileList($filelist, $option){
      //  var_dump($filelist);
        ?>
        <form action="index.php" method="post" name="adminForm">

            <table class="adminlist">
                <thead>
                    <tr>
                        <th width="10" rowspan="2">
                            <?php echo JText::_( 'Num' ); ?>
                        </th>
                        <th width="10" class="title" rowspan="2">
                            <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($filelist); ?>);" />
                        </th>

                        <th>File name</th>
                        <th>Commands</th>
                    </tr>
                </thead>
                <tbody>
<?php
                $k = 0;
                for ($i=0; $i < count($filelist); $i++) {
//                $row = $rows[$i];

                $link 		= JRoute::_( 'index.php?option=com_chem&task=viewlog&f='. $filelist[$i] );

                $checked 	= JHTML::_('grid.id', $i, $filelist[$i], false, 'fid');
                $access 	= JHTML::_('grid.access',   $row, $i );
                $published 	= JHTML::_('grid.published', $row, $i );

                //                    $row->cat_link 	= JRoute::_( 'index.php?option=com_categories&section=com_contact_details&task=edit&type=other&cid[]='. $row->catid );
                //                    $row->user_link	= JRoute::_( 'index.php?option=com_users&task=editA&cid[]='. $row->user_id );
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td><?php echo $i + 1;?></td>
                    <td>
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <span class="editlinktip hasTip" title="<?php echo JText::_( 'View log' );?>::<?php echo htmlspecialchars($filelist[$i]); ?>">
						<a href="<?php echo $link; ?>">
                            <?php echo htmlspecialchars($filelist[$i]); ?></a> </span>

                        </td>
                    <td>dh</td>
                </tr>
                <?php
                        $k = 1 - $k;
                        } ?>
                </tbody>

            </table>


                    <input type="hidden" name="option" value="<?php echo $option; ?>" />
                    <input type="hidden" name="task" value="" />
                    <?php echo JHTML::_( 'form.token' ); ?>
        </form>
      <?php
    }

}