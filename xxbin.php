index.php?page=<?= $chapterTitle->getId ?>
<?= $chapterTitle->getId ?>

<?php
    echo "c'est bon";
    echo "<br/>";
?>



<?php

/*        var_dump($this->args);
        echo "<br/>";
        var_dump($this->defaults);
        echo "<br/>";*/
        $defaultsArgs = array_keys($this->defaults);
        // var_dump($defaultsArgs);
        // echo "<br/>";
        foreach($this->args as $key => &$value) {
            // var_dump($key);
            // echo "<br/>";
            $index = array_search($key, $defaultsArgs);
            // var_dump($index);
            // echo "<br/>";
            // $value = $this->defaults[$defaultsArgs[$index]];
          /*  var_dump($value);
            echo "<br/>";
            return;*/
            if ($index !== FALSE && $value === "") {
                $value = $this->defaults[$defaultsArgs[$index]];
                // var_dump($value);
                // echo "<br/>";
                return;
            }