<div id="menu">
    <div id="menuLogo"></div>
    <div id="classic">
        <?php
        if (isset($_SESSION['user']) && !is_null($_SESSION['user'])){
            echo "<div id='account'>
            <a href='/index.php?ctrl=account' title='account'>Votre espace</a>
        </div>";
        }
        else {
            echo " <div id='connect'>
            <a href='/index.php?ctrl=connect' title='connection'>Connectez-vous</a>
        </div>";
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
