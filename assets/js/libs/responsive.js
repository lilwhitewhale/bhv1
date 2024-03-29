jQuery(document).ready(function($) {

	$(document).mouseup(function (e) {
	    var container = $("#MM");

	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0) { // ... nor a descendant of the container
	       		container.find('.sub-menu').hide();
	    }
	});

	$('.touching').on( 'click', '.hasSubMenu', function(e) {	
		e.preventDefault();
		var thisNext = $(this).next();	
		$('.sub-menu').each(function() {
			if($(this).css('display') == "block" && thisNext.css('display') != "block" ){
				$(this).hide('slow');
			}
		});		
		$(this).parent().addClass('li_hover');
		if(thisNext.css('display') == 'none') {
			$(this).next().slideDown();
		} else {
			$(this).next().slideUp();
			$(this).parent().removeClass('li_hover');
		}
	});
	$('.touching .sub-menu a').on( 'click', function(e) {
		var thisNext = $(this).next();
		if($(this).children().size() > 0) {
			e.preventDefault();
			thisNext.toggle('600', 'linear');

		}
	});

	$('#MM_responsive_show').on( 'click', function() {
		$(this).hide();
		$('#MM_responsive_hide, #MM').show();
	});

	$('#MM_responsive_hide').on( 'click', function() {
		$("#MM_responsive_hide, #MM").hide();
		$('#MM_responsive_show').show();
	});
	// Home slider 
	// The function with timeout for waiting for other functions' completion
	setTimeout(function() {
		$('.slideShow img').each(function() {
			if($(this).height() != 0) {
				var smallHeight = $(this).height();
				var originalHeight = $('.slideShow').height();
				if (smallHeight < originalHeight) {
					$('.slideShow').height(smallHeight);
				}
			}
		});
	}, 300);
});

// ======================================================================
//	Responsive Design Functions
// ======================================================================

// Browser re-size adjustments (important for orientation change)
// -------------------------------------------------------------------
(function($) {
	// Portfolio Height Adjust (for uniform display if heigh variation)
	// -------------------------------------------------------------------
	$.fn.portfolioHeightFix = function(opts) {
		var pGroup = $(this);
		// for each portfolio instance
		pGroup.each( function() {
			var h = 0;
			// get all items in the group
			pItems = $(this).find('.item-container');
			pItems.each( function(i, val) {
				if ($(this).height() > h) {
					// get the greatest height value
					// var realh = $(this).find('img').height() + $(this).find('.the-post-content').outerHeight();
					h = $(this).height();
					// h = realh;
				}
			});
			pItems.css('height',h+'px'); // set all to max height
		});
	}

	$.fn.responsiveScale = function(ratio) {
		this.each(function() {
			var _this = $(this),
				_w = ( typeof _this.data('width') !== "undefined" ) ? _this.data('width') : _this.width(),
				_h = ( typeof _this.data('height') !== "undefined" ) ? _this.data('height') : _this.height();

				if (typeof ratio !== "undefined") {
					var _ratio = ratio;
				} else {
					var _ratio = (typeof _this.data('ratio') !== "undefined") ? _this.data('ratio') : _w / _h;
				}
			$(window).resize(function() {
				var w = _this.width(); 
				_this.css('height', Math.round((w / _ratio))+'px');
			});
		});
		
		$(window).trigger('resize');
		return this;
	};
		
	$.fn.responsivePortfolioScale = function() {
		this.each(function() {
			
			$pageW = $('#Middle').width();
			var _this = $(this),
				cols = _this.data('values').cols,
				col_w = _this.data('values').col_w,
				margin = _this.data('values').margin,
				width = _this.data('values').width,
				area = _this.data('values').area,
				ratio = _this.data('values').ratio,
				containerW = _this.width();
			
			// image and column sizes
			working_area = containerW - (margin * (cols - 1)) - 1;
			colW = Math.floor(working_area / cols);
			imgOldW = parseInt(_this.find('img').attr('width'));
			itemContainer = $('.textwidget .portfolio-list').find('.item-container');
			if ( $pageW > 480 && colW <= imgOldW ) {
				imgW = colW + 'px';
			} else if( $pageW > 480 && colW > imgOldW ) {
				itemContainer.css('width', imgOldW);
				imgW = colW + 'px';
			} else {
				imgW = '';
			}
			_this.find('li').each( function() {
				$(this).css('width',colW+'px');
			});
			_this.find('.portfolio-image').each( function() {
				$(this).css({'width':imgW, 'height':'auto'});
			});
		});
		
		return this;
	};

})(jQuery);

jQuery('.slideShow').responsiveScale();
jQuery('.slideShow .contentSlide').responsiveScale();
jQuery('.slideShow .slideAnimate img').responsiveScale();

jQuery(window).resize(function() {

	// Portfolio
	jQuery('.portfolio-list').responsivePortfolioScale(); // Initialize responsive scaling
	jQuery('.portfolio-list').find('.item-container').css('height','auto'); //reset on resize
	jQuery('.portfolio-list').portfolioHeightFix(); // reapply after resize
	setTimeout(function() {
		jQuery('.portfolio-list').responsivePortfolioScale(); // Initialize responsive scaling
		jQuery('.portfolio-list').find('.item-container').css('height','auto'); //reset on resize
		jQuery('.portfolio-list').portfolioHeightFix(); // reapply after resize
	}, 300);
	// Menu
	if ( window.innerWidth < 768 ) {
		jQuery('#MM').hide();
		jQuery('#MM_responsive_hide').hide();
		jQuery('#MM_responsive_show').show();
	} else {
		jQuery('#MM').show();
		jQuery('#MM_responsive_hide').hide();
		jQuery('#MM_responsive_show').hide();	
	} 

	// Home slider
	jQuery('.slideShow img').each(function() {
		if(jQuery(this).height() != 0) {
			var smallHeight = jQuery(this).height();
			var originalHeight = jQuery('.slideShow').height();
			if (smallHeight < originalHeight) {
				jQuery('.slideShow').height(smallHeight);
				jQuery('.slideShow > div[id^="SS-"] div').height(smallHeight);
			}
		}
	});

	// Contact Form
	jQuery('.contactFormWrapper input, .contactFormWrapper textarea, .publicForm input, .publicForm textarea').each( function() {
		var maxW = jQuery('.contactFormWrapper').width();
		jQuery(this).css('max-width', maxW);
	});
});