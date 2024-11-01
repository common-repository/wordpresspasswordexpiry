<?php
/*
Plugin Name: WordPress Password Expiry
Description: This plugin expires a user's access to the site after every specified number of days (initially set to 30 days).You can select the type of user/users for whom password should expire. After expiration, users needs to reset their password by clicking on 'Reset' link on the login page.  
Plugin URI:http://wordpress.org/extend/plugins/wordpresspasswordexpiry/
Author: WisdmLabs
Author URI:http://wisdmlabs.com
Version: 1.5
License: GPLv2
Network: true
Text Domain: pran

"WordPress Password Expiry"
Copyright (C) 2012  WisdmLabs

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require(ABSPATH .'wp-includes/pluggable.php');

add_action('admin_init', 'reg_setting' );

//Admin menu for this plugin
add_action('admin_menu', 'register_password_expire_period');

function reg_setting()
{
    register_setting('exp_options','exp_user');
}

function register_password_expire_period()
{
    $iconurl = plugins_url()."/wordpresspasswordexpiry/img/icon.png";
    
    add_menu_page('wordpresspasswordexpiry', '<div style="font-size:12px;">Password Expiry</div>', 'administrator', 'wordpresspasswordexpiry', 'password_expire_period', $iconurl);
	
}
 
function password_expire_period() 
{
    global $current_user;
    get_currentuserinfo();
    $note=0; 
?>

<!-- Set password expiry period and custom error message -->

<div class="wrap wdm_leftwrap" id="wdm_wpe_page">
    
<h2>WordPress Password Expiry</h2>

<div id="wpe_form_content">
    
<form name="exp_form" method="POST" id="wdm_wpe_form" action="options.php">

<?php
    settings_fields('exp_options'); 

    $site_users =   array('exp_day' => 30,
			'exp_msg' => 'Your Password Has Expired.',
			'first_admin' => 0,
			'reset_option' => 'auto',
			'contact_email' => get_option('admin_email'),
			'custom_reset' => 'Please contact your administrator to reset your password.'
		       );

    $exp_data = get_option( 'exp_user', $site_users);?>

<div class="wpe_exp_content">
    
<p class="wpe_ip_label">Set password expiry period</p>
<input type="text" name="exp_user[exp_day]" size="2" class="number required" min=0 value="<?php echo $exp_data['exp_day'];?>" /> days

</div>

<div class="wpe_exp_content">
    
<p class="wpe_ip_label">Set custom error message</p> 
<input class="wpe_input_size" id="wpe_msg_ip" type="text" name="exp_user[exp_msg]" value="<?php echo $exp_data['exp_msg'];?>" />

</div>
 
<div class="wpe_exp_content">
    
<p class="wpe_ip_label">Select user roles</p>

<ul id="wpe_role_list" class="wdm_wpe_list">
    
<?php

    if($current_user->ID==1) 
    {
?>
    <li>
	<input id="wpe_main_admin_option" type="checkbox" name="exp_user[first_admin]" value="1" <?php checked( '1', $exp_data['first_admin'] ); $note=1; ?> />
	Main Administrator <span id="wpe_main_admin_text">(Only you can manage this)</span>
    </li>
<?php

    }

    if ( !isset( $wp_roles ) )
    $wp_roles = new WP_Roles();

    $all_roles = $wp_roles->roles;
	foreach ( $all_roles as $role => $details ) 
	{
		$name = translate_user_role($details['name'] );
		?>
		<li>
		    <input type="checkbox" name="exp_user[<?php echo esc_attr($role);?>]" value="1" <?php checked( '1', $exp_data[esc_attr($role)] ); ?> />
		    <?php echo $name;?>
		</li>
	<?php
	}
	
	?>
</ul>
</div>

<div class="wpe_exp_content">
    
<p class="wpe_ip_label">Select option to reset password</p>

<ul id="wpe_reset_list" class="wdm_wpe_list">
    
<li> 
    <input id="exp_auto_opt" type="radio" name="exp_user[reset_option]" value="auto" <?php checked( 'auto', $exp_data['reset_option'] ); ?> />
    <label for="exp_auto_opt"> User can reset password using 'Reset' link </label>
</li>
	
<li class="wpe_cont_email_check">
    <input id="exp_cont_opt" type="radio" name="exp_user[reset_option]" value="contact" <?php checked( 'contact', $exp_data['reset_option'] ); ?> />
    <label for="exp_cont_opt"> User should contact using 'Request' link </label>
</li>

<li class="wpe_cont_email_check" id="wpe_cont_email_list">
    <label for="exp_cont_email" style="color: #4B4B4D;"> <strong>Contact Email</strong> </label>
    <input id="exp_cont_email" class="required email wpe_input_size" type="text" name="exp_user[contact_email]" value="<?php echo empty($exp_data['contact_email']) ? get_option('admin_email') : $exp_data['contact_email']; ?>" />
</li>

<li class="wpe_cust_msg_check">
    <input id="exp_cust_opt" type="radio" name="exp_user[reset_option]" value="custom" <?php checked( 'custom', $exp_data['reset_option'] ); ?> />
    <label for="exp_cust_opt"> Disable links and put a custom message </label>
</li>

<li class="wpe_cust_msg_check" id="wpe_cust_msg_list">
    <textarea class="wpe_input_size" name="exp_user[custom_reset]" /><?php echo empty($exp_data['custom_reset']) ? 'Please contact your administrator to reset your password.' : $exp_data['custom_reset']; ?></textarea>
</li>

</ul>

</div>
       
<p class="submit" id="wpe_submit_settings">
    <input type="submit" class="button-primary" value="Save Changes" name="submit"/>
</p>

</form>

             
<?php           

//Validation of expiry field

if ( is_numeric( $exp_data['exp_day'] ) == TRUE )
{

    if( $exp_data['exp_day'] >= 0 )
    {
	echo "<p class='wpe_notify_msg'> Your site user's password will expire after <b>".$exp_data['exp_day']."</b> day(s) of their login. </p>";
    }

}

?>

</div>

<?php if($note==1)
{
    ?>
<br />    
<div id="wdm_wpe_notification">
    
<p class="wpe_ip_label">Please Note:</p>
Here,
<br>
<ul id="wpe_note_list">

<li>'Main Administrator' option is for -<br>
(<i>very first admin at the time of site install & configuration</i>).</li>
<li>'Administrators' option is for -<br>
(<i>admin users created after 'Main Administrator'</i>).</li>
<li>Other Administrative users can not see first option i.e. 'Main Administrator' and hence can not manage it, even if one of them has installed this plugin.</li>
<li>You are able to see this NOTE and can manage this option because <strong>you are detected as 'Main Administrator'</strong>.</li>
<li id="wpe_main_admin_note" style="color: #960000;"> <strong>SORRY!</strong><br /> Main Administrator's password can only be reset using 'Reset' link option. </li>
</ul>

</div>
<?php
}
?>
</div>

<?php

    wp_enqueue_style('wdm_wpe_BE', plugins_url('css/wpe_be.css', __FILE__));
    
    //include WisdmLabs sidebar
    
    $plugin_data  = get_plugin_data(__FILE__);
    $plugin_name = $plugin_data['Name'];
    $wdm_plugin_slug = 'wordpresspasswordexpiry';
    
    include_once('wisdm_sidebar/wisdm_sidebar.php');
    create_wisdm_sidebar($plugin_name, $wdm_plugin_slug);
    
    wp_enqueue_script('wpe_respot_preview',plugins_url('js/wpe_resopt_prev.js', __FILE__),array('jquery'));
}

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * If we're in the WordPress Admin, hook into profile update
 *
 * @since 1.0
 */

