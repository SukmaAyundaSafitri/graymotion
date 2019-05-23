$(function() {
	var urlHome = window.location.origin + '/graymotion/';

	$('.btn-toggle1').click(function() {
		$('#menu-wrapper nav > ul').slideToggle();
	});

	$('.btn-toggle2').click(function() {
		$('#sidebar-wrapper').slideToggle();
	});

	$('.star').hover(function() {
		$('.star').removeClass('rating-over');
		$('.star').removeClass('rating-half');
		$('.star').addClass('rating-star');
		$(this).prevAll().andSelf().addClass('rating-over');
	}, function() {
		var avg = $('.ratings-wrap').attr('data-avg');
		$('.star').removeClass('rating-over');
		$('.star').removeClass('rating-half');
		$('.star').removeClass('rating-star');

		for(var i = 0; i < 5; i++) {
			if(avg - i >= 1)
				$('.star:eq(' + i + ')').addClass('rating-over');
			else if(avg - i > 0)
				$('.star:eq(' + i + ')').addClass('rating-half');
			else
				$('.star:eq(' + i + ')').addClass('rating-star');
		}
	});

	$('.star').click(function() {
		var id = $('.ratings-wrap').attr('data-id');
		var val = $(this).attr('data-value');

		$.post(urlHome + 'rating/', {id: id, value: val}, function(result) {
			if(result.result) {
				$(this).prevAll().andSelf().addClass('rating-over');
				$('.type-rating').html('Thanks for your rating...');
				$('.star').removeClass('star');
			}
			else {
				$('.type-rating').html('Failed add rating...');
			}
		}, 'json')
	})

	$('img.preview').click(function() {
		var warna = $(this).attr('data-warna');
		
		$('#warna').val(warna);
	});

	$('textarea[name="body"]').focus(function() {
		$('.form-comment-bottom').slideDown(500, "linear");
	});

	$('.artikel3').hover(function() {
		$('.gambar3').css('opacity', 0.5);
	}, function() {
		$('.gambar3').css('opacity', 1);
	});

	function checkSize() {
		if($(window).width() < 479) {
			$('#view-product').removeClass('list');
			$('#view-product').addClass('grid');
			$('.cList').removeClass('active');
			$('.cGrid').addClass('active');
			$('.cList img').attr('src', urlHome + 'assets/img/site/list-gray.png');
			$('.cGrid img').attr('src', urlHome + 'assets/img/site/grid-white.png');
		}
	}
	checkSize();

	var displayArticle2 = false;
	function displayArticle() {

		if($(window).width() < 930 && !displayArticle2) {
			var img2 = $('.image2').get();
			$('.image2').remove();
			var img3 = $('.image3').get();
			console.log(img3);
			$('.image3').remove();

			$('.artikel2').after(img2);
			$('.artikel3').after(img3);

			displayArticle2 = true;
		}
		else if($(window).width() > 930 && displayArticle2) {
			var img2 = $('.image2').get();
			$('.image2').remove();
			var img3 = $('.image3').get();
			$('.image3').remove();

			$('.artikel3').after(img2);
			$('.artikel2').after(img3);

			displayArticle2 = false;
		}
	}
	displayArticle();

	$(window).resize(function() {
		checkSize();
		displayArticle();
	})

	$('.cGrid').click(function() {
		$('#view-product').removeClass('list');
		$('#view-product').addClass('grid');
		$('.cList').removeClass('active');
		$(this).addClass('active');
		$('.cList img').attr('src', urlHome + 'assets/img/site/list-gray.png');
		$('.cGrid img').attr('src', urlHome + 'assets/img/site/grid-white.png');
	});

	$('.cList').click(function() {
		$('#view-product').removeClass('grid');
		$('#view-product').addClass('list');
		$('.cGrid').removeClass('active');
		$(this).addClass('active');
		$('.cGrid img').attr('src', urlHome + 'assets/img/site/grid-gray.png');
		$('.cList img').attr('src', urlHome + 'assets/img/site/list-white.png');
	});

	$('.btn-list-chart').click(function() {
			$.post(urlHome + 'ChartActionRev', {action: 'load'}, function(data) {
				var html = "";
				for(var i in data) {
					html += "<li><img src='" + urlHome + "assets/img/product/" + data[i][5] + "'><span class='qty-chart'>" + data[i][4] + "</span><span><a class='link-blue-gray' href='" + urlHome + 'product/' + data[i][6] + "/'>" + data[i][1].substring(0, 20) + "...</a></span><br><span class='desc'>" + data[i][3] + ", " + data[i][2] + "</span><i class='fa fa-times-circle btn-rmv-cart' data-id='" + data[i][0] + "' data-ukuran='" + data[i][3] + "' data-warna='" + data[i][2] + "'></i></li>";
				}
				if(html == "")
					html = "<li style='text-align: center; color: #888'>CHART EMPTY</li>";

				$('.list-chart .list').html(html);
			}, 'json');

		$('.list-chart').slideToggle();
	});

	$('body').on('click', '.btn-rmv-cart', function() {
		var id = $(this).attr('data-id');
		var warna = $(this).attr('data-warna')
		var ukuran = $(this).attr('data-ukuran')
		var element = $(this);

		$.post(urlHome + 'ChartActionRev', {action: 'remove', id: id, warna: warna, ukuran: ukuran, qty: 0}, function() {
			if($('.list-chart li').length == 1) {
				$('.list-chart .list').append("<li style='text-align: center; color: #888'>CHART EMPTY</li>");
			}
			element.closest('li').remove();
			window.location.reload();
		})
	})

	$('.filter-stok').change(function() {
		var id = $('#ukuran').attr('data-id');
		var warna = $('#warna').val();
		var ukuran = $('#ukuran').val();

		$.get(urlHome + 'api/stok/' + id + '/' + warna + '/' + ukuran, function(qty) {
			$('#stok').val(qty);
		})
	})

	$('.btn-chart').click(function() {
		$(this).nextAll('div').find('.select-size').slideToggle();
	});

	$('.btn-comment').click(function() {
		var a = $('#comment-wrapper').offset().top - 20;
		$('body, html').animate({scrollTop: a}, '900');
	});

	$('.checked-size').click(function() {
		var id = $(this).attr('data-id');
		var btn = $(this);

		$.post(urlHome + 'ChartAction', {action: 'addRemove', id: id, size: $(this).val()}, function() {
			//btn.html(data);
		})
	});

	$('.btn-add-to-cart').click(function() {
		var id = $(this).attr('data-id');
		var warna = $('#warna').val();
		var ukuran = $('#ukuran').val();
		var qty = $('#qty').val();
		$.post(urlHome + 'ChartActionRev', {action: 'add', id: id, ukuran: ukuran, qty: qty, warna: warna}, function(d) {
			if(d == 'ok') {
				alert('Success add to cart');
				window.location.reload();
			}
			else if(d == 'out stock') {
				alert('Quantity too much');
			}
		})
	})

	$('.btn-add-to-cart1').click(function() {
		var id = $(this).attr('data-id');
		var warna = $('#warna').val();
		var ukuran = $('#ukuran').val();
		var qty = '1';

		$.post(urlHome + 'ChartActionRev', {action: 'add', id: id, ukuran: ukuran, qty: qty, warna: warna}, function(d) {
			if(d == 'ok') {
				window.location = urlHome + 'wishlist/' + id + '/add';
			}
			else if(d == 'out stock') {
				alert('Quantity too much');
			}
		})
	})

	$('.btn-update-qty').click(function() {
		var e = $(this).closest("tr");
		var ele = e.find("td:nth-of-type(4)");
		var val = parseInt(ele.html());

		if(!$(this).hasClass('upd')) {	
			if(isNaN(val)) {
				return window.location='';
			}

			ele.html("<input type='text' value='" + val + "' class='frmEdit'>");
		}
		else {
			var id = $(this).closest('td').attr('data-id');
			var size = $(this).closest('td').attr('data-size');
			var warna = $(this).closest('td').attr('data-warna');
			var qty = parseInt(ele.find('input').val());

			if(isNaN(qty)) {
				return alert("Not valid quantity");
			}

			$.post(urlHome + 'ChartActionRev', {action: 'update', id: id, ukuran: size, qty: qty, warna: warna}, function(d) {
				ele.html(qty);
				var a = e.find('td:nth-of-type(5)').html().substr(4).replace(".", "");
				e.find('td:nth-of-type(6)').html("Rp. " + (parseInt(a) * qty).toLocaleString());
			});
		}

		$(this).toggleClass("upd");
	});

	$('.btn-remove-cart').click(function() {
		var id = $(this).closest('td').attr('data-id');
		var size = $(this).closest('td').attr('data-size');
		var warna = $(this).closest('td').attr('data-warna');

		$.post(urlHome + 'ChartActionRev', {action: 'remove', id: id, ukuran: size, qty: 0, warna: warna}, function(data) {
			window.location='';
		});
	})

	$('#propinsi').change(function() {
		var id = $(this).val();

		if(parseInt(id) == 0) {
			$('#kabupaten').html('');
			$('#kecamatan').html('');
			return;
		}

		ele = $(this);
		$.get(urlHome + 'api/kabupaten/' + id, function(data) {
			$('#kabupaten').html(data);
			ele.closest('tr').find('td:nth-of-type(4)').html('');
		})
	})

	$('#kabupaten').change(function() {
		var id = $(this).val();
		ele = $(this);
		$.get(urlHome + 'api/kecamatan/' + id, function(data) {
			$('#kecamatan').html(data);
			ele.closest('tr').find('td:nth-of-type(4)').html('');
		})
	})

	var price = 0;
	$('#kecamatan').change(function() {
		var id = $(this).val();
		var ele = $(this);
		$.post(urlHome + 'api/priceRegion/', {id: id}, function(data) {
			if(data != '') {
				ele.closest('tr').find('td:nth-of-type(4)').html('Rp. ' + parseInt(data).toLocaleString(3));
				price = parseInt(data);
				updatePrice();
			}
			else
				ele.closest('tr').find('td:nth-of-type(4)').html('');
		})
	})

	function updatePrice() {
		var cost = $('#cost');
		var berat = parseInt(cost.find('tr td:nth-of-type(1)').html());
		var total = parseInt(berat * price);
		cost.find('tr td:nth-of-type(2)').html('Rp. ' + price.toLocaleString(3));
		cost.find('tr td:nth-of-type(3)').html('Rp. ' + (total).toLocaleString(3));

		var final = $('#final');
		var item = parseInt(final.find('tr:nth-of-type(2) td:nth-of-type(2)').html().substr(4).replace(/\./g, ''));
		final.find('tr:nth-of-type(3) td:nth-of-type(2)').html('Rp. ' + (total).toLocaleString(3));
		final.find('tr:nth-of-type(4) td:nth-of-type(2)').html('Rp. ' + (item + total).toLocaleString(3));
	}

	$('.search-box form').submit(function(e) {
		e.preventDefault();
		window.location=urlHome + 'search&q=' + $(this).find('input[type="text"]').val();
	});

	$('#about-wrapper .content .title').click(function() {
		var stt = $(this).nextAll('.desc').css('display');
		if(stt == 'none') {
			$(this).find('span').css('font-weight', 'bold');
			$(this).find('img').attr('src', urlHome + 'assets/img/site/min-circle.png');
		}
		else {
			$(this).find('span').css('font-weight', 'normal');
			$(this).find('img').attr('src', urlHome + 'assets/img/site/plus-circle.png');
		}
		$(this).nextAll('.desc').slideToggle();
	});

	$('.btn-up').click(function() {
		$("body").animate({ scrollTop: '0' }, 500)
	})

	$('.preview').click(function() {
		$('.primary').attr('src', $(this).attr('src'));
	})

	$(window).scroll(function() {
		if($(window).scrollTop() < 50)
			$('.btn-up').slideUp();
		else
			$('.btn-up').slideDown();
	})

	$('#hsSt, #hsNo').change(function() {
		HistoryFilter(true);
	})

	$('#hsPg').change(function() {
		HistoryFilter(false);
	})

	$('#hsKw').keyup(function() {
		HistoryFilter(true);
	})

	$('.btn-load-more').click(function() {
		var id = $(this).prev().attr('data-id');
		var type = $(this).prev().attr('data-type');
		var page = parseInt($(this).attr('data-page')) + 1;
		var element = $(this);
		element.html("&nbsp;<div class='overlay-loading'></div>");

		$.get(urlHome + 'api/comment/' + id + '/' + type + '/' + page + '/5', function(data) {
			setTimeout(function() {
				element.prev().append(data);
				element.attr('data-page', page);
				element.html('Load More...');
			}, 800)
			
		});
	})

	function HistoryFilter(v) {
		var kw = $('#hsKw').val();
		var st = $('#hsSt').children('option').filter(':selected').val();
		var li = $('#hsNo').children('option').filter(':selected').val();
		if(v)
			var pg = 1;
		else
			var pg = $('#hsPg').children('option').filter(':selected').val();

		$.post(urlHome + 'history/filter', {kw: kw, st: st, li: li, pg: pg}, function(data) {
			$('.data').html(data);
		})
	}
});