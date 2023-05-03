/* Parallax Functions */
var setParallaxOffsets = function () {
    var parallaxItems = document.getElementsByClassName("parallaxItem");
    for (var a = 0; a < parallaxItems.length; a++) {
        var parallaxParent = parallaxItems[a].closest(".hasParallax");
        if (!parallaxParent) {
            continue;
        }
        var parallaxRateX = parallaxItems[a].getAttribute("data-parallax-rate-x") || "";
        var parallaxRateY = parallaxItems[a].getAttribute("data-parallax-rate-y") || "";
        var parallaxRateXValue = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
        var parallaxRateYValue = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
        var elementIsAboveFold = getElementIsAboveFold(parallaxItems[a]);
        var elementOffsetX = elementIsAboveFold ? 0 : (-1) * parallaxRateXValue * (window.innerWidth / 2 - parallaxItems[a].clientWidth); //px
        var elementOffsetY = elementIsAboveFold ? 0 : (-1) * parallaxRateYValue * (window.innerHeight - parallaxItems[a].clientHeight); //px
        parallaxItems[a].style.transform = "translate(" + elementOffsetX + "px, " + elementOffsetY + "px)";
        parallaxItems[a].setAttribute("data-parallax-offset-x", elementOffsetX);
        parallaxItems[a].setAttribute("data-parallax-offset-y", elementOffsetY);
        parallaxItems[a].classList.add("parallaxSet");
    }
    return;
};
var manageParallax = function () {
    var parallaxElements = document.getElementsByClassName("hasParallax");
    for (var a = 0; a < parallaxElements.length; a++) {
        var elementIsInViewport = getElementIsInViewportY(parallaxElements[a]);
        if (!elementIsInViewport) {
            continue;
        }
        var parallaxItems = parallaxElements[a].getElementsByClassName("parallaxItem");
        for (var b = 0; b < parallaxItems.length; b++) {
            setElementParallax(parallaxItems[b]);
        }
    }
    return;
};
window.addEventListener("load", function () { setParallaxOffsets(); });
window.addEventListener("scroll", function () { manageParallax(); });

//# sourceMappingURL=ParallaxFunctions.js.map
