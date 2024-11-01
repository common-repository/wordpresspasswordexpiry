=== WordPress Password Expiry ===
Contributors: WisdmLabs
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40wisdmlabs%2ecom&lc=US&item_name=WisdmLabs%20Plugin%20Donation&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest
Tags: expire, expiry, password, password expiry, wordpress password expiry, auto password expire, reset password, site access, custom roles, WisdmLabs
Requires at least: 3.3.1
Tested up to: 3.5.1
Version: 1.5
Stable tag: 1.5
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Expires password for the selected type of users on the site after every specified number of days.

== Description ==

* This plugin expires a user's access to the site after every specified number of days (initially set to 30 days).
* You can select the type of user/users for whom password should expire. The plugin works for default user types of WordPress as well as users with custom roles.
* After expiration, users needs to reset their password by clicking on 'Reset' link on the login page. 
* If the user is 'Main Administrator' (i.e. the very first admin at the time of site install & configuration), only he/she can manage expiration option for himself/herself. The future administrators can not manage expiration option for 'Main Administrator'.
* Other administrative users can manage expiration option for users at their level as well as lower level.

= Newly added features =

* Added 'Reset' link option: This option like the previous version, allows site users to reset password on their own.
* Added 'Request' link option: Administrators can choose this option if they don't want site users to reset password on their own and want them to contact the admin to reset their password. Users see a 'Request' link instead of 'Reset' link after clicking on which an email is sent to the email address configured by admin (by default admin's WordPress email id is picked. However, admin can modify this email address). In this email, user's name, email id and role is sent to admin. These attributes help the admin to identify the user whose password has expired. Finally, its upto the admin on how he/she authenticates the request for password reset and later informs the user. This plugin provides various helpful messages to understand the overall working.
* Main administrator (first admin) can only select 'Reset' link option (first one in 'option to password reset') for his/her account ('Main administrator' account) while he/she can select any option for his/her lower level users. 
* Added custom message (disable links) option: Administrator can put a custom text message instead of 'Reset' or 'Request' link, if needed. When choosing this option to show custom message and not any link, admin will be responsible for how he/she contacts the user and resets password.
* Added a plugin support sidebar in settings page: This sidebar enables various features such as asking a support query, making enquiry for custom development, know services provided by us etc. right from the plugin settings page.

This Plugin is brought to you by <a href="http://wisdmlabs.com">WisdmLabs</a>.

== Installation ==

= How to install this plugin ? =
1. Unzip the file 'wordpresspasswordexpiry.zip'.
2. Upload the 'wordpresspasswordexpiry' directory to '/wp-content/plugins/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. After activating, you will see an option for 'Password Expiry' in the admin menu (left navigation).

= Usage =
1. Click on 'Password Expiry' option in the admin menu in Dashboard.
2. Here, you can set password expiry period and a custom message for any types users (refer screenshots).
3. Passwords for selected types of users expire after specified number of days.


== Screenshots ==

1. Usage Screen(Main admin)
2. Usage Screen(Future admin)
3. 'Reset' link option
4. 'Request' link option 
5. Custom message option

== Frequently Asked Questions ==

= When does expiration time start for users? =
  The expiration time is specific to each user. It starts from their first successful login.


== Changelog ==

= 1.5 =
* Added new features :
- Show 'Reset' link to reset password 
- Show 'Request' link for getting request for resetting password
- Show custom message instead of reset/request links
* Added plugin support sidebar.
* Added external CSS files and moved all major styling into it. Some new styling also added. 
* Added some jQuery effects for newly added features.
* Tested compatability with WordPress 3.5.1

= 1.4 =
* Resolved conflict with 'WordPress iOS app'.
* Tested compatability with WordPress 3.5

= 1.3.5 =
* Changed 'expire()' function name to a unique name to avoid a conflict.

= 1.3 =
* Developed feature for expiring password for users with custom roles.
* Fixed a bug - 'Notice: Constant WPINC already defined in /home/user/domains/domain/public_html/wp-content/plugins/wordpresspasswordexpiry/pwd-exp.php on line 31 '
* Tested compatibility with WordPress latest version(3.4.2).

= 1.2 =
* Provided list of site users types including administrators.
* Developed option to select any types of users for setting password expiration time and message for them.
* A special feature(managing option for their own) for 'Main Adminstrator'.
* Tested compatibility with WordPress latest version(3.4.1).

= 1.1 =
* Fixed a bug: In previous version, by default, only the main admin's password would never expire. Other administrative user's password would expire.
Now, no administrative user's password expire by default. Only non admin user's password expire by default. So, if other administrative users install this plugin, he/she will be safe from expiration.
* Changed layout of this plugin's settings page.
* Tested compatibility with WordPress latest version(3.4).

= 1.0 =
* First version.

