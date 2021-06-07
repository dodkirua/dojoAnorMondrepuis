<div id="articleDisplay" class="panel">

    <?php

    use Model\Manager\ArticleManager;
    use Model\Utility\Utility;



    $articles = ArticleManager::getAll(false);

    \dev\Dev::pre2($articles[0]);
   /* foreach ($var['article'] as $article){
        echo "<div id='article' " . $article['id'] ." >";
        if (!is_null($article['image'])){
            echo "<div id='articleImage'></div>";
        }
        echo "<h1>" . $article['title'] . "</h1>";
        $date = new DateTime();
        $date->setTimestamp(intval($article['date']));
        echo "<p class='date'>publié le " . $date->format('d/m/Y')  . "</p>";
        echo "<p class='content'>" . Utility::addMaj($article['content']) . "</p>";
        echo "</div>";
    }*/


    ?>

</div>
