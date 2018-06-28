<?php
/*
Plugin Name: Responsive Youtube & Vimeo Video Lightbox 
Plugin URI: http://swadeshswain.com
Description: This Responsive plugin will allow you to show  Youtube & Vimeo Video in Lightbox Popup using shortcode
Version: 2.0
Author: swadeshswain
Author URI: http://swadeshswain.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
function ryvl_min_jquery() {
    if (!is_admin()) {
       wp_enqueue_script('jquery');
   }
}
add_action('init', 'ryvl_min_jquery');
add_action( 'wp_footer', 'ryvl_enqueue_script' );
add_action( 'wp_footer', 'ryvl_enqueue_style' );
function ryvl_enqueue_script() {
  
  wp_enqueue_script('videoPopUp.jquery', plugins_url('/js/videoPopUp.jquery.js',__FILE__), array( 'jquery' ), false );
  ?>
<script type="text/javascript">
		jQuery(function(){
			jQuery("a.yes").YouTubePopUp();
			jQuery("a.no").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
		});
	</script>

  <?php
}  
function ryvl_enqueue_style() {
wp_enqueue_style( 'YouTubePopUp',  plugins_url('/css/videoPopUp.css',__FILE__) , false ); 	
}
function ryvl_shortcode( $atts ,$content = null )
{
ob_start();
$atts = shortcode_atts(
		array(
			'video_url' => '',
			'auto_play' => '',
		),
		$atts
	);
	$output .='<a class="'.$atts['auto_play'].'" href="'.$atts['video_url'].'">'. $content .'</a>';
ob_clean();
	return $output;
}
add_shortcode('ryvl', 'ryvl_shortcode');
?>