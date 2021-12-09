<?php
require 'header.php';
$errormess = '';


if(isset($_SESSION['user'])) {
    //var_dump($_SESSION['user']);
    $user = $_SESSION['user'];
    $user_login = $user[0]['1'];
    $user_id = $user[0]['0'];
    $date = date('Y-m-d H:i:s');

$Requete = mysqli_query($bdd, "SELECT * FROM commentaires WHERE id_utilisateur = '$user_id'");
$nouveau_com = mysqli_fetch_all($Requete);
//var_dump($nouveau_com);

if(isset($_POST['envoyer'])) {

    if(empty($nouveau_com)) {
        $commentaire = $_POST['commentaire'];
    
        $reqinsert = mysqli_query($bdd, "INSERT INTO commentaires (id, commentaire, id_utilisateur, date) VALUES (NULL, '$commentaire', '$user_id', '$date');");
        //echo "insertion réussie de votre premier commentaire";
        header('location:livre-or.php');
    }
    else {
        $commentaire = $_POST['commentaire'];
    
        $reqinsert = mysqli_query($bdd, "INSERT INTO commentaires (id, commentaire, id_utilisateur, date) VALUES (NULL, '$commentaire', '$user_id', '$date');");
        header('location:livre-or.php');


    }
}
}
//essayons un elseif

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