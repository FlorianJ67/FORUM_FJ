<?php

$sujet = $result["data"]['sujet'];
$messages = $result["data"]['messages'];
    
if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];
} else {
    $currentUser = null;
}
?>

<h1>liste des messages du sujet <?= $sujet->getTitre() ?></h1>

<div id="forumList">
    
    <?php
    if (!$messages) {
        echo "<p>Aucun message n'a été trouver</p>";
    } else {
        // listage des messages
        foreach($messages as $message ){
            ?>
        <div class="message-box">

            <!-- pseudo de l'utilisateur + lien detailUtilisateur -->
            <div>
                <a class="user-message" href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $message->getUtilisateur()->getId()?>"><?=$message->getUtilisateur()->getPseudo()?></a>
            </div>
            <div>
            <?php
                // boutton supprimer le message
                if($currentUser) {
                    if(($currentUser->getRole() === "Admin") || ($currentUser->getId() == $message->getSujet()->getUtilisateur()->getId())) {
                ?>
                    <a href="index.php?ctrl=sujet&action=supprimerMessage&id=<?= $message->getId()?>" class="deleteMessage"><i class="fa-solid fa-trash deleteForum-btn"></i></a>
                <?php
                }}
                ?>

                <!-- contenu du message -->
                <p><?=$message->getContenu()?></p>

                <!-- date du message -->
                <p class="creation-date"><?=$message->getDateDeCreation()?></p>

            </div>

        </div>
        <?php
        }
    }
    if ($sujet->getEtat()) {
        ?>
        <!-- formulaire nouveau sujet + 1er message du nouveau sujet -->
        <form action="index.php?ctrl=sujet&action=nouveauMessage&id=<?=$id?>" method="post">
                <textarea name="textMessage" rows= "3"></textarea>
                <input type="submit" name="submit">
        </form>
    <?php
    } 
    ?>
            
</div>






  
