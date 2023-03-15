<?php

$topics = $result["data"]['sujets'];
    
?>

<h1>liste des sujets</h1>

<?php
foreach($sujets as $sujet ){

    ?>
    <p><?=$sujet->getTitle()?></p>
    <?php
}


  
