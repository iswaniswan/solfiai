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

.shape {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 1;
    pointer-events: none
}

.shape>svg {
    width: 100%;
    height: auto;
    /* fill: var(--vz-body-bg) */
    fill: var(--dark)
}

.auth-one-bg {
    background-image: url(<?= Yii::getAlias('@web').'/images/logo2dsmalltransparent.png' ?>);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    opacity: .125;
}

.auth-one-bg .bg-overlay {
    background: -webkit-gradient(linear,left top,right top,from(var(--dark)),to(var(--grey-dark)));
    /* background: linear-gradient(to right,var(--dark),var(--grey-dark)); */
    background: linear-gradient(0deg,var(--danger),transparent);
    opacity: .9;
}


.auth-page-wrapper .auth-page-content {
    padding-bottom: 60px;
    position: relative;
    z-index: 2;
    width: 100%
}

.auth-page-wrapper .footer {
    left: 0;
    background-color: transparent;
    color: var(--vz-body-color)
}

.auth-one-bg-position {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 380px
}

.bg-overlay {
    position: absolute;
    height: 100%;
    width: 100%;
    right: 0;
    bottom: 0;
    left: 0;
    top: 0;
    opacity: .7;
    background-color: #000
}

*:hover {
    transform: unset !important;
}

</style>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="/" class="d-inline-block auth-logo">
                                <img src="/images/logo-light.png" alt="" height="20">
                            </a>
                        </div>
                        <!-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> -->
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 bg-dark" style="box-shadow: 0 5px 30px rgba(255, 255, 255, 0.125) !important;">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary" style="text-shadow: 0 0 white;">SOLFI AI</h5>
                            </div>
                            <div class="p-2 mt-4">
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

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="LoginForm[username]" >
                                    </div>

                                    <div class="mb-3">
                                        <div style="float: right !important;">
                                            <a href="javascript: void(0);" class="text-muted">Lupa Password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="LoginForm[password]">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                                    </div>

                                    <!-- <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                        </div>
                                    </div> -->
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Belum punya akun? <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="fw-semibold text-primary text-decoration-underline"> Daftar </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <!-- <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>