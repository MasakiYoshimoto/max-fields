<?php /* Smarty version 2.6.27, created on 2018-09-05 17:27:40
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/tops//index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/tops//index.html', 140, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>管理画面</title>
<link href="<?php echo $this->_tpl_vars['html']->webroot('css/common.css'); ?>
" rel="stylesheet" type="text/css">
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
google.load("jquery","1.3.1");
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.css'); ?>
" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/highcharts/highcharts.js'); ?>
" type="text/javascript"></script>
<script type="text/javascript">
<?php if ($this->_tpl_vars['analytics']['profile_id']): ?>
$(function(){
	var options = {
		// 描写先やグラフのタイプを指定する
		chart: {
			renderTo: 'high_chart',
			defaultSeriesType: 'line'
		},

		// グラフのタイトルとデザイン
		title: {
			text: ''
		},

		// グラフの横軸のメモリと単位
		xAxis: {
			categories: [<?php echo $this->_tpl_vars['date_list']; ?>
],
			title: {
				text: '日付'
			}
		},

		// グラフの縦軸のメモリと単位
		yAxis: {
			title: {
				text: null
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			min:0
		},

		// グラフ頂点でのツールチップ表示の方法
		tooltip: {
			formatter: function() {
				return '<STRONG>'+ this.series.name +'</STRONG>'+
				this.x +' : '+ this.y;
			}
		},
		legend: {
			layout: 'vertical',
			style: {
				left: 'auto',
				bottom: 'auto',
				right: '10px',
				top: '100px'
			}
		},

		// クレジット
		credits: {
			enabled: false
		},

		// 表示するデータを配列形式で保持する
		series: []
	};

	// JSON形式でデータを取得する
	$.getJSON('<?php echo $this->_tpl_vars['html']->webroot('myreports'); ?>
', function(jsonData) {

		// 各データをoptionsのseriesにセットしていく
		$.each(jsonData.chartDatas, function(dataNumber, series_data) {
			options.series.push(series_data);
		});

		// グラフを描写する
		var chart = new Highcharts.Chart(options);
	});

	var now = new Date();
	$('#ranking').load('<?php echo $this->_tpl_vars['html']->webroot("myreports/ranking/m:"); ?>
'+now.getTime());

});
<?php else: ?>
$(function(){
	$('#access-graph').html("");
	$('#access-rank').html("");
});
<?php endif; ?>
</script>
</head>


<body>
<div class="wordBreak" style="word-break:break-all;">

<!--header-->
<div id="header">
<div id="header-inner">

<!--logo-->
<?php echo $this->_tpl_vars['this']->renderElement('logo'); ?>

<!--logoここまで-->

</div>
</div>
<!--headerここまで-->

<!--pagebody-->
<div id="pagebody">
<div id="pagebody-inner">

<!--sidebar-->
<?php echo $this->_tpl_vars['this']->renderElement('side_menu'); ?>

<!--sidebarここまで-->

<!--content-->
<div id="content">
<h2>トップ</h2>
<div id="content-inner">

<div class="cont" id="free-space"><?php echo $this->_tpl_vars['free_space']; ?>
</div>

<p><a href="http://www.google.com/intl/ja/analytics/" target="_blank" /> Google Analytics </a></p>
<div id="access-graph" class="cont">
<h3>直近10日間の日別アクセス数(<?php echo ((is_array($_tmp=$this->_tpl_vars['period1'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
)</h3>
<div style="padding-top:10px;border: solid 1px #aaaaaa;"><div id="high_chart" style="height:200px;width:600px;"><img src="<?php echo $this->_tpl_vars['html']->webroot('images/ajax-loader.gif'); ?>
" style="margin:84px 0px 0px 280px;" /></div></div>
</div>

<div id="access-rank" class="cont pageList">
<h3>直近1ヶ月間のアクセス数ランキング(<?php echo ((is_array($_tmp=$this->_tpl_vars['period2'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
)</h3>
<div id="ranking"><div style="border: solid 1px #aaaaaa;"><img src="<?php echo $this->_tpl_vars['html']->webroot('images/ajax-loader.gif'); ?>
" style="margin:0px 0px 0px 280px;" /></div></div>
</div>

</div>
</div>
<!--contentここまで-->

</div>
</div>
<!--pagebodyここまで-->

<!--scroll-->
<div id="scroll">
<div id="scroll-inner">
<a href="#header">ページの先頭へ</a>
</div>
</div>
<!--scrollここまで-->

<!--footer-->
<div id="footer">
</div>
<!--footerここまで-->

<?php echo $this->_tpl_vars['this']->renderElement('copyright'); ?>


</div>
</body>
</html>