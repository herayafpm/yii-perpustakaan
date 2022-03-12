<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengembalian".
 *
 * @property int $id
 * @property int $buku_id
 * @property int $user_id
 * @property int $admin_id
 * @property int|null $qty
 * @property string|null $at
 *
 * @property User $admin
 * @property Buku $buku
 * @property User $user
 */
class Pengembalian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengembalian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['buku_id', 'user_id', 'admin_id'], 'required'],
            [['buku_id', 'user_id', 'admin_id', 'qty'], 'integer'],
            [['at'], 'safe'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['buku_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buku::className(), 'targetAttribute' => ['buku_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'buku_id' => 'Buku ID',
            'user_id' => 'User ID',
            'admin_id' => 'Admin ID',
            'qty' => 'Qty',
            'at' => 'At',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(User::className(), ['id' => 'admin_id']);
    }

    /**
     * Gets query for [[Buku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuku()
    {
        return $this->hasOne(Buku::className(), ['id' => 'buku_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            $buku = Buku::find()->where(['id' => $this->buku_id])->one();
            $buku->stok = (int) $buku->stok + (int) $this->qty;
            $buku->update();
        }
        return parent::afterSave($insert,$changedAttributes);
    }

    public function afterDelete()
    {
        $buku = Buku::find()->where(['id' => $this->buku_id])->one();
        $buku->stok = (int) $buku->stok - (int) $this->qty;
        $buku->update();
        return parent::afterDelete();   
    }
}
