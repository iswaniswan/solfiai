<?php

use app\models\Paket;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar Paket';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Paket'    ],
]) ?>

<div class="row mb-4">
    <?php foreach ($dataProvider->models as $model) { ?>

        <?php 
        /* non premium style */
        if (@$model->is_premium == 1) {
            continue;
        }
        
        ?>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
            <div class="card-box tilebox-one bg-dark">
                <i class="icon-tag float-right m-0 h2 text-muted"></i>                
                <h3 class="my-3 card-poin"><?= strtoupper($model->name) ?></h3>
                <div class="row" style="display: flex;">
                    <div class="container" style="position: relative">
                        <span class="text-muted" style="vertical-align: sub; font-size: larger; text-decoration: line-through; margin-left: 10px;">RP. <?= number_format($model->price, 0, ",", ".") ?></span>
                        <?php if (@$model->diskon_persen != null) {
                            $diskon = $model->diskon_persen;
                            $hargaDiskon = $model->price - ($model->price * ($diskon / 100));
                            $hargaDiskon = number_format($hargaDiskon, 0, ",", ".");
                            $html = <<<HTML
                                <div>
                                    <span class="text-danger" style="vertical-align: sub; font-size: larger; margin-left: 10px;">RP. $hargaDiskon </span>
                                </div>
                            HTML;
                            echo $html;
                        }
                        
                        
                        ?>
                        <?php 
                        $url = Url::to(['deposit/create-member', 'id_paket' => $model->id]);
                        $html = '<a href="'.$url.'" class="btn btn-primary btn-rounded waves-effect waves-light float-right">Detail</a>';
                        
                        echo $html;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row mb-4">
    <?php foreach ($dataProvider->models as $model) { ?>

        <?php 
        /* premium style */
        if (@$model->is_premium == 0) {
            continue;
        }
        
        ?>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
            <div class="card-box tilebox-one bg-warning">
                <i class="icon-tag float-right m-0 h2 text-muted"></i>                
                <h3 class="my-3 card-poin text-danger"><?= strtoupper($model->name) ?></h3>
                <div class="row" style="display: flex;">
                    <div class="container" style="position: relative">
                        <span class="text-white" style="vertical-align: sub; font-size: larger; margin-left: 10px;">RP. <?= number_format($model->price, 0, ",", ".") ?></span>
                        <?php 
                        $url = Url::to(['deposit/create-member', 'id_paket' => $model->id]);
                        $html = '<a href="'.$url.'" class="btn btn-primary btn-rounded waves-effect waves-light float-right">Detail</a>';
                        
                        echo $html;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<?php 

$style = <<<CSS
    .card-poin::before {        
        margin-right: 5px;
    }
    .card-poin::after {        
        margin-left: 10px;
    }
CSS;

$this->registerCss($style);

?>