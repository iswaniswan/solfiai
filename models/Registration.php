<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $plain_password
 * @property int|null $plain_pin
 * @property string|null $sponsor_code
 * @property int $status
 * @property string|null $date_created
 * @property int $status_hapus
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    public static function createFromUser(User $user)
    {
        $model = new Registration();
        $model->email = $user->email;
        $model->phone = $user->phone;
        $model->plain_password = '';
        $model->plain_pin = '';
        $model->sponsor_code = $user->registered_referral_code;
        $model->save();
        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plain_pin', 'status', 'status_hapus'], 'integer'],
            [['date_created'], 'safe'],
            [['username', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 16],
            [['plain_password'], 'string', 'max' => 255],
            [['sponsor_code'], 'string', 'max' => 12],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'phone' => 'Phone',
            'plain_password' => 'Plain Password',
            'plain_pin' => 'Plain Pin',
            'sponsor_code' => 'Sponsor Code',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'status_hapus' => 'Status Hapus',
        ];
    }
}
