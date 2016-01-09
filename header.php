<div id="headerBackground">

    <div id="header">


        <ul>
            <li id="logo"><h2><a href=""><strong>ISI</strong>etudiants</a></h2></li>
            <li class="menuele"><a href="">formation</a></li>
            <li class="menuele"><a href="">Mon profil</a></li>
            <li class="menuele"><a href="accueil.php">Accueil</a></li>
            <li class="menuele"><a href="forum.php">Forum</a></li>
            <li class="menuele"><a href="">tchat</a></li>
            <li class="menuele">
                <?php echo $_SESSION['pseudo'];?>
                <ul id="menuhide" style="display: none; position: fixed; background-color: red;">
                    <li><a href="option.php">Option</a></li>
                    <li><a href="deconnect.php">Deconnexion</a></li>
                    <li><a href="message-prive.php">Message  prive</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>

<script>
    document.getElementsByClassName('menuele')[5].addEventListener('mouseover' , showMenu);

    document.getElementsByClassName('menuele')[5].addEventListener('mouseout' , hideMenu);

    function showMenu()
    {
        document.getElementById('menuhide').style.display = 'block';
        document.getElementById('menuhide').style.textAlign = 'left';
    }

    function hideMenu()
    {
        document.getElementById('menuhide').style.display = 'none';
    }
</script>
