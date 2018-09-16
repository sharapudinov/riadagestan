/**
 * Created by Asus- on 02.02.2015.
 */
var offset_menu = $("#menu-wrap").offset();
var initialMargin = 5;

var _scroll= function(){
    this.scrollable_element=null;
    this.menu_wrap=$("#menu-wrap");
    this.line=$(".line");
    this.news_item1 = $('.news_item1');
    this.right = $(".right_news_spisok");
    this.zaglushka = $('#menu-zaglushka');
    this.main = $('.main');
    this.scrollContent=function () {
        if (!!this.scrollable_element) {
            this.paddingTop=initialMargin + parseInt(this.scrollable_element.css('margin-bottom'))+
            parseInt(this.main.css('padding-top')) + parseInt(this.main.css('padding-bottom')) ;
            if ($(window).scrollTop() > offset_menu.top) {
                if (this.main.height() - $(window).scrollTop() + offset_menu.top <= this.scrollable_element.height() +
                    this.zaglushka.height() + this.paddingTop) {
                    this.scrollable_element.css('margin-top', this.main.height() - this.scrollable_element.height() - this.zaglushka.height());
                } else {
                    this.scrollable_element.css('margin-top', $(window).scrollTop() - offset_menu.top + initialMargin);
                }
            } else
                this.scrollable_element.css('margin-top', initialMargin);
        }
    }

    this.scrollMenu = function () {
        if ($(window).scrollTop() > offset_menu.top) {
            if (!this.menu_wrap.hasClass('fixed_menu')) {
                this.line.addClass('fixed_line');
                this.menu_wrap.addClass('fixed_menu');
                this.zaglushka.show();
            }
        }
        else {
            if (this.menu_wrap.hasClass('fixed_menu')) {
                this.menu_wrap.removeClass('fixed_menu');
                this.line.removeClass('fixed_line');
                this.zaglushka.hide();
            }
        }
    }

    this.defineScrollable=function(){
        if (this.news_item1.length > 0 && (this.news_item1.height() < this.right.height())) {
            this.scrollable_element = this.news_item1;
        }
        else if (this.right.length > 0) {
            this.scrollable_element = this.right;
        } else this.scrollable_element=null;
    }

    this.reset=function (){
        this.news_item1.css('margin-top',initialMargin);
        this.right.css('margin-top',initialMargin);
    }
}

