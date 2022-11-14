<?php
require("connect.php");
ob_start();
session_start();

include_once("helpdesk.php");
include_once("setreview.php");

?>

<!DOCTYPE html>
<html lang="cs">    
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
    

</head>    
    <body class="sb-nav-fixed">
<!-- horizontální menu -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php?link=dashboard">Acta VŠPJ</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block ms-auto me-0 my-md-0">
                <a href="dashboard.php?link=search" class="btn btn-outline-light me-2"><i class="bi bi-search h5"></i></a>
            </div>
            <!-- Navbar-->
            <div class="dropdown">
                    <button type="button" class="btn btn-outline-light me-2 dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i>  
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">    
                        <li><a class="dropdown-item" href="index.php">Odhlásit</a></li>
                    </ul>
            </div>
        </nav>
<!-- vertikální menu -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseArticles" aria-expanded="false" aria-controls="collapseArticles">
                                <div class="sb-nav-link-icon">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                Příspěvky
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseArticles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                        <?php
                            if($_SESSION["role"]=='Author')
                            {
                        ?>
                                    <a class="nav-link" href="dashboard.php?link=dashboard">Přehled příspěvků</a>
                        <?php
                        }
                        ?>

                        <?php
                            if($_SESSION["role"]=='Reviewer')
                            {
                         ?>
                                    <a class="nav-link" href="dashboard.php?link=reviewerAll">Přehled příspěvků</a>
                        <?php
                        }
                        ?>

                        <?php
                            if($_SESSION["role"]=='Editor' || $_SESSION["role"]=='Chief' || $_SESSION["role"]=='Admin')
                            {
                        ?>
                                    <a class="nav-link" href="dashboard.php?link=All">Přehled příspěvků</a>
                        <?php
                        }
                        ?>

                        <?php
                            if($_SESSION["role"]=='Author')
                            {
                        ?>
                                    <a class="nav-link" href="dashboard.php?link=articleform">Vytvořit příspěvek</a>
                        <?php
                        }
                        ?>
                                </nav>                            
                            </div>                            
                        <?php
                            if($_SESSION["role"]=='Chief' || $_SESSION["role"]=='Admin')
                            {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTasks" aria-expanded="false" aria-controls="collapseTasks">
                                <div class="sb-nav-link-icon">
                                    <i class="bi bi-journal-check"></i>
                                </div>
                                Správa úkolů
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseTasks" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Přehled úkolů</a>
                                    <a class="nav-link" href="#">Vytvořit úkolů</a>
                                </nav>
                            </div>
                        <?php
                        }
                        ?>
                            <!--<a class="nav-link" href="#">
                                <div class="sb-nav-link-icon">
                                    <i class="bi bi-gear-fill"></i>
                                </div>
                                Nastavení
                            </a>-->
                            <hr class="dropdown-divider mt-3">
                            </hr>
                            <a class="nav-link btn btn-danger text-white" href="#helpdesk" data-bs-toggle="modal" data-bs-target="#helpdesk">
                                <div class="sb-nav-link-icon text-white">
                                    <i class="bi bi-question-circle-fill"></i>
                                </div>
                                Helpdesk
                             </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">
                            Přihlášen jako:
                        </div>
                            <?php
                                echo $_SESSION["username"]." ";
                            ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?php
                    
                    if(isset($_GET['link'])){
                        $link=$_GET['link'];
                            if ($link == 'search'){
                                $_SESSION["role"];
                                include 'search.php';
                            }
                            if ($link == 'articleform'){
                                $_SESSION["role"];
                                include 'articleform.php';
                            }
                            if ($link == 'insertarticle'){
                                $_SESSION["role"];
                                include 'insertarticle.php';
                            }
                            if ($link == 'reviewerAll'){
                                $_SESSION["role"];
                                include 'reviewerAll.php';
                            }
                            if ($link == 'All'){
                                $_SESSION["role"];
                                include 'All.php';
                            }
                            if ($link == 'dashboard'){ goto s;}
                    }
                    else
                    {
                    s:
                    $dashboard = $_SESSION["role"];
                    switch ($dashboard) {
                      case "Author":
                        include("author.php");
                        break;
                      case "Editor":
                        include("editor.php");
                        break;
                      case "Reviewer":
                        include("reviewer.php");
                        break;
                      case "Chief":
                        include("chief.php");
                        break;
                      case "Admin":
                        include("admin.php");
                        break;
                      default:
                        echo('Error 404 Not Found');
                    }
                    }
                    
                    
                    
                ?>
<!-- zápatí -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Default Team 2022
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>    
    </body>
</html>