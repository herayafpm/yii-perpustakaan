<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buku".
 *
 * @property int $id
 * @property string|null $judul
 * @property string|null $pengarang
 * @property int|null $tahun_terbit
 * @property int|null $stok
 *
 * @property Peminjaman[] $peminjamen
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_terbit', 'stok'], 'integer'],
            [['judul', 'pengarang'], 'string', 'max' => 255],
            [['judul', 'pengarang','tahun_terbit','stok'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'pengarang' => 'Pengarang',
            'tahun_terbit' => 'Tahun Terbit',
            'stok' => 'Stok',
        ];
    }

    /**
     * Gets query for [[Peminjaman]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeminjaman()
    {
        return $this->hasMany(Peminjaman::className(), ['buku_id' => 'id']);
    }
}
