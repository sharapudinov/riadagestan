// 0.0.3
require.config({
  // пути к основным модулям приложения
	paths: {
		jquery: './src/jquery-1.8.3.min',
		moment: './src/moment.min',
		momentRu: './src/moment-ru',
		calendar: './src/calendar'
	},
  // скрипты не имеющие поддержки AMD
  shim: {
    momentRu: ['moment']
  }
});

define(function(require, exports, module) {
  var _debug = true;
	// jquery loader
	(function(w, minVersion) {
		if(typeof jQuery!= 'undefined') {
			// в этой точке библитека jQuery готова к использованию
			if(jQuery().jquery <= minVersion.toString()) {
				// если версия библиотеки jQuery устарела
				var noConflict = (typeof $!='undefined' && $==jQuery) ? false : true;
				var _tmpJq = jQuery;

				require(['jquery'], function($) {
					w.jq = $.noConflict(true);
					jQuery = _tmpJq;
					!noConflict && ($ = _tmpJq);
					loaderCallback();
				});
			}
			else {
				// библиотека jQuery имеет актуальную версию
				w.jq = jQuery;
				loaderCallback();
			}
		}
		else {
			//jquery not loaded
			require(['jquery'], function() {
				w.jq = jQuery;
				loaderCallback();
			});
		}
	})(window, '1.7');

	function loaderCallback() {

		// асинхронная загрузка приложения
		// и необходимых библиотек
		require(['calendar', 'momentRu', 'moment'], function(calendar, momentru, moment){
			moment.lang && moment.lang('ru');
			calendar.init(window.jq);
		});
	}
});
