<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peliculas */

$this->title = 'Dar de alta una pelicula';
$this->params['breadcrumbs'][] = ['label' => 'Peliculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peliculas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
