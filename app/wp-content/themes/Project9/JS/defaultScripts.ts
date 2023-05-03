/* Pop Up Functions */
const handleCloseLocalPopUp : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const localPopUp : any = eventTarget.closest(".popUp");

    if (!localPopUp) { return; }

    localPopUp.classList.remove("active");

    setTimeout(() => { localPopUp.style.display = "none"; }, 100);

    return;
}
const handleOpenPopUpByID : (elementID : string) => void = (elementID) => {
    if (!elementID) { return; }

    const targetPopUp : any = document.getElementById(elementID);

    if (!targetPopUp) { return; }

    targetPopUp.style.display = "block";

    setTimeout(() => { targetPopUp.classList.add("active"); }, 100);

    return;
}

/* Navigation Fucntions */
const goToSectionByID : (elementID : string) => void = (elementID) => {
    if (!elementID) { return; }

    const targetElement : any = document.getElementById(elementID);

    if (!targetElement) { return; }

    const elementCoordinates : elementCoordinates = getElementCoordinates(targetElement);

    window.scrollTo({
        top: elementCoordinates.top - 100,
        left: 0,
        behavior: "smooth"
    });

    return;
}
const goToPageTop : () => void = () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    });

    return;
}
const handleToPageTopButtonActiveToggle : () => void = () => {
    const toTopContainer : any = document.getElementById("toTop");
    const heroBanner : any = document.getElementsByClassName("HeroBanner")[0];

    if (!toTopContainer || !heroBanner) { return; }

    const heroBannerHeight : number = heroBanner.clientHeight; //px
    const windowScrollY : number = window.scrollY; //px

    if (windowScrollY > heroBannerHeight) {
        toTopContainer.style.display = "block";

        setTimeout(() => { toTopContainer.classList.add("active"); }, 200);

    } else {
        toTopContainer.classList.remove("active");

        setTimeout(() => { toTopContainer.style.display = "none"; }, 200);
    }

    return;
}
window.addEventListener("scroll", () => { handleToPageTopButtonActiveToggle(); });
