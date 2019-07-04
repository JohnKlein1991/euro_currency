<?php
/* @var $currency string */
/* @var $this \yii\web\View */
/* @var $updateButtonId string */
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->registerJsVar('updateButtonId', $updateButtonId);
$this->registerJsFile(
        '@web/js/modules/euro/index_view.js',
        [
                'depends' => 'yii\web\JqueryAsset'
        ]
);
?>
<div class="euro-default-index">
    <h1>Текущий курс евро</h1>

    <?php Pjax::begin();
    if(!$currency) : ?>
    <p>Данные уточняются</p>
    <?php else : ?>
    <p>
        1 EUR = <?=$currency?> RUB
    </p>
    <?php endif;?>
    <?= Html::a("Обновить", ['/euro/default/index'], [
        'class' => 'hidden',
        'id' => $updateButtonId,
    ]) ?>
    <?php
    Pjax::end();
    ?>
</div>