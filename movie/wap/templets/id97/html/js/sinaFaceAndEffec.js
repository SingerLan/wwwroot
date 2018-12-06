/**
 * @author 夏の寒风
 * @time 2012-12-14
 */

//自定义hashtable
function Hashtable() {
    this._hash = new Object();
    this.put = function(key, value) {
        if (typeof (key) != "undefined") {
            if (this.containsKey(key) == false) {
                this._hash[key] = typeof (value) == "undefined" ? null : value;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    this.remove = function(key) { delete this._hash[key]; }
    this.size = function() { var i = 0; for (var k in this._hash) { i++; } return i; }
    this.get = function(key) { return this._hash[key]; }
    this.containsKey = function(key) { return typeof (this._hash[key]) != "undefined"; }
    this.clear = function() { for (var k in this._hash) { delete this._hash[k]; } }
}


var emotions1 = new Array();
var categorys1 = new Array();// 分组
var uSinaemotions1Ht = new Hashtable();

// 初始化缓存，页面仅仅加载一次就可以了
$(function() {
	var app_id = '1362404091';
	$.ajax( {
		dataType : 'json',
		url : 'http://m.yfmovie.top/emotions.json',
		success : function(response) {
			var data = response.data;
			for ( var i in data) {
				if (data[i].category == '') {
					data[i].category = '默认';
				}
				if (emotions1[data[i].category] == undefined) {
					emotions1[data[i].category] = new Array();
					categorys1.push(data[i].category);
				}
				emotions1[data[i].category].push( {
					name : data[i].phrase,
					icon : data[i].icon
				});
				uSinaemotions1Ht.put(data[i].phrase, data[i].icon);
			}
		}
	});
});

//替换
function AnalyticEmotion(s) {
	if(typeof (s) != "undefined") {
		var sArr = s.match(/\[.*?\]/g);
		if(null!=sArr && '' != sArr){
			for(var i = 0; i < sArr.length; i++){
				if(uSinaemotions1Ht.containsKey(sArr[i])) {
					var reStr = "<img src=\"" + uSinaemotions1Ht.get(sArr[i]) + "\" height=\"22\" width=\"22\" />";
					s = s.replace(sArr[i], reStr);
				}
			}
		}
		
	}
	return s;
}

(function($){
	$.fn.SinaEmotion = function(target){
		var cat_current;
		var cat_page;
		$(this).click(function(event){
			event.stopPropagation();
			var eTop = target.offset().top + target.height() + 15;
			var eLeft = target.offset().left - 1;
			
			if($('#emotions1 .categorys1')[0]){
				$('#emotions1').css({top: eTop, left: 10});
				$('#emotions1').toggle();
				return;
			}
			$('body').append('<div id="emotions1"></div>');
			$('#emotions1').css({top: eTop, left: 10});
			$('#emotions1').html('<div>正在加载，请稍候...</div>');
			$('#emotions1').click(function(event){
				event.stopPropagation();
			});
			$('#emotions1').html('<div style="float:right"><a href="javascript:void(0);" id="prev" style="height: 19px;margin-top: 3px;padding-top: 1px;">\u00ab</a><a href="javascript:void(0);" id="next" style="height: 19px;margin-top: 3px;padding-top: 1px;">\u00bb</a></div><div class="categorys1"></div><div class="container1"></div>');
			$('#emotions1 #prev').click(function(){
				showcategorys1(cat_page - 1);
			});
			$('#emotions1 #next').click(function(){
				showcategorys1(cat_page + 1);
			});
			showcategorys1();
			showemotions1();
			
		});
		$('body').click(function(){
			$('#emotions1').remove();
		});
		$.fn.insertText = function(text){
			this.each(function() {
				if(this.tagName !== 'INPUT' && this.tagName !== 'TEXTAREA') {return;}
				if (document.selection) {
					this.focus();
					var cr = document.selection.createRange();
					cr.text = text;
					cr.collapse();
					cr.select();
				}else if (this.selectionStart || this.selectionStart == '0') {
					var 
					start = this.selectionStart,
					end = this.selectionEnd;
					this.value = this.value.substring(0, start)+ text+ this.value.substring(end, this.value.length);
					this.selectionStart = this.selectionEnd = start+text.length;
				}else {
					this.value += text;
				}
			});        
			return this;
		}
		function showcategorys1(){
			var page = arguments[0]?arguments[0]:0;
			if(page < 0 || page >= categorys1.length / 5){
				return;
			}
			$('#emotions1 .categorys1').html('');
			cat_page = page;
			for(var i = page * 5; i < (page + 1) * 5 && i < categorys1.length; ++i){
				$('#emotions1 .categorys1').append($('<a href="javascript:void(0);">' + categorys1[i] + '</a>'));
			}
			$('#emotions1 .categorys1 a').click(function(){
				showemotions1($(this).text());
			});
			$('#emotions1 .categorys1 a').each(function(){
				if($(this).text() == cat_current){
					$(this).addClass('current');
				}
			});
		}
		function showemotions1(){
			var category = arguments[0]?arguments[0]:'默认';
			var page = arguments[1]?arguments[1] - 1:0;
			$('#emotions1 .container1').html('');
			cat_current = category;
			for(var i = 0;  i < emotions1[category].length; ++i){
				$('#emotions1 .container1').append($('<a style="border: 1px;border-right: none;display: inline-block;" href="javascript:void(0);" title="' + emotions1[category][i].name + '"><img src="' + emotions1[category][i].icon + '" alt="' + emotions1[category][i].name + '" width="22" height="22" /></a>'));
			}
			$('#emotions1 .container1 a').click(function(){
				target.insertText($(this).attr('title'));
				$('#emotions1').remove();
			});
			 
			$('#emotions1 .categorys1 a.current').removeClass('current');
			$('#emotions1 .categorys1 a').each(function(){
				if($(this).text() == category){
					$(this).addClass('current');
				}
			});
		}
	}
})(jQuery);
