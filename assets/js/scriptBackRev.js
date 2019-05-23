$(function() {
	var BASEURL = window.location.origin + '/graymotion/admin/';
	var u = document.URL.replace(BASEURL, '');
	u = u.split('/')[0];

	$('ul.sidebar-menu > li').each(function(i) {
		if($(this).text().toLowerCase().search(u) > -1) {
			$(this).find('ul').slideDown();
			$(this).addClass('active');
			$(this).find('img').css("transform", 'rotate(90deg)');
		}
	})

	$('.cmbLimit, .cmbStatus, .cmbLevel, .cmbCategory, .cmbType, .cmbStock').change(function() {
		loadTable();
	})

	$('.txtSearch').keyup(function() {
		loadTable();
	})

	$('.dropdown-toggle').click(function() {
		$(this).parent().toggleClass('open');
	})

	$('.navbar a[class!=logo-text]').click(function(e) {
		//e.preventDefault();
	})

	$('.toggle-fullscreen').click(function() {
		var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
		if(fullscreenElement)
			document.webkitExitFullscreen();
		else
			document.documentElement.webkitRequestFullscreen();
	})

	$('.toggle-search').click(function() {
		$('.search-box').css('margin-top', '0');
	})

	$('.btn-close-search').click(function() {
		$('.search-box').css('margin-top', '-60px');
	})

	$('.sidebar-menu > li:not(:first-child) > a').click(function(e) {
		e.preventDefault();
		var ele = $(this).parent()
		var cl = ele.hasClass('active');

		if(!cl)
			ele.addClass('active');

		$(this).next('ul').slideToggle(400, function() {
			if(cl)
				ele.removeClass('active');
		});
	})

	$('.btn-refresh').click(function() {
		var ele = $(this).parent().next('.box-body').find('.overlay');
		ele.fadeIn();
		setTimeout(function() {
			ele.fadeOut();
		}, 1000)
	})

	$('body').on('click', '.btn-status', function() {
		var id = $(this).closest('tr').attr('id');
		var data = $(this).text();

		$.ajax({
			type: 'POST',
			data: {tipe: data},
			url: id + '/status',
			success: function(d) {
				//console.log(d);
				window.location='';
			}
		})
	})

	$('.btn-password').click(function() {
		$('.overlay').fadeIn();
		$('#modal-password').fadeIn();
	})

	$('.btn-add').click(function() {
		$('.overlay').fadeIn();
		$('#biasa').fadeIn();
		$('#biasa .panel-heading').html('Add');
		$('#biasa form').attr('action', BASEURL + $(this).attr('data-type') + '/new');
	})

	$('body').on('click', '.btn-edit', function(e) {
		e.preventDefault();

		var data = {};
		var id = $(this).attr('data-id');
		var ele = $(this).closest('tr').attr('data-type');
		$.get(BASEURL + ele + '/' + id + '/get', function(d) {
			if(ele == 'category') {
				$('#biasa form [name="name"]').val(d.nama);
				$('#biasa form [name="type"]').val(d.tipe);
			}
			else if(ele == 'account') {
				$('#biasa form [name="username"]').val(d.username);
				$('#biasa form [name="level"]').val(d.level);
			}
		}, 'json');

		$('.overlay').fadeIn();
		$('#biasa').fadeIn();
		$('#biasa .panel-heading').html('Edit');
		$('#biasa form').attr('action', BASEURL + ele + '/' + id + '/edit');
	})

	$('.btn-edit-news').click(function() {
		var element = $('.content-email .teks');
		var teks = element.html();
		element.html('<textarea name="teks" id="teks">' + teks + '</textarea>');

		$('.content-email .title').html("<input type='text' name='judul' class='form-control' value='" + $('.content-email .title span').html() + "'>");
		initTinyMce();

		$(this).before('<button type="submit" class="btn-edit-news btn-ku btn-white"><i class="fa fa-save fa-fw"></i> Save</button>');
		$(this).remove();
	})

	$('body').on('click', '.btn-delete', function(e) {
		e.preventDefault();

		var id = $(this).closest('tr').attr('id');
		var type = $(this).closest('tr').attr('data-type');

		$.ajax({
			type: 'DELETE',
			url: BASEURL + type + '/' + id,
			success: function() {
				window.location='';
			}
		})
	});

	$('.btn-status').click(function(e) {
		e.preventDefault();
		var id = $(this).closest('tr').attr('data-id');
		var type = $(this).closest('tr').attr('data-type');

		$.post(BASEURL + type + '/' + id + '/status', function(d) {
			window.location='';
		})
	})

	$('.overlay').click(function() {
		$('.overlay').fadeOut();
		$('.modal').fadeOut();
	})

	$('.link-tr').click(function() {
		window.location = BASEURL + $(this).attr('data-type') + '/' + $(this).attr('data-id');
	})


	$('body').on('click', '#paging-wrapper .nav a', function(e) {
		e.preventDefault();
		var p = $(this).attr('href');
		now = p;
		loadTable(p);
	});

	$('body').on('click', '.btn-text', function() {
		/*var id = $(this).closest('tr').attr('id');*/
		var teks = $(this).parent().parent();
		var tgl = $(this).closest('tr').find('td:last').text();
		var cmnt = $(this).closest('tr').find('.txtComment').text();

		$('.bdy-right .name').text($.trim(teks.html().split('<span>')[0]) + ' - ' + tgl);
		$('.bdy-right .contents').text(cmnt);

		$('.overlay').fadeIn();
		$('#biasa').fadeIn();
	})

	var hit = parseInt($('#btn-add-color').attr('data-start'));
	$('#btn-add-color').click(function() {
		$(this).before("<fieldset><legend>Color " + hit + "</legend><div class='flex'><div class='form-group flex1'><label for='title'>Color</label><input type='text' placeholder='Color' class='form-control' name='color[]' required></div><div class='form-group flex1'><label for='title'>Image</label><input type='file' class='form-control' name='image[]' required></div></div><div class='flex'><div class='form-group flex1'><label for='title'>S</label><input type='number' placeholder='S Stock' class='form-control' name='S[]' required></div><div class='form-group flex1'><label for='title'>M</label><input type='number' placeholder='M Stock' class='form-control' name='M[]'  required></div><div class='form-group flex1'><label for='title'>L</label><input type='number' placeholder='L Stock' class='form-control' name='L[]' required></div><div class='form-group flex1'><label for='title'>XL</label><input type='number' placeholder='XL Stock' class='form-control' name='XL[]' required></div></div></fieldset>");
		hit++;
	})

	/*function checkPage() {
		if(now == 1) {
			$('#paging-wrapper nav:first-child').attr('disabled', 'disabled');
			$('#paging-wrapper nav:last-child').removeAttr('disabled');
		}
		else {
			$('#paging-wrapper nav:last-child').attr('disabled', 'disabled');
			$('#paging-wrapper nav:first-child').removeAttr('disabled');
		}

		if(now == max) {
			$('#paging-wrapper nav:last-child').attr('disabled', 'disabled');
			$('#paging-wrapper nav:first-child').removeAttr('disabled');
		}
		else {
			$('#paging-wrapper nav:first-child').attr('disabled', 'disabled');
			$('#paging-wrapper nav:last-child').removeAttr('disabled');
		}
	}*/
	
	$('.cmbDateFrom, .cmbDateTo').change(function() {
		loadTable();
	})

	$('.btn-export').click(function(e) {
		e.preventDefault();
		var q = "";
		var url = $(this).closest('form').attr('action');
		var df = $('.cmbDateFrom').val();
		var dt = $('.cmbDateTo').val();
		q = q + "&df=" + df + "&dt=" + dt

		if($('.cmbCategory').length > 0) {
			q = q + "&cg=" + $('.cmbCategory').val();
		}

		window.location=url + q;
	})

	var now = 1;
	var max = 1;
	function loadTable(p = 1) {
		var data = {};
		var li = 5;
		data.pg = p;

		if($('.cmbLimit').length > 0) {
			data.li = $('.cmbLimit').children('option').filter(':selected').val();
			li = data.li;
		}
		if($('.cmbStatus').length > 0) {
			data.st = $('.cmbStatus').children('option').filter(':selected').val();
		}
		if($('.cmbLevel').length > 0) {
			data.lv = $('.cmbLevel').children('option').filter(':selected').val();
		}
		if($('.cmbCategory').length > 0) {
			data.cg = $('.cmbCategory').children('option').filter(':selected').val();
		}
		if($('.cmbType').length > 0) {
			data.ty = $('.cmbType').children('option').filter(':selected').val();
		}
		if($('.cmbStock').length > 0) {
			data.so = $('.cmbStock').children('option').filter(':selected').val();
		}
		if($('.txtSearch').length > 0) {
			data.kw = $('.txtSearch').val();
		}
		if($('.cmbDateFrom').length > 0) {
			data.df = $('.cmbDateFrom').val();
		}
		if($('.cmbDateTo').length > 0) {
			data.dt = $('.cmbDateTo').val();
		}

		$.post('filter', data, function(data) {
			$('#data').html(data);
		})		
	}

	initTinyMce();
	function initTinyMce() {
		tinymce.init({
			selector:'#teks',
			theme: 'modern',
			height: 300,
		  plugins: [
		    'advlist autolink lists link image',
		    'searchreplace wordcount visualblocks visualchars code',
		    'media nonbreaking contextmenu',
		    'template paste textpattern imagetools'
		  ],
			toolbar1: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
		  toolbar2: 'image | link | unlink | blockquote',
		  content_css: [
		    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
		    '//www.tinymce.com/css/codepen.min.css'
		  ]
		});
	}
})