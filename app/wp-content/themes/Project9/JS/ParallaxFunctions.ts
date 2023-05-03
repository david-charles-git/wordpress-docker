/* Parallax Functions */
const setParallaxOffsets : () => void = () => {
    const parallaxItems : any = document.getElementsByClassName("parallaxItem");

    for (var a = 0; a < parallaxItems.length; a++) {
        const parallaxParent : any = parallaxItems[a].closest(".hasParallax");

        if (!parallaxParent) { continue; }

        const parallaxRateX : string = parallaxItems[a].getAttribute("data-parallax-rate-x") || "";
        const parallaxRateY : string = parallaxItems[a].getAttribute("data-parallax-rate-y") || "";
        const parallaxRateXValue : number = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
        const parallaxRateYValue : number = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
        const elementIsAboveFold : boolean = getElementIsAboveFold(parallaxItems[a]);
        const elementOffsetX : number = elementIsAboveFold ? 0 : (-1) * parallaxRateXValue * (window.innerWidth / 2 - parallaxItems[a].clientWidth); //px
        const elementOffsetY : number = elementIsAboveFold ? 0 : (-1) * parallaxRateYValue * (window.innerHeight - parallaxItems[a].clientHeight); //px
        
        parallaxItems[a].style.transform = "translate(" + elementOffsetX + "px, " + elementOffsetY + "px)";
        parallaxItems[a].setAttribute("data-parallax-offset-x", elementOffsetX);
        parallaxItems[a].setAttribute("data-parallax-offset-y", elementOffsetY);
        parallaxItems[a].classList.add("parallaxSet");
    }  

    return;            
}
const manageParallax : () => void = () => {
    const parallaxElements : any = document.getElementsByClassName("hasParallax");

    for (var a = 0; a < parallaxElements.length; a++) {
        const elementIsInViewport : boolean = getElementIsInViewportY(parallaxElements[a]);

        if (!elementIsInViewport) { continue; }
        
        const parallaxItems : any = parallaxElements[a].getElementsByClassName("parallaxItem");

        for (var b = 0; b < parallaxItems.length; b++) {
            setElementParallax(parallaxItems[b]);
        }   
    }

    return;
}
window.addEventListener("load", () => { setParallaxOffsets(); });
window.addEventListener("scroll", () => { manageParallax(); });