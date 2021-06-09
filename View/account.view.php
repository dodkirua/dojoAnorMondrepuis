<div id="accountDisplay" class="panel">
    <?php
    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    ?>

    <div id='userInformation' class='display information'>
        <div>
             <h2>Vos informations personnelles</h2>
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
        <div class="center">
            <form action='/index.php?ctrl=form&action=pass' method='post'>
                <input type='submit' value='Changer le mot de passe' class="margin">
            </form>

            <form action='/index.php?ctrl=form&action=information' method='post'>
                <input type='submit' value='Modifier mes informations' class="margin">
            </form>
        </div>



    </div>
    <?php
    if (isset($user['address'])){
        $address = $user['address'];
        ?>

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
            <div class="center">
                <form action='/index.php?ctrl=form&action=address' method='post'>
                    <input type='submit' value="Modifier l'adresse" class="margin">
                </form>
            </div>
        </div>
    <?php
    } ?>

    <?php
    // parent display
    if (isset($parent)){
        ?>
        <div id='parentInformation' class='margin'>
            <h2>Les personnes à contacter</h2>
        <?php
        foreach ($parent as $key => $item){
            ?>
            <div class="information">
                <div>
                <h2>Personne n° <?=  $key ?></h2>
                <p>Username : <?=  $item['username'] ?></p>

                <?php
                if (!is_null($item['name']) && $item['name'] !== ""){?>
                    <p>Nom : <?=  $item['name'] ?></p><?php
                }
                if (!is_null($item['surname']) && $item['surname'] !== "") {?>
                    <p>Prénom : <?=  $item['surname'] ?></p><?php
                }
                if (!is_null($item['mail']) && $item['mail'] !== "") {?>
                    <p>Mail : <?=  $item['mail'] ?></p><?php
                }
                if (!is_null($item['phone']) && $item['phone'] !== "") {?>
                    <p>Téléphone : 0<?=  $item['phone'] ?></p><?php
                }
                if (!is_null($item['licence']) && $item['licence'] !== "") {?>
                    <p>Votre numéro de licence : <?=  $item['licence'] ?></p><?php
                }
                echo "</div>";

                    if (isset($item['address'])){
                        $address = $item['address'][0];
                        ?>

                        <div id='parentAddress<?=  $key ?>' class='margin'>
                            <h3>Adresse</h3>
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
                    <?php
                    }
            echo "</div>";
        }
        echo "</div>";
    }
    // Child display
    if (isset($child)){
        ?>
        <div id='childInformation' class='margin'>
            <h2>Personne contact pour : </h2>
        <?php

        foreach ($child as $key => $item){?>
            <div class="information">
                <div>
                    <h2>Personne n° <?=  $key ?></h2>
                    <p>Username : <?=  $item['username'] ?></p>

                    <?php
                    if (!is_null($item['name']) && $item['name'] !== ""){?>
                        <p>Nom : <?=  $item['name'] ?></p><?php
                    }
                    if (!is_null($item['surname']) && $item['surname'] !== "") {?>
                        <p>Prénom : <?=  $item['surname'] ?></p><?php
                    }
                    if (!is_null($item['mail']) && $item['mail'] !== "") {?>
                        <p>Mail : <?=  $item['mail'] ?></p><?php
                    }
                    if (!is_null($item['phone']) && $item['phone'] !== "") {?>
                        <p>Téléphone : 0<?=  $item['phone'] ?></p><?php
                    }
                    if (!is_null($item['licence']) && $item['licence'] !== "") {?>
                        <p>Votre numéro de licence : <?=  $item['licence'] ?></p><?php
                    }
                    echo "</div>";

                    if (isset($item['address'])){
                        $address = $item['address'][0];
                        ?>

                        <div id='childAddress<?=  $key ?>' class='margin'>
                            <h3>Adresse</h3>
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
                        <?php
                    }
                    echo "</div>";}
        echo "</div>";
    }
    ?>
    <?php
?>

</div>
