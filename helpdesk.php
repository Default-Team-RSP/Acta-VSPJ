<?php
 //Set up your login name and password here
// $username="test";
// $password="test";
 
?>

<!-- Přihlašovací okno -->
<div class="modal fade" id="helpdesk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white border border-white">
                <h4 class="modal-title">Helpdeskový formulář</h4>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                <?php if(isset($error_msg)){ echo $error_msg; } ?>
                    <form action="./BE/Helpdesk/helpdeskSQL.php" method="post">
                        <div class="mb-3 mt-3">
                            <label for="firtsname">Jméno:</label>
                            <input type="text" class="form-control" id="firtsname" name="firtsname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname">Přijmení:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Tel. číslo:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="comment">Vaše stížnost:</label>
                            <input type="text" class="form-control" id="comment" name="comment" required>
                        </div>
                        <button type="submit" class="btn btn-dark">Odeslat</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

if(isset($script)){ echo $script; } 