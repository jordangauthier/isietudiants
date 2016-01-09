<?php

    //on start la session
    session_start();

    include 'include/function/allfunction.php';

    //si la variable session pseudo vaut rien on redirige vers index.php
    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php?error=4');
    }

    else
    {
        //on se connect a la bdd
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        //on prepare la qrequete qui va aller chercher tout les information a partir du id du membre
        $get_info_account = $bdd->prepare('SELECT * FROM  account WHERE id = :id');

        //on dit que le WHERE id = session id_member et on execute la requete
        $get_info_account->execute(array(
           'id' => $_GET['user']
        ));

        //on recupere la ligne voulu
        $get_all_info = $get_info_account->fetch();

        //on prepare la requete (on prend tout de topic a partir de la variable get user)
        $get_last_topic_profil = $bdd->prepare('SELECT * FROM topic WHERE pseudo_id = :pseudo_id ORDER BY id DESC LIMIT 10');

        //on execute la requete
        $get_last_topic_profil->execute(array(
            'pseudo_id' => $_GET['user']
        ));
    }

    //si la variable get user existe on regarde si elle ne vaut pas un id membre existant si ses le cas on reidirige vers index.php
    if(isset($_GET['user']))
    {
       if($_GET['user'] != $get_all_info['id'])
       {
           header('Location: index.php');
       }
    }

    //si la variableb  get user nexiste pas on redirige vers index.php
    else
    {
        header('Location: index.php');
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

    <div id="corpsBackground">

        <div id="corps">

            <div id="imgProfil">
                <img src="<?php echo $get_all_info['url_img'];?>">
            </div>

            <div id="info_about">

                <ul>
                    <li><strong>A propos de <?php echo $get_all_info['prenom'].' '.$get_all_info['nom']; ?>:</strong></li>
                    <li>Pseudo: <?php echo $get_all_info['pseudo'] ?></li>
                    <li>Nom: <?php echo $get_all_info['nom'] ?></li>
                    <li>Prenom <?php echo $get_all_info['prenom'] ?></li>
                    <li>Programe d'etude: <?php echo $get_all_info['programe_etude'] ?></li>
                </ul>

            </div>

            <div id="lastProfilTopic">

                    <?php

                        //on affiche les 10 dernier message
                        while($aff_last_topic_profil = $get_last_topic_profil->fetch())
                        {
                            echo "<p><a href='viewtopic.php?topic=$aff_last_topic_profil[id]'>$aff_last_topic_profil[titre]</a></p>";
                        }

                    ?>

            </div>

        </div>

    </div>

<?php include 'footer.php';?>

</body>
</html>
