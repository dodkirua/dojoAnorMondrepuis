<div id="AdminArticleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    $del = $_POST['del'];
    $mod = $_POST['mod'];

    //\dev\Dev::pre($user);

    // display for delete
    if (isset($del)){
        $article = $var['article'][$del];
        ?>
        <div id='delArticle' >

            <?php


            if (!is_null($article['image'])){
                if (!is_null($article['image'])){?>
                    <div id='articleImage'><img src='/assets/img/article/<?= $article['image']?>' alt='<?= $article['title'] ?>'></div>
                    <?php
                }
            }
            ?>
            <h1><?= $article['title'] ?></h1>
            <?php
            $date = new DateTime();
            $date->setTimestamp(intval($article['date']));
            ?>
            <p class='date'>publié le <?= $date->format('d/m/Y')?></p>
            <p class='content'><?= Utility::addMaj($article['content'])?></p>

            <form id="modifyAddress" action="/index.php?ctrl=form&action=delArticle" method="post" class="panel">
                <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
                <input type="submit" value="Voulez-vous vraiment supprimer cet article ?">
            </form>
            <button><a href="/index.php?ctrl=articleAdmin" title="adminReturn">Retour  au panneau d'administration</a></button>

        </div>
    <?php
    }
    //display for mod
    elseif (isset($mod)){
        $article = $var['article'][$mod];
        ?>
        <div id="modArticle" >
                <h2>Modification d'un article</h2>
                <form id="modifyAddress" action="/index.php?ctrl=form&action=modArticle" method="post" class="panel">
                    <div class="label">
                        <label for="title" >Titre </label>
                        <input id="title" name="title"  type="text" value="<?= $article['title'] ?>">
                    </div>
                    <div class="label">
                        <label for="content" >Contenu</label>
                        <textarea name="content" id="content" cols="100" rows="25"><?= $article['content'] ?></textarea>
                    </div>
                    <div class="label">
                        <label for="image" >Image (max 5mo)</label>
                        <input id="image" name="image"  type="file">
                    </div>
                    <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
                    <input type="submit" id="modifysubmit"  value="Enregistrer les modifications">
                </form>

            </div>
        <?php
    }

    else {
        // display action button
        ?>
        <div id='article' class='display information'>
            <div id="addButton">
                <button class="button" value="addArticle">Ajout d'un article</button>
                <button class="button" value="delArticle">Supprimer un article</button>
                <button class="button" value="modArticle">Modifier un article</button>
            </div>
        <!--display for add-->
            <div id="addArticle" class="articleSelect">
                <h2>Ajout d'un article</h2>
                <form id="modifyAddress" action="/index.php?ctrl=form&action=addArticle" method="post" class="panel" enctype="multipart/form-data">
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

                    <input type="submit" id="modifysubmit"  value="Valider">
                </form>

            </div>
            <!--display array of article title-->
            <div id="select" class="articleSelect">
                <h2 id="titleArticle"></h2>
                <form id="formSelect" action="/index.php?ctrl=articleAdmin" method="post" class="panel">
                    <div class="label">
                        <label for="articleSelect" >Titre </label>
                        <select name="" id="articleSelect">
                            <?php
                            foreach ($var['article'] as $key => $article){

                                ?>
                                <option value="<?= $key ?>"><?= $article['title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" id="selectSubmit"  value="">
                </form>
            </div>


        <!--error display-->
            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
