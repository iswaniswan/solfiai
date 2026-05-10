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

<div class="auth-page-wrapper">
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
                                    'id' => 'register-form',
                                    'layout' => 'horizontal',
                                    'fieldConfig' => [
                            //                'template' => "{label}\n{input}\n{error}",
                                        'template' => "{label}\n{input}",
                                        'labelOptions' => ['class' => 'col-12', 'style' => 'font-weight: 400', 'icon' => '<i></i>'],
                                        'inputOptions' => ['class' => 'col-12 form-control'],
                            //                'errorOptions' => ['class' => 'col-12 invalid-feedback'],
                                        'horizontalCssClasses' => [
                                            'field' => 'mb-3',
                                        ]
                                    ],
                                ]); ?>

                                    <div class="field-email required mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" class="col-12 form-control" name="User[email]" required="" autocomplete="off" aria-required="true" required>
                                    </div>

                                    <div class="field-harga_paket  mb-4" style="padding:unset">
                                        <label class="form-label" for="username">User ID</label>
                                        <div class="input-group">
                                            <input type="text" class="col-12 form-control " name="User[username]" id="username" autocomplete="off" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="generateUsername()" title="Generate">
                                                    <i class="ti-reload px-2 text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field-harga_paket  mb-4" style="padding:unset">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="text" class="col-12 form-control " name="User[password]" id="password" minlength='8' autocomplete="off" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="generatePassword()" title="Generate">
                                                    <i class="ti-reload px-2 text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field-phone  mb-4" style="padding:unset">
                                        <label class="form-label" for="phone">No Handphone</label>
                                        <input type="text" class="col-12 form-control" pattern="[0-9]*" inputmode="numeric" name="User[phone]" id="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '');" autocomplete="off" required>
                                    </div>

                                    <div class="field-telegram_id mb-4" style="padding:unset">
                                        <label class="form-label" for="telegram_id">ID Telegram</label>
                                        <input type="text" class="col-12 form-control " name="User[telegram_id]" id="telegram_id" autocomplete="off" required>
                                    </div>

                                    <?php 
                                        $referralValue = null;
                                        $attribute = '';
                                        if (@$referral != null) {
                                            $referralValue = $referral;
                                            $attribute = 'readonly';
                                        }
                                        
                                        ?>
                                        <div class="mb-4 field-referral-code">
                                            <label class="form-label" for="referral-code">Referral Code</label>
                                            <input type="text" id="referral_code" maxlength="8" class="col-12 form-control" 
                                                name="User[registered_referral_code]" 
                                                value="<?= $referralValue ?>" aria-required="true" 
                                                aria-invalid="false" <?= $attribute ?>
                                                placeholder="Masukkan kode referral (jika ada)">
                                        </div>  

                                    <div class="mt-4">
                                        <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary btn-block mb-4', 'id' => 'btn-register-submit']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="d-flex justify-content-center text-primary" style="margin-top: 2rem; margin-bottom:unset;">Sudah punya akun? <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class=" ml-1"><b>Login</b></a></p>
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




