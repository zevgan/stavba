<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Platce */

$this->title = Yii::t('app', 'Přidat Plátce');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plátce'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platce-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
