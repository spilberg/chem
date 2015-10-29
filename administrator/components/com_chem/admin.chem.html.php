<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_chem {

    function showMolecules_1( &$rows, &$pageNav, $option, &$lists )
//    function showMolecules()
    {
        ?>
        <form action="index.php?option=com_contact" method="post" name="adminForm">
            <p>The form</p>
        </form>
    <?php
    }

    function showMolecules( &$rows, &$pageNav, $option, &$lists )
    {
        $user =& JFactory::getUser();

        var_dump($rows);

        //Ordering allowed ?
        $ordering = ($lists['order'] == 'cd.ordering');

        JHTML::_('behavior.tooltip');
        ?>
        <form action="index.php?option=com_contact" method="post" name="adminForm">

            <table>
                <tr>
                    <td align="left" width="100%">
                        <?php echo JText::_( 'Filter' ); ?>:
                        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
                        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
                        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
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
                    <th width="10">
                        <?php echo JText::_( 'Num' ); ?>
                    </th>
                    <th width="10" class="title">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
                    </th>
                    <th width="1%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort',   'ID', 'cd.id', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>

                    <th>
                        <?php echo JText::_('cat_namber'); ?>
                    </th>
                    <th class="title">

                        <?php echo JTEXT::_('molecular_formula'); ?>
<!--                        --><?php //echo JHTML::_('grid.sort',   'Name', 'cd.name', @$lists['order_Dir'], @$lists['order'] ); ?>
                    </th>
                    <th width="5%" class="title" nowrap="nowrap">
<!--                        --><?php //echo JHTML::_('grid.sort',   'Published', 'cd.published', @$lists['order_Dir'], @$lists['order'] ); ?>
                        <?php echo JTEXT::_('Status' ); ?>
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
                    <td colspan="11">
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

                    $row->cat_link 	= JRoute::_( 'index.php?option=com_categories&section=com_contact_details&task=edit&type=other&cid[]='. $row->catid );
                    $row->user_link	= JRoute::_( 'index.php?option=com_users&task=editA&cid[]='. $row->user_id );
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


                        <td>
                            <?php echo $row->cat_namber; ?>
                        </td>
                        <td>
                            <?php
                            if (JTable::isCheckedOut($user->get ('id'), $row->checked_out )) :
                                echo htmlspecialchars($row->molecular_formula);
                            else :
                                ?>
                                <span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit Element' );?>::<?php echo htmlspecialchars($row->molecular_formula); ?>">
						<a href="<?php echo $link; ?>">
                            <?php echo htmlspecialchars($row->molecular_formula); ?></a> </span>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td align="center">
<!--                            --><?php //echo $published;?>
                            <?php echo $row->status;?>
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
                                    <?php echo JText::_( 'cat_namber'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="cat_namber" id="cat_namber" size="60" maxlength="255" value="<?php echo $row->cat_namber; ?>" />
                            </td>
                        </tr>


                        <tr>
                            <td class="key">
                                <label for="mol_weigh">
                                    <?php echo JText::_( 'mol_weigh'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="mol_weigh" id="mol_weigh" size="60" maxlength="255" value="<?php echo $row->mol_weigh; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="mass">
                                    <?php echo JText::_( 'mass'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="mass" id="mass" size="60" maxlength="255" value="<?php echo $row->mass; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="cas_number">
                                    <?php echo JText::_( 'cas_number'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="cas_number" id="cas_number" size="60" maxlength="255" value="<?php echo $row->cas_number; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="mdl_number">
                                    <?php echo JText::_( 'mdl_number'); ?>:
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
                                    <?php echo JText::_( 'purity'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="purity" id="purity" size="60" maxlength="255" value="<?php echo $row->purity; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="smiles">
                                    <?php echo JText::_( 'smiles'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="smiles" id="smiles" size="60" maxlength="255" value="<?php echo $row->smiles; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="status">
                                    <?php echo JText::_( 'status'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="status" id="status" size="60" maxlength="255" value="<?php echo $row->status; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="molecular_formula">
                                    <?php echo JText::_( 'molecular_formula'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="molecular_formula" id="molecular_formula" size="60" maxlength="255" value="<?php echo $row->molecular_formula; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="iupac_name">
                                    <?php echo JText::_( 'iupac_name'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="iupac_name" id="iupac_name" size="60" maxlength="255" value="<?php echo $row->iupac_name; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price1mg">
                                    <?php echo JText::_( 'price1mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price1mg" id="price1mg" size="60" maxlength="255" value="<?php echo $row->price1mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price2mg">
                                    <?php echo JText::_( 'price2mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price2mg" id="price2mg" size="60" maxlength="255" value="<?php echo $row->price2mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price3mg">
                                    <?php echo JText::_( 'price3mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price3mg" id="price3mg" size="60" maxlength="255" value="<?php echo $row->price3mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price4mg">
                                    <?php echo JText::_( 'price4mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price4mg" id="price4mg" size="60" maxlength="255" value="<?php echo $row->price4mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price5mg">
                                    <?php echo JText::_( 'price5mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price5mg" id="price5mg" size="60" maxlength="255" value="<?php echo $row->price5mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price10mg">
                                    <?php echo JText::_( 'price10mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price10mg" id="price10mg" size="60" maxlength="255" value="<?php echo $row->price10mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price15mg">
                                    <?php echo JText::_( 'price15mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price15mg" id="price15mg" size="60" maxlength="255" value="<?php echo $row->price15mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price20mg">
                                    <?php echo JText::_( 'price20mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price20mg" id="price20mg" size="60" maxlength="255" value="<?php echo $row->price20mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price25mg">
                                    <?php echo JText::_( 'price25mg'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price25mg" id="price25mg" size="60" maxlength="255" value="<?php echo $row->price25mg; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price5mmol">
                                    <?php echo JText::_( 'price5mmol'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price5mmol" id="price5mmol" size="60" maxlength="255" value="<?php echo $row->price5mmol; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price10mmol">
                                    <?php echo JText::_( 'price10mmol'); ?>:
                                </label>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="price10mmol" id="price10mmol" size="60" maxlength="255" value="<?php echo $row->price10mmol; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td class="key">
                                <label for="price20mmol">
                                    <?php echo JText::_( 'price20mmol'); ?>:
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
}