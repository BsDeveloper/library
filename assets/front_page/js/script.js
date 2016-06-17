$(document).ready(function(){

	/* =========================================================================== */
	/*  Responsive Function
	/* =========================================================================== */
	var viewportIndicator = $("#viewport-indicator"),
		breakpoints = ["@phone", "@mobile", "@tablet", "@laptop", "@desktop"];

	function currentBreakpoint() {
		return viewportIndicator.css('font-family').replace(/['"]+/g, "");
	}

	function isBreakpoint(breakpoint) {
		return (breakpoint == currentBreakpoint()) ? true : false;
	}

	function fromBreakpoint(breakpoint) {
		if(breakpoint == currentBreakpoint()) {
			return true;
		} else if(breakpoint == "@phone") {
			return true;
		} else if(breakpoint == "@mobile") {
			return (currentBreakpoint() != "@phone") ? true : false;
		} else if(breakpoint == "@tablet") {
			if(currentBreakpoint() != "@phone" && currentBreakpoint() != "@mobile") {
				return true;
			} else {
				return false;
			}
		} else if(breakpoint == "@laptop") {
			return (currentBreakpoint() == "@desktop") ? true : false;
		} else if(breakpoint == "@desktop") {
			return (currentBreakpoint() == "@desktop") ? true : false;
		} else {
			return false;
		}
	}


	/* =========================================================================== */
	/*  Base Funtion
	/* =========================================================================== */
	function isTransitionsSupported() {
		var thisBody = document.body || document.documentElement,
			thisStyle = thisBody.style,
			support = 	thisStyle.transition !== undefined || 
						thisStyle.WebkitTransition !== undefined || 
						thisStyle.MozTransition !== undefined || 
						thisStyle.MsTransition !== undefined || 
						thisStyle.OTransition !== undefined;
		return support;
	} //webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend

	function thumbImagesCenter(){
		var thumb = $(".thumb"),
			thumbImages = thumb.find(".thumb-img, img");
		thumb.imagesLoaded().always( function( instance ) {
			thumbImages.each(function(){
				var currentThumb = $(this).closest(".thumb"),
					thumbWidht = currentThumb.width(),
					thumbHeight = currentThumb.height();
				if($(this).height() <= thumbHeight) {
					$(this).css({
						width: "auto",
						height: "100%"
					});
				} 
				if($(this).width() <= thumbWidht) {
					$(this).css({
						width: "100%",
						height: "auto"
					});
				}
			});	
		});
	} 

	/* =========================================================================== */
	/*  Preloader
	/* =========================================================================== */
	$('.hero').imagesLoaded().always( function( instance ) {
		$("#preloader").fadeOut(function(){
			$(this).remove();
		});
	});
	
	/* =========================================================================== */
	/*  Navicon Toggle "Mobile Navigation"
	/* =========================================================================== */
	var transitionEnd = "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend";
	var navbar = $(".navbar"),
		navicon1 = navbar.find("#navicon1"),
		navicon2 = navbar.find("#navicon2"),
		navicon3 = navbar.find("#navicon3"),
		topNavMenu = navbar.find(".top-nav .nav-menu"),
		mainNavMenu = navbar.find(".main-nav .nav-menu"),
		phoneNumber = navbar.find(".phone-number .phone-wrap"),
		mainDropdown = mainNavMenu.find(".dropdown");

	function navMenuExpand(navMenu, callback) {
		if(isTransitionsSupported()) {
			navMenu.addClass("expand").one(transitionEnd, function(){
				if(typeof callback === "function") {
					callback();
				}
			});
		} else {
			navMenu.addClass("expand");
			if(typeof callback === "function") {
				callback();
			}
		}
	}

	function navMenuCollapse(navMenu, callback) {
		var navMenuDropdown = navMenu.find(".dropdown.expand");
		if(isTransitionsSupported()) {
			if(navMenuDropdown.length) {
				dropdownCollapse(navMenuDropdown, function(){
					navMenu.removeClass("expand").one(transitionEnd, function(){
						if(typeof callback === "function") {
							callback();
						}
					});
				});
			} else {
				navMenu.removeClass("expand").one(transitionEnd, function(){
					if(typeof callback === "function") {
						callback();
					}
				});	
			}			
		} else {
			if(navMenuDropdown.length) {
				dropdownCollapse(navMenuDropdown);
			}
			navMenu.removeClass("expand");
			if(typeof callback === "function") {
				callback();
			}
		}
	}

	function dropdownExpand(dropdown, callback) {
		if(isTransitionsSupported()) {
			dropdown.css("height", "auto").addClass("expand").one(transitionEnd, function(){
				if (typeof callback === "function") {
					callback();
				}
			});	
		} else {
			if (typeof callback === "function") {
				callback();
			}
		}
		
	}

	function dropdownCollapse(dropdown, callback) {
		if(isTransitionsSupported()) {
			dropdown.removeClass("expand").one(transitionEnd, function(){
				$(this).removeAttr("style");
				if (typeof callback === "function") {
					callback();
				}
			});	
		} else {
			dropdown.removeClass("expand");
			dropdown.removeAttr("style");
			if (typeof callback === "function") {
				callback();
			}
		}
	}

	/* Main Nav
	/* ----------------------------------------------------------- */
	navicon3.click(function(){
		$(this).toggleClass("active");
		if(mainNavMenu.hasClass("expand")) {
			navMenuCollapse(mainNavMenu);
		} else {
			navMenuExpand(mainNavMenu);
		}
	})

	mainDropdown.children("a").click(function(event){
		event.preventDefault();
		if(mainDropdown.hasClass("expand")){
			dropdownCollapse(mainDropdown);
		} else {
			dropdownExpand(mainDropdown);
		}
	});

	/* Top Nav
	/* ----------------------------------------------------------- */
	navicon1.click(function(){
		$(this).toggleClass("active");

		if(navicon2.hasClass("active")) {
			navicon2.removeClass("active");
			phoneNumber.removeClass("expand");	
		}

		if(topNavMenu.hasClass("expand")) {
			if(topNavMenu.find(".dropdown").length) {
				dropdownCollapse(topDropdown);
			}
			navMenuCollapse(topNavMenu);
		} else {
			navMenuExpand(topNavMenu);
		}
	})

	/* Phone Number
	/* ----------------------------------------------------------- */
	navicon2.click(function(){
		$(this).toggleClass("active");

		if(navicon1.hasClass("active")) {
			navicon1.removeClass("active");
			topNavMenu.removeClass("expand");	
		}
		
		if(phoneNumber.hasClass("expand")) {
			navMenuCollapse(phoneNumber);
		} else {
			navMenuExpand(phoneNumber);
		}
	});

	/* =========================================================================== */
	/*  Search Toggle
	/* =========================================================================== */
	var searchForm = $(".search-form"),
		searchNav = searchForm.find(".search-nav");
	searchNav.click(function(){
		$(this).toggleClass("expand");
		searchForm.find(".search-box").toggleClass("expand");
	});

	/* =========================================================================== */
	/*  Hero
	/* =========================================================================== */
	var hero = $(".hero"),
		heroImage = hero.find(".hero-image"),
		heroCaption = hero.find(".hero-caption"),
		owlHero = hero.find("#owl-hero");

	var hero2 = $(".hero2"),
		hero2Image = hero2.find(".hero2-image"),
		hero2Caption = hero2.find(".hero2-caption");

	function fullSreenHero() {
		var windowHeight = $(window).height();
		if(windowHeight > 550) {
			heroImage.height(windowHeight);
		} else {
			heroImage.height(550);
		}
	}

	var navTextAngle   = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		animationNames = ["bounce","flash","pulse","rubberBand","shake","swing","tada","wobble","jello",
						  "bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","fadeIn",
						  "fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig",
						  "fadeInUp","fadeInUpBig","flipInX","flipInY","lightSpeedIn","rotateIn","rotateInDownLeft",
						  "rotateInDownRight","rotateInUpLeft","rotateInUpRight","rollIn","zoomIn","zoomInDown",
						  "zoomInLeft","zoomInRight","zoomInUp","slideInDown","slideInLeft","slideInRight","slideInUp"
						 ],
		animationLength = animationNames.length,
		currentAnimation = 0;

	var animationEnd = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
	function animateCSS(obj, animationName) {
		obj.addClass(animationName).one(animationEnd, function(){
			$(this).removeClass(animationName);
		});
	}

	function animateCaption() {
		var animationName = "animated " + animationNames[currentAnimation];
		animateCSS(heroCaption, animationName);
		currentAnimation = (++currentAnimation > animationLength) ? 0 : currentAnimation++; 
	}

	owlHero.owlCarousel({
		autoPlay : 6000,
		addClassActive : true,
		navigation : true,
		pagination : true,
		slideSpeed : 500,
		rewindSpeed : 500,
		paginationSpeed : 500,
		singleItem : true,
		lazyLoad: true,
		navigationText: navTextAngle,
		afterAction: animateCaption
	});

	var owlControls = owlHero.find(".owl-controls"),
		owlHeroPrev = owlControls.find(".owl-prev"),
		owlHeroNext = owlControls.find(".owl-next"),
		owlHeroPrevNext = owlControls.find(".owl-prev, .owl-next");

	function setHeroCaptionTop(navbarHeight) {
		var navbarHeight2 = navbarHeight;
		if($(".main-inner").length) {
			navbarHeight2 -= 35;
		}
		if($(".course-menu").length) {
			navbarHeight2 -= 40;
		}
		if(navbarHeight < 330) {
			heroCaption.css("padding-top", navbarHeight);
			hero2Caption.css("padding-top", navbarHeight2);
		} else {
			heroCaption.css("padding-top", 310);
			hero2Caption.css("padding-top", 310);
		}
		var halfHeroImage = (heroImage.height() - navbarHeight) / 2;
		owlHeroPrev.css("bottom", halfHeroImage);
		owlHeroNext.css("bottom", halfHeroImage);
	}

	function centeringOverlay() {
		var navbarHeight;
		if(fromBreakpoint("@tablet")) {
			navbarHeight = $(".navbar").height();
			setHeroCaptionTop(navbarHeight);
		} else {
			if(navicon3.hasClass("active") || mainNavMenu.find(".dropdown.expand")) {
				navicon3.removeClass("active");
				if(mainNavMenu.hasClass("expand")) {
					navMenuCollapse(mainNavMenu, function(){
						navbarHeight = $(".navbar").height();
						setHeroCaptionTop(navbarHeight);
					});
				} else {
					dropdownCollapse(mainDropdown);
					navbarHeight = $(".navbar").height();
					setHeroCaptionTop(navbarHeight);
				}
			} else {
				navbarHeight = $(".navbar").height();
				setHeroCaptionTop(navbarHeight);
			}
		}
	}

	var heroTimeout,
		isHeroCssSet = false;

	owlHero.on("mousemove", function(){
		clearTimeout(heroTimeout);
		if(!isHeroCssSet) {
			owlHeroPrev.css("left", 0);
			owlHeroNext.css("right", 0);
			isHeroCssSet = true;
		}
		heroTimeout = setTimeout(function(){
			owlHeroPrev.css("left", -45);
			owlHeroNext.css("right", -45);
			isHeroCssSet = false;
		}, 2000);
	});

	owlHeroPrevNext.click(function(){
		clearTimeout(heroTimeout);
		heroTimeout = setTimeout(function(){
			owlHeroPrev.css("left", -45);
			owlHeroNext.css("right", -45);
			isHeroCssSet = false;
		}, 2000);
	});

	function initHero() {
		$('.hero').imagesLoaded().always( function( instance ) {
			fullSreenHero();
			centeringOverlay();
		});
	}

	/* =========================================================================== */
	/*  Scroll Down & Scroll Top
	/* =========================================================================== */
	$(".scroll-down").click(function() {
		$(window).scrollTo("#main-content", 300);
	});

	$(".scroll-up").click(function() {
		$(window).scrollTo("#viewport-indicator", 550);
	});


	/* =========================================================================== */
	/*  Owl Carousel
	/* =========================================================================== */
	$("#owl-hot-news").owlCarousel({
		autoPlay : true,
		navigation : true,
		slideSpeed : 400,
		pagination : false,
		paginationSpeed : 500,
		singleItem : true,
		navigationText : navTextAngle
	});

	$("#bs-owl-covered").owlCarousel({
		autoPlay : true,
		navigation : false,
		slideSpeed : 400,
		pagination : true,
		paginationSpeed : 500,
		items : 5,
		itemsDesktop : [992,4],
		itemsDesktopSmall : [678,3],
		itemsTablet: [480,2],
		itemsMobile : [320, 1]
	});

	$("#bs-owl-creation").owlCarousel({
		autoPlay : true,
		navigation : true,
		slideSpeed : 400,
		pagination : false,
		paginationSpeed : 500,
		navigationText : navTextAngle,
		stopOnHover: true,
		items : 3,
		itemsDesktop : [992,2],
		itemsDesktopSmall : [678,2],
		itemsTablet: [480,1],
		itemsMobile : [320, 1]
	});

	$(".owl-slide-gallery").owlCarousel({
		autoPlay : true,
		navigation : true,
		slideSpeed : 400,
		pagination : false,
		paginationSpeed : 500,
		singleItem : true,
		navigationText : navTextAngle,
	});

	$(".owl-slide-content").owlCarousel({
		autoPlay : false,
		navigation : true,
		slideSpeed : 400,
		pagination : true,
		paginationSpeed : 500,
		singleItem : true,
		navigationText : ["Prev", "Next"],
	});

	$("#owl-post-top").owlCarousel({
		autoPlay : true,
		navigation : true,
		slideSpeed : 400,
		pagination : true,
		paginationSpeed : 500,
		singleItem : true,
		navigationText : navTextAngle,
	}).find(".owl-controls").appendTo(".post-owl-controls");

	$("#owl-course-facilities").owlCarousel({
		autoPlay : true,
		navigation : false,
		slideSpeed : 400,
		pagination : false,
		paginationSpeed : 500,
		singleItem : true,
	});


	/* =========================================================================== */
	/*  Owl Carousel Base Function
	/* =========================================================================== */
	var cssVisible = {
			"opacity": 1,
			"visibility": "visible"
		},
		cssHidden = {
			"opacity": 0,
			"visibility": "hidden"
		};

	function owlHideShowNav(owlArea, owlTimeout) {
		var owlPrevNext = owlArea.find(".owl-prev, .owl-next"),
			isCssSet = false;

		owlArea.on("mousemove", function(){
			clearTimeout(owlTimeout);
			if(!isCssSet) {
				owlPrevNext.css(cssVisible);
				isCssSet = true;
			}
			owlTimeout = setTimeout(function(){
				owlPrevNext.css(cssHidden);
				isCssSet = false;
			}, 1500);
		});

		owlPrevNext.click(function(){
			clearTimeout(owlTimeout);
			owlTimeout = setTimeout(function(){
				owlPrevNext.css(cssHidden);
				isCssSet = false;
			}, 1500);
		});
	}


	/* =========================================================================== */
	/*  Owl Carousel Hide & Show Nav
	/* =========================================================================== */
	var owlCreation = $("#bs-owl-creation"),
		owlCreationTimeout;
	owlHideShowNav(owlCreation, owlCreationTimeout);

	var owlPlaceGallery = $(".owl-slide-gallery"),
		owlPlaceGalleryTimeout;
	owlHideShowNav(owlPlaceGallery, owlPlaceGalleryTimeout);


	/* =========================================================================== */
	/*  Browser Box
	/* =========================================================================== */
	var browser = $(".bs-browser"),
		browserWrapper = browser.find(".browser-wrapper"),
		browserContent = browserWrapper.find(".browser-content"),
		browserBar = $(document.createElement("div"))
		.addClass("browser-bar")
		.html("<div class='bullets'><i></i><i></i><i></i></div>");
	browser.prepend(browserBar);

	browserWrapper.hover(function(){
		var thisContent = $(this).find(".browser-content"),
			topAnimate = thisContent.height() - $(this).height(),
			speedAnimate = topAnimate * 6;

		thisContent.stop().animate({top: -topAnimate}, speedAnimate);
	}, function(){
		var thisContent = $(this).find(".browser-content");
		thisContent.stop().animate({top: 0}, 1000);
	});

	/* =========================================================================== */
	/*  Student Testi
	/* =========================================================================== */
	var bsStudentTesti = $(".bs-student .testi"),
		bsStudentTestiList = bsStudentTesti.children(".testi-list");
	bsStudentTesti.niceScroll(bsStudentTestiList, {
		cursorcolor: "#666",
		cursorwidth: 8,
		bouncescroll: false,
		opacity: 0.5
	});

	/* =========================================================================== */
	/*  Color Box
	/* =========================================================================== */
	$("a.btn-free-course").colorbox({
		scrolling: false
	});

	$("a.btn-zoom").colorbox({
		maxWidth: 992,
		maxHeight: 768
	});

	function colorboxOnResize() {
		var boxWidth = $("#box-free-course").width();
		$('a.btn-free-course').colorbox.resize({
			width: boxWidth, 
			maxWidth: "100%"
		});

		$("a.btn-zoom").colorbox.resize({
			maxWidth: 997,
			maxHeight: 768
		});
	}	
	

	/* =========================================================================== */
	/*  Sidebar Toggle
	/* =========================================================================== */
	$(".sidebar-toggle").click(function(){
		var faAngle = $(this).children(".fa");

		$(this).toggleClass("expand");
		if(faAngle.hasClass("fa-angle-double-right")) {
			faAngle.removeClass("fa-angle-double-right");
			faAngle.addClass("fa-angle-double-left");
		} else {
			faAngle.removeClass("fa-angle-double-left");
			faAngle.addClass("fa-angle-double-right");
		}
		$(this).next(".sidebar-content").toggleClass("expand");
	});


	/* =========================================================================== */
	/*  Sidebar Menu Dropdown
	/* =========================================================================== */
	var dropdownMenu = $(".side-menu .dropdown-menu"),
		dropdownMenuA = dropdownMenu.find(".dropdown a");

	dropdownMenuA.click(function(event){
		event.preventDefault();
		$(this).closest(".dropdown").toggleClass("expand");
	});

	
	/* =========================================================================== */
	/*  Masonry Grid System
	/* =========================================================================== */
	if($(".masonry-grid").length) {
		$(".masonry-grid").masonry({
			itemSelector: '.col'
		});	
	}

	if($(".masonry-grid2").length) {
		$(".masonry-grid2").masonry({
			itemSelector: '.col.col-3'
		});	
	}	
	
	
	/* =========================================================================== */
	/*  Sorting Grid
	/* =========================================================================== */
	var sortGrid = $(".grid-sort"),
		sortGridItems1 = sortGrid.find(".web-type .desc, .web-work .desc"),
		sortGridItems2 = sortGrid.find(".app-type .desc, .app-work .desc");

	function sortGridOnResize() {
		if(fromBreakpoint("@laptop")) {
			sortGridItemAutoHeight(sortGridItems1, 3);
			sortGridItemAutoHeight(sortGridItems2, 3);
		} else if(fromBreakpoint("@tablet")) {
			sortGridItemAutoHeight(sortGridItems1, 2);
			sortGridItemAutoHeight(sortGridItems2, 2);
		} else {
			sortGridItemAutoHeight(sortGridItems1, 1);
			sortGridItemAutoHeight(sortGridItems2, 1);
		}	
	}

	function sortGridItemAutoHeight(sortGridItems, columns) {
		var sortGridRowsIndex = 0;
			sortGridRowsHeight = [],
			sortGridItemHeight = 0;

		sortGridItems.css("height", "auto").each(function(i) {
			if(sortGridItemHeight < $(this).height()) {
				sortGridItemHeight = $(this).height();
			}
			if((i+1) % columns == 0) {
				sortGridRowsHeight.push(sortGridItemHeight);
			} else if(i == sortGridItems.length) {
				sortGridRowsHeight.push(sortGridItemHeight);
			}
		});

		sortGridItems.each(function(i) {
			$(this).height(sortGridRowsHeight[sortGridRowsIndex]);
			if((i+1) % columns == 0) {
				sortGridRowsIndex++;
			}
		});
	}


	/* =========================================================================== */
	/*  Centering Grid
	/* =========================================================================== */
	var centerGrid = $(".grid-center");
		centerGridCol = centerGrid.find(".col-4");
	function centerGridOnResize() {
		if(fromBreakpoint("@laptop")){
			if((centerGridCol.length % 2) != 0) {
				centerGridCol
					.last().css("margin-left", 0)
					.prev().css("margin-left", "16.66666667%");
			}
		} else if(fromBreakpoint("@tablet")){
			if((centerGridCol.length % 2) != 0) {
				centerGridCol
					.last().css("margin-left", "25%")
					.prev().css("margin-left", 0);
			}
		} else {
			centerGridCol
				.last().css("margin-left", 0)
				.prev().css("margin-left", 0);
		}
	}


	/* =========================================================================== */
	/*  Window Resize End
	/* =========================================================================== */
	$(window).load(function(){
		$(window).resize(function(){
			
		});

		var resizeWindowEnd = function() {
			initHero();
			thumbImagesCenter();
			bsStudentTesti.getNiceScroll().resize();
			centerGridOnResize();
			sortGridOnResize();
			colorboxOnResize();
		}

		resizeWindowEnd();
		var resizeTimer;
		$(window).on('resize', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {

				resizeWindowEnd();

			}, 200);
		});	
	});


	
	/////////////////////////////////////////////////////////////////////////////////
	//===============================================================================
	//  FIRST LOAD END
	//===============================================================================
	/////////////////////////////////////////////////////////////////////////////////

	
	/* =========================================================================== */
	/*  Tool Tip
	/* =========================================================================== */

	$('.bs-tip').tooltipster({
		maxWidth: 320,
		delay: 100
	});


	/* =========================================================================== */
	/*  Stellar Parallax
	/* =========================================================================== */
	function loadStellar(){
		$('body').imagesLoaded().always( function( instance ) {
			$.stellar({
				horizontalScrolling: false,
				hideDistantElements: false,
				responsive: true
			});
		});
	}

	function setParallax() {
		var mainHeader = $("#main-header"),
			windowHeight = $(window).height();

		if(windowHeight > 550 && fromBreakpoint("@tablet")) {
			mainHeader.attr("data-stellar-ratio", 0.5);
		}
	}

	setParallax();
	loadStellar();

	/* =========================================================================== */
	/*  Course Menu
	/* =========================================================================== */
	var courseMenu = $(".course-menu"),
		owlCourseMenu = $("#owl-course-menu"),
		owlCourseMenuPrev = courseMenu.find(".owl-menu-prev"),
		owlCourseMenuNext = courseMenu.find(".owl-menu-next");

	owlCourseMenu.owlCarousel({
		navigation : false,
		slideSpeed : 400,
		pagination : false,
		items : 4,
		itemsDesktop : [992,3],
		itemsDesktopSmall : [678,2],
		itemsTablet : [480,1],
		itemsMobile : [320, 1]
	});

	owlCourseMenu.find(".menu").each(function(index){
		if ( $( this ).is( ".active" ) ) {
			owlCourseMenu.trigger('owl.goTo', index);
			return false;
		}
	});

	owlCourseMenuPrev.click(function(){
		owlCourseMenu.trigger("owl.prev")
	});

	owlCourseMenuNext.click(function(){
		owlCourseMenu.trigger("owl.next")
	});
	

	/* =========================================================================== */
	/*  Scroll Animation
	/* =========================================================================== */

	if(fromBreakpoint("@mobile")) {
		if($(".hero").length) {
			var headers = $(".bs-header1, .bs-header2, .bs-header3, .bs-sub-header1, .bs-sub-header2");
			headers.css({
				"-webkit-animation-duration": ".5s",
	  			"animation-duration": ".5s",
			}).addClass("hidden").viewportChecker({
				classToAdd: 'visible animated zoomIn',
				classToRemove: 'zoomIn',
			});
		}

		var bsWhy = $(".bs-why").addClass("has-animate"),
			bsLeftImg = bsWhy.find(".bc-left-img"),
			bsRightImg = bsWhy.find(".bc-right-img");

		bsLeftImg.addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInRight',
			classToRemove: 'fadeInRight',
		});

		bsRightImg.addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInLeft',
			classToRemove: 'fadeInLeft',
		});


		var bsCourse = $(".bs-course").addClass("has-animate"),
			bsCourseItem = bsCourse.find(".course");
		bsCourseItem.addClass("hidden").viewportChecker({
			classToAdd: 'visible animated flipInX',
			classToRemove: 'flipInX',
		});


		var bsService = $(".bs-service").addClass("has-animate"),
			bsServiceLeft = bsService.find(".service.left"),
			bsServiceRight = bsService.find(".service.right");
		bsServiceRight.addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInRight',
			classToRemove: 'fadeInRight',
		});

		bsServiceLeft.addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInLeft',
			classToRemove: 'fadeInLeft',
		});
	}
	

	/* =========================================================================== */
	/*  Pop up after mouse cursor leaving web
	/* =========================================================================== */

	$("body").one("mouseleave", function(e){
         var str = "( " + e.pageX + ", " + e.pageY + " )";
         // alert(str);

         $('#myModal').modal('toggle');
     });


	/* =========================================================================== */
	/*  Fixed course menu
	/* =========================================================================== */

	$(window).scroll(function () {
	      //if you hard code, then use console
	      //.log to determine when you want the 
	      //nav bar to stick.  
	      // console.log($(window).scrollTop())
	    if ($(window).scrollTop() > 450) {
	      $('.menu-group').addClass('navbar-fixed');
	    }
	    if ($(window).scrollTop() < 450) {
	      $('.menu-group').removeClass('navbar-fixed');
	    }
	});

	// //Initialize tooltips
 //    $('.nav-tabs > li a[title]').tooltip();
    
 //    //Wizard
 //    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

 //        var $target = $(e.target);
    
 //        if ($target.parent().hasClass('disabled')) {
 //            return false;
 //        }
 //    });

 //    $(".next-step").click(function (e) {

 //        var $active = $('.wizard .nav-tabs li.active');
 //        $active.next().removeClass('disabled');
 //        nextTab($active);

 //    });
 //    $(".prev-step").click(function (e) {

 //        var $active = $('.wizard .nav-tabs li.active');
 //        prevTab($active);

 //    });

});

// function nextTab(elem) {
//     $(elem).next().find('a[data-toggle="tab"]').click();
// }
// function prevTab(elem) {
//     $(elem).prev().find('a[data-toggle="tab"]').click();
// }