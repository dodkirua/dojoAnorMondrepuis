
<div class="chat">
    <h1>enregistrez vous</h1>
    <form action="/index.php?ctrl=form&action=registration" id="registration" method="post">
    <div>
        <div class="form">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form">
            <label for="pass">PassWord</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div id="check">
            <span id="maj" class="colorRed">Une majuscule</span>
            <span id="min" class="colorRed">Une minuscule</span>
            <span id="char" class="colorRed">Un caractère spéciale</span>
            <span id="number" class="colorRed">Un chiffre</span>
            <span id="length" class="colorRed">10 caractères minimum</span>
        </div>

        <div class="form">
            <label for="passVerify">PassWord Verification</label>
            <input type="password" name="passVerify" id="passVerify" required>
        </div>
        <div id="checkVerify"></div>
        <div class="submit">
            <input type="submit" value="Valider" class="submit">
        </div>


    </div>


    </form>


</div>
<script src="/assets/js/connect.js"></script>
<script src="/assets/js/connectVerification.js" type="module"></script>