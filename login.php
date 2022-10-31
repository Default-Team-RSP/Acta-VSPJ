<?php
require("connect.php");
?>

<!-- Přihlašovací okno -->                
<div class="modal fade" id="login">                          
    <div class="modal-dialog">                                      
        <div class="modal-content">                                                  
            <div class="modal-header bg-dark text-white border border-white">                                                              
                <h4 class="modal-title">Přihlášení</h4>                                                                       
            </div>                                                  
            <div class="modal-body">                                                              
                <div class="container mt-3">                                                                          
                    <form action="/action_page.php" method="post">
                        <div class="mb-3 mt-3">                                                                                                  
                            <label for="username">Uživatelské jméno</label>
                            <input type="text" class="form-control" id="username" placeholder="Uživatelské jméno" name="username" required>
                        </div>                                                                                      
                        <div class="mb-3">                                                                                                  
                            <label for="pwd">Heslo</label>
                            <input type="password" class="form-control" id="password" placeholder="Heslo" name="password" required>
                        </div>                                                                                      
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Zůstat přihlášen
                            </label>                                                                                      
                        </div>
                        <button type="submit" class="btn btn-dark">Přihlásit</button>                                           
                        <!--<a href="dashboard.html" class="btn btn-dark">Přihlásit</a>-->                                          
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>                                                                                                       
                    </form>                                                              
                </div>                                                  
            </div>                                 
        </div>                          
    </div>              
</div>