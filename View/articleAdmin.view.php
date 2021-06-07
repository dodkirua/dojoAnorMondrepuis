<div id="AdminArticleDisplay" class="panel">
    <?php
    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    ?>

    <div id='article' class='display information'>
        <div id="addButton">
            <button>Ajout d'un article</button>
        </div>

        <div id="addArticle">
            <h2>Ajout d'un article</h2>
            <form id="modifyAddress" action="/index.php?ctrl=form&action=addArticle" method="post" class="panel">
                <div class="label">
                    <label for="title" >Titre </label>
                    <input id="title" name="title"  type="text">
                </div>
                <div class="label">
                    <label for="content" >Contenu</label>
                    <textarea name="content" id="content" cols="100" rows="25"></textarea>
                </div>
                <div class="label">
                    <label for="image" >Image (max 5mo)</label>
                    <input id="image" name="image"  type="file">
                </div>
                <div class="label">
                    <input id="user" name="user"  value="<?= $user["id"] ?>" type="hidden">
                </div >

                <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
            </form>
            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
        </div>




    </div>
</div>
