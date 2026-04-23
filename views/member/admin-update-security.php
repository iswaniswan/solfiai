<?php

use app\components\Mode;
use app\components\Session;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $referrer string */

$this->title = 'Update Member Security';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => "Security"
    ],
]) ?>

<div class="member-update">

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-12',
            'wrapper' => 'col-12',
            'error' => '',
            'hint' => '',
            'field' => 'mb-3 row',
        ],
        'options' => ['style' => 'padding:unset'],
    ],
    'enableClientScript' => false
]); ?>

<div class="row">
    <div class="col-8">
        <div class="member-form card-box">
            <div class="card-body row">
                <div class="col-12" style="border-bottom: 1px solid #ccc; margin-bottom: 2rem;">
                    <h4 class="card-title mb-3"><?= $this->title ?></h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($user) ?>

                    <?= $form->field($user, 'username')->textInput([
                            'readonly' => 'readonly'
                    ]) ?>

                    <?= $form->field($user, 'email')->input('email', [
                        'readonly' => 'readonly'
                    ]) ?>

                    <?= $form->field($user, 'pin')->input('number') ?>

                    <?php // $form->field($user, 'password')->input('password') ?>

                    <div class="mb-3 row field-user-password required" style="padding:unset">
                        <label class="col-12" for="user-password">Password</label>
                        <div class="col-12">
                            <div class="input-group mb-3 mr-3">
                                <input type="password" id="user-password" class="form-control" name="User[password]" value="<?= @$user->password ?>" aria-required="true">
                                <div class="invalid-feedback "></div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="togglePlainPassword()">
                                        <i class="ti-eye mx-2 h6 text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="plain_password" id="plain_password" value="<?= @$modelRegistration->plain_password ?>" readonly />

                </div>

                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', ['member/index-admin'], ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == 'view') { ?>
            <?= Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">' . ucwords($mode) .'</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    function togglePlainPassword() {
        const plainPassword = $('#plain_password').val();
        const currentType = $('#user-password').attr('type');
        if (currentType === 'text') {
            $('#user-password').attr('type', 'password');
        } else {
            $('#user-password').attr('type', 'text');
            $('#user-password').val(plainPassword);
        }
    }
</script>