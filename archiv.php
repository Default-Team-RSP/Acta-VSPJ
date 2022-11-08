<?php
    require("connect.php");
?>
<!-- Stránka -->
<main class="container">
    <h2 class="pb-4 mb-4">Archiv</h2>
        
        <h3 class="pt-4 pb-4 mt-4">č. 4/2022</h3>
            <div class="button-box col-12 me-2">
                <?php
                include("info4.php");
                ?>
                <a href="#info4" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#info4">Info</a>
                <a href="assets/data/cislo_4_2022.pdf" class="btn btn-outline-danger text-dark bg-white" target="_blank">Celé číslo v <img src="assets/img/PDF_icon.svg" class="icon"></a>
            </div>
        <h3 class="pt-4 pb-4 mt-4">č. 3/2022</h3>
            <div class="button-box col-12 me-2">
                <?php
                include("info3.php");
                ?>
                <a href="#info3" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#info3">Info</a>
                <a href="assets/data/cislo_3_2022.pdf" class="btn btn-outline-danger text-dark bg-white" target="_blank">Celé číslo v <img src="assets/img/PDF_icon.svg" class="icon"></a>
            </div>
        <h3 class="pt-4 pb-4 mt-4">č. 2/2022</h3>
            <div class="button-box col-12 me-2">
                <?php
                include("info2.php");
                ?>
                <a href="#info2" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#info2">Info</a>
                <a href="assets/data/cislo_2_2022.pdf" class="btn btn-outline-danger text-dark bg-white" target="_blank">Celé číslo v <img src="assets/img/PDF_icon.svg" class="icon"></a>
            </div>
        <h3 class="pt-4 pb-4 mt-4">č. 1/2022</h3>
            <div class="button-box col-12 me-2">
                <?php
                include("info1.php");
                ?>
                <a href="#info1" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#info1">Info</a>
                <a href="assets/data/cislo_1_2022.pdf" class="btn btn-outline-danger text-dark bg-white" target="_blank">Celé číslo v <img src="assets/img/PDF_icon.svg" class="icon"></a>
            </div>
</main>