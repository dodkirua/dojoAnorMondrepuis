<div id="menu">
    <div id="menuLogo"></div>
    <div id="classic">

        <?php
        if (isset($_SESSION['user']) && !is_null($_SESSION['user'])){?>
        <div id='account'>
            <p>Bienvenue  <?= $_SESSION['user']['username'] ?> </p>
            <a href='/index.php' title='Home'>Accueil</a>
            <a href='/index.php?ctrl=account' title='Account'>Votre espace</a>
            <a href='/index.php?ctrl=disconnect' title='Disconnect'>Déconnexion</a>
        </div>
        <?php
        }
        else {?>
            <div id='connect'>
            <a href='/index.php?ctrl=connect' title='connection'>Connectez-vous</a>
        </div>
        <?php
        }



        ?>
    </div>
    <div id="mobile">
        <div id="iconMobile">
            <i class="fas fa-bars"></i>
        </div>
        <div id="menuMobile">
        
        </div>
    </div>
</div>
