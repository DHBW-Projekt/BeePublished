<?php foreach ($data as $entry): ?>
<li>
    <?php
    if ($entry['page_id'] != null) {
        echo "<a href=\"" . $entry['Page']['name'] . "\">";
    }
    echo $entry['name'];
    if ($entry['page_id'] != null) {
        echo "</a>";
    }
    if (array_key_exists('Children', $entry) && sizeof($entry['Children']) > 0) {
        echo '<ul class="subnav">';
        echo $this->element('menu', array('data' => $entry['Children']));
        echo "</ul>";
    }
    ?>
</li>
<?php endforeach; ?>