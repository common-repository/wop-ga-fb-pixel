<?php

/*
Plugin Name: WOP Google Analytics and Facebook Pixel Manager
Version:     1.1
Plugin URI:  https://wordpress.org/plugins/wop-ga-fb-pixel/
Author:      Devender Kumar 
Author URI:  https://devenderkumar.com/
Description: Wordpress google analytics,WP google analytics Enter google analytics Id only ,Wordpress google analytics show every page.facebook pixel, Wp facebook pixel
License:     GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
#header Section

function wop_add_css() {
    wp_register_style('wop_add_css', plugins_url('assets/css/wop-ga-fb.css',__FILE__ ));
    wp_enqueue_style('wop_add_css');
}
add_action( 'admin_init','wop_add_css');


$plugin_folder = 'wop-ga-fb-pixel';



function Wop_facebook_plugin_header_code() {
	$Wop_facebook_plugin_optionss = get_option('Wop_facebook_plugin_options');
	echo "<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
// Insert Your Custom Audience Pixel ID below. 
fbq('init', '$Wop_facebook_plugin_optionss[facebook_id]', 'auto');
fbq('track', 'PageView');
</script>";	
}
 function Wop_google_plugin_header_code() {
	$Wop_google_plugin_options = get_option('Wop_google_plugin_options');
	echo "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '$Wop_google_plugin_options[google_id]', 'auto');
  ga('send', 'pageview');
</script>";	
}
#admin section update option
function Wop_ga_fb_pixel_area() {

	$Wop_facebook_plugin_options = get_option('Wop_facebook_plugin_options');

 
 
	if (isset($_POST['update_options_submits'])) {
		 $Wop_facebook_plugin_options['facebook_id'] = sanitize_text_field($_POST['facebook_id']);
		update_post_meta( $post->ID,'Wop_facebook_plugin_options', $Wop_facebook_plugin_options);
		
	
	}
	

	 
	 $Wop_google_plugin_options = get_option('Wop_google_plugin_options');

	if (isset($_POST['update_options_submit'])) {
		$Wop_google_plugin_options['google_id'] = sanitize_text_field($_POST['google_id']);
		update_post_meta($post->ID,'Wop_google_plugin_options', $Wop_google_plugin_options);
	}

	?>
<div class="col-md-9" style="background-color: rgba(30,140,190,.8);margin-left:-21px;">
<img src="<?php echo plugins_url('assets/images/logo.png',__FILE__ ); ?>"/>
<a class="mailto" href="mailto:support@wordpress-outsourcing-partners.com" >Get Support </a>
</div>
<div class=wrap>
  <ul class="tabs">
  	 <li class="tab">
	
      <input type="radio" name="tabs" checked="checked" id="tab2" />
	 
      <label for="tab2"><?php esc_html_e( 'Google Analytics', 'wop-ga_fb_pixel' ); ?></label>   
      <div id="tab-content2" class="content">
        <form method="post">
    <!--<h2 style="color:white;font-size:  25px; margin-top: -20px !important;"><?php esc_html_e( 'Google Analytics Code', 'wop-ga_fb_pixel' ); ?></h2>-->
    <fieldset class="options" name="general" >
	<br/>
      <table class="editform">
        <tr>
          <th nowrap valign="top" style="color:  black;"><?php esc_html_e( 'Google Analytics ( Id )-:', 'wop-ga_fb_pixel' ); ?></th>
          <td><input name="google_id" type="text" Placeholder="Enter Like UA-999999-9" id="google_id" value="<?php echo $Wop_google_plugin_options['google_id']; ?>" size="30" style="
    border: 2px solid !important;
"/>

          </td>
        </tr>
		
      </table>
    </fieldset>  
    <div class="submit">
      <input type="submit" class="button button-primary" name="update_options_submit" value="Add / Update" />
	
	</div>
  </form>
    </li> 
    <li class="tab">
        <input type="radio" name="tabs"  id="tab1" />
        <label for="tab1"><?php esc_html_e( 'Facebook Pixel', 'wop-ga_fb_pixel' ); ?></label>		
        <div id="tab-content1" class="content">
           <form method="post">
    <!--<h2 style="color:white;font-size:  25px; margin-top: -20px !important;"><?php esc_html_e( 'Facebook Pixel Code', 'wop-ga_fb_pixel' ); ?></h2>-->
    <fieldset class="options" name="general">
	<br/>
      <table class="editform">
        <tr>
          <th nowrap valign="top" style="color:  black;"><?php esc_html_e( 'Facebook Pixel ( Id )-:', 'wop-ga_fb_pixel' ); ?></th>
          <td><input name="facebook_id" type="text" Placeholder="Enter Like UA-999999-9" id="facebook_id" value="<?php echo $Wop_facebook_plugin_options['facebook_id']; ?>" size="30" style="
    border: 2px solid !important;
"/>
          </td>
        </tr>
      </table>
    </fieldset>
<div class="submit">
      <input type="submit" class="button button-primary" name="update_options_submits" value="Add / Update" />
	</div>
  </form>
</div>
	 </li>
 
  </ul>
<!-- Start Update form Here -->


</div>



<?php
}
function facebook_plugin_admin_submenu() { add_submenu_page('options-general.php', 'WOP GA & FB Pixel Manager', 'WOP GA & FB Pixel Manager', 8, __FILE__, 'Wop_ga_fb_pixel_area'); }
add_action('admin_menu', 'facebook_plugin_admin_submenu');
add_action('wp_head', 'Wop_facebook_plugin_header_code');
add_action('wp_head', 'Wop_google_plugin_header_code');


?>