<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roi".
 *
 * @property int $id
 * @property float|null $roi
 * @property string|null $date_created
 */
class Roi extends \yii\db\ActiveRecord
{

    const MAX = 90;

    public const TYPE_USER = 100000;
    public const TYPE_BASIC = 600000;
    public const TYPE_BISNIS = 1350000;
    public CONST TYPE_STOKIS = 15000000;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['roi'], 'number'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roi' => 'Roi',
            'date_created' => 'Date Created',
        ];
    }

    public static function getCurrentRoi()
    {
        return static::find()->orderBy(['date_created' => SORT_DESC])->one();
    }

    public static function isHasMax(Member $member)
    {
        $paket = @$member->paket->id;
    }

    public static function getMaxRoi($idPaket)
    {
        $value = 0;

        switch ($idPaket) {
            case Paket::TYPE_USER : {
                $value = static::TYPE_USER;
                break;
            }

            case Paket::TYPE_BASIC: {
                $value = static::TYPE_BASIC;
                break;
            }

            case Paket::TYPE_BISNIS: {
                $value = static::TYPE_BISNIS;
                break;
            }

            case Paket::TYPE_STOKIS: {
                $value = static::TYPE_STOKIS;
                break;
            }

            default: break;
        }

        return $value;
    }

}
