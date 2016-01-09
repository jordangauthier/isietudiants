<?php
    //on part la session
    session_start();

    include 'include/function/allfunction.php';

    //on se connecte a la bdd
    //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
    dbConnect();

    //on prepare la requete qui select tous de message_rpvier a partir de la valeur de mpid dans lurl
    $get_view_mp = $bdd->prepare('SELECT * FROM message_priver WHERE id = :id');

    //on lexecute
    $get_view_mp->execute(array(
        'id' => $_GET['mpid']
    ));

    //on recupere le mp demander
    $donne = $get_view_mp->fetch();

    //on va preparer la requete qui va aller chercher toute les reponse au message-priver voulu
    $get_all_answer = $bdd->prepare('SELECT * FROM mp_reponse WHERE parent_id = :parent_id');

    $get_all_answer->execute(array(
        'parent_id' => $_GET['mpid']
    ));

    //si la variable session pseudo nest pas celle du destinataire du mp on redirige lutilisateur vers index.php
    if($_SESSION['pseudo'] != $donne['destinataire'] and $_SESSION['pseudo'] != $donne['lui_qui_envoi'])
    {
       header('Location: message-prive.php');
    }

    //si la variable mpid nexiste pas dans lurl on redirige vers message-prive.php
    if(!isset($_GET['mpid']))
    {
        header('Location: message-prive.php');
    }

    $messageErreur = '';

    if(isset($_GET['erreur']))
    {
        if($_GET['erreur'] == 1)
        {
            $messageErreur = 'Veuillez ne pas laisser de champs vide';
        }

        else if ($_GET['erreur'] == 2)
        {
            $messageErreur = 'Erreur';
        }

        else if($_GET['erreur'] != 1 or $_GET['erreur'] != 2)
        {
            header("Location: viewmp.php?mpid=$_GET[mpid]");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php headerFooterCss();?>
</head>
<body>
    <?php include 'header.php'; ?>

    <?php
            echo "<table>
                <tr>
                    <td>$donne[titre]</td> <td>$donne[date_send]</td>
                </tr>

                <tr>
                    <td>$donne[lui_qui_envoi]</td>  <td>$donne[message]</td>
                </tr>
             </table>";
    ?>
    <?php
        while($donne_answer = $get_all_answer->fetch())
        {
            echo "<table>

                <tr>

                    <td>$donne[titre]</td> <td>$donne_answer[date_send]</td>

                </tr>

                    <tr>

                        <td>$donne_answer[lui_qui_envoi]</td>  <td>$donne_answer[message]</td>

                    </tr>

                 </table>";
        }
    ?>

    <br>
    <br>

    <form action="transige/mp_answer.php?mpid=<?php echo $_GET['mpid'];?>" method="post">
        <h3>Repondre au message</h3>
        <p>to: <?php echo $donne['titre']; ?></p>
        <textarea name="mp_reponse_area" placeholder="votre message..."></textarea>
        <p><?php echo $messageErreur; ?></p>
        <p><input type="submit" value="envoyer"></p>
    </form>

    <?php include 'footer.php';?>
</body>
</html>
