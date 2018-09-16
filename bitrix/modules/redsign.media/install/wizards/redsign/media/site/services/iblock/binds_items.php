<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule('iblock'))
	return;

$arFilterIBlocks = array(
	array(
		'IBLOCK_TYPE' => 'articles',
		'IBLOCK_CODE' => 'news',
		'IBLOCK_XML_ID' => 'news',
	),
);

$arrFilterElements = array(
	"news" => array(
		"apple-zapatentovala-risuyushchiy-po-vozdukhu-stilus" => array(
			"READ_ALSO" => array(
				"news" => array(
					"ryzhie-temnokozhie-poyavyatsya-v-novom-nabore-emodzi",
					"nokia-zaregistrirovala-dva-smartfona-v-rossii",
					"gta-v-kupili-bolshe-chelovek-chem-prozhivaet-v-germanii",
				),
			),
		),
		"arnold-shvartsenegger-vpervye-sygraet-glavnuyu-rol-v-seriale" => array(
			"READ_ALSO" => array(
				"news" => array(
					"spice-girls-otpravyatsya-v-mirovoy-tur",
					"nazvany-pyat-luchshikh-aktris-poluchivshikh-premiyu-oskar",
					"reper-basta-nazval-draku-shevchenko-i-svanidze-luchshim-battlom",
				),
			),
		),
		"artem-anisimov-propustil-trenirovku-chikago" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sportsmeny-rf-smogut-na-oi-2018-nosit-shapku-v-tsvetakh-rossii",
					"balotelli-i-buffona-mogut-vyzvat-na-tovarishcheskie-matchi-sbornoy-italii",
					"peres-nachal-rassledovanie-o-lichnoy-zhizni-neymara",
				),
			),
		),
		"balotelli-i-buffona-mogut-vyzvat-na-tovarishcheskie-matchi-sbornoy-italii" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sportsmeny-rf-smogut-na-oi-2018-nosit-shapku-v-tsvetakh-rossii",
					"peres-nachal-rassledovanie-o-lichnoy-zhizni-neymara",
					"artem-anisimov-propustil-trenirovku-chikago",
				),
			),
		),
		"dva-cheloveka-pogibli-pod-kolesami-elektrichki-v-shcherbinke" => array(
			"READ_ALSO" => array(
				"news" => array(
					"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami",
					"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley",
					"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira",
				),
			),
		),
		"dvoe-velosipedistov-otpravilis-iz-samary-v-saratov-po-ldu-volgi" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sudey-osvobozhdayut-ot-obyasneniya-motivov",
					"poslom-zayavki-ekaterinburga-na-ekspo-2025-stanet-matreshka",
					"turoperatory-rasskazali-poletyat-li-tomichi-v-egipet-v-2018-godu",
				),
			),
		),
		"dzh-miller-i-dyuopa-vstretyatsya-28-aprelya" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sportsmeny-rf-smogut-na-oi-2018-nosit-shapku-v-tsvetakh-rossii",
					"balotelli-i-buffona-mogut-vyzvat-na-tovarishcheskie-matchi-sbornoy-italii",
					"peres-nachal-rassledovanie-o-lichnoy-zhizni-neymara",
				),
			),
		),
		"eksperty-usomnilis-v-perspektivah-pavla-grudinina" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"forbes-opublikoval-reyting-razbogatevshikh-na-kriptovalyute-lyudey" => array(
			"READ_ALSO" => array(
				"news" => array(
					"limit-gosdolga-ssha-budet-povyshen-do-marta-2019-goda",
					"inflyatsiya-za-god-v-venesuele-prevysila-4000",
					"rubl-poprobuet-ukrepitsya-na-starte-torgov",
				),
			),
		),
		"gazprom-neft-razdelit-biznes-i-sokhranit-kachestvo-topliva" => array(
			"READ_ALSO" => array(
				"news" => array(
					"novyy-s-klass-budet-stoit-ot-4-2-mln-rubley",
					"amerikanskiy-istrebitel-upal-v-okean-u-yaponskogo-ostrova-okinava",
					"vladimir-putin-nam-nuzhno-svesti-mosty-mezhdu-vlastyu-i-biznesom",
				),
			),
		),
		"grivach-v-evrope-rastet-spros-na-rossiyskiy-gaz" => array(
			"READ_ALSO" => array(
				"news" => array(
					"forbes-opublikoval-reyting-razbogatevshikh-na-kriptovalyute-lyudey",
					"limit-gosdolga-ssha-budet-povyshen-do-marta-2019-goda",
					"inflyatsiya-za-god-v-venesuele-prevysila-4000",
				),
			),
		),
		"gta-v-kupili-bolshe-chelovek-chem-prozhivaet-v-germanii" => array(
			"READ_ALSO" => array(
				"news" => array(
					"apple-zapatentovala-risuyushchiy-po-vozdukhu-stilus",
					"ryzhie-temnokozhie-poyavyatsya-v-novom-nabore-emodzi",
					"nokia-zaregistrirovala-dva-smartfona-v-rossii",
				),
			),
		),
		"hyundai-sozdala-subbrend-n-sport-dlya-zaryazhennykh-modeley" => array(
			"READ_ALSO" => array(
				"news" => array(
					"obnarodovany-fotografii-novogo-kia-sportage",
					"tesla-model-x-pervym-iz-elektrokarov-peresek-sakharu",
					"skoda-pokazala-obnovlyennuyu-fabia",
				),
			),
		),
		"inflyatsiya-za-god-v-venesuele-prevysila-4000" => array(
			"READ_ALSO" => array(
				"news" => array(
					"forbes-opublikoval-reyting-razbogatevshikh-na-kriptovalyute-lyudey",
					"limit-gosdolga-ssha-budet-povyshen-do-marta-2019-goda",
					"rubl-poprobuet-ukrepitsya-na-starte-torgov",
				),
			),
		),
		"kitay-oboruduet-podlodki-iskusstvennym-intellektom" => array(
			"READ_ALSO" => array(
				"news" => array(
					"rakov-mutantov-nazvali-ikonami-feminizma",
					"uchenye-nauchilis-uluchshat-pamyat-lyudey",
					"uchenye-nashli-vymershiy-vid-khvostatykh-paukov",
				),
			),
		),
		"kosmicheskiy-sputnik-ubiytsa-dognal-evropeyskiy-sputnik" => array(
			"READ_ALSO" => array(
				"news" => array(
					"rakov-mutantov-nazvali-ikonami-feminizma",
					"uchenye-nauchilis-uluchshat-pamyat-lyudey",
					"kitay-oboruduet-podlodki-iskusstvennym-intellektom",
				),
			),
		),
		"kto-s-kem-poboretsya-na-vyborakh-prezidenta" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"lider-demokratov-bolee-vosmi-chasov-vystupala-v-kongresse-ssha" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"limit-gosdolga-ssha-budet-povyshen-do-marta-2019-goda" => array(
			"READ_ALSO" => array(
				"news" => array(
					"forbes-opublikoval-reyting-razbogatevshikh-na-kriptovalyute-lyudey",
					"inflyatsiya-za-god-v-venesuele-prevysila-4000",
					"rubl-poprobuet-ukrepitsya-na-starte-torgov",
				),
			),
		),
		"ministrom-ekonomiki-tatarstana-naznachen-farid-abdulganiev" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley" => array(
			"READ_ALSO" => array(
				"news" => array(
					"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami",
					"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira",
					"u-bezrabotnogo-moskvicha-ukrali-lexus-za-6-6-milliona-rubley",
				),
			),
		),
		"nasa-sozdast-podvodnuyu-lodku-dlya-titana" => array(
			"READ_ALSO" => array(
				"news" => array(
					"rakov-mutantov-nazvali-ikonami-feminizma",
					"uchenye-nauchilis-uluchshat-pamyat-lyudey",
					"kitay-oboruduet-podlodki-iskusstvennym-intellektom",
				),
			),
		),
		"nazvany-pyat-luchshikh-aktris-poluchivshikh-premiyu-oskar" => array(
			"READ_ALSO" => array(
				"news" => array(
					"spice-girls-otpravyatsya-v-mirovoy-tur",
					"arnold-shvartsenegger-vpervye-sygraet-glavnuyu-rol-v-seriale",
					"reper-basta-nazval-draku-shevchenko-i-svanidze-luchshim-battlom",
				),
			),
		),
		"nokia-zaregistrirovala-dva-smartfona-v-rossii" => array(
			"READ_ALSO" => array(
				"news" => array(
					"apple-zapatentovala-risuyushchiy-po-vozdukhu-stilus",
					"ryzhie-temnokozhie-poyavyatsya-v-novom-nabore-emodzi",
					"gta-v-kupili-bolshe-chelovek-chem-prozhivaet-v-germanii",
				),
			),
		),
		"obnarodovany-fotografii-novogo-kia-sportage" => array(
			"READ_ALSO" => array(
				"news" => array(
					"hyundai-sozdala-subbrend-n-sport-dlya-zaryazhennykh-modeley",
					"tesla-model-x-pervym-iz-elektrokarov-peresek-sakharu",
					"skoda-pokazala-obnovlyennuyu-fabia",
				),
			),
		),
		"peres-nachal-rassledovanie-o-lichnoy-zhizni-neymara" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sportsmeny-rf-smogut-na-oi-2018-nosit-shapku-v-tsvetakh-rossii",
					"balotelli-i-buffona-mogut-vyzvat-na-tovarishcheskie-matchi-sbornoy-italii",
					"artem-anisimov-propustil-trenirovku-chikago",
				),
			),
		),
		"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"poslom-zayavki-ekaterinburga-na-ekspo-2025-stanet-matreshka" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sudey-osvobozhdayut-ot-obyasneniya-motivov",
					"dvoe-velosipedistov-otpravilis-iz-samary-v-saratov-po-ldu-volgi",
					"turoperatory-rasskazali-poletyat-li-tomichi-v-egipet-v-2018-godu",
				),
			),
		),
		"putin-obsudit-v-novosibirske-voprosy-razvitiya-rossiyskoy-nauki" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"rakov-mutantov-nazvali-ikonami-feminizma" => array(
			"READ_ALSO" => array(
				"news" => array(
					"uchenye-nauchilis-uluchshat-pamyat-lyudey",
					"kitay-oboruduet-podlodki-iskusstvennym-intellektom",
					"uchenye-nashli-vymershiy-vid-khvostatykh-paukov",
				),
			),
		),
		"reper-basta-nazval-draku-shevchenko-i-svanidze-luchshim-battlom" => array(
			"READ_ALSO" => array(
				"news" => array(
					"spice-girls-otpravyatsya-v-mirovoy-tur",
					"nazvany-pyat-luchshikh-aktris-poluchivshikh-premiyu-oskar",
					"arnold-shvartsenegger-vpervye-sygraet-glavnuyu-rol-v-seriale",
				),
			),
		),
		"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda" => array(
			"READ_ALSO" => array(
				"news" => array(
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
					"ministrom-ekonomiki-tatarstana-naznachen-farid-abdulganiev",
					"soros-vlozhil-polmilliona-dollarov-v-otmenu-brexit",
				),
			),
		),
		"rubl-poprobuet-ukrepitsya-na-starte-torgov" => array(
			"READ_ALSO" => array(
				"news" => array(
					"forbes-opublikoval-reyting-razbogatevshikh-na-kriptovalyute-lyudey",
					"limit-gosdolga-ssha-budet-povyshen-do-marta-2019-goda",
					"inflyatsiya-za-god-v-venesuele-prevysila-4000",
				),
			),
		),
		"ryzhie-temnokozhie-poyavyatsya-v-novom-nabore-emodzi" => array(
			"READ_ALSO" => array(
				"news" => array(
					"apple-zapatentovala-risuyushchiy-po-vozdukhu-stilus",
					"nokia-zaregistrirovala-dva-smartfona-v-rossii",
					"gta-v-kupili-bolshe-chelovek-chem-prozhivaet-v-germanii",
				),
			),
		),
		"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira" => array(
			"READ_ALSO" => array(
				"news" => array(
					"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami",
					"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley",
					"u-bezrabotnogo-moskvicha-ukrali-lexus-za-6-6-milliona-rubley",
				),
			),
		),
		"skoda-pokazala-obnovlyennuyu-fabia" => array(
			"READ_ALSO" => array(
				"news" => array(
					"obnarodovany-fotografii-novogo-kia-sportage",
					"hyundai-sozdala-subbrend-n-sport-dlya-zaryazhennykh-modeley",
					"tesla-model-x-pervym-iz-elektrokarov-peresek-sakharu",
				),
			),
		),
		"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"soros-vlozhil-polmilliona-dollarov-v-otmenu-brexit" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"spice-girls-otpravyatsya-v-mirovoy-tur" => array(
			"READ_ALSO" => array(
				"news" => array(
					"nazvany-pyat-luchshikh-aktris-poluchivshikh-premiyu-oskar",
					"arnold-shvartsenegger-vpervye-sygraet-glavnuyu-rol-v-seriale",
					"reper-basta-nazval-draku-shevchenko-i-svanidze-luchshim-battlom",
				),
			),
		),
		"sportsmeny-rf-smogut-na-oi-2018-nosit-shapku-v-tsvetakh-rossii" => array(
			"READ_ALSO" => array(
				"news" => array(
					"balotelli-i-buffona-mogut-vyzvat-na-tovarishcheskie-matchi-sbornoy-italii",
					"peres-nachal-rassledovanie-o-lichnoy-zhizni-neymara",
					"artem-anisimov-propustil-trenirovku-chikago",
				),
			),
		),
		"sudey-osvobozhdayut-ot-obyasneniya-motivov" => array(
			"READ_ALSO" => array(
				"news" => array(
					"poslom-zayavki-ekaterinburga-na-ekspo-2025-stanet-matreshka",
					"dvoe-velosipedistov-otpravilis-iz-samary-v-saratov-po-ldu-volgi",
					"turoperatory-rasskazali-poletyat-li-tomichi-v-egipet-v-2018-godu",
				),
			),
		),
		"tesla-model-x-pervym-iz-elektrokarov-peresek-sakharu" => array(
			"READ_ALSO" => array(
				"news" => array(
					"obnarodovany-fotografii-novogo-kia-sportage",
					"hyundai-sozdala-subbrend-n-sport-dlya-zaryazhennykh-modeley",
					"skoda-pokazala-obnovlyennuyu-fabia",
				),
			),
		),
		"turoperatory-rasskazali-poletyat-li-tomichi-v-egipet-v-2018-godu" => array(
			"READ_ALSO" => array(
				"news" => array(
					"sudey-osvobozhdayut-ot-obyasneniya-motivov",
					"poslom-zayavki-ekaterinburga-na-ekspo-2025-stanet-matreshka",
					"dvoe-velosipedistov-otpravilis-iz-samary-v-saratov-po-ldu-volgi",
				),
			),
		),
		"u-bezrabotnogo-moskvicha-ukrali-lexus-za-6-6-milliona-rubley" => array(
			"READ_ALSO" => array(
				"news" => array(
					"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami",
					"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley",
					"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira",
				),
			),
		),
		"uchenye-nashli-vymershiy-vid-khvostatykh-paukov" => array(
			"READ_ALSO" => array(
				"news" => array(
					"rakov-mutantov-nazvali-ikonami-feminizma",
					"uchenye-nauchilis-uluchshat-pamyat-lyudey",
					"kitay-oboruduet-podlodki-iskusstvennym-intellektom",
				),
			),
		),
		"uchenye-nauchilis-uluchshat-pamyat-lyudey" => array(
			"READ_ALSO" => array(
				"news" => array(
					"rakov-mutantov-nazvali-ikonami-feminizma",
					"kitay-oboruduet-podlodki-iskusstvennym-intellektom",
					"uchenye-nashli-vymershiy-vid-khvostatykh-paukov",
				),
			),
		),
		"v-krasnoyarskom-krae-presekli-bunt-zaderzhannykh-nelegalov" => array(
			"READ_ALSO" => array(
				"news" => array(
					"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami",
					"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley",
					"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira",
				),
			),
		),
		"v-kremle-otvergli-obvinenia-rossiy-v-kiberattakach" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
		"v-neskolkikh-regionakh-rossii-zafiksirovany-moshchnye-vspyshki-orvi" => array(
			"READ_ALSO" => array(
				"news" => array(
					"v-neskolkikh-regionakh-rossii-zafiksirovany-moshchnye-vspyshki-orvi",
					"vo-vsekh-poliklinikakh-moskvy-ustanovyat-elektronnye-tablo",
					"v-permskikh-shkolakh-iz-za-grippa-obyavili-karantin",
				),
			),
		),
		"v-permskikh-shkolakh-iz-za-grippa-obyavili-karantin" => array(
			"READ_ALSO" => array(
				"news" => array(
					"v-neskolkikh-regionakh-rossii-zafiksirovany-moshchnye-vspyshki-orvi",
					"vo-vsekh-poliklinikakh-moskvy-ustanovyat-elektronnye-tablo",
					"v-permskikh-shkolakh-iz-za-grippa-obyavili-karantin",
				),
			),
		),
		"vo-ldakh-okhotskogo-morya-zastryal-teplokhod-so-127-passazhirami" => array(
			"READ_ALSO" => array(
				"news" => array(
					"mvd-predlozhilo-usilit-nakazanie-dlya-pyanykh-voditeley",
					"samolet-vernulsya-v-aeroport-vyleta-na-alyaske-iz-za-gologo-passazhira",
					"u-bezrabotnogo-moskvicha-ukrali-lexus-za-6-6-milliona-rubley",
				),
			),
		),
		"vo-vsekh-poliklinikakh-moskvy-ustanovyat-elektronnye-tablo" => array(
			"READ_ALSO" => array(
				"news" => array(
					"v-neskolkikh-regionakh-rossii-zafiksirovany-moshchnye-vspyshki-orvi",
					"vo-vsekh-poliklinikakh-moskvy-ustanovyat-elektronnye-tablo",
					"v-permskikh-shkolakh-iz-za-grippa-obyavili-karantin",
				),
			),
		),
		"voditeley-predupredyat-ob-evakuatsii-mashiny-po-telefonu" => array(
			"READ_ALSO" => array(
				"news" => array(
					"obnarodovany-fotografii-novogo-kia-sportage",
					"hyundai-sozdala-subbrend-n-sport-dlya-zaryazhennykh-modeley",
					"tesla-model-x-pervym-iz-elektrokarov-peresek-sakharu",
				),
			),
		),
		"whatsapp-testiruet-platyezhnuyu-sistemu" => array(
			"READ_ALSO" => array(
				"news" => array(
					"apple-zapatentovala-risuyushchiy-po-vozdukhu-stilus",
					"ryzhie-temnokozhie-poyavyatsya-v-novom-nabore-emodzi",
					"nokia-zaregistrirovala-dva-smartfona-v-rossii",
				),
			),
		),
		"yaponiya-rossiya-provotsiruet-ssha-na-novuyu-gonku-vooruzheniy" => array(
			"READ_ALSO" => array(
				"news" => array(
					"roskomnadzor-proverit-facebook-vo-vtoroy-polovine-2018-goda",
					"smi-soobshchili-o-voennom-parade-v-kndr-nakanune-olimpiady",
					"pervye-istrebiteli-pyatogo-pokoleniya-postupyat-v-voyska-v-2019-godu",
				),
			),
		),
	),
);


