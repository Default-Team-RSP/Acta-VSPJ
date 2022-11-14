<?php
    require("connect.php");
?>

<main>
        <div class="container my-5">
            <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white border border-white">
                        Formulář pro vložení příspěvku
                    </div>
                    <div class="card-body">
                        <div class="container mt-3">
                

<form class="row g-2" action="dashboard.php?link=insertarticle" method="post" enctype="multipart/form-data">
            <div class="col-auto">
  <input class="form-control" type="file" name="uploaded_file" id="formFile">
   </div>
  <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" value="Nahrát soubor...">
            </div>
        </form>
        
    




</div>
                    </div>
                </div>
            </div>
          </div>
    </main>