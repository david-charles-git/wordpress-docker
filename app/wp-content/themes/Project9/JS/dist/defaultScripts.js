/* Pop Up Functions */
var handleCloseLocalPopUp = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var localPopUp = eventTarget.closest(".popUp");
    if (!localPopUp) {
        return;
    }
    localPopUp.classList.remove("active");
    setTimeout(function () { localPopUp.style.display = "none"; }, 100);
    return;
};
var handleOpenPopUpByID = function (elementID) {
    if (!elementID) {
        return;
    }
    var targetPopUp = document.getElementById(elementID);
    if (!targetPopUp) {
        return;
    }
    targetPopUp.style.display = "block";
    setTimeout(function () { targetPopUp.classList.add("active"); }, 100);
    return;
};
/* Navigation Fucntions */
var goToSectionByID = function (elementID) {
    if (!elementID) {
        return;
    }
    var targetElement = document.getElementById(elementID);
    if (!targetElement) {
        return;
    }
    var elementCoordinates = getElementCoordinates(targetElement);
    window.scrollTo({
        top: elementCoordinates.top - 100,
        left: 0,
        behavior: "smooth"
    });
    return;
};
var goToPageTop = function () {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    });
    return;
};
var handleToPageTopButtonActiveToggle = function () {
    var toTopContainer = document.getElementById("toTop");
    var heroBanner = document.getElementsByClassName("HeroBanner")[0];
    if (!toTopContainer || !heroBanner) {
        return;
    }
    var heroBannerHeight = heroBanner.clientHeight; //px
    var windowScrollY = window.scrollY; //px
    if (windowScrollY > heroBannerHeight) {
        toTopContainer.style.display = "block";
        setTimeout(function () { toTopContainer.classList.add("active"); }, 200);
    }
    else {
        toTopContainer.classList.remove("active");
        setTimeout(function () { toTopContainer.style.display = "none"; }, 200);
    }
    return;
};
window.addEventListener("scroll", function () { handleToPageTopButtonActiveToggle(); });

//# sourceMappingURL=defaultScripts.js.map
