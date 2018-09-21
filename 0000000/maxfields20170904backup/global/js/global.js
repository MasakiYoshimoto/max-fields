/*
 * transformとtransitionをサポートしてるかどうかの判別
 */
(function($){
    
    var el = $("<div>");
    
    $.support.transform  = typeof el.css("transform") === "string";
    $.support.transition = typeof el.css("transitionProperty") === "string";
    
})(jQuery);


/*
 * スライドショーのプラグイン
 */
(function($){

	$.fn.slideShow = function(options){

		var $items, itemLen, settings, timer, currentIndex, isPlaying;

		$items = this;
		itemLen = $items.length;

		settings = $.extend({
			duration: 400,
			interval: 4000,
			autoplay: true,
			prevBtn: null,
			nextBtn: null
		}, options);

		// 引数のインデックスのアイテムを表示
		var show = function(index){
			$items.eq(currentIndex).fadeOut(settings.duration);
			$items.eq(currentIndex = index).fadeIn(settings.duration);
			if(isPlaying){
				readyNext();
			}
		};

		// 次のアイテムを表示
		var next = function(){
			show( (currentIndex + 1) % itemLen );
		};

		// 前のアイテムを表示
		var prev = function(){
			show( (currentIndex - 1 + itemLen) % itemLen );
		};

		// インターバルを置いて次のアイテムを表示（オートプレイ用）
		var readyNext = function(){
			if(timer){
				clearTimeout(timer);
				timer = null;
			}
			timer = setTimeout(function(){
				timer = null;
				next();
			}, settings.interval);
		};

		// オートプレイを開始
		var startAutoPlay = function(){
			if(isPlaying){
				return;
			}
			isPlaying = true;
			readyNext();
		};

		// オートプレイを停止
		var pauseAutoPlay = function(){
			if(!isPlaying){
				return;
			}
			isPlaying = false;
			clearTimeout(timer);
			timer = null;
		};

		// 初期化
		var ini = function(){
			show(0);
			if(itemLen < 2){
				return;
			}
			settings.prevBtn && settings.prevBtn.show().click(prev);
			settings.nextBtn && settings.nextBtn.show().click(next);
			settings.autoplay && startAutoPlay();
		};

		ini();

	};

})(jQuery);


/*
 * 全域で実行
 */
(function($){

	// スクロールアニメーション
	// IE7でアニメーション後にハッシュ加えるときにスクロール位置が変化する、原因はbodyのmarginTop
	var scroller = new $.Tinyscroller();

	// クッキーにハッシュがある場合はスクロールアニメーションで移動
	(function( scrollTo ){
		if( !scrollTo ){
			return;
		}
		$.removeCookie("scrollTo", {path: "/"});
		$(window).load(function(){
			scroller.scrollTo(scrollTo);
		});
	})( $.cookie("scrollTo") );

	// クリックによるスクロールアニメーション
	// ハッシュ付きリンクはクッキーにハッシュを保存して、ハッシュ無しでページ遷移
	$(document).on("click", "a[href*=#]", function(e){
		var anchorHref = this.href.split("#");
		if( anchorHref[0] === location.href.split("#")[0] ){
			e.preventDefault();
			scroller.scrollTo("#" + anchorHref[1]);
		}else{
			$.cookie("scrollTo", "#" + anchorHref[1], {path: "/"});
			this.href = anchorHref[0];
		}
	});

	// color box
	$(document).on("click", "a[rel=colorbox]", function(e){
		e.preventDefault();
		$.colorbox({href: $(this).attr("href")});
	});
	
	if( $.support.transition ){
		$("html").addClass("transition");
	}else{
		$(document).on("mouseover", "a img, .fade", function(e){
			$(this).stop(true).fadeTo(400, 0.6);
		});
		$(document).on("mouseout", "a img, .fade", function(e){
			$(this).fadeTo(400, 1);
		});
	}
	


})(jQuery);