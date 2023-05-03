/* Read More Functions */
var handleReadMoreClick = function (readMoreCopy, readLessCopy) {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget || !readMoreCopy || !readLessCopy) {
        return;
    }
    var readMoreContainer = eventTarget.closest(".readMore");
    var openClose = eventTarget.getAttribute("data-openClose");
    if (!readMoreContainer || (openClose !== "open" && openClose !== "close")) {
        return;
    }
    var readMoreContent = readMoreContainer.getElementsByTagName("P")[0];
    if (!readMoreContent) {
        return;
    }
    var newOpenClose = openClose === "open" ? "close" : "open";
    var readMoreContainerHeight = readMoreContainer.clientHeight; //px
    var timeoutDelayOne = 210; //ms
    var timeoutDelayTwo = 220; //ms
    readMoreContainer.style.height = readMoreContainerHeight + "px";
    readMoreContainer.style.opacity = 0;
    eventTarget.setAttribute("data-openClose", newOpenClose);
    setTimeout(function () {
        var readMoreText = openClose === "open" ? readLessCopy : readMoreCopy;
        readMoreContainer.classList.toggle("active");
        eventTarget.innerText = readMoreText;
    }, timeoutDelayOne);
    setTimeout(function () {
        var readMoreContentHeight = readMoreContent.clientHeight; //px
        readMoreContainer.style.height = readMoreContentHeight + "px";
        readMoreContainer.style.opacity = null;
    }, timeoutDelayTwo);
    return;
};
var resetAllReadMores = function () {
    var readMoreContainers = document.getElementsByClassName("readMore");
    for (var a = 0; a < readMoreContainers.length; a++) {
        var readMoreCopy = readMoreContainers[a].getAttribute("data-readMoreCopy");
        var readMoreButton = readMoreContainers[a].getElementsByClassName("button")[0];
        if (!readMoreCopy || !readMoreButton) {
            continue;
        }
        readMoreContainers[a].classList.remove("active");
        readMoreContainers[a].style.height = null;
        readMoreButton.setAttribute("data-openClose", "open");
        readMoreButton.innerText = readMoreCopy;
    }
    return;
};
window.addEventListener("resize", function () { resetAllReadMores(); });

//# sourceMappingURL=ReadMoreFunctions.js.map
