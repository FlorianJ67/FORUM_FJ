<?php

$utilisateur = $result["data"]['user'];
if(isset($result["data"]['messages'])) {
    $messages = $result["data"]['messages'];
} else {
    $messages = null;
}
    
?>

<h1>Info sur <?=$utilisateur->getPseudo() ?></h1>

<div>
    <h2 style="text-align:center;">Dernier messages</h2>
    <div style="width: 33%; margin: 0 auto;">
        <?php 
        if ($messages) {
            // liste des 5 derniers messages de l'utilisateur
            foreach($messages as $message) {
            ?>
                <div class="message-box">
                    <div>
                        <a href="index.php?ctrl=sujet&action=sujetsThread&id=<?= $message->getSujet()->getId() ?>"><?= $message->getSujet()->getTitre() ?></a>                    
                    </div>
                    <div>
                        <p><?= $message->getContenu() ?></p>
                        <p class="creation-date"><?= $message->getDateDeCreation() ?></p>    
                    </div>

                </div>

            <?php
            }
        } else {
            ?>
            <div class="message-box">
                <p>L'utilisateur n'a pas encore écrit de messages</p>
            </div>
        <?php
        }
        ?>
    </div>
</div>






  
