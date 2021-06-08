<?php
$address = $_SESSION['user']['address'];
$street = explode(" ",$address['street']);
$street2 = $street[0];
unset($street[0]);
$street = implode(" ",$street);
?>
<div id="contactAddressModify" class="panel center">
    <h2>Modification de l'adresse</h2>
    <form id="modifyAddress" action="/index.php?ctrl=form&action=modifyAddress" method="post" class="panel">
        <div class="label">
            <label for="numModify" >Numéro </label>
            <input id="numModify" name="num"  value="<?= $address['num'] ?>" type="text">
        </div>
        <div class="label">
            <label for="street2Modify" >bis</label>
            <input id="street2Modify" name="street2"  value="<?= $street2 ?>" type="text">
        </div>
        <div class="label">
            <label for="streetModify" >Rue</label>
            <input id="streetModify" name="street"  value="<?= $street ?>" type="text">
        </div>
        <div class="label">
            <label for="zipModify" >Code postal </label>
            <input id="zipModify" name="zip"  value="<?= $address["zip_code"] ?>" type="text">
        </div >
        <div class="label">
            <label for="cityModify" >Ville </label>
            <input id="cityModify" name="city"  value="<?= $address["city"] ?>" type="text">
        </div>
        <div class="label">
            <label for="countryModify" >Pays </label>
            <input id="countryModify" name="country"  value="<?= $address["country"] ?>" type="text" >
        </div>
        <div class="label">
            <label for="addModify" >Complément (étage,...) </label>
            <input id="addModify" name="add"  value="<?= $address["add"] ?>" type="text" >
        </div>

        <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
    </form>
    <div>
        <p class="error"><?= $var['error'] ?></p>
    </div>
    <?php  //\dev\Dev::pre($address); ?>
</div>


