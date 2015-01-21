<?php
/**
 * Barry Portfolio Plugin
 *
 * odds and ends for portfolio site.
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
 * Description: odds and ends for portfolio site.
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






// Works admin list custom columns setup
add_action("manage_posts_custom_column",  "work_custom_columns");
add_filter("manage_edit-work_columns", "work_edit_columns");

function work_edit_columns($columns){
  $columns = array(
	  "cb" => "<input type='checkbox' />",
	  "title" => "Work",
	  "description" => "Description",
	  "dimensions" => "dimensions",
	  "work_attached_media" => "Attached media",
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
		case "dimensions":
			$custom = get_post_custom();
			$dimx = $custom['dimension_x'][0];
			$dimy = $custom['dimension_y'][0];
			$dims = array($dimx, $dimy);
			$format = '%1$d mm  x %2$d mm';
			echo vsprintf($format, $dims);
			// alternative way of doing similar thing
			// foreach($dims as $dim){
			//     echo $dim, " ";
			// };
			break;
		case "work_attached_media":
		// print out the first variable, print out the second variable
			$custom = get_post_custom();
			// $custom_keys = get_post_custom_keys();
			// $custom_values = get_post_custom_values('work_attached_media');

			// $my_custom_field = $custom["work_attached_media"];
			// foreach($my_custom_field as $key => $value) {
			//     echo $key . " => " . $value . "<br />";
			//   };

			// print count($custom_keys);
			// print_r($custom);
			echo $custom["work_attached_media"][0]; //prints out all values listed in work_attached_media
			break;
		case "year_completed":
			$custom = get_post_custom();
			echo $custom["year_completed"][0];
			break;
	}
}



BarryPortfolioPlugin::get_instance();
