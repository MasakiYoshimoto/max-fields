
function category_del( val ) {
	if(confirm('削除を行うと、このカテゴリーに属するデータはすべて削除されます。\nよろしいですか？')){
		document.del.elements['data[Cmscategory][del_c_id]'].value = val;
		document.del.submit();
	}
}
function category_update( val ) {
	document.update.elements['data[Cmscategory][up_c_id]'].value = val;
	document.update.elements['data[Cmscategory][up_name]'].value = document.list.elements['data[name' + val + ']'].value;
	document.update.elements['data[Cmscategory][up_title_max]'].value = document.list.elements['data[title_max' + val + ']'].value;
	if(document.list.elements['data[use_rss' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_rss]'].value = 1;
	if(document.list.elements['data[use_period' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_period]'].value = 1;
	if(document.list.elements['data[use_mobile' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_mobile]'].value = 1;
	if(document.list.elements['data[use_category' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_category]'].value = 1;
	if(document.list.elements['data[use_link' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_link]'].value = 1;
	if(document.list.elements['data[use_fulledit' + val + ']'][1].checked) document.update.elements['data[Cmscategory][up_use_fulledit]'].value = 1;
	if(document.list.elements['data[use_filemanager' + val + ']'][1].checked) document.update.elements['data[Cmscategory][use_filemanager]'].value = 1;
	document.update.elements['data[Cmscategory][preview_page]'].value = document.list.elements['data[preview_page' + val + ']'].value;
	document.update.submit();
}
function category_setting( val ) {
	document.edit.elements['data[Cmscategory][edit_c_id]'].value = val;
	document.edit.submit();
}

function items_del( val ) {
	if(confirm('削除を行うと、この項目に属するデータはすべて削除されます。\nよろしいですか？')){
		document.del.elements['data[Cmsitem][del_i_id]'].value = val;
		document.del.submit();
	}
}
function items_update( val ) {
	document.update.elements['data[Cmsitem][up_i_id]'].value = val;
	document.update.elements['data[Cmsitem][up_item_name]'].value = document.list.elements['item_name' + val].value;
	document.update.elements['data[Cmsitem][up_values]'].value = document.list.elements['values' + val].value;
	document.update.elements['data[Cmsitem][up_max]'].value = document.list.elements['max' + val].value;
	document.update.elements['data[Cmsitem][up_unit]'].value = document.list.elements['unit' + val].value;
	document.update.elements['data[Cmsitem][up_variable_name]'].value = document.list.elements['variable_name' + val].value;
	document.update.elements['data[Cmsitem][up_explanation]'].value = document.list.elements['explanation' + val].value;
	if( document.list.elements['required' + val].checked ) {
		document.update.elements['data[Cmsitem][up_required]'].value = 1;
	}
	else {
		document.update.elements['data[Cmsitem][up_required]'].value = 0;
	}
	document.update.submit();
}

function documents_add( ) {
	document.add.submit();
}
function documents_edit( val ) {
	document.edit.elements['data[Cmsdocument][d_id]'].value = val;
	document.edit.submit();
}
function documents_del( val ) {
	if(confirm('削除を行うと、この項目に属するデータはすべて削除されます。\nよろしいですか？')){
		document.del.elements['data[Cmsdocument][del_d_id]'].value = val;
		document.del.submit();
	}
}
function do_GoMOVE( form , elem , val ) {
	document.forms[form].elements[elem].value = val;
	document.forms[form].submit();
}
function document_return( ) {
	document.doc_return.submit();
}

function cado_GoList( form , val ) {
	document.forms[form].elements['data[Cmscategory][c_id]'].value = val;
	document.forms[form].submit();
}

function search( val ) {
	document.searchword.elements['data[Cmscategory][word]'].value = val;
	document.searchword.submit();
}

function go_sort( id , flag ) {
	document.sort.elements['data[Cmsdocument][d_id]'].value = id;
	document.sort.elements['data[Cmsdocument][sort_flag]'].value = flag;
	document.sort.submit();
}

function go_itemssort( id , flag ) {
	document.sort.elements['data[Cmsitem][i_id]'].value = id;
	document.sort.elements['data[Cmsitem][sort_flag]'].value = flag;
	document.sort.submit();
}

function doccategories_add( ) {
	document.add.submit();
}
function doccategories_edit( val ) {
	document.edit.elements['data[Cmsdoccategory][id]'].value = val;
	document.edit.submit();
}
function doccategories_del( val ) {
	if(confirm('削除してもよろしいですか？')){
		document.del.elements['data[Cmsdoccategory][del_id]'].value = val;
		document.del.submit();
	}
}
function go_doccategorysort( id , flag ) {
	document.sort.elements['data[Cmsdoccategory][id]'].value = id;
	document.sort.elements['data[Cmsdoccategory][sort_flag]'].value = flag;
	document.sort.submit();
}

function makeSitemap(val) {
	document.Sitemap.action = val;
	document.Sitemap.submit();
}
