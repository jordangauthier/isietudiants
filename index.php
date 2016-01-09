<?php
    //on part la session
    session_start();

    include 'include/function/allfunction.php';

    //on initialise la variable errorWrite
    $errorWrite = '';

    /*
     * On test si la variable de session pseudo existe/si elle existe.
     * On regarde si elle vaut rien. Si elle vaut rien on redirige le membre vers accueil
     */
    if(isset($_SESSION['pseudo']))
    {
        if($_SESSION['pseudo'] != null)
        {
            header('Location: accueil.php');
        }
    }

    /*
     * On teste si la variable $_GET[error] existe
     * si oui on regarde si elle vaut 1,2 ou 4
     * Sinon on redirige vers index.php
     */
    if(isset($_GET['error']))
    {
        if($_GET['error'] == 1)
        {
            $errorWrite = "veuillez entrer un pseudo";
        }

        else if($_GET['error'] == 2)
        {
            $errorWrite = 'Mauvais pseudo ou mot de passe';
        }

        else if($_GET['error'] == 4)
        {
            $errorWrite = "Vous essayer d'entrer illegalement sur le site";
        }

        else
        {
            header('Location: index.php');
        }
    }

    //On test si la variable $_GET[register] existe si oui on affiche le message
    else if(isset($_GET['register']))
    {
        $errorWrite = "Bravo vous etes maintenant enregistrer";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>

<div id="global">

    <div id="logo">
        <p><strong>ISI</strong>etudiants</p>
    </div>

    <div id="globalConnect">
        <form action="connect.php" method="post">
            <p><input class="usertype" type="text" name="pseudo" placeholder="Pseudo"></p>
            <p><input class="usertype" type="password" name="pw" placeholder="Mot de passe"></p>
            <p class="error"><?php echo $errorWrite ; ?></p>
            <p><input class="subbutton" type="submit" value="Connect"> <button formaction="register.php" class="subbutton">S'enrigstrer</button></p>
        </form>
    </div>

</div>


<script>
        var getSubButton = document.getElementsByClassName('subbutton')[0];
        var getSubButtonTwo = document.getElementsByClassName(['subbutton'])[1];

        getSubButton.addEventListener('mousedown', clicksub);
        getSubButtonTwo.addEventListener('mousedown' , clicksubtwo);

        function clicksub()
        {
            document.getElementsByClassName('subbutton')[0].style.borderBottom = "0px";
        }

        function clicksubtwo()
        {
            document.getElementsByClassName('subbutton')[1].style.borderBottom = "0px";
        }
</script>
</body>
</html>
