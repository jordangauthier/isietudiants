<?php
    session_start();

    include 'include/function/allfunction.php';

    $admin = false;

    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php?error=2');
    }

    else
    {
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        $get_pseudo = $bdd->prepare('SELECT admin FROM account WHERE pseudo = :pseudo');

        $get_pseudo->execute(array(
            'pseudo' => $_SESSION['pseudo']
        ));

        $donne_get_pseudo = $get_pseudo->fetch();

        $list_all_pseudo = $bdd->prepare('SELECT pseudo , status FROM account');

        $list_all_pseudo->execute();

        if($donne_get_pseudo['admin'] == 'oui')
        {
            $admin = true;
        }
    }

    $messageCourriel = '';
    $messageImage = '';
    $messagePassword = '';
    $adminMessage = '';
    $adminBanMessage = '';

    if(isset($_GET['change']))
    {
        if($_GET['change'] == 'courriel')
        {
            $messageCourriel = 'Votre courriel a ete modifier avec succes';
        }

        else if($_GET['change'] == 'image')
        {
            $messageImage = 'Votre photo de profil a ete modifier avec succes';
        }

        else if($_GET['change'] == 'password')
        {
            $messagePassword = 'Votre mot de passe a ete modifier avec succes';
        }

        else
        {
            header('Location: option.php');
        }
    }

    if(isset($_GET['ban']))
    {
        if($_GET['ban'] == 'true')
        {
            $adminBanMessage = 'Utilisateur bannis avec succes';
        }

        else
        {
            header('Location: option.php');
        }
    }

    if(isset($_GET['deban']))
    {
        if($_GET['deban'] == 'true')
        {
            $adminBanMessage = 'Utilisateur debannis avec succes';
        }

        else
        {
            header('Location: option.php');
        }
    }

    if(isset($_GET['erreur']))
    {
        if($_GET['erreur'] == 100)
        {
            $messageCourriel = 'Ce courriel est deja utiliser';
        }

        else if($_GET['erreur'] == 101)
        {
            $messageCourriel = 'Le courriel et celui de confirmation ne sont pas identique';
        }

        else if($_GET['erreur'] == 102)
        {
            $messageCourriel = 'Veuillez ne pas laisser les champs vide si vous voulez modifier votre courriel';
        }

        else if($_GET['erreur'] == 103)
        {
            $messageImage = 'Veuillez ne pas laisser les champs vide si vous voulez modifier votre photo de profil';
        }

        else if($_GET['erreur'] == 104)
        {
            $messagePassword = 'Vaut deux  mot de passe ne sont pas identique';
        }

        else if($_GET['erreur'] == 105)
        {
            $messagePassword = 'Ne pas laissez les champs vide si vous voulez modifier votre mot de passe';
        }

        else if($_GET['erreur'] == 106)
        {
            $messagePassword = 'Les variable sont inexistante';
        }

        else if($_GET['erreur'] == 107)
        {
            $adminMessage = 'Ne laissez aucun champs vide';
        }

        else if($_GET['erreur'] == 108)
        {
            $adminBanMessage = 'Ne laissez pas de champs vide';
        }

        else if($_GET['erreur'] == 109)
        {
            $adminBanMessage = 'Le pseudo est inexistant';
        }

        else
        {
            header('Location: option.php');
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

        #corpsBackground
        {
            margin:auto;
        }

        #corps
        {
            background-color: red;
            width:50%;
            margin:auto;
            padding:10px;
            height: 500px;
        }

        #secondBod
        {
            margin: auto;
        }

        .forumSection
        {
            width:30%;
            background-color: red;
            display: inline-block;
            text-align: left;
            margin-top:5px;
            padding: 5px;
        }

        .forumSection:hover
        {
            background-color: green;
        }

        .lastmsg
        {
            border-top:1px solid black;
            margin-top:15px;
        }

        #imgProfil img
        {
            width:250px;
        }

        #imgProfil
        {
            float: left;
        }

        #info_about
        {
            float:right;
        }

        #info_about ul
        {
            list-style:none;
        }

        #lastProfilTopic
        {
            clear: both;
        }
    </style>

</head>
<body>

    <?php include 'header.php';?>

    <h2>Changer ses information</h2>

    <h3>Changer son courriel</h3>
    <p><?php echo $messageCourriel; ?></p>
    <form action="transige/change_courriel.php" method="post">
        <p><input type="email" name="change_courriel" placeholder="Changer son courriel"></p>
        <p><input type="email" name="change_courriel_confirm" placeholder="Confirmation du courriel"></p>
        <p><input type="submit" value="Sauvegarder"></p>
    </form>

    <h3>Changer sa photo de profil</h3>
    <p><?php echo $messageImage; ?></p>
    <form action="transige/change_photo.php" method="post">
        <p><input type="text" name="change_img" placeholder="Url de la nouvelle image"></p>
        <p><input type="submit" value="Sauvegarder"></p>
    </form>

    <h3>Changer son mot de passe</h3>
    <p><?php echo $messagePassword; ?></p>
    <form action="transige/change_password.php" method="post">
        <p><input type="password" name="change_password" placeholder="Changer son mot de passe"></p>
        <p><input type="password" name="change_password_confirm" placeholder="Confirmation du mot de passe"></p>
        <p><input type="submit" value="Sauvegarder"></p>
    </form>

    <?php
        if($admin)
        {
            echo "
            <h3>Section admin:</h3>

            <h4>Nouvelle article</h4>

            <form action='transige/newsPublication.php' method='post'>
                <p><input type='text' name='titre_news_admin' placeholder='Titre'></p>
                <p><input type='text' name='img_news_admin'></p>
                <p><textarea name='msg_news_admin' placeholder='message...'></textarea></p>
                <p>$adminMessage</p>
                <p><input type='submit' value='Publier'></p>
            </form>

            <form action='transige/bannir.php' method='post'>
                <h4>Bannir/debannir un membre:</h4>
                <p>$adminBanMessage</p>
                <input type='text' name='ban_pseudo' placeholder='Pseudo du membre a bannir'>
                <input type='submit' value='bannir'>
            </form>
            <form action='transige/debannir.php' method='post'>
                <input type='text' name='deban_pseudo' placeholder='Pseudo du membre a debannir'>
                <input type='submit' value='debannir'>
            </form>
            ";
        }
    ?>


    <?php include 'footer.php';?>

</body>
</html>
