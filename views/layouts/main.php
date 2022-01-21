<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head() ?>
    </head>
    <body>
    <?php
    $this->beginBody() ?>

    <div class="wrap">
        <?php

        NavBar::begin(
            [
                'brandLabel' => 'Test Reports',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]
        );


        $menuItems[] = ['label' => 'Industry', 'url' => ['/industry/index']];
        $menuItems[] = ['label' => 'Enterprise', 'url' => ['/enterprise/index']];
        $menuItems[] = [
            'label' => 'Reports',
            'items' => [
                ['label' => 'SomeMonthlyReport', 'url' => ['/reports/index']],
            ]
        ];

        echo Nav::widget(
            [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]
        );
        NavBar::end();
        ?>
        <div class="container-fluid">
            <?= Breadcrumbs::widget(
                [
                    'homeLink' => false,
                    'links' => $this->params['breadcrumbs'] ?? [],
                ]
            ) ?>
            <?= $content ?>
        </div>
    </div>

    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage() ?>