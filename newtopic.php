<?php

    include 'zcode.php';
    include 'include/function/allfunction.php';

    if(isset($_POST['titre_html_msg']) and isset($_POST['msg_html']))
    {
        if(!empty($_POST['titre_html_msg']) and !empty($_POST['msg_html']))
        {
            session_start();
            //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
            dbConnect();

            //on prepare la requete qui va aller chercher  le id du pseudo du membre connecte
            $take_id_creator = $bdd->prepare('SELECT id , status FROM account WHERE pseudo = :pseudo');

            //on lexecute
            $take_id_creator->execute(array(
                'pseudo' => $_SESSION['pseudo']
            ));

            //on recupere le id desirer
            $takeIdUser = $take_id_creator->fetch();

            if($takeIdUser['status'] == 'bannis')
            {
                header('Location: forum.php?ban=true');
                exit();
            }

            else
            {
                $newMessage = $bdd->prepare('INSERT INTO topic(section_forum, pseudo , pseudo_id , titre ,message, date_send) VALUES (:section_forum, :pseudo, :pseudo_id , :titre , :message , now())');

                $newMessage->execute(array(
                    'pseudo' => $_SESSION['pseudo'],
                    'pseudo_id' => $takeIdUser['id'],
                    'titre' => htmlspecialchars($_POST['titre_html_msg']),
                    'message' => $_POST['msg_html'],
                    'section_forum' => $_GET['section']
                ));

                header('Location: forumview.php?section='.$_GET['section'].'');
                exit();
            }

        }

        else
        {
           header('Location: forumview.php?form=incomplete');
            exit();
        }
    }

    else
    {
        header('Location: disconnect.php');
        exit();
    }
?>
