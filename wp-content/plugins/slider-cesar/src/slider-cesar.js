("use strict");
(function () {
	document.onreadystatechange = function () {
		if (document.readyState === "complete") {
			slidercesar(".slidercesar");
		}
	};
	let slidercesar = function (slidercesarSlides) {
		let slidercesarSlider = document.querySelectorAll(slidercesarSlides);
		slidercesarSlider.forEach(function (slider, index) {
			let initialActiveSlideAttr = slider.getAttribute(
				"data-initial-active-slide",
			);
			let loopSlideAttr = slider.getAttribute("data-loop-slide");
			let autoplayAttr = slider.getAttribute("data-autoplay");
			let autoplayIntervalAttr = slider.getAttribute("data-autoplay-interval");
			let slideNavigationAttr = slider.getAttribute("data-slide-navigation");
			let hoverPauseAttr = slider.getAttribute("data-hover-pause");
			let transitionEffectAttr = slider.getAttribute("data-transition-effect");
			let transitionDurationAttr = slider.getAttribute(
				"data-transition-duration",
			);
			let animationAttr = slider.getAttribute("data-animation");
			let transitionSpeedAttr = slider.getAttribute("data-transition-speed");
			let arrowNavigationAttr = slider.getAttribute("data-arrow-navigation");
			let variableHeightAttr = slider.getAttribute("data-variable-height");
			let settings = {
				initialActiveSlide: initialActiveSlideAttr
					? parseInt(initialActiveSlideAttr)
					: 0,
				loopSlide: loopSlideAttr ? false : true,
				autoplay: autoplayAttr ? false : true,
				autoplayInterval: autoplayIntervalAttr ? autoplayIntervalAttr : "1.5s",
				slideNavigation: slideNavigationAttr ? slideNavigationAttr : "dots",
				hoverPause: hoverPauseAttr ? false : true,
				transitionEffect: transitionEffectAttr ? transitionEffectAttr : "slide",
				transitionDuration: transitionDurationAttr
					? transitionDurationAttr
					: ".6s",
				animation: animationAttr
					? animationAttr
					: "cubic-bezier(0.46, 0.03, 0.52, 0.96)",
				transitionSpeed: transitionSpeedAttr ? transitionSpeedAttr : ".6s",
				arrowNavigation: arrowNavigationAttr ? false : true,
				variableHeight: variableHeightAttr ? true : false,
			};
			let currentSlideIndex = settings.initialActiveSlide;
			let currentSlideId = settings.initialActiveSlide;
			let previousSlideId = settings.initialActiveSlide;
			let animating = false;
			let el_slidercesar__track = slider.querySelector(".slidercesar__track");
			let el_slidercesar__slides = slider.querySelectorAll(
				".slidercesar__slide",
			);
			let el_slidercesar__button__previous = slider.querySelector(
				".slidercesar__button__previous",
			);
			let el_slidercesar__button__next = slider.querySelector(
				".slidercesar__button__next",
			);
			el_slidercesar__track.addEventListener(
				"transitionstart",
				transitionStart,
			);
			el_slidercesar__track.addEventListener("transitionend", transitionEnd);
			let offsetPercent = 100 / el_slidercesar__slides.length;
			let translateXOffset = currentSlideIndex * offsetPercent;
			let translateX = "translateX(-" + translateXOffset + "%)";
			let parallaxSlides = slider.querySelectorAll(
				'.slidercesar__slide[data-parallax="true"]',
			);
			if (parallaxSlides) {
				parallaxInit();
				window.addEventListener("scroll", function (event) {
					parallaxSlides.forEach(function (parallaxSlide, index) {
						let parallaxAttribute = parallaxSlide.getAttribute(
							"data-parallax-speed",
						);
						let el_slide_bg = parallaxSlide.querySelectorAll(
							".slidercesar__slide__bg",
						)[0];
						if (parallaxAttribute) {
							let sliderPositionY = parallaxSlide.getBoundingClientRect().y;
							if (
								sliderPositionY <= window.innerHeight &&
								sliderPositionY >= Math.abs(window.innerHeight) * -1
							) {
								let parallaxSpeed = parallaxAttribute
									? parseInt(parallaxAttribute) / 100
									: 0;
								let parallaxOffset =
									parallaxSpeed * (window.innerHeight - sliderPositionY);
								let totalParallaxOffset = parallaxSpeed * window.innerHeight;
								el_slide_bg.style.transform =
									"translateY(" +
									(parallaxOffset - totalParallaxOffset) +
									"px)";
							} else {
								el_slide_bg.style.transform = "translateY(0px)";
							}
						}
					});
				});
				window.addEventListener("resize", parallaxInit);
			}
			function parallaxInit() {
				parallaxSlides.forEach(function (slide, index) {
					let parallaxAttribute = slide.getAttribute("data-parallax-speed");
					let parallaxSpeed = parallaxAttribute
						? parseInt(parallaxAttribute) / 100
						: 0;
					let sliderBoundingRect = slider.getBoundingClientRect();
					let sliderPositionY = sliderBoundingRect.y;
					let sliderHeight = sliderBoundingRect.height;
					let windowHeight = window.innerHeight;
					let el_slide_bg = slide.querySelectorAll(
						".slidercesar__slide__bg",
					)[0];
					let el_slide_bg_img = el_slide_bg.querySelectorAll("img")[0];
					let imageHeight = (parallaxSpeed * windowHeight) / 2 + sliderHeight;
					el_slide_bg_img.style.height = imageHeight + "px";
					let totalParallaxOffset = parallaxSpeed * windowHeight;
					let parallaxOffset = 0;
					if (
						sliderPositionY <= windowHeight &&
						sliderPositionY >= Math.abs(windowHeight) * -1
					) {
						parallaxOffset = parallaxSpeed * (windowHeight - sliderPositionY);
					}
					el_slide_bg.style.transform =
						"translateY(" + (parallaxOffset - totalParallaxOffset) + "px)";
				});
			}
			let autoplayTime;
			let autoplayInterval;
			let autopayToggle;
			function onMouseOutAutoplay() {
				autopayToggle = autoplayInterval;
			}
			if (settings.autoplay == true) {
				if (settings.autoplayInterval.indexOf("ms") > 0) {
					autoplayInterval = parseInt(settings.autoplayInterval.split("ms")[0]);
					autopayToggle = autoplayInterval;
				} else {
					let seconds = Number(settings.autoplayInterval.split("s")[0]);
					autoplayInterval = seconds * 1000;
					autopayToggle = autoplayInterval;
				}
				if (typeof autoplayInterval === "number") {
					window.requestAnimationFrame(autoplayTimerFrame);
					if (settings.hoverPause == true) {
						slider.addEventListener("mouseover", function (event) {
							autopayToggle = "pause";
						});
						slider.addEventListener("mouseout", onMouseOutAutoplay);
					}
				}
			}
			function autoplayTimerFrame(timestamp) {
				if (autopayToggle === "stop") return;
				if (autoplayTime === undefined || autopayToggle === "pause")
					autoplayTime = timestamp;
				let elapsed = timestamp - autoplayTime;
				window.requestAnimationFrame(autoplayTimerFrame);
				if (elapsed >= autopayToggle) {
					autoplayTime = timestamp;
					nextSlide();
				}
			}
			let el_slidercesar__buttons = slider.querySelectorAll(
				".slidercesar__button",
			);
			if (settings.slideNavigation != "none") {
				el_slidercesar__buttons.forEach(function (button) {
					button.addEventListener("click", function () {
						if (!animating) {
							let buttonIdValue = parseInt(
								button.getAttribute("data-button-id"),
							);
							animateTrackToSlideId(buttonIdValue, true);
						}
					});
				});
			}
			function animateTrackToSlideId(slideId, toggleAutoplay) {
				if (toggleAutoplay === void 0) {
					toggleAutoplay = false;
				}
				if (!animating) {
					if (toggleAutoplay) {
						slider.removeEventListener("mouseout", onMouseOutAutoplay);
						autopayToggle = "stop";
					}
					if (currentSlideId != slideId) {
						el_slidercesar__slides = slider.querySelectorAll(
							".slidercesar__slide",
						);
						let slideIndex_1 = slideId;
						if (!settings.loopSlide) {
						} else if (
							settings.transitionEffect == "slide" &&
							settings.loopSlide == true
						) {
							if (
								currentSlideIndex === 0 &&
								el_slidercesar__slides.length > 2
							) {
								el_slidercesar__track.style.transition = "none";
								let lastSide =
									el_slidercesar__slides[el_slidercesar__slides.length - 1];
								el_slidercesar__track.prepend(lastSide);
								currentSlideIndex = 1;
								let trackOffset = currentSlideIndex * offsetPercent;
								translateX = "translateX(-" + trackOffset + "%)";
								el_slidercesar__track.style.transform = translateX;
							} else if (
								currentSlideIndex ===
								el_slidercesar__slides.length - 1
							) {
								el_slidercesar__track.style.transition = "none";
								currentSlideIndex = el_slidercesar__slides.length - 2;
								let trackOffset = currentSlideIndex * offsetPercent;
								translateX = "translateX(-" + trackOffset + "%)";
								el_slidercesar__track.style.transform = translateX;
								let firstSlide = el_slidercesar__slides[0];
								el_slidercesar__track.append(firstSlide);
							}
							let slideMatch = slider.querySelectorAll(
								'[data-slide-index="' + slideId + '"]',
							);
							if (slideMatch[0] && slideMatch[0].parentNode) {
								let slideMatch_parent_children =
									slideMatch[0].parentNode.children;
								let closeSlide = Array.from(slideMatch_parent_children).indexOf(
									slideMatch[0],
								);
								slideIndex_1 = closeSlide;
							}
						}
						setTimeout(function () {
							animate(slideId, slideIndex_1);
						}, 100);
					}
				}
			}
			function animate(slideId, slideIndex) {
				if (settings.transitionEffect == "slide") {
					el_slidercesar__track.style.transition =
						"all " + settings.transitionDuration + " " + settings.animation;
					let trackOffset = slideIndex * offsetPercent;
					translateX = "translateX(-" + trackOffset + "%)";
					el_slidercesar__track.style.transform = translateX;
					currentSlideIndex = slideIndex;
					currentSlideId = slideId;
				} else if (settings.transitionEffect == "fade") {
					currentSlideIndex = slideIndex;
					currentSlideId = slideId;
					transitionEnd();
				}
			}
			function transitionStart() {
				animating = true;
				if (autopayToggle !== "stop") autopayToggle = "pause";
				if (settings.transitionEffect == "slide") {
					el_slidercesar__track.style.transition =
						"all " + settings.transitionDuration + " " + settings.animation;
				}
				if (settings.variableHeight) {
					updateSliderHeight();
				}
				slider
					.querySelector('[data-slide-index="' + currentSlideId + '"]')
					.classList.add("slidercesar__slide--animating-in");
				slider
					.querySelector('[data-slide-index="' + previousSlideId + '"]')
					.classList.add("slidercesar__slide--animating-out");
			}
			function transitionEnd() {
				slider
					.querySelector(".slidercesar__slide--active")
					.classList.remove("slidercesar__slide--active");
				slider
					.querySelector('[data-slide-index="' + currentSlideId + '"]')
					.classList.add("slidercesar__slide--active");
				if (settings.slideNavigation != "none") {
					slider
						.querySelector(".slidercesar__button--active")
						.classList.remove("slidercesar__button--active");
					el_slidercesar__buttons[currentSlideId].classList.add(
						"slidercesar__button--active",
					);
				}
				animating = false;
				if (autopayToggle !== "stop") autopayToggle = autoplayInterval;
			}
			if (el_slidercesar__button__previous && el_slidercesar__button__next) {
				el_slidercesar__button__previous.addEventListener("click", function () {
					prevSlide(null, true);
				});
				el_slidercesar__button__next.addEventListener("click", function () {
					nextSlide(null, true);
				});
			}
			function prevSlide(event, toggleAutoplay) {
				removeAnimatingClasses();
				previousSlideId = currentSlideId;
				let prevSlideId = currentSlideId - 1;
				if (prevSlideId < 0) {
					prevSlideId = el_slidercesar__slides.length - 1;
				}
				animateTrackToSlideId(prevSlideId, toggleAutoplay);
			}
			function nextSlide(event, toggleAutoplay) {
				removeAnimatingClasses();
				previousSlideId = currentSlideId;
				let nextSlideId = currentSlideId + 1;
				if (nextSlideId > el_slidercesar__slides.length - 1) {
					nextSlideId = 0;
				}
				animateTrackToSlideId(nextSlideId, toggleAutoplay);
			}
			function removeAnimatingClasses() {
				slider
					.querySelector('[data-slide-index="' + currentSlideId + '"]')
					.classList.remove("slidercesar__slide--animating-in");
				slider
					.querySelector('[data-slide-index="' + previousSlideId + '"]')
					.classList.remove("slidercesar__slide--animating-out");
			}
			if (settings.variableHeight) {
				slider.style.transition = "height ease " + settings.transitionDuration;
				updateSliderHeight();
				window.addEventListener("resize", updateSliderHeight);
			}
			function updateSliderHeight() {
				let sliderWidth = slider.offsetWidth;
				let currentSceenSize = getScreenSize();
				let currentImage = slider.querySelector(
					'[data-slide-index="' +
						currentSlideId +
						'"] img.visible--' +
						currentSceenSize,
				);
				if (currentImage) {
					let imageOriginalWidth = Number(currentImage.getAttribute("width"));
					let imageOriginalHeight = Number(currentImage.getAttribute("height"));
					let imageVariableHeight = calculateVariableHeight(
						imageOriginalWidth,
						sliderWidth,
						imageOriginalHeight,
					);
					slider.style.height = imageVariableHeight + "px";
				}
			}
			function calculateVariableHeight(
				originalWidth,
				newWidth,
				originalHeight,
			) {
				let percentageDifference;
				if (originalWidth < newWidth) {
					let widthDifference = newWidth - originalWidth;
					percentageDifference = widthDifference / originalWidth;
					return percentageDifference * originalHeight + originalHeight;
				} else {
					let widthDifference = originalWidth - newWidth;
					percentageDifference = widthDifference / originalWidth;
					return originalHeight - percentageDifference * originalHeight;
				}
			}
			function getScreenSize() {
				let windowWidth = window.innerWidth;
				if (windowWidth > 1280) {
					return "xl";
				} else if (windowWidth < 1280 && windowWidth >= 1024) {
					return "lg";
				} else if (windowWidth < 1024 && windowWidth >= 768) {
					return "md";
				} else {
					return "sm";
				}
			}
			let pressDownX = null;
			let mouseXtriggerThreshold = 150;
			slider.addEventListener("mousedown", function (event) {
				pressDownX = event.pageX;
			});
			slider.addEventListener("mouseup", function (event) {
				let diffX = event.pageX - pressDownX;
				if (diffX > 0 && diffX < mouseXtriggerThreshold) {
					nextSlide(null, true);
				} else if (diffX < 0 && diffX > -mouseXtriggerThreshold) {
					prevSlide(null, true);
				}
			});
			let touchXtriggerThreshold = 6;
			slider.addEventListener("touchstart", handleTouchStart, {
				passive: true,
			});
			slider.addEventListener("touchmove", handleTouchMove, { passive: true });
			function handleTouchStart(event) {
				let firstTouch = event.touches[0];
				pressDownX = firstTouch.clientX;
			}
			function handleTouchMove(event) {
				if (!pressDownX) {
					return;
				}
				let xUp = event.touches[0].clientX;
				let xDiff = pressDownX - xUp;
				if (xDiff > touchXtriggerThreshold) {
					nextSlide(null, true);
					autopayToggle = "stop";
				} else if (xDiff < -touchXtriggerThreshold) {
					prevSlide(null, true);
					autopayToggle = "stop";
				}
				pressDownX = null;
			}
		});
	};
})();