function pran_admin() 
{
	if ( is_admin() )
	{	add_action( 'user_profile_update_errors', 'pran_profile_update', 11, 3 );
               
	}
}

add_action( 'init', 'pran_admin' );

/**
 * When user successfully changes their password, set the timestamp in user meta.
 *
 * @param WP_Error $errors Errors, by ref.
 * @param bool $update Unknown, by ref.
 * @param object $user User object, by ref.
 * @since 1.0
 */
function pran_profile_update( $errors, $update, $user ) {
	/**
	 * Bail out if there are errors attached to the change password profile field,
	 * or if the password is not being changed.
	 */
	if ( $errors->get_error_data( 'pass' ) || empty( $_POST['pass1'] ) || empty( $_POST['pass2'] ) )
		return;

	// Store timestamp
	update_user_meta( $user->ID, 'pran', time());
}

/**
 * When user successfully resets their password, re-set the timestamp.
 *
 * @param object $user User object
 * @since 1.0
 */
function pran_password_reset( $user ) {
	update_user_meta( $user->ID, 'pran', time());
}

add_action( 'password_reset', 'pran_password_reset' );

/**
 * When the user logs in, check that their meta timestamp is still in the allowed range.
 * If it isn't, prevent log in.
 *
 * @param WP_Error|WP_User $user WP_User object if login was successful, otherwise WP_Error object.
 * @param string $username
 * @param string $password
 * @return WP_Error|WP_User WP_User object if login was successful and had not expired, otherwise WP_Error object.
 * @since 1.0
 */

