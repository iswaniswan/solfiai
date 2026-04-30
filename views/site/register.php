<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

\app\assets\RegisterAsset::register($this);
// \app\assets\UplonAsset::register($this);

$this->title = 'Register';
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


<div aria-live="polite" aria-atomic="true" style="position: absolute; top: 1rem; right: 1rem; min-height: 200px; width: 24rem;">
  <div class="toast bg-danger" role="alert" style="position: absolute; top: 0; right: 0; " data-delay="3000" id="toast-referal">
    <div class="toast-header">
      <img src="" class="rounded mr-2" alt="">
      <strong class="mr-auto">Error</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        Referral tidak boleh kosong
    </div>
  </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: absolute; top: 1rem; right: 1rem; min-height: 200px; width: 24rem;">
    <div class="toast bg-danger" role="alert" style="position: absolute; top: 0; right: 0; " data-delay="3000" id="toast-email">
        <div class="toast-header">
            <img src="" class="rounded mr-2" alt="">
            <strong class="mr-auto">Error</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Email Sudah digunakan!
        </div>
    </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: absolute; top: 1rem; right: 1rem; min-height: 200px; width: 24rem;">
    <div class="toast bg-danger" role="alert" style="position: absolute; top: 0; right: 0; " data-delay="3000" id="toast-username">
        <div class="toast-header">
            <img src="" class="rounded mr-2" alt="">
            <strong class="mr-auto">Error</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Username Sudah digunakan!
        </div>
    </div>
</div>

<div class="row justify-content-center text-primary box-center">
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

    <div class="card">
        <div class="card-body">

            <div class="col-12 p-4">
                <div class="row text-center">
                    <a href="#" class="col">
                        <img src="<?= Yii::getAlias('@web').'/images/logo2dsmalltransparent.png' ?>" style="width:50%; max-height:70px; object-fit:scale-down">
                    </a>
                </div>
            </div>
            <div id="login-form">
                <h3></h3>
                <section>
                    <div class="field-email required mb-4">
                        <label class="col-12" style="padding-left: unset" for="email">Email</label>
                        <input type="email" id="email" class="col-12 form-control" name="User[email]" required="" autocomplete="off" aria-required="true" required>
                    </div>

                    <div class="field-harga_paket  mb-4" style="padding:unset">
                        <label class="col-12" style="padding-left: unset" for="username">User ID</label>
                        <div class="input-group">
                            <input type="text" class="col-12 form-control " name="User[username]" id="username" autocomplete="off" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary btn-sm" onclick="generateUsername()" title="Generate">
                                    <i class="ti-shield px-2 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="field-harga_paket  mb-4" style="padding:unset">
                        <label class="col-12" style="padding-left: unset" for="password">Password</label>
                        <div class="input-group">
                            <input type="text" class="col-12 form-control " name="User[password]" id="password" minlength='8' autocomplete="off" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary btn-sm" onclick="generatePassword()" title="Generate">
                                    <i class="ti-shield px-2 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="field-phone  mb-4" style="padding:unset">
                        <label class="col-12" style="padding-left: unset" for="phone">No Handphone</label>
                        <input type="text" class="col-12 form-control" pattern="[0-9]*" inputmode="numeric" name="User[phone]" id="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '');" autocomplete="off" required>
                    </div>

                    <div class="field-telegram_id mb-4" style="padding:unset">
                        <label class="col-12" style="padding-left: unset" for="telegram_id">ID Telegram</label>
                        <input type="text" class="col-12 form-control " name="User[telegram_id]" id="telegram_id" autocomplete="off" required>
                    </div>

                </section>
            </div>
            <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary btn-block mb-4', 'id' => 'btn-register-submit']) ?>
        </div>
    
    </div>
    <div class="go-to-login">
        <div class="col-12 text-center">
        <p class="d-flex justify-content-center text-primary" style="margin-top: 2rem; margin-bottom:unset;">Sudah memiliki akun? <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class=" ml-1"><b>Login</b></a></p>
    </div>
    <?php ActiveForm::end(); ?>
    </div>


        <?php
        $checked = ''; $flag = false;
        $cookie = Yii::$app->request->cookies->getValue('dark-mode');
        if ($cookie != null and $cookie == true) {
            $checked = 'checked';
            $flag = true;
        }
        ?>
    <?php /*
    <div class="row mt-2 mx-auto">
        <div class="col-12 text-center">
            <a href="<?= Url::to(['site/toggle-dark-mode', 'flag' => $flag]) ?>" class="dropdown-item notify-item text-center">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input theme-choice"
                           id="dark-mode-switch" <?= $checked ?>>
                    <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                </div>
            </a>
        </div>
    </div>
    */ ?>

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
            width: 60%;
        }
    }

CSS;

$this->registerCss($style);

?>