<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

// \app\assets\UplonAsset::register($this);

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
        /* background-image: url('<?php // Yii::getAlias('@web').'/images/background.jpg' ?>'); */
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
    
    .card:hover, .btn:hover {
        transform: unset !important;
    }
</style>

<style>
  :root {
    --primary-color: #E94560;
    /* Warna background disesuaikan agar match dengan backdrop logo */
    --card-bg: #1a1a1d; 
    --input-bg: #e9ecef;
    --text-label: #E94560;
  }

  body {
    /* background-color: #0f0f12; Background luar lebih gelap */
    background-color: var(--dark);
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .login-card {
    background-color: var(--card-bg);
    width: 380px;
    padding: 40px;
    border-radius: 12px;
    /* Drop shadow halus, bukan efek 3D */
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .solfi-logo {
    color: var(--primary-color);
    font-size: 42px;
    font-weight: 900;
    margin-bottom: 30px;
    letter-spacing: -2px;
    text-transform: uppercase;
    /* Shadow pada teks untuk kedalaman tanpa 3D bevel */
    text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
  }

  .input-group {
    text-align: left;
    margin-bottom: 20px;
  }

  .input-group label {
    display: block;
    color: var(--text-label);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    text-align: center;
  }

  .input-group input {
    width: 100%;
    padding: 12px 15px;
    border-radius: 8px;
    border: none;
    background-color: var(--input-bg);
    box-sizing: border-box;
    font-size: 14px;
  }

  .password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
  }

  .eye-icon {
    position: absolute;
    right: 15px;
    color: var(--primary-color);
    cursor: pointer;
  }

  .login-btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 6px;
    background-color: var(--primary-color);
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: opacity 0.2s;
  }

  .login-btn:hover {
    opacity: 0.9;
  }

  .footer-text {
    color: #888;
    font-size: 13px;
    margin-top: 25px;
  }

  .footer-text a {
    color: var(--primary-color);
    text-decoration: none;
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
                'labelOptions' => ['class' => 'col-12 col-form-label text-primary', 'style' => 'padding-left: unset'],
                'inputOptions' => ['class' => 'col-12 form-control form-control-lg', 'style' => 'padding-right: 1rem'],
//                'errorOptions' => ['class' => 'col-12 invalid-feedback'],
                'horizontalCssClasses' => [
                    'field' => 'mb-3',
                ]
            ],
        ]); ?>
        <div class="card mb-0 mx-auto text-center" style="box-shadow: 0px 0px 35px 35px rgba(73,80,87,.15) !important; max-width: 28rem;">
            <div class="card-body" style="padding: unset">
                <div class="row text-white">
                    <div class="container p-5">
                        <a href="#" style="display: block;" class="my-3 py-3">
                            <img src="<?= Yii::getAlias('@web').'/images/logo2dsmalltransparent.png' ?>" style="width:100%">
                        </a>
                        <?php // $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?php // $form->field($model, 'password')->passwordInput() ?>

                        <div class="input-group mb-3 mr-3 field-loginform-password required">
                            <label class="col-12 col-form-label text-primary" style="padding-left: unset" for="loginform-username">Username</label>
                            <input type="text" id="loginform-username" class="col-12 form-control form-control-lg" name="LoginForm[username]" 
                                style="padding-right: 1rem; border-top-left-radius: 8px; border-bottom-left-radius: 8px;" autofocus="" aria-required="true" aria-invalid="false" required>                            
                        </div>

                        <div class="input-group mb-3 mr-3 field-loginform-password required">
                            <label class="col-12 col-form-label text-primary" style="padding-left: unset" for="loginform-password">Password</label>
                            <input type="password" id="loginform-password" class="col-12 form-control form-control-lg" name="LoginForm[password]"
                                   value="" style="padding-right: 1rem; border-top-left-radius: 8px; border-bottom-left-radius: 8px;" aria-required="true" aria-invalid="false" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary btn-sm" 
                                    style="background: transparent; border: 1px solid var(--white); border-top-right-radius: 8px; border-bottom-right-radius: 8px;" 
                                    onclick="showPassword()">
                                    <i class="ti-eye h5 text-primary"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 field-loginform-rememberme d-none">
                            <div class="col-12 checkbox checkbox-primary ml-2 ">
                                <input type="hidden" name="LoginForm[rememberMe]" value="0">
                                <input type="checkbox" id="loginform-rememberme" class="form-check-input" name="LoginForm[rememberMe]" value="1" checked="true">
                                <label class="form-check-label" style="font-weight: 400;" for="loginform-rememberme">Remember Me</label>
                            </div>
                            <div class="col-12"><div class="invalid-feedback "></div></div>
                        </div>

                        <div class="" style="padding: 0.5rem 0rem;">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-outline-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                        <p class="d-flex justify-content-center text-primary" style="margin-top: 2rem; margin-bottom:unset;">Belum punya akun?
                            <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="ml-1 text-primary" style="display: block"><span>Daftar</span></a>
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