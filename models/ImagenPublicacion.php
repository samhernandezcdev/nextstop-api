<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen_publicacion".
 *
 * @property int $imp_id
 * @property string $imp_path
 * @property int $imp_fkpublicacion
 *
 * @property Publicacion $impFkpublicacion
 */
class ImagenPublicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagen_publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imp_path', 'imp_fkpublicacion'], 'required'],
            [['imp_fkpublicacion'], 'integer'],
            [['imp_path'], 'string', 'max' => 255],
            [['imp_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['imp_fkpublicacion' => 'pub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imp_id' => 'Imp ID',
            'imp_path' => 'Imp Path',
            'imp_fkpublicacion' => 'Imp Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[ImpFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImpFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'imp_fkpublicacion']);
    }
}
