<?php

$categories = $result["data"]['categories'];
$sujets = $result["data"]['sujets'];

if (isset($result["data"]['categorieActuel'])) {
    $categorieActuel = $result["data"]['categorieActuel'];
}


?>

<h1>liste des sujets</h1>

<div id="forumList">
    <!-- Liste des genres -->
     <form action="index.php?ctrl=sujet&action=sujetsParCategorie" method="post">
        <label for="categorie">Catégorie</label>
        <select name="categorie" id="categorie">
            <option value="" selected disabled>Toutes (par date)</option>
        <?php 
            if (!$categories) {
                echo "<p>Aucune catégories n'a été trouver</p>";
            } else {
                foreach($categories as $categorie ){
                    ?>
                    <option name="<?=$categorie->getNom()?>" value="<?=$categorie->getId()?>" ><?=$categorie->getNom()?></option>                 
                    <?php
                }
            }?>
        </select>
        <input type="submit">
    </form> 
    
    <!-- Liste des sujets -->
    <table>
        <thead>
            <tr>
                <th>Sujet</th>
                <th>Dernière activité</th>
                <th>Crée le</th>
                <th>Créateur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!$sujets) {
                echo "<tr><td><p style='color: red; font-weight: bold; text-align: center'>Aucun sujet n'a été trouver</p></td></tr>";
            } else {
                foreach($sujets as $sujet ){
                    ?>
                <tr>    
                    <td><a href="index.php?ctrl=sujet&action=sujetsThread&id=<?=$sujet->getId()?>"><?=$sujet->getTitre()?></a></td>
                    <td>non</td>
                    <td><?=$sujet->getDateDeCreation()?></td>
                    <td><a href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $sujet->getUtilisateur()->getId()?>"><?=$sujet->getUtilisateur()->getPseudo() ?></a></td>
                </tr>
                    <?php
                }
            }?>
            
        </tbody>
    </table>
    <?php
    if (isset($categorieActuel)) {
    ?>
    <form action="index.php?ctrl=sujet&action=nouveauSujet&id=<?= $categorieActuel ?>" method="post">
            <input type="text" name="titreSujet">
            <textarea name="textMessage" rows= "3"></textarea>
            <input type="submit" name="submit">
    </form>
    <?php
    }
    ?>
</div>






  
