<?php
/**
* @package   yoo_phoenix Template
* @version   1.5.2 2009-07-02 16:34:50
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$cparams =& JComponentHelper::getParams('com_media');
?>

<div class="joomla <?php echo $this->params->get('pageclass_sfx')?>">
	<div class="categorylist">

		<?php if ($this->params->get('show_page_title', 1)) : ?>
		<h1 class="pagetitle">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
		<?php endif; ?>

		<?php if ($this->category->image || $this->category->description) : ?>
		<div class="description">
			<?php if ($this->category->image) : ?>
				<img class="<?php echo $this->category->image_position;?>" src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'. $this->category->image;?>" alt="" />
			<?php endif; ?>
			<?php if ($this->category->description) : ?>
				<?php echo $this->category->description; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php
			$this->items =& $this->getItems();
			echo $this->loadTemplate('items');
		?>

		<?php if ($this->access->canEdit || $this->access->canEditOwn) : ?>	
			<?php echo JHTML::_('icon.create', $this->category  , $this->params, $this->access); ?>	
		<?php endif; ?>	

	</div>
</div>