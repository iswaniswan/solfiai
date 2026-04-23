<?php


/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $referrer string */

$this->title = 'Tambah Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>