<?php
require("connect.php");
?>

<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <meta charset="utf-8" />        
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Acta VŠPJ</title>
    <!-- CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <!-- Scripts -->        
    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>        
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
    <?php
    include_once("header.php");
    include_once("login.php");
    include_once("signup.php");
    include_once("helpdesk.php");


    ?>
    <main class="container">                     
    <div class="bg-light rounded alert alert-danger alert-dismissible fade show" role="alert">                             
        <strong>Tato aplikace je výsledkem školního projektu v kurzu Řízení SW projektů na Vysoké škole polytechnické Jihlava. Nejedná se o stránky skutečného odborného časopisu!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                   
    </div>  
    <section>
        <?php
        if (isset($_GET['stranka']))
            $stranka = $_GET['stranka'];
        else
            $stranka = 'home';
        if (preg_match('/^[a-zA-Z0-9 _-]+$/', $stranka)) {
            $vlozeno = include($stranka . '.php');
            if (!$vlozeno)
                echo('Error 404 Not Found');
        } else
            echo('Error 400 Bad Request');
        ?>
    </section>
    </main>
    <?php
    include_once("footer.php");
    ?>
</body>
</html>