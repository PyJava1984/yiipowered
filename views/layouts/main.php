<?php
use app\models\Project;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - YiiPowered</title>
    <link rel="alternate" type="application/rss+xml" title="YiiPowered" href="<?= \yii\helpers\Url::to(['project/rss'], true)?>"/>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> YiiPowered',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $menuItems = [
                '<form id="searchbox_006237035567373325440:lmymu4nwvsa" action="http://www.google.com/search" class="navbar-form navbar-left">
                    <fieldset class="form-group">
                        <input id="search_input" name="q" type="text" size="20" maxlength="256" class="form-control" placeholder="Search for...">
                        <input type="hidden" name="cx" value="FILL_ME">
                        <input type="hidden" name="cof" value="FORID:0">
                    </fieldset>
                </form>',
                ['label' => 'RSS', 'url' => ['/project/rss']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Project admin', 'url' => ['/project/admin', 'status' => Project::STATUS_PUBLISHED], 'visible'=> \Yii::$app->user->can('manageProjects')];
                $menuItems[] = ['label' => 'User admin', 'url' => ['/user/index'], 'visible'=> \Yii::$app->user->can('adminUsers')];
                $menuItems[] = ['label' => Yii::$app->user->identity->username, 'url' => ['/user/view', 'id' => \Yii::$app->user->id]];
                $menuItems[] = [
                    'label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            ?>

            <span class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-globe"></span> <b class="caret"></b></a>
                <?= \app\widgets\LanguageDropdown::widget() ?>
            </span>

            <?= yii\helpers\Html::a(Yii::t('project', 'Add project'), ['project/create'], ['class' => 'btn btn-success navbar-btn']) ?>

            <?php
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
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
            <p class="pull-left">
                &copy; YiiPowered <?= date('Y') ?> |
                <?= Html::a('About', ['/site/about']) ?>
            </p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
