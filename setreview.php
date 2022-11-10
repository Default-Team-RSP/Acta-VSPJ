<div class="modal fade" id="setreview">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white border border-white">
                <h4 class="modal-title">Oponentní formulář</h4>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                
                    <form action="./index.php?action=validate" method="post">

                        <div class="mt-3">
                            <label for="asset-range" class="form-label"><strong>Aktuálnost, zajímavost a přínosnost </strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'asset');">
                        </div>
                        <div class="mb-3 row">
                            <label for="asset" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="asset" name="asset" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="originality-range" class="form-label"><strong>Originalita</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'originality');">
                        </div>
                        <div class="mb-3 row">
                            <label for="originality" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="originality" name="originality" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="expertness-range" class="form-label"><strong>Odborná úroveň</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'expertness');">
                        </div>
                        <div class="mb-3 row">
                            <label for="expertness" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="expertness" name="expertness" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="grammar-range" class="form-label"><strong>Jazyková a stylistická úroveň</strong> (0 - 10 b.)</label>
                            <input type="range" class="form-range" min="0" max="10" step="1" onchange="updateTextInput(this.value, 'grammar');">
                        </div>
                        <div class="mb-3 row">
                            <label for="grammar" class="col-sm-2 col-form-label">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" id="grammar" name="grammar" value="" readonly class="form-control-plaintext">
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
                                <input class="form-check-input" type="checkbox" id="reference" onclick="yesno(this, 'yesnos');" />
                            </div>
                            <p id="yesnos" class="mb-5"></p>
                        </div>
                        
                        <button type="submit" class="btn btn-dark">Odeslat</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateTextInput(val, elId) {
          document.getElementById(elId).value=val; 
        }

function yesno(chk, label) {
    document.getElementById(label).innerHTML = chk.checked ? "Doporučuji" : "Nedoporučuji";
}
</script>