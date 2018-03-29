<?php

use yii\helpers\Html;

use yii\widgets\Pjax;
use app\models\Firmy;
use app\models\ZpusobyPlatby;
use app\models\Platce;
use app\models\Faktury;
use app\models\DetailPlatby;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\widgets\ColorInput;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;
use kartik\field\FieldRange;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FakturySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faktury');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .container {width:1500px !important;margin:0 auto;}
    #w0-container {overflow:hidden;}
    </style>
</style>
<div class="faktury-index">

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]);
   // die();
    ?>

    <p>
        <?
         //Html::a(Yii::t('app', 'Přidat fakturu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
           <?
 $searchModel->datum_platby=date("01.m.Y")." - ".date("t.m.Y");

//die(print_r($searchModel->detaily, true));
//$searchModel->detaily='';
 ?>
    <?=


    GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'dataProvider' => $dataProvider,

        'filterModel' => $searchModel,
 'toolbar' =>  [
        ['content' =>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'Přidat fakturu', 'class' => 'btn btn-success', 'onclick' => 'window.location.href = "/stavba/web/faktury/create";']) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Obnovit'])
        ],
        '{export}',
        '{toggleData}',
    ],
    'export' => [
       // 'fontAwesome' => true
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'Faktury',
    ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'pageSummary'=>false,],

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'spolecnost',
                'pageSummary'=>false,
                'label'=>'Společnost',
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },


                'content'=>function($data){
                    return $data->getSpolecnostName();
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data'=>Firmy::getFirmyList(), // any list of values
                        'options' => ['class'=>'form-control', 'prompt'=>'Vyberte firmu...'],


                    ];
                },

'filterType'=>GridView::FILTER_SELECT2,
                 'filterWidgetOptions'=>[
                 'data' => Firmy::getFirmyList(),
                  'language' => 'cs',
                    'pluginOptions' => [
                    'language' => 'cs',
                    'tags' => true,
                    "multiple"=>"true",
                    "allowClear"=>"true",
                    ]],



            ],


            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'datum_zp',
                'width'=>'100px',
                'pageSummary'=>false,
                'format' => ['date', 'php:d.m.Y'],
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },



                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_WIDGET,
                        'size'=>'md',

                        'widgetClass'=> 'kartik\datecontrol\DateControl',
                        'options'=>[
                            'type'=>DateControl::FORMAT_DATE,
                            //'ajaxConversion'=>false,
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]


                    ];
                },

  'filterType'=>GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions'=>[
                    'pluginOptions' => [
                    'ranges'=>[
    "Dnes" => ["moment().startOf('day')", "moment()"],
    "Včera" => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
    'Vše' => ["moment().startOf('year')", "moment()"],
    'Poslední 30 dni' => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
    "Tento měsíc" => ["moment().startOf('month')", "moment().endOf('month')"],
    "Předchozí měsíc" => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
],
                    'locale' => [
                'cancelLabel' => 'Zavřit',
                'applyLabel'=> 'Použit',
                'customRangeLabel'=> 'Zvolte rozmezí',
                'format' => 'DD.MM.YYYY',
        ],

                       'autoUpdateInput' => false,

                    ]
                ],

            ],

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'datum_platby',
                'width'=>'100px',

                'pageSummary'=>false,
                'format' => ['date', 'php:d.m.Y'],
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },



                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_WIDGET,
                        'size'=>'md',

                        'widgetClass'=> 'kartik\datecontrol\DateControl',
                        'options'=>[
                            'type'=>DateControl::FORMAT_DATE,
                            //'ajaxConversion'=>false,
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]


                    ];
                },
                'filterType'=>GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions'=>[