function pran_handle_log_in( $user, $username, $password )
{

	// Check if an error has already been set
	if ( is_wp_error( $user ) )
		return $user;


	// Check we're dealing with a WP_User object
	if ( ! is_a( $user, 'WP_User' ) )
		return $user;

	// This is a log in which would normally be succesful
	$user_id = $user->data->ID;


	// If no timestamp set, it's probably the user's first log in attempt since this plugin was installed, so set the timestamp to now
	$timestamp = (int)get_user_meta( $user_id, 'pran', true ); 

	if ( empty( $timestamp ) )
	{
		$timestamp = time();		
	}
              
	update_user_meta( $user_id, 'pran', $timestamp );

        
        $exp_data=get_option( 'exp_user');
         
        $diff=time()-$timestamp;
         
        $mess_exp=$exp_data['exp_msg'];

        $day=$exp_data['exp_day'];
         
	$login_expiry = defined( 'PRAN_EXPIRY' ) ? PRAN_EXPIRY : 60 * 60 * 24 * $day; 

	$cur_user = new WP_User( $user_id );

	if ( !empty( $cur_user->roles ) && is_array( $cur_user->roles ) ) 
	{
	    foreach ( $cur_user->roles as $role )
	    $cur_user_role = $role;
	}
	

	// first admin
	if($exp_data['first_admin']==1)
	{
	    if($cur_user_role == 'administrator' && $user_id ==1)
	    {
	        $user = wdm_pwd_expire($diff, $login_expiry, $mess_exp, $user, $cur_user_role);
	        
	        return $user;
	    }
	}
    
	// other users
	if ( !isset( $wp_roles ) )
	$wp_roles = new WP_Roles();
    
	$all_roles = $wp_roles->roles;
    
	foreach( $all_roles as $role => $details ) 
	{
	    if($exp_data[esc_attr($role)]==1)
	    { 
	        if($cur_user_role == esc_attr($role) && $user_id !=1)
	        {
	    	$user = wdm_pwd_expire($diff, $login_expiry, $mess_exp, $user, $cur_user_role);
	        
	    	return $user;
	        }
	    }
	}

	return $user;
}

add_filter( 'authenticate', 'pran_handle_log_in', 30, 3 );

// Error message to user after expiry  

