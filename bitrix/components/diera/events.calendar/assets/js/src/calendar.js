// version 0.1.5-a
define(function(require, exports, module){

  var options = {
      debug: false
    , calendarWrapper: "#calendarWrapper"
    , tooltipOffset:  { top: 15, left: 45 }
  }

  var
      _DEBUG = false // logger
    , tooltipTimer
    , ej // raw events data
    , LEFT_CAL // calendar object
    , calendarWrapper = "#calendarWrapper"
    , $_tooltip
    , tooltipOffset = { top: 15, left: 45 }; // parsed events data

  exports.init = init;

  function init($,params){

    log('inside $ -> ', $().jquery);

    $(function() { //DOM Ready

      if(window.eventsJson) {
        ej = window.EJ = eventsJson;
        // start this point
        initCalendar(function callbackInit(err){
          log('calendar init complete');
          reinitLinks(); // draw markers
        });

      } else {
        log('events not found');
        ej = null;
      }

      function initCalendar(fn) {

        // Создание DOM-tooltip
        // <div id="eventsCalendarTooltip" dyn-date="" dyn-start="" dyn-stop="">
        // <div class="tooltipBg"></div>
        // <div class="tooltipBody"></div>
        //  <div class="arrow"></div>
        //  <a class="close" href="#">&times;</a>
        // </div>

        $_tooltip = $('<div></div>').hide()
          .attr({'id':'eventsCalendarTooltip','dyn-date':'','dyn-start':'','dyn-stop':''})
          .append($('<div></div>').addClass('tooltipBg'))
          .append($('<div></div>').addClass('tooltipBody'))
          .append($('<div></div>').addClass('arrow'))
	      .append($('<a>&times;</a>').attr({ 'class': 'close', 'href': '#'}));

        // Добавляем в конец страницы
        $('body').append($_tooltip);

        log('start init');

        LEFT_CAL = Calendar.setup({
          cont: 'eventsCalendar',
          weekNumbers: false,
          selectionType: Calendar.SEL_SINGLE, // only single now works
          //showTime: 12
          // titleFormat: "%B %Y"
          onSelect: function(e){ toggleTooltip(e.selection.sel); },
          onFocus: function(e){  reinitLinks(); },
          onChange: function(e){
            simpleHideTooltip();
            // при скроллинге нужна небольшая пауза
            setTimeout(function(){ reinitLinks(); }, 500);
          },
          onBlur: function(e){ reinitLinks(); },
          dateInfo: function getInfo(date){ return getCEvents(date); }
        });


        $('body').on('click',function bodyClick(){ simpleHideTooltip(); }); // hide tooltip on outer click
        $(window).resize(function windowResize(){ simpleHideTooltip(); }); // hide tooltip on resize

        fn(null);
      }

      // v 0.0.1
      function getCEvents(date,fn){
        var date_as_number = Calendar.dateToInt(date);
        if(window.EJ[date_as_number]) {
          return { klass: window.EJ[date_as_number].klass, tooltip: null };
        }
      }

      // template helper to format tooltip
      // Todo: create tooltip template
      // v 0.0.1
	    function formatTooltip(item) {

		    var _tmpl = [], items = item.data, dateStart, dateEnd;

		    if(item.data.length > 0) {
			    for(var i = 0; i < items.length; i++) {

				    dateStart = new Date(parseInt(items[i].dateStart) * 1000);
				    //var _ds = dateStart.getFullYear() + "-" + (dateStart.getMonth() + 1) + "-" + dateStart.getDate();
				    var _ds = moment(dateStart).format('LL');

				    _tmpl.push('<a class="dateEvent" href="' + items[i].url + '">');
				    _tmpl.push('<span class="eventHeader">' + items[i].name + '</span>');
				    //_tmpl.push('<h3>' + items[i].name + '</h3>');
				    _tmpl.push('<span class="dateRange">');
				    _tmpl.push('<span class="start">' + _ds || 'no date' + '</span>');

				    if(items[i].dateEnd != "") {

					    dateEnd = new Date(parseInt(items[i].dateEnd) * 1000);
					    //var _de = dateEnd.getFullYear() + "-" + (dateEnd.getMonth() + 1) + "-" + dateEnd.getDate();
					    var _de = moment(dateEnd).format('LL');

					    _tmpl.push('<span class="end"> — ' + _de || "no date" + '</span>');

				    }

				    _tmpl.push('</span>');
				    //_tmpl.push('<a class="eventlink" href="' + items[i].url + '">' + items[i].name + '</a>');
				    _tmpl.push('</a>');

			    }

			    return _tmpl.join('\n');

		    }

		    return null;
	    }

      // Hide/Show Tooltip
      // v 0.0.7-a
      function toggleTooltip(items,fn){
        var _offset, $tooltip, $box, dateSelected;

        dateSelected = items[0];

        if(tooltipTimer) clearTimeout(tooltipTimer);

        $tooltip = $('#eventsCalendarTooltip');
        $box = $('div[dyc-date='+dateSelected+']',".DynarchCalendar");
        _offset = $box.offset();

        if( $box.hasClass('calendarEvent') && $box.hasClass('DynarchCalendar-day-othermonth') ) {
          setTimeout(function(){
            $box = $('div[dyc-date='+dateSelected+']',".DynarchCalendar");
            _offset = $box.offset();
            animateTooltip($tooltip,_offset);
          },500);
        } else {
          $box = $('div[dyc-date='+dateSelected+']',".DynarchCalendar");
          _offset = $box.offset();
        }

        // if already exists
        if($tooltip.hasClass('date' + dateSelected)){
          if($tooltip.css('display') == 'none') {
            $tooltip
              .animate({
                top: _offset.top - tooltipOffset.top,
                left: _offset.left + tooltipOffset.left
              })
              .fadeIn();
            return;
          } else {
            return;
          }
        }

        log('toggle',items[0]);

        // todo: ?

        // close link
        $tooltip.on('click',function clickOnTooltip(e){
	      if($($(e.target)[0]).is('a span')) return;
          if( ($(e.target)[0].tagName).toLowerCase() == 'a' && !$(e.target).hasClass('close') ) {
            return;
          } else {
            // click on close
            $tooltip.removeClass();
            return false;
          }
        });

        if(undefined === window.EJ[dateSelected]) {
          $tooltip
            .removeClass()
            .fadeOut();
        } else {
          if(window.EJ && window.EJ[dateSelected].data) { // create new
            $tooltip
              .attr('dyn-date',dateSelected)
              .find('.tooltipBody')
              .html(formatTooltip(window.EJ[dateSelected]))
              .end()
              .find('a.close').on('click',function closeTooltip(){ $tooltip.fadeOut(); })
              .end()
              .animate({
                top: _offset.top - tooltipOffset.top,
                left: _offset.left +tooltipOffset.left
              })
              .fadeIn()
              .removeClass()
              .addClass('date' + dateSelected);
          } else {
            $tooltip
              .removeClass()
              .fadeOut();
          }
        }

        return fn && fn(null);
      }

      // helper for timeout animate
      function animateTooltip($el,offset){
        $el
          .animate({
            top: offset.top - tooltipOffset.top,
            left: offset.left +tooltipOffset.left
          })
          .fadeIn();
        return $el;
      }

      // helper for hide tooltip
      function simpleHideTooltip(fn){
        $('#eventsCalendarTooltip').hide();
        fn && fn(null);
      }

      // инициализация активных событий (ссылок)
      // обертка дат событий в ссылки
      // v. alpha
      function reinitLinks(fn){
	    return;
        var mydate, $tooltip, $selected;
        $tooltip = $('#eventsCalendarTooltip');

        $('.calendarEvent').each(function wrapDate(idx,item){
          if($(item).has('a').length == 0) {
            $(item)
              .wrapInner('<a class="calendarEventLink" href="#tooltip"></a>')
              .on({
                'mouseover' : function(e){ },
                'mouseenter': function(e){ },
                'click': function(e){ },
                'mousedown': function(e){ },
                'mouseup': function(e){ }
              });
          }
        });

        $selected = $('.DynarchCalendar-day-selected',".DynarchCalendar");
        log($selected.attr('dyc-date'));

        return fn && fn(null);
      }

    }); // Dom ready end

  }

  // helpers
  function log(){
    _DEBUG && typeof(console.log) === 'function' && console.log(arguments);
  }

});