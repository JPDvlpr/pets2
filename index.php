<?php
/**
 * Created by PhpStorm.
 * User: jpapp
 * Date: 1/18/2018
 * Time: 1:30 PM
 */

session_start();
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('vendor/autoload.php');

$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);

$f3->route('GET /',
    function () {
        echo 'default';
    }
);

$f3->route('GET /pets/show/@animal', function ($f3, $params) {
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
            //$f3->reroute('/');
//        404 error
        default:
            //$f3->error(404);
            echo 'neither animal';
    }
});

$f3->route('GET /pets/order',
    function ($f3, $params) {
        $template = new Template();
        echo $template->render('form1.html');
    }
);

$f3->route('POST /pets/order2',
    function ($f3,$params) {
        $_SESSION['animals'] = $_POST['animals'];
        $template = new Template();
        echo $template->render('form2.html');
    }
);

$f3->route('POST /pets/results',
    function ($f3,$params) {
    //shows every variable within the session
    //var_dump($_SESSION);
        $_SESSION['color'] = $_POST['color'];
        $f3-> set('animals', $_SESSION['animals']);
        $f3-> set('color', $_SESSION['color']);
        $template = new Template();
        echo $template->render('results.html');    }
);

//run fat free
$f3->run();