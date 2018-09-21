/*
	下記内容を圧縮し、common.min.jsに書き出して使用する
	このファイル自体は読み込まない
*/
jQuery(function($){
	// var scrollAdjust = 0;	//スムーズスクロールの補正要素
	var scrollAdjust = '#header';	//スムーズスクロールの補正要素
	$('a[href*="#"]').click(function(){	//アンカーをクリックしたらスクロール
		var href = $(this).attr('href').replace(/.*#/gi,'#');	//同一ページならハッシュ以外を削ってページ遷移を抑止
		autoScroll(href,scrollAdjust);
	});
	if(location.hash) autoScroll(location.hash,scrollAdjust,false);	//アクセス時にハッシュがある場合はスクロール
	//スクロール処理	point:目標地点　adjust:位置をずらす場合の基準要素or基準値　anime：アニメーションの有無
	function autoScroll(point,adjust,anime){
		if (adjust === undefined) {	//未定義なら0
			adjust = 0;
		}else if (isNaN(adjust)) {	//数値以外でなら要素として高さ取得
			adjust = $(adjust).outerHeight();
		}
		var target = $((point == '#' || point === '') ? 'html' : point);
		if(!($(target).length)){
			target = $('html');
		}
		if (anime === true || anime === undefined) {	//未定義ならアニメーションさせる
			$('html,body').not(':animated').animate({scrollTop:target.offset().top-adjust},500,'swing');
		}else{
			$('html,body').not(':animated').animate({scrollTop:target.offset().top-adjust},10,'linear');
		}
		return false;
	}

	if(navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/12\./)) {
		$('body').on("mousewheel", function () {	//IEのスクロールを無効にする
			event.preventDefault();
			var wd = event.wheelDelta;
			var csp = window.pageYOffset;
			window.scrollTo(0, csp - wd);
		});
	}

	$('.js-t8').trunk8({//指定要素に行数制限をかける
		lines:1,
		fill:'...'
	});
	$(window).on('scroll resize',function(){
		$('.js-t8').trunk8({//指定要素に行数制限をかける
			lines:1,
			fill:'...'
		});
	});
	$('.js-t8-2').trunk8({//指定要素に行数制限をかける
		lines:2,
		fill:'...'
	});
	$(window).on('scroll resize',function(){
		$('.js-t8-2').trunk8({//指定要素に行数制限をかける
			lines:2,
			fill:'...'
		});
	});

	$(window).on('load scroll', function () {
		//ある程度スクロールしたらTOPへボタン表示
		var topBtn = $('#to-top');
		var scrollPos = 700;
		if ($(this).scrollTop() > scrollPos) {
			$(topBtn).fadeIn();
		} else {
			$(topBtn).fadeOut();
		}
	});



	var topicsSwiper;
	if($('.swiper-topics')[0]){  //Swiperコンテナを検出したら実行
		topicsSwiper = new Swiper ('.swiper-topics', {
			effect: 'fade',        //slide,fade,cube,coverflow
			speed: 200,            //アニメ速度
			fadeEffect: {          //フェードオプション
				crossFade: true      //クロスフェード
			},
			navigation: {
				nextEl: '.swiper-button-next',  //前のページボタンを呼び出す要素
				prevEl: '.swiper-button-prev',  //次のページボタンを呼び出す要素
			},
		});
	}
	var mvSwiper;
	if($('.swiper-anime')[0]){  //Swiperコンテナを検出したら実行
		mvSwiper = new Swiper ('.swiper-anime', {
			effect: 'fade',        //slide,fade,cube,coverflow
			speed: 1500,            //アニメ速度
			loop: true,            //ループ

			autoplay: {                     //オートオプション
				delay: 6000,                  //待機時間
				disableOnInteraction: false,  //操作されたらオート解除
			},
		});
		swiperAnimeON();
	}
	mvSwiper.on('init slideChangeTransitionStart touchEnd', function () {	//スライド完了時のトリガー
		swiperAnimeOFF();
	});
	mvSwiper.on('slideChangeTransitionEnd touchEnd', function () {	//スライド完了時のトリガー
		swiperAnimeON();
	});
	function swiperAnimeON(){
		$('.swiper-slide-active,.swiper-slide-duplicate-active').find('.anime').addClass('active');	//表示スライドのアニメをアクティブ
	}
	function swiperAnimeOFF(){
		$('.swiper-slide').not('.swiper-slide-active,.swiper-slide-duplicate-active').find('.anime').removeClass('active');	//スライド全体のアクティブ解除
	}
});
