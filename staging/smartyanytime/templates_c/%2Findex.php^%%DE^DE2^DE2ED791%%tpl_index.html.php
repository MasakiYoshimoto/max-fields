<?php /* Smarty version 2.6.27, created on 2016-03-07 15:59:09
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 42, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 67, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 67, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%DE^DE2^DE2ED791%%tpl_index.html.inc'] = '18f485069579b727c228757a784ccfc7'; ?><?php 
define('PAGE_TITLE', '求人案件 | 株式会社マックスフィールズ');
define('PAGE_DESCRIPTION', '静岡・都内の派遣アウトソーシング、コンサルティングはマックスフィールズ。あなたの力を発揮する確かなフィールド。');
define('BODY_CLASS', 'jobsearch');

include('./gmi2/include/header.php');  ?>


<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>求人案件</li>
	</ol>
</div>
<!-- コンテント(SP用) -->
<div id="topicpath_sp">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>求人案件</li>
	</ol>
</div>
<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title.gif" alt="Job information">
					<span>求人案件</span>
				</h2>
			</div>
				<p class="outTitle00">◎ 求人検索</p>
						<div id="secondary">
							<?php  include('./gmi2/include/search_box.php');  ?>
						</div><!-- end #secondary-->

				<p class="outTitle00">◎ 求人一覧</p>
                        <?php if ($this->caching && !$this->_cache_including): echo '{nocache:18f485069579b727c228757a784ccfc7#0}'; endif;echo smartyanytime_plugins_job2::job2_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 9), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:18f485069579b727c228757a784ccfc7#0}'; endif;?>

                        <?php if ($this->_tpl_vars['job']['list']): ?>
						<div id="primary">
								<div id="jobinfo">
									<ul>
									<?php $_from = $this->_tpl_vars['job']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['job_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['job_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['job_list']['iteration']++;
?>
										<li>
                                            <?php if ($this->_tpl_vars['value']['category'] == 10000): ?>
                                            <?php $this->assign('cat_no', '1'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 10010): ?>
                                            <?php $this->assign('cat_no', '2'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 10020): ?>
                                            <?php $this->assign('cat_no', '3'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 10030): ?>
                                            <?php $this->assign('cat_no', '3'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 10040): ?>
                                            <?php $this->assign('cat_no', '4'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 10050): ?>
                                            <?php $this->assign('cat_no', '5'); ?>
                                            <?php elseif ($this->_tpl_vars['value']['category'] == 99999): ?>
                                            <?php $this->assign('cat_no', '6'); ?>
                                            <?php endif; ?>
											<p class="search_cdn0<?php echo $this->_tpl_vars['cat_no']; ?>
_ttl"><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['value']['category']]; ?>
<p>
											<h3 class="jobtitle"><a href="detail.html?d=<?php echo $this->_tpl_vars['value']['id']; ?>
<?php echo $this->_tpl_vars['job']['search_query']; ?>
"><?php echo $this->_tpl_vars['value']['catchcopy']; ?>
</a></h3>
											<div class="thumbnail"><img src="<?php echo $this->_tpl_vars['wwwroot']; ?>
/thumbs/img2.php<?php echo $this->_tpl_vars['magic']; ?>
&filename=/cms_contents/images/<?php echo $this->_tpl_vars['value']['pic1']; ?>
&newxsize=160&newysize=107&trim=1" width="160" height="107"></div>
											<p class="detail_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['work'])) ? $this->_run_mod_handler('strip', true, $_tmp, '') : smarty_modifier_strip($_tmp, '')))) ? $this->_run_mod_handler('mb_truncate', true, $_tmp, 70) : smarty_modifier_mb_truncate($_tmp, 70)); ?>
</p>
											<div class="readmore"><a href="detail.html?d=<?php echo $this->_tpl_vars['value']['id']; ?>
<?php echo $this->_tpl_vars['job']['search_query']; ?>
" title="詳しく見る">詳細を見る</a></div>
										</li>
									<?php endforeach; endif; unset($_from); ?>
									</ul>
								</div>
                            <?php if ($this->_tpl_vars['job']['list'] && $this->_tpl_vars['job']['maxpage'] != 1): ?>
                            <div id="pagenavi">
                                <ul>
                                    <?php if ($this->_tpl_vars['job']['list'] && $this->_tpl_vars['job']['page'] != 1): ?><li class="arrow"><a href="./?p=<?php echo $this->_tpl_vars['job']['page']-1; ?>
<?php echo $this->_tpl_vars['job']['search_query']; ?>
">&lt;</a></li><?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['job']['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['job_page_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['job_page_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['job_page_list']['iteration']++;
?>
                                    <li class="<?php if ($this->_tpl_vars['job']['page'] == $this->_tpl_vars['value']): ?>current<?php else: ?>current02<?php endif; ?>"><a href="./?p=<?php echo $this->_tpl_vars['value']; ?>
<?php echo $this->_tpl_vars['job']['search_query']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a></li>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['job']['list'] && $this->_tpl_vars['job']['maxpage'] && $this->_tpl_vars['job']['maxpage'] != $this->_tpl_vars['job']['page']): ?><li class="arrow"><a href="./?p=<?php echo $this->_tpl_vars['job']['page']+1; ?>
<?php echo $this->_tpl_vars['job']['search_query']; ?>
">&gt;</a></li><?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div><!-- end #primary-->
                       <?php else: ?>
                        <div id="primary">
                        該当する求人案件がありませんでした。
                        </div>
                       <?php endif; ?>

			<div class="mainPageTop"><a href="#pageTop">ページトップ</a></div>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	
<?php  include('./gmi2/include/sidebar.php');  ?>

</div><!--/#contentWrap-->


<?php  include('./gmi2/include/footer.php');  ?>