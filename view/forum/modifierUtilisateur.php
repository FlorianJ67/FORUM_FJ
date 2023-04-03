<?php

$utilisateur = $result["data"]['user'];
if(App\Session::getFlash("modifyRequest")){
    $wantToModifyPassWord = true;
} else {
    $wantToModifyPassWord = null;
}

?>

<h1>Bienvenu(e) <?=$utilisateur->getPseudo() ?></h1>

<div id="forumList">
    <ul>
        <li><a href="index.php?ctrl=security&action=modifierMDP&id=<?=$utilisateur->getId()?>">Modifier votre mot de passe</a></li>
        <?php 
        if($wantToModifyPassWord){
        ?>
        <form action="index.php?ctrl=security&action=modifierMDP&id=<?=$utilisateur->getId()?>" method="post">
            <div>
                <label for="mdp">Mot de passe actuelle</label>
                <input type="password" name="mdp">
            </div>
            <div>
                <label for="newMdp">Nouveau mot de passe</label>
                <input type="password" name="newMdp">
            </div>            
            <div>
                <label for="newMdp2">Confirmé le nouveau mot de passe</label>
                <input type="password" name="newMdp2">
            </div>
            <div>
                <input type="submit" name="submit" value="Modifier Mdp">
            </div>
        </form>
        <?php
        }
        if($utilisateur->getBan() == 1) {
        ?>
        <li><a href="index.php?ctrl=utilisateur&action=demandeDeBan">Faire une demande de déBan</a></li>
        <?php
        }
        ?>
    </ul>
</div>






  
