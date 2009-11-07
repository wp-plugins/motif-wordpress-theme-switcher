<?php

/*
Plugin Name: Motif WordPress Theme Switcher
Plugin URI: http://kodemaster.co.cc/motif
Description: This plugin automatically changes your theme on each day based on the theme you have set for that day. To setup themes for each day goto your blog's Design or Appearence Section and click on Motif WP Theme Switcher.
Author: Penuel Ratnagrahi
Version: 1.0
Author URI: http://kodemaster.co.cc
*/


/*  Copyright 2009 Penuel Ratnagrahi  (email : penuel@codetoon.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class MotifWPThemeSwitcher{
	
	var $dirName	= "";
	var $title		= "Motif WordPress Theme Switcher";
	var $array_days = array(0=>"Sunday",1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thursday",5=>"Friday",6=>"Saturday");
	
	public function __construct(){
		
		$this->dirName =  str_replace(basename(__FILE__),"",plugin_basename(__FILE__));
		
	}
	
	/*
	 * plugin options and setting forms stylesheet.
	 */
	public function admin_stylesheets(){				
		
		$csspath = get_option('siteurl') ."/".  PLUGINDIR .'/'. $this->dirName ."style.css";
				 		 
		echo "<link href=\"$csspath \" type=\"text/css\" rel=\"stylesheet\"/>";
	 
	}
	
	/*
	 * Register the plugin options menu. Inside the design section!
	 */
	public function registerMenus(){
		
		add_theme_page("Motif WP Theme Switcher","Motif WP Theme Switcher",8, __FILE__,array($this,'drawOptionsScreen'));
	}
	
	/*
	 * Draw the plugin options screen. 
	 * Will allow to set the themes for each day.
	 */
	public function drawOptionsScreen(){
		include("week_days.php");
	}
	
	/*
	 * Shows the update successfull notification
	 */
	
	public function update_notice(){
		if(isset($_GET['updated']) && $_GET["updated"] == "true"){
			echo "<div id='motif_notice' class='updated fade'><p><strong>".__("Themes configured successfully")."</strong></p></div>";		
		}
	}
	
	/*
	 * heart of the plugin, checks the day and changes the template.
	 */
	
	public function getTemplate($template){
		if(get_option('enable_motif_theme_switcher') == "y"){	
			
			$week_day = date("w");
			
			$template_key = "motif_". $week_day;
			
			$new_template =  get_option($template_key);
			
			if($new_template!=""){
				return $new_template;
				
			}
			else{
				return $template;	//default template.
			}
			
		}
		else{
			
			//plugin not effective, return the current selected template
			return $template;	
		}
		
	}
	
	
	public function switchTemplate($template){
		return $this->getTemplate($template);
	}
	
	public function switchStyleSheet($template){
		return $this->getTemplate($template);
	}
	
	public function applyGoogleAnalytics(){
		$motif_gacode = "\n<!-- embeded by motif theme switcher: Google Analytics code begin--> \n";
		$motif_gacode .= get_option('motif_gacode');
		$motif_gacode .= "\n<!-- embeded by motif theme switcher: Google Analytics code end-->\n";
				
		echo $motif_gacode;	
	}
}




/*initialize */
$motif = new MotifWPThemeSwitcher();

//register with wp hooks and filters.
add_action("admin_menu", array($motif,'registerMenus'));

add_action('admin_notices',array($motif, 'update_notice'));

add_action("admin_head", array($motif,'admin_stylesheets'));

//switch the template directory
add_filter("template", array($motif,'switchTemplate'));

//switch the template stylesheet
add_filter("stylesheet", array($motif,'switchStyleSheet'));

//apply Google Analytics code
add_action("get_footer", array($motif,'applyGoogleAnalytics'));



