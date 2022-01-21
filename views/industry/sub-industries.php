<?php
/* @var $dataProvider SubIndustry[] */

use kartik\grid\GridView;

echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
        ],
    ]
);
?>