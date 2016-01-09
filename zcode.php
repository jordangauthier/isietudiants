<?php

    include 'geshi/geshi.php';

    function zcode($texte)
    {
        $texte = preg_replace("/<gras>(.*)<\/gras>/siU" , "<strong>$1</strong>" , $texte);
        $texte = preg_replace("#<couleur=(red|blue|purple|yellow|orange|white)>(.*)<\/couleur>#siU" , "<span style='color:$1'>$2</span>" , $texte);
        $texte = preg_replace("#<taille=(10px|12px|14px|16px|18px|20px|25px)>(.*)<\/taille>#siU" , "<span style='font-size:$1'>$2</span>" , $texte);
        $texte = preg_replace_callback("#<code=(.+)>(.*)<\/code>#siU" , create_function('$matches' , 'return code($matches[2] , $matches[1]);') , $texte);
        $texte = nl2br($texte);

        return $texte;
    }

    function code($source , $language)
    {
        $code = new GeSHi($source,$language);
        $parse = $code->parse_code();
        $resultat = '<div>'.'<br/>'.$parse.'</div>';

        return $resultat;
    }

?>
