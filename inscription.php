<?php
require 'header.php';
$errormess = '';
$bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name);
mysqli_set_charset($bdd, 'utf8');

if(isset($_SESSION['login'])) {
    header('Location:profil.php');
}   /*/ouverture d'une session, si login est renseigné redirection vers la page profil.php*/
//var_dump($_SESSION);

if(isset($_POST['connexion'])){
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Cpassword'])) {
    $login = ($_POST['username']);
    $mdp = ($_POST['password']);
    $Cmdp = ($_POST['Cpassword']);
    $Requete = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
    $result = mysqli_fetch_all($Requete);
    if($result == true) {
        $errormess = 'Cet utilisateur existe déja';
    }
    elseif ($mdp == $Cmdp) {
        $reqinsert = mysqli_query($bdd, "INSERT INTO utilisateurs(login, password) VALUES ('$login','$mdp')");
        header('location:connexion.php');

    }
    elseif ($mdp != $Cmdp) {
        $errormess = 'Les mots de passe ne sont pas identiques';
    }
}
}
?>

<body>
        <div id="container">
            <!-- zone d'inscription -->
            <h3 ><?php echo $errormess; ?></h3>
            <form action="" method="POST">
                <h1>Inscription</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <label><b>Confirmation du mot de passe</b></label>
                <input type="password" placeholder="Entrez à nouveau le mot de passe" name="Cpassword" required>

                <input type="submit" id='submit' name="connexion" value='Inscription'>
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Inscription impossible</p>";
                }
                ?>
                
            </form>
        </div>
    </body>

    <?php require 'footer.php'; ?>