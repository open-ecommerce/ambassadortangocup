<!DOCTYPE HTML>

<html>

<head>
    <title>Argentinean Ambassador Tango Cup 2021</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/evote.css?version=3" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

include 'data/evote.php';
require 'index/classes/TableGenerator.php';
require 'index/classes/MenuGenerator.php';
require 'data/RandomInfo.php';
require 'data/Dialogue.php';


$evote = new Evote();
$tg = new TableGenerator();
$mg = new MenuGenerator();
$randomString = new RandomInfo();

if(isset($_SESSION['message']) && is_string($_SESSION['message']) && $_SESSION['message'] != ''){
    $d = unserialize($_SESSION['message']);
    $d->printAlerts();
    unset($_SESSION['message']);
}

$page = trim($_SERVER['REQUEST_URI'], '/');
$tr = trim($_SERVER['REQUEST_URI'], '/');
$nav = explode('/',$tr);


?>
    <!-- Header -->
    <div class="fixed-header">

<?php if($module != 'vote' && $module != ''): ?>

        <div class="navbar navbar-inverse navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <span>E-vote</span>
                    </a>
                </div>

               <div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?php else: ?>
        </div>
        <!-- Main content for voting -->
        <div class="col-lg-12 voting centered">
    <?php endif; ?>
<?php
    $configured = file_exists('data/config.php');
    if(!$configured){
        echo '<h4>Check configuration</h4>';
    }else{
        include 'index/vote/votingcode.php';
    }
?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
