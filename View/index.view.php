<div id="articleDisplay" class="panel">
    <?php

    use Model\Utility\Utility;

    if (!is_null($var['article']['image']) && $var['article']['image'] !== ""){
           echo "<div id='articleImage'><img src='/assets/img/article/". $var['article']['image'] ."' alt='". $var['article']['title'] ."'></div>";
    }
    echo "<h1>" . $var['article']['title'] . "</h1>";
    $date = new DateTime();
    $date->setTimestamp(intval($var['article']['date']));
    echo "<p class='date'>publié le " . $date->format('d/m/Y')  . "</p>";
    echo "<p class='content'>" . Utility::addMaj($var['article']['content']) . "</p>";


    ?>

</div>

