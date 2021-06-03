<div id="articleDisplay" class="panel">
    <?php
        if (!is_null($var['article']['image'])){
           echo "<div id='articleImage'></div>";
        }
        echo "<h1>" . $var['article']['title'] . "</h1>";
        $date = new DateTime();
        $date->setTimestamp(intval($var['article']['date']));
        echo "<p class='date'>publié le " . $date->format('d/m/Y')  . "</p>";
        echo "<p class='content'>" . $var['article']['title'] . "</p>";
    ?>



</div>

