<?php

header("content-type: image/png");
//imagen y sus medidas
$image = imagecreate(130,50);
//color de fondo
$color_fondo= imagecolorallocate($image,212,197,192);
$color_texto= imagecolorallocate($image,30 ,18,18);

function generar_caracteres($chars, $lenght){
    $captcha = null;

    for ($i=0; $i <$lenght; $i++) { 
        $rand = rand(0 , count($chars)-1);
        $captcha.= $chars[$rand];
    }
    return $captcha;
}
//se encripta para que no se pueda obtener 
$captcha = generar_caracteres(array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'),6);

setcookie('captcha',sha1($captcha),time()+60*3);
//agregamos el texto a la imagen
imagettftext($image,22,15,12,40,$color_texto,"ASMAN.TTF",$captcha);
//terminamos de crear la imagen
imagepng($image);