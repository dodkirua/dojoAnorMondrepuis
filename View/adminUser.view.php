<div id="AdminArticleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    $user = $_SESSION['user'];
    $parent = $_SESSION['parent'];
    $child = $_SESSION['child'];
    $del = $_POST['del'];
    $mod = $_POST['mod'];

    //\dev\Dev::pre($user);

    if (isset($del)){
        $user = $var['user'][$del];
        ?>
        <div id='delArticle' >

           del
        </div>
        <?php
    }

    elseif (isset($mod)){
        $user = $var['user'][$mod];
        ?>
        <div id="modArticle" >
            mod
        </div>
        <?php
    }

    else {
        ?>

        <div id='article' class='display information'>
            <div id="addButton">
                <button class="button" value="add">Ajout d'un utilisateur</button>
                <button class="button" value="del">Supprimer un utilisateur</button>
                <button class="button" value="mod">Modifier un utilisateur</button>
            </div>

            <div id="addArticle" class="articleSelect">
               add

            </div>

            <div id="select" class="articleSelect">
                <h2 id="titleArticle"></h2>
                <form id="formSelect" action="/index.php?ctrl=articleAdmin" method="post" class="panel">
                    <div class="label">
                        <label for="articleSelect" >Titre </label>
                        <select name="" id="articleSelect">
                            <?php
                            foreach ($var['user'] as $key => $item){

                                ?>
                                <option value="<?= $key ?>"><?= $item['username'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" id="selectSubmit"  value="">
                </form>
            </div>



            <div>
                <p class="error"><?= $var['error'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
