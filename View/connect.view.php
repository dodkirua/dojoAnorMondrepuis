
<div class="chat">
    <h1>Connection</h1>
    <form action="/index.php?ctrl=form&action=connect" method="post">

        <div class="form">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form">
            <label for="pass">PassWord</label>
            <input type="password" name="pass" id="pass">
        </div>
        <input type="submit" value="Valider">
        <div class="link">
            <a href="/index.php?ctrl=registration">Créer un compte</a>
            <a href="/index.php?ctrl=passforgot">Mot de passe oublié?</a>
        </div>
    </form>
</div>