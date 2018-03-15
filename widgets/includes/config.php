<?php
/*
config.php

stores configuration information for our web application

*/

//removes header already sent errors
ob_start();

define('SECURE',false); #force secure, https, for all site pages

define('PREFIX', 'widgets_wn18_'); #Adds uniqueness to your DB table names.  Limits hackability, naming collisions

header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching

define('DEBUG',true); #we want to see all errors

include 'credentials.php';//stores database info
include 'common.php';//stores favorite functions
include 'custom.php';//stores custom functions

//prevents date errors
date_default_timezone_set('America/Los_Angeles');

//create config object
$config = new stdClass;

//these are the navigation links
$config->nav1['index.php'] = "HOME";
$config->nav1['inspiration.php'] = "INSPIRATION";
$config->nav1['customers.php'] = "CUSTOMERS";
$config->nav1['contact.php'] = "CONTACT";
$config->nav1['daily.php'] = "DAILY";

//create default page identifier
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//START NEW THEME STUFF - be sure to add trailing slash!
$sub_folder = 'widgets2/';//change to 'widgets' or 'sprockets' etc.
$config->theme = 'BusinessCasual';//sub folder to themes

//will add sub-folder if not loaded to root:
$config->physical_path = $_SERVER["DOCUMENT_ROOT"] . '/' . $sub_folder;
//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{
    //adjust protocol
    $protocol = (SECURE==true ? 'https://' : 'http://'); // returns true
    
}
$config->virtual_path = $protocol . $_SERVER["HTTP_HOST"] . '/' . $sub_folder;

define('ADMIN_PATH', $config->virtual_path . '/admin/'); # Could change to sub folder
define('INCLUDE_PATH', $config->physical_path . '/includes/');

//END NEW THEME STUFF

//set website defaults
$config->pageTitle = THIS_PAGE;
$config->pageBanner = 'Widgets';
$config->pageSlogan = 'Our Widgets Are Better';
$config->loadhead = '';//place items in <head> element

switch(THIS_PAGE){
        
    case 'template.php':
        $config->pageTitle = 'Template';
        $ctaImage = 'products-02.jpg';
        $ctaHeading1 = 'Try Our Widgets';
        $ctaHeading2 = 'Yummy Yummy';
        $ctaText = 'Mocha java variety, java froth single origin arabica wings. Carajillo, body aftertaste aged coffee frappuccino affogato. Cultivar cinnamon, mocha dark cultivar saucer aroma wings spoon irish dripper body. Strong, extra affogato, id coffee and sugar blue mountain siphon.';
    break;    
        
    case 'index.php':
        $config->pageTitle = 'Home';
        $ctaImage = 'products-04.jpg';
        $ctaHeading1 = 'Try Our Homemade Widgets';
        $ctaHeading2 = 'So tasty';
        $ctaText = 'Mocha java variety, java froth single origin arabica wings. Carajillo, body aftertaste aged coffee frappuccino affogato. Cultivar cinnamon, mocha dark cultivar saucer aroma wings spoon irish dripper body. Strong, extra affogato, id coffee and sugar blue mountain siphon.';
    break;
        
    case 'inspiration.php':
        $config->pageTitle = 'Inspiration';
    break;
        
    case 'customers.php':
        $config->pageTitle = 'Customers';
    break;
        
    case 'contact.php':
        $config->pageTitle = 'Contact';
    break;
        
    case 'daily.php':
        $config->pageTitle = 'Daily Special';
    break;
        
    case 'admin_login.php':
        $config->pageTitle = 'Admin Login';
    break;

    case 'admin_logout.php':
        $config->pageTitle = 'Admin Logout';
    break;
    
    case 'admin_dashboard.php':
        $config->pageTitle = 'Admin Dashboard';
    break;
        
    case 'admin_add.php':
        $config->pageTitle = 'Add an Admin';
    break;
        
    case 'admin_reset.php':
        $config->pageTitle = 'Reset an Admin';
    break;
        
    case 'admin_edit.php':
        $config->pageTitle = 'Edit an Admin';
    break;
        
    case 'admin_validate.php':
        $config->pageTitle = 'Validate an Admin';
    break;
 
    default:
        $config->pageTitle = THIS_PAGE; 
    break;
}//end switch title tags

//START NEW THEME STUFF
//creates theme virtual path for theme assets, JS, CSS, images
$config->theme_virtual = $config->virtual_path . 'themes/' . $config->theme . '/';
//END NEW THEME STUFF

/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
if(startSession() && isset($_SESSION['AdminID']))
{#add admin logged in info to sidebar or nav
    
    $config->adminWidget = '
        <a href="' . ADMIN_PATH . 'admin_dashboard.php">ADMIN</a> 
        <a href="' . ADMIN_PATH . 'admin_logout.php">LOGOUT</a>
    ';
}else{//show login (YOU MAY WANT TO SET TO EMPTY STRING FOR SECURITY)
    
    $config->adminWidget = '
        <a  href="' . ADMIN_PATH . 'admin_login.php">LOGIN</a>
    ';
}
?>















