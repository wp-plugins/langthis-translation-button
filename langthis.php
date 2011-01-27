<?php
/*
Plugin Name: LangThis Language Translation
Plugin URI: http://www.langthis.com
Description: The Langthis Translation Widget allows any visitor to translate your site easily to about 55 Languarges. The button is added to the bottom of every post.
Author: LangThis.com
Version: 1.1
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

/* When plugin is activated */

register_activation_hook(__FILE__,'langthis_install');

/* When plugin is deactivation*/

register_deactivation_hook( __FILE__, 'langthis_remove' );

function langthis_install() {
 /* Creates new database field */
 add_option("langthis_id", '0', 'yes');
 add_option("langthis_iso", 'gb', 'yes');
}

function langthis_remove() {
 /* Deletes the database field */
 delete_option('langthis_id');
 delete_option('langthis_iso');
}

if ( is_admin() ){
 /* Call the html code */
 add_action('admin_menu', 'langthis_admin_menu');

 function langthis_admin_menu() {
  add_options_page('LangThis', 'LangThis Settings', 'administrator',
  'langthis', 'langthis_plugin_page');
 }

 function langthis_plugin_page() {
?>
<div>
<h2>LangThis.com Plugin Options Page</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<fieldset>
<label for="langthis_iso">Choose the language of your website</label><br />
<select id="langthis_iso" name="langthis_iso">
<option value="al" <?php if(get_option('langthis_iso') == 'al'){echo "selected=\"selected\"";} ?>>Albanian</option>
<option value="arab" <?php if(get_option('langthis_iso') == 'arab'){echo "selected=\"selected\"";} ?>>Arabic</option>
<option value="bg" <?php if(get_option('langthis_iso') == 'bg'){echo "selected=\"selected\"";} ?>>Bulgarian</option>
<option value="br" <?php if(get_option('langthis_iso') == 'br'){echo "selected=\"selected\"";} ?>>Brazilian P.</option>
<option value="by" <?php if(get_option('langthis_iso') == 'by'){echo "selected=\"selected\"";} ?>>Belarusian</option>
<option value="catalan" <?php if(get_option('langthis_iso') == 'catalan'){echo "selected=\"selected\"";} ?>>Catalan</option>
<option value="cn" <?php if(get_option('langthis_iso') == 'cn'){echo "selected=\"selected\"";} ?>>Chinese S.</option>
<option value="cz" <?php if(get_option('langthis_iso') == 'cz'){echo "selected=\"selected\"";} ?>>Czech</option>
<option value="de" <?php if(get_option('langthis_iso') == 'de'){echo "selected=\"selected\"";} ?>>German</option>
<option value="dk" <?php if(get_option('langthis_iso') == 'dk'){echo "selected=\"selected\"";} ?>>Danish</option>
<option value="es" <?php if(get_option('langthis_iso') == 'es'){echo "selected=\"selected\"";} ?>>Spanish</option>
<option value="fi" <?php if(get_option('langthis_iso') == 'fi'){echo "selected=\"selected\"";} ?>>Finnish</option>
<option value="fr" <?php if(get_option('langthis_iso') == 'fr'){echo "selected=\"selected\"";} ?>>French</option>
<option value="galician" <?php if(get_option('langthis_iso') == 'galician'){echo "selected=\"selected\"";} ?>>Galician</option>
<option value="gb" <?php if(get_option('langthis_iso') == 'gb'){echo "selected=\"selected\"";} ?>>English</option>
<option value="gr" <?php if(get_option('langthis_iso') == 'gr'){echo "selected=\"selected\"";} ?>>Greek</option>
<option value="hr" <?php if(get_option('langthis_iso') == 'hr'){echo "selected=\"selected\"";} ?>>Croatian</option>
<option value="hu" <?php if(get_option('langthis_iso') == 'hu'){echo "selected=\"selected\"";} ?>>Hungarian</option>
<option value="id" <?php if(get_option('langthis_iso') == 'id'){echo "selected=\"selected\"";} ?>>Indonesian</option>
<option value="ie" <?php if(get_option('langthis_iso') == 'ie'){echo "selected=\"selected\"";} ?>>Irish</option>
<option value="il" <?php if(get_option('langthis_iso') == 'il'){echo "selected=\"selected\"";} ?>>Hebrew</option>
<option value="in" <?php if(get_option('langthis_iso') == 'in'){echo "selected=\"selected\"";} ?>>Hindi</option>
<option value="ir" <?php if(get_option('langthis_iso') == 'ir'){echo "selected=\"selected\"";} ?>>Persian</option>
<option value="is" <?php if(get_option('langthis_iso') == 'is'){echo "selected=\"selected\"";} ?>>Icelandic</option>
<option value="it" <?php if(get_option('langthis_iso') == 'it'){echo "selected=\"selected\"";} ?>>Italian</option>
<option value="jp" <?php if(get_option('langthis_iso') == 'jp'){echo "selected=\"selected\"";} ?>>Japanese</option>
<option value="kr" <?php if(get_option('langthis_iso') == 'kr'){echo "selected=\"selected\"";} ?>>Korean</option>
<option value="latin" <?php if(get_option('langthis_iso') == 'latin'){echo "selected=\"selected\"";} ?>>Latin</option>
<option value="latinamerica" <?php if(get_option('langthis_iso') == 'latinamerica'){echo "selected=\"selected\"";} ?>>Latin Am..</option>
<option value="lt" <?php if(get_option('langthis_iso') == 'lt'){echo "selected=\"selected\"";} ?>>Lithuanian</option>
<option value="lv" <?php if(get_option('langthis_iso') == 'lv'){echo "selected=\"selected\"";} ?>>Latvian</option>
<option value="mk" <?php if(get_option('langthis_iso') == 'mk'){echo "selected=\"selected\"";} ?>>Macedonian</option>
<option value="mt" <?php if(get_option('langthis_iso') == 'mt'){echo "selected=\"selected\"";} ?>>Maltese</option>
<option value="my" <?php if(get_option('langthis_iso') == 'my'){echo "selected=\"selected\"";} ?>>Malay</option>
<option value="nl" <?php if(get_option('langthis_iso') == 'nl'){echo "selected=\"selected\"";} ?>>Dutch</option>
<option value="no" <?php if(get_option('langthis_iso') == 'no'){echo "selected=\"selected\"";} ?>>Norwegian</option>
<option value="ph" <?php if(get_option('langthis_iso') == 'ph'){echo "selected=\"selected\"";} ?>>Filipino</option>
<option value="pl" <?php if(get_option('langthis_iso') == 'pl'){echo "selected=\"selected\"";} ?>>Polish</option>
<option value="pt" <?php if(get_option('langthis_iso') == 'pt'){echo "selected=\"selected\"";} ?>>Portuguese</option>
<option value="ro" <?php if(get_option('langthis_iso') == 'ro'){echo "selected=\"selected\"";} ?>>Romanian</option>
<option value="rs" <?php if(get_option('langthis_iso') == 'rs'){echo "selected=\"selected\"";} ?>>Serbian</option>
<option value="ru" <?php if(get_option('langthis_iso') == 'ru'){echo "selected=\"selected\"";} ?>>Russian</option>
<option value="se" <?php if(get_option('langthis_iso') == 'se'){echo "selected=\"selected\"";} ?>>Swedish</option>
<option value="sk" <?php if(get_option('langthis_iso') == 'sk'){echo "selected=\"selected\"";} ?>>Slovak</option>
<option value="th" <?php if(get_option('langthis_iso') == 'th'){echo "selected=\"selected\"";} ?>>Thai</option>
<option value="tr" <?php if(get_option('langthis_iso') == 'tr'){echo "selected=\"selected\"";} ?>>Turkish</option>
<option value="tw" <?php if(get_option('langthis_iso') == 'tw'){echo "selected=\"selected\"";} ?>>Chinese T.</option>
<option value="tz" <?php if(get_option('langthis_iso') == 'tz'){echo "selected=\"selected\"";} ?>>Swahili</option>
<option value="ua" <?php if(get_option('langthis_iso') == 'ua'){echo "selected=\"selected\"";} ?>>Ukranian</option>
<option value="vn" <?php if(get_option('langthis_iso') == 'vn'){echo "selected=\"selected\"";} ?>>Vietnamese</option>
<option value="wales" <?php if(get_option('langthis_iso') == 'wales'){echo "selected=\"selected\"";} ?>>Welsh</option>
<option value="yiddish" <?php if(get_option('langthis_iso') == 'yiddish'){echo "selected=\"selected\"";} ?>>Yiddish</option>
<option value="za" <?php if(get_option('langthis_iso') == 'za'){echo "selected=\"selected\"";} ?>>Afrikaans</option>
</select>
<br /><br />
<label for="langthis_id">Your LangThis Account ID (<a href="http://www.langthis.com/user/register.php" target="_blank">Get One</a>)</label><br />
<input name="langthis_id" type="text" id="langthis_id" value="<?php echo get_option('langthis_id'); ?>" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="langthis_id,langthis_iso" />
<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php
 }
}
class LangThisWidget {
	
