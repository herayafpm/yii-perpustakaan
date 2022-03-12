<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class PeminjamanSearch extends Peminjaman
{
    // add the public attributes that will be used to store the data to be search
    public $judul;
    public $user_nama;
    public $admin_nama;

    // now set the rules to make those attributes safe
    public function rules()
    {
        return [
            [['id', 'qty'], 'integer'],
            [['judul','user_nama','admin_nama'], 'safe']
        ];
    }
    public function search($params)
    {
        // create ActiveQuery
        $query = Peminjaman::find();
        // Important: lets join the query with our previously mentioned relations
        // I do not make any other configuration like aliases or whatever, feel free
        // to investigate that your self
        $query->joinWith(['buku', 'user'])->leftJoin('user admin','peminjaman.admin_id = admin.id');
        $this->load($params);

        if(!\Yii::$app->user->can('admin')){
            $query->where(['user_id' => \Yii::$app->user->identity->id]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['id','judul','user_nama','admin_nama','qty','at']
            ]
        ]);

        $dataProvider->sort->attributes['judul'] = [
            'asc' => ['buku.judul' => SORT_ASC],
            'desc' => ['buku.judul' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_nama'] = [
            'asc' => ['user.nama' => SORT_ASC],
            'desc' => ['user.nama' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['admin_nama'] = [
            'asc' => ['admin.nama' => SORT_ASC],
            'desc' => ['admin.nama' => SORT_DESC],
        ];

        
        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // We have to do some search... Lets do some magic
        $query->andFilterWhere(['like', 'buku.judul', $this->judul])
            ->andFilterWhere(['like', 'user.nama', $this->user_nama])
            ->andFilterWhere(['like', 'admin.nama', $this->admin_nama]);

        return $dataProvider;
    }
}
