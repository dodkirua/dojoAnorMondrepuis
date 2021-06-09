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
    <div>
        <h2>Modification des informations</h2>
        <form id="modifyInformation" action="/index.php?ctrl=form&action=modifyInformation" method="post" class="panel">
            <div class="formDisplay">
                <div class="label">
                    <label for="nameModify" >Prénom </label>
                    <label for="surnameModify" >Nom </label>
                    <label for="mailModify" >Email </label>
                    <label for="phoneModify" >Téléphone </label>
                    <label for="licenceModify" <?= $hidden ?>>Licence </label>
                    <label for="checkModify" class="smallText">En cochant cette case vous acceptez les
                        <a href="/CGU.pdf"  title="CGU" target="_blank">conditions générales d'utilisations</a> </label>
                </div>
                <div class="input">
                    <input id="nameModify" name="name"  value="<?= $user['name'] ?>" type="text">
                    <input id="surnameModify" name="surname"  value="<?= $user['surname'] ?>" type="text">
                    <input id="mailModify" name="mail"  value="<?= $user["mail"] ?>" type="email">
                    <input id="phoneModify" name="phone"  value="0<?= $user["phone"] ?>" type="tel">
                    <input id="licenceModify" name="licence"  value="<?= $user["licence"] ?>" type="text" <?= $hidden ?>>
                    <input id="checkModify" name="check"  value="" type="checkbox" >
                    <input type="submit" id="modifysubmit" class="submit" value="Enregistrer les modifications">
                </div>
            </div>
        </form>
    </div>
    <div>
        <p class="error"><?= $var['error'] ?></p>
    </div>

</div>

