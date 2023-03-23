<?php

if(isset($result["data"]['error'])) {
    $error = $result["data"]['error'];
} else {
    $error = null;
}
    
?>


<div>

    <form action="index.php?ctrl=security&action=ajoutUtilisateur" method="post">
        <div>
            <label for="pseudo">Pseudo *</label>
            <input type="text" name="pseudo">      
        </div>
        <div>
            <label for="mail">Mail *</label>
            <input type="mail" name="mail">
            </div>
        <div>
            <label for="mdp1">Mot de passe *</label>
            <input type="password" name="mdp1">
            </div>
        <div>
            <label for="mdp2">Vérifier le mot de passe *</label>
            <input type="password" name="mdp2">
            </div>
        <div>
            <input type="submit" name="submit">
        </div>
    </form>

    <?php 
    if($error) {
    ?>

    <div class='error-box'>
        <p><?= $error ?></p>
    </div>

    <?php 
    }
    ?>

</div>






  
