<?php
    $style = ($style == 'ordered') ? 'ol' : 'ul';
?>

<<?= $style ?>>
    <?php foreach ($items as $item): ?>
        <li>
            <?= $item ?>
        </li>
    <?php endforeach; ?>
</<?= $style ?>>