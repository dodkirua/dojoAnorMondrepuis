

</div>
        <div id="footer">
            <p>site créé par <a href="https://github.com/dodkirua/" target="_blank" title="github dodkirua">Pierre-Yves Bouttefeux </a>sous licence <a href="/LICENSE" target="_blank" title="licence">GNU v3.0</a></p>
        </div>
    </div>
    <?php
    if (file_exists("/assets/js/$view.js")){
        echo "<script src='/assets/js/" . $view . ".js'></script>";
    }
    else {
        echo "<script src='/assets/js/index.js'></script>";
    }
    ?>

</body>
</html>