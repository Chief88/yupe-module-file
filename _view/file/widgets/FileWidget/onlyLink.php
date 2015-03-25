<?php
$class = isset($params['htmlOptions']['class'])?$params['htmlOptions']['class']:'';
?>

<a class="<?php echo $class; ?>" href="<?php echo $file->getUrlFile(); ?>">
    <span><?php echo $file->name ?></span>
</a>