<?php
/*
Plugin Name: JP Scrollbar
Plugin URI: http://joydevpal.esy.es/nice-scrollbar-wordpress/
Description: This plugin enables custom scrollbar in your wordpress website. You can customize scrollbar settings as per your requirement
Author: Joydev Pal
Author URI: http://www.joydevpal.esy.es
Version: 1.0
 */

/*==========  Call jquery  ==========*/

function jp_cs_jquery(){
	wp_enqueue_script( 'jquery' );
}
add_action( 'init', 'jp_cs_jquery' );

/*==========  Call plugin js  ==========*/

define('NICE_SCROLLBAR_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');

function jp_cs_load_scripts(){
	wp_register_script( 'jp_cs_main_script', NICE_SCROLLBAR_PLUGIN_DIR .'js/jquery.mCustomScrollbar.concat.min.js', false, '1.0', true );
	wp_register_script( 'jp_cs_mouse_scroll', NICE_SCROLLBAR_PLUGIN_DIR .'js/jquery.mousewheel.js', false, '1.0', true );
	

	wp_enqueue_script( 'jp_cs_main_script' );
	wp_enqueue_script( 'jp_cs_mouse_scroll' );	
	
}
add_action( 'wp_footer', 'jp_cs_load_scripts' );

/*==========  call plugin styles  ==========*/

function jp_cs_load_styles(){
	wp_register_style( 'jp_cs_main_style', NICE_SCROLLBAR_PLUGIN_DIR.'css/jquery.mCustomScrollbar.css', __FILE__ );
	wp_register_style( 'jp_cs_custom_style', NICE_SCROLLBAR_PLUGIN_DIR.'css/jp_custom_scrollbar.css', __FILE__ );

	wp_enqueue_style( 'jp_cs_main_style' );
	wp_enqueue_style( 'jp_cs_custom_style' );
}
add_action( 'wp_head', 'jp_cs_load_styles' );

/*==========  Register setiings page  ==========*/

function jp_cs_settings_menu(){
	add_options_page('JP Scrollbar Options', 'JP Scrollbar Options', 'manage_options', 'nice-scrollbar-settings', 'jp_cs_plugin_setting');
}
add_action('admin_menu', 'jp_cs_settings_menu');

/*==========  Default options  ==========*/

$jp_cs_options = array(
	'theme' => 'dark-thick',
	'show_scrollbutton' => 'true',
	'scroll_speed' => '250',
	'autohide_scrollbar' => 'false',
	'keyboard_scroll' => 'true',
	'autoexpand_scrollbar' => 'true'

);

