<?php
    include 'include/function/allfunction.php';
    /*
     * on test si la variable post msg existe
     * si elle nexiste pas on redirige vers forum.php
     * si elle existe on regarde si il nest pas vide
     * -si il nest pas vide on start la session
     * -on se connect a la bdd
     * -on prepare la requete pour inserer le a reponse au topic dans la table soustopic
     * -on lexecute
     * -on reidirige lutilisateur vers viewtopic.php?topic=le_id_du_topic
     */
    if(isset($_POST['msg']))
    {
       if(!empty($_POST['msg']))
       {
           session_start();

           //$bdd = new PDO('mysql:host=localhost;dbname=OCRtest', 'root', '');
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
               $create_new_msg = $bdd->prepare('INSERT INTO soustopic(parent_id, pseudo, message , date_send) VALUES (:parent_id , :pseudo , :message , now())');

               $create_new_msg->execute(array(
                   'parent_id' => $_GET['topic'],
                   'pseudo' => $_SESSION['pseudo'],
                   'message' => $_POST['msg']
               ));

               //on fait une requete pour aller chercher  le nombre de reponse du message
               $take_nb_msg = $bdd->prepare('SELECT nbreponse FROM topic WHERE id = :id');

               //on lexecute
               $take_nb_msg->execute(array(
                   'id' => $_GET['topic']
               ));

               //on va chercher le id du message parent a la reponse
               $select_id = $take_nb_msg->fetch();

               //on fais une requete pour incrementer de 1 le nbreponse du topic et on change la date pour celle de maintenant pour remettre le topic en premiere position
               $increment_nb_reponse = $bdd->prepare('UPDATE topic SET nbreponse = :nbreponse , date_send = now() WHERE id = :id'); // delete le date_send = now() pour faire comme faut

               //on lexecute
               $increment_nb_reponse->execute(array(
                   'id' => $_GET['topic'],
                   'nbreponse' => $select_id['nbreponse'] + 1
               ));

               header('Location: viewtopic.php?topic='.$_GET['topic'].'#formulaireTopic');
           }
       }

        else
        {
            header('Location: viewtopic.php?topic='.$_GET['topic'].'&form=incomplete#formulaireTopic');
        }

    }

    else
    {
        header('Location: forum.php');
    }

?>
