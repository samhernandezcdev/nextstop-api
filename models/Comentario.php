<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $com_id
 * @property string $com_contenido
 * @property int $com_estatus 0=Inactivo, 1=Activo
 * @property string $com_fecha
 * @property int $com_fkusuario
 * @property int $com_fkpublicacion
 *
 * @property Publicacion $comFkpublicacion
 * @property Usuario $comFkusuario
 * @property VotoComentario[] $votoComentarios
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_contenido', 'com_fecha', 'com_fkusuario', 'com_fkpublicacion'], 'required'],
            [['com_contenido'], 'string'],
            [['com_estatus', 'com_fkusuario', 'com_fkpublicacion'], 'integer'],
            [['com_fecha'], 'safe'],
            [['com_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['com_fkpublicacion' => 'pub_id']],
            [['com_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['com_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_contenido' => 'Com Contenido',
            'com_estatus' => '0=Inactivo, 1=Activo',
            'com_fecha' => 'Com Fecha',
            'com_fkusuario' => 'Com Fkusuario',
            'com_fkpublicacion' => 'Com Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[ComFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'com_fkpublicacion']);
    }

    /**
     * Gets query for [[ComFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'com_fkusuario']);
    }

    /**
     * Gets query for [[VotoComentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotoComentarios()
    {
        return $this->hasMany(VotoComentario::class, ['voc_fkcomentario' => 'com_id']);
    }
}
