<?php

use common\components\SubIndustryColumn;
use common\models\searches\MonthlyReportSearch;
use common\models\SubIndustry;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->title = 'Some Monthly Report';
$this->params['breadcrumbs'][] = $this->title;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel MonthlyReportSearch */
 ?>

<div class="chargebacks">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="form-group">
        <?= Html::a(
            'Create Monthly Report',
            ['/monthly-report/create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php
    $form = ActiveForm::begin(['method' => 'get', 'action' => null]) ?>

    <?= $form->field($searchModel, 'date_from')->widget(
        DatePicker::class,
        [
            'options' => [
                'autocomplete' => 'off'
            ],
            'pluginOptions' => [
                'orientation' => 'bottom left',
                'format' => 'yyyy-mm',
                'minViewMode' => 'months',
            ]
        ]
    ) ?>

    <?= $form->field($searchModel, 'date_to')->widget(
        DatePicker::class,
        [
            'options' => [
                'autocomplete' => 'off'
            ],
            'pluginOptions' => [
                'orientation' => 'bottom left',
                'format' => 'yyyy-mm',
                'minViewMode' => 'months',
            ]
        ]
    ) ?>

    <?= $form->field($searchModel, 'industries')->widget(
        \kartik\select2\Select2::class,
        [
            'data' => [
                'Industries' => SubIndustry::getListSubIndustriesWithIndustryId(),
                'SubIndustries' => SubIndustry::getIndustriesList()
            ],
            'options' =>
                [
                    'prompt' => 'All',
                    'multiple' => true,
                    'autocomplete' => 'off'
                ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    ) ?>

    <div class="form-group text-left">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>


    <?php
    ActiveForm::end();

    $attributes = [];

    $attributes[] = [
        'header' => 'Industry',
        /**
         * Добавляем класс колонку для человекочитаемого вывода и для красивого экспорта
         */
        'class' => SubIndustryColumn::class,
        'attribute' => 'industry',
    ];
    $attributes[] = [
        'header' => 'Total Workers',
        'attribute' => 'total_workers'
    ];
    $attributes[] = [
        'header' => 'Total Average Salary',
        'attribute' => 'total_average_salary'
    ];
    $attributes[] = [
        'header' => 'Total Taxes Paid',
        'attribute' => 'total_taxes_paid_amount'
    ];
    $attributes[] = [
        'header' => 'Total Energy Charges',
        'attribute' => 'energy_charges'
    ];
    $attributes[] = [
        'header' => 'Provider',
        'attribute' => 'provider'
    ];

    $exportMenu = ExportMenu::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => $attributes,
            'target' => ExportMenu::TARGET_SELF,
            'showConfirmAlert' => false,
            'dropdownOptions' => [
                'label' => 'Export to',
                'class' => 'btn btn-default',
                'menuOptions' => ['class' => 'dropdown-menu dropdown-menu-right',],
            ],
            'columnSelectorMenuOptions' => ['class' => 'dropdown-menu dropdown-menu-right'],
            'filename' => 'some-report export for ' . $searchModel->date_from . '-' . $searchModel->date_to
        ]
    );

    echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'floatHeader' => true,
            'floatHeaderOptions' => [
                'position' => 'absolute',
                'top' => 50
            ],
            'options' => ['style' => 'overflow: hidden'],
            'containerOptions' => ['style' => 'white-space: normal;'],
            'columns' => $attributes,
            'panel' => ['type' => GridView::TYPE_PRIMARY],
            'toolbar' => $exportMenu
        ]
    );
    ?>
</div>
