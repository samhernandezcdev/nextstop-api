<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usu_id
 * @property string $usu_nombre
 * @property string $usu_apellido
 * @property string $usu_correo
 * @property string $usu_clave
 * @property string $usu_biografia
 * @property string $usu_foto
 * @property int $usu_estatus 0=Inactivo, 1=Activo
 * @property string $usu_fecha
 *
 * @property Comentario[] $comentarios
 * @property PublicacionVisita[] $publicacionVisitas
 * @property Publicacion[] $publicacions
 * @property VotoComentario[] $votoComentarios
 * @property VotoPublicacion[] $votoPublicacions
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_biografia', 'usu_foto', 'usu_fecha'], 'required'],
            [['usu_biografia'], 'string'],
            [['usu_estatus'], 'integer'],
            [['usu_fecha'], 'safe'],
            [['usu_nombre', 'usu_apellido'], 'string', 'max' => 30],
            [['usu_correo', 'usu_clave', 'usu_foto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => 'Usu ID',
            'usu_nombre' => 'Usu Nombre',
            'usu_apellido' => 'Usu Apellido',
            'usu_correo' => 'Usu Correo',
            'usu_clave' => 'Usu Clave',
            'usu_biografia' => 'Usu Biografia',
            'usu_foto' => 'Usu Foto',
            'usu_estatus' => '0=Inactivo, 1=Activo',
            'usu_fecha' => 'Usu Fecha',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['com_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[PublicacionVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionVisitas()
    {
        return $this->hasMany(PublicacionVisita::class, ['puv_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Publicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicacion::class, ['pub_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[VotoComentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotoComentarios()
    {
        return $this->hasMany(VotoComentario::class, ['voc_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[VotoPublicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotoPublicacions()
    {
        return $this->hasMany(VotoPublicacion::class, ['vop_fkusuario' => 'usu_id']);
    }
}
