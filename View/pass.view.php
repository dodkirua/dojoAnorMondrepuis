<div id="passDisplay" class="panel">
    <div id='userInformation' class='display'>
        <h2>Vos informations personnelles</h2>
        <p>Username : <?= $_SESSION['user']['username'] ?></p>
        <form action='/index.php?ctrl=form&action=passChange' method='post' id="passModify">
            <div class="formDisplay">
                 <div class="label"  id="passChgFormLabel">
                     <label for='old'>Ancien mot de passe</label>
                     <label for='pass'>Nouveau mot de passe</label>
                     <label for='passVerify'>Vérification du mot de passe</label>
                 </div>
                 <div class="input">
                     <input type='password'  name='old' id='old'>
                     <input type='password'  name='pass' id='pass'>
                     <div id='pwMsg'>
                         <span id='maj' class='colorRed'>Une majuscule</span>
                         <span id='min' class='colorRed'>Une minuscule</span>
                         <span id='char' class='colorRed'>Un caractère spéciale</span>
                         <span id='number' class='colorRed'>Un chiffre</span>
                         <span id='length' class='colorRed'>10 caractères minimum</span>
                     </div>
                     <input type='password'  name='passVerify' id='passVerify'>
                     <div id='checkVerify'></div>
                     <input type='submit'  value='Valider' class="submit">
                 </div>
             </div>
        </form>
        </div>
    <div>
        <p class="error"><?= $var['error'] ?></p>
    </div>
<?php
      //\dev\Dev::pre($_SESSION);
?>
</div>
