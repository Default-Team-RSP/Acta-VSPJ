<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/helpdesk.css">
    <link rel="stylesheet" href="queries.css">
    <title>Jednoduchý helpdeskový formulář</title>
</head>
<body>
    
<!-- obsah  -->
<div class="row">
   
    <?php
            //výchozi formular nastavit na prazdne hodnoty
                $firstname = $lastname = $email = $year = $pripojeniDatabaze = $comment = "";
                //povinná pole také nastavit na prazdne hodnoty
                $firstnameErr = $emailErr = $yearErr = "";
            
            //Kontola promenných test_input
            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                /*povinné pole KŘESTNÍ JMÉNO*/
                if(empty($_POST["firstname"])){
                    $firstnameErr = "Křestní jméno je povinné.";
                } else{
                    $firstname = test_input($_POST["firstname"]);
                    /*Podminky obsahu*/
                    if (!preg_match("/^[a-zA-Z-' Á,Č,Ď,É,Ě,Í,Ň,Ó,Ř,Š,Ť,Ú,Ů, Ý,Ž,Ä,Ĺ,Ľ,Ô,Ŕ,á,č,ď,é,ě,í,ň,ó,ř,š,ť,ú,ů,ý,ž,ä,ĺ,ľ,ô,ŕ]*$/",$firstname)) {
                    $firstnameErr = "U křestního jména jsou povolena pouze velká malá písmena a mezery.";
                    } 
                }
                /*NEpovinné pole PŘÍJMENÍ*/
                $lastname = test_input($_POST["lastname"]);
                            
                            
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
                /*povinné pole LETOŠNÍ ROK*/
                    if(empty($_POST["year"])){
                        $yearErr = "Rok je povinný údaj. Ochrana proti spamu.";
                    } else{
                        $year = test_input($_POST["year"]);
                    /*Podminky obsahu*/ // zkontrolovat, platnost aktuálního roku
                        $rok = date('Y');
                        if (!preg_match("/$rok/",$year)) {
                        $yearErr = "Zadejte aktuální (letošní) rok v tomto formátu např. 2000 pozn. Ochrana proti spamu.";
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
                        $query = "INSERT INTO helpdeskForm(Jmeno,Prijmeni,Email,Zprava) VALUES('$firstname','$lastname','$email','$comment')";
                        
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

            <div class="ctverecFormular">
                <div class="container">
                    <h2 class="nadpisform">Jednoduchý helpdeskový formulář</h2>
                    <!-- chybové hlášky -->
                    <span class="error"><?php echo $firstnameErr;?></span>
                    <span class="error"><?php echo $emailErr;?></span>
                    <span class="error"><?php echo $yearErr;?></span>
                    
                    
                    <!-- hláška databáze -->
                    <span class="uspech" ><?php echo $pripojeniDatabaze;?></span> 
            
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <input type="text" name="firstname" placeholder="Jméno*" required >
                    <input type="text" name="lastname" placeholder="Přijmení" ><br>
                    <input type="number" name="year" placeholder="Dnes je rok*" title="ochrana proti spamu" required>
                    <input type="email" name="email" placeholder="E-mail*" required value="@"><br>
                    <textarea name="comment" id="" placeholder="Vaše zpráva ..."></textarea>
                    <input type="submit" name="submit" value="Odeslat">
                    </form>
                    
                     
                    <a class="btnZpet" href="index.php"><button type="button" class="btnZpet btn btn-link">Zpět domů</button></a>
                </div>
            </div>
                
        
        <div class="clearfix"></div>
</div>
</body>
</html>