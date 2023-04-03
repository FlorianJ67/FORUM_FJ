<?php

ini_set('intl.default_locale', 'fr_FR');

$categories = $result["data"]['categories'];
$sujets = $result["data"]['sujets'];

// catégorie
if (isset($result["data"]['categorieActuel'])) {
    $categorieActuel = $result["data"]['categorieActuel'];
} else if (isset($id)){
    $categorieActuel = $id;
}

// utilisateur
if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];
} else {
    $currentUser = null;
}

?>

<h1>liste des sujets</h1>

<div id="forumList">
    <!-- Liste des genres -->
     <form action="index.php?ctrl=sujet&action=sujetsParCategorie" id="categorieSelector" method="post">
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
    <table id="listSujets">
        <thead>
            <tr>
                <th>Sujet</th>
                <th>Message</th>
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
                    <td><a href="index.php?ctrl=sujet&action=sujetsThread&id=<?=$sujet->getId()?>"><?=$sujet->getTitre()?></a><?php if($sujet->getEtat() == false || $sujet->getEtat() == 0){ ?> <i class="fa-solid fa-lock"></i> <?php } ?></td>
                    <td><?=$sujet->getNombreMessage()?> <i class="fa-regular fa-message"></i></td>
                    <!--      Stock la date                                                           stock la date sous un des format prédéfini format                       On enlève la chaine de charactère indésirable              -->
                    <td><?php $cal = IntlCalendar::fromDateTime($sujet->getDernierMessage(),"fr_FR"); $date = IntlDateFormatter::formatObject($cal, IntlDateFormatter::FULL); echo ucfirst(str_replace("Temps universel coordonné", "",$date))?></td>
                    <td><?php $cal = IntlCalendar::fromDateTime($sujet->getDateDeCreation(),"fr_FR"); $date = IntlDateFormatter::formatObject($cal, IntlDateFormatter::FULL); echo ucfirst(str_replace("Temps universel coordonné", "",$date))?></td>
                    <td><a href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $sujet->getUtilisateur()->getId()?>"><?=$sujet->getUtilisateur()->getPseudo() ?></a></td>
                    <?php
                    if($currentUser) {
                        if(($currentUser->getRole() == "admin") || ($currentUser->getId() == $sujet->getUtilisateur()->getId())) {
                    ?>
                            <td><a href="index.php?ctrl=sujet&action=lockSujet&id=<?=$sujet->getId()?>" title="Vérouiller le Sujet"><i class="fa-solid <?php if($sujet->getEtat() == true || $sujet->getEtat() == 1){?>fa-lock <?php }else {?>fa-lock-open<?php } ?> lockForum-btn"></i></a></td>
                            <td><a href="index.php?ctrl=sujet&action=supprimerSujet&id=<?=$sujet->getId()?>" title="Supprimer le Sujet"><i class="fa-solid fa-trash deleteForum-btn"></i></a></td>
                    <?php
                        }
                    }
                    ?>
                </tr>
            <?php
                }
            }?>
            
        </tbody>
    </table>
    <?php
    // formulaire d'ajout de sujet si une catégorie est selectionner (via le $categorieActuel(méthode post au dessus du tableau) ou bien l'id de l'url)
    if (isset($categorieActuel)) {
    ?>
    <form action="index.php?ctrl=sujet&action=nouveauSujet&id=<?= $categorieActuel ?>" class="reply" method="post">
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






  
