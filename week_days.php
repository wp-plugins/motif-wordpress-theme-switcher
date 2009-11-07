
<?php
require('functions.php');

$array_days = $this->array_days;

//build the page_options value for updating options. WordPress method.
$page_options = "enable_motif_theme_switcher";
$page_options .= ", motif_gacode";
foreach($array_days as $key=>$val){
	$page_options .= ", motif_". $key;
}
//reset the array;
reset($array_days);

//get the themes
$themes = get_themes();
$theme_names = array_keys($themes);
natcasesort($theme_names);

$current_theme=  get_current_theme();



$plugin_state_enabled = get_option('enable_motif_theme_switcher');

if($plugin_state_enabled == ""){
	$plugin_state_enabled = "n";
}


?>



<div class="wrap">
<form method="post" action="options.php"><input type="hidden"
	name="action" value="update" /> <input type="hidden"
	name="page_options" value="<?php echo $page_options; ?>" /> <?php wp_nonce_field('update-options'); ?>
<div id="motif_ts">
<h2>Motif WP Theme Switcher</h2>

<p><strong>Enable automatic switching of themes? </strong> <br />

<input id="enable_motif_yes" type="radio"
	name="enable_motif_theme_switcher" value="y"
	<?php echo ("y" == $plugin_state_enabled)?"checked=\"checked\"":""; ?> /><label
	for="enable_motif_yes">Yes, automatically switch themes on my blog
every day as setup below</label> <br />
<input id="enable_motif_no" type="radio"
	name="enable_motif_theme_switcher" value="n"
	<?php echo ("n" == $plugin_state_enabled)?"checked=\"checked\"":""; ?> /><label
	for="enable_motif_no">No, load my default current selected WordPress
theme (<?php echo $current_theme; ?>) and stop automatic switching of themes</label></p>

<p><strong>Google Analytics Code</strong> <br />
<em>Enter your complete google analytics tracking code here, if you have
not already embeded it in your theme files.</em> <textarea rows="7"
	cols="70" name="motif_gacode"><?php echo get_option('motif_gacode');?></textarea>

<p><strong>Assign themes for each day of the week</strong><br />
<em>(if any of the day is left unassigned the default current selected theme of WordPress would be loaded)</em></p>



<div id="theme_shot_container"><?php 

$theme_base_uri = get_theme_baseuri();

foreach($theme_names as $theme_name):
	$template = $themes[$theme_name]['Template'];
	$screenshot = $themes[$theme_name]['Screenshot'];
	$stylesheet_dir = $themes[$theme_name]['Stylesheet Dir'];
	$title = $themes[$theme_name]['Title'];?>

	<div class="motif_theme_shot"><?php
		if ($screenshot) :
			$screenshot_path = $theme_base_uri . "/". $stylesheet_dir . '/' . $screenshot
			?> <img src="<?php echo $screenshot_path; ?>" alt="" width="300px" height="225px" /><br />
		<?php endif; ?>
		<?php echo $title; ?>


		<div class="days_container">
		
			<?php 
			reset($array_days);
			foreach ($array_days as $key => $day):
				$class = strtolower(substr($day,0,3));
				$checked = "";
				if(get_option("motif_".$key) == $template){
					$checked = "checked=\"checked\"";
				}?>
				<div class="day">
				<input id="<?php echo "motif_".$key."_". $template ?>" type="radio" name="<?php echo "motif_".$key ?>" value="<?php echo $template; ?>" <?php echo $checked ?> />
					 	<br/>
						
						<label for="<?php echo "motif_".$key."_". $template ?>"><?php echo substr($day,0,3);?></label>
					</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endforeach;  ?>

<div class="clr"><input type="submit" name="Submit"
	value="<?php _e('Save Changes') ?>" /></div>
</div>

</div>

</form>
</div>
