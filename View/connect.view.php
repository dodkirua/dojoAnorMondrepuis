
<div class="panel form">
    <div>
        <h2>Connection</h2>
        <form action="/index.php?ctrl=form&action=connect" method="post" class="form">
            <div class="formDisplay">
                <div class="label" id="connectLabel">
                    <label for="username">Username</label>
                    <label for="pass">PassWord</label>
                </div>
                <div class="input" id="connectInput">
                    <input type="text" name="username" id="username">
                    <input type="password" name="pass" id="pass">
                    <input type="submit" value="Valider">
                </div>
            </div>
            <div class="link" >
                <a href="/index.php?ctrl=passForgot" title="pass forgot">Mot de passe oublié?</a>
            </div>
            <?php
            if (isset($var['error'])){
                echo "<div class='error'>" .$var['error'] . "</div>";
            }
            ?>
        </form>
    </div>
</div>