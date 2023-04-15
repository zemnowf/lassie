<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>
<article class="good">
    <div class="good__content">
        <a href="<?= $item["DETAIL_PAGE_URL"] ?>" class="good__link">
            <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>"
                 id="<?= $itemIds["PICT"] ?>"
                 alt="Товар" class="good__img"
                 title="">
            <span class="flag flag_type_<?= $item["PROPERTIES"]["ATTR_LABEL"]["VALUE"] ?>">
                <?= $item["PROPERTIES"]["ATTR_LABEL"]["VALUE"] ?></span>
        </a><a href="javascript:void(0);" class="like">Мне нравится</a>
        <h4 class="good__name"><?= $item['NAME'] ?></h4>
        <div class="good__price-wrapper"><?
            if (!empty($price)) {
                ?>
                <?
                if ($price['PRINT_RATIO_PRICE'] < $price["PRINT_RATIO_BASE_PRICE"]) {
                    ?>
                    <span class="good__price good__price_new"><?= $price['PRINT_RATIO_PRICE']; ?></span><?
                    ?>
                    <span class="good__price good__price_old"><?= $price["PRINT_RATIO_BASE_PRICE"]; ?></span><?
                } else {
                    ?>
                    <span class="good__price"><?= $price['PRINT_RATIO_PRICE']; ?></span><?
                }
                ?><?
                if ($price['PERCENT'] > 0) {
                    ?>
                    <span class="good__discount">Скидка <?= $price['PERCENT'] ?>%</span>
                    <?
                }
            }
            ?></div>
    </div>
    <div class="good__hover">
        <form method="post" action="" class="form good__order">
            <div class="good__order-row">
                <? if (!empty($item["PROPERTIES"]["ATT_SIZE"]["VALUE_ENUM"])): ?>
                    <label class="good__order-label">Выберите размер</label>
                    <? foreach ($item["PROPERTIES"]["ATT_SIZE"]["VALUE_ENUM"] as $size): ?>
                        <div class="checkbox-tile">
                            <input id="good2-size<?= $size ?>" name="Good[size]" type="radio"
                                   value="<?= $size ?>"
                                   required
                                   class="checkbox-tile__elem">
                            <label for="good2-size<?= $size ?>"
                                   class="checkbox-tile__label"><?= $size ?></label>
                        </div>
                    <? endforeach;
                endif; ?>
            </div>
            <div class="good__order-row product-item-hidden" data-entity="quantity-block">
                <label for="<?= $itemIds["QUANTITY"] ?>" class="good__order-label">Количество</label>
                <div class="input-number">
                    <input id="<?= $itemIds["QUANTITY"] ?>" name="<?= $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                           type="number" value="<?= $measureRatio ?>" class="input-number__elem">
                    <div class="input-number__counter"><span id="<?= $itemIds["QUANTITY_UP"] ?>"
                                                             class="input-number__counter-spin input-number__counter-spin_more">Больше</span><span
                                id="<?= $itemIds["QUANTITY_DOWN"] ?>"
                                class="input-number__counter-spin input-number__counter-spin_less">Меньше</span>
                    </div>
                </div>
            </div>
            <div id="<?= $itemIds["BASKET_ACTIONS"] ?>">
                <button id="<?= $itemIds["BUY_LINK"] ?>" type="submit" class="btn">Добавить в корзину</button>
            </div>
        </form>
    </div>
    <?
    if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
            if ($blockName == 'sku') {
                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
                    foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                        if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']])) {
                            continue;
                        }
                        $skuProps[] = array(
                            'ID' => $skuProperty['ID'],
                            'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                            'VALUES' => $skuProperty['VALUES'],
                            'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                        );
                    }
                    unset($skuProperty, $value);
                    if ($item['OFFERS_PROPS_DISPLAY']) {
                        foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer) {
                            $strProps = '';

                            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty) {
                                    $strProps .= '<dt>' . $displayProperty['NAME'] . '</dt><dd>' . (is_array($displayProperty['VALUE']) ? implode(' / ',
                                            $displayProperty['VALUE']) : $displayProperty['VALUE']) . '</dd>';
                                }
                            }
                            $item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                        }
                        unset($jsOffer, $strProps);
                    }
                }
                break;
            }
        }
    }
    ?>
</article>

