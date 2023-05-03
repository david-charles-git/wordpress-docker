// Carousel Functions
var setCarouselGridGap = function () {
    var carousels = document.getElementsByClassName("Carousel");
    for (var a = 0; a < carousels.length; a++) {
        var carouselInner = carousels[a].getElementsByClassName("inner")[0] || null;
        var gridGap = carousels[a].getAttribute("data-carousel-grid-gap") || "";
        var gridGapValue = !isNaN(parseFloat(gridGap)) ? parseFloat(gridGap) : 0; //px
        if (!carouselInner) {
            continue;
        }
        carouselInner.style.gridGap = gridGapValue + "px";
        continue;
    }
    return;
};
var setCarouselItemsMaxWidth = function () {
    var carousels = document.getElementsByClassName("Carousel");
    for (var a = 0; a < carousels.length; a++) {
        var itemMaxWidth = carousels[a].getAttribute("data-carousel-item-max-width") || "";
        var itemMaxWidthValue = !isNaN(parseFloat(itemMaxWidth)) ? parseFloat(itemMaxWidth) : 400; //px
        var carouselItems = carousels[a].getElementsByClassName("item");
        for (var b = 0; b < carouselItems.length; b++) {
            carouselItems[b].style.maxWidth = itemMaxWidthValue + "px";
        }
        carousels[a].classList.add("carouselSet");
    }
    return;
};
var setCarouselInitialShownItems = function () {
    var carousels = document.getElementsByClassName("Carousel");
    for (var a = 0; a < carousels.length; a++) {
        setCarouselShownItems(carousels[a]);
    }
    return;
};
var setCarouselShownItems = function (carousel) {
    var carouselMaxWidth = carousel.getAttribute("data-carousel-max-width") || "";
    var carouselMaxWidthValue = !isNaN(parseFloat(carouselMaxWidth)) ? parseFloat(carouselMaxWidth) : 0; //px
    if (carouselMaxWidthValue > window.innerWidth) {
        carouselMaxWidthValue = window.innerWidth;
    }
    var activeItem = carousel.getElementsByClassName("item active")[0] || null;
    if (!activeItem) {
        return;
    }
    var activeItemCoordinates = getElementCoordinates(activeItem);
    if (!activeItemCoordinates) {
        return;
    }
    var items = carousel.getElementsByClassName("item");
    for (var a = 0; a < items.length; a++) {
        if (items[a] == activeItem) {
            continue;
        }
        var itemCoordinates = getElementCoordinates(items[a]);
        if (!itemCoordinates) {
            continue;
        }
        if (itemCoordinates.right < activeItemCoordinates.left) {
            items[a].classList.remove("showing");
            continue;
        }
        if (itemCoordinates.right > carouselMaxWidthValue + activeItemCoordinates.left) {
            items[a].classList.remove("showing");
            continue;
        }
        items[a].classList.add("showing");
    }
    return;
};
var handleCarouselButtonClick = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var carousel = eventTarget.closest(".Carousel");
    if (!carousel) {
        return;
    }
    var isLeftButton = eventTarget.classList.contains("left");
    var isRightButton = eventTarget.classList.contains("right");
    if (isLeftButton) {
        shiftCarouselLeft(eventTarget);
    }
    if (isRightButton) {
        shiftCarouselRight(eventTarget);
    }
    stopCarouselAutoShift(carousel);
    return;
};
var handleCarouselNavigationTabClick = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var carousel = eventTarget.closest(".Carousel");
    if (!carousel) {
        return;
    }
    var tabIndex = eventTarget.getAttribute("data-id") || "";
    var tabIndexValue = !isNaN(parseInt(tabIndex)) ? parseInt(tabIndex) : 0;
    shiftCarouselToFrame(carousel, tabIndexValue);
    stopCarouselAutoShift(carousel);
    return;
};
var handleCarouselTouchStart = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var carousel = eventTarget.closest(".Carousel");
    if (!carousel) {
        return;
    }
    var touchX = event.touches[0].clientX || 0; //px
    stopCarouselAutoShift(carousel);
    globalCarouselTouchX = touchX;
    return;
};
var handleCarouselTouchEnd = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var touchX = event.changedTouches[0].clientX || 0; //px
    if (globalCarouselTouchX > touchX) {
        shiftCarouselRight(eventTarget);
    }
    if (globalCarouselTouchX < touchX) {
        shiftCarouselLeft(eventTarget);
    }
    globalCarouselTouchX = 0; //px
    return;
};
var handleAutoShiftCarousels = function () {
    var carousels = document.getElementsByClassName("Carousel");
    for (var a = 0; a < carousels.length; a++) {
        var autoShift = carousels[a].getAttribute("data-carousel-auto-scroll");
        var carouselInner = carousels[a].getElementsByClassName("inner")[0];
        if (autoShift == "true" && carouselInner) {
            shiftCarouselRight(carouselInner);
        }
    }
    return;
};
var handleCarouselOnResize = function () {
    var carousels = document.getElementsByClassName("Carousel");
    for (var a = 0; a < carousels.length; a++) {
        shiftCarouselToFrame(carousels[a], 0);
        stopCarouselAutoShift(carousels[a]);
        setCarouselShownItems(carousels[a]);
    }
    return;
};
var shiftCarouselLeft = function (element) {
    if (!element) {
        return;
    }
    var carousel = element.closest(".Carousel");
    if (!carousel) {
        return;
    }
    var carsouselItems = carousel.getElementsByClassName("item");
    for (var a = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) {
            var newIndex = a - 1 < 0 ? carsouselItems.length - 1 : a - 1;
            shiftCarouselToFrame(carousel, newIndex);
            return;
        }
    }
    return;
};
var shiftCarouselRight = function (element) {
    if (!element) {
        return;
    }
    var carousel = element.closest(".Carousel");
    if (!carousel) {
        return;
    }
    var carsouselItems = carousel.getElementsByClassName("item");
    for (var a = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) {
            var newIndex = a + 1 >= carsouselItems.length ? 0 : a + 1;
            shiftCarouselToFrame(carousel, newIndex);
            return;
        }
    }
    return;
};
var shiftCarouselToFrame = function (carousel, frame) {
    if (!carousel) {
        return;
    }
    frame = frame || 0;
    var carouselInner = carousel.getElementsByClassName("inner")[0];
    if (!carouselInner) {
        return;
    }
    var carouselItemWidth = 0; //px
    var carouselGridGap = carousel.getAttribute("data-carousel-grid-gap") || "";
    var carouselGridGapValue = !isNaN(parseFloat(carouselGridGap)) ? parseFloat(carouselGridGap) : 0; //px
    var carsouselItems = carousel.getElementsByClassName("item");
    var tabItems = carousel.getElementsByClassName("tab");
    for (var a = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) {
            carouselItemWidth = carsouselItems[a].clientWidth + carouselGridGapValue; /*px*/
        }
        carsouselItems[a].classList.remove("active");
    }
    for (var a = 0; a < tabItems.length; a++) {
        tabItems[a].classList.remove("active");
    }
    var transformXValue = (-1) * frame * carouselItemWidth; //px
    carouselInner.style.transform = "translateX(" + transformXValue + "px)";
    carsouselItems[frame].classList.add("active");
    tabItems[frame].classList.add("active");
    setCarouselShownItems(carousel);
    var leftButton = carousel.getElementsByClassName("carouselButton left")[0];
    if (!leftButton) {
        return;
    }
    if (frame == 0) {
        leftButton.classList.remove("active");
        return;
    }
    leftButton.classList.add("active");
    return;
};
var stopCarouselAutoShift = function (carousel) {
    carousel.setAttribute("data-carousel-auto-scroll", "false");
    return;
};
var globalCarouselTouchX = 0; //px
var carouselAutoShiftIntervalTime = 5000; //ms
var carouselAutoShiftInterval = setInterval(handleAutoShiftCarousels, carouselAutoShiftIntervalTime);
window.addEventListener("load", function () { setCarouselGridGap(); setCarouselItemsMaxWidth(); setCarouselInitialShownItems(); });
window.addEventListener("resize", function () { handleCarouselOnResize(); });

//# sourceMappingURL=CarouselFunctions.js.map
