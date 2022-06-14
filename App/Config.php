<?php

    namespace App;

    /**
     * Application configuration
     *
     * PHP version 7.0
     */
    class Config
    {
        /**
         * application email
         * @var string,email
         */
        const EMAIL = 'admin@myhoperevival.com';
        /**
         * Admin Path to access admin area
         * @var string
         */

        const ADMIN_PATH = "admin";

        /**
         * set app url to if public folder not in public_html
         * if project public folder is available in public_html comment first line and uncomment second.
         * @var string
         */
        const APP_URL = "http://localhost/hoperevival/public";
        //const APP_URL = ""; // if public files are in public_html

        /**
        * No changes reburied
         */
        const ADMIN_URL = self::APP_URL."/".self::ADMIN_PATH;

        /**
         * Database host
         * @var string
         */
        const DB_HOST = 'localhost';

       /**
         * Database name
         * @var string
         */
        const DB_NAME = 'myhoperevival';

        /**
         * Database user
         * @var string
         */
        const DB_USER = 'root';

        /**
         * Database password
         * @var string
         */
        const DB_PASSWORD = '';

        /**
         * Show or hide error messages on screen\
         * true will show errors.
         * false will display 404 page and logs errors in logs folder(optional)
         * @var boolean
         */
        const SHOW_ERRORS = true;

    }
