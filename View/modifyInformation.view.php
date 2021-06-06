<?php
$user = $_SESSION['user'];
if ($user['role']['id'] === 1){
    $hidden = "hidden";
}
else {
    $hidden = "";
}
?>
<div id="contactInformationModify" class="panel center">
    <form id="modifyInformation" action="/index.php?ctrl=form&action=modifyInformation" method="post" class="panel">
        <div class="label">
            <label for="nameModify" >Prénom </label>
            <input id="nameModify" name="name"  value="<?= $user['name'] ?>" type="text">
        </div>
        <div class="label">
            <label for="surnameModify" >Nom </label>
            <input id="surnameModify" name="surname"  value="<?= $user['surname'] ?>" type="text">
        </div>
        <div class="label">
            <label for="mailModify" >Email </label>
            <input id="mailModify" name="mail"  value="<?= $user["mail"] ?>" type="email">
        </div >
        <div class="label">
            <label for="phoneModify" >Téléphone </label>
            <input id="phoneModify" name="phone"  value="0<?= $user["phone"] ?>" type="tel">
        </div>
        <div class="label">
            <label for="licenceModify" <?= $hidden ?>>Licence </label>
            <input id="licenceModify" name="licence"  value="<?= $user["licence"] ?>" type="text" <?= $hidden ?>>
        </div>
        <div class="label">
            <label for="checkModify" class="smallText">En cochant cette case vous acceptez les
                 <a href="/CGU.pdf"  title="CGU" target="_blank">conditions générales d'utilisations</a> </label>
            <input id="checkModify" name="check"  value="" type="checkbox" >
        </div>

        <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
    </form>
    <div>
        <p class="error"><?= $var['error'] ?></p>
    </div>
    <?php  //\dev\Dev::pre($user); ?>
</div>

