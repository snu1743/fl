<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $sourcePath = '@vendor';
    public $css = [
        'almasaeed2010/adminlte/dist/css/adminlte.min.css',
    ];
    public $js = [
    ];
    public $depends = [];
}
