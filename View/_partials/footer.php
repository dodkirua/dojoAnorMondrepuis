

</div>
        <div id="footer">
            <p>site créé par <a href="https://github.com/dodkirua/" target="_blank" title="github dodkirua">Pierre-Yves Bouttefeux </a>sous licence <a href="/LICENSE" target="_blank" title="licence">GNU v3.0</a></p>
        </div>
    </div>
    <?php
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/assets/js/" . $view . ".js")){ ?>
        <script src="/assets/js/<?= $view ?>.js" type="module"></script> <?php
    }
    else {
        echo "<script src='/assets/js/index.js' type='module'></script>";
    }
    ?>

</body>
</html>