<?php foreach ($data as $entry): ?>
<li id="menu_entry_<?php echo $entry['id']; ?>">
    <?php
    if ($adminMode) {
        echo "<div>";
    }
    if ($entry['page_id'] != null && !$adminMode) {
        echo "<a href=\"" . $entry['Page']['name'] . "\">";
    }
    echo $entry['name'];
    if ($entry['page_id'] != null && !$adminMode) {
        echo "</a>";
    }
    if ($adminMode) {
        echo "</div>";
    }
    if (array_key_exists('Children', $entry) && sizeof($entry['Children']) > 0) {
        echo '<ol class="subnav">';
        echo $this->element('menu', array('data' => $entry['Children'], 'adminMode' => $adminMode));
        echo "</ol>";
    }
    ?>
</li>
<?php endforeach; ?>