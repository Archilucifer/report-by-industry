<?php


use common\models\SubIndustry;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Industry Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="industry-create-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php
        $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'industry')->dropDownList(SubIndustry::getIndustriesList())?>
        <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'head')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group text-right">
            <?= Html::submitButton(
                $model->isNewRecord
                    ? 'Create'
                    : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>

        <?php
        ActiveForm::end(); ?>

    </div>
</div>
