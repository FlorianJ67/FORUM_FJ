<?php

$categories = $result["data"]['categories'];

if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];
} else {
    $currentUser = null;
}
    
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
<?php
if (isset($currentUser)) {
    if($currentUser->getRole() == "admin"){
?>
        <!-- formulaire nouveau sujet + 1er message du nouveau sujet -->
        <form action="index.php?ctrl=categorie&action=nouvelleCategorie" class="reply" method="post">
            <div>
                <label for="nomCategorie">Ajouter une catégorie:</label> 
                <input name="nomCategorie" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Ajouter">
            </div>
        </form>
<?php
    }
}
?>




  
