<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<ul class="breadcrumbs" itemscope>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "")
	{
		$strReturn .= '
			<li class="breadcrumbs__item" id="bx_breadcrumb_'.$index.'">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" class="breadcrumbs__name">
					'.$title.'
				</a>
				<meta content="'.($index + 1).'" />
			</li>';
	}
	else
	{
		$strReturn .= '
			<div class="breadcrumbs__item">
				'.$arrow.'
				' .$title.'
			</div>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
