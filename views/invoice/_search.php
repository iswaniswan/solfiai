<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'id_deposit') ?>

    <?= $form->field($model, 'no') ?>

    <?= $form->field($model, 'request_time') ?>

    <?php // echo $form->field($model, 'expired_time') ?>

    <?php // echo $form->field($model, 'va_number') ?>

    <?php // echo $form->field($model, 'no_reference') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'approved_by') ?>

    <?php // echo $form->field($model, 'approved_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
