<?php


use common\models\SubIndustry;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Monthly Report Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="industry-create-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php
        $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'industry')->dropDownList(SubIndustry::getIndustriesList()) ?>
        <?= $form->field($model, 'date')->widget(
            DatePicker::class,
            [
                'options' => [
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'orientation' => 'bottom right',
                    'format' => 'yyyy-mm',
                    'minViewMode' => 'months',
                ]
            ]
        ) ?>
        <?= $form->field($model, 'workers')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'average_salary')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'taxes_paid_amount')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'energy_charges')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'provider')->textInput(['maxlength' => true]) ?>

        <div class="form-group text-right">
            <?= Html::submitButton(
                'Create',
                ['class' => 'btn btn-success']
            ) ?>
        </div>

        <?php
        ActiveForm::end(); ?>

    </div>
</div>
