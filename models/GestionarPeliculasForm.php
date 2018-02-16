<?php

namespace app\models;

use yii\base\Model;

class GestionarPeliculasForm extends Model
{
    /**
     * El numero del socio.
     * @var string
     */
    public $numero;

    /**
     * El codigo de la pelicula.
     * @var string
     */
    public $codigo;

    public function formName()
    {
        return '';
    }

    public function attributeLabels()
    {
        return [
            'numero' => 'Número de socio',
            'codigo' => 'Código de película',
        ];
    }

    public function rules()
    {
        return [
            [['numero', 'codigo'], 'required'],
            [['numero', 'codigo'], 'default'],
            [['numero', 'codigo'], 'number'],
            [
                ['numero'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Socios::className(),
                'targetAttribute' => ['numero' => 'numero'],
            ],
            [
                ['codigo'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Peliculas::className(),
                'targetAttribute' => ['codigo' => 'codigo'],
            ],
        ];
    }
}
