<?php

namespace app\models;

use yii\base\Model;

class GestionarSociosForm extends Model
{
    /**
     * El numero del socio.
     * @var string
     */
    public $numero;

    public function formName()
    {
        return '';
    }

    public function attributeLabels()
    {
        return [
            'numero' => 'Número de socio',
        ];
    }

    public function rules()
    {
        return [
            [['numero'], 'required'],
            [['numero'], 'default'],
            [['numero'], 'number'],
            [
                ['numero'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Socios::className(),
                'targetAttribute' => ['numero' => 'numero'],
            ],
        ];
    }
}
