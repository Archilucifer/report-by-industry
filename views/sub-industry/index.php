<?php
/* @var $dataProvider SubIndustry[] */

use common\models\SubIndustry;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;

echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'class' => ActionColumn::class,
                'header' => 'View',
                'template' => '{view}',
                'options' => ['width' => '1'],
                'buttons' => [
                    'view' => static function ($url, SubIndustry $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            [
                                '/industry/view-sub',
                                'id' => $model->id
                            ]
                        );
                    },
                ],
            ]
        ],
    ]
);
?>