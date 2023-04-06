<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

$arSkuTemplate = array();
if (is_array($arResult['SKU_PROPS'])) {

    foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps) {
        $arSkuTemplate[$iblockId] = array();

        foreach ($skuProps as & $arProp) {

            ob_start();
            if ('TEXT' == $arProp['SHOW_MODE']) {
                if (5 < $arProp['VALUES_COUNT']) {
                    $strClass = 'good__order-row';
                    $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                    $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                    $strSlideStyle = '';
                } else {
                    $strClass = 'good__order-row';
                    $strWidth = '100%';
                    $strOneWidth = '20%';
                    $strSlideStyle = 'display: none;';
                }
                ?>
            <div class="<?= $strClass; ?>" id="#ITEM#_prop_<?= $arProp['ID']; ?>_cont">
                <label class="good__order-label"><?= $arProp["NAME"] ?></label>
                <div id="#ITEM#_prop_<?= $arProp['ID']; ?>_list" style="width: <?= $strWidth; ?>;"><?

                    foreach ($arProp['VALUES'] as $arOneValue) {
                        ?>
                        <div class="checkbox-tile">
                            <input
                                    id="#ITEM#_prop_<?= $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                    name="Good[#ITEM#_prop_]"
                                    type="radio"
                                    data-treevalue="<?= $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                    data-onevalue="<?= $arOneValue['ID']; ?>"
                                    required=""
                                    class="checkbox-tile__elem"
                            >
                            <label
                                    for="#ITEM#_prop_<?= $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                    class="checkbox-tile__label"
                            ><?= htmlspecialcharsex($arOneValue['NAME']); ?></label>
                        </div>
                        <?
                    }

                    ?></div>
                <div class="bx_slide_left" id="#ITEM#_prop_<?= $arProp['ID']; ?>_left"
                     data-treevalue="<?= $arProp['ID']; ?>" style="<?= $strSlideStyle; ?>"></div>
                <div class="bx_slide_right" id="#ITEM#_prop_<?= $arProp['ID']; ?>_right"
                     data-treevalue="<?= $arProp['ID']; ?>" style="<?= $strSlideStyle; ?>"></div>

                </div><?
            }
            $arSkuTemplate[$iblockId][$arProp['CODE']] = ob_get_contents();
            ob_end_clean();
            unset($arProp);
        }
    }
}
?>

