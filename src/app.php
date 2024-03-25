<?php 
// quick router for the app

if(isset($_GET["post"])){
    $postName = $_GET["post"];
    require 'src/post/index.php';
} else if(isset($_GET['view'])){
    $view = $_GET['view'];

    require 'src/post/' . $view . '.php';
}else {
    require 'src/home.php';
}
