<?php /* Smarty version 2.6.27, created on 2015-05-26 11:23:25
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/myjobis/include/search_box.html */ ?>
<div id="serchbox">
    <form action="./job2.html" id="search_form" method="get">
        <div class="category cat1">
            <h2 class="switchHat"><img src="img/job_serchtitle1.gif" width="138" height="25" alt="職種から探す" /><img class="sp" src="img/sp_job_serchtitle_more.gif" width="36" height="36"></h2>
            <ul class="accordion_ul switchDetail">
                <li class="job_category">飲食/フード系</li>
                <li><label for="job1"><input id="job1" type="checkbox" class="search_chk" name="job[]" value="10000" <?php if (in_array ( 10000 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />カフェ</label></li>
                <li><label for="job2"><input id="job2" type="checkbox" class="search_chk" name="job[]" value="10010" <?php if (in_array ( 10010 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />レストラン・ダイニング</label></li>
                <li><label for="job3"><input id="job3" type="checkbox" class="search_chk" name="job[]" value="10020" <?php if (in_array ( 10020 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />ホテル</label></li>
                <li><label for="job4"><input id="job4" type="checkbox" class="search_chk" name="job[]" value="10999" <?php if (in_array ( 10999 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />その他</label></li>
                <li class="job_category">販売/ショップ系</li>
                <li><label for="job5"><input id="job5" type="checkbox" class="search_chk" name="job[]" value="11000" <?php if (in_array ( 11000 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />雑貨</label></li>
                <li><label for="job6"><input id="job6" type="checkbox" class="search_chk" name="job[]" value="11010" <?php if (in_array ( 11010 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />ファッション</label></li>
                <li><label for="job7"><input id="job7" type="checkbox" class="search_chk" name="job[]" value="11020" <?php if (in_array ( 11020 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />コスメ</label></li>
                <li><label for="job8"><input id="job8" type="checkbox" class="search_chk" name="job[]" value="11030" <?php if (in_array ( 11030 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />デリカ・ベーカリー・スイーツ</label></li>
                <li><label for="job9"><input id="job9" type="checkbox" class="search_chk" name="job[]" value="11999" <?php if (in_array ( 11999 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />その他（フラワーショップ等）</label></li>
                <li class="job_category">宅配デリバリー系</li>
                <li><label for="job10"><input id="job10" type="checkbox" class="search_chk" name="job[]" value="12000" <?php if (in_array ( 12000 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />フード・デリカ</label></li>
                <li><label for="job11"><input id="job11" type="checkbox" class="search_chk" name="job[]" value="12010" <?php if (in_array ( 12010 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />オフィス用品</label></li>
                <li><label for="job12"><input id="job12" type="checkbox" class="search_chk" name="job[]" value="12020" <?php if (in_array ( 12020 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />ドラッグストアチェーン</label></li>
                <li><label for="job13"><input id="job13" type="checkbox" class="search_chk" name="job[]" value="12030" <?php if (in_array ( 12030 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />デパート・百貨店</label></li>
                <li><label for="job14"><input id="job14" type="checkbox" class="search_chk" name="job[]" value="12999" <?php if (in_array ( 12999 , $this->_tpl_vars['search_job'] )): ?>checked<?php endif; ?> />その他（フラワーショップ等）</label></li>
            </ul>
        </div>
        <div class="category cat2">
            <h2 class="switchHat"><img src="img/job_serchtitle2.gif" width="154" height="25" alt="勤務地から探す" /><img class="sp" src="img/sp_job_serchtitle_more.gif" width="36" height="36"></h2>
            <ul class="accordion_ul switchDetail">
                <li><label for="area1"><input id="area1" type="checkbox" class="search_chk" name="area[]" value="100" <?php if (in_array ( 100 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?>/>お台場・汐留・新橋・品川</label></li>
                <li><label for="area2"><input id="area2" type="checkbox" class="search_chk" name="area[]" value="101" <?php if (in_array ( 101 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />六本木・麻布・赤坂・青山</label></li>
                <li><label for="area3"><input id="area3" type="checkbox" class="search_chk" name="area[]" value="102" <?php if (in_array ( 102 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />お茶の水・湯島・九段・後楽園</label></li>
                <li><label for="area4"><input id="area4" type="checkbox" class="search_chk" name="area[]" value="103" <?php if (in_array ( 103 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />銀座・日本橋・東京駅周辺</label></li>
                <li><label for="area5"><input id="area5" type="checkbox" class="search_chk" name="area[]" value="104" <?php if (in_array ( 104 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />葛飾・江戸川・江東</label></li>
                <li><label for="area6"><input id="area6" type="checkbox" class="search_chk" name="area[]" value="105" <?php if (in_array ( 105 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />上野・浅草・両国</label></li>
                <li><label for="area7"><input id="area7" type="checkbox" class="search_chk" name="area[]" value="106" <?php if (in_array ( 106 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />蒲田・大森・羽田周辺</label></li>
                <li><label for="area8"><input id="area8" type="checkbox" class="search_chk" name="area[]" value="107" <?php if (in_array ( 107 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />渋谷・目黒・世田谷</label></li>
                <li><label for="area9"><input id="area9" type="checkbox" class="search_chk" name="area[]" value="108" <?php if (in_array ( 108 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />新宿・中野・杉並・吉祥寺</label></li>
                <li><label for="area10"><input id="area10" type="checkbox" class="search_chk" name="area[]" value="109" <?php if (in_array ( 109 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />池袋・目白・板橋・赤羽</label></li>
                <li><label for="area11"><input id="area11" type="checkbox" class="search_chk" name="area[]" value="110" <?php if (in_array ( 110 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />八王子・立川・町田・府中・調布</label></li>
                <li><label for="area12"><input id="area12" type="checkbox" class="search_chk" name="area[]" value="111" <?php if (in_array ( 111 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />青梅・奥多摩</label></li>
                <li><label for="area13"><input id="area13" type="checkbox" class="search_chk" name="area[]" value="112" <?php if (in_array ( 112 , $this->_tpl_vars['search_area'] )): ?>checked<?php endif; ?> />伊豆七島・小笠原</label></li>
            </ul>
        </div>
        <div class="spcellwrap2">
            <div class="tableRow">
                <a class="btn" href="#" id="all_btn"><img class="allow" src="img/common_arrow_blu.png" width="11" height="11" alt="全ての求人情報を見る" />全ての求人情報を見る</a>
            </div>
            <div class="clearfix tableTop">
                <div class="wrap">
                    <button class="btn" id="clear_btn" type="button" title="選択内容をクリアする"><img class="allow" src="img/common_arrow_blu.png" width="11" height="11" alt="選択内容をクリアする" />選択内容をクリアする</button>
                    <div class="tableTop"><input class="submit" id="search_btn" type="button" value="送信する" title="送信する" /></div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(function(){
            $('#all_btn').click(function(){
                $('.search_chk').attr('checked', 'checked');
                $('#search_form').submit();
                return false;
            });

            $('#clear_btn').click(function(){
                $('.search_chk').attr('checked', false);
                return false;
            });
            $('#search_btn').click(function(){
                if($('.search_chk:checked').size() == 0)
                {
                    alert('検索条件を選択してください');
                }
                else
                {
                    $('#search_form').submit();
                }
            });
        });
    </script>
</div><!-- #serchbox -->