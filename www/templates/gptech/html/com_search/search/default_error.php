<?php
/**
* @package   yoo_phoenix Template
* @version   1.5.2 2009-07-02 16:34:50
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<h2>
	<?php echo JText::_('Error') ?>
</h2>
<p>
	<?php echo $this->escape($this->error); ?>
</p>