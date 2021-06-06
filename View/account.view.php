<div id="AccountDisplay" class="panel">
        <?php 
        $user = $_SESSION;
        $parent = $_SESSION['parent'];
        $child = $_SESSION['child'];
        ?>

        <div id='userInformation' class='display'>
         <h2>Vos informations personnelles</h2>
        <p>Username : <?=  $user['user']['username'] ?></p>

        <?php
        if (!is_null($user['user']['name']) && $user['user']['name'] !== ""){?>
            <p>Nom : <?=  $user['user']['name'] ?></p><?php
        }
        if (!is_null($user['user']['surname']) && $user['user']['surname'] !== "") {?>
            <p>Prénom : <?=  $user['user']['surname'] ?></p><?php
        }
        if (!is_null($user['user']['mail']) && $user['user']['mail'] !== "") {?>
            <p>Mail : <?=  $user['user']['mail'] ?></p><?php
        }
        if (!is_null($user['user']['phone']) && $user['user']['phone'] !== "") {?>
            <p>Téléphone : 0<?=  $user['user']['phone'] ?></p><?php
        }
        if (!is_null($user['user']['licence']) && $user['user']['licence'] !== "") {?>
            <p>Votre numéro de licence : <?=  $user['user']['licence'] ?></p><?php
        }

        ?>
         <form action='/index.php?ctrl=form&action=pass' method='post'>
        <input type='submit' value='Changer le mot de passe'> 
        </form>

         <form action='/index.php?ctrl=form&action=modifyInformation' method='post'>
        <input type='submit' value='Modifier mes informations'> 
        </form>


        </div>
        <?php
        if (isset($user['user']['address'])){
            $address = $user['user']['address'];
            ?>

            <div id='userAddress' class='display'>
                <h2>Adresse</h2>
                <p>Adresse : <?= $address['num'] . " " . $address['street'] ?></p>
                <p>Code Postale : <?= $address['zip_code'] ?></p>
                <p>Ville : <?= $address['city'] ?></p>
                <p>Pays : <?= $address['country'] ?></p>

                <?php
                if  (!is_null($address['add'])){
                    ?>
                    <p>Information complémentaire: <?= $address['add'] ?></p>
                    <?php
                }
                ?>
            </div>
        <?php
        } ?>


        <?php
        if (isset($parent)){
            ?>
            <div id='parentInformation' class='display'>
                <h2>Les personnes à contacter</h2>
            <?php
            foreach ($parent as $key => $item){
                ?>
                <div class="information">
                    <div>
                    <h2>personne n° <?=  $key ?></h2>
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

                            <div id='userAddress' class='display'>
                                <h3>Adresse</h3>
                                <p>Adresse : <?= $address['num'] . " " . $address['street'] ?></p>
                                <p>Code Postale : <?= $address['zip_code'] ?></p>
                                <p>Ville : <?= $address['city'] ?></p>
                                <p>Pays : <?= $address['country'] ?></p>

                                <?php
                                if  (!is_null($address['add'])){
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
        if (isset($child)){
            ?>
            <div id='childInformation' class='display'>
                <h2>Personne contact pour : </h2>
            <?php

            foreach ($child as $key => $item){?>
                <div class="information">
                    <div>
                        <h2>personne n° <?=  $key ?></h2>
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

                            <div id='userAddress' class='display'>
                                <h3>Adresse</h3>
                                <p>Adresse : <?= $address['num'] . " " . $address['street'] ?></p>
                                <p>Code Postale : <?= $address['zip_code'] ?></p>
                                <p>Ville : <?= $address['city'] ?></p>
                                <p>Pays : <?= $address['country'] ?></p>

                                <?php
                                if  (!is_null($address['add'])){
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


          // \dev\Dev::pre($user);
         // \dev\Dev::pre2($user);
    ?>

</div>
