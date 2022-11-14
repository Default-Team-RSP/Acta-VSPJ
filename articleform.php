<main>
        <div class="container my-5">
            <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white border border-white">
                        Formulář pro vložení příspěvku
                    </div>
                    <div class="card-body">
                        <div class="container mt-3">
                
                    <form action="./dashboard.php?link=insertarticle" method="post" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            Jméno:
                           
                        </div>
                        <div class="mb-3 mt-3">
                            Příjmení:
                            
                        </div>
                        <div class="mb-3">
                            <label for="title">Název článku</label>
                            <input type="text" class="form-control" id="title" name="title" required />
                        </div>

                        <input type="submit" class="btn btn-dark" value="Dál" onclick="next()" required />
                        <a class="btn btn-secondary" href="dashboard.php?link=dashboard.php" role="button" >Zavřít</a>
                    </form>
                    
                </div>
                    </div>
                </div>
            </div>
          </div>
    </main>

<script>
function next() {
  window.location.assign("dashboard.php?link=insertarticle")
}
</script>