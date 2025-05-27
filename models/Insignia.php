<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insignia".
 *
 * @property int $ins_id
 * @property string $ins_nombre
 * @property string|null $ins_descripcion
 * @property string|null $ins_criterio Ej: {"visitas_minimas": 10}
 * @property string $ins_fecha
 */
class Insignia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insignia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ins_nombre', 'ins_fecha'], 'required'],
            [['ins_criterio', 'ins_fecha'], 'safe'],
            [['ins_nombre'], 'string', 'max' => 15],
            [['ins_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ins_id' => 'Ins ID',
            'ins_nombre' => 'Ins Nombre',
            'ins_descripcion' => 'Ins Descripcion',
            'ins_criterio' => 'Ej: {\"visitas_minimas\": 10}',
            'ins_fecha' => 'Ins Fecha',
        ];
    }
}
