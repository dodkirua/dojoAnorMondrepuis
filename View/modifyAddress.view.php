<?php
$address = $_SESSION['user']['address'];
$street = explode(" ",$address['street']);
$street2 = $street[0];
unset($street[0]);
$street = implode(" ",$street);
?>
<div id="contactAddressModify" class="panel center">
    <div>
    <h2>Modification de l'adresse</h2>
        <form id="modifyAddress" action="/index.php?ctrl=form&action=modifyAddress" method="post" class="panel">
            <div class="formDisplay">
                <div class="label">
                    <label for="numModify" >Numéro </label>
                    <label for="street2Modify" >bis</label>
                    <label for="streetModify" >Rue</label>
                    <label for="zipModify" >Code postal </label>
                    <label for="cityModify" >Ville </label>
                    <label for="countryModify" >Pays </label>
                    <label for="addModify" >Complément (étage,...) </label>
                </div>
                <div class="input">
                    <input id="numModify" name="num"  value="<?= $address['num'] ?>" type="text">
                    <input id="street2Modify" name="street2"  value="<?= $street2 ?>" type="text">
                    <input id="streetModify" name="street"  value="<?= $street ?>" type="text">
                    <input id="zipModify" name="zip"  value="<?= $address["zip_code"] ?>" type="text">
                    <input id="cityModify" name="city"  value="<?= $address["city"] ?>" type="text">
                    <input id="countryModify" name="country"  value="<?= $address["country"] ?>" type="text" >
                    <input id="addModify" name="add"  value="<?= $address["add"] ?>" type="text" >
                    <input type="submit" id="modifysubmit"  class="submit" value="Enregistrer">
                </div>
            </div>
        </form>
    </div>
    <div>
        <p class="error"><?= $var['error'] ?></p>
    </div>
    <?php  //\dev\Dev::pre($address); ?>
</div>


