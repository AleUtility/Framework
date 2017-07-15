<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 06/05/2017
 * Time: 20:36
 */

$url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$url_path_parts = explode("/", $url_path);
$last_url_path_part = $url_path_parts[count($url_path_parts)-1];

// Get user info
$user = array();
if(isLogin()) {
    // Something appear, for example create a variable $user
    $user = array(
        "username" => "Username",
        "email" => "youremail@gmail.com",
        "name" => "Name",
        "surname" => "Surname"
    );
    // You can write also:
    // $user = $_SESSION;
}

if($last_url_path_part=="" || !strrpos($last_url_path_part, ".")) {
    include "../builder/builder_template.php";
}
elseif(strrpos($last_url_path_part, ".")) {
    echo "wrong path";
}


/* Custom PHP funciton */
function startsWith($haystack, $needle) { // Usage: boolean startsWith($str, '|');
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) { // Usage: boolean endsWith($str, '}');
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

function isLogin() { // Login condition
    return isset($_SESSION['username']);
}