	// Constructor
	function LangThisWidget(){
		add_filter('the_content', array(&$this, 'codeToContent'));
	}
	
	function codeToContent($content){  
		// Add nothing to RSS feed.
		if (is_feed()) return $content;
		// Add nothing to categories.
		if (is_category()) return $content;
		// Get the link.
		$link  = urlencode(get_permalink());
		return $content.$this->getLangThisCode($link);
	}
	
	// Get the actual button code.
	function getLangThisCode($link) {
		$langthis_code = '<script type="text/javascript" src="http://www.langthis.com/langthisjs.php?site='.get_option('langthis_id').'&from='.get_option('langthis_iso').'"></script>';
		$langthis_code .=	'<a href="http://www.langthis.com/" style="padding:0;margin:0;" class="langthis"><img src="http://www.langthis.com/img/btn-gb1.png" alt="Translation button!" /></a>';
        return $langthis_code;
	}
	
	function LangThisWidget_doposts($content){  
		for ($i=0; $i<10; $i++){
			$content .= $this->LangThisWidget_post($i);
		}
		return $content;
	}
	
	function LangThisWidget_post($entry){
		$link  = urlencode(get_permalink());
		if (!isset($link)){
			$widget_post  = $this->getLangThisCode($link);
			$widget_post .= $this->LangThisWidget_postit($entry);
		}
		return $widget_post;
	}
	
	function LangThisWidget_postit($i){
		add_filter('the_content', array(&$this, 'codeToContent'));
		$content = $this->codeToContent($content);
		
		$cut = explode("|", $content);
		$post = $cut[0];
		$link  = $cut[1]; 
		return content . "<br />$link";
	}
}

$langthis_this &= new LangThisWidget();
?>