<?php

use common\models\Industry;
use kartik\grid\ExpandRowColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'Industry';
$this->params['breadcrumbs'][] = $this->title;

/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-group">
        <?= Html::a(
            'Create',
            ['/merchants/create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>

<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'floatHeaderOptions' => [
            'position' => 'absolute',
            'top' => 50
        ],
        'containerOptions' => ['style' => 'white-space: nowrap;'],
        'toolbar' => false,
        'panel' => ['type' => GridView::TYPE_PRIMARY],
        'columns' => [
            'id',
            'attribute' => 'name',
        [
            'class' => ExpandRowColumn::class,
            'value' => static function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => static function (Industry $model) {
                return Yii::$app->controller->renderPartial(
                    'sub-industries',
                    [
                        'dataProvider' => new ActiveDataProvider(
                            [
                                'query' => $model->getSubIndustries(),
                            ]
                        )
                    ]
                );
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
        ],
    ],
    ]
)
?>
