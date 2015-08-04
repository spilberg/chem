<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php JHTML::_('stylesheet', 'chem.css', 'components/com_chem/assets/'); ?>

<?php if ($this->params->get( 'show_page_title', 1)) : ?>
    <div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
        <?php echo $this->escape($this->params->get('page_title')); ?>
    </div>
<?php endif; ?>
<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<!--    <label for="id">-->
<!--        --><?php //echo JText::_('Select Poll'); ?>
<!--        --><?php //echo $this->lists['polls']; ?>
<!--    </label>-->

 тут будет контент
</div>