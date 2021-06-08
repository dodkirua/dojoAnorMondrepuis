<div id="AdminArticleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    $del = $_POST['del'];
    $mod = $_POST['mod'];

    //\dev\Dev::pre($var);

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
        ?>
        <div id="modArticle" >
            mod
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

            <div id="add" class="articleSelect">


            </div>

            <div id="select" class="articleSelect">
                <h2 id="titleArticle"></h2>
                <form id="formSelect" action="/index.php?ctrl=userAdmin" method="post" class="panel">
                    <div class="label">
                        <label for="articleSelect" >Titre </label>
                        <select name="" id="articleSelect">
                            <?php
                            foreach ($var['user'] as $key => $item){

                                ?>
                                <option value="<?= $key ?>"><?= $item['username'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" id="selectSubmit"  value="">
                </form>
            </div>



            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
