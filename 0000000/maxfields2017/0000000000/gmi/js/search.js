
var area_flag = {"10000": false, "11000":false, "12000":false, "13000":false, "14000":false, "99999":false};
var area = ["10000", "11000", "12000", "13000", "14000", "99999"];

$(function(){

	$('.accordion_ul ul').hide();

	setSearchParams();

	$.each(area, function(i, element) {
			$('.area_btn_'+element).click(function(){

				if(!area_flag[element]){
					area_flag[element] = true;
					$('#area_check_'+element).prop('checked', true);
					$('.area_'+element).prop('checked', true);
					$('#area_group_'+element).addClass('active').next("ul").slideDown();
				}
				else {
					area_flag[element] = false;
					$('#area_check_'+element).prop('checked', false);
					$('.area_'+element).prop('checked', false);
					$('#area_group_'+element).removeClass('active').next("ul").slideUp();
				}

			});

			$('.area_'+element).click(function(){
				if(!$(this).prop('checked')){
					area_flag[element] = false;
					$('#area_check_'+element).prop('checked', false);
				}

				if($('.area_'+element).size() == $('.area_'+element+':checked').size()) {
					area_flag[element] = true;
					$('#area_check_'+element).prop('checked', true);
				}
			});
		}
	);

	$('#go_search').click(function(){

		if($('.searchbox01 input:checkbox:checked').size() != 0 || $('.searchbox02 input:checkbox:checked').size() != 0) {
			setSubmitParams();
			$('#search_form').submit();
		}
		else {
			alert('検索条件を選択して下さい');
		}

		return false;
	});

	$('#search_all').click(function(){
		$('.searchbox01 input:checkbox, .searchbox02 input:checkbox').prop('checked', true);
		setSubmitParams();
		$('#search_form').submit();
		return false;
	});

	$('#search_clear').click(function(){
		$.each(area, function(i, element) {
			area_flag[element] = false;
			$('#area_group_'+element).removeClass('active');
		});

		$('.accordion_ul ul').slideUp();
		$('.searchbox01 input:checkbox, .searchbox02 input:checkbox').prop('checked', false);
		return false;
	});

});

function setSearchParams() {
	var key;
	var value;
	var hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	var job_params;
	var area_params;
	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');

		key = decodeURIComponent(hash[0]);
		value = decodeURIComponent(hash[1]);

		if(key == 'job') {
			if(value != '') {
				job_params = value.split(',');
				for(var s = 0; s < job_params.length; s++) {
					$('#job_'+job_params[s]).prop('checked', true).parent().parent().show().prev("p").addClass('active');
				}
			}
		}
		else if(key == 'area') {
			if(value != '') {
				area_params = value.split(',');
				for(var s = 0; s < area_params.length; s++) {
					$('#area_'+area_params[s]).prop('checked', true);
				}
			}
		}
	}

	$.each(area, function(i, element) {
		if($('.area_'+element).size() == $('.area_'+element+':checked').size()) {
			area_flag[element] = true;
			$('#area_check_'+element).prop('checked', true);
			$('#area_group_'+element).addClass('active').next("ul").slideDown();
		}
		else if($('.area_'+element+':checked').size() > 0) {
			$('#area_group_'+element).addClass('active').next("ul").slideDown();
		}
	});
}

function setSubmitParams() {
	if($('.job_checkbox:checked').size() > 0) {
		$('#selected_job').val(
			$('.job_checkbox:checked').map( function() {
				return $(this).val();
			}).get().join(",")
		);
	}

	if($('.area_checkbox:checked').size() > 0) {
		$('#selected_area').val(
			$('.area_checkbox:checked').map( function() {
				return $(this).val();
			}).get().join(",")
		);
	}
}