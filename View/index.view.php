<div id="articleDisplay" class="panel">
    <?php
    var_dump($vars);
        if (!is_null($vars['article']['image'])){
           echo "<div id='articleImage'></div>";
        }
        echo "<h1>" . $vars['article']['title'] . "</h1>";
        $date = new DateTime();
        $date->setTimestamp(intval($vars['article']['date']));
        echo "<p class='date'>publié le " . $date->format('d/m/Y')  . "</p>";
        echo "<p>" . $vars['article']['title'] . "</p>";
    ?>



</div>

