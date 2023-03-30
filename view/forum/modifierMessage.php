<?php

$message = $result["data"]['message'];
    
if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];
} else {
    $currentUser = null;
}
?>

<h1>messages de <?= $message->getUtilisateur()->getPseudo() ?> du sujet <?= $message->getSujet()->getTitre() ?></h1>

<div id="forumList">
    
    <div class="message-box">

        <!-- pseudo de l'utilisateur + lien detailUtilisateur -->
        <div>
            <a class="user-message" href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $message->getUtilisateur()->getId()?>"><?=$message->getUtilisateur()->getPseudo()?></a>
        </div>
        <div>
            <!-- contenu du message -->
            <p class="contenu-message"><?=$message->getContenu()?></p>
        <?php
            // boutton supprimer le message
            if($currentUser) {
                if(($currentUser->getRole() === ("admin" || "moderateur")) || ($currentUser->getId() === $message->getSujet()->getUtilisateur()->getId())) {
        ?>
                <a href="index.php?ctrl=sujet&action=supprimerMessage&id=<?= $message->getId()?>" class="deleteMessage"><i class="fa-solid fa-trash deleteForum-btn"></i></a>
        <?php
            }}
        ?>

            <!-- date du message -->
            <p class="creation-date"><?=$message->getDateDeCreation()?></p>

        </div>

    </div>
<?php
if($currentUser) {
    // on vérifie si le message appartient à l'utilisateur connecté ou si il sagit d'un admin
    if (($message->getUtilisateur()->getId() === $currentUser->getId()) || $currentUser->getRole() === ("admin" || "moderateur")) {
        ?>
        <!-- formulaire modifier message du -->
        <form action="index.php?ctrl=sujet&action=modifierMessage&id=<?=$id?>" method="post">
            <textarea name="textMessage" rows= "3"><?= $message->getContenu() ?></textarea>
            <input type="submit" name="submit" value="Modifier">
        </form>
<?php
    }
} 
?>            
</div>






  
