<ul class="select-icon">
    <?php foreach($namesIcons as $nameIcon): ?>
        <li>
            <i class='fa fa-<?php print $nameIcon; ?>'
               nameIcon="<?php print $nameIcon; ?>"
               nameFieldForInsert="<?php print $nameField ?>"></i>
        </li>
    <?php endforeach; ?>
</ul>