<ul class="goods">

    <? if (!empty($arResult['ITEMS'])):

        foreach ($arResult['ITEMS'] as $key => $arItem):

            $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);

            $arItemIDs = array(
                'ID' => $strMainID,
                'PICT' => $strMainID . '_pict',
                'SECOND_PICT' => $strMainID . '_secondpict',
                'MAIN_PROPS' => $strMainID . '_main_props',

                'QUANTITY' => $strMainID . '_quantity',
                'QUANTITY_DOWN' => $strMainID . '_quant_down',
                'QUANTITY_UP' => $strMainID . '_quant_up',
                'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                'BUY_LINK' => $strMainID . '_buy_link',
                'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                'PRICE' => $strMainID . '_price',
                'DSC_PERC' => $strMainID . '_dsc_perc',
                'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                'PROP_DIV' => $strMainID . '_sku_tree',
                'PROP' => $strMainID . '_prop_',
                'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
            );

            $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

            $strTitle = (isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem['NAME']);
            $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : ""; ?>
            <li class="goods__item" id="<?= $strMainID; ?>">
                <article class="good">
                    <div class="good__content">
                        <a id="<?= $arItemIDs['PICT']; ?>" href="<?= $arItem['DETAIL_PAGE_URL']; ?>"
                           class="good__link." title="<?= $strTitle; ?>"><?
                            if ($arParams['SHOW_IMAGE'] == "Y") {
                                ?><img
                                src="<?= ($arParams['SHOW_IMAGE'] == "Y" ? $arItem['PREVIEW_PICTURE']['SRC'] : ""); ?>"
                                alt="Товар" class="good__img" title=""><?
                            }
                            if ($arItem['PROPERTIES']['ATTR_LABEL']['VALUE']) {

                                ?><span class="flag flag_type_<?= $arItem['PROPERTIES']['ATTR_LABEL']['VALUE']; ?>"
                                        title="<?= $arItem['PROPERTIES']['ATTR_LABEL']['VALUE']; ?>">
                                <?= $arItem['PROPERTIES']['ATTR_LABEL']['VALUE']; ?></span><?
                            }

                            ?></a>
                        <a href="javascript:void(0);" class="like">Мне нравится</a><?
                        if ($arParams['SHOW_NAME'] == "Y") {
                            ?><h4 class="good__name"><?= $arItem['NAME']; ?></h4><?
                        } ?>
                        <div class="good__price-wrapper"><?
                            if (!empty($arItem['MIN_PRICE'])) {
                                ?>
                                <?
                                if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE']) {
                                    ?>
                                    <span class="good__price good__price_new"><?= $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></span><?
                                    ?>
                                    <span class="good__price good__price_old"><?= $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
                                } else {
                                    ?>
                                    <span class="good__price"><?= $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></span><?
                                }
                                ?><?
                                if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                                    if ($arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] > 0) {
                                        ?>
                                        <span class="good__discount">Скидка <?= $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ?>%</span>
                                        <?
                                    }
                                }
                            }
                            ?></div>
                    </div>
                    <div class="good__hover">
                        <form id="<?= $arItemIDs['BUY_LINK'] ?>" method="post" action="<?= $arItem['BUY_URL'] ?>">
                            <?

                            if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) { // Simple Product

                                ?>
                                <?
                                $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                            if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
                                ?>
                            <div id="<?= $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
                                <?
                                if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
                                    foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                        ?><input type="hidden"
                                                 name="<?= $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<?= $propID; ?>]"
                                                 value="<?= htmlspecialcharsbx($propInfo['ID']); ?>"><?
                                        if (isset($arItem['PRODUCT_PROPERTIES'][$propID])) {
                                            unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                                        }
                                    }
                                }
                                $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);

                                if (!$emptyProductProperties) {
                                    ?>
                                    <table>
                                        <?
                                        foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                            ?>
                                            <tr>
                                                <td><?= $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                <td>
                                                    <?
                                                    if ('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']) {
                                                        foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                            ?><label><input type="radio"
                                                                            name="<?= $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<?= $propID; ?>]"
                                                                            value="<?= $valueID; ?>" <?= ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><?= $value; ?>
                                                            </label><br><?
                                                        }
                                                    } else {
                                                        ?><select
                                                        name="<?= $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<?= $propID; ?>]"><?
                                                        foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                            ?>
                                                            <option
                                                            value="<?= $valueID; ?>" <?= ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><?= $value; ?></option><?
                                                        }
                                                        ?></select><?
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                        }
                                        ?>
                                    </table>
                                    <?
                                }
                                ?>
                            </div><?
                            }
                            $arJSParams = array(
                                'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                                'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                                'SHOW_ADD_BASKET_BTN' => false,
                                'SHOW_BUY_BTN' => true,
                                'SHOW_ABSENT' => true,
                                'PRODUCT' => array(
                                    'ID' => $arItem['ID'],
                                    'NAME' => $arItem['~NAME'],
                                    'PICT' => $arItem['PREVIEW_PICTURE'],
                                    'CAN_BUY' => $arItem["CAN_BUY"],
                                    'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                                    'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                                    'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                                    'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                                    'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                                    'ADD_URL' => $arItem['~ADD_URL'],
                                    'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
                                ),
                                'BASKET' => array(
                                    'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                                    'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                    'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                    'EMPTY_PROPS' => $emptyProductProperties
                                ),
                                'VISUAL' => array(
                                    'ID' => $arItemIDs['ID'],
                                    'PICT_ID' => $arItemIDs['PICT'],
                                    'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                                    'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                                    'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                                    'PRICE_ID' => $arItemIDs['PRICE'],
                                    'BUY_ID' => $arItemIDs['BUY_LINK'],
                                    'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
                                ),
                                'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                            );
                            ?>
                                <script type="text/javascript">
                                    var <?=$strObName; ?> =
                                        new JCCatalogSectionBest(<?=CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                                </script><?
                            }
                            else
                            { // Wth Sku

                            ?>
                            <? $arOffer = array();
                            foreach ($arItem["OFFERS"] as $offer) {
                                if ($offer["PROPERTIES"]["ATT_SIZE"]) {
                                    $arOffer[] = $offer["PROPERTIES"]["ATT_SIZE"]["VALUE"];
                                }
                            }

                            if (!empty($arOffer)) { ?>
                                <div class="good__order-row">
                                    <label class="good__order-label">Выберите размер</label>
                                    <? foreach ($arOffer as $size) { ?>
                                        <div class="checkbox-tile">
                                            <input id="good2-size<?= $size ?>" name="Good[size]" type="radio"
                                                   value="<?= $size ?>"
                                                   required
                                                   class="checkbox-tile__elem">
                                            <label for="good2-size<?= $size ?>"
                                                   class="checkbox-tile__label"><?= $size ?></label>
                                        </div>
                                    <? } ?>
                                </div>
                            <? } ?>
                                <div class="good__order" id="<?= $arItemIDs['PROP_DIV']; ?>"><?
                                    if (!empty($arItem['OFFERS']) && isset($arSkuTemplate[$arItem['IBLOCK_ID']])) {
                                        $arSkuProps = array();
                                        foreach ($arSkuTemplate[$arItem['IBLOCK_ID']] as $code => $strTemplate) {
                                            if (!isset($arItem['OFFERS_PROP'][$code])) {
                                                continue;
                                            }
                                            echo str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate);
                                        }

                                        if (isset($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']])) {
                                            foreach ($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']] as $arOneProp) {
                                                if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']])) {
                                                    continue;
                                                }
                                                $arSkuProps[] = array(
                                                    'ID' => $arOneProp['ID'],
                                                    'SHOW_MODE' => $arOneProp['SHOW_MODE'],
                                                    'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
                                                );
                                            }
                                        }
                                        foreach ($arItem['JS_OFFERS'] as & $arOneJs) {
                                            if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT']) {
                                                $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = GetMessage('SB_MESS_DIFF_PERCENT',
                                                    ['#DIFF#' => $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT']]);
                                            }
                                        }
                                        if ($arItem['OFFERS_PROPS_DISPLAY']) {
                                            foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer) {
                                                $strProps = '';
                                                if (!empty($arJSOffer['DISPLAY_PROPERTIES'])) {
                                                    foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp) {
                                                        $strProps .= '<br>' . $arOneProp['NAME'] . ' <strong>' . (is_array($arOneProp['VALUE']) ? implode(' / ',
                                                                $arOneProp['VALUE']) : $arOneProp['VALUE']) . '</strong>';
                                                    }
                                                }
                                                $arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                                            }
                                        }
                                    }
                                    if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) {
                                        ?>

                                        <div class="good__order-row">
                                        <label class="good__order-label">Количество</label>
                                        <div class="input-number">
                                            <input type="number" step="1" min="1" class="input-number__elem"
                                                   id="<?= $arItemIDs['QUANTITY']; ?>"
                                                   name="<?= $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                                   value="<?= $arItem['CATALOG_MEASURE_RATIO']; ?>">
                                            <div class="input-number__counter">
                                    <span id="<?= $arItemIDs['QUANTITY_UP']; ?>"
                                          class="input-number__counter-spin input-number__counter-spin_more">Больше</span>
                                                <span id="<?= $arItemIDs['QUANTITY_DOWN']; ?>"
                                                      class="input-number__counter-spin input-number__counter-spin_less">Меньше</span>
                                            </div>
                                        </div>
                                        </div><?
                                    }
                                    ?>
                                    <button id="<?= $arItemIDs['BUY_LINK'];?> form="<?= $arItemIDs['BUY_LINK'] ?>" class="btn"><?
                                        echo "Добавить в корзину";
                                        ?></button>
                                    <div style="clear: both;"></div>
                                </div><?
                            $arJSParams = array(
                                'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                                'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                                'SHOW_ADD_BASKET_BTN' => false,
                                'SHOW_BUY_BTN' => true,
                                'SHOW_ABSENT' => true,
                                'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
                                'SECOND_PICT' => false,
                                'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
                                'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
                                'DEFAULT_PICTURE' => array(
                                    'PICTURE' => $arItem['PRODUCT_PREVIEW'],
                                    'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
                                ),
                                'VISUAL' => array(
                                    'ID' => $arItemIDs['ID'],
                                    'PICT_ID' => $arItemIDs['PICT'],
                                    'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
                                    'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                                    'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                                    'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                                    'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
                                    'PRICE_ID' => $arItemIDs['PRICE'],
                                    'TREE_ID' => $arItemIDs['PROP_DIV'],
                                    'TREE_ITEM_ID' => $arItemIDs['PROP'],
                                    'BUY_ID' => $arItemIDs['BUY_LINK'],
                                    'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
                                    'DSC_PERC' => $arItemIDs['DSC_PERC'],
                                    'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
                                    'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
                                ),
                                'BASKET' => array(
                                    'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                    'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE']
                                ),
                                'PRODUCT' => array(
                                    'ID' => $arItem['ID'],
                                    'NAME' => $arItem['~NAME']
                                ),
                                'OFFERS' => $arItem['JS_OFFERS'],
                                'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
                                'TREE_PROPS' => $arSkuProps,
                                'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                            );
                            ?>
                                <script type="text/javascript">
                                    var <?=$strObName; ?> =
                                        new JCCatalogSectionBest(<?=CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                                </script><?
                            } ?>
                        </form>
                    </div>
                </article>
            </li>
        <?
        endforeach
        ?>
        <div style="clear: both;"></div>
        <li class="goods__item"></li>
        <li class="goods__item"></li>

    <?
    else: ?>
        <div class="bx-nothing"><?= GetMessage("SB_NO_PRODUCTS"); ?></div>
    <?
    endif
    ?>

</ul>

<script type="text/javascript">
    BX.message({
        MESS_BTN_BUY: '<? echo('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('SB_TPL_MESS_BTN_BUY')); ?>',
        MESS_BTN_ADD_TO_BASKET: '<? echo('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('SB_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
        MESS_BTN_DETAIL: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SB_TPL_MESS_BTN_DETAIL')); ?>',
        MESS_NOT_AVAILABLE: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SB_TPL_MESS_BTN_DETAIL')); ?>',
        BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
        BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
        ADD_TO_BASKET_OK: '<? echo GetMessageJS('SB_ADD_TO_BASKET_OK'); ?>',
        TITLE_ERROR: '<? echo GetMessageJS('SB_CATALOG_TITLE_ERROR') ?>',
        TITLE_BASKET_PROPS: '<? echo GetMessageJS('SB_CATALOG_TITLE_BASKET_PROPS') ?>',
        TITLE_SUCCESSFUL: '<? echo GetMessageJS('SB_ADD_TO_BASKET_OK'); ?>',
        BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('SB_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
        BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_CLOSE') ?>'
    });
</script>