$arrFilterElementIDs = array();
$arElementsUsed = array();
$arrIBlockIDs = array();
foreach($arFilterIBlocks as $arFilterIBlock){
	$rsIBlock = CIBlock::GetList(array(), array( 'TYPE' => $arFilterIBlock['IBLOCK_TYPE'], 'CODE' => $arFilterIBlock['IBLOCK_CODE'], 'XML_ID' => $arFilterIBlock['IBLOCK_XML_ID'] ));
	if($arIBlock = $rsIBlock->Fetch()){
		$arrIBlockIDs[$arFilterIBlock['IBLOCK_CODE']] = $arIBlock['ID'];
	}
}
foreach($arrFilterElements as $sCatalogCode1 => $arFilterCatalog1){
	foreach($arFilterCatalog1 as $sElementCode1 => $arFilterElement1){
		$arElementsUsed[$sCatalogCode1][] = $sElementCode1;
		foreach($arFilterElement1 as $sPropertyCode => $arPropertyValue){
			foreach($arPropertyValue as $sCatalogCode2 => $arFilterCatalog2){
				foreach($arFilterCatalog2 as $sElementCode2){
						$arElementsUsed[$sCatalogCode2][] = $sElementCode2;
				}
			}
		}
	}
}
foreach($arElementsUsed as $sCatalogCode => $arCatalogElementsUsed){
	$arElementsUsed[$sCatalogCode] = array_unique($arCatalogElementsUsed);
}
foreach($arElementsUsed as $sCatalogCode => $arCatalogElementsUsed){
$res = CIBlockElement::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => $arrIBlockIDs[$sCatalogCode], 'CODE' => $arCatalogElementsUsed));
	while($arElement = $res->GetNext()){
		$arElementIDs[$sCatalogCode][$arElement['CODE']] = $arElement['ID'];
	}
}
foreach($arrFilterElements as $sCatalogCode1 => $arFilterCatalog1){
	foreach($arFilterCatalog1 as $sElementCode1 => $arFilterElement1){
		$arFilterProps = array();
		foreach($arFilterElement1 as $sPropertyCode => $arPropertyValue){
			foreach($arPropertyValue as $sCatalogCode2 => $arFilterCatalog2){
				foreach($arFilterCatalog2 as $sElementCode2){
					$arFilterProps[$sPropertyCode][] = $arElementIDs[$sCatalogCode2][$sElementCode2];

				}
			}
		}
		CIBlockElement::SetPropertyValuesEx($arElementIDs[$sCatalogCode1][$sElementCode1], $arrIBlockIDs[$sCatalogCode1],  $arFilterProps);
	}
}