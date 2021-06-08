<div id="accountDisplay" class="panel">
    <?php
    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    ?>
    <div id="link" class="margin">
        <a href="/index.php?ctrl=articleAdmin">Gestion des articles</a>
        <a href="/index.php?ctrl=userAdmin">Gestion des utilisateur</a>

    </div>

</div>