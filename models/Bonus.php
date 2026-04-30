<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonus".
 *
 * @property int $id
 * @property int|null $level
 * @property int|null $persen
 * @property int $status
 * @property string|null $keterangan
 */
class Bonus extends \yii\db\ActiveRecord
{

    public const ACTIVE = 1;
    public const INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'persen', 'status'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'persen' => 'Persen',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
        ];
    }
}
