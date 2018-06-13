<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


        global $wpdb;

        $tableName = $wpdb->prefix . 'wordpresform';

        /** Check if the database exists */
        if($wpdb->get_var('SHOW TABLES LIKE ' . $tableName) != $tableName){

            $sql = "CREATE TABLE " . $tableName . "(
                id INT(10) PRIMARY KEY AUTO_INCREMENT,
                companyName VARCHAR(255),
                pointOfContactName VARCHAR(255),
                pointOfContactId    VARCHAR(255),
                recorededDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            dbDelta($sql);

            add_option('wordpressform_database_version', '1.0');

        }
	}

}
