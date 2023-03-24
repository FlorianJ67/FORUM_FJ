<?php

if(isset($result["data"]['error'])) {
    $error = $result["data"]['error'];
} else {
    $error = null;
}
    
?>

<h2>Connexion</h2>
<div class="gestionnaireUtilisateur">

    <form action="index.php?ctrl=security&action=connexionUtilisateur" method="post">

        <div>
            <label for="mail">Mail *</label>
            <input type="mail" name="mail" required>
        </div>
        <div>
            <label for="mdp">Mot de passe *</label>
            <input type="password" name="motDePasse" required>
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






  