if(is_admin()){ // Load only if we are viewing an admin page
	
	/*==========  Register settings and call sanitization functions  ==========*/
	
	function jp_cs_register_settings(){		
		register_setting('jp_cs_settings_group', 'jp_cs_options', 'jp_cs_validate_options');
	}
	add_action('admin_init', 'jp_cs_register_settings');


	function jp_cs_plugin_setting(){
		global $jp_cs_options;
		if(!isset($_REQUEST['nicescroll-settings-updated'])){
			$_REQUEST['nicescroll-settings-updated'] = false; //This checks whether the form has just been submitted.
		} ?>

		<div class="wrap">
			<h2>Nice Scrollbar Settings</h2>
			<?php if($_REQUEST['nicescroll-settings-updated'] !== false){ ?> 
			<div class="updated fade"><p><strong><?php _e('Options Saved') ?></strong></p></div>
			<?php } //if the form has just been submitted, this shows the notification. ?>
			<form method="post" action="options.php">
				<?php $settings = get_option('jp_cs_options'); ?>
				<?php settings_fields('jp_cs_settings_group'); /* This function outputs some hidden fields required by the form, including a nonce, a unique number used to ensure the form has been submitted from the admin page and not somewhere else, very important for security. */ ?>
				<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
					<tr valign="top">
						<th scope="row"><label for="holder_color">Scrollbar theme</label></th>
						<td>							
							<select name="jp_cs_options[theme]">								
								<option value="dark" <?php selected('dark', $settings['theme']); ?>>Dark</option>
								<option value="dark-2" <?php selected('dark-2', $settings['theme']); ?>>Dark 2</option>
								<option value="dark-3" <?php selected('dark-3', $settings['theme']); ?>>Dark 3</option>
								<option value="dark-thick" <?php selected('dark-thick', $settings['theme']); ?>>Dark Thick</option>
								<option value="dark-thin" <?php selected('dark-thin', $settings['theme']); ?>>Dark Thin</option>
								<option value="light" <?php selected('light', $settings['theme']); ?>>Light</option>
								<option value="light-2" <?php selected('light-2', $settings['theme']); ?>>Light 2</option>
								<option value="light-3" <?php selected('light-3', $settings['theme']); ?>>Light 3</option>
								<option value="light-thick" <?php selected('light-thick', $settings['theme']); ?>>Light Thick</option>
								<option value="light-thin" <?php selected('light-thin', $settings['theme']); ?>>Light Thin</option>
								<option value="minimal" <?php selected('minimal', $settings['theme']); ?>>Minimal</option>
								<option value="minimal-dark" <?php selected('minimal-dark', $settings['theme']); ?>>Minimal Dark</option>
								<option value="inset" <?php selected('inset', $settings['theme']); ?>>Inset</option>
								<option value="inset-dark" <?php selected('inset-dark', $settings['theme']); ?>>Inset Dark</option>
								<option value="inset-2" <?php selected('inset-2', $settings['theme']); ?>>Inset 2</option>
								<option value="inset-2-dark" <?php selected('inset-2-dark', $settings['theme']); ?>>Inset 2 Dark</option>
								<option value="inset-3" <?php selected('inset-3', $settings['theme']); ?>>Inset 3</option>
								<option value="inset-3-dark" <?php selected('inset-3-dark', $settings['theme']); ?>>Inset 3 Dark</option>
								<option value="rounded" <?php selected('rounded', $settings['theme']); ?>>Rounded</option>
								<option value="rounded-dark" <?php selected('rounded-dark', $settings['theme']); ?>>Rounded Dark</option>
								<option value="rounded-dots" <?php selected('rounded-dots', $settings['theme']); ?>>Rounded Dots</option>
								<option value="rounded-dots-dark" <?php selected('rounded-dots-dark', $settings['theme']); ?>>Rounded Dots Dark</option>
								<option value="3d" <?php selected('3d', $settings['theme']); ?>>3D</option>
								<option value="3d-dark" <?php selected('3d-dark', $settings['theme']); ?>>3D Dark</option>
								<option value="3d-thick" <?php selected('3d-thick', $settings['theme']); ?>>3D Thick</option>
								<option value="3d-thick-dark" <?php selected('3d-thick-dark', $settings['theme']); ?>>3D Thick Dark</option>								
							</select>
							<p class="description">Select your scrollbar theme. Default : Dark Thick</p> 
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="social_icon_bg1">Show scrollbar buttons</label></th>
						<td>
							<select name="jp_cs_options[show_scrollbutton]">
								<option value="true" <?php selected('true', $settings['show_scrollbutton']); ?>>Yes</option>
								<option value="false" <?php selected('false', $settings['show_scrollbutton']); ?>>No</option>
							</select>
							<p class="description">Choose your scrollbar buttons preference here. It will show buttons like arrow at the top and bottom of the scrollbar. Default : Yes</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="social_icon_bg1">Scroll speed</label></th>
						<td>
							<input id="jp_cs_options[scroll_speed]" name="jp_cs_options[scroll_speed]" type="text" value="<?php echo $settings['scroll_speed']; ?>"><p class="description">Enter scroll speed here. The larger value make scrolling faster and smaller value make scrolling slower. Default value is 250. </p>
						</td>
					</tr>					
					<tr>
						<th scope="row"><label for="social_icon_bg1">Auto hide scrollbar</label></th>
						<td>
							<select name="jp_cs_options[autohide_scrollbar]">
								<option value="true" <?php selected('true', $settings['autohide_scrollbar']); ?>>Yes</option>
								<option value="false" <?php selected('false', $settings['autohide_scrollbar']); ?>>No</option>
							</select>
							<p class="description">Select preference for autohide scrollbar. If select 'Yes', it will hide the scrollbar when your cursor is outside of the page. If select 'No', it will show the scrollbar even your cursor is outside of the page. Default : No</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="social_icon_bg1">Enable scrolling via keyboard</label></th>
						<td>
							<select name="jp_cs_options[keyboard_scroll]">
								<option value="true" <?php selected('true', $settings['keyboard_scroll']); ?>>Yes</option>
								<option value="false" <?php selected('false', $settings['keyboard_scroll']); ?>>No</option>
							</select>
							<p class="description">To enable scrolling via keyboard, select 'Yes'. If you don't want scrolling via keyboard, select 'No'. Default : Yes</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="social_icon_bg1">Auto expand scrollbar</label></th>
						<td>
							<select name="jp_cs_options[autoexpand_scrollbar]">
								<option value="true" <?php selected('true', $settings['autoexpand_scrollbar']); ?>>Yes</option>
								<option value="false" <?php selected('false', $settings['autoexpand_scrollbar']); ?>>No</option>
							</select>
							<p class="description">If select 'Yes', it will make scrollbar bolder when you mouse hover or drag the scrollbar. If select 'No', it will not change anything during mouse hover or drag. Default : Yes</p>
						</td>
					</tr>
				</table>
				<p class="submit"><input type="submit" class="button-primary" value="Save Options"></p>
			</form>
		</div>
		<?php
	}

	/*==========  validate options  ==========*/
	
	function jp_cs_validate_options($input){
		global $jp_cs_options;
		$settings = get_option('jp_cs_options', $jp_cs_options);
		//We strip all tags from the text field, to avoid vulnerabilities like XSS
		$input['theme'] = wp_filter_post_kses($input['theme']);
		$input['show_scrollbutton'] = wp_filter_post_kses($input['show_scrollbutton']);
		$input['scroll_speed'] = wp_filter_post_kses($input['scroll_speed']);
		$input['autohide_scrollbar'] = wp_filter_post_kses($input['autohide_scrollbar']);
		$input['keyboard_scroll'] = wp_filter_post_kses($input['keyboard_scroll']);
		$input['autoexpand_scrollbar'] = wp_filter_post_kses($input['autoexpand_scrollbar']);		
		return $input;
	}
}

function jp_cs_scrollbar_active(){ ?>

<?php global $jp_cs_options; $jp_cs_scrollbar_settings = get_option( 'jp_cs_options', $jp_cs_options ); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("body").mCustomScrollbar({
		theme:"<?php echo $jp_cs_scrollbar_settings['theme']; ?>",
        scrollButtons:{
          enable:<?php echo $jp_cs_scrollbar_settings['show_scrollbutton']; ?>
        },        
        mouseWheel:{ scrollAmount: <?php echo $jp_cs_scrollbar_settings['scroll_speed']; ?> },
        autoHideScrollbar: <?php echo $jp_cs_scrollbar_settings['autohide_scrollbar']; ?>,
        keyboard:{ enable: <?php echo $jp_cs_scrollbar_settings['keyboard_scroll']; ?> },
        autoExpandScrollbar: <?php echo $jp_cs_scrollbar_settings['autoexpand_scrollbar']; ?>       
        
	});
})
</script>
<?php

}
add_action('wp_footer', 'jp_cs_scrollbar_active');
?>