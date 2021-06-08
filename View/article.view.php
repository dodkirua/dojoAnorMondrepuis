<div id="articleDisplay" class="panel">

    <?php

    use Model\Manager\ArticleManager;
    use Model\Utility\Utility;

    foreach ($var['article'] as $article){

    ?>
    <div id='article <?= $article['id'] ?>' class='panel' >

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

    </div>
    <?php
    }
    ?>
</div>
