<?php

$sujets = $result["data"]['sujets'];
    
?>

<h1>liste des sujets</h1>

<?php
if (!$sujets) {
    echo "<p>Aucun sujet n'a été trouver</p>";
} else {
    foreach($sujets as $sujet ){
        ?>
        <p><?=$sujet->getTitle()?></p>
        <?php
    }
}



  
