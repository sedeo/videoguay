<?php

namespace app\models;

/**
 * This is the model class for table "peliculas".
 *
 * @property int $id
 * @property string $codigo
 * @property string $titulo
 * @property string $precio_alq
 *
 * @property Alquileres[] $alquileres
 */
class Peliculas extends \yii\db\ActiveRecord
{
    public $todo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peliculas';
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['todo']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'titulo', 'precio_alq'], 'required'],
            [['codigo', 'precio_alq'], 'number'],
            [['titulo'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código',
            'titulo' => 'Título',
            'precio_alq' => 'Precio de alquiler',
            'todo' => 'Todo',
        ];
    }

    /**
     * Comprueba si una pelicula esta alquilada.
     * @return bool Si esta alquilada o no
     */
    public function getEstaAlquilada()
    {
        return $this->getAlquileres()
            ->where(['devolucion' => null])
            ->exists();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlquileres()
    {
        return $this->hasMany(Alquileres::className(), ['pelicula_id' => 'id'])->inverseOf('pelicula');
    }

    public function getSocios()
    {
        return $this->hasMany(Socios::className(), ['id' => 'socio_id'])
            ->via('alquileres');
    }
}
