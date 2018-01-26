<?php

namespace core\entities;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $status_id
 * @property int $user_id
 * @property string $description
 *
 * @property Logs $id0
 * @property Statuses $statuses
 * @property Users $users
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_id', 'user_id'], 'required'],
            [['status_id', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Logs::className(), 'targetAttribute' => ['id' => 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getImages()
    {
        return $this->hasMany(Images::className(), ['id' => 'order_id']);
    }


    public function changeStatusToPhoto()
    {
        $this->status_id = Statuses::STATUS_PHOTO;
        $this->save();
    }

    public function changeStatusToPayed()
    {
        $this->status_id = Statuses::STATUS_PAYED;
        $this->save();
    }

    public function changeStatusToReady()
    {
        $this->status_id = Statuses::STATUS_READY;
        $this->save();
    }

    public function changeStatusToPost()
    {
        $this->status_id = Statuses::STATUS_POST;
        $this->save();
    }

    public static function create($user, $description)
    {
        $order = new Orders();
        $order->status_id = Statuses::STATUS_NEW;
        $order->user_id = $user->id;
        $order->description = $description;
        $order->save();
        return $order;
    }
}
