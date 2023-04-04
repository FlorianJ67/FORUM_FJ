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
                <!-- contenu du message -->
                <p class="contenu-message"><?=$message->getContenu()?></p>

            <?php
                // boutton modifier & supprimer le message
                if($currentUser) {
                    if(($currentUser->getRole() == "admin" || $currentUser->getRole() == "moderateur") || ($currentUser->getId() == $message->getUtilisateur()->getId())) {
                ?>
                        <div class="lockOrSupp-sujet">
                            <a href="index.php?ctrl=sujet&action=modifierMessage&id=<?= $message->getId()?>" class="modifyMessage" title="Modifier le message"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="index.php?ctrl=sujet&action=supprimerMessage&id=<?= $message->getId()?>" class="deleteMessage" title="Supprimer le message"><i class="fa-solid fa-trash deleteForum-btn"></i></a>
                        </div>
                <?php
                    }
                }
                ?>

                <!-- date du message -->
                <p class="creation-date"><?=$message->getDateDeCreation()?></p>

            </div>

        </div>
        <?php
        }
    }
    // on vérifie si le sujet est blocké et si il y a un utilisateur connecté
    if ($sujet->getEtat() && $currentUser && $currentUser->getBan() == !1) {
        ?>
        <!-- formulaire nouveau sujet + 1er message du nouveau sujet -->
        <form action="index.php?ctrl=sujet&action=nouveauMessage&id=<?=$id?>" class="reply" method="post">
            <div>
                <label for="textMessage">Envoyer un message:</label> 
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






  
