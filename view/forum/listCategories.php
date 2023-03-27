<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste des catégories</h1>

<div >

<?php 
if (!$categories) {
    echo "<p>Aucune catégorie n'a été trouver</p>";
} else {
    foreach($categories as $categorie ){
?>
        <a href="index.php?ctrl=sujet&action=sujetsParCategorie&id=<?=$categorie->getId()?>"><?=$categorie->getNom()?></a>                 
<?php
    }
}?>

</div>






  
