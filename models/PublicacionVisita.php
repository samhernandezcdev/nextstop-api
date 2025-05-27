<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion_visita".
 *
 * @property int $puv_id
 * @property string $puv_ip Para identificar visitas únicas
 * @property string $puv_fecha
 * @property int|null $puv_fkusuario
 * @property int $puv_fkpublicacion
 *
 * @property Publicacion $puvFkpublicacion
 * @property Usuario $puvFkusuario
 */
class PublicacionVisita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion_visita';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puv_ip', 'puv_fkpublicacion'], 'required'],
            [['puv_fecha'], 'safe'],
            [['puv_fkusuario', 'puv_fkpublicacion'], 'integer'],
            [['puv_ip'], 'string', 'max' => 45],
            [['puv_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['puv_fkpublicacion' => 'pub_id']],
            [['puv_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['puv_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'puv_id' => 'Puv ID',
            'puv_ip' => 'Para identificar visitas únicas',
            'puv_fecha' => 'Puv Fecha',
            'puv_fkusuario' => 'Puv Fkusuario',
            'puv_fkpublicacion' => 'Puv Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[PuvFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPuvFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'puv_fkpublicacion']);
    }

    /**
     * Gets query for [[PuvFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPuvFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'puv_fkusuario']);
    }
}
