<?php

use common\models\Industry;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\widgets\ActiveForm */
/* @var $model Industry */

$this->title = 'Industry Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="industry-create-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php
        $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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
