<?php

$messages = $result["data"]['messages'];

    
?>

<h1>liste des sujets</h1>

<div id="forumList">
    

    <?php
    if (!$messages) {
        echo "<p>Aucun message n'a été trouver</p>";
    } else {
        foreach($messages as $message ){
            ?>
        <div class="message-box">
            <div>
                <a class="user-message" href="index.php?ctrl=utilisateur&action=detailUtilisateur&id=<?= $message->getUtilisateur()->getId()?>"><?=$message->getUtilisateur()->getPseudo()?></a>
            </div>
            <div>
                <p><?=$message->getContenu()?></p>
                <p class="creation-date"><?=$message->getDateDeCreation()?></p>
            </div>

        </div>
            <?php
        }
    }?>

    <form action="index.php?ctrl=sujet&action=nouveauMessage&id=<?=$id?>" method="post">
            <textarea name="textMessage" rows= "3"></textarea>
            <input type="submit" name="submit">
    </form>
            
        </tbody>
    </table>

</div>






  
