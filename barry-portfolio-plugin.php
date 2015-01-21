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


add_action("admin_init", "barry_attached_media");


function barry_attached_media(){
	// set up editing interface - because it is added to the amin_init action above
	// add_meta_box( $id, $title, $callback, $post_type, $context (main or sidebar), $priority, $callback_args );
	add_meta_box("work_attached_media_files", "2 Attached media files for the works", "work_attached_media_files", "work", "normal", "high");
}

function work_attached_media_files(){
// 	global $post;
// 	add_post_meta($postid, work_attached_media_files);
//
// 	// other
//
	global $post;
	$postid = get_post_custom($post->ID);
	$postkeys = get_post_custom_keys($postid);
	$work_attached_media_files = $postid["work_attached_media_files"];
	$filecount = count($work_attahced_media_files);
	
	print_r($postkeys);
	$meta_value = "temporary";
	add_post_meta($postid, work_attached_media_files, $meta_value);
	
	foreach($postid as $file){
		if(is_array($file)){
				print_r($file);
				echo "<br />";
			} else {
				echo $file, ".<br />";
			}
		}
		echo "end";
	
	// print_r($work_attached_media_files);
	echo $filecount;
		?>
	<p><label>Enter here the attached media IDs to make a gallery:</label>
		<table border="1" style="width:80%;">
			<tr>
				<th rowspan="100%" style="width:20%;">Table header</th>
				<td>Table cell 1
			</tr>
			<tr>
				<td>Table cell 2</td>
			</tr>
			<?php
			// delete_post_meta($post_id, $meta_key, $meta_value);
			foreach($work_attached_media_files as $val) {
				$bswitch =  get_post_meta( $object->ID, 'work_attached_media_files', true );
				$format = "<tr><td><input type='checkbox' name='work_attached_media_files' value='true'  /><textarea name='work_attached_media_files'>%s</textarea></td></tr>";
				echo printf($format, $val, $bswitch);
			}
			?>
		</table>
		<textarea cols="30" rows="5" name="work_attached_media_file"><?php 

			echo print_r($work_attached_media_files); ?></textarea></p> 
	<?php
	
	// below doesn't currently work yet
	// foreach($work_attached_media_files as $key => $value) {
	// 	    echo $key . " => " . $value . "<br />";
	// 	  }
}

add_action('save_post', 'barry_save_work');
// add_action('save_post', 'barry_add_work_iamge');
// add_action('save_post', 'barry_delete_work_iamge');

function barry_save_work(){
  global $post;
  // update_post_meta($post_id, $meta_key, $meta_value, $prev_value = '');
  update_post_meta($post->ID, "work_attached_media_files", $_POST["work_attached_media_files"]);
}
function barry_add_work_iamge(){
  global $post;
  // update_post_meta($post_id, $meta_key, $meta_value, $prev_value = '');
  add_post_meta($post->ID, "work_attached_media_files", $_POST["work_attached_media_files"]);
}
function barry_delete_work_iamge(){
  global $post;
  // update_post_meta($post_id, $meta_key, $meta_value, $prev_value = '');
  delete_post_meta($post->ID, "work_attached_media_files", $_POST["work_attached_media_files"]);
}

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
