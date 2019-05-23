$(function() {
	urlHome = 'http://localhost/graymotion/admin/';

	var u = document.URL.replace(urlHome, '');
	u = u.split('/')[0];

	$('ul.sidebar-menu > li').each(function(i) {
		if($(this).text().toLowerCase().search(u) > -1) {
			$(this).find('ul').slideDown();
			$(this).find('img').css("transform", 'rotate(90deg)');
		}
	})

	$('.sidebar-menu > li > a').click(function(e) {
		e.preventDefault();
		var d = $(this).next('ul').css('display');
		$(this).next('ul').slideToggle();

		if(d == 'none')
			$(this).find('img').css("transform", 'rotate(90deg)');
		else
			$(this).find('img').css("transform", 'rotate(0deg)');
	})

	$('body').on('click', '.btn-stock', function() {
		var id = $(this).closest('tr').attr('id');
		var teks = $(this).parent().parent();

		$('[name="productStock"]').val($.trim(teks.html().split('<span>')[0]));
		$('[name="productId"]').val(id);

		$('.overlay').fadeIn(800);
		$('#popup').fadeIn(700);
	})

	$('body').on('click', '.btn-text', function() {
		/*var id = $(this).closest('tr').attr('id');*/
		var teks = $(this).parent().parent();
		var tgl = $(this).closest('tr').find('td:last').text();
		var cmnt = $(this).closest('tr').find('.txtComment').text();

		$('.bdy-right .name').text($.trim(teks.html().split('<span>')[0]) + ' - ' + tgl);
		$('.bdy-right .contents').text(cmnt);

		$('.overlay').fadeIn(800);
		$('#popup').fadeIn(700);
	})

	$('#popup form').submit(function(e) {
		e.preventDefault();
		var data = {};
		data.id = $('[name="productId"]').val();
		data.size = $('[name="productSize"]').val();
		data.stock = $('[name="productQty"]').val();

		$.post(urlHome + 'product/' + data.id + '/stock', data, function() {
			window.location='';
		});
	})

	$('.btn-close, .overlay').click(function() {
		$('.overlay').fadeOut(800);
		$('#popup').fadeOut(700);
	})

	$('body').on('click', '.btn-delete', function() {
		var id = $(this).closest('tr').attr('id');

		$.ajax({
			type: 'DELETE',
			url: id,
			success: function() {
				window.location='';
			}
		})
	})

	$('body').on('click', '.btn-status', function() {
		var id = $(this).closest('tr').attr('id');
		var data = $(this).text();

		$.ajax({
			type: 'POST',
			data: {tipe: data},
			url: id + '/status',
			success: function() {
				window.location='';
			}
		})
	})

	$('.cmbLimit, .cmbStatus, .cmbLevel, .cmbCategory, .cmbType, .cmbStock').change(function() {
		loadTable();
	})

	$('.txtSearch').keyup(function() {
		loadTable();
	})


	$('body').on('click', '.nav a', function(e) {
		e.preventDefault();
		var p = $(this).attr('href');
		loadTable(p);
	});

	function loadTable(p = 1) {
		var data = {};
		data.pg = p;

		if($('.cmbLimit').length > 0) {
			data.li = $('.cmbLimit').children('option').filter(':selected').val();
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

		$.post('filter', data, function(data) {
			$('#data').html(data);
		})
	}
})

$('.toggle').click(function() {
	var w = $('#sidebar-wrapper').css('width');
	if(w == '1px') {
		$('#sidebar-wrapper').animate({width: '20%'}, 100)
	}
	else {
		$('#sidebar-wrapper').animate({width: 0}, 100)
	}
	console.log(w);
	
})