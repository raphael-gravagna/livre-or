<?php
require 'header.php';
$errormess = '';
$bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name);
mysqli_set_charset($bdd, 'utf8');
//var_dump($bdd);

if( isset($_SESSION['user'])) {
$user = $_SESSION['user'];
$userid = $user[0]['0'];
$Requete = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE id = '$userid'");
$userinfo = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
//var_dump($userinfo);
$userlogin_bdd = $userinfo[0]['login'];
$usermdp_bdd = $userinfo[0]['password'];
//foreach($userinfo['id']);
// var_dump($user_id);    
    if(isset($_POST['modification'])){
      if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Cpassword'])) {

            $newlogin = ($_POST['username']);
            $newmdp = ($_POST['password']);
            $newCmdp = ($_POST['Cpassword']);
            $veriflogin_user = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs`WHERE login = '$newlogin'");
            $resultlogin_user = mysqli_fetch_assoc($veriflogin_user);
            //var_dump($resultlogin_user);
            $veriflogin_alluser = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs`"); //les logins de tous les utilisateurs
            $resultlogin_alluser = mysqli_fetch_all($veriflogin_alluser, MYSQLI_ASSOC);
            //var_dump($resultlogin_alluser);

            if($newmdp != $newCmdp) {
                $errormess = "Confirmation du mot de passe incorrect";
            }

            elseif($newlogin == $userlogin_bdd || empty($resultlogin_user)) {
                $reqinsert = mysqli_query($bdd, "UPDATE utilisateurs SET  login = '$newlogin', password = '$newmdp' WHERE id = $userid");
                session_destroy();
                header("Location:connexion.php");
            }
            elseif($newlogin != $userlogin_bdd && !empty($resultlogin_user)) {
                $errormess = "Ce login est déja utilisé";
            }

            
      }
    }
}
?>

<body>
        <div id="container">
            <h3 ><?php echo $errormess; ?></h3>
            <form action="" method="POST">
                <h1>Profil</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" value="<?php echo $userlogin_bdd ?>">

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" value="<?php echo $usermdp_bdd ?>" required>

                <label><b>Confirmation de mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="Cpassword" value="<?php echo $usermdp_bdd ?>" required>

                <input type="submit" id='submit' name="modification" value='modification'>
                <?php
                ?>
                
            </form>
        </div>
    </body>

<?php require 'footer.php'; ?>