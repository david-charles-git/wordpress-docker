// Enter Exit Functions
var setEnterExitOffsets = function () {
    var enterExitItems = document.getElementsByClassName("enterExitItem");
    for (var a = 0; a < enterExitItems.length; a++) {
        var enterExitOffsetX = enterExitItems[a].getAttribute("data-enter-exit-offset-x") || "";
        var enterExitOffsetY = enterExitItems[a].getAttribute("data-enter-exit-offset-y") || "";
        var enterExitOffsetXValue = !isNaN(parseFloat(enterExitOffsetX)) ? parseFloat(enterExitOffsetX) : 0; //px
        var enterExitOffsetYValue = !isNaN(parseFloat(enterExitOffsetY)) ? parseFloat(enterExitOffsetY) : 0; //px
        var elementIsAboveFold = getElementIsAboveFold(enterExitItems[a]);
        var defaultDelay = elementIsAboveFold ? 500 : 0; //ms
        var enterExitDelay = enterExitItems[a].getAttribute("data-enter-exit-delay") || "";
        var enterExitDelayValue = !isNaN(parseFloat(enterExitDelay)) ? defaultDelay + parseFloat(enterExitDelay) : defaultDelay; //ms
        enterExitItems[a].style.transform = "translate(" + enterExitOffsetXValue + "px, " + enterExitOffsetYValue + "px)";
        enterExitItems[a].classList.add("enterExitSet");
        setTimeout(setElementEnterExit, enterExitDelayValue, enterExitItems[a]);
    }
    return;
};
var manageEnterExit = function () {
    var enterExitParents = document.getElementsByClassName("hasEnterExit");
    for (var a = 0; a < enterExitParents.length; a++) {
        var elementIsInViewport = getElementIsInViewportY(enterExitParents[a]);
        if (!elementIsInViewport) {
            continue;
        }
        var enterExitItems = enterExitParents[a].getElementsByClassName("enterExitItem");
        for (var b = 0; b < enterExitItems.length; b++) {
            setElementEnterExit(enterExitItems[b]);
        }
    }
    return;
};
window.addEventListener("load", function () { setEnterExitOffsets(); });
window.addEventListener("scroll", function () { manageEnterExit(); });

//# sourceMappingURL=EnterExitFunctions.js.map
