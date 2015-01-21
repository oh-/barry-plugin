<?php if (isset($_FILES['text-two']))

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attach_id = media_handle_upload( $_FILES['text-two'], $post_id );

update_post_meta($post_id,'textTwo', $attach_id));

?>