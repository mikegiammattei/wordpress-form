<?php
    /* Plugin Name:  WordPress Form
    Plugin URI:   http://WordPressForm.com
    Description:  The most robust WordPress Form built by experts developers.
    Version:      1.0
    Author:       Michael Giammattei
    Author URI:   http://website-company.com/
    License:      GPL2
    License URI:  https://www.gnu.org/licenses/gpl-2.0.html

    WordPress Form is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.

    WordPress Form is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with {Plugin Name}. If not, see {URI to Plugin License}.
    */

    function wordpressform_activate(){

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
    register_activation_hook(__FILE__ , 'wordpressform_activate');

    function wordpressform_uninstall(){

        global $wpdb;

        $tableName = $wpdb->prefix . 'wordpresform';

        /** Check if the database exists */
        if($wpdb->get_var('SHOW TABLES LIKE ' . $tableName) != $tableName){

            $sql = "DROP TABLE " . $tableName;

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            $wpdb->query($sql);

        }
    }

    //register_deactivation_hook(__FILE__ , 'wordpressform_deactivate');

    register_uninstall_hook(__FILE__, 'wordpressform_uninstall');