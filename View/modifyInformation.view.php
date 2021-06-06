<?php
$user = $_SESSION['user'];
if ($user['role']['id'] === 1){
    $hidden = "hidden";
}
else {
    $hidden = "";
}
?>
<div id="contactInformationModify" class="display">
    <form id="modifyInformation" action="/index.php?ctrl=form&action=modifyInformation" method="post" >
        <label for="nameModify" >Prénom </label>
        <input id="nameModify" name="name"  value="<?= $user['name'] ?>" type="text">
        <label for="surnameModify" >Nom </label>
        <input id="surnameModify" name="surname"  value="<?= $user['surname'] ?>" type="text">
        <label for="mailModify" >Email </label>
        <input id="mailModify" name="email"  value="<?= $user["mail"] ?>" type="email">
        <label for="phoneModify" >Téléphone </label>
        <input id="phoneModify" name="phone"  value="0<?= $user["phone"] ?>" type="text">
        <label for="licenceModify" <?= $hidden ?>>Licence </label>
        <input id="licenceModify" name="licence"  value="<?= $user["licence"] ?>" type="text" <?= $hidden ?>>
        <label for="checkModify" >En cochant cette case j'accepte les
            <a href="/CGU.pdf" title="CGU" target="_blank">conditions générales d'utilisations</a> </label>
        <input id="checkModify" name="check"  value="" type="checkbox" >
        <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
    </form>
</div>