<?php 
/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column h-100">
<?php 
// NavBar::begin([
//     'brandLabel' => Yii::$app->name,
//     'brandImage' => Yii::getAlias('@web/images/logos/Logo-1x1.png'),
//     'brandUrl' => ['/system/default'],
//     'options' => ['class' => 'navbar navbar-expand-sm navbar-light bg-light'],
//     'innerContainerOptions' => ['class' => 'container-fluid'],
// ]);
//     echo Nav::widget([
//         'options' => ['class' => 'navbar-nav me-auto mb-2 mb-sm-0'],
//         'items' => Yii::$app->params['menus']['top_left'],
//         'encodeLabels' => false,
//     ]);
//     echo Nav::widget([
//         'options' => ['class' => 'navbar-nav me-right mb-2 mb-sm-0'],
//         'items' => Yii::$app->params['menus']['top_right'],
//         'encodeLabels' => false,
//     ]);
// NavBar::end();
?>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-auto bg-light sticky-top">
                <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                    <a href="<?= Url::toRoute(['/']) ?>" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <!-- <i class="bi-bootstrap fs-1"></i> -->
                        <img class="img-fluid" width="45px" src="<?= Yii::getAlias('@web/images/logos/Logo-1x1.png') ?>" />
                    </a>
                    <?php 
                        echo Nav::widget([
                            'options' => ['class' => 'nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center justify-content-between w-100 px-3 align-items-center'],
                            // 'items' => Yii::$app->params['menus']['admin'],
                            'encodeLabels' => false,
                        ]);
                    ?>
                </div>
            </div>
            <div class="col-sm p-3 min-vh-100">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <div class="bg-light rounded-3 mt-3 pb-1 p-3 mb-2">
                        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                    </div>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</main>
<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; PACMEC <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?php // = Yii::powered() ?>Powered by FelipheGomez</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>