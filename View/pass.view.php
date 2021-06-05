<div id="AccountDisplay" class="panel">


        <div id='userInformation' class='display'>
         <h2>Vos informations personnelles</h2>
        <p>Username : <?= $_SESSION['user']['username'] ?></p>
       
         <form action='/index.php?ctrl=form&action=passChange' method='post' id="passModify">
         <label for='old'>Ancien mot de passe</label>
         <input type='password'  name='old' id='old'>
         <label for='pass'>Nouveau mot de passe</label>
         <input type='password'  name='pass' id='pass'>
         <div id='pwMsg'>
                <span id='maj' class='colorRed'>Une majuscule</span>
                <span id='min' class='colorRed'>Une minuscule</span>
                <span id='char' class='colorRed'>Un caractère spéciale</span>
                <span id='number' class='colorRed'>Un chiffre</span>
                <span id='length' class='colorRed'>10 caractères minimum</span>
            </div>
         <label for='passVerify'>Vérification du mot de passe</label>
         <input type='password'  name='passVerify' id='passVerify'>
         <div id='checkVerify'></div>
        <input type='submit' value='Valider'> 
        </form>
        </div>
<?php
    //  \dev\Dev::pre($_SESSION['user']['surname']);

?>
</div>
