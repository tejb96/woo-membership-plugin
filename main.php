<?php
/*
Plugin Name: Membership Data
Plugin URI: https://www.adralberta.com/
Description: Displays a table of the memberships summary
Authors: HarinSBal
Version: 2.0
*/

require_once(dirname(__FILE__)."/exportSubmenuPage.php");

add_action('admin_menu', "add_admin_menu_item_membership_summary_plugin_hsb");

function add_admin_menu_item_membership_summary_plugin_hsb(){
    add_menu_page( 'WooMemberships', //page title
    'Membership Data', //menu title
    'manage_options', //capability
    'export_csv_submenuslug_hsb', //parent slug
    'export_membership_data_submenu_page_hsb', //callback
    'dashicons-portfolio' //icon
    );   
    
}

add_action('admin_enqueue_scripts', 'enqueue_style_table_page_hsb');
function enqueue_style_table_page_hsb($hook){
    if('toplevel_page_export_csv_submenuslug_hsb' === $hook){
        wp_enqueue_style('table_styles_hsb', plugins_url("/css/exporthsb.css", __FILE__));
    }
}

add_action('admin_enqueue_scripts', 'enqueue_script_export_submenu_hsb');
function enqueue_script_export_submenu_hsb($hook){
    if('membership-data_page_export_csv_submenuslug_hsb' === $hook){
        wp_enqueue_script('quarterButtons_jsfile_hsb', plugins_url("js/quarterButtonshsb.js", __FILE__));
        wp_enqueue_style('export_styles_hsb', plugins_url("/css/exporthsb.css", __FILE__));
    }
}
 

function export_membership_data_submenu_page_hsb() {
    //if memberships are changed fix their names and ids here, above and in the exportSbmenuPage.php file. In that file it is hardcoded to check for organizational memberships:
    $memberships_adria = array(1914=>'Associate', 3966=>'Directory', 1915=>'Full', 1916=>'LINK', 1917=>'Organizational');
    //wc product ids for each membership. New first and then the renewal.
    $memberships_wc_adria = array('Full'=>2574, 'LINK'=>3151, 'Organizational'=>4220, 'Associate'=>3138);

    render_export_menu_page_html_hsb($memberships_adria, $memberships_wc_adria);
}

add_action('admin_init','membership_data_download_csv_hsb');
    
           
?>