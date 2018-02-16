<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Alquileres */

$this->title = 'Alquiler #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alquileres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alquileres-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'socio_id',
            'pelicula_id',
            'created_at:datetime',
            'devolucion:datetime',
        ],
    ]) ?>

</div>
