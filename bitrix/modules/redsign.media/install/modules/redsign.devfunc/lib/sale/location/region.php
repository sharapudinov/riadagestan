<?php

namespace Redsign\DevFunc\Sale\Location;

use \Bitrix\Currency;
use \Bitrix\Main\Context;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Web\Cookie;
use \Bitrix\Main\Web\Uri;
use \Bitrix\Sale;

class Region
{
	const COOKIE_NAME = 'current_region';

    static function OnSiteLocationSelected() {

	}

    static function OnPageStart() {

		if (defined('ADMIN_SECTION') || defined('WIZARD_SITE_ID')) {
			return;
		}

		if (!self::isUseRegionality()) {
			return;
		}

		$arRegion = self::getCurrentRegion();

		if (is_array($arRegion)) {

			$server = Context::getCurrent()->getServer();
			$request = Context::getCurrent()->getRequest();

			$arRegionSaved = $request->getCookie(self::COOKIE_NAME);

			if ($arRegionSaved) {
				$arRegionSaved = unserialize($arRegionSaved);
				if ($arRegionSaved['ID'] !== $arRegion['ID']) {
					self::set($arRegion);
				}
			} else {
				self::set($arRegion);
			}

			if (
				is_array($arRegion['LIST_DOMAINS']) && count($arRegion['LIST_DOMAINS']) > 0
				&& !in_array($server->getServerName(), $arRegion['LIST_DOMAINS'])) {

				$uriString = $request->getRequestUri();

				$uri = new Uri($uriString);
				$uri->setHost(reset($arRegion['LIST_DOMAINS']));
				$redirect = $uri->getUri();
				LocalRedirect($redirect);
			}

			define('SITE_LOCATION_ID', $arRegion['LOCATION_ID']);

			$GLOBALS['arRegionFilter'] = array(
				array(
					"LOGIC"=>"OR",
					array(
						'PROPERTY_REGION_REF' => $arRegion['ID'],
					),
					array(
						'PROPERTY_REGION_REF' => false,
					)
				)
			);
		}
    }

    static function OnEndBufferContent(&$content) {

		if (defined('ADMIN_SECTION') || defined('WIZARD_SITE_ID')) {
			return;
		}

		if (!self::isUseRegionality()) {
			return;
		}

		$arRegion = self::getCurrentRegion();

		// replace macros
		if (is_array($arRegion)) {
			if (is_array($arRegion['REGION_MACROS']) && count($arRegion['REGION_MACROS']) > 0) {
				foreach ($arRegion['REGION_MACROS'] as $sMacros => $arValues) {
					if (is_array($arValues) && count($arValues) > 0) {
						foreach ($arValues as $iValueKey => $sValue) {

							if ($iValueKey != 0) {
								$sMacros = preg_replace('/^#([^#]+)#$/', '#$1_'.$iValueKey.'#', $sMacros);
							}

							if (strpos($content, $sMacros) !== false) {
								$content = str_replace($sMacros, $sValue, $content);
							}
						}
					}
				}
			}
		}
	}

