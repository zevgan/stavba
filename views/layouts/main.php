<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use webvimark\modules\UserManagement\models\User;


use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    
    $adminMenu=[
        'label' => 'Administrace',
        'items' => [




        ],
    ];

    if (User::hasRole(['Fakturacni'])) {
        $adminMenu['items'][] = '<li class="dropdown-header">Administrace faktur</li>';
            $adminMenu['items'][] = ['label' => 'Firmy dodavatele', 'url' => ['/firmy']];
            $adminMenu['items'][] = ['label' => 'Způsoby platby', 'url' => ['/zpusoby-platby']];
            $adminMenu['items'][] = ['label' => 'Plátce', 'url' => ['/platce']];
            $adminMenu['items'][] = ['label' => 'Detail platby', 'url' => ['/detail-platby']];
           $adminMenu['items'][] =  '<li class="divider"></li>';

    }
    
    if (User::hasRole(['Admin'])) {
        $adminMenu['items'][] = '<li class="dropdown-header">Administrace uživatelů</li>';
             $adminMenu['items'][]=['label' => 'Uživatele', 'url' => ['/user-management/user/index']];
            $adminMenu['items'][]= ['label' => 'Role', 'url' => ['/user-management/role/index']];
             $adminMenu['items'][]=['label' => 'Práva', 'url' => ['/user-management/permission/index']];
             $adminMenu['items'][]=['label' => 'Grupy', 'url' => ['/user-management/auth-item-group/index']];
             $adminMenu['items'][]=['label' => 'Access log', 'url' => ['/user-management/user-visit-log/index']];
            }
    
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Faktury', 'url' => ['/faktury']],
            $adminMenu,


            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username.')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);


/*
    echo GhostMenu::widget([
        'encodeLabels'=>false,
        'activateParents'=>true,
        'items' => [

            [
                'label' => 'Frontend routes',
                'items'=>[
                    ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                    ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                    ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                    ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                    ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                    ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
                ],
            ],
        ],
    ]);
*/

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Kalikova.com <?= date('Y') ?></p>

        <p class="pull-right">Designed by Zevgan</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
