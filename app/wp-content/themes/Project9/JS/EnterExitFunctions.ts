// Enter Exit Functions
const setEnterExitOffsets : () => void = () => {
    const enterExitItems : any = document.getElementsByClassName("enterExitItem");

    for (var a = 0; a < enterExitItems.length; a++) {
        const enterExitOffsetX : string = enterExitItems[a].getAttribute("data-enter-exit-offset-x") || "";
        const enterExitOffsetY : string = enterExitItems[a].getAttribute("data-enter-exit-offset-y") || "";
        const enterExitOffsetXValue = !isNaN(parseFloat(enterExitOffsetX)) ? parseFloat(enterExitOffsetX) : 0; //px
        const enterExitOffsetYValue = !isNaN(parseFloat(enterExitOffsetY)) ? parseFloat(enterExitOffsetY) : 0; //px
        const elementIsAboveFold : boolean = getElementIsAboveFold(enterExitItems[a]);
        const defaultDelay : number = elementIsAboveFold ? 500 : 0; //ms
        const enterExitDelay : string = enterExitItems[a].getAttribute("data-enter-exit-delay") || "";
        const enterExitDelayValue : number = !isNaN(parseFloat(enterExitDelay)) ? defaultDelay + parseFloat(enterExitDelay) : defaultDelay; //ms

        enterExitItems[a].style.transform = "translate(" + enterExitOffsetXValue + "px, " + enterExitOffsetYValue + "px)";
        enterExitItems[a].classList.add("enterExitSet");

        setTimeout(setElementEnterExit, enterExitDelayValue, enterExitItems[a]);
    }  

    return;            
}
const manageEnterExit : () => void = () => {
    const enterExitParents : any = document.getElementsByClassName("hasEnterExit");

    for (var a = 0; a < enterExitParents.length; a++) {
        const elementIsInViewport : boolean = getElementIsInViewportY(enterExitParents[a]);
        
        if (!elementIsInViewport) { continue; }

        const enterExitItems : any = enterExitParents[a].getElementsByClassName("enterExitItem");

        for (var b = 0; b < enterExitItems.length; b++) {
            
            setElementEnterExit(enterExitItems[b]);
        }
    }

    return;
}
window.addEventListener("load", () => { setEnterExitOffsets(); });
window.addEventListener("scroll", () => { manageEnterExit(); });