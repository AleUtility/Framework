<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 06/05/2017
 * Time: 21:30
 */

if(file_exists('../pages'.$url_path.'/index.php')){
    require_once('../pages'.$url_path.'/index.php');
    $page = new Page();
}
elseif(file_exists('../pages'.$url_path.'index.php')){
    require_once('../pages'.$url_path.'index.php');
    $page = new Page();
}
else {
    // Not found pages
    class Page {
        function Content()
        { ?>
            <div class="container top">
                <div class="row">
                    <div class="text-center">
                        <h1 class="title">
                            File not found!
                        </h1>
                    </div>
                </div>
            </div>
        <?php }
    }
}
if(!isLogin())
    $user = null;

// Create pages instance
$page = new Page();

// Permits
if(isset($page) && method_exists($page, 'permits'))
    $permits = isset($page) && method_exists($page, 'permits') ? $page->permits() : null;
if(!isset($permits) || $permits==null || hasPermits($permits))
    include "../template/index.php";
else
    if(isset($page) && method_exists($page, 'destination'))
        $page->destination();
    else
        header("Location: /");

function parse($url_path, $real_path, $action = "==") {
    switch($action) {
        case "==":
            return $url_path == $real_path || $url_path == $real_path . "/";
            break;
        case "{ }":
            return ""; // $url, $separator = "/", $variableLeft = "{", $variableRight = "}"
            break;
    }
}

function hasPermits($permits) {
    $hasPermits = true;
    foreach ($permits as $key => $value) {
        switch($value) {
            case "login":
                if(!isset($_SESSION['username']))
                    $hasPermits = false;
                break;
        }
    }
    return $hasPermits;
}