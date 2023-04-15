<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}

?>
<form action="<?= $arResult["FORM_ACTION"] ?>" style="width:270px" class="catalog-page__filter catalog__filter form"
      name="<?= $arResult["FILTER_NAME"] . "_form" ?>" method="get">
    <fieldset class="form__fieldset">
        <legend style="float: none;"
                class="form__title form__title_align_center">Фильтр</legend>
        <?

        foreach ($arResult["ITEMS"] as $key => $arItem) {
            if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) {
                continue;
            }

            if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) {
                continue;
            }
            ?>
            <div class="form__row form__row_direction_column">
            <label class="form__label"><?= $arItem["NAME"] ?></label>

            <?
        if ($arItem["CODE"] == "ATT_SIZE") {
            ?>
            <div class="form__content-group"><?
        }
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"]) {
            case "A": //NUMBERS_WITH_SLIDER
                ?>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="min-price"
                                type="text"
                                name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="max-price"
                                type="text"
                                name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div style="clear: both;"></div>

                <div class="bx_ui_slider_track" id="drag_track_<?= $key ?>">
                    <?
                    $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                    $value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4);
                    $value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 2);
                    $value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) * 3) / 4);
                    $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                    ?>
                    <div class="bx_ui_slider_part p1"><span><?= $value1 ?></span></div>
                    <div class="bx_ui_slider_part p2"><span><?= $value2 ?></span></div>
                    <div class="bx_ui_slider_part p3"><span><?= $value3 ?></span></div>
                    <div class="bx_ui_slider_part p4"><span><?= $value4 ?></span></div>
                    <div class="bx_ui_slider_part p5"><span><?= $value5 ?></span></div>

                    <div class="bx_ui_slider_pricebar_VD"
                         style="left: 0;right: 0;"
                         id="colorUnavailableActive_<?= $key ?>"></div>
                    <div class="bx_ui_slider_pricebar_VN"
                         style="left: 0;right: 0;"
                         id="colorAvailableInactive_<?= $key ?>"></div>
                    <div class="bx_ui_slider_pricebar_V"
                         style="left: 0;right: 0;"
                         id="colorAvailableActive_<?= $key ?>"></div>
                    <div class="bx_ui_slider_range" id="drag_tracker_<?= $key ?>"
                         style="left: 0;right: 0;">
                        <a class="bx_ui_slider_handle left"
                           style="left:0;"
                           href="javascript:void(0)"
                           id="left_slider_<?= $key ?>"></a>
                        <a class="bx_ui_slider_handle right"
                           style="right:0;"
                           href="javascript:void(0)"
                           id="right_slider_<?= $key ?>"></a>
                    </div>
                </div>
            <?
            $arJsParams = array(
                "leftSlider" => 'left_slider_' . $key,
                "rightSlider" => 'right_slider_' . $key,
                "tracker" => "drag_tracker_" . $key,
                "trackerWrap" => "drag_track_" . $key,
                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                "colorAvailableActive" => 'colorAvailableActive_' . $key,
                "colorAvailableInactive" => 'colorAvailableInactive_' . $key
            );
            ?>
                <script type="text/javascript">
                    BX.ready(function () {
                        window['trackBar<?= $key ?>'] = new BX.Iblock.SmartFilter(<?= CUtil::PhpToJSObject($arJsParams) ?>);
                    });
                </script>
            <?
            break;
            case "B": //NUMBERS
            ?>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="min-price"
                                type="text"
                                name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="max-price"
                                type="text"
                                name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
            <?
            break;
            case "G": //CHECKBOXES_WITH_PICTURES
            ?>
                <div class="form__content-group">
                    <?
                    foreach ($arItem["VALUES"] as $val => $ar): ?>
                        <div class="checkbox-tile checkbox-tile_size_big">
                            <input type="checkbox"
                                   name="<?= $ar["CONTROL_NAME"] ?>"
                                   id="<?= $ar["CONTROL_ID"] ?>"
                                   value="<?= $ar["HTML_VALUE"] ?>"
                                   class="checkbox-tile__elem">
                            <label for="<?= $ar["CONTROL_ID"] ?>" class="checkbox-tile__label checkbox-tile__label_type_color
                    checkbox-tile__label_color_<?= $ar["URL_ID"]; ?>"><?= $ar["URL_ID"]; ?>
                            </label>
                        </div>
                    <?
                    endforeach;
                    ?>
                </div>
            <?
            break;
            case "H": //CHECKBOXES_WITH_PICTURES_AND_LABELS
            ?>
            <?
            foreach ($arItem["VALUES"] as $val => $ar):
            ?>
            <input
                    style="display: none"
                    type="checkbox"
                    name="<?= $ar["CONTROL_NAME"] ?>"
                    id="<?= $ar["CONTROL_ID"] ?>"
                    value="<?= $ar["HTML_VALUE"] ?>"
                <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
            />
                <?
                $class = "";
                if ($ar["CHECKED"]) {
                    $class .= " active";
                }
                if ($ar["DISABLED"]) {
                    $class .= " disabled";
                }
                ?>
                <label for="<?= $ar["CONTROL_ID"] ?>" data-role="label_<?= $ar["CONTROL_ID"] ?>"
                       class="bx_filter_param_label<?= $class ?>"
                       onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'active');">
                                        <span class="bx_filter_param_btn bx_color_sl">
                                            <?
                                            if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):
                                                ?>
                                                <span class="bx_filter_btn_color_icon"
                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                            <?
                                            endif;
                                            ?>
                                       </span>
                    <span class="bx_filter_param_text" title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                            ?> (<span
                                data-role="count_<?= $ar["CONTROL_ID"] ?>"><?= $ar["ELEMENT_COUNT"]; ?></span>)<?
                        endif;
                        ?></span>
                </label>
            <?
            endforeach;
            ?>
            <?
            break;
            case "P": //DROPDOWN
            $checkedItemExist = false;
            ?>
                <div class="bx_filter_select_container">
                    <div class="bx_filter_select_block"
                         onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                        <div class="bx_filter_select_text" data-role="currentOption">
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar) {
                                if ($ar["CHECKED"]) {
                                    echo $ar["VALUE"];
                                    $checkedItemExist = true;
                                }
                            }
                            if (!$checkedItemExist) {
                                echo GetMessage("CT_BCSF_FILTER_ALL");
                            }
                            ?>
                        </div>
                        <div class="bx_filter_select_arrow"></div>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                id="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <?
                        foreach ($arItem["VALUES"] as $val => $ar):
                            ?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                    id="<?= $ar["CONTROL_ID"] ?>"
                                    value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                            />
                        <?
                        endforeach;
                        ?>
                        <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
                            <ul>
                                <li>
                                    <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                           class="bx_filter_param_label"
                                           data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                        <?= GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                    </label>
                                </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"]) {
                                        $class .= " selected";
                                    }
                                    if ($ar["DISABLED"]) {
                                        $class .= " disabled";
                                    }
                                    ?>
                                    <li>
                                        <label for="<?= $ar["CONTROL_ID"] ?>"
                                               class="bx_filter_param_label<?= $class ?>"
                                               data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?></label>
                                    </li>
                                <?
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?
            break;
            case "R": //DROPDOWN_WITH_PICTURES_AND_LABELS
            ?>
                <div class="bx_filter_select_container">
                    <div class="bx_filter_select_block"
                         onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                        <div class="bx_filter_select_text" data-role="currentOption">
                            <?
                            $checkedItemExist = false;
                            foreach ($arItem["VALUES"] as $val => $ar):
                                if ($ar["CHECKED"]) {
                                    ?>
                                    <?
                                    if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):
                                        ?>
                                        <span class="bx_filter_btn_color_icon"
                                              style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                    <?
                                    endif;
                                    ?>
                                    <span class="bx_filter_param_text">
                                                        <?= $ar["VALUE"] ?>
                                                   </span>
                                    <?
                                    $checkedItemExist = true;
                                }
                            endforeach;
                            if (!$checkedItemExist) {
                                ?><span class="bx_filter_btn_color_icon all"></span> <?
                                echo GetMessage("CT_BCSF_FILTER_ALL");
                            }
                            ?>
                        </div>
                        <div class="bx_filter_select_arrow"></div>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                id="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <?
                        foreach ($arItem["VALUES"] as $val => $ar):
                            ?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                    id="<?= $ar["CONTROL_ID"] ?>"
                                    value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                            />
                        <?
                        endforeach;
                        ?>
                        <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none">
                            <ul>
                                <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                    <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                           class="bx_filter_param_label"
                                           data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                        <span class="bx_filter_btn_color_icon all"></span>
                                        <?= GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                    </label>
                                </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"]) {
                                        $class .= " selected";
                                    }
                                    if ($ar["DISABLED"]) {
                                        $class .= " disabled";
                                    }
                                    ?>
                                    <li>
                                        <label for="<?= $ar["CONTROL_ID"] ?>"
                                               data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                               class="bx_filter_param_label<?= $class ?>"
                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')">
                                            <?
                                            if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):
                                                ?>
                                                <span class="bx_filter_btn_color_icon"
                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                            <?
                                            endif;
                                            ?>
                                            <span class="bx_filter_param_text">
                                                            <?= $ar["VALUE"] ?>
                                                       </span>
                                        </label>
                                    </li>
                                <?
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?
            break;
            case "K": //RADIO_BUTTONS
            ?>
                <label class="bx_filter_param_label" for="<?= "all_" . $arCur["CONTROL_ID"] ?>">
                                    <span class="bx_filter_input_checkbox">
                                        <input
                                                type="radio"
                                                value=""
                                                name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                id="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                onclick="smartFilter.click(this)"
                                        />
                                        <span class="bx_filter_param_text"><?= GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                    </span>
                </label>
                <?
            foreach ($arItem["VALUES"] as $val => $ar):
                ?>
                <label data-role="label_<?= $ar["CONTROL_ID"] ?>" class="bx_filter_param_label"
                       for="<?= $ar["CONTROL_ID"] ?>">
                                        <span class="bx_filter_input_checkbox <?= $ar["DISABLED"] ? 'disabled' : '' ?>">
                                            <input
                                                    type="radio"
                                                    value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                                    name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                    id="<?= $ar["CONTROL_ID"] ?>"
                                                <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                               onclick="smartFilter.click(this)"
                                            />
                                            <span class="bx_filter_param_text"
                                                  title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span
                                                        data-role="count_<?= $ar["CONTROL_ID"] ?>"><?= $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif;
                                                ?></span>
                                        </span>
                </label>
            <?
            endforeach;
            ?>
            <?
            break;
            case "U": //CALENDAR
            ?>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container bx_filter_calendar_container">
                        <?
                        $APPLICATION->IncludeComponent('bitrix:main.calendar', '', array(
                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                            'SHOW_INPUT' => 'Y',
                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT",
                                    $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                            'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                            'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                            'SHOW_TIME' => 'N',
                            'HIDE_TIMEBAR' => 'Y'
                        ), null, array(
                            'HIDE_ICONS' => 'Y'
                        ));
                        ?>
                    </div>
                </div>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container bx_filter_calendar_container">
                        <?
                        $APPLICATION->IncludeComponent('bitrix:main.calendar', '', array(
                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                            'SHOW_INPUT' => 'Y',
                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT",
                                    $arItem["VALUES"]["MAX"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                            'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                            'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                            'SHOW_TIME' => 'N',
                            'HIDE_TIMEBAR' => 'Y'
                        ), null, array(
                            'HIDE_ICONS' => 'Y'
                        ));
                        ?>
                    </div>
                </div>
            <?
            break;
            default: //CHECKBOXES
            ?>
            <?
            foreach ($arItem["VALUES"] as $val => $ar):
            ?>

            <? if ($arItem["CODE"] == "ATT_SIZE"):
                ?>
                <div class="checkbox-tile checkbox-tile_size_big">
                    <input
                            type="checkbox"
                            value="<?= $ar["HTML_VALUE"] ?>"
                            name="<?= $ar["CONTROL_NAME"] ?>"
                            id="<?= $ar["CONTROL_ID"] ?>"
                            class="checkbox-tile__elem"
                            style="background-color: #<?= $ar["URL_ID"] ?> "
                        <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                        <?= $ar["DISABLED"] ? 'disabled' : '' ?>
                            onclick="smartFilter.click(this)"
                    />
                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>" class="checkbox-tile__label"
                           for="<?= $ar["CONTROL_ID"] ?>">
                        <?= $ar["VALUE"]; ?>
                    </label>
                </div>


            <?
            else:
                ?>

                <div class="checkbox">
                    <input
                            type="checkbox"
                            value="<?= $ar["HTML_VALUE"] ?>"
                            name="<?= $ar["CONTROL_NAME"] ?>"
                            id="<?= $ar["CONTROL_ID"] ?>"
                            class="checkbox__elem"
                        <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                        <?= $ar["DISABLED"] ? 'disabled' : '' ?>
                            onclick="smartFilter.click(this)"
                    />
                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>" class="checkbox__label form__label"
                           for="<?= $ar["CONTROL_ID"] ?>">
                        <?= $ar["VALUE"];
                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])): ?>&nbsp;(
                            <span
                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><?= $ar["ELEMENT_COUNT"]; ?></span>)<?
                        endif;
                        ?>
                    </label>
                </div>
            <?
            endif;
                ?>
            <?
            endforeach;
            if ($arItem["CODE"] == "ATT_SIZE") {
                ?></div><?
            }
                ?>
                </div>
            <?
            }
        }
        //prices
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            $key = $arItem["ENCODED_ID"];
            if (isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                    continue;
                }
                ?>
                <div class="form__row form__row_direction_column">
                    <label class="form__label">Цена, руб.</label>
                    <div id="slider-range"></div>
                    <div class="range-slider">
                        <input class="range-slider__elem" type="text">
                        <div class="range-slider__output-row">
                            <input
                                    class="input range-slider__output"
                                    type="text"
                                    name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                    id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                    value="<?= $arItem["VALUES"]["MIN"]["VALUE"] ?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                            />
                            <input
                                    class="input range-slider__output"
                                    type="text"
                                    name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                    id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                    value="<?= $arItem["VALUES"]["MAX"]["VALUE"] ?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                            />
                        </div>
                    </div>
                    <div id="drag_track_<?= $key ?>" style="display: none">
                        <?
                        $price1 = $arItem["VALUES"]["MIN"]["VALUE"];
                        $price2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4);
                        $price3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 2);
                        $price4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) * 3) / 4);
                        $price5 = $arItem["VALUES"]["MAX"]["VALUE"];
                        ?>
                        <span class="irs">
                                    <div class="bx_ui_slider_part p1"><span><?= $price1 ?></span></div>
                                    <div class="bx_ui_slider_part p2"><span><?= $price2 ?></span></div>
                                    <div class="bx_ui_slider_part p3"><span><?= $price3 ?></span></div>
                                    <div class="bx_ui_slider_part p4"><span><?= $price4 ?></span></div>
                                    <div class="bx_ui_slider_part p5"><span><?= $price5 ?></span></div>

                                    <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;"
                                         id="colorUnavailableActive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;"
                                         id="colorAvailableInactive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_pricebar_V" style="left: 0;right: 0;"
                                         id="colorAvailableActive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_range" id="drag_tracker_<?= $key ?>"
                                         style="left: 0%; right: 0%;">
                                        <a class="bx_ui_slider_handle left" style="left:0;" href="javascript:void(0)"
                                           id="left_slider_<?= $key ?>"></a>
                                        <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)"
                                           id="right_slider_<?= $key ?>"></a>
                                    </div>
                                    </span>
                    </div>
                    <div style="opacity: 0;height: 1px;"></div>
                    <?
                    $precision = 2;
                    if (Bitrix\Main\Loader::includeModule("currency")) {
                        $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                        $precision = $res['DECIMALS'];
                    }
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_' . $key,
                        "rightSlider" => 'right_slider_' . $key,
                        "tracker" => "drag_tracker_" . $key,
                        "trackerWrap" => "drag_track_" . $key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $precision,
                        "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                        "colorAvailableActive" => 'colorAvailableActive_' . $key,
                        "colorAvailableInactive" => 'colorAvailableInactive_' . $key
                    );
                    ?>
                    <script type="text/javascript">
                        BX.ready(function () {
                            window['trackBar<?= $key ?>'] = new BX.Iblock.SmartFilter(<?= CUtil::PhpToJSObject($arJsParams) ?>);
                        });
                    </script>
                </div>
            <?
            endif;
        }

        ?>
        <div class="clb"></div>
        <button type="submit" class="btn">Показать товары</button>
        <div class="row">
            <div class="col-xs-12 bx-filter-button-box">
                <div class="bx-filter-block">
                    <div class="bx-filter-parameters-box-container">
                        <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                            <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                            <span class="arrow"></span>
                            <br/>
                            <a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>