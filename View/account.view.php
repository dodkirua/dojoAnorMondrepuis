<div id="AccountDisplay" class="panel">
    <?php
        echo "       
        <div id='userInformation' class='display'>
         <h2>Vos informations personnelles</h2>
        <p>Username : ". $_SESSION['user']['username'] ."</p>
        ";
        if (!is_null($_SESSION['user']['name']) && $_SESSION['user']['name'] !== ""){
            echo "<p>Nom : ". $_SESSION['user']['name'] ."</p>";
        }
        if (!is_null($_SESSION['user']['surname']) && $_SESSION['user']['surname'] !== "") {
            echo "<p>Prénom : ". $_SESSION['user']['surname'] ."</p>";
        }
        if (!is_null($_SESSION['user']['mail']) && $_SESSION['user']['mail'] !== "") {
            echo "<p>Mail : ". $_SESSION['user']['mail'] ."</p>";
        }
        if (!is_null($_SESSION['user']['phone']) && $_SESSION['user']['phone'] !== "") {
            echo "<p>Téléphone : 0". $_SESSION['user']['phone'] ."</p>";
        }
        if (!is_null($_SESSION['user']['licence']) && $_SESSION['user']['licence'] !== "") {
            echo "<p>Votre numéro de licence : ". $_SESSION['user']['licence'] ."</p>";
        }

         echo " 
         <form action='/index.php?ctrl=form&action=pass' method='post'>
        <input type='submit' value='Changer le mot de passe'> 
        </form>";
        echo " 
         <form action='/index.php?ctrl=form&action=modifyInformation' method='post'>
        <input type='submit' value='Modifier mes informations'> 
        </form>";


        echo "</div>";

      //  \dev\Dev::pre($_SESSION['user']['surname']);
    ?>

</div>
