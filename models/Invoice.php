<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $code
 * @property int|null $id_deposit
 * @property int|null $no
 * @property string|null $request_time
 * @property string|null $expired_time
 * @property int|null $va_number
 * @property string|null $no_reference
 * @property int|null $status
 * @property int|null $approved_by
 * @property string|null $approved_date
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $data_json
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['id_deposit', 'no', 'va_number', 'status', 'approved_by'], 'integer'],
            [['request_time', 'expired_time', 'approved_date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['data_json'], 'string'],
            [['code'], 'string', 'max' => 20],
            [['no_reference'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'id_deposit' => 'Id Deposit',
            'no' => 'No',
            'request_time' => 'Request Time',
            'expired_time' => 'Expired Time',
            'va_number' => 'Va Number',
            'no_reference' => 'No Reference',
            'status' => 'Status',
            'approved_by' => 'Approved By',
            'approved_date' => 'Approved Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'data_json' => 'Data Json',
        ];
    }
}
