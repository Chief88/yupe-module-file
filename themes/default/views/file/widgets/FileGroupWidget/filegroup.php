<ul>
    <?php foreach ($files as $file): { ?>
        <li>
            <a href="<?= $file->getUrlFile(); ?>">
                <?php if (!empty($file->icon)): { ?>
                    <i class='fa fa-<?= $file->icon; ?>'></i>
                <?php } else: { ?>
                    <?php if (!empty($file->image)): { ?>
                        <img src="<?= $file->getImageUrl(false, 50); ?>" alt="<?= $file->name; ?>"/>
                    <?php }endif; ?>
                <?php }endif; ?><span><?= $file->name ?></span>
            </a>
        </li>
    <?php }endforeach; ?>
</ul>