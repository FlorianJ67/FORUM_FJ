<?php

$categories = $result["data"]['categories'];
$sujets = $result["data"]['sujets'];

if (isset($result["data"]['categorieActuel'])) {
    $categorieActuel = $result["data"]['categorieActuel'];
} else if (isset($id)){
    $categorieActuel = $id;
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
        <input type="submit" value="Rechercher">
    </form> 
    
    <!-- Tableau des sujets -->
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
                // liste des sujets
                foreach($sujets as $sujet ){
                    ?>
                <tr>    
                    <td><a href="index.php?ctrl=sujet&action=sujetsThread&id=<?=$sujet->getId()?>"><?=$sujet->getTitre()?></a></td>
                    <td>toujours non enfaite</td>
                    <td><?=$sujet->getDateDeCreation()?></td>
                    <td><a href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $sujet->getUtilisateur()->getId()?>"><?=$sujet->getUtilisateur()->getPseudo() ?></a></td>
                </tr>
                    <?php
                }
            }?>
            
        </tbody>
    </table>
    <?php
    // formulaire d'ajout de sujet si une catégorie est selectionner (via le $categorieActuel(méthode post au dessus du tableau) ou bien l'id de l'url)
    if (isset($categorieActuel) || isset($id)) {
    ?>
    <form action="index.php?ctrl=sujet&action=nouveauSujet&id=<?= $categorieActuel ?>" method="post">
        <div>
            <label for="titreSujet">Titre: </label>
            <input type="text" name="titreSujet">
        </div>
        <div>
            <label for="textMessage">Message: </label>
            <textarea name="textMessage" rows= "3"></textarea>
        </div>
        <div>
            <input type="submit" name="submit">
        </div>
    </form>
    <?php
    }
    ?>
</div>






  
