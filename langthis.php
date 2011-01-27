<?php
/*
Plugin Name: LangThis Language Translation
Plugin URI: http://www.langthis.com
Description: The Langthis Translation Widget allows any visitor to translate your site easily to about 55 Languarges.
Author: LangThis.com
Version: 2.0
Author URI: http://www.langthis.com
*/
/*  Copyright 2010  LangThis.com  (email : langthis@langthis.com)

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

add_action( 'widgets_init', 'langthis_load_widgets' );

function langthis_load_widgets() {
	register_widget( 'Langthis_Widget' );
}

class Langthis_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Langthis_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'langthis-widget', 'description' => __('The Langthis Translation Widget allows any visitor to translate your site easily to about 55 Languarges.', 'langthis') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 240, 'height' => 400, 'id_base' => 'langthis-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'langthis-widget', __('Langthis Widget', 'langthis'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$siteid = $instance['siteid'];
		$iso = $instance['iso'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Displays the javascript code for the button. */
		echo "<script type=\"text/javascript\" src=\"http://www.langthis.com/langthisjs.php";
		
		/* If iso field exist */
		if ( $iso ){
			echo "?from=".$iso;}
		else {
			echo "?from=gb";}
		
		/* If username field exist */
		if ( $name )
			echo "&amp;user=".$name;

		/* If siteid field exist */
		if ( $siteid )
			echo "&amp;site=".$siteid;
			
		/* End of javascript */
		echo "\"></script>";

		/* The button shown. */
		echo '<p style="text-align:center;align:center;"><a href="http://www.langthis.com/" style="padding:0;margin:0;outline:0;" class="langthis"><img src="http://www.langthis.com/img/btn-gb1.png" alt="Translation button!" /></a></p>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['siteid'] = strip_tags( $new_instance['siteid'] );

		/* No need to strip tags for sex and show_sex. */
		$instance['iso'] = $new_instance['iso'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Langthis Translation', 'langthis'), 'name' => __('', 'langthis'), 'siteid' => __('', 'langthis'), 'iso' => 'gb');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your Userame: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Username:', 'langthis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>
        
		<!-- Your Site id: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'siteid' ); ?>"><?php _e('Your Siteid:', 'langthis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'siteid' ); ?>" name="<?php echo $this->get_field_name( 'siteid' ); ?>" value="<?php echo $instance['siteid']; ?>" style="width:100%;" />
		</p>

		<!-- Sex: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'iso' ); ?>"><?php _e('Language of your website:', 'langthis'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'iso' ); ?>" name="<?php echo $this->get_field_name( 'iso' ); ?>" class="widefat" style="width:100%;">
