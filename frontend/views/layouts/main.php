<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<?php 
if (!empty(Yii::$app->params['menus']['top_left']) || !empty(Yii::$app->params['menus']['top_right'])) {

    NavBar::begin([
        // 'brandLabel' => Yii::$app->name,
        // 'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-sm navbar-light bg-light'],
        'innerContainerOptions' => ['class' => 'container-fluid'],
    ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-sm-0'],
            'items' => Yii::$app->params['menus']['top_left'],
            'encodeLabels' => false,
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-right mb-2 mb-sm-0'],
            'items' => Yii::$app->params['menus']['top_right'],
            'encodeLabels' => false,
        ]);
    NavBar::end();
}
?>
<header class="px-0 border-bottom"> 
    <div class="container-fluid px-3">
        <?php 
            NavBar::begin([
                // 'brandLabel' => Yii::$app->name,
                'brandLabel' => Html::img(Yii::getAlias($menus->top_primary->brand_image ?? '@web/images/logos/Logo-header.png'), ['alt'=>Yii::$app->name, 'height' => '32', 'class' => 'me-2']),
                // 'brandImage' => Yii::getAlias('@web/images/logos/Logo-header.png'),
                'brandUrl' => $menus->top_primary->brand_url ?? Yii::$app->homeUrl,
                'options' => ['class' => 'navbar navbar-expand-md bg-body-white rounded'],
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'brandOptions' => ['class' => 'bi me-2'],
            ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'],
                    'items' => array_map(function($model) {
                        $item = [
                            'label' => $model->label,
                            'url' => Url::toRoute($model->url),
                        ];
                        return $item;
                    }, Yii::$app->params['menus']['top_primary']->items ?? []),
                    'encodeLabels' => false,
                ]);
                
                if (!Yii::$app->user->isGuest) {
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav me-right mb-2 mb-lg-0'],
                        'items' => [
                            [
                                'label' => '<img src="'.Yii::$app->user->identity->avatarUrl.'" alt="mdo" width="32" height="32" class="rounded-circle"> ' . Yii::$app->user->identity->username,
                                'url' => ['/site/index'],
                                'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                                'items' => array_merge(isset(Yii::$app->params['menus']['my_account']->items) ? array_map(function($model) {
                                    $item = [
                                        'label' => $model->label,
                                        'url' => Url::toRoute($model->url),
                                    ];
                                    return $item;
                                }, Yii::$app->params['menus']['my_account']->items) : [], [
                                    '<hr class="dropdown-divider">',
                                        Html::beginForm(['/site/logout'])
                                        . Html::submitButton(
                                            'Cerrar sesion',
                                            ['class' => 'dropdown-item']
                                        )
                                        . Html::endForm()
                                ])
                            ],
                            Yii::$app->user->can('admin') ? [
                                'label' => '<i class="bi bi-gear-wide-connected"></i> AdminPanel',
                                'url' => ['/admin'],
                                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                                // 'items' => Yii::$app->params['menus']['admin']
                            ] : '',
                        ],
                        'encodeLabels' => false,
                    ]);
                }
            NavBar::end();
        ?>
    </div>

    <?php 
        if (!empty(Yii::$app->params['menus']['top_secondary']) || Yii::$app->user->isGuest) {
            NavBar::begin([
                // 'brandLabel' => Yii::$app->name,
                // 'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar navbar-expand-md navbar-dark bg-dark'],
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'brandOptions' => ['class' => 'bi me-2'],
            ]);
            
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-sm-0'],
                    'items' => Yii::$app->params['menus']['top_secondary'] ?? [],
                    'encodeLabels' => false,
                ]);
                
                if (Yii::$app->user->isGuest) {
                    echo '<div class="text-end">';
                        echo '<a href="'.Url::toRoute(['/site/login']).'" class="btn btn-light text-dark me-2">Ingresar</a>';
                        echo '<a href="'.Url::toRoute(['/site/signup']).'" class="btn btn-primary">Registrarte</a>';
                    echo '</div>';
                } else {
                    // echo '<form role="search">
                    //     <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    // </form>';
                }
    
            NavBar::end();
        }
    ?>
</header>



<!-- <header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header> -->

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
