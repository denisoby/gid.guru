<?php
$custom_mb = new MomizatMB_MetaBox(array
(
    'id' => 'mom_slider_meta',
    'title' => __('Slides', 'framework'),
    'template' => MOM_FW . '/metaboxes/slider-meta.php',
    'types' => array('flex_slider','nivo_slider'),
    'hide_editor' => TRUE
));