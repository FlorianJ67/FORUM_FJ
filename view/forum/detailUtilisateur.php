<?php

$utilisateur = $result["data"]['utilisateur'];
$messages = $result["data"]['messages'];
    
?>

<h1>Info sur <?=$utilisateur->getPseudo() ?></h1>

<div>
    <h2 style="text-align:center;">Dernier messages</h2>
    <div style="width: 33%; margin: 0 auto;">
        <?php 
        foreach($messages as $message) {
        ?>
            <div class="message-box">
                <div>
                    <p><?= $message->getSujet()->getTitre() ?></p>                    
                </div>
                <div>
                    <p><?= $message->getContenu() ?></p>
                    <p class="creation-date"><?= $message->getDateDeCreation() ?></p>    
                </div>

            </div>

        <?php
        }
        ?>
    </div>
</div>






  
