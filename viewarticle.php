<?php
    session_start();

    include 'include/function/allfunction.php';

    ifNotConnected();

    $idArticle = $_GET['id'];

    if(isset($idArticle))
    {
        //$bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');
        dbConnect();

        $get_article_from_id = $bdd->prepare('SELECT * FROM nouvelle WHERE id = :id');

        $get_article_from_id->execute(array(
            'id' => $idArticle
        ));

        $donne_id_article = $get_article_from_id->fetch();
    }

    else
    {
        header('Location: accueil.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php headerFooterCss();?>
</head>
<body>

<?php include 'header.php';?>

<?php
    echo"
            <div>
                <img src=$donne_id_article[image] alt=''/>
                <h2>$donne_id_article[titre]</h2>
                <p>$donne_id_article[message]</p>
            </div>
    ";
?>
<?php include 'footer.php';?>
</body>
</html>
