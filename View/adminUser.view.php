<div id="AdminArticleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    $del = $_POST['del'];
    $mod = $_POST['mod'];


    //\dev\Dev::pre($_POST);

    if (isset($del)){
        $user = $var['user'][$del];
        $address = $user['address'];
        ?>
        <div id='del' >
            <div>
                <h2>Informations personnelles de <?=  $user['username'] ?></h2>
                <p>Username : <?=  $user['username'] ?></p>
                <?php
                if (!is_null($user['name']) && $user['name'] !== ""){?>
                    <p>Nom : <?=  $user['name'] ?></p><?php
                }
                if (!is_null($user['surname']) && $user['surname'] !== "") {?>
                    <p>Prénom : <?=  $user['surname'] ?></p><?php
                }
                if (!is_null($user['mail']) && $user['mail'] !== "") {?>
                    <p>Mail : <?=  $user['mail'] ?></p><?php
                }
                if (!is_null($user['phone']) && $user['phone'] !== "") {?>
                    <p>Téléphone : 0<?=  $user['phone'] ?></p><?php
                }
                if (!is_null($user['licence']) && $user['licence'] !== "") {?>
                    <p>Votre numéro de licence : <?=  $user['licence'] ?></p><?php
                }

                ?>
            </div>
            <div id='userAddress' class='margin information'>
                <div>
                    <h2>Adresse</h2>
                    <p>Adresse : <?= $address['num'] . " " . $address['street'] ?></p>
                    <p>Code Postale : <?= $address['zip_code'] ?></p>
                    <p>Ville : <?= $address['city'] ?></p>
                    <p>Pays : <?= $address['country'] ?></p>

                    <?php
                    if  (!is_null($address['add']) && $address['add'] !== "" ){
                        ?>
                        <p>Information complémentaire: <?= $address['add'] ?></p>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <div>
                <form id="modifyAddress" action="/index.php?ctrl=form&action=delUser" method="post" class="panel">
                    <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                    <input type="hidden" name="addressBookId" value="<?= $user['address_book_id'] ?>">
                    <input type="submit" value="Voulez-vous vraiment supprimer cet Utilisateur?">
                </form>
                <button><a href="/index.php?ctrl=userAdmin" title="adminReturn">Retour  au panneau d'administration</a></button>
            </div>

        </div>
        <?php
    }

    elseif (isset($mod)){
        $user = $var['user'][$mod];
        $address = $user['address'];
        $street = explode(" ",$address['street']);
        $street2 = $street[0];
        unset($street[0]);
        $street = implode(" ",$street);
        ?>
        <div id="modArticle" >
            <form id="userModify" action="/index.php?ctrl=form&action=userModify" method="post" class="panel">
                <h2>utilisateur : <?= $user['username'] ?></h2>
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
                    <label for="licenceModify" >Licence </label>
                    <input id="licenceModify" name="licence"  value="<?= $user["licence"] ?>" type="text" >
                </div>
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
                <?php 
                if ($_SESSION['user']['role']['id'] === 4){
                    $role = $var['role'];
                    ?>
                <div class="label">
                    <label for="roleId">Role de l'utilisateur</label>
                    <select name="role" id="roleId">

                    <?php
                    foreach ($role as $r){
                        ?>
                        <option value="<?= $r['id']?>"><?= $r['name']?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <?php
                }
                ?>
                <input type="hidden" name="userId" value="<?= $user["id"] ?>">
                <input type="hidden" name="addressBookId" value="<?= $user['address_book_id'] ?>">
                <input type="hidden" name="oldAddressId" value="<?= $address["id"] ?>">

                <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
            </form>
        </div>
        <?php
    }

    else {
        ?>

        <div id='article' class='display information'>
            <div id="addButton">
                <button class="button" value="add">Ajout d'un utilisateur</button>
                <button class="button" value="del">Supprimer un utilisateur</button>
                <button class="button" value="mod">Modifier un utilisateur</button>
            </div>


            <!-- select a user -->
            <div id="select" class="articleSelect">
                <h2 id="titleArticle"></h2>
                <form id="formSelect" action="/index.php?ctrl=userAdmin" method="post" class="panel">
                    <div class="label">
                        <label for="articleSelect" >Titre </label>
                        <select name="" id="articleSelect">
                            <?php
                            foreach ($var['user'] as $key => $item){

                                ?>
                                <option value="<?= $key ?>"><?= $key ?> - <?= $item['username'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" id="selectSubmit"  value="">
                </form>
            </div>

            <!-- add user panel-->
            <div id="add" class="articleSelect">
                <form id="userModify" action="/index.php?ctrl=form&action=userAdd" method="post" class="panel">
                    <h2>Ajout d'un utilisateur</h2>
                    <div class="label">
                        <label for="nameModify" >Prénom </label>
                        <input id="nameModify" name="name"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="surnameModify" >Nom </label>
                        <input id="surnameModify" name="surname"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="mailModify" >Email </label>
                        <input id="mailModify" name="mail"  value="" type="email">
                    </div >
                    <div class="label">
                        <label for="phoneModify" >Téléphone </label>
                        <input id="phoneModify" name="phone"  value="" type="tel">
                    </div>
                    <div class="label">
                        <label for="licenceModify" >Licence </label>
                        <input id="licenceModify" name="licence"  value="" type="text" >
                    </div>
                    <div class="label">
                        <label for="numModify" >Numéro </label>
                        <input id="numModify" name="num"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="street2Modify" >bis</label>
                        <input id="street2Modify" name="street2"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="streetModify" >Rue</label>
                        <input id="streetModify" name="street"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="zipModify" >Code postal </label>
                        <input id="zipModify" name="zip"  value="" type="text">
                    </div >
                    <div class="label">
                        <label for="cityModify" >Ville </label>
                        <input id="cityModify" name="city"  value="" type="text">
                    </div>
                    <div class="label">
                        <label for="countryModify" >Pays </label>
                        <input id="countryModify" name="country"  value="" type="text" >
                    </div>
                    <div class="label">
                        <label for="addModify" >Complément (étage,...) </label>
                        <input id="addModify" name="add"  value="" type="text" >
                    </div>
                    <?php
                    if ($_SESSION['user']['role']['id'] === 4){
                        $role = $var['role'];
                        ?>
                        <div class="label">
                            <label for="roleId">Role de l'utilisateur</label>
                            <select name="role" id="roleId">

                                <?php
                                foreach ($role as $r){
                                    ?>
                                    <option value="<?= $r['id']?>"><?= $r['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                    ?>

                    <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
                </form>

            </div>


            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
