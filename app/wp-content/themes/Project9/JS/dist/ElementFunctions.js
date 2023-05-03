var getElementCoordinates = function (element) {
    var elementTop = window.scrollY + element.getBoundingClientRect().top; //px
    var elementBottom = elementTop + element.clientHeight; //px
    var elementLeft = window.scrollX + element.getBoundingClientRect().left; //px
    var elementRight = elementLeft + element.clientWidth; //px
    var elementCoordinates = {
        top: elementTop,
        left: elementLeft,
        bottom: elementBottom,
        right: elementRight
    };
    return elementCoordinates;
};
var getElementIsAboveFold = function (element) {
    var elementCoordinates = getElementCoordinates(element);
    if (elementCoordinates.top > window.innerHeight) {
        return false;
    }
    return true;
};
var getElementIsInViewportX = function (element) {
    var elementCoordinates = getElementCoordinates(element);
    if (elementCoordinates.left > window.scrollX + window.innerWidth || elementCoordinates.right < window.scrollX) {
        return false;
    }
    return true;
};
var getElementIsInViewportY = function (element) {
    var elementCoordinates = getElementCoordinates(element);
    if (elementCoordinates.top > window.scrollY + window.innerHeight || elementCoordinates.bottom < window.scrollY) {
        return false;
    }
    return true;
};
var getElementIsInViewport = function (element) {
    if (!getElementIsInViewportX(element) || !getElementIsInViewportY(element)) {
        return false;
    }
    return true;
};
var getElementRelativeScrollY = function (element) {
    if (!element) {
        return 0;
    }
    var elementCoordinates = getElementCoordinates(element);
    var elementIsAboveFold = getElementIsAboveFold(element);
    var elementRelativeScrollY = window.scrollY + window.innerHeight - elementCoordinates.top; //px
    if (elementIsAboveFold) {
        elementRelativeScrollY = window.scrollY;
    }
    if (window.scrollY + window.innerHeight - elementCoordinates.top < 0) {
        elementRelativeScrollY = 0;
    }
    return elementRelativeScrollY;
};
var setElementEnterExit = function (element) {
    var enterExitType = element.getAttribute("data-enter-exit-type") || "";
    if (enterExitType == "enter") {
        if (getElementIsInViewportY(element) && !element.classList.contains("entered")) {
            element.classList.add("entered");
        }
        return;
    }
    if (enterExitType == "exit") {
        if (!getElementIsInViewportY(element) && element.classList.contains("entered")) {
            element.classList.remove("entered");
        }
        return;
    }
    if (!getElementIsInViewportY(element) && element.classList.contains("entered")) {
        element.classList.remove("entered");
    }
    if (getElementIsInViewportY(element) && !element.classList.contains("entered")) {
        element.classList.add("entered");
    }
    return;
};
var setElementParallax = function (element) {
    var parallaxParent = element.closest(".hasParallax") || null;
    if (!parallaxParent) {
        return;
    }
    var windowWidthToHeightRatio = window.innerWidth / window.innerHeight;
    var parentRelativeScroll = getElementRelativeScrollY(parallaxParent); //px
    var parallaxRateX = element.getAttribute("data-parallax-rate-x") || "";
    var parallaxRateY = element.getAttribute("data-parallax-rate-y") || "";
    var parallaxOffsetX = element.getAttribute("data-parallax-offset-x") || "";
    var parallaxOffsetY = element.getAttribute("data-parallax-offset-y") || "";
    var parallaxRateXValue = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
    var parallaxRateYValue = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
    var parallaxOffsetXValue = !isNaN(parseFloat(parallaxOffsetX)) ? parseFloat(parallaxOffsetX) : 0; //px
    var parallaxOffsetYValue = !isNaN(parseFloat(parallaxOffsetY)) ? parseFloat(parallaxOffsetY) : 0; //px
    var parallaxValueX = parallaxOffsetXValue + (parallaxRateXValue * parentRelativeScroll + windowWidthToHeightRatio); //px
    var parallaxValueY = parallaxOffsetYValue + (parallaxRateYValue * parentRelativeScroll); //px
    element.style.transform = "translate(" + parallaxValueX + "px, " + parallaxValueY + "px)";
    return;
};
var setBackgroundElementParallax = function (element) {
    var parallaxParent = element.closest(".hasParallaxBackground");
    if (!parallaxParent) {
        return;
    }
    var parentRelativeScroll = getElementRelativeScrollY(parallaxParent); //px
    var parallaxRateX = element.getAttribute("data-parallax-rate-x") || "";
    var parallaxRateY = element.getAttribute("data-parallax-rate-y") || "";
    var parallaxRateXValue = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
    var parallaxRateYValue = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
    var parallaxValueX = parallaxRateXValue * parentRelativeScroll; //px
    var parallaxValueY = parallaxRateYValue * parentRelativeScroll; //px
    element.style.transform = "translate(" + parallaxValueX + "px, " + parallaxValueY + "px)";
    return;
};

//# sourceMappingURL=ElementFunctions.js.map
