<?php
// URL Root
if (!defined('URLROOT')) define('URLROOT', 'http://localhost/travel-site');

// Site Name
if (!defined('SITENAME')) define('SITENAME', 'Travel Site');

// App Root
if (!defined('APPROOT')) define('APPROOT', dirname(dirname(__FILE__)));

// Redirect function
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
} 