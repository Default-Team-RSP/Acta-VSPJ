<?php
 //Set up your login name and password here
// $username="test";
// $password="test";
require("connect.php");
 

if (isset($_GET['action']))
 {
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password' ";

    $result = mysqli_query($conn, $sql);

    if ( mysqli_num_rows($result)>0 )
    {
        $row = mysqli_fetch_assoc($result);
        session_start();
        header("Cache-control: private");
        $_SESSION["user_is_logged"] = 1;
        $_SESSION["role"] = $row['Role'];
        $_SESSION["username"] = $row['Username'];
         header("location: dashboard.php");
         exit;
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
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
                <?php if(isset($error_msg)){ echo $error_msg; } ?>
                    <form action="./index.php?action=validate" method="post">
                        <div class="mb-3 mt-3">
                            <label for="username">Uživatelské jméno</label>
                            <input type="text" class="form-control" id="username" placeholder="Uživatelské jméno" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Heslo</label>
                            <input type="password" class="form-control" id="password" placeholder="Heslo" name="password" required>
                        </div>
                        <input class="btn btn-dark" type="submit" value="Přihlásit">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(isset($script)){ echo $script; } ?>