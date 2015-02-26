<?php
/**
 * @var $this yii\web\View
 * @var self yii\web\View
 * @var $content string
 */
$this->beginPage();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <?php $this->head();?>
</head>
<body data-ng-app="app" ng-controller="appCtrl" init-page window-resize>
    <?php $this->beginBody();?>

    <div class="main-wrap" role="main">
        <?php echo $content;?>
    </div>

    <?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>