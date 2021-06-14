<div id="AdminArticleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    $del = $_POST['del'];
    $mod = $_POST['mod'];


    if (isset($del)){
        $user = $var['user'][$del];
        $address = $user['address'];
        ?>
           <!--display del-->
        <div id='del' class="user" >
            <h2>Informations personnelles de <?=  $user['username'] ?></h2>
            <div class="margin">
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
            <div id='userAddress' class='margin'>
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
                    <div class="formDisplay">
                        <div class="label">
                            <button><a href="/index.php?ctrl=userAdmin" title="adminReturn">Retour  au panneau d'administration</a></button>
                        </div>
                        <div class="input">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <input type="hidden" name="addressBookId" value="<?= $user['address_book_id'] ?>">
                            <input type="submit" class="submit" value="Supprimer cet Utilisateur?">
                        </div>
                    </div>
                </form>

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
            <!--display mod-->
        <div class="form" id="userMod">
            <div id="userFormMod">
                <h2>utilisateur : <?= $user['username'] ?></h2>
                <form id="userModify" action="/index.php?ctrl=form&action=userModify" method="post" class="panel">
                    <div class="formDisplay">
                        <div class="label" id="userFormModLabel">
                            <label for="nameModify" >Prénom </label>
                            <label for="surnameModify" >Nom </label>
                            <label for="mailModify" >Email </label>
                            <label for="phoneModify" >Téléphone </label>
                            <label for="licenceModify" >Licence </label>
                            <label for="numModify" >Numéro </label>
                            <label for="street2Modify" >bis</label>
                            <label for="streetModify" >Rue</label>
                            <label for="zipModify" >Code postal </label>
                            <label for="cityModify" >Ville </label>
                            <label for="countryModify" >Pays </label>
                            <label for="addModify" >Complément (étage,...) </label>
                            <?php
                            if ($_SESSION['user']['role']['id'] === 4){
                                ?>
                                <label for="roleId">Role de l'utilisateur</label>
                                <?php
                            }
                            ?>
                            <button><a href="/index.php?ctrl=resetPass&id=<?= $user['id'] ?>" title="resetPassword">Reset de password</a></button>
                        </div>
                        <div class="input">
                            <input id="nameModify" name="name"  value="<?= $user['name'] ?>" type="text">
                            <input id="surnameModify" name="surname"  value="<?= $user['surname'] ?>" type="text">
                            <input id="mailModify" name="mail"  value="<?= $user["mail"] ?>" type="email">
                            <input id="phoneModify" name="phone"  value="0<?= $user["phone"] ?>" type="tel">
                            <input id="licenceModify" name="licence"  value="<?= $user["licence"] ?>" type="text" >
                            <input id="numModify" name="num"  value="<?= $address['num'] ?>" type="text">
                            <input id="street2Modify" name="street2"  value="<?= $street2 ?>" type="text">
                            <input id="streetModify" name="street"  value="<?= $street ?>" type="text">
                            <input id="zipModify" name="zip"  value="<?= $address["zip_code"] ?>" type="text">
                            <input id="cityModify" name="city"  value="<?= $address["city"] ?>" type="text">
                            <input id="countryModify" name="country"  value="<?= $address["country"] ?>" type="text" >
                            <input id="addModify" name="add"  value="<?= $address["add"] ?>" type="text" >
                            <?php
                            if ($_SESSION['user']['role']['id'] === 4){
                                $role = $var['role'];
                                ?>
                                <select name="role" id="roleId">
                                    <?php
                                    foreach ($role as $r){
                                        ?>
                                        <option value="<?= $r['id']?>"><?= $r['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                            <input type="hidden" name="userId" value="<?= $user["id"] ?>">
                            <input type="hidden" name="addressBookId" value="<?= $user['address_book_id'] ?>">
                            <input type="hidden" name="oldAddressId" value="<?= $address["id"] ?>">

                            <input type="submit" class="submit" id="modifysubmit"  value="Enregistrer les modifications">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    else {
        ?>

            <!--display action button -->
        <div id='article' class='display form'>
            <div id="addButton">
                <button class="button" value="add">Ajout d'un utilisateur</button>
                <button class="button" value="del">Supprimer un utilisateur</button>
                <button class="button" value="mod">Modifier un utilisateur</button>
            </div>




            <!-- add user panel-->
            <div id="add" class="articleSelect">
                <div id="userFormAdd">
                    <h2>Ajouter un utilisateur</h2>
                    <form id="userAdd" action="/index.php?ctrl=form&action=userAdd" method="post" class="panel">
                        <div class="formDisplay">
                            <div class="label" id="userFormAddLabel">
                                <label for="name" >Prénom </label>
                                <label for="surname" >Nom </label>
                                <label for="mail" >Email </label>
                                <label for="phone" >Téléphone </label>
                                <label for="licence" >Licence </label>
                                <label for="num" >Adresse : n° </label>
                                <label for="street2" >bis</label>
                                <label for="street" >Rue</label>
                                <label for="zip" >Code postal </label>
                                <label for="city" >Ville </label>
                                <label for="country" >Pays </label>
                                <label for="add" >Complément (étage,...) </label>
                                <?php
                                if ($_SESSION['user']['role']['id'] === 4){
                                    ?>
                                    <label for="roleId">Role de l'utilisateur</label>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="input">
                                <input id="name" name="name"   type="text">
                                <input id="surname" name="surname"   type="text">
                                <input id="mail" name="mail"   type="email">
                                <input id="phone" name="phone"   type="tel">
                                <input id="licence" name="licence"   type="text" >
                                <input id="num" name="num"   type="text">
                                <input id="street2" name="street2"   type="text">
                                <input id="street" name="street"  type="text">
                                <input id="zip" name="zip"   type="text">
                                <input id="city" name="city"   type="text">
                                <input id="country" name="country"  type="text" >
                                <input id="add" name="add"  type="text" >
                                <?php
                                if ($_SESSION['user']['role']['id'] === 4){
                                    $role = $var['role'];
                                    ?>
                                    <select name="role" id="roleId">
                                        <?php
                                        foreach ($role as $r){
                                            ?>
                                            <option value="<?= $r['id']?>"><?= $r['name']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                                <input type="hidden" name="userId" value="<?= $user["id"] ?>">
                                <input type="hidden" name="addressBookId" value="<?= $user['address_book_id'] ?>">
                                <input type="hidden" name="oldAddressId" value="<?= $address["id"] ?>">

                                <input type="submit" class="submit" id="modifysubmit"  value="Enregistrer les modifications">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- select a user -->
            <div id="select" class="articleSelect form">
                <div>
                    <h2 id="title"></h2>
                    <form id="formSelect" action="/index.php?ctrl=userAdmin" method="post" class="form">
                        <div class="formDisplay">
                            <div class="label">
                                <label for="articleSelect" >Titre </label>
                            </div>
                            <div class="input">
                                <select name="" id="articleSelect">
                                    <?php
                                    foreach ($var['user'] as $key => $item){

                                        ?>
                                        <option value="<?= $key ?>"><?= $key ?> - <?= $item['username'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" id="selectSubmit"  value="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--display error-->
            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
            <!--display add return-->
            <div>
                <?php

               if (isset($_SESSION['add']['username'])){
                   echo "<p id='identity'>identifiant :" . $_SESSION['add']['username'] ." : pass:" . $_SESSION['add']['pass']."</p>";
                   $_SESSION['add'] = [];
               }

               ?>
            </div>
        </div>
    <?php } ?>
</div>
