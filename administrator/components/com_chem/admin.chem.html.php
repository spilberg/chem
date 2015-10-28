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
}