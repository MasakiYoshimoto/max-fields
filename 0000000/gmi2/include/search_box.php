<script src="../js/search.js" type="text/javascript"></script>
<div class="searchbox01">
<div class="searchbox_inr">
<div class="searchbox_top">
    <h3><span>職種から探す</span></h3>
    <ul class="accordion_ul"><!-- accordion_ul -->
        <li><input class="job_checkbox" id="job_10000" type="checkbox" value="10000"><span class="search_cdn01">サービス・販売系</span></li>
        <li><input class="job_checkbox" id="job_10010" type="checkbox" value="10010"><span class="search_cdn02">事務・オペレーター系</span></li>
        <li><input class="job_checkbox" id="job_10020" type="checkbox" value="10020"><span class="search_cdn03">作業系　製造</span></li>
        <li><input class="job_checkbox" id="job_10030" type="checkbox" value="10030"><span class="search_cdn03">作業系　倉庫</span></li>
        <li><input class="job_checkbox" id="job_10040" type="checkbox" value="10040"><span class="search_cdn04">資格・スキル系</span></li>
        <li><input class="job_checkbox" id="job_10050" type="checkbox" value="10050"><span class="search_cdn05">短期・スポット</span></li>
        <li><input class="job_checkbox" id="job_99999" type="checkbox" value="99999"><span class="search_cdn06">その他</span></li>
    </ul><!-- /accordion_ul -->
    <!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
    <!--[if lt IE 9]> <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> <![endif]-->
</div>
    <div class="searchbox02">
        <h3><span>勤務地から探す</span></h3>
<ul class="accordion_ul"><!-- accordion_ul -->
        <li>
            <div>
                <p class="area_btn_10000" id="area_group_10000"><span class="wrap">
                    <input id="area_check_10000" type="checkbox">東京都</span>
                </p>
                <ul>
                    <li><input class="area_10000 area_checkbox" id="area_10000" type="checkbox" value="10000">23区内</li>
                    <li><input class="area_10000 area_checkbox" id="area_10010" type="checkbox" value="10010">その他の地域</li>
                </ul>
            </div>
        </li>
        <li>
            <div>
                <p class="area_btn_11000" id="area_group_11000"><span class="wrap">
                    <input id="area_check_11000" type="checkbox">神奈川県</span>
                </p>
                <ul>
                    <li><input class="area_11000 area_checkbox" id="area_11000" type="checkbox" value="11000">川崎・横浜</li>
                    <li><input class="area_11000 area_checkbox" id="area_11010" type="checkbox" value="11010">県央・湘南・その他のエリア</li>
                </ul>
            </div>
        </li>
        <li>
            <div>
                <p class="area_btn_12000" id="area_group_12000"><span class="wrap">
                    <input id="area_check_12000" type="checkbox">静岡県</span>
                </p>
                <ul>
                    <li><input class="area_12000 area_checkbox" id="area_12000" type="checkbox" value="12000">西部</li>
                    <li><input class="area_12000 area_checkbox" id="area_12010" type="checkbox" value="12010">中部</li>
                    <li><input class="area_12000 area_checkbox" id="area_12020" type="checkbox" value="12020">東部</li>
                </ul>
            </div>
        </li>
        <li><input class="area_checkbox" id="area_13000" type="checkbox" value="13000"><span class="area_c01">空港（成田・羽田・セントレア）</span></li>
        <li><input class="area_checkbox" id="area_14000" type="checkbox" value="14000"><span class="area_c01">千葉・埼玉・北関東エリア</span></li>
        <li><input class="area_checkbox" id="area_99999" type="checkbox" value="99999"><span class="area_c01">その他の道府県</span></li>
</ul>
	</div><!-- .searchbox02 -->
</div><!-- .searchbox_inr -->
        <div class="search">
            <!-- <input type="search" placeholder="フリーワード" id="s_words"><br /> -->
            <ul>
                <li><a id="search_all" href="#">全ての求人情報を見る</a></li>
                <li><a id="search_clear" href="#">全てのチェックを外す</a></li>
            </ul>
            <a href="#" id="go_search"><div class="bt_search"><img src="img/btn_search.gif" alt="検索"></div></a>
        </div>


</div>
<form name="search" id="search_form" method="get" action="/gmi2/search/">
    <input type="hidden" id="selected_job" name="job" value="" />
    <input type="hidden" id="selected_area" name="area" value="" />
</form>