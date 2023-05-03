/* Parallax Background Functions */
var setParallaxBackgroundHeights = function () {
    var parallaxBackgroundItems = document.getElementsByClassName("parallaxBackgroundItem");
    for (var a = 0; a < parallaxBackgroundItems.length; a++) {
        var parallaxRateX = parallaxBackgroundItems[a].getAttribute("data-parallax-rate-x") || "";
        var parallaxRateY = parallaxBackgroundItems[a].getAttribute("data-parallax-rate-y") || "";
        var parallaxRateXValue = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
        var parallaxRateYValue = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
        var parallaxBackgroundWidth = parallaxBackgroundItems[a].clientWidth > 0 ? parallaxBackgroundItems[a].clientWidth : 1; //px
        var parallaxBackgroundHeight = parallaxBackgroundItems[a].clientHeight > 0 ? parallaxBackgroundItems[a].clientHeight : 1; //px
        var alteredWidth = Math.abs((window.innerWidth / parallaxBackgroundWidth) * parallaxRateXValue * 100) + 100; //%
        var alteredHeight = Math.abs((window.innerHeight / parallaxBackgroundHeight) * parallaxRateYValue * 100) + 100; //%
        parallaxBackgroundItems[a].style.width = alteredWidth + "%";
        parallaxBackgroundItems[a].style.height = alteredHeight + "%";
        parallaxBackgroundItems[a].classList.add("parallaxSet");
    }
    return;
};
var manageParallaxBackground = function () {
    var parallaxBackgroundElements = document.getElementsByClassName("hasParallaxBackground");
    for (var a = 0; a < parallaxBackgroundElements.length; a++) {
        var elementIsInViewport = getElementIsInViewportY(parallaxBackgroundElements[a]);
        if (!elementIsInViewport) {
            continue;
        }
        var parallaxBackgroundItems = parallaxBackgroundElements[a].getElementsByClassName("parallaxBackgroundItem");
        for (var b = 0; b < parallaxBackgroundItems.length; b++) {
            setBackgroundElementParallax(parallaxBackgroundItems[b]);
        }
    }
    return;
};
window.addEventListener("load", function () { setParallaxBackgroundHeights(); });
window.addEventListener("scroll", function () { manageParallaxBackground(); });

//# sourceMappingURL=ParallaxBackgroundFunctions.js.map
