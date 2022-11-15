<?php
    require("connect.php");
?>
<main>
        <div class="container my-5">
            <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white border border-white">
                Oponentní formulář
            </div>
                    <div class="card-body">
                        <div class="container mt-3">
                
                    <form action="./dashboard.php?link=setreview" method="post" enctype="multipart/form-data">

                        <div class="mt-3">
                            <label for="asset-range" class="form-label"><strong>Aktuálnost, zajímavost a přínosnost </strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" >
                        </div>
                        <div class="mb-3 row">
                            <label for="asset" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="asset" name="asset" value="" disabled class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="originality-range" class="form-label"><strong>Originalita</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'originality');">
                        </div>
                        <div class="mb-3 row">
                            <label for="originality" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="originality" name="originality" value="" disabled class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="expertness-range" class="form-label"><strong>Odborná úroveň</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'expertness');">
                        </div>
                        <div class="mb-3 row">
                            <label for="expertness" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="expertness" name="expertness" value="" disabled class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="grammar-range" class="form-label"><strong>Jazyková a stylistická úroveň</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'grammar');">
                        </div>
                        <div class="mb-3 row">
                            <label for="grammar" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="grammar" name="grammar" value="" disabled class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3 mb-3">
                            Celkem bodů:
                        </div>

                        <div class="mt-3">
                            <label for="text" class="form-label"><strong>Volné hodnocení</strong></label>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="text" name="text" rows="3"></textarea>
                        </div>

                        <div class="mt-3">
                            <label for="result" class="form-label"><strong>Výsledek</strong></label>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" id="result" placeholder="Navržený výsledek dle celkového bodového zisku." disabled>
                        </div>

                        <div class="mt-3">
                            <label for="reference" class="form-label"><strong>Doporučení</strong></label>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="reference" name="reference" onclick="yesno(this, 'yesnos');" />
                            </div>
                            <p id="yesnos" class="mb-5"></p>
                        </div>
                        
                        <button type="submit" class="btn btn-dark">Odeslat</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back()">Zavřít</button>
                    </form>
                </div>
                    </div>
                </div>
            </div>
          </div>
    </main>

<script>
function updateTextInput(val, elId) {
          document.getElementById(elId).value=val; 
        }

function yesno(chk, label) {
    document.getElementById(label).innerHTML = chk.checked ? "Doporučuji" : "Nedoporučuji";
}
</script>