<?php

$categories = $result["data"]['categories'];
$sujets = $result["data"]['sujets'];
    
?>

<h1>liste des sujets</h1>

<?php
if (!$categories) {
    echo "<p>Aucune catégories n'a été trouver</p>";
} else {
    foreach($categories as $categorie ){
        ?>
        <p><?=$categorie->getNom()?></p>
        <?php
    }
}?>


<?php
if (!$sujets) {
    echo "<p>Aucun sujet n'a été trouver</p>";
} else {
    foreach($sujets as $sujet ){
        ?>
        <p><?=$sujet->getTitre()?></p>
        <?php
    }
}?>



  
