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
            <div>
                <form id="modifyAddress" action="/index.php?ctrl=form&action=delArticle" method="post" class="form">
                    <div class="formDisplay">
                        <div class="label">
                            <button><a href="/index.php?ctrl=articleAdmin" title="adminReturn">Retour  au panneau d'administration</a></button>
                        </div>
                        <div class="input">
                            <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
                            <input type="submit" class="submit" value="Supprimer cet article ?">
                        </div>
                    </div>
                </form>
            </div>


        </div>
    <?php
    }

    //display for mod
    elseif (isset($mod)){
        $article = $var['article'][$mod];
        ?>
        <div class="form">
            <div>
            <h2>Modification d'un article</h2>
                <form id="modifyAddress" action="/index.php?ctrl=form&action=modArticle" method="post" class="form">
                    <div class="formDisplay">
                        <div class="label">
                            <label for="title" >Titre </label>
                            <label for="content" >Contenu</label>
                        </div>
                        <div class="input">
                            <input id="title" name="title"  type="text" value="<?= $article['title'] ?>">
                            <textarea name="content" id="content" cols="100" rows="25"><?= $article['content'] ?></textarea>
                            <div class="image">
                                <label for="image" >Image (max 5mo)</label>
                                <input id="image" name="image"  type="file" >
                            </div>
                            <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
                            <input type="submit" id="modifysubmit"  value="Enregistrer les modifications" class="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    else {
        // display action button
        ?>
        <div id='article' class='display form'>
            <div id="addButton">
                <button class="button" value="addArticle">Ajout d'un article</button>
                <button class="button" value="delArticle">Supprimer un article</button>
                <button class="button" value="modArticle">Modifier un article</button>
            </div>

        <!--display for add-->
            <div id="addArticle" class="articleSelect">
                <div>
                <h2>Ajout d'un article</h2>
                    <form id="addform" action="/index.php?ctrl=form&action=addArticle" method="post" class="form" enctype="multipart/form-data">
                        <div class="formDisplay">
                            <div class="label">
                                <label for="title" >Titre </label>
                                <label for="content" >Contenu</label>
                            </div>
                            <div class="input">
                                <input id="title" name="title"  type="text">
                                <textarea name="content" id="content" cols="100" rows="25"></textarea>
                                <div class="image">
                                    <label for="image" >Image (max 5mo)</label>
                                    <input id="image" name="image"  type="file">
                                </div>
                                <input id="user" name="user"   value="<?= $user["id"] ?>" type="hidden">
                                <input type="submit" id="modifysubmit" class="submit" value="Valider">
                            </div >
                        </div>

                    </form>
                </div>
            </div>

            <!--display array of article title-->
            <div id="select" class="articleSelect form">
                <div>
                    <h2 id="titleArticle"></h2>
                    <form id="formSelect"  action="/index.php?ctrl=articleAdmin" method="post" class="form">
                        <div class="formDisplay">
                            <div class="label">
                                <label for="articleSelect" >Titre </label>
                            </div>
                            <div class="input">
                                <select name="" id="articleSelect">
                                    <?php
                                    foreach ($var['article'] as $key => $article){
                                        ?>
                                        <option value="<?= $key ?>"><?= $article['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit"  class="submit" id="selectSubmit"  value="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--error display-->
        <div>
            <p class="error"><?= $var['error'] ?></p>
        </div>

    <?php } ?>
</div>
