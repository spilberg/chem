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

    <?php foreach($this->request as $obj) :
       // echo $obj->status;
        //print_r($j);
        foreach($obj as $k => $v){
            echo $k . ' : ' . $v . '</br>';
        }
    echo '</br>';
    endforeach; ?>

 <?php //print_r($this->request[0]->id); ?>

</div>