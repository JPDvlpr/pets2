<?php
/**
 * Created by PhpStorm.
 * User: jpapp
 * Date: 1/18/2018
 * Time: 1:30 PM
 */

//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('vendor/autoload.php');

$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);

$f3->route('GET /',
    function () {
        echo'default';
    }
);



$f3->route('GET /pets2/show/@animal', function ($f3, $params) {
    switch ($params['animal']) {
        case 'cat':
            echo "<img src='../../images/cat.jpg' alt='cat'>";
            //echo 'cats';
            break;
        case 'dog':
            echo "<img src='../../images/dog.jpeg'>";
            //echo 'dogs';
            break;
        case 'cow':
            $f3->reroute('/');
//        404 error
        default:
            //$f3->error(404);
            echo 'neither animal';
    }
});

//run fat free
$f3->run();