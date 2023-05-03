/* Parallax Background Functions */
const setParallaxBackgroundHeights : () => void = () => {
    const parallaxBackgroundItems : any = document.getElementsByClassName("parallaxBackgroundItem");

    for (var a = 0; a < parallaxBackgroundItems.length; a++) {
        const parallaxRateX : string = parallaxBackgroundItems[a].getAttribute("data-parallax-rate-x") || "";
        const parallaxRateY : string = parallaxBackgroundItems[a].getAttribute("data-parallax-rate-y") || "";
        const parallaxRateXValue : number = !isNaN(parseFloat(parallaxRateX)) ? parseFloat(parallaxRateX) : 0;
        const parallaxRateYValue : number = !isNaN(parseFloat(parallaxRateY)) ? parseFloat(parallaxRateY) : 0;
        const parallaxBackgroundWidth : number = parallaxBackgroundItems[a].clientWidth > 0 ? parallaxBackgroundItems[a].clientWidth : 1; //px
        const parallaxBackgroundHeight : number = parallaxBackgroundItems[a].clientHeight > 0 ? parallaxBackgroundItems[a].clientHeight : 1; //px
        const alteredWidth : number = Math.abs((window.innerWidth / parallaxBackgroundWidth) * parallaxRateXValue * 100) + 100; //%
        const alteredHeight : number = Math.abs((window.innerHeight / parallaxBackgroundHeight) * parallaxRateYValue * 100) + 100; //%

        parallaxBackgroundItems[a].style.width = alteredWidth + "%";
        parallaxBackgroundItems[a].style.height = alteredHeight + "%";
        parallaxBackgroundItems[a].classList.add("parallaxSet");
    }

    return;
}
const manageParallaxBackground : () => void = () => {
    const parallaxBackgroundElements : any = document.getElementsByClassName("hasParallaxBackground");

    for (var a = 0; a < parallaxBackgroundElements.length; a++) {
        const elementIsInViewport : boolean = getElementIsInViewportY(parallaxBackgroundElements[a]);

        if (!elementIsInViewport) { continue; }
        
        const parallaxBackgroundItems : any = parallaxBackgroundElements[a].getElementsByClassName("parallaxBackgroundItem");

        for (var b = 0; b < parallaxBackgroundItems.length; b++) {
            setBackgroundElementParallax(parallaxBackgroundItems[b]);
        }   
    }

    return;
}
window.addEventListener("load", () => { setParallaxBackgroundHeights(); });
window.addEventListener("scroll", () => { manageParallaxBackground(); });