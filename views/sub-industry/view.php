<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubIndustry */
/* @var $mainIndustry common\models\Industry */

$this->params['breadcrumbs'][] = 'Sub industry';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-industry-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                        'attribute' => 'main_industry',
                    'value' => static function () use ($mainIndustry) {
                        return $mainIndustry->name;
                    }
                ]
            ],
        ]
    ) ?>

</div>