function wdm_pwd_expire($diff, $login_expiry, $mess_exp, $user, $cur_user_role)
{ 
    if ( $diff >= $login_expiry )
	{   
	    $exp_data = get_option('exp_user');
	    
	    if($exp_data['reset_option'] === 'contact')
	    {
		$reset_text  = '<form class="wpe_req_link" method="post">';
		$reset_text .= '<input id="wpe_curr_usr_name" type="hidden" name="wpe_curr_usr_name" value="'. base64_encode($user->data->user_login) .'" />';
		$reset_text .= '<input id="wpe_curr_usr_email" type="hidden" name="wpe_curr_usr_email" value="'. base64_encode($user->data->user_email) .'" />';
		$reset_text .= '<input id="wpe_curr_usr_role" type="hidden" name="wpe_curr_usr_role" value="'. base64_encode($cur_user_role) .'" />';
		$reset_text .= '<button class="wpe_req_link" name="wdm_wpe_reset" /> <a> Request </a> </button> for a new password.';
		$reset_text .= '</form>';
	    }
	    
	    elseif($exp_data['reset_option'] === 'custom')
	    {
		$reset_text = $exp_data['custom_reset'];
	    }
	    
	    else
	    {
		$reset_link = site_url( 'wp-login.php?action=lostpassword', 'login' );
		$reset_text = 'Please <a href="'. $reset_link .'"> <strong> Reset </strong> </a> your password.';
	    }
	    
	    $get_err = new WP_Error( 'authentication_failed', sprintf( __( '<strong>Sorry !</strong> <br />%s<br />
	 %s', 'pran' ), $mess_exp, $reset_text ) );
	
	    return $get_err;
	}
	
    else
	return $user;
}

//Contact admin to reset password

function wdm_contact_admin()
{
    wp_enqueue_style('wdm_wpe_FE', plugins_url('css/wpe_fe.css', __FILE__));
    
    if(isset($_POST['wdm_wpe_reset']))
    {
		$exp_data = get_option('exp_user');
		
		$wpe_curr_usr_name 	= isset($_POST['wpe_curr_usr_name']) ? $_POST['wpe_curr_usr_name'] : '';
		$wpe_curr_usr_email 	= isset($_POST['wpe_curr_usr_email']) ? $_POST['wpe_curr_usr_email'] : '';
		$wpe_curr_usr_role 	= isset($_POST['wpe_curr_usr_role']) ? $_POST['wpe_curr_usr_role'] : '';
		
		$to = $exp_data['contact_email'];
		$sub = '['.get_bloginfo("name").'] Password Reset';
		$req_msg = '';
		$req_msg .= 'Password of a user has expired at your site <a href="'. get_bloginfo('wpurl') .'">'. get_bloginfo('name') .'</a>'. '<br />'. '<br />';
		$req_msg .= '<strong>User Name:</strong> '. base64_decode($wpe_curr_usr_name) . '<br />';
		$req_msg .= '<strong>User Email:</strong> '. base64_decode($wpe_curr_usr_email) . '<br />';
                $req_msg .= '<strong>User Role:</strong> '. base64_decode($wpe_curr_usr_role) . '<br /><br />';
		$req_msg .= '<strong>Please note:</strong> <br /> A password reset request has been made for a user having above credentials.
		Kindly confirm this request by sending an email to above email id.
		After confirmation you can reset the password.' . '<br /><br />';
		$req_msg .= '<strong> Please do not forget to send an acknowledgement note to user after resetting the password. </strong>';
		
		add_filter( 'wp_mail_content_type', 'wpe_html_content_type' );
		
		if(wp_mail($to, $sub, $req_msg, '', ''))
		    wp_enqueue_script('wdm_wpe_req', plugins_url('js/wpe-request.js', __FILE__), array('jquery'));
		    
		else
		    wp_die("Sorry, your request could not be sent.");
		       
		remove_filter( 'wp_mail_content_type', 'wpe_html_content_type' );
    }
		
}

function wpe_html_content_type()
{
    return 'text/html';
}

add_action('init','wdm_contact_admin');

function wdm_appeal_notice()
{
    if((isset($_REQUEST['page']) && $_REQUEST['page'] == 'wordpresspasswordexpiry') && (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == true))
    {
	$wdm_plugin_slug = 'wordpresspasswordexpiry';
    
	?>
    
	<div class="wdm_appeal_text" style="background-color:#FFE698;padding:10px;margin-right:10px;">
	    <strong>An Appeal:</strong>
	    We strive hard to bring you useful, high quality plugins for FREE and to provide prompt responses to all your support queries.
	    If you are happy with our work, please consider making a good faith donation, here -
	    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40wisdmlabs%2ecom&lc=US&item_name=WisdmLabs%20Plugin%20Donation&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest" target="_blank"> Donate now</a> 
	    and do post an encouraging review, here - <a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $wdm_plugin_slug; ?>" target="_blank"> Review this plugin</a>.
	</div>
    
	<?php
    }
}
add_action('admin_notices', 'wdm_appeal_notice');
?>