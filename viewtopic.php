<?php
    session_start();

    include 'zcode.php';
    include 'include/function/allfunction.php';

    $write= '';

    $delete_topic = '';
    $delete_answer = '';

    //si le parametre url topic nexiste pas on reidirige vers forum.php
    if(!isset($_GET['topic']))
    {
        header('Location: forum.php');
    }

    /*
     * si la variable de session pseudo ne vaut rien on reidirige vers index.php
     * sinon on se connecte la base de donne
     * on efectue une requete a la table topic du id de la valeyr de get topic
     * on effectue un autre requete de la table soustopic du parend_id qui vaut celui de la valeur de get topic
     */
    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php');
    }

    else
    {
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        ////////////////////////////////////////////////////////////////////////////////////////
        $aff_message = $bdd->query("SELECT * FROM topic WHERE id= '" . $_GET['topic'] ."'");

        $donne = $aff_message->fetch();

        ////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////////////////

        $aff_all = $bdd->query("SELECT * FROM soustopic WHERE parent_id= '" . $_GET['topic'] ."'");

        ///////////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $take_pseudo_answer = $bdd->query("SELECT pseudo FROM soustopic WHERE parent_id ='" . $_GET['topic'] ."'");

        $aff_pseudo_answer = $take_pseudo_answer->fetchAll();
    }

    /*
    * on teste si la variable get topic exite
    * si oui on regarde si la variable get topic ne vaut pas un id
    * si elle ne vaut pas une des id on redirige lutilisateur a forum.php
    */
    if(isset($_GET['topic']))
    {
        if($_GET['topic'] != $donne['id'])
        {
            header('Location: forum.php');
        }

        else if($_GET['topic'] == "")
        {
            header('Location: forum.php');
        }
    }

    /*
     * on teste si la variable get form existe
     * si elle existe on regarde si get form vaut incomplete
     * si oui la variable write vaut veuillez remplir tous les champ
     * sinon la variable get form ne vaut pas incomplete on redirige vers viewtopic.php?topic = get topic
     */
    if(isset($_GET['form']))
    {
        if($_GET['form'] == 'incomplete')
        {
            $write = 'Veuillez remplir tous les champ';
        }

        else
        {
            header('Location: viewtopic.php?topic='.$_GET['topic'].'');
        }
    }

    if($_SESSION['pseudo'] == $donne['pseudo'])
    {
        $delete_topic = '<a href='.'transige/deltopic.php?topic='.$_GET['topic'].'>'.'Supprimer'.'</a>';
    }


    //on test pour chaque reponse si la variable session pseudo est egal celle du createur de la reponse
    for($i = 0 ; $i <= count($aff_pseudo_answer) - 1 ; $i++)
    {
        if($_SESSION['pseudo'] == $aff_pseudo_answer[$i][0])
        {
            //on insere le supprimer
        }

        else
        {
            //on insert une variable qui vaut rien
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

        .topicSection
        {
            width:100%;
            background-color: red;
            margin-top:5px;
        }

        .topicSection td
        {
            width: 300px;
            text-align: center;
            padding: 10px;
        }

        #formulaireTopic .inputTitre
        {
            width:100%;
        }

        #formulaireTopic textarea
        {
            width:100%;
            height:300px;
        }

        #corps
        {
            width:50%;
            margin: auto;
            margin-top: 10px;
        }

        #oneMessage
        {
            width: 100%;
        }

        #oneMessage td
        {
            background-color: red;
        }

        #oneMessage .notMsg
        {
            background-color: red;
        }

        #oneMessage pre
        {
            overflow: scroll;
            width:80%;
            margin:auto;
            font-size:15px;
        }

    </style>

</head>
<body>
<?php include 'header.php'; ?>

<div id="corps">
    <h1><?php echo $donne['titre'] ?></h1>

    <a href="#formulaireTopic">Repondre au message</a>

    <table id="oneMessage">
        <tr>
            <td><?php echo $donne['titre']; ?></td>
            <td><?php echo $donne['date_send']; ?></td>
        </tr>

        <tr>
            <td><?php echo "<a href='profil.php?user=$donne[pseudo_id]'>$donne[pseudo]</a>" ?></td>
            <td><?php echo $delete_topic ?></td>
        </tr>

        <tr>
            <td colspan="2"><?php echo zcode($donne['message']); ?></td>
        </tr>
    </table>

    <?php
        while($donne_answer = $aff_all->fetch())
        {
           echo '<table>'.'<tr>'.'<td>'.$donne_answer['pseudo'].'</td>'.'<td>'.$delete_answer.'</td>'.'</tr>'.'<tr>'.'<td>'.zcode($donne_answer['message']).'</td>'.'</tr>'.'</table>';

        }
    ?>



    <div id="formulaireTopic">
        <form
            action="newmessage.php?topic=<?php echo $_GET['topic'];?>" method="post">
            <h5>Message:</h5>
            <p><textarea name="msg"></textarea></p>
            <h5><?php echo $write ?></h5>
            <p><input type="submit"></p>
        </form>
    </div>
</div>



<?php include 'footer.php';?>
</body>
</html>
