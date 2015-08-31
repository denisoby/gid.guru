<?php 
if (isset($_GET['instagram'])) {
	$instagram = $_GET['instagram'];
} else {
	$instagram = '';
}

if ($instagram != 'hide') {
if ( is_active_sidebar( 'instagram-widget' ) ) {
	dynamic_sidebar( 'instagram-widget' ); 	
}
}

?>