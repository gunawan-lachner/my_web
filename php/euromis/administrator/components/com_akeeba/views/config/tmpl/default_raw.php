<?php
/**
 * @package AkeebaBackup
 * @copyright Copyright (c)2006-2011 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 * @version $Id: default_raw.php 409 2011-01-24 09:30:22Z nikosdion $
 * @since 1.3
 *
 * The main page of the Akeeba Backup component is where all the fun takes place :)
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

$document = JFactory::getDocument();
$document->setMimeEncoding('text/plain');
echo '###'.json_encode($this->result).'###';