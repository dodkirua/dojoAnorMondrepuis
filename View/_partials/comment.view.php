<div class="form">
    <form action="/index.php?ctrl=form&action=comment">
        <label for="comment">Votre commentaire</label>
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" id="user">
    </form>
</div>