<?php
require("../../connect.php"); 

$firstname=$_POST['firtsname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$comment=$_POST['comment'];

if($firstname == NULL || $lastname == NULL || $comment == NULL) {
    echo "Pole musí být vyplněna";
}else{
    
$sql = "INSERT INTO `helpdesk`(`HelpdeskID`, `Timestamp`, `Firstname`, `Lastname`, `Email`, `Telefon`, `Issue`) VALUES 
(NULL ,NULL, '$firstname', '$lastname','$email','$phone','$comment')";
}
 

if (mysqli_query($conn, $sql)) {
    echo "Váš problém byl úspešně odeslán, vyčkejte na přesměrování";
    sleep(5); //tohle nefunguje korektně!!!!!
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
mysqli_close($conn);
 
?>