<ul>
    <?php foreach ($files as $file): ?>
        <li>
            <a href="<?php echo $file->getUrlFile(); ?>">
                <?php if( !empty($file->icon) ):{ ?>
                <i class='fa fa-<?php echo $file->icon; ?>'></i>
                <?php }else:{ if( !empty($file->image) ):{ ?>
                    <img src="<?php echo $file->getImageUrl(50, 50); ?>" alt="<?php echo $file->name; ?>"/>
                <?php }endif; }endif; ?><span><?php echo $file->name ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>