'value'=>'10.03.2018',
                    'pluginOptions' => [

                    'ranges'=>[
    "Dnes" => ["moment().startOf('day')", "moment()"],
    "Včera" => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
   'Vše' => ["moment().startOf('year')", "moment()"],
    'Poslední 30 dni' => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
    "Tento měsíc" => ["moment().startOf('month')", "moment().endOf('month')"],
    "Předchozí měsíc" => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
],
                    'locale' => [
                'cancelLabel' => 'Zavřit',
                'applyLabel'=> 'Použit',
                'customRangeLabel'=> 'Zvolte rozmezí',
                'format' => 'DD.MM.YYYY',
        ],

                       'autoUpdateInput' => false,

                    ]
                ],

            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'zpusob_platby',
                'pageSummary'=>false,
                'label'=>'Způsob platby',
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },


                'content'=>function($data){
                    return $data->getZpusobPlatbyName();
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data'=>ZpusobyPlatby::getZpusobyPlatbyList(), // any list of values
                        'options' => ['class'=>'form-control', 'prompt'=>'Vyberte způsob...'],


                    ];
                },


                 'filterType'=>GridView::FILTER_SELECT2,
                 'filterWidgetOptions'=>[
                 'data' => ZpusobyPlatby::getZpusobyPlatbyList(),
                  'language' => 'cs',
                    'pluginOptions' => [
                    'language' => 'cs',
                    'tags' => true,
                    "multiple"=>"true",
                    "allowClear"=>"true",
                    ]],

            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'platce',
                'pageSummary'=>false,
                'label'=>'Plátce',
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },
                'content'=>function($data){
                    return $data->getPlatceName();
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data'=>Platce::getPlatceList(), // any list of values
                        'options' => ['class'=>'form-control', 'prompt'=>'Vyberte Plátce...'],
                    ];
                },


                                 'filterType'=>GridView::FILTER_SELECT2,
                 'filterWidgetOptions'=>[
                 'data' => Platce::getPlatceList(),
                  'language' => 'cs',
                    'pluginOptions' => [
                    'language' => 'cs',
                    'tags' => true,
                    "multiple"=>"true",
                    "allowClear"=>"true",
                    ]],



            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'detaily_ids',
                'pageSummary'=>false,
                'label'=>'Detaily Platby',
                'contentOptions' =>function ($model, $key, $index, $column){
                    return ['class' => 'name'];
                },
                'content'=>function($data){

                   return $data->getDetailyNames();
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [

                        'format' => Editable::FORMAT_LINK,
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data'=>DetailPlatby::getDetailPlatbyList(), // any list of values

                        'options' => ['class'=>'form-control', 'multiple'=>'true', 'prompt'=>'Vyberte Detail...'],
                    ];
                },


                 'filterType'=>GridView::FILTER_SELECT2,
                 'filterWidgetOptions'=>[
                 'data' => DetailPlatby::getDetailPlatbyList(),
                  'language' => 'cs',
                    'pluginOptions' => [
                    'language' => 'cs',
                    'tags' => true,
                    "multiple"=>"true",
                    "allowClear"=>"true",
                    ]],


            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'bez_dph',
                'pageSummary'=>true,
               'format'=>['decimal',2],
                 'filter'=>false,
                                                            'editableOptions'=> function ($model, $key, $index) {
                        return [
                           'pluginEvents'=>[
                     "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#w0-container'}); }",
    ]

                        ];
                    }
      
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'dph',
                'pageSummary'=>true,
               'format'=>['decimal',2],
                 'filter'=>false,
                                           'editableOptions'=> function ($model, $key, $index) {
                        return [
                           'pluginEvents'=>[
                     "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#w0-container'}); }",
    ]

                        ];
                    }
            ],
            [
               // 'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'vc_dph',
                'pageSummary'=>true,
              'format'=>['decimal',2],
                'filter'=>false,



            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'poznamka',
                'width'=>'170px',
                'pageSummary'=>false,
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Poznámka',
                        'size'=>'md'

                    ];
                }
            ],


            ['class' => '\kartik\grid\ActionColumn',
                'template'=>'{delete}',
                'pageSummary'=>false,
                'width'=>'10px',

            ],

        ],
      'showPageSummary' => true,

    ]);






    ?>
    <?php Pjax::end(); ?>
<?

/*
foreach (Faktury::find()
    ->where(['id' => 53])
    ->one()->detaily as $d) {
    echo $d->nazev_platby;
    }
//echo var_export( Faktury::getDetaily(), true);


/*

        $faktury = Faktury::findAll(53);
       // $detaily = DetailPlatby::findAll();

        foreach($faktury as $faktura)
        {
            echo $faktura->id . " has " . count($faktura->detaily) . " details. They are:<br />";
            foreach($faktura->detaily as $detail)
            {
                echo $detail->nazev . "<br />";
            }
            echo "<br />";
        }

        echo "<hr />";
*/
//echo defined('INTL_ICU_VERSION') ? INTL_ICU_VERSION : 'no ICU';
 ?>
</div>
