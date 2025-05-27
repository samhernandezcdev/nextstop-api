<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voto_publicacion".
 *
 * @property int $vop_fkusuario
 * @property int $vop_fkpublicacion
 * @property string $vop_fecha
 *
 * @property Publicacion $vopFkpublicacion
 * @property Usuario $vopFkusuario
 */
class VotoPublicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voto_publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vop_fkusuario', 'vop_fkpublicacion', 'vop_fecha'], 'required'],
            [['vop_fkusuario', 'vop_fkpublicacion'], 'integer'],
            [['vop_fecha'], 'safe'],
            [['vop_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['vop_fkpublicacion' => 'pub_id']],
            [['vop_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['vop_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vop_fkusuario' => 'Vop Fkusuario',
            'vop_fkpublicacion' => 'Vop Fkpublicacion',
            'vop_fecha' => 'Vop Fecha',
        ];
    }

    /**
     * Gets query for [[VopFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVopFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'vop_fkpublicacion']);
    }

    /**
     * Gets query for [[VopFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVopFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'vop_fkusuario']);
    }
}
