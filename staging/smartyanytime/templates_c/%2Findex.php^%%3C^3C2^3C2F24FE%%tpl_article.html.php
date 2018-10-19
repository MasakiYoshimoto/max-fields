<?php /* Smarty version 2.6.27, created on 2013-08-08 15:20:45
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/info/tpl_article.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_detail', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/info/tpl_article.html', 8, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/info/tpl_article.html', 34, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%3C^3C2^3C2F24FE%%tpl_article.html.inc'] = '53398886a2422e2e3f9820007e552fa0'; ?><?php 
define('PAGE_TITLE', 'お知らせ・最近のコンサル活動実績 | 株式会社マックスフィールズ');
define('PAGE_DESCRIPTION', '静岡・都内の派遣アウトソーシング、コンサルティングはマックスフィールズ。製造・物流の経営効率化をサポートします。');
define('BODY_CLASS', 'info');

include('./maxfields/include/header.php'); ?>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:53398886a2422e2e3f9820007e552fa0#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_detail(array('id' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:53398886a2422e2e3f9820007e552fa0#0}'; endif;?>

<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li><a href="./">お知らせ・最近のコンサル活動実績</a></li>
		<li><?php echo $this->_tpl_vars['data']['TITLE']; ?>
</li>
	</ol>
</div>


<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title.gif" alt="information">
					<span>お知らせ・最近のコンサル活動実績</span>
				</h2>
			</div>

			<div class="infoArticleHeader">
				<span><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['RELEASE_DATE'])) ? $this->_run_mod_handler('d_format', true, $_tmp, "Y.m.d") : smarty_modifier_d_format($_tmp, "Y.m.d")); ?>
</span>
				<a href="./">お知らせ一覧</a>
				<h3><?php echo $this->_tpl_vars['data']['TITLE']; ?>
</h3>
			</div><!--/.infoArticleHeader-->

			<div class="infoArticleBody"><?php echo $this->_tpl_vars['data']['HONBUN']; ?>
</div>

			<?php if ($this->_tpl_vars['data']['PICNUM']): ?>
				<div class="infoArticleImage">
					<ul>
						<?php if ($this->_tpl_vars['data']['PIC1']): ?><li><a href="<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC1']; ?>
" rel="colorbox"><img src="<?php echo $this->_tpl_vars['wwwroot']; ?>
/thumbs/img2.php<?php echo $this->_tpl_vars['magic']; ?>
&filename=<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC1']; ?>
&newxsize=190" alt="<?php echo $this->_tpl_vars['data']['TITLE']; ?>
"></a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['data']['PIC2']): ?><li><a href="<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC2']; ?>
" rel="colorbox"><img src="<?php echo $this->_tpl_vars['wwwroot']; ?>
/thumbs/img2.php<?php echo $this->_tpl_vars['magic']; ?>
&filename=<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC2']; ?>
&newxsize=190" alt="<?php echo $this->_tpl_vars['data']['TITLE']; ?>
"></a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['data']['PIC3']): ?><li><a href="<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC3']; ?>
" rel="colorbox"><img src="<?php echo $this->_tpl_vars['wwwroot']; ?>
/thumbs/img2.php<?php echo $this->_tpl_vars['magic']; ?>
&filename=<?php echo $this->_tpl_vars['image_url']; ?>
/<?php echo $this->_tpl_vars['data']['PIC3']; ?>
&newxsize=190" alt="<?php echo $this->_tpl_vars['data']['TITLE']; ?>
"></a></li><?php endif; ?>
					</ul>
				</div><!--/.infoArticleImage-->
			<?php endif; ?>

			<?php if ($this->_tpl_vars['data']['FILENUM']): ?>
				<div class="infoArticleFile">
					<h4><img src="img/file_download.gif" alt="File Donwload" width="97" height="16"></h4>
					<ul>
						<?php if ($this->_tpl_vars['data']['ATTACHFILE1']): ?><li><a href="<?php echo $this->_tpl_vars['file_url']; ?>
/<?php echo $this->_tpl_vars['data']['ATTACHFILE1']; ?>
" target="_blank"><?php if ($this->_tpl_vars['data']['ATTACHFILE1_TITLE']): ?><?php echo $this->_tpl_vars['data']['ATTACHFILE1_TITLE']; ?>
<?php else: ?><?php echo $this->_tpl_vars['data']['FILE_TYPE1']; ?>
ファイル<?php endif; ?>（<?php echo $this->_tpl_vars['data']['EXTENSION1']; ?>
）</a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['data']['ATTACHFILE2']): ?><li><a href="<?php echo $this->_tpl_vars['file_url']; ?>
/<?php echo $this->_tpl_vars['data']['ATTACHFILE2']; ?>
" target="_blank"><?php if ($this->_tpl_vars['data']['ATTACHFILE2_TITLE']): ?><?php echo $this->_tpl_vars['data']['ATTACHFILE2_TITLE']; ?>
<?php else: ?><?php echo $this->_tpl_vars['data']['FILE_TYPE2']; ?>
ファイル<?php endif; ?>（<?php echo $this->_tpl_vars['data']['EXTENSION2']; ?>
）</a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['data']['ATTACHFILE3']): ?><li><a href="<?php echo $this->_tpl_vars['file_url']; ?>
/<?php echo $this->_tpl_vars['data']['ATTACHFILE3']; ?>
" target="_blank"><?php if ($this->_tpl_vars['data']['ATTACHFILE3_TITLE']): ?><?php echo $this->_tpl_vars['data']['ATTACHFILE3_TITLE']; ?>
<?php else: ?><?php echo $this->_tpl_vars['data']['FILE_TYPE3']; ?>
ファイル<?php endif; ?>（<?php echo $this->_tpl_vars['data']['EXTENSION3']; ?>
）</a></li><?php endif; ?>
					</ul>
				</div><!--/.infoArticleFile-->
			<?php endif; ?>

			<div class="infoBackIndex">
				<a href="./">お知らせ一覧</a>
			</div><!--/.infoBackIndex-->

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	
<?php  include('./maxfields/include/sidebar.php'); ?>

</div><!--/#contentWrap-->


<?php  include('./maxfields/include/footer.php'); ?>