<?php

use common\components\SubIndustryColumn;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->title = 'Enterprises';
$this->params['breadcrumbs'][] = $this->title;
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="form-group">
        <?= Html::a(
            'Create',
            ['/enterprise/create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>
<?php


echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'owner',
            [
                'attribute' => 'industry',
                'class' => SubIndustryColumn::class
            ],
            'inn',
            'phone',
            'email',
            'address',
        ],
    ]
);