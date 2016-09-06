<?php
/**
* @package   yoo_phoenix Template
* @version   1.5.2 2009-07-02 16:34:50
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
*/

/*
	YOOtheme Template configuration
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// include classes
require_once(JPATH_ROOT."/templates/{$this->template}/lib/php/template.php");
require_once(JPATH_ROOT."/templates/{$this->template}/lib/php/cache.php");
require_once(JPATH_ROOT."/templates/{$this->template}/lib/renderer/modules.php");

// init vars
$template =& YOOTemplate::getInstance();
$template->setDocument($this);

// set title and params
$this->setTitle($mainframe->getCfg('sitename').' - '.$this->getTitle());
$this->params->bind($template->params->toArray());

// set template current color
if ($template->getCurrentColor() != 'default') {
	$this->params->set('color', $template->getCurrentColor());
}

// set template css
$color = $this->params->get('color');
$this->addStyleDeclaration($template->getCSS());
$this->addStyleSheet($template->url.'/css/template.css');
if ($color != '' && $color != 'default') {
	$color_url = $template->url.'/css/variations/';
	$this->addStyleSheet($color_url.$color.'.css');
}
// $this->addStyleSheet($template->url.'/css/custom.css');

// set mootools javascript lib
if ($this->params->get('load_mootools')) {
	$template->replaceMootools();
}

// set template javascript
if ($this->params->get('load_javascript')) {
	$this->addScriptDeclaration($template->getJavaScript());
	$this->addScript($template->url.'/lib/js/addons/base.js');
	$this->addScript($template->url.'/lib/js/addons/accordionmenu.js');
	$this->addScript($template->url.'/lib/js/addons/fancymenu.js');
	$this->addScript($template->url.'/lib/js/addons/dropdownmenu.js');
	$this->addScript($template->url.'/lib/js/template.js');
}

// ie7 hacks
if ($template->isIe(7)) {
	$css = '<link rel="stylesheet" href="%s" type="text/css" />';
	$ie7[] = sprintf($css, $template->url.'/css/ie7hacks.css');
	$this->addCustomTag('<!--[if IE 7]>'.implode("\n", $ie7).'<![endif]-->');
}

// ie6 hacks
if ($template->isIe(6)) {
	$css = '<link rel="stylesheet" href="%s" type="text/css" />';
	$js = '<script type="text/javascript" src="%s"></script>';
	$ie6[] = sprintf($css, $template->url.'/css/ie6hacks.css');
	/* if ($color != '' && $color != 'default') {
		$ie6[] = sprintf($css, $color_url.'-ie6hacks.css');
	} */
	$ie6[] = sprintf($js, $template->url.'/lib/js/addons/ie6fix.js');
	$ie6[] = sprintf($js, $template->url.'/lib/js/addons/ie6png.js');
	$ie6[] = sprintf($js, $template->url.'/lib/js/ie6fix.js');
	$this->addCustomTag('<!--[if IE 6]>'.implode("\n", $ie6).'<![endif]-->');
}

// set css class for specific columns
$columns = null;
if ($this->countModules('left')) $columns .= 'column-left';
if ($this->countModules('right') && !class_exists('JEditor')) $columns .= ' column-right';
if ($this->countModules('contentleft') && !class_exists('JEditor')) $columns .= ' column-contentleft';
if ($this->countModules('contentright') && !class_exists('JEditor')) $columns .= ' column-contentright';
$this->params->set('columns', $columns);

// stylesheet/script compression & caching
if ($compression = $this->params->get('compression')) {
	$gzip = $compression == 2;
	$rule = new YOOCacheRule('/^.*\/templates\/'.$this->template.'\/.*$/');
	$stylesheet = new YOOCacheStylesheet($this);
	$stylesheet->addRule($rule);
	$stylesheet->process($gzip);
	$script = new YOOCacheScript($this);
	$script->addRule($rule);
	$script->process($gzip);
}