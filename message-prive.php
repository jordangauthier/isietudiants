<?php
    session_start();

    include 'include/function/allfunction.php';

    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php');
    }

    else
    {
        //on se connect a la base de donne
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        //on prepare la qrequete qui select tous de la tble message priver a partir du destinataire qui est la variable session pseudo
        $get_mp_received = $bdd->prepare('SELECT * FROM message_priver WHERE destinataire = :destinataire ORDER BY date_send desc');

        //on lexecute
        $get_mp_received->execute(array(
            'destinataire' => $_SESSION['pseudo']
        ));

        //on prepare la requete qui select tous de la table message priver a partir de lui qui envoie le message qui vaut la variable session pseudo
        $get_mp_send = $bdd->prepare('SELECT * FROM message_priver WHERE lui_qui_envoi = :lui_qui_envoi');

        //on lexecute
        $get_mp_send->execute(array(
            'lui_qui_envoi' => $_SESSION['pseudo']
        ));
    }

    $messageErreur = '';

    if(isset($_GET['erreur']))
    {
        if($_GET['erreur'] == 1)
        {
            $messageErreur = 'Le pseudo est invalide';
        }

        else if($_GET['erreur'] == 2)
        {
            $messageErreur = 'Veuillez ne pas laissez de champs vide';
        }

        else if ($_GET['erreur'] == 3)
        {
            $messageErreur = 'Erreur';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php headerFooterCss();?>

    <style>
        #globalNewMp
        {
            background-color: red;
            width: 50%;
            margin: auto;
            padding:10px;
        }

        textarea
        {
            width: 100%;
            height:200px;
        }
    </style>

</head>
<body>
    <?php include 'header.php'; ?>

    <div id="globalNewMp">

        <h3>Mes message prive:</h3>
        <?php
            while($messageRecu = $get_mp_received->fetch())
            {
                echo "<table>

                        <tr>

                        <td>$messageRecu[lui_qui_envoie_save]</td>  <td>$messageRecu[titre]</td> <td><a href='viewmp.php?mpid=$messageRecu[id]'>consulter</a></td> <td><a href='transige/del_mp_receive.php?mpid=$messageRecu[id]'>Supprimer</a></td>

                        </tr>

                     </table>";
            }
        ?>

        <h3>Mes message envoyer:</h3>
        <?php
            while($messageEnvoyer = $get_mp_send->fetch())
            {
                echo "<table>

                        <tr>

                            <td>$messageEnvoyer[destinataire_save]</td>  <td>$messageEnvoyer[titre]</td> <td><a href='viewmp.php?mpid=$messageEnvoyer[id]'>consulter</a></td> <td><a href='transige/del_mp_send.php?mpid=$messageEnvoyer[id]'>Supprimer</a></td>

                        </tr>

                     </table>";
            }
        ?>


        <h3>Enovyer un nouveau message</h3>
        <form action="transige/newMp.php" method="post">
            <h5>Destinataire:</h5>
            <p><input type="text" name="destinataire_mp" placeholder="Pseudo du destinataire"></p>
            <h5>Titre:</h5>
            <p><input type="text" name="titre_mp" placeholder="Titre du message"></p>
            <h5>Message:</h5>
            <p><textarea name="message_mp" placeholder="Votre message..."></textarea></p>
            <p><?php echo $messageErreur; ?></p>
            <p><input type="submit" value="envoyer"></p>
        </form>
    </div>


    <?php include 'footer.php';?>
</body>
</html>
