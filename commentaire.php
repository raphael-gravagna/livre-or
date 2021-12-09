<?php
require 'header.php';
$errormess = '';


if(isset($_SESSION['user'])) {
if(isset($_POST['envoyer'])) {
    $user = $_SESSION['user'];
    //var_dump($user);
    $user_login = $user[0]['1'];
    $user_id = $user[0]['0'];
    //var_dump($user_id);
    $date = date('Y-m-d H:i:s');
    //var_dump($date);
    $commentaire = $_POST['commentaire'];
    //var_dump($commentaire);
    //var_dump($bdd);
    //var_dump($date);
    $reqinsert = mysqli_query($bdd, "INSERT INTO commentaires (id, commentaire, id_utilisateur, date) VALUES (NULL, '$commentaire', '$user_id', '$date');");
    echo "insertion réussie";
}
    $user = $_SESSION['user'];
    $user_login = $user[0]['1'];
    $user_id = $user[0]['0'];
    $date = date('Y-m-d H:i:s');
$Requete = mysqli_query($bdd, "SELECT * FROM commentaires WHERE id_utilisateur = '$user_id'");
$nouveau_com = mysqli_fetch_all($Requete);

    if($nouveau_com == true && ) {
        $commentaire = $_POST['commentaire'];
        $reqinsert = mysqli_query($bdd, "INSERT INTO commentaires (id, commentaire, id_utilisateur, date) VALUES (NULL, '$commentaire', '$user_id', '$date');");
    }
}


?>

<body>
        <div id="container">
            <h3 ><?php echo $errormess; ?></h3>

            <form action="" method="POST">
                <h1>Livre d'or</h1>
                
                <textarea name="commentaire" cols="52" rows="5">Vous pouvez saisir votre commentaire qui sera très positif j'en suis sur, ici. Dans le cas contraire, Pascal remontera votre IP et nous vous enverrons les Lopez.</textarea>

                <input type="submit" id='submit' name="envoyer" value='Envoyer'>
            </form>
        </div>
    </body>

    <?php require 'footer.php'; ?>