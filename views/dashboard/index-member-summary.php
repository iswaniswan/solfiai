<?php
/** @var yii\web\View $this */

use app\components\Session;
use app\models\FundActive;
use app\models\FundPassive;
use app\models\FundRef;
use app\models\FundTicket;
use app\models\Roi;
use yii\helpers\Url;

$this->title = 'Dashboard Member';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => $this->title
    ],
]) ?>

<style>
    h3[data-plugin]::after {
        content: '%';
    }
    .roi {
        width: 100%;
        display:flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .roi h3 {
        flex-grow: 1;
    }
    .roi h3:nth-child(1) {
        text-align: left;
    }
    .roi h3:nth-child(2) {
        text-align: center;
        font-size: small !important;
        margin-bottom: unset !important;
    }
    .roi h3:nth-child(3) {
        text-align: right;
    }
</style>

<div class="row mb-4">
    <div class="col-sm-6">
        <div class="card-box tilebox-one">
            <h6 class="text-muted text-uppercase mt-0">Member Area</h6>
            <div class="row mt-4 mb-2" style="margin-left: -24px;">
                <a href="<?= Url::to(['member/update-profile', 'id' => $member->id]) ?>" class="col text-center">
                    <i class="icon-user m-2 h2 text-success"></i>
                    <span class="text-muted" style="display: block;">Profil</span>
                </a>
                <a href="<?= Url::to(['member/update-paket', 'id' => $member->id]) ?>" class="col text-center">
                    <i class="icon-badge m-2 h2 text-purple"></i>
                    <span class="text-muted" style="display: block;">Paket</span>
                </a>
                <a href="<?= Url::to(['member/update-bank', 'id' => $member->id]) ?>" class="col text-center">
                    <i class="icon-wallet m-2 h2 text-primary"></i>
                    <span class="text-muted" style="display: block;">Bank</span>
                </a>
                <a href="<?= Url::to(['member/update-security', 'id' => $member->id]) ?>" class="col text-center">
                    <i class="icon-lock-open m-2 h2 text-danger"></i>
                    <span class="text-muted" style="display: block;">Security</span>
                </a>
            </div>
        </div>
    </div>
    <?php /*
    <div class="col-sm-6">
        <div class="card-box tilebox-one">
            <i class="icon-tag float-right m-0 h2 text-success"></i>
            <h6 class="text-muted text-uppercase mt-0">PAKET <?= $paket->name ?></h6>
            <h3 class="my-3 card-poin"><?= FundTicket::getBalance($member->id) ?></h3>
            <?php $lastCredit = FundTicket::lastCredit($member->id) ?>
            <span>Terakhir ditambahkan <?= date('d M Y', strtotime($lastCredit->date_created)) ?></span>
        </div>
    </div>
    */ ?>
    <?php
    $myRoi = 0;
    $queryRoi = FundPassive::getTotal(Session::getIdMember(), FundRef::ROI);
    if ($queryRoi != null and $queryRoi > 0) {
        $myRoi = number_format($queryRoi, 0, ",", ".");
    }

    $persenRoi = 0;
    $sumRoi = FundPassive::getSum(Session::getIdMember(), FundRef::ROI) ?? 0;
    $sumRoi += FundActive::getSum(Session::getIdMember(), FundRef::ROI) ?? 0;
    if ($sumRoi != null and $sumRoi > 0) {
        $maxRoi = Roi::getMaxRoi(@$paket->id);
        $persenRoi = $sumRoi / $maxRoi * 100;
    }
    ?>
    <?php /*
    <div class="col-md-6">
        <div class="card-box">
            <h6 class="text-muted text-uppercase mt-0">Progress</h6>

            <h3 class="text my-3"><span class="text-muted">PAKET <?= strtoupper($paket->name) ?></span>
                <span class="text-danger float-right"><b><?= number_format($persenRoi, 2, ",", ".") ?>%</b></span>
            </h3>
            <div class="progress progress-xl" style="height: 20px;">
                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                     style="width: <?= $persenRoi ?>%">
                </div>
            </div>
            <a href="#">
                <span>Detail</span>
            </a>
        </div>
    </div>
    */ ?>
    <div class="col-6">
        <div class="card-box tilebox-two">
            <?php $urlRiwayatRoi = Url::to(['/member/index-fund-statement', 'id_fund_ref' => FundRef::ROI]) ?>
            <a href="<?= $urlRiwayatRoi ?>" class="btn btn-sm btn-primary waves-effect waves-light float-right">Riwayat</a>
            <h6 class="text-muted text-uppercase mt-0 mb-4">ROI (PAKET <?= strtoupper(@$paket->name) ?>)</h6>
            <div class="roi">
                <h3 class="text-warning">IDR. <?= number_format($sumRoi, 0, ",", ".")  ?></h3>
                <h3 class="mt-4 mb-4 text-success" data-plugin="counterup"><?= number_format($persenRoi, 2, ".", ",") ?></h3>
                <h3 class="text-danger">IDR. <?= number_format($maxRoi, 0, ",", ".")  ?></h3>
            </div>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?= $persenRoi ?>%" aria-valuenow="<?= $persenRoi ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="card-box tilebox-one">
            <?php $urlRiwayat = Url::to(['/member/index-fund-statement']) ?>
            <a href="<?= $urlRiwayat ?>" class="btn btn-sm btn-primary waves-effect waves-light float-right">Riwayat</a>
            <h6 class="text-muted text-uppercase mt-0">Saldo Tunai</h6>
            <?php $balanceActive = FundActive::getBalance($member->id); ?>
            <h3 class="my-3 text-success"><?= "IDR. " . number_format($balanceActive, 0, ",", ".") ?></h3>
        </div>
    </div>
    <div class="col-6">
        <div class="card-box tilebox-one">
            <a href="<?= $urlRiwayat ?>" class="btn btn-sm btn-primary waves-effect waves-light float-right">Riwayat</a>
            <h6 class="text-muted text-uppercase mt-0">Saldo Tabungan</h6>
            <?php $totalWithdraw = FundPassive::getBalance($member->id); ?>
            <h3 class="my-3 text-warning"><?= "IDR. " . number_format($totalWithdraw, 0, ",", ".") ?></h3>
        </div>
    </div>
</div>