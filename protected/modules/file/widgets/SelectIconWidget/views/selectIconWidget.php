<ul class="select-icon img-thumbnail">
    <?php foreach($namesIcons as $nameIcon):{ ?>
        <li>
            <i class='fa fa-<?= $nameIcon; ?>'
               nameIcon="<?= $nameIcon; ?>"
               nameFieldForInsert="<?= $nameField ?>"></i>
        </li>
    <?php }endforeach; ?>
</ul>