<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

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
<!--                        --><?php //echo JTEXT::_('ID'); ?>
                    </th>

                    <th rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'Catalog number', 'ch.cat_namber', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>
                    <th class="title" rowspan="2">
                        <?php echo JHTML::_('grid.sort',   'Molecular Weight', 'ch.mol_weigh', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                        --><?php //echo JTEXT::_('Molecular Weight'); ?>
                    </th>
                    <th class="title" nowrap="nowrap" rowspan="2">


                        <?php echo JHTML::_('grid.sort',   'Available from stock', 'ch.mass', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                        --><?php //echo JTEXT::_('Available from stock' ); ?>
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


<!--                    <th nowrap="nowrap" width="8%">-->
<!--                        --><?php //echo JHTML::_('grid.sort',   'Order by', 'cd.ordering', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                        --><?php //if ($ordering) echo JHTML::_('grid.order',  $rows ); ?>
<!--                    </th>-->
<!--                    <th width="8%" nowrap="nowrap">-->
<!--                        --><?php //echo JHTML::_('grid.sort',   'Access', 'cd.access', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                    </th>-->
<!--                    <th width="10%" class="title">-->
<!--                        --><?php //echo JHTML::_('grid.sort',   'Category', 'category', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                    </th>-->
<!--                    <th class="title" nowrap="nowrap" width="10%">-->
<!--                        --><?php //echo JHTML::_('grid.sort',   'Linked to User', 'user', @$lists['order_Dir'], @$lists['order'] ); ?>
<!--                    </th>-->

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

                    $link 		= JRoute::_( 'index.php?option=com_chem&task=edit&cid[]='. $row->id );

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

                            <?php
                            if (JTable::isCheckedOut($user->get ('id'), $row->checked_out )) :
                                echo htmlspecialchars($row->cat_namber);
                            else :
                                ?>
                                <span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit Element' );?>::<?php echo htmlspecialchars($row->cat_namber); ?>">
						<a href="<?php echo $link; ?>">
                            <?php echo htmlspecialchars($row->cat_namber); ?></a> </span>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td align="center">
                            <?php echo $row->mol_weigh; ?>
                        </td>
                        <td align="center">
<!--                            --><?php //echo $published;?>
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

<!--                        <td class="order">-->
<!--                            <span>--><?php //echo $pageNav->orderUpIcon( $i, ( $row->catid == @$rows[$i-1]->catid ), 'orderup', 'Move Up', $ordering ); ?><!--</span>-->
<!--                            <span>--><?php //echo $pageNav->orderDownIcon( $i, $n, ( $row->catid == @$rows[$i+1]->catid ), 'orderdown', 'Move Down', $ordering ); ?><!--</span>-->
<!--                            --><?php //$disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
<!--                            <input type="text" name="order[]" size="5" value="--><?php //echo $row->ordering;?><!--" --><?php //echo $disabled ?><!-- class="text_area" style="text-align: center" />-->
<!--                        </td>-->
<!--                        <td align="center">-->
<!--                            --><?php //echo $access;?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            <a href="--><?php //echo $row->cat_link; ?><!--" title="--><?php //echo JText::_( 'Edit Category' ); ?><!--">-->
<!--                                --><?php //echo $row->category; ?><!--</a>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <a href="--><?php //echo $row->user_link; ?><!--" title="--><?php //echo JText::_( 'Edit User' ); ?><!--">-->
<!--                                --><?php //echo $row->user; ?><!--</a>-->
<!--                        </td>-->

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

    function editMolecule( &$row, &$lists, $option, &$params ) {

        JRequest::setVar( 'hidemainmenu', 1 );

        JHTML::_('script', 'jquery-1.9.1.min.js', 'components/com_chem/marvin/js/lib/');
        JHTML::_('script', 'jsme.nocache.js', 'components/com_chem/jsme/');

//        if ($row->image == '') {
//            $row->image = 'blank.png';
//        }

        JHTML::_('behavior.tooltip');
        jimport('joomla.html.pane');
        // TODO: allowAllClose should default true in J!1.6, so remove the array when it does.
//        $pane = &JPane::getInstance('sliders', array('allowAllClose' => true));

//        JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'misc' );
//        $cparams = JComponentHelper::getParams ('com_media');
        ?>
        <script language="javascript" type="text/javascript">
            <!--
            function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    submitform( pressbutton );
                    return;
                }

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
                                <label for="cat_namber">
                                    <?php echo JText::_( 'Catalog number'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="cat_namber" id="cat_namber" size="60" maxlength="255" value="<?php echo $row->cat_namber; ?>" />
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
<!--                    --><?php
//                    echo $pane->startPane("menu-pane");
//                    echo $pane->startPanel(JText :: _('Contact Parameters'), "param-page");
//                    echo $params->render();
//                    echo $pane->endPanel();
//                    echo $pane->startPanel(JText :: _('Advanced Parameters'), "param-page");
//                    echo $params->render('params', 'advanced');
//                    echo $pane->endPanel();
//                    echo $pane->startPanel(JText :: _('E-mail Parameters'), "param-page");
//                    echo $params->render('params', 'email');
//                    echo $pane->endPanel();
//                    echo $pane->endPane();
//                    ?>
                </fieldset>
            </div>
            <div class="clr"></div>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
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
            <p>Programming by Nick Korbut.<br/>
            email: <a href="mailto:nick.korbut@gmail.com">nick.korbut@gmail.com</a>
            </p>
        </form>
    <?php
    }

    function exportDB(){
        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>In this place I am planing export DB functionality. Coming soon.</p>
        </form>
    <?php

    }

    function importDB(){
        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>In this place I am planing import DB functionality. Coming soon.</p>
        </form>
    <?php

    }

    function pakageDelete($option){
       // JRequest::setVar( 'hidemainmenu', 1 );
        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>In this place I am planing package delete functionality. Coming soon.</p>
            <p>Please insert each item in each line. If You ready press button Delete</p>

            <textarea id="itemtodelete" name="itemtodelete" cols="50" rows="8" class="inputbox"></textarea>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
<!--            <input type="hidden" name="id" value="--><?php //echo $row->id; ?><!--" />-->
<!--            <input type="hidden" name="cid[]" value="--><?php //echo $row->id; ?><!--" />-->
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }

    function pakageDeleteProcess($todelete){
       // JRequest::setVar( 'hidemainmenu', 1 );

        $db = & JFactory::getDBO();

        ?>
        <form action="index.php" method="post" name="adminForm">
            <p>It is a process ...</p>
            <p><?php

                $endofstring = "',";
                $endofstring1 = ";";

                $in = '';

                $queries = '';

                for($i= 0; $i < count($todelete); $i++){

                    if (count($todelete) - 1  == $i) $endofstring1 = "";
                    $queries .= 'DELETE FROM jos_chem WHERE id = '.trim($todelete[$i]).$endofstring1;

                }

//                for($i= 0; $i < count($todelete); $i++){
//
//                    if (count($todelete) - 1  == $i) $endofstring = "'";
//                    $in .= "'".trim($todelete[$i]).$endofstring;
//
//                }


               // $query = 'SELECT * FROM jos_chem WHERE id IN ('. $in .')';

                $db->setQuery($queries);
//                $db->setQuery($query);

                $db->queryBatch(false);

                echo "Complete " . $db->getAffectedRows();

                ?></p>



            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <!--            <input type="hidden" name="id" value="--><?php //echo $row->id; ?><!--" />-->
            <!--            <input type="hidden" name="cid[]" value="--><?php //echo $row->id; ?><!--" />-->
            <input type="hidden" name="task" value="" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
    <?php
    }
}