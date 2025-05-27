<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voto_comentario".
 *
 * @property int $voc_fkusuario
 * @property int $voc_fkcomentario
 * @property string $voc_fecha
 *
 * @property Comentario $vocFkcomentario
 * @property Usuario $vocFkusuario
 */
class VotoComentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voto_comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voc_fkusuario', 'voc_fkcomentario', 'voc_fecha'], 'required'],
            [['voc_fkusuario', 'voc_fkcomentario'], 'integer'],
            [['voc_fecha'], 'safe'],
            [['voc_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['voc_fkcomentario' => 'com_id']],
            [['voc_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['voc_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'voc_fkusuario' => 'Voc Fkusuario',
            'voc_fkcomentario' => 'Voc Fkcomentario',
            'voc_fecha' => 'Voc Fecha',
        ];
    }

    /**
     * Gets query for [[VocFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVocFkcomentario()
    {
        return $this->hasOne(Comentario::class, ['com_id' => 'voc_fkcomentario']);
    }

    /**
     * Gets query for [[VocFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVocFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'voc_fkusuario']);
    }
}