	public static function set($arRegion = array()) {

		static $eventOnResultExists = null;

		if ($eventOnGetExists === true || $eventOnGetExists === null)
		{
			foreach (GetModuleEvents('redsign.devfunc', 'OnSiteLocationSelected', true) as $arEvent)
			{
				$eventOnGetExists = true;
				$mxResult = ExecuteModuleEventEx(
					$arEvent,
					array(
						$arRegion,
					)
				);
			}
			if ($eventOnGetExists === null)
				$eventOnGetExists = false;
		}

		$arCityData = array(
			'ID' => $arRegion['ID'],
		);

        if ($arCityData) {
            $cookie = new Cookie(self::COOKIE_NAME, serialize($arCityData));
            Context::getCurrent()->getResponse()->addCookie($cookie);
        }
		
		if (Loader::includeModule('sale')) {
			$basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), SITE_ID);
			$basket->refreshData(array('PRICE', 'COUPONS'));
			$basket->save();
		}
	}

	public static function getRegionIBlockID() {
		$iRegionIBlockID = null;

		$iRegionIBlockID = Option::get('redsign.devfunc', 'location_region_iblock_id', null, SITE_ID);

		return $iRegionIBlockID;
	}


	public static function isUseRegionality() {


		if (Option::get('redsign.devfunc', 'use_location_region', 'Y', SITE_ID) !== 'Y') {
			return false;
		}
		
		$iRegionIBlockID = self::getRegionIBlockID();

		if (intval($iRegionIBlockID) <= 0) {
			return false;
		}

		return true;
	}

	public static function getRegions() {

		$arRegions = array();

		if ($iRegionIBlockID = self::getRegionIBlockID()) {

			if (Loader::includeModule('iblock')) {

				$arFilter = array(
					'ACTIVE' => 'Y',
					'IBLOCK_ID' => $iRegionIBlockID
				);
				$arSelect = array(
					'ID',
					'NAME',
					'IBLOCK_ID',
					'IBLOCK_SECTION_ID',
					'DETAIL_TEXT',
					'PROPERTY_*',
				);

				$dbItems = \CIBlockElement::getList(
					array(),
					$arFilter,
					false,
					false,
					$arSelect
				);

				while ($obItem = $dbItems->GetNextElement()) {
					$arItem = $obItem->GetFields();
					$arItem['PROPERTIES'] = $obItem->GetProperties();

					foreach ($arItem["PROPERTIES"] as $sPropCode => $arProp)
					{
						$prop = &$arItem["PROPERTIES"][$sPropCode];

						if (
							$prop['PROPERTY_TYPE'] == 'S' && $prop['USER_TYPE'] == 'HTML'
							&& (
								(is_array($prop["VALUE"]) && count($prop["VALUE"])>0)
								|| (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0)
							)
						)
						{
							$arItem['DISPLAY_PROPERTIES'][$sPropCode] = \CIBlockFormatProperties::GetDisplayValue($arItem, $prop, 'region_out');

							if (!is_array($arItem['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE']))
							{
								$arItem['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'] = (array)$arItem['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'];
							}
						}
					}
					unset($sPropCode, $arProp);

					$arRegions[$arItem['ID']] = $arItem;
				}
				unset($obItem, $arItem);
			}

			if ($arRegions)
			{
				foreach ($arRegions as $key => $arRegion)
				{
					if ($arRegion['PROPERTIES']['LOCATION_DEFAULT']['VALUE_XML_ID'] == 'yes') {
						$arRegions[$key]['DEFAULT'] = true;
					}
					unset($arRegions[$key]['PROPERTIES']['LOCATION_DEFAULT']);

					//domains props
					if (!is_array($arRegion['PROPERTIES']['DOMAINS']['VALUE'])) {
						$arRegion['PROPERTIES']['DOMAINS']['VALUE'] = !empty($arRegion['PROPERTIES']['DOMAINS']['VALUE'])
							? (array)$arRegion['PROPERTIES']['DOMAINS']['VALUE']
							: array();
					}

					if (
						strlen($arRegion['PROPERTIES']['MAIN_DOMAIN']['VALUE']) > 0
						&& !in_array($arRegion['PROPERTIES']['MAIN_DOMAIN']['VALUE'], $arRegion['PROPERTIES']['DOMAINS']['VALUE'])
					) {
						$arRegions[$key]['LIST_DOMAINS'] = array_merge((array)$arRegion['PROPERTIES']['MAIN_DOMAIN']['VALUE'], $arRegion['PROPERTIES']['DOMAINS']['VALUE']);
					} else {
						$arRegions[$key]['LIST_DOMAINS'] = $arRegion['PROPERTIES']['DOMAINS']['VALUE'];
					}
					unset(
						$arRegions[$key]['PROPERTIES']['DOMAINS'],
						$arRegions[$key]['PROPERTIES']['MAIN_DOMAIN']
					);

					//stores props
					if (!is_array($arRegion['PROPERTIES']['STORES_REF']['VALUE'])) {
						$arRegion['PROPERTIES']['STORES_REF']['VALUE'] = (array)$arRegion['PROPERTIES']['STORES_REF']['VALUE'];
					}
					$arRegions[$key]['LIST_STORES'] = $arRegion['PROPERTIES']['STORES_REF']['VALUE'];
					unset($arRegions[$key]['PROPERTIES']['STORES_REF']);

					//location props
					$arRegions[$key]['LOCATION_ID'] = $arRegion['PROPERTIES']['LOCATION_REF']['VALUE'];
					unset($arRegions[$key]['PROPERTIES']['LOCATION_REF']);

					//prices props
					if (Loader::includeModule('catalog')) {

						if (!is_array($arRegion['PROPERTIES']['PRICES_REF']['VALUE'])) {
							$arRegion['PROPERTIES']['PRICES_REF']['VALUE'] = (array)$arRegion['PROPERTIES']['PRICES_REF']['VALUE'];
						}

						if ($arRegion['PROPERTIES']['PRICES_REF']['VALUE']) {
							if (reset($arRegion['PROPERTIES']['PRICES_REF']['VALUE']) != 'component') {
								$dbPriceType = \CCatalogGroup::GetList(
									array(
										'SORT' => 'ASC'
									),
									array(
										'ID' => $arRegion['PROPERTIES']['PRICES_REF']['VALUE']
									),
									false,
									false,
									array(
										'ID',
										'NAME',
										'CAN_BUY'
									)
								);
								while ($arPriceType = $dbPriceType->Fetch()) {
									$arRegions[$key]['LIST_PRICES'][$arPriceType['NAME']] = $arPriceType;
								}
							} else {
								$arRegions[$key]['LIST_PRICES'] = $arRegion['PROPERTIES']['PRICES_REF']['VALUE'];
							}
						} else {
							$arRegions[$key]['LIST_PRICES'] = array();
						}
						unset($arRegions[$key]['PROPERTIES']['PRICES_REF']);
					}

					foreach ($arRegion['PROPERTIES'] as $sPropkey => $arProp) {
						if (strpos($sPropkey, 'REGION_') === 0) {

							if (!is_array($arProp['VALUE'])) {
								$arProp['VALUE'] = (array)$arProp['VALUE'];
							}

							if (isset($arRegion['DISPLAY_PROPERTIES'][$sPropkey])) {
								$sMacrosInsert = $arRegion['DISPLAY_PROPERTIES'][$sPropkey]['DISPLAY_VALUE'];
								unset($arRegions[$key]['DISPLAY_PROPERTIES'][$sPropkey]);
							} else {
								$sMacrosInsert = $arProp['VALUE'];
							}

							$arRegions[$key]['REGION_MACROS']['#'.$sPropkey.'#'] = $sMacrosInsert;

							if ($sPropkey == 'REGION_PHONE') {
								$arRegions[$key]['REGION_MACROS']['#'.$sPropkey.'_URL#'] = array_map(
									function ($v) {
										return preg_replace('/[^0-9\+]/', '', $v);
									},
									$sMacrosInsert
								);
							}

							unset($arRegions[$key]['PROPERTIES'][$sPropkey]);
						}
					}
					unset($sPropkey, $arProp);
				}
			}
		}

		return $arRegions;
	}

	public static function getCurrentRegion() {
		// static $arRegion;

		$bFindDomain = false;

		$arRegions = self::getRegions();

		$city = \Redsign\DevFunc\Sale\Location\Location::getMyCity();

		if ($city) {
			foreach ($arRegions as $iRegionKey => $arRegion) {
				if ($city['ID'] === $arRegion['LOCATION_ID']) {
					return $arRegions[$iRegionKey];
				}
			}
		}

		$server = Context::getCurrent()->getServer();

		foreach ($arRegions as $arRegion) {

			if (
				in_array($server->getServerName(), $arRegion['LIST_DOMAINS'])
				|| in_array($server->getHttpHost(), $arRegion['LIST_DOMAINS'])
			) {
				return $arRegion;
			}
		}

		if ($city) {
			foreach ($arRegions as $key => $arRegion) {
				if ($city === $arRegion['NAME']) {
					return $arRegion;
				}
			}
		}

		foreach ($arRegions as $arRegion) {
			if ($arRegion['DEFAULT']) {
				return $arRegion;
			}
		}

		return reset($arRegions);
	}

	function OnGetOptimalPrice($intProductID, $quantity = 1, $arUserGroups = array(), $renewal = "N", $priceList = array(), $siteID = false, $arDiscountCoupons = false) {

		global $APPLICATION;

		$arRegion = self::getCurrentRegion();

		if ($arRegion) {
			return \Redsign\DevFunc\Catalog\Product::GetOptimalPrice($intProductID, $quantity, $arUserGroups, $renewal, $priceList, $siteID, $arDiscountCoupons, $arRegion);
		} else {
			return true;
		}
	}


	static function editCatalogItem(&$item) {


		if (!self::isUseRegionality()) {
			return;
		}
		
		$arRegion = self::getCurrentRegion();

		if ($arRegion) {

			if ($arRegion['LIST_PRICES'] && reset($arRegion['LIST_PRICES']) != 'component') {

				$arFilterIds = array();
				foreach ($arRegion['LIST_PRICES'] as $arPrice) {
					if ($arPrice['CAN_BUY'] == 'Y') {
						$arFilterIds[] = $arPrice['ID'];
					}
				}
				unset($arPrice);

				self::filterItemPrices($item, $arFilterIds);

				if (is_array($item['OFFERS']) && count($item['OFFERS']) > 0) {
					foreach ($item['OFFERS'] as $iOfferKey => $arOffer) {
						self::filterItemPrices($item['OFFERS'][$iOfferKey], $arFilterIds);
					}
					unset($iOfferKey, $arOffer);
				}

			}
		}
	}

	static function filterItemPrices(&$item, $arFilterIds) {

		if (is_array($item['PRICES_ALLOW'])) {
			$item['PRICES_ALLOW'] = array_filter(
				$item['PRICES_ALLOW'],
				function ($v) use ($arFilterIds) {
					return in_array($v, $arFilterIds);
				}
			);
		}

		if (is_array($item['CAT_PRICES'])) {
			$item['CAT_PRICES'] = array_filter(
				$item['CAT_PRICES'],
				function ($v) use ($arFilterIds) {
					return in_array($v['ID'], $arFilterIds);
				}
			);
		}

		if (is_array($item['PRICES'])) {
			$item['PRICES'] = array_filter(
				$item['PRICES'],
				function ($v) use ($arFilterIds) {
					return in_array($v['PRICE_ID'], $arFilterIds);
				}
			);
		}

		$item['MIN_PRICE'] = \CIBlockPriceTools::getMinPriceFromList($item['PRICES']);

		if ($item['CATALOG_TYPE'] == \CCatalogProduct::TYPE_PRODUCT || $item['CATALOG_TYPE'] == \CCatalogProduct::TYPE_SET) {
			if (isset($item['MIN_PRICE']) && !empty($item['MIN_PRICE']) && isset($item['CATALOG_MEASURE_RATIO']))
			{
				\CIBlockPriceTools::setRatioMinPrice($item, false);
			} else {
				unset($item['RATIO_PRICE']);
			}

			$item['MIN_BASIS_PRICE'] = $item['MIN_PRICE'];
		}

		if (is_array($item['ITEM_ALL_PRICES'])) {
			foreach ($item['ITEM_ALL_PRICES'] as $iPricesKey => $arPrices) {
				if (is_array($arPrices['PRICES'])) {
					$item['ITEM_ALL_PRICES'][$iPricesKey]['PRICES'] = array_filter(
						$item['ITEM_ALL_PRICES'][$iPricesKey]['PRICES'],
						function ($v) use ($arFilterIds) {
							return in_array($v['PRICE_TYPE_ID'], $arFilterIds);
						}
					);
				}
			}
			unset($iPricesKey, $arPrices);
		}

		if (is_array($item['ITEM_PRICES'])) {
			$item['ITEM_PRICES'] = array_filter(
				$item['ITEM_PRICES'],
				function ($v) use ($arFilterIds) {
					return in_array($v['PRICE_TYPE_ID'], $arFilterIds);
				}
			);
		}

		if (
			is_array($item['ITEM_PRICES']) && count($item['ITEM_PRICES']) < 1
			&& is_array($item['ITEM_ALL_PRICES'][$item['ITEM_PRICE_SELECTED']]['PRICES']) && count($item['ITEM_ALL_PRICES'][$item['ITEM_PRICE_SELECTED']]['PRICES']) > 0
		) {
			$minimalPrice = null;
			$baseCurrency = Currency\CurrencyManager::getBaseCurrency();

			foreach ($item['ITEM_ALL_PRICES'][$item['ITEM_PRICE_SELECTED']]['PRICES'] as $priceKey => $priceRow) {
				$priceRow['PRICE_SCALE'] = \CCurrencyRates::ConvertCurrency(
					$priceRow['PRICE'],
					$priceRow['CURRENCY'],
					$baseCurrency
				);

				if ($minimalPrice === null || $minimalPrice['PRICE_SCALE'] > $priceRow['PRICE_SCALE']) {
					$minimalPrice = $priceRow;
				}
			}
			unset($priceRow);

			if (is_array($minimalPrice)) {
				foreach ($item['ITEM_ALL_PRICES'] as $iPricesKey => $arPrices) {

					foreach ($arPrices['PRICES'] as $arPrice) {

						if ($arPrice['PRICE_TYPE_ID'] == $minimalPrice['PRICE_TYPE_ID']) {
							$arPrice['MIN_QUANTITY'] = $arPrices['MIN_QUANTITY'];
							$item['ITEM_PRICES'][] = $arPrice;
						}
					}
					unset($arPrice);
				}
				unset($iPricesKey, $arPrices);
			}
		}

		$arFilterKeys = array(
			'CATALOG_PRICE_',
			'CATALOG_GROUP_ID_',
			'CATALOG_GROUP_NAME_',
			'CATALOG_CAN_ACCESS_',
			'CATALOG_CAN_BUY_',
			'CATALOG_PRICE_ID_',
			'CATALOG_CURRENCY_',
			'CATALOG_QUANTITY_FROM_',
			'CATALOG_QUANTITY_TO_',
			'CATALOG_EXTRA_ID_',
		);
		foreach ($item as $k => $v) {
			if (preg_match('/^~?('.implode($arFilterKeys, '|').')(\d+)$/', $k, $matches)) {
				if (!in_array($matches[2], $arFilterIds)) {
					unset($item[$matches[0]]);
				}
			}
		}
		unset($k, $v);

		if (isset($item['ITEM_PRICES'])) {
			$item['CAN_BUY'] = !empty($item['ITEM_PRICES']) && $item['PRODUCT']['AVAILABLE'] === 'Y';;
		} elseif (isset($item['PRICES'])) {
			$item['CAN_BUY'] = \CIBlockPriceTools::CanBuy($item['IBLOCK_ID'], $item['PRICES'], $item);
		}
	}

	static function editCatalogStores(&$item) {

		if (!self::isUseRegionality()) {
			return;
		}

		$arRegion = self::getCurrentRegion();

		if ($arRegion) {
			if ($arRegion['LIST_STORES'] && reset($arRegion['LIST_STORES']) != 'component') {

				$arFilterIds = $arRegion['LIST_STORES'];

				if (is_array($item['STORES'])) {
					$item['STORES'] = array_filter(
						$item['STORES'],
						function ($v) use ($arFilterIds) {
							return in_array($v['ID'], $arFilterIds);
						}
					);
				}

				if (is_array($item['JS']['STORES'])) {
					$item['JS']['STORES'] = array_filter(
						$item['JS']['STORES'],
						function ($v) use ($arFilterIds) {
							return in_array($v, $arFilterIds);
						}
					);
				}

				if (is_array($item['JS']['SKU']) && count($item['JS']['SKU']) > 0) {

					foreach ($item['JS']['SKU'] as $iSkuKey => $arSku) {
						$item['JS']['SKU'][$iSkuKey] = array_filter(
							$item['JS']['SKU'][$iSkuKey],
							function ($k) use ($arFilterIds) {
								return in_array($k, $arFilterIds);
							},
							ARRAY_FILTER_USE_KEY
						);
					}
				}
			}
		}
	}
}
