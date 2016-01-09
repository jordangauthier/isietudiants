<?php


    //on part la session
    session_start();

    include 'include/function/allfunction.php';

    //si la la variable de session pseudo ne vaut rien on redirige vers index.php
    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php?error=4');
    }

    //sinon on se connect a la base de donner et on lance la requete chosir le pseudo de la table membre_connect
    else
    {
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        $write_membre_connect = $bdd->query('SELECT pseudo FROM membre_connecte');

        //on fais une requete qui dit daller chercher les 10 dernier topic cree
        $get_last_topic = $bdd->query('SELECT * FROM topic ORDER BY id DESC LIMIT 10');

        //on prepare la qrequete qui va aller chercher tout les information a partir du id du membre
        $get_info_account = $bdd->prepare('SELECT * FROM  account WHERE id = :id');

        //on dit que le WHERE id = session id_member et on execute la requete
        $get_info_account->execute(array(
            'id' => $_SESSION['id_member']
        ));

        //on recupere la ligne voulu
        $get_all_info = $get_info_account->fetch();


        $get_article = $bdd->prepare('SELECT * FROM nouvelle ORDER BY date_send desc LIMIT 5');

        $get_article->execute();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php headerFooterCss();?>

    <style>
        #corps
        {
            background-color: red;
            width:50%;
            margin:auto;
            padding:10px;
        }

        #corpBackground
        {
            margin-top: 10px;
        }

        #news
        {
            width:100%;
            background-color: white;
        }
    </style>

</head>
<body>
        <?php include 'header.php'; ?>

        <div id="corpBackground">

            <div id="corps">

                <ul>
                    <?php
                    while($donne_news = $get_article->fetch())
                    {
                        echo"
                            <li style='list-style: none; vertical-align: text-top; margin-top: 50px;'>
                                <img style='width: 350px; display: inline-block;' src=$donne_news[image] alt=''/>
                                <div style='display: inline-block;position: relative;' class='title_and_msg'>
                                    <h3 style='margin-bottom: 100px;' class='titre_news_acc'>$donne_news[titre]</h3>
                                    <p style='width: 550px;margin-bottom: 70px;' class='msg_news_acc;'>$donne_news[message]</p>
                                    <a class='readmore_news_acc' href='viewarticle.php?id=$donne_news[id]'>Lire la suite</a>
                                </div>
                            </li>
                        ";
                    }
                    ?>
                    <p>1 , 2 , 3</p>
                </ul>



                <div id="news">
                    <h3 style="background-color: red; color:white;">Les dernier topic du forum:</h3>

                    <table>
                        <?php
                        while($aff_last_topic = $get_last_topic->fetch())
                        {
                            echo "<tr><td>$aff_last_topic[section_forum]</td><td><a href='viewtopic.php?topic=$aff_last_topic[id]'>$aff_last_topic[titre]</a></td></tr>";
                        }
                        ?>
                    </table>
                </div>

            </div>

        </div>

        <?php include 'footer.php';?>
</body>
</html>
