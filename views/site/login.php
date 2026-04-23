<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

\app\assets\UplonAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .box-center {
        display: flex;
        justify-content: center;
        align-items:center;
        height: 80vh;
        width: 80vw;
        margin:auto;
    }
    a.dropdown-item, a.dropdown-item *:hover {
        cursor: pointer;
        background-color: transparent !important;
    }

    body {
        background-image: url('<?= Yii::getAlias('@web').'/images/background.jpg' ?>');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* Glassmorphism card effect */
    .card {
        backdrop-filter: blur(16px) saturate(180%);
        /* -webkit-backdrop-filter: blur(16px) saturate(180%) !important; */
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        border: 1px solid rgba(209, 213, 219, 0.3);
    }
</style>

<div class="row mb-4 justify-content-center box-center">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
//                'template' => "{label}\n{input}\n{error}",
                'template' => "{label}\n{input}",
                'labelOptions' => ['class' => 'col-12 col-form-label', 'style' => 'font-weight: 400; padding-left: unset'],
                'inputOptions' => ['class' => 'col-12 form-control', 'style' => 'padding-right: 1rem'],
//                'errorOptions' => ['class' => 'col-12 invalid-feedback'],
                'horizontalCssClasses' => [
                    'field' => 'mb-3',
                ]
            ],
        ]); ?>
        <div class="card mb-0 mx-auto" style="box-shadow: 0px 0px 35px 35px rgba(73,80,87,.15) !important; max-width: 28rem;">
            <div class="card-body" style="padding: unset">
                <div class="row text-white">
                    <div class="container p-5">
                        <a href="#" style="display: block;" class="my-3 py-3">
                            <img src="<?= Yii::getAlias('@web').'/images/LOGO.png' ?>" style="width:100%">
                        </a>
                        <h4 class="text-warning text-center">Account Login</h4>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?php // $form->field($model, 'password')->passwordInput() ?>

                        <div class="input-group mb-3 mr-3 field-loginform-password required">
                            <label class="col-12 col-form-label" style="font-weight: 400; padding-left: unset" for="loginform-password">Password</label>
                            <input type="password" id="loginform-password" class="col-12 form-control" name="LoginForm[password]"
                                   value="" style="padding-right: 1rem" aria-required="true" aria-invalid="false" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-dark btn-sm" style="background: #fff; border: 1px solid transparent" onclick="showPassword()">
                                    <i class="ti-eye h5 text-secondary"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 field-loginform-rememberme">
                            <div class="col-12 checkbox checkbox-warning ml-2 ">
                                <input type="hidden" name="LoginForm[rememberMe]" value="0">
                                <input type="checkbox" id="loginform-rememberme" class="form-check-input" name="LoginForm[rememberMe]" value="1" checked="">
                                <label class="form-check-label" style="font-weight: 400;" for="loginform-rememberme">Remember Me</label>
                            </div>
                            <div class="col-12"><div class="invalid-feedback "></div></div>
                        </div>

                        <div class="" style="padding: 0.5rem 0rem;">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-outline-warning btn-block', 'name' => 'login-button']) ?>
                        </div>
                        <p class="d-flex justify-content-center text-warning" style="margin-top: 2rem; margin-bottom:unset;">Don't have an account?
                            <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="ml-1" style="display: block"><span>Register</span></a>
                        </p>
                    </div>
                </div>
            </div> <!-- end card-body -->
        </div>
        <?php ActiveForm::end(); ?>
        <!-- end card -->

        <!-- end row -->
        <?php 
        $checked = ''; $flag = false;
        $cookie = Yii::$app->request->cookies->getValue('dark-mode');
        if ($cookie != null and $cookie == true) {
            $checked = 'checked';
            $flag = true;
        }
        ?>
        <?php /*
        <div class="row mt-2">
            <a href="<?= Url::to(['site/toggle-dark-mode', 'flag' => $flag]) ?>" class="dropdown-item notify-item text-center" style="width:fit-content; margin: auto; padding: .5rem 0;">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input theme-choice"
                           id="dark-mode-switch" <?= $checked ?>>
                    <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                </div>
            </a>
        </div>
        */ ?>
    </div>
</div>

<?php 
$script = <<<JS
    function showPassword() {
        const currentType = $('#loginform-password').attr('type');
        if (currentType === 'text') {
            $('#loginform-password').attr('type', 'password');
        } else {
            $('#loginform-password').attr('type', 'text');
        }
    }

$(document).ready(function() {
    $('#dark-mode-switch').on('change', function() {
        $(this).parent().trigger('click');
    })        
})


JS;

$this->registerJs($script, View::POS_END);

?>