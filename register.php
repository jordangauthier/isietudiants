<?php
    include 'include/function/allfunction.php';
    $errorWrite = '';

    //on teste si la variable get error existe si oui on regarde elle vaut quoi et on affiche le message derreur aproprier
    if(isset($_GET['error']))
    {
        if($_GET['error'] == 3)
        {
            $errorWrite = 'Le pseudo ou le courriel est deja prit';
        }

        else if($_GET['error'] == 2)
        {
            $errorWrite = 'Veuillez remplir tous les champ';
        }

        else
        {
           header('Location: register.php');
        }

    }

    if(
        isset($_GET['nom']) AND
        isset($_GET['prenom']) AND
        isset($_GET['courriel']) AND
        isset($_GET['programe'])
      )
    {
        if(preg_match("/^[A-Za-z]/", $_GET['nom']))
        {
            echo 'good';
        }

        else
        {
            echo 'not good';
        }
    }

    else
    {

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<div id="global">

    <div id="logo">
        <p>Inscription:</p>
    </div>

    <div id="globalConnect">
        <form action="registerbdd.php" method="post">
            <p><input class="inputRegister" type="text" placeholder="Nom" name="nom_account"></p>
            <p><input class="inputRegister" type="text" placeholder="Prenom" name="prenom_account"></p>
            <p><input class="inputRegister" type="text" placeholder="pseudo" name="pseudo_account"></p>
            <p><input class="inputRegister" type="password" placeholder="Mot de passe" name="pw_account"></p>
            <p><input class="inputRegister" type="email" placeholder="Courriel" name="courriel_account"></p>
            <p><input class="inputRegister" type="text" placeholder="url image de profil" name="img_account"></p>
            <p><select name="programe_account">
                    <option selected disabled>Choisir un programe d'etude</option>
                    <option>Programation reseau et telecommunication</option>
                    <option>Programation et technologie internet</option>
                    <option>Reseau securiter et telephonie ip</option>
                    <option>Integration de systeme d'information</option>
                    <option>Integration de site web</option>
                    <option>Gestion de projet informatique</option>
                </select></p>
            <p style="color: white; font-weight: 600;"><?php echo $errorWrite ?></p>
            <p><input class="subbutton" type="submit" value="s'inscrire"></p>
        </form>
    </div>

</div>


<script>
    var getbutton = document.getElementsByClassName('subbutton')[0];

    getbutton.addEventListener('mousedown' , clicksub);


    function clicksub()
    {
        document.getElementsByClassName('subbutton')[0].style.borderBottom = "0px";
    }
</script>
</body>
</html>
