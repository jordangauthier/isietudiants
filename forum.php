<?php
    //on part la session
    session_start();

    include 'include/function/allfunction.php';

    $supprime_topic_msg = '';
    $banMsg = '';

    //si la variable session pseudo vaut rien on redirige vers index.php
    ifNotConnected();

    /*
     * on test si la variable get supprime topic existe
     * si oui on regarde si elle vaut true
     * si oui on affecte la valeur dun message a supprime topic
     * sinon on reidirige vers forum.php
     */
    if(isset($_GET['supprime_topic']))
    {
        if($_GET['supprime_topic'] == 'true')
        {
            $supprime_topic_msg = 'Votre message a ete supprimer avec succes';
        }

        else
        {
            header('Location: forum.php');
        }
    }

    if(isset($_GET['ban']))
    {
        if($_GET['ban'] == 'true')
        {
            $banMsg = 'Vous ne pouvez pas postez de message car vous etes bannis pour un temps indeterminer.';
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
        width:50%;
        margin:auto;
        text-align: center;
    }

    #corps
    {
        text-align: left;
        padding: 10px;
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
</style>

</head>
<body>
    <?php include 'header.php'; ?>

    <div id="corpsBackground">

        <div id="corps">
            <div id="secondBod">
                <p style="text-align: center; font-weight: 600;"><?php echo $supprime_topic_msg ?></p>
                <p style="color:red; font-weight: 600;"><?php echo $banMsg ?></p>
                <h3>Section web</h3>
                <div class="forumSection">
                    <h4>Html/css</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Html/css">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Javascript</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Javascript">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Php</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Php">consulter</a></p>
                </div>

                <h3>Programation</h3>
                <div class="forumSection">
                    <h4>C</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=C">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>C++</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Langage cplusplus">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Langage .NET</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=.net">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Java</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Java">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Python</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Python">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Base de donne</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Base de donne">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Mobile</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Mobile">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Autre</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Autres">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Developement</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Developement">consulter</a></p>
                </div>

                <h3>System d'exploitation:</h3>
                <div class="forumSection">
                    <h4>Windows</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Windows">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Linux</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Linux">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Mac os</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Mac os">consulter</a></p>
                </div>

                <h3>Infographie:</h3>
                <div class="forumSection">
                    <h4>Graphisme 3D</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Graphisme 3d">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Graphisme 2D</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Graphisme 2d">consulter</a></p>
                </div>

                <h3>Materiel et logiciel</h3>
                <div class="forumSection">
                    <h4>Hardware</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Hardware">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Software</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Software">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Choix materiel</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Choix materiel informatique">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Probleme technique</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Probleme technique">consulter</a></p>
                </div>

                <div class="forumSection">
                    <h4>Vos reseau</h4>
                    <p>Une question sur la realisation de site web en html/css?</p>
                    <p class="lastmsg"><a href="forumview.php?section=Reseautique">consulter</a></p>
                </div>
            </div>

        </div>

    </div>

    <?php include 'footer.php';?>

</body>
</html>
