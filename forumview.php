<?php
    //on part la session
    session_start();

    include 'include/function/allfunction.php';

    //on initialise la variable write
    $write = '';

    //on declare le tableau sectionTab avec comme valeur les nom des section des forum
    $sectionTab = [
        'Html/css',
        'Javascript',
        'Php',
        'C',
        'Langage cplusplus',
        '.net',
        'Java',
        'Python',
        'Base de donne',
        'Mobile',
        'Autres',
        'Developement',
        'Windows',
        'Linux',
        'Mac os',
        'Graphisme 3d',
        'Graphisme 2d',
        'Hardware',
        'Software',
        'Choix materiel informatique',
        'Probleme technique',
        'Reseautique'
    ];

    /*
     * 1ier if: On teste si la variable $_GET[section] existe
     * 2ieme if: si oui on regarde si sa valeur nest pas egal avec une valeur du tableau sectiontab
     * Si elle negal a aucune section on redirige vers forum/php
     * sinon si la variable $_GET[section] nexiste pas on redigirge vers forum.php
     */
    if(isset($_GET['section']))
    {
        if(!in_array($_GET['section'] , $sectionTab))
        {
            header('Location: forum.php');
        }
    }

    else
    {
        header('Location: forum.php');
    }

    /*
     * si la variable de session pseudo est null on redirige vers index.php
     * sinon On teste si la variable $_GET[form] existe
     * On regarde ensuite si la avriable get form vaut incomplete
     * si oui on affiche le message derreur
     * sinon si la variable get form vaut autre chose on redirige vers forum.php
     * Si la variable session negale pas null on se connecte a la bdd
     * on lance ensuite laa requete de chosir le pseudo le titre et le id de la table topic a selon la section_forum
     */
    if($_SESSION['pseudo'] == null)
    {
        header('Location: index.php?error=4');
    }

    else
    {
        if(isset($_GET['form']))
        {
            if($_GET['form'] == 'incomplete')
            {
                $write = 'Veuillez remplir tous les champ';
            }

            else
            {
                header('Location: forum.php');
            }
        }
        $bdd =  new PDO('mysql:host=localhost;dbname=OCRtest' , 'root' , '');

        $aff_topic = $bdd->query("SELECT pseudo, titre , id , nbreponse FROM topic WHERE section_forum= '" . $_GET['section'] ."' ORDER BY date_send DESC");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php headerFooterCss(); ?>
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
    
    .zcodeIcon
    {
        display: inline-block;
        list-style: none;
        text-align: left;
        border:1px solid red;
        padding-right:10px;
        padding-left:10px;
        padding-top:5px;
        padding-bottom:5px;
    }
    
    #zcodeList
    {
        display: inline-block;
        border:1px solid black;
    }
    
    

</style>

</head>
<body>
<?php include 'header.php'; ?>

<div id="corps">
    <h1><?php echo $_GET['section']; ?></h1>

    <a href="#formulaireTopic">Cree un topic</a>
    <?php
        //on affiche les topic selon la section sur laquel on a cliquer
        while($donne = $aff_topic->fetch())
        {
            echo "
                <div class='topicSection'>
                    <a href='viewtopic.php?topic=$donne[id]'>
                    <table>
                        <tr>
                            <td>" .$donne['titre']."</td>
                            <td>$donne[nbreponse]</td>
                            <td>".$donne['pseudo']."</td>
                        </tr>
                    </table>
                    </a>
                </div>
                ";
        }
    ?>

    <div id="formulaireTopic">
        <form action="newtopic.php?section=<?php echo $_GET['section'];?>" method="post">
            <h5>Titre:</h5>
            <p><input name="titre_html_msg" class="inputTitre" type="text"></p>
            <h5>Message:</h5>
            <ul id="zcodeList">
                <li id="zcodeIconGras" class="zcodeIcon">G</li>
                <li id="zcodeIconColor" class="zcodeIcon">
                    C
                    <ul  id="listColor" style="display: none;">
                        <li><img id="orangeColor" src="image/orange_color.jpg" alt=""></li>
                        <li><img id="redColor" src="image/red_color.jpg" alt=""></li>
                        <li><img id="blueColor" src="image/blue_color.jpg" alt=""></li>
                    </ul>
                </li>
                <li id="zcodeIconTaille" class="zcodeIcon">
                    T

                    <ul id="zcodeListTaille" style="display: none;">
                        <li id="taille10">Taille 10</li>
                        <li id="taille12">Taille 12</li>
                        <li id="taille14">Taille 14</li>
                        <li id="taille16">Taille 16</li>
                        <li id="taille18">Taille 18</li>
                        <li id="taille20">Taille 20</li>
                        <li id="taille25">Taille 25</li>
                    </ul>
                </li>
                <li id="zcodeIconCode" class="zcodeIcon">
                    Code

                    <ul id="zcodeListCode" style="display: none;">
                        <?php
                            $lang_tab = array(
                                'Actionscript',
                                'ADA',
                                'Apache Log ',
                                'AppleScript',
                                'ASM',
                                'ASP',
                                'AutoIT',
                                'Bash',
                                'BlitzBasic',
                                'C',
                                'C for Macs',
                                'C#',
                                'C++',
                                'CAD DCL',
                                'CadLisp',
                                'CFDG',
                                'ColdFusion',
                                'CSS',
                                'Delphi',
                                'DIV',
                                'DOS',
                                'Eiffel',
                                'Fortran',
                                'FreeBasic',
                                'GML',
                                'HTML',
                                'Inno',
                                'Java',
                                'Java 5',
                                'Javascript',
                                'Lisp',
                                'Lua',
                                'Microprocessor ASM',
                                'MySql',
                                'NSIS',
                                'Objective C',
                                'OCaml',
                                'OpenOffice BASIC',
                                'Oracle 8 SQL',
                                'Pascal',
                                'Perl',
                                'php',
                                'Python',
                                'Q(uick)BASIC',
                                'robots.txt',
                                'Ruby',
                                'SAS',
                                'Scheme',
                                'SDLBasic',
                                'Smarty',
                                'SQL',
                                'T-SQL',
                                'VB.NET',
                                'Visual BASIC',
                                'Visual Fox Pro',
                                'XML',
                            );

                            for($i = 0 ; $i <= count($lang_tab) - 1 ; $i++)
                            {
                                echo "<li>$lang_tab[$i]</li>";
                            }
                        ?>
                    </ul>
                </li>
            </ul>
            <p><textarea name="msg_html"></textarea></p>
            <h5><?php echo $write ?></h5>
            <p><input type="submit"></p>
        </form>
    </div>
</div>



<?php include 'footer.php';?>

<script>

    //variable qui definiti le bouton balise
    var boldButton = document.getElementById('zcodeIconGras');
    var tailleButton = document.getElementById('zcodeIconTaille');
    var colorButton = document.getElementById('zcodeIconColor');
    var codeButton = document.getElementById('zcodeIconCode');

    //le textarea
    var areaSpace = document.getElementsByTagName('textarea')[0];

    //on ajoute led listener  au bouton des balise gras
    boldButton.addEventListener('click' , clickOnBold);

    //on ajoute led listener  au bouton des balise taille
    tailleButton.addEventListener('mouseover' , hoverOnTaille);
    tailleButton.addEventListener('mouseout' , outOnTaille);

    var taille10Button = document.getElementById('taille10');
    var taille12Button = document.getElementById('taille12');
    var taille14Button = document.getElementById('taille14');
    var taille16Button = document.getElementById('taille16');
    var taille18Button = document.getElementById('taille18');
    var taille20Button = document.getElementById('taille20');
    var taille25Button = document.getElementById('taille25');

    taille10Button.addEventListener('click' , clickOnTaille10);
    taille12Button.addEventListener('click' , clickOnTaille12);
    taille14Button.addEventListener('click' , clickOnTaille14);
    taille16Button.addEventListener('click' , clickOnTaille16);
    taille18Button.addEventListener('click' , clickOnTaille18);
    taille20Button.addEventListener('click' , clickOnTaille20);
    taille25Button.addEventListener('click' , clickOnTaille25);

    //on ajoute led listener  au bouton des balise couleur
    colorButton.addEventListener('mouseover' , hoverOnColor);
    colorButton.addEventListener('mouseout' , outOnColor);

    var orangeButton = document.getElementById('orangeColor');
    var redButton = document.getElementById('redColor');
    var blueButton = document.getElementById('blueColor');

    orangeButton.addEventListener('click' , clickOnOrange);
    redButton.addEventListener('click' , clickOnRed);
    blueButton.addEventListener('click' , clickOnBlue);

    //on ajoute led listener  au bouton des balise code
    codeButton.addEventListener('mouseover' , hoverOnCode);
    codeButton.addEventListener('mouseout' , outOnCode);

    var lang_tab = [
        'Actionscript',
        'ADA',
        'Apache Log ',
        'AppleScript',
        'ASM',
        'ASP',
        'AutoIT',
        'Bash',
        'BlitzBasic',
        'C',
        'C for Macs',
        'C#',
        'C++',
        'CAD DCL',
        'CadLisp',
        'CFDG',
        'ColdFusion',
        'CSS',
        'Delphi',
        'DIV',
        'DOS',
        'Eiffel',
        'Fortran',
        'FreeBasic',
        'GML',
        'HTML',
        'Inno',
        'Java',
        'Java 5',
        'Javascript',
        'Lisp',
        'Lua',
        'Microprocessor ASM',
        'MySql',
        'NSIS',
        'Objective C',
        'OCaml',
        'OpenOffice BASIC',
        'Oracle 8 SQL',
        'Pascal',
        'Perl',
        'php',
        'Python',
        'Q(uick)BASIC',
        'robots.txt',
        'Ruby',
        'SAS',
        'Scheme',
        'SDLBasic',
        'Smarty',
        'SQL',
        'T-SQL',
        'VB.NET',
        'Visual BASIC',
        'Visual Fox Pro',
        'XML',
    ];

    for(var k = 24 ; k <= 80 - 1 ; k++)
    {
        var codeVar = document.getElementsByTagName('li')[k];
        codeVar.addEventListener('click' , clickOnCode);
    }

    //


    /////////////////////////////////////////LES FONCTION DES BALISE GRAS////////////////////////////////////////

    function clickOnBold()
    {
        var textnode = document.createTextNode("<gras></gras>");
        areaSpace.appendChild(textnode);
    }


    ////////////////////////////////LES FONCTIONS DES BALISE TAILLE//////////////////////////////////////////////

    function hoverOnTaille()
    {
        document.getElementById('zcodeListTaille').style.display = 'block';
        document.getElementById('zcodeListTaille').style.position = 'fixed';
    }

    function outOnTaille()
    {
        document.getElementById('zcodeListTaille').style.display = 'none';
    }

    function clickOnTaille10()
    {
        var textnode = document.createTextNode("<taille=10px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille12()
    {
        var textnode = document.createTextNode("<taille=12px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille14()
    {
        var textnode = document.createTextNode("<taille=14px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille16()
    {
        var textnode = document.createTextNode("<taille=16px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille18()
    {
        var textnode = document.createTextNode("<taille=18px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille20()
    {
        var textnode = document.createTextNode("<taille=20px></taille>");
        areaSpace.appendChild(textnode);
    }

    function clickOnTaille25()
    {
        var textnode = document.createTextNode("<taille=25px></taille>");
        areaSpace.appendChild(textnode);
    }
    /////////////////////////////LES FONCTIONS DES BALISE COULEUR/////////////////////////////////////////

    function hoverOnColor()
    {
        document.getElementById('listColor').style.display='block';
        document.getElementById('listColor').style.position='fixed';
        document.getElementById('listColor').style.backgroundColor='black';
    }

    function outOnColor()
    {
        document.getElementById('listColor').style.display='none';
    }

    function clickOnOrange()
    {
        var textnode = document.createTextNode("<couleur=orange></couleur>");
        areaSpace.appendChild(textnode);
    }

    function clickOnRed()
    {
        var textnode = document.createTextNode("<couleur=red></couleur>");
        areaSpace.appendChild(textnode);
    }

    function clickOnBlue()
    {
        var textnode = document.createTextNode("<couleur=blue></couleur>");
        areaSpace.appendChild(textnode);
    }

    //////////////////////////LE FONCTION DES BALISE CODE/////////////////////////////////////////

    function hoverOnCode()
    {
        document.getElementById('zcodeListCode').style.display = 'block';
        document.getElementById('zcodeListCode').style.position = 'fixed';
        document.getElementById('zcodeListCode').style.fontSize = '11px';
    }

    function outOnCode()
    {
        document.getElementById('zcodeListCode').style.display = 'none';
    }

    function clickOnCode()
    {

        var getlist = document.getElementsByTagName('li');

        for(var i = 24 ; i <= 80 - 1 ; i ++)
        {
             if(this == getlist[i])
             {
                 console.log('allo');
                 var textnode = document.createTextNode("<code="+lang_tab[i-24]+"></code>");
                 areaSpace.appendChild(textnode);
             }
        }
    }

</script>
</body>
</html>
