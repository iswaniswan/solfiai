<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "paket".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $poin
 * @property string|null $remark
 * @property int|null $is_active
 */
class Paket extends \yii\db\ActiveRecord
{

    const TYPE_USER = 1;
    const TYPE_BASIC = 2;
    const TYPE_BISNIS = 3;
    const TYPE_STOKIS = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'poin', 'is_active'], 'integer'],
            [['name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'price' => 'Harga',
            'poin' => 'Poin',
            'remark' => 'Keterangan',
            'is_active' => 'Is Active',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(static::find()->where([
            'is_active' => '1',
        ])->all(),'id', function($self) {
            return ucwords($self->name);
        });
    }

    public function getBadgeStatus()
    {
        $html = '<span class="badge badge-danger p-2">Inactive</span>';
        
        if ((int) $this->is_active == 1) {
            $html = '<span class="badge badge-success p-2">Active</span>';
        }

        return $html;
    }

}
