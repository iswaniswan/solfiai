<?php

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $referrer string */

$this->title = 'Edit Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="invoice-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
