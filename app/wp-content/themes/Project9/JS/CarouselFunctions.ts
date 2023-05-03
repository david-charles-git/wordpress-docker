// Carousel Functions
const setCarouselGridGap : () => void = () => {
    const carousels : any = document.getElementsByClassName("Carousel");
    
    for (var a = 0; a < carousels.length; a++) {
        const carouselInner : HTMLElement | null = carousels[a].getElementsByClassName("inner")[0] || null;
        const gridGap : string = carousels[a].getAttribute("data-carousel-grid-gap") || "";
        const gridGapValue : number = !isNaN(parseFloat(gridGap)) ? parseFloat(gridGap) : 0; //px
        
        if (!carouselInner) { continue; }

        carouselInner.style.gridGap = gridGapValue + "px";

        continue;
    }

    return;
}
const setCarouselItemsMaxWidth : () => void = () => {
    const carousels : any = document.getElementsByClassName("Carousel");

    for (var a : number = 0; a < carousels.length; a++) {
        const itemMaxWidth : string = carousels[a].getAttribute("data-carousel-item-max-width") || "";
        const itemMaxWidthValue : number = !isNaN(parseFloat(itemMaxWidth)) ? parseFloat(itemMaxWidth) : 400; //px
        const carouselItems : any = carousels[a].getElementsByClassName("item");

        for (var b : number = 0; b < carouselItems.length; b++) {
            carouselItems[b].style.maxWidth = itemMaxWidthValue + "px";
        }

        carousels[a].classList.add("carouselSet");
    }

    return;
}
const setCarouselInitialShownItems : () => void = () => {
    const carousels : any = document.getElementsByClassName("Carousel");

    for (var a= 0; a < carousels.length; a++) {
        setCarouselShownItems(carousels[a]);
    }
    
    return;
}
const setCarouselShownItems : (carousel : HTMLElement) => void = (carousel) => {
    const carouselMaxWidth : string = carousel.getAttribute("data-carousel-max-width") || "";
    var carouselMaxWidthValue : number = !isNaN(parseFloat(carouselMaxWidth)) ? parseFloat(carouselMaxWidth) : 0; //px
    
    if (carouselMaxWidthValue > window.innerWidth) { carouselMaxWidthValue = window.innerWidth; }

    const activeItem : any = carousel.getElementsByClassName("item active")[0] || null;
    
    if (!activeItem) { return; }

    const activeItemCoordinates : elementCoordinates = getElementCoordinates(activeItem);
    
    if (!activeItemCoordinates) { return; }

    const items : any = carousel.getElementsByClassName("item");

    for (var a = 0; a < items.length; a++) {
        if (items[a] == activeItem) { continue; }

        const itemCoordinates : elementCoordinates = getElementCoordinates(items[a]);

        if (!itemCoordinates) { continue; }

        if (itemCoordinates.right < activeItemCoordinates.left) { items[a].classList.remove("showing"); continue; }
        
        if (itemCoordinates.right > carouselMaxWidthValue + activeItemCoordinates.left) { items[a].classList.remove("showing"); continue; }

        items[a].classList.add("showing");
    }

    return;
}

const handleCarouselButtonClick : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const carousel : any = eventTarget.closest(".Carousel");

    if (!carousel) { return; }

    const isLeftButton : boolean = eventTarget.classList.contains("left");
    const isRightButton : boolean = eventTarget.classList.contains("right");

    if (isLeftButton) { shiftCarouselLeft(eventTarget); }

    if (isRightButton) { shiftCarouselRight(eventTarget); }

    stopCarouselAutoShift(carousel);

    return;
}
const handleCarouselNavigationTabClick : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const carousel : any = eventTarget.closest(".Carousel");

    if (!carousel) { return; }

    const tabIndex : string = eventTarget.getAttribute("data-id") || "";
    const tabIndexValue : number = !isNaN(parseInt(tabIndex)) ? parseInt(tabIndex) : 0;

    shiftCarouselToFrame(carousel, tabIndexValue);
    stopCarouselAutoShift(carousel);

    return;
}
const handleCarouselTouchStart : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const carousel : any = eventTarget.closest(".Carousel");

    if (!carousel) { return; }

    const touchX : number = event.touches[0].clientX || 0; //px

    stopCarouselAutoShift(carousel);

    globalCarouselTouchX = touchX;

    return;
}
const handleCarouselTouchEnd : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;
    
    if (!eventTarget) { return; }

    const touchX : number = event.changedTouches[0].clientX || 0; //px
    
    if (globalCarouselTouchX > touchX) { shiftCarouselRight(eventTarget); }
    
    if (globalCarouselTouchX < touchX) { shiftCarouselLeft(eventTarget); }

    globalCarouselTouchX = 0; //px

    return;
}
const handleAutoShiftCarousels : () => void = () => {
    const carousels : any = document.getElementsByClassName("Carousel");

    for (var a = 0; a < carousels.length; a++) {
        const autoShift : string = carousels[a].getAttribute("data-carousel-auto-scroll");
        const carouselInner : any = carousels[a].getElementsByClassName("inner")[0];

        if (autoShift == "true" && carouselInner) { shiftCarouselRight(carouselInner); }
    }

    return;
}
const handleCarouselOnResize : () => void = () => {
    const carousels : any = document.getElementsByClassName("Carousel");

    for (var a : number = 0; a < carousels.length; a++) {
        shiftCarouselToFrame(carousels[a], 0);
        stopCarouselAutoShift(carousels[a]);
        setCarouselShownItems(carousels[a]);
    }

    return;
}

