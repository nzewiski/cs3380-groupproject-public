<?php
//modify vars below
// Database
define('DB_HOSTNAME', 'hostname');
define('DB_USERNAME', 'username');
define('DB_PASSWORD', 'password');
define('DB_DATABASE', 'database');
define('DB_PREFIX', '');
define('SITE_URL', '');
define('ALLOW_SIGNUP', true);
define('SHOW_SIGNUP_LINK', true);
define('USER_NAMES_DISPLAY', 3); // 1 = real names, 2 = usernames, 3 = usernames w/ real names on hover
define('COMMENTS_SYSTEM', 'basic'); // basic, disqus, or disabled
define('DISQUS_SHORTNAME', ''); // only needed if using Disqus for comments

define('SEASON_YEAR', '2015');

//set timezone offset, hours difference between your server's timezone and eastern
define('SERVER_TIMEZONE_OFFSET', +2);

// ***DO NOT EDIT ANYTHING BELOW THIS LINE***
error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
