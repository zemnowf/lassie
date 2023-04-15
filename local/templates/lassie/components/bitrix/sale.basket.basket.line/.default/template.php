<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="header__basket">
    <div class="text">В вашей корзине</div>
    <a href="<?= $arParams["PATH_TO_BASKET"] ?>" class="link"><?= $arResult["NUM_PRODUCTS"] . " " .
        $arResult["DECLENSION"]?>
        на <?= $arResult["TOTAL_PRICE_RAW"] ?> руб.</a>
</div>