/* Element Functions */
interface elementCoordinates {
    top    : number,
    left   : number,
    bottom : number,
    right  : number
}

const getElementCoordinates : (element : HTMLElement) => elementCoordinates = (element) => {
    const elementTop : number = window.scrollY + element.getBoundingClientRect().top; //px
    const elementBottom : number = elementTop + element.clientHeight; //px
    const elementLeft : number = window.scrollX + element.getBoundingClientRect().left; //px
    const elementRight : number = elementLeft + element.clientWidth; //px
    const elementCoordinates : elementCoordinates = {
        top    : elementTop,
        left   : elementLeft,
        bottom : elementBottom,
        right  : elementRight 
    };

    return elementCoordinates;
}
const getElementIsAboveFold : (element : HTMLElement) => boolean = (element) => {
    const elementCoordinates : elementCoordinates = getElementCoordinates(element);

    if (elementCoordinates.top > window.innerHeight) { return false; }

    return true;
}
const getElementIsInViewportX : (element : HTMLElement) => boolean = (element) => {
    const elementCoordinates : elementCoordinates = getElementCoordinates(element);

    if (elementCoordinates.left > window.scrollX + window.innerWidth || elementCoordinates.right < window.scrollX) { return false; }

    return true;
}
const getElementIsInViewportY : (element : HTMLElement) => boolean = (element) => {
    const elementCoordinates : elementCoordinates = getElementCoordinates(element);

    if (elementCoordinates.top > window.scrollY + window.innerHeight || elementCoordinates.bottom < window.scrollY) {  return false; }

    return true;
}
const getElementIsInViewport : (element : HTMLElement) => boolean = (element) => {
    if (!getElementIsInViewportX(element) || !getElementIsInViewportY(element)) {  return false; }

    return true;
}
const getElementRelativeScrollY : (element : HTMLElement | null) => number = (element) => {  
    if (!element) { return 0; }

    const elementCoordinates : elementCoordinates = getElementCoordinates(element);
    const elementIsAboveFold : boolean = getElementIsAboveFold(element);
    var elementRelativeScrollY : number = window.scrollY + window.innerHeight - elementCoordinates.top; //px

    if (elementIsAboveFold) { elementRelativeScrollY = window.scrollY; }
    
    if (window.scrollY + window.innerHeight - elementCoordinates.top < 0) { elementRelativeScrollY = 0; }

    return elementRelativeScrollY;
}
const setElementEnterExit : (element : HTMLElement) => void = (element) => {    
    const enterExitType : string = element.getAttribute("data-enter-exit-type") || "";

    if (enterExitType == "enter") {
        if (getElementIsInViewportY(element) && !element.classList.contains("entered")) { element.classList.add("entered"); }

        return;
    }

    if (enterExitType == "exit") {
        if (!getElementIsInViewportY(element) && element.classList.contains("entered")) { element.classList.remove("entered"); }

        return;
    }

    if (!getElementIsInViewportY(element) &&  element.classList.contains("entered")) {  element.classList.remove("entered"); }

    if (getElementIsInViewportY(element) &&  !element.classList.contains("entered")) { element.classList.add("entered"); }

    return;
}
const setElementParallax : (element : HTMLElement) => void = (element) => {
    const parallaxParent : HTMLElement | null = element.closest(".hasParallax") || null;

    if (!parallaxParent) { return; }

    const windowWidthToHeightRatio : number = window.innerWidth / window.innerHeight;
    const parentRelativeScroll : number = getElementRelativeScrollY(parallaxParent); //px

    const parallaxRateX : string = element.getAttribute("data-parallax-rate-x") || "";
    const parallaxRateY : string = element.getAttribute("data-parallax-rate-y") || "";
    const parallaxOffsetX : string = element.getAttribute("data-parallax-offset-x") || "";
    const parallaxOffsetY : string = element.getAttribute("data-parallax-offset-y") || "";

    const parallaxRateXValue : number = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
    const parallaxRateYValue : number = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
    const parallaxOffsetXValue : number = !isNaN(parseFloat(parallaxOffsetX)) ? parseFloat(parallaxOffsetX) : 0; //px
    const parallaxOffsetYValue : number = !isNaN(parseFloat(parallaxOffsetY)) ? parseFloat(parallaxOffsetY) : 0; //px
    const parallaxValueX : number = parallaxOffsetXValue + (parallaxRateXValue * parentRelativeScroll + windowWidthToHeightRatio); //px
    const parallaxValueY : number = parallaxOffsetYValue + (parallaxRateYValue * parentRelativeScroll); //px
    
    element.style.transform = "translate(" + parallaxValueX + "px, " + parallaxValueY + "px)";

    return;
}
const setBackgroundElementParallax : (element : HTMLElement) => void = (element) => {
    const parallaxParent : HTMLElement | null = element.closest(".hasParallaxBackground");

    if (!parallaxParent) { return; }

    const parentRelativeScroll : number = getElementRelativeScrollY(parallaxParent); //px
    const parallaxRateX : string = element.getAttribute("data-parallax-rate-x") || "";
    const parallaxRateY : string = element.getAttribute("data-parallax-rate-y") || "";
    
    const parallaxRateXValue : number = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
    const parallaxRateYValue : number = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
    const parallaxValueX : number = parallaxRateXValue * parentRelativeScroll; //px
    const parallaxValueY : number = parallaxRateYValue * parentRelativeScroll; //px
    
    element.style.transform = "translate(" + parallaxValueX + "px, " + parallaxValueY + "px)";

    return;
}