<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion".
 *
 * @property int $pub_id
 * @property string $pub_titulo
 * @property string|null $pub_descripcion
 * @property int $pub_estatus 0=Inactivo, 1=Activo
 * @property string $pub_fecha
 * @property int $pub_fklugar
 * @property int $pub_fkusuario
 *
 * @property Comentario[] $comentarios
 * @property Etiqueta[] $etiquetas
 * @property ImagenPublicacion[] $imagenPublicacions
 * @property Lugar $pubFklugar
 * @property Usuario $pubFkusuario
 * @property PublicacionVisita[] $publicacionVisitas
 * @property VotoPublicacion[] $votoPublicacions
 */
class Publicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pub_descripcion'], 'string'],
            [['pub_estatus', 'pub_fklugar', 'pub_fkusuario'], 'integer'],
            [['pub_fecha', 'pub_fklugar', 'pub_fkusuario'], 'required'],
            [['pub_fecha'], 'safe'],
            [['pub_titulo'], 'string', 'max' => 100],
            [['pub_fklugar'], 'exist', 'skipOnError' => true, 'targetClass' => Lugar::class, 'targetAttribute' => ['pub_fklugar' => 'lug_id']],
            [['pub_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['pub_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_id' => 'Pub ID',
            'pub_titulo' => 'Pub Titulo',
            'pub_descripcion' => 'Pub Descripcion',
            'pub_estatus' => '0=Inactivo, 1=Activo',
            'pub_fecha' => 'Pub Fecha',
            'pub_fklugar' => 'Pub Fklugar',
            'pub_fkusuario' => 'Pub Fkusuario',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['com_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[Etiquetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetas()
    {
        return $this->hasMany(Etiqueta::class, ['eti_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[ImagenPublicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagenPublicacions()
    {
        return $this->hasMany(ImagenPublicacion::class, ['imp_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PubFklugar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFklugar()
    {
        return $this->hasOne(Lugar::class, ['lug_id' => 'pub_fklugar']);
    }

    /**
     * Gets query for [[PubFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'pub_fkusuario']);
    }

    /**
     * Gets query for [[PublicacionVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionVisitas()
    {
        return $this->hasMany(PublicacionVisita::class, ['puv_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[VotoPublicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotoPublicacions()
    {
        return $this->hasMany(VotoPublicacion::class, ['vop_fkpublicacion' => 'pub_id']);
    }
}