const shiftCarouselLeft : (element : HTMLElement) => void = (element) => {
    if (!element) { return; }

    const carousel : any = element.closest(".Carousel");

    if (!carousel) { return; }

    const carsouselItems : any = carousel.getElementsByClassName("item");

    for (var a : number = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) {
            const newIndex : number = a - 1 < 0 ? carsouselItems.length - 1 : a - 1;

            shiftCarouselToFrame(carousel, newIndex);

            return;
        }
    }

    return;
}
const shiftCarouselRight : (element : HTMLElement) => void = (element) => {
    if (!element) { return; }

    const carousel : any = element.closest(".Carousel");

    if (!carousel) { return; }

    const carsouselItems : any = carousel.getElementsByClassName("item");

    for (var a : number = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) {
            const newIndex : number = a + 1 >= carsouselItems.length ? 0 : a + 1;

            shiftCarouselToFrame(carousel, newIndex);

            return;
        }
    }

    return;
}
const shiftCarouselToFrame : (carousel : HTMLElement, frame : number) => void = (carousel, frame) => {
    if (!carousel) { return; }

    frame = frame || 0;

    const carouselInner : any = carousel.getElementsByClassName("inner")[0];

    if (!carouselInner) { return; }

    var carouselItemWidth : number = 0; //px
    const carouselGridGap : string = carousel.getAttribute("data-carousel-grid-gap") || "";
    const carouselGridGapValue : number = !isNaN(parseFloat(carouselGridGap)) ? parseFloat(carouselGridGap) : 0; //px
    const carsouselItems : any = carousel.getElementsByClassName("item");
    const tabItems : any = carousel.getElementsByClassName("tab");

    for (var a = 0; a < carsouselItems.length; a++) {
        if (carsouselItems[a].classList.contains("active")) { carouselItemWidth = carsouselItems[a].clientWidth + carouselGridGapValue; /*px*/ }
        
        carsouselItems[a].classList.remove("active");
    }

    for (var a = 0; a < tabItems.length; a++) {
        tabItems[a].classList.remove("active");
    }

    const transformXValue : number = (-1) * frame * carouselItemWidth; //px

    carouselInner.style.transform = "translateX(" + transformXValue + "px)";
    carsouselItems[frame].classList.add("active");
    tabItems[frame].classList.add("active");

    setCarouselShownItems(carousel);

    const leftButton : any = carousel.getElementsByClassName("carouselButton left")[0];

    if (!leftButton) { return; }

    if (frame == 0) { leftButton.classList.remove("active"); return; }

    leftButton.classList.add("active");

    return;
}

const stopCarouselAutoShift : (carousel : HTMLElement) => void = (carousel) => {
    carousel.setAttribute("data-carousel-auto-scroll", "false");

    return;
}

var globalCarouselTouchX : number = 0; //px
const carouselAutoShiftIntervalTime : number = 5000; //ms
const carouselAutoShiftInterval : number = setInterval(handleAutoShiftCarousels, carouselAutoShiftIntervalTime);

window.addEventListener("load", () => { setCarouselGridGap(); setCarouselItemsMaxWidth(); setCarouselInitialShownItems(); });
window.addEventListener("resize", () => { handleCarouselOnResize(); });