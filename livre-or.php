<?php
require 'header.php';
$errormess = '';
//var_dump($_SESSION);

$com = mysqli_query($bdd, "SELECT commentaire, date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur=utilisateurs.id ORDER BY date DESC");
$com_tableau = mysqli_fetch_all($com, MYSQLI_ASSOC);
/*var_dump($com_tableau);
$com_date = $com_tableau[0]['date'];
$com_login = $com_tableau[0]['login'];
$com_commentaire = $com_tableau[0]['commentaire'];
*/
?>

<body>
    <?php if(isset($_SESSION['user'])) {
echo "<h3><a href='commentaire.php'>===>Contribuer au livre d'or</a></h3>";
}
?>
            <table class>
                <tr>

                </tr>
                <tr><?php
                    foreach($com_tableau as $com_tableau_user){
                    echo '<tr><th>'.''.'</th>';
                    echo '<td><b>'.$com_tableau_user['login'].'</b><br>'.$com_tableau_user['date'].'<br>'.$com_tableau_user['commentaire'].'</td>';
                    }?>
            </table>
</body>





<?php require 'footer.php'; ?>