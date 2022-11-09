<?php
require("connect.php");
?>

<!-- Menu -->
<header class="p-3 bg-dark text-white">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="menu">

                <?php
                function active($currect_page){
                  $stranka = $_GET['stranka'];
                  if($currect_page == $stranka){
                      echo 'active'; 
                  } 
                }
                ?>

                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link navbar-brand <?php active('home');?>" href="index.php?stranka=home">Acta VŠPJ</a></li>
                    <li class="nav-item"><a class="nav-link <?php active('archiv');?>" href="index.php?stranka=archiv">Archiv</a></li>
                    <li class="nav-item"><a class="nav-link <?php active('pro_autory');?>" href="index.php?stranka=pro_autory">Pro autory</a></li>
                </ul> 
                <div class="d-none d-md-inline-block ms-auto me-0 my-md-0">
                    <a href="index.php?stranka=search" class="btn btn-outline-light me-2"><i class="bi bi-search h5"></i></a>
                </div>
                <!--<form action="search.php" method="GET" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control form-control-dark" type="text" name="query" placeholder="Vyhledat článek..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-outline-light" id="btnNavbarSearch" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>-->

                <div class="dropdown">
                    <button type="button" class="btn btn-outline-light me-2 dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i>  
                    </button>
                    <ul class="dropdown-menu">    
                        <li><a href="#login" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#login">Přihlášení</a></li>    
                        <li><a href="#signup" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signup">Registrace</a></li>  
                    </ul>
                </div>
                <a href="#helpdesk" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#helpdesk">Helpdesk</a>
            </div>
        </div>
    </nav>
</header>