<?php
/**
 * Barry Portfolio Plugin
 *
 * odds and ends for portfolio site
 *
 * @package   barry-portfolio-plugin
 * @author    Samuuel Overington <so@madeso.uk>
 * @license   GPL-2.0+
 * @link      madeso.uk
 * @copyright 1-10-2015 madeso
 *
 * @wordpress-plugin
 * Plugin Name: Barry Portfolio Plugin
 * Plugin URI:  madeso.uk
 * Description: odds and ends for portfolio site
 * Version:     1.0.0
 * Author:      Samuuel Overington
 * Author URI:  madeso.uk
 * Text Domain: barry-portfolio-plugin-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "BarryPortfolioPlugin.php");

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook(__FILE__, array("BarryPortfolioPlugin", "activate"));
register_deactivation_hook(__FILE__, array("BarryPortfolioPlugin", "deactivate"));

// try out from here
/**
 * Set up Work attachements
 */
require_once(plugin_dir_path(__FILE__) . "work_attachments.php");


add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function work_details_edit_columns($columns){
  $columns = array(
	  "cb" => "<input type='checkbox' />",
	  "title" => "Work Title",
	  "description" => "Description",
	  "year_completed" => "Year Completed",
  );
 
  return $columns;
}
function work_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "year_completed":
      $custom = get_post_custom();
      echo $custom["year_completed"][0];
      break;
  }
}

BarryPortfolioPlugin::get_instance();
