<?php
date_default_timezone_set('Asia/Tehran');


// PUBLIC
define("DEVELOPING_MODE", "true");
define("PROOT", '/php_mvc/');
define("SITE_TITLE", 'php_mvc');
define("DEFAULT_CONTROLLER", 'Home');
define("DEFAULT_LAYOUT", 'default');


// DATABASE CONFIGURE
define("DB_HOST","localhost");
define("DB_NAME","php_mvc");
define("DB_USER","root");
define("DB_PASS","");


// COOKIE NAMES
define("CURRENT_USER_SESSION_NAME", "session__logged_in_user_id");
define("REMEMBER_ME_COOKIE_NAME", "cookie__remember_login");
define("REMEMBER_ME_COOKIE_EXPIRY", 604800);
