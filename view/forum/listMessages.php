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
                        <p class="user-message"><?=$message->getUtilisateur()->getPseudo()?></p>
                    </div>
                    <div>
                        <p><?=$message->getContenu()?></p>
                        <p class="creation-date"><?=$message->getDateDeCreation()?></p>
                    </div>

                </div>
                    <?php
                }
            }?>
            
        </tbody>
    </table>

</div>






  
