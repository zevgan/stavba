<?php
use yii\helpers\Html;

use yii\widgets\Pjax;
use app\models\Firmy;
use app\models\ZpusobyPlatby;
use app\models\Platce;
use app\models\DetailPlatby;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\widgets\ColorInput;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;
use kartik\field\FieldRange;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPlatbySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Detaily Platby');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-platby-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Přidat Detail Platby'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nazev_platby',
                'pageSummary'=>true,
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Název platby',
                        'size'=>'md'

                    ];
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}',],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
