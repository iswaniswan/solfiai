<?php


/* @var $this yii\web\View */
/* @var $model app\models\Bonus */
/* @var $referrer string */

$this->title = 'Tambah Bonus';
$this->params['breadcrumbs'][] = ['label' => 'Bonuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>