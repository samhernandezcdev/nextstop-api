<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiqueta".
 *
 * @property int $eti_id
 * @property string $eti_nombre
 * @property string $eti_fecha
 * @property int $eti_fkpublicacion
 *
 * @property Publicacion $etiFkpublicacion
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiqueta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eti_nombre', 'eti_fecha', 'eti_fkpublicacion'], 'required'],
            [['eti_fecha'], 'safe'],
            [['eti_fkpublicacion'], 'integer'],
            [['eti_nombre'], 'string', 'max' => 100],
            [['eti_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['eti_fkpublicacion' => 'pub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'eti_id' => 'Eti ID',
            'eti_nombre' => 'Eti Nombre',
            'eti_fecha' => 'Eti Fecha',
            'eti_fkpublicacion' => 'Eti Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[EtiFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtiFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'eti_fkpublicacion']);
    }
}
