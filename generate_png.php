<?php
header ("Content-type: image/png");
$im = ImageCreate (100, 20)
or die ("Erreur lors de la création de l'image");
$couleur_fond = ImageColorAllocate ($im, 255, 255, 255);
$noir = ImageColorAllocate($im, 0, 0, 0);
imagestring($im, 5, 5, 2, $_GET['number'], $noir);
ImagePng ($im);
?>