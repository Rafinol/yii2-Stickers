<?php

namespace core\entities;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $status
 *
 * @property Orders $id0
 */
class Statuses extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PHOTO = 2;
    const STATUS_PAYED = 3;
    const STATUS_READY = 4;
    const STATUS_POST = 5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 50],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id' => 'status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id' => 'status_id']);
    }
}
