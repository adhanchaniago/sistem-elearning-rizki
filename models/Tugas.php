<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tugas".
 *
 * @property int $id_tugas
 * @property int $id_mapel
 * @property string $nama_tugas
 * @property string $tanggal_upload
 * @property string $nama_file
 *
 * @property MataPelajaran $tugas
 * @property TugasDetail[] $tugasDetails
 */
class Tugas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tugas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mapel', 'nama_tugas', 'tanggal_upload', 'nama_file'], 'required'],
            [['id_mapel'], 'integer'],
            [['tanggal_upload'], 'safe'],
            [['nama_tugas'], 'string', 'max' => 50],
            [['nama_file'], 'string', 'max' => 25],
            [['id_tugas'], 'exist', 'skipOnError' => true, 'targetClass' => MataPelajaran::className(), 'targetAttribute' => ['id_tugas' => 'id_mapel']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tugas' => 'Id Tugas',
            'id_mapel' => 'Id Mapel',
            'nama_tugas' => 'Nama Tugas',
            'tanggal_upload' => 'Tanggal Upload',
            'nama_file' => 'Nama File',
        ];
    }

    /**
     * Gets query for [[Tugas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTugas()
    {
        return $this->hasOne(MataPelajaran::className(), ['id_mapel' => 'id_tugas']);
    }

    /**
     * Gets query for [[TugasDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTugasDetails()
    {
        return $this->hasMany(TugasDetail::className(), ['id_tugas' => 'id_tugas']);
    }
}
