
/* Read More Functions */
const handleReadMoreClick : (readMoreCopy : string, readLessCopy : string) => void = (readMoreCopy, readLessCopy) => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget || !readMoreCopy || !readLessCopy) { return; }

    const readMoreContainer : any = eventTarget.closest(".readMore");
    const openClose : string = eventTarget.getAttribute("data-openClose");

    if (!readMoreContainer || ( openClose !== "open" && openClose !== "close")) { return; }

    const readMoreContent : any = readMoreContainer.getElementsByTagName("P")[0];

    if (!readMoreContent) { return; }
    
    const newOpenClose : string = openClose === "open" ? "close" : "open";
    const readMoreContainerHeight : number = readMoreContainer.clientHeight; //px
    const timeoutDelayOne : number = 210; //ms
    const timeoutDelayTwo : number = 220; //ms
    
    readMoreContainer.style.height = readMoreContainerHeight + "px";            
    readMoreContainer.style.opacity = 0;
    eventTarget.setAttribute("data-openClose", newOpenClose);

    setTimeout(() => {
        const readMoreText : string = openClose === "open" ? readLessCopy : readMoreCopy;

        readMoreContainer.classList.toggle("active");
        eventTarget.innerText = readMoreText;
    }, timeoutDelayOne);

    setTimeout(() => {
        const readMoreContentHeight : number = readMoreContent.clientHeight; //px

        readMoreContainer.style.height = readMoreContentHeight + "px";
        readMoreContainer.style.opacity = null;
    }, timeoutDelayTwo);

    return;
}
const resetAllReadMores : () => void = () => {
    const readMoreContainers : any = document.getElementsByClassName("readMore");

    for (var a = 0; a < readMoreContainers.length; a++) {
        const readMoreCopy : string = readMoreContainers[a].getAttribute("data-readMoreCopy");
        const readMoreButton : any = readMoreContainers[a].getElementsByClassName("button")[0];

        if (!readMoreCopy || !readMoreButton) { continue; }

        readMoreContainers[a].classList.remove("active");
        readMoreContainers[a].style.height = null;
        readMoreButton.setAttribute("data-openClose", "open");
        readMoreButton.innerText = readMoreCopy;
    }

    return;
}
window.addEventListener("resize", () => { resetAllReadMores(); });