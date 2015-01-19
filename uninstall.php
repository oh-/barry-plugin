<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   barry-portfolio-plugin
 * @author    Samuuel Overington <so@madeso.uk>
 * @license   GPL-2.0+
 * @link      madeso.uk
 * @copyright 1-10-2015 madeso
 */

// If uninstall, not called from WordPress, then exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
	exit;
}

// TODO: Define uninstall functionality here