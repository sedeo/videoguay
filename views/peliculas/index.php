<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeliculasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peliculas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peliculas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dar de alta una pelicula', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alquilar pelicula', ['alquilar'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'titulo',
            'precio_alq:currency',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
