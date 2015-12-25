<?php $linkHtmlOptionsString = '';
$imageHtmlOptionsString = '';
$showImage = isset($params['showImage']) ? $params['showImage'] : true;
$showIcon = isset($params['showIcon']) ? $params['showIcon'] : true;

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

<a <?= $linkHtmlOptionsString; ?> href="<?= $file->getUrlFile(); ?>">

    <?php if( !empty($file->icon) && $showIcon ):{ ?>
        <i class='fa fa-<?= $file->icon; ?>'></i>
    <?php }else:{ ?>
        <?php if( !empty($file->image) && $showImage ):{ ?>
            <img <?= $imageHtmlOptionsString; ?> src="<?= $file->getImageUrl(); ?>" alt="<?= $file->name; ?>"/><?php }endif; ?><?php }endif; ?><?= isset($anchor) ? $anchor : $file->name ?>
</a>