<?php
$urlValidateReferralCode = Url::to(['/member/validate-referral-code']);
$urlGenerateUsername = Url::to(['/member/generate-username']);
$urlGeneratePassword = Url::to(['/member/generate-password']);
$urlGeneratePin = Url::to(['/member/generate-pin']);
$urlValidateEmail = Url::to(['/user/validate-email']);
$urlValidateUsername = Url::to(['/user/validate-username']);
$urlCheckUsernameExists = '';

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
$script = <<<JS

    function validateEmail() {
        $.ajax({
            type: "POST",
            url: "{$urlValidateEmail}",
            data: {
                'email': $('#email').val(),
                "{$csrfParam}": "{$csrfToken}"
            },
            success: function(response) {                
                console.log(response?.status);
                if (response?.status == false) {
                    console.log('email sudah diguanakan');
                    $('#toast-email').toast('show');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function validateUsername() {
        $.ajax({
            type: "POST",
            url: "{$urlValidateUsername}",
            data: {
                'username': $('#username').val(),
                "{$csrfParam}": "{$csrfToken}"
            },
            success: function(response) {                
                console.log(response?.status);
                if (response?.status == false) {
                    console.log('username sudah diguanakan');
                    $('#toast-username').toast('show');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function generateUsername() {
        $.ajax({
            type: "POST",
            url: "{$urlGenerateUsername}",
            data: {
                'email': $('#email').val(),
                "{$csrfParam}": "{$csrfToken}"
            },
            success: function(response) {
                console.log(response);
                const data = response?.data;
                $('#username').val(data?.username);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function generatePassword() {
        $.ajax({
            type: "POST",
            url: "{$urlGeneratePassword}",
            data: {
                "{$csrfParam}": "{$csrfToken}"
            },
            success: function(response) {
                console.log(response);
                const data = response?.data;
                $('#password').val(data?.password);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function actionStep() {
        /** verify referral */
        const referral = $('#referral_code').val();
        if (referral == null || referral == '') {
            // alert('Referral tidak boleh kosong');
            $('#toast-referal').toast('show');
            return false;
        }
        
        let myPromise = new Promise(function(myResolve, myReject) {
            $.ajax({
                type: "POST",
                url: "{$urlValidateReferralCode}",
                data: {
                    "{$csrfParam}": "{$csrfToken}",
                    'referral_code': $('#referral_code').val()
                },
                success: function(response) {
                    myResolve(response);
                },
                error: function(error) {
                    myReject(error);
                }
            });
        });
        
        myPromise.then(
            function(value) {
                console.log(value);
                if (value?.status == 'success') {
                    $('a[href="#next"]').show(); 
                    $('#referral_code').attr('readonly', true);
                    setTimeout(() => {
                        $('a[href="#next"]').trigger('click');
                    }, 300);
                } else {
                    alert(value?.message);
                }               
          },
            function(error) {
                console.log(error);
            }
        );
    }
    
    $("#example-basic").steps({
        labels: {
            finish: "Submit" // Change this to your desired label for the last step's finish button
        },
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        onStepChanging: function (event, currentIndex, newIndex) {
            // return actionStep(event, currentIndex, newIndex);
            let allButton = $('.btn-action');
            allButton.each(function() {
                const bIndex = $(this).data('index');
                if (bIndex <= newIndex) {
                    $(this).removeClass('disabled');
                } else {
                    if ($(this).hasClass('disabled') == false) {
                        $(this).addClass('disabled');
                    }
                }
            })
            return true;
        }
    });
    
    $('ul[role="tablist"]').hide('fast');
    
    $(document).ready(function() {
        $('a[href="#next"]').hide('fast'); 
        
        $('#email').on('keyup', function() {
            const value = $(this).val();
    
            if (value.search('@') >= 0) {
                validateEmail();
            }
        });
        
        $('#username').on('focus', function(e) {
            validateEmail();
        })
        
        $('#username').on('keyup', function() {
            const value = $(this).val();    
            if (value.length >= 0) {
                validateUsername();
            }
        });
        
        $('#password').on('focus', function(e) {
            validateUsername();
        })
        
        $('a[href="#finish"]').on('click', function() {
            $('#btn-register-submit').trigger('click');
        })
        
    })

    // const confirmSubmit = () => {
    //     const referral = $('#referral_code').val() || '';
    //     if (referral == '') {
    //         return confirm("Lanjutkan Daftar Tanpa Kode Referral?");
    //     }
    // }

    $('button[type="submit"]').on('click', function(e) {
        const referral = $('#referral_code').val() || '';

        if (referral === '') {
            if (!confirm("Lanjutkan Daftar Tanpa Kode Referral?")) {
                e.preventDefault(); // cancel submit kalau user pilih Cancel
                return;
            }
        }
        // kalau ada referral ATAU user klik OK → biarkan submit jalan
    });


JS;

$this->registerJs($script, View::POS_END);

$style = <<<CSS
    body.enlarged {
        min-height: auto!important;
    }
    
    .wizard > .content {
        border: unset;
        min-height: auto !important;
        margin-bottom: 2rem;
    }
    
    .wizard > .actions  {
        padding-left: 2rem; 
        padding-right: 2rem;
    }
    
    ul[role=tablist] {
        display: none;
    }

    .actions.clearfix {
        text-align: center;
    }
    
    @media (min-width: 768px) {

        #register-form {
            display: block;
        }
    }

CSS;

$this->registerCss($style);

?>