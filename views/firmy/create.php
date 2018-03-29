<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Firmy */

$this->title = Yii::t('app', 'Přidat Firmu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firmy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firmy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