<option value="gb" <?php if ( 'gb' == $instance['iso'] ) echo 'selected="selected"'; ?>>English</option>
<option value="al" <?php if ( 'al' == $instance['iso'] ) echo 'selected="selected"'; ?>>Albanian</option>
<option value="arab" <?php if ( 'arab' == $instance['iso'] ) echo 'selected="selected"'; ?>>Arabic</option>
<option value="bg" <?php if ( 'bg' == $instance['iso'] ) echo 'selected="selected"'; ?>>Bulgarian</option>
<option value="br" <?php if ( 'br' == $instance['iso'] ) echo 'selected="selected"'; ?>>Brazilian P.</option>
<option value="by" <?php if ( 'by' == $instance['iso'] ) echo 'selected="selected"'; ?>>Belarusian</option>
<option value="catalan" <?php if ( 'catalan' == $instance['iso'] ) echo 'selected="selected"'; ?>>Catalan</option>
<option value="cn" <?php if ( 'cn' == $instance['iso'] ) echo 'selected="selected"'; ?>>Chinese S.</option>
<option value="cz" <?php if ( 'cz' == $instance['iso'] ) echo 'selected="selected"'; ?>>Czech</option>
<option value="de" <?php if ( 'de' == $instance['iso'] ) echo 'selected="selected"'; ?>>German</option>
<option value="dk" <?php if ( 'dk' == $instance['iso'] ) echo 'selected="selected"'; ?>>Danish</option>
<option value="es" <?php if ( 'es' == $instance['iso'] ) echo 'selected="selected"'; ?>>Spanish</option>
<option value="fi" <?php if ( 'fi' == $instance['iso'] ) echo 'selected="selected"'; ?>>Finnish</option>
<option value="fr" <?php if ( 'fr' == $instance['iso'] ) echo 'selected="selected"'; ?>>French</option>
<option value="galician" <?php if ( 'galician' == $instance['iso'] ) echo 'selected="selected"'; ?>>Galician</option>
<option value="gr" <?php if ( 'gr' == $instance['iso'] ) echo 'selected="selected"'; ?>>Greek</option>
<option value="hr" <?php if ( 'hr' == $instance['iso'] ) echo 'selected="selected"'; ?>>Croatian</option>
<option value="hu" <?php if ( 'hu' == $instance['iso'] ) echo 'selected="selected"'; ?>>Hungarian</option>
<option value="id" <?php if ( 'id' == $instance['iso'] ) echo 'selected="selected"'; ?>>Indonesian</option>
<option value="ie" <?php if ( 'ie' == $instance['iso'] ) echo 'selected="selected"'; ?>>Irish</option>
<option value="il" <?php if ( 'il' == $instance['iso'] ) echo 'selected="selected"'; ?>>Hebrew</option>
<option value="in" <?php if ( 'in' == $instance['iso'] ) echo 'selected="selected"'; ?>>Hindi</option>
<option value="ir" <?php if ( 'ir' == $instance['iso'] ) echo 'selected="selected"'; ?>>Persian</option>
<option value="is" <?php if ( 'is' == $instance['iso'] ) echo 'selected="selected"'; ?>>Icelandic</option>
<option value="it" <?php if ( 'it' == $instance['iso'] ) echo 'selected="selected"'; ?>>Italian</option>
<option value="jp" <?php if ( 'jp' == $instance['iso'] ) echo 'selected="selected"'; ?>>Japanese</option>
<option value="kr" <?php if ( 'kr' == $instance['iso'] ) echo 'selected="selected"'; ?>>Korean</option>
<option value="latin" <?php if ( 'latin' == $instance['iso'] ) echo 'selected="selected"'; ?>>Latin</option>
<option value="latinamerica" <?php if ( 'latinamerica' == $instance['iso'] ) echo 'selected="selected"'; ?>>Latin Am..</option>
<option value="lt" <?php if ( 'lt' == $instance['iso'] ) echo 'selected="selected"'; ?>>Lithuanian</option>
<option value="lv" <?php if ( 'lv' == $instance['iso'] ) echo 'selected="selected"'; ?>>Latvian</option>
<option value="mk" <?php if ( 'mk' == $instance['iso'] ) echo 'selected="selected"'; ?>>Macedonian</option>
<option value="mt" <?php if ( 'mt' == $instance['iso'] ) echo 'selected="selected"'; ?>>Maltese</option>
<option value="my" <?php if ( 'my' == $instance['iso'] ) echo 'selected="selected"'; ?>>Malay</option>
<option value="nl" <?php if ( 'nl' == $instance['iso'] ) echo 'selected="selected"'; ?>>Dutch</option>
<option value="no" <?php if ( 'no' == $instance['iso'] ) echo 'selected="selected"'; ?>>Norwegian</option>
<option value="ph" <?php if ( 'ph' == $instance['iso'] ) echo 'selected="selected"'; ?>>Filipino</option>
<option value="pl" <?php if ( 'pl' == $instance['iso'] ) echo 'selected="selected"'; ?>>Polish</option>
<option value="pt" <?php if ( 'pt' == $instance['iso'] ) echo 'selected="selected"'; ?>>Portuguese</option>
<option value="ro" <?php if ( 'ro' == $instance['iso'] ) echo 'selected="selected"'; ?>>Romanian</option>
<option value="rs" <?php if ( 'rs' == $instance['iso'] ) echo 'selected="selected"'; ?>>Serbian</option>
<option value="ru" <?php if ( 'ru' == $instance['iso'] ) echo 'selected="selected"'; ?>>Russian</option>
<option value="se" <?php if ( 'se' == $instance['iso'] ) echo 'selected="selected"'; ?>>Swedish</option>
<option value="sk" <?php if ( 'sk' == $instance['iso'] ) echo 'selected="selected"'; ?>>Slovak</option>
<option value="th" <?php if ( 'th' == $instance['iso'] ) echo 'selected="selected"'; ?>>Thai</option>
<option value="tr" <?php if ( 'tr' == $instance['iso'] ) echo 'selected="selected"'; ?>>Turkish</option>
<option value="tw" <?php if ( 'tw' == $instance['iso'] ) echo 'selected="selected"'; ?>>Chinese T.</option>
<option value="tz" <?php if ( 'tz' == $instance['iso'] ) echo 'selected="selected"'; ?>>Swahili</option>
<option value="ua" <?php if ( 'ua' == $instance['iso'] ) echo 'selected="selected"'; ?>>Ukranian</option>
<option value="vn" <?php if ( 'vn' == $instance['iso'] ) echo 'selected="selected"'; ?>>Vietnamese</option>
<option value="wales" <?php if ( 'wales' == $instance['iso'] ) echo 'selected="selected"'; ?>>Welsh</option>
<option value="yiddish" <?php if ( 'yiddish' == $instance['iso'] ) echo 'selected="selected"'; ?>>Yiddish</option>
<option value="za" <?php if ( 'za' == $instance['iso'] ) echo 'selected="selected"'; ?>>Afrikaans</option>
			</select>
		</p>
        <ul style="font-size:9px;" class="infolinks">
			<li><a href="http://www.langthis.com/user/register.php" target="_blank">Create an account</a></li>
            <li><a href="http://www.langthis.com" target="_blank">Login for more settings</a></li>
			<li><a href="http://www.langthis.com/help.php" target="_blank">Help</a></li>
		</ul>
	<?php
	}
}

?>