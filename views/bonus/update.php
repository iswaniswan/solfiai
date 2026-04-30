<?php

/* @var $this yii\web\View */
/* @var $model app\models\Bonus */
/* @var $referrer string */

$this->title = 'Edit Bonus';
$this->params['breadcrumbs'][] = ['label' => 'Bonuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="bonus-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
