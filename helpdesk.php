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
                    <form action="./index.php?action=validate" method="post">
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

?>       
<?php
            //výchozi formular nastavit na prazdne hodnoty
                $firtsname = $lastname = $phone = $email = $comment = "";

            
//Kontola promenných test_input
if ($_SERVER["REQUEST_METHOD"] == "POST"){

                /*povinné pole KŘESTNÍ JMÉNO*/
                if(empty($_POST["firtsname"])){
                    $firstnameErr = "Křestní jméno je povinné.";
                } else{
                    $firstname = test_input($_POST["firstname"]);
                    /*Podminky obsahu*/
                    if (!preg_match("/^[a-zA-Z-' Á,Č,Ď,É,Ě,Í,Ň,Ó,Ř,Š,Ť,Ú,Ů, Ý,Ž,Ä,Ĺ,Ľ,Ô,Ŕ,á,č,ď,é,ě,í,ň,ó,ř,š,ť,ú,ů,ý,ž,ä,ĺ,ľ,ô,ŕ]*$/",$firstname)) {
                    $firstnameErr = "U křestního jména jsou povolena pouze velká malá písmena a mezery.";
                    } 
                }
                /*povinné pole PŘÍJMENÍ*/
                
                if(empty($_POST["lastname"])){
                    $firstnameErr = "Příjmení  je povinné.";
                } else{
                    $firstname = test_input($_POST["lastname"]);
                    /*Podminky obsahu*/
                    if (!preg_match("/^[a-zA-Z-' Á,Č,Ď,É,Ě,Í,Ň,Ó,Ř,Š,Ť,Ú,Ů, Ý,Ž,Ä,Ĺ,Ľ,Ô,Ŕ,á,č,ď,é,ě,í,ň,ó,ř,š,ť,ú,ů,ý,ž,ä,ĺ,ľ,ô,ŕ]*$/",$firstname)) {
                    $firstnameErr = "U křestního jména jsou povolena pouze velká malá písmena a mezery.";
                    } 
                }
                
                /*NEpovinné pole Tel. číslo*/
                $phone = test_input($_POST["phone"]);
                            
                /*povinné pole EMAIL*/
                    if(empty($_POST["email"])){
                        $emailErr = "E-mail je povinný.";
                    } else{
                        $email = test_input($_POST["email"]);
                    /*Podminky obsahu*/
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Neplatný formát e-mailu.";
                        } 
                    }

                /*NEpovinné pole ZPRÁVA pouze ověřeno fcí test_input*/
                $comment = test_input($_POST["comment"]);
                } 
                //Databáze
                if(isset($_POST["submit"]))
                {
                    if (isset($_POST['firstname']) && $_POST['firstname'] && !$firstnameErr &&
                    isset($_POST['lastname']) && $_POST['lastname'] &&
                    isset($_POST['email']) && $_POST['email'] && !$emailErr &&
                    isset($_POST['year']) && $_POST['year'] == date('Y'))
                    {
    
                        //PRIPOJENI DO DATABAZE
                            $connection = mysqli_connect("localhost","root","","rspDatabaze");
                            //pojistka
                            if($connection){
                                $pripojeniDatabaze = "Děkujeme Vám za Váši zprávu. Ozveme se.";
                            }else{
                                die("Ou, něco se pokazilo.");
                            }
                        //SQL
                        $query = "INSERT INTO helpdeskForm(Jmeno,Prijmeni,Email,Zprava) VALUES('$firtsname','$lastname','$phone','$email','$comment')";
                        
                        //Propojení s databazi
                        $result = mysqli_query($connection,$query);
                            //pojistka
                            if(!$result){
                                die("Dotaz do databáze selhal.");
                            }
                    }
                }
                
                
            
            //overeni poli ve formulari
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

        ?>   
</body>
</html>