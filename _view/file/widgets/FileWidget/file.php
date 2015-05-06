<?php $linkHtmlOptionsString = '';
$imageHtmlOptionsString = '';
if( isset($params['linkOptions']) && !empty($params['linkOptions']) ){
    $linkOptions = $params['linkOptions'];
    $linkHtmlOptions = [];
    if( isset($linkOptions['htmlOptions']) && !empty($linkOptions['htmlOptions']) ){
        $linkHtmlOptions = $linkOptions['htmlOptions'];
    }

    foreach($linkHtmlOptions as $key => $option ){
        $linkHtmlOptionsString .= $key.'=\''.$option.'\' ';
    }

    if( isset($linkOptions['anchor']) ){
        $anchor = $linkOptions['anchor'];
    }

}

if( isset($params['imageOptions']) && !empty($params['imageOptions']) ){
    $imageOptions = $params['imageOptions'];
    $imageHtmlOptions = [];
    if( isset($imageOptions['htmlOptions']) && !empty($imageOptions['htmlOptions']) ){
        $imageHtmlOptions = $imageOptions['htmlOptions'];
    }

    foreach($imageHtmlOptions as $key => $option ){
        $imageHtmlOptionsString .= $key.'=\''.$option.'\' ';
    }

} ?>

<a <?= $linkHtmlOptionsString; ?> href="<?php echo $file->getUrlFile(); ?>">

    <?php if( !empty($file->icon) ):{ ?>
        <i class='fa fa-<?php echo $file->icon; ?>'></i>
    <?php }else:{ ?>
        <?php if( !empty($file->image) ):{ ?>
            <img <?= $imageHtmlOptionsString; ?> src="<?php echo $file->getImageUrl(); ?>" alt="<?= $file->name; ?>"/><?php }endif; ?><?php }endif; ?><?= isset($anchor) ? $anchor : $file->name ?>
</a>