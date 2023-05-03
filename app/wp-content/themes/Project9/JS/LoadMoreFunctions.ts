//Load More Functions
const setLoadMoreResultsHeight : (loadMoreFeed : HTMLElement) => void = (loadMoreFeed) => {
    if (!loadMoreFeed) { return; }

    const loadMoreOuter : any = loadMoreFeed.getElementsByClassName("outer")[0];
    const loadMoreInner : any = loadMoreFeed.getElementsByClassName("inner")[0];

    if (!loadMoreInner || !loadMoreOuter) { return; }

    loadMoreOuter.style.height = loadMoreInner.clientHeight + "px";

    return;
}
const setLoadMoreFeedostOffset : (loadMoreFeed : HTMLElement) => void = (loadMoreFeed) => {
    if (!loadMoreFeed) { return; }

    const items : any = loadMoreFeed.getElementsByClassName("item");

    loadMoreFeed.setAttribute("data-load-more-post-offset", items.length);

    return;
}

const handleLoadMoreResultsSuccess : (response : any, loadMoreFeed : HTMLElement) => void = (response, loadMoreFeed) => {
    if (!loadMoreFeed) { return; }

    const loadMoreInner : any = loadMoreFeed.getElementsByClassName("inner")[0];

    if (!loadMoreInner) { return; }

    const jsonResponse : any = JSON.parse(response);

    if (jsonResponse.allPostsDispalyed) { loadMoreFeed.classList.add("end"); }

    loadMoreInner.innerHTML = loadMoreInner.innerHTML + jsonResponse.content;
    loadMoreFeed.classList.remove("loading");
    loadMoreFeed.classList.add("set");

    setLoadMoreResultsHeight(loadMoreFeed);
    setLoadMoreFeedostOffset(loadMoreFeed);

    return;
}
const handleLoadMoreResultsError : (response : any, loadMoreFeed : HTMLElement) => void = (response, loadMoreFeed) => {
    if (!loadMoreFeed) { return; }
    

    return;
}

const getLoadMoreResults : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const loadMoreFeed : any = eventTarget.closest(".LoadMoreFeed");
    const loadMoreInner : any = document.getElementsByClassName("inner")[0];

    if (!loadMoreFeed || !loadMoreInner) { return; }

    const postType : string = loadMoreFeed.getAttribute("data-load-more-post-type") || "any";
    const postsPerPage : string = loadMoreFeed.getAttribute("data-load-more-posts-per-page") || "";
    const postOffest : string = loadMoreFeed.getAttribute("data-load-more-post-offset") || "";
    const postsPerPageValue : number = !isNaN(parseInt(postsPerPage)) ? parseInt(postsPerPage) : 9;
    const postOffestValue : number = !isNaN(parseInt(postOffest)) ? parseInt(postOffest) : 0;
    const searchValue : string = loadMoreFeed.getAttribute("data-load-more-search-value") || "";
    const loadMoreData : any = {
        action       : "getLoadMoreResults",
        postType     : postType,
        postsPerPage : postsPerPageValue,
        postOffset   : postOffestValue,
        searchValue  : searchValue
    };

    loadMoreFeed.classList.remove("set");
    loadMoreFeed.classList.add("loading");

    setLoadMoreResultsHeight(loadMoreFeed);

    $.ajax({
        type     : 'GET',
        url      : '/wp-admin/admin-ajax.php',
        dataType : 'html',
        data     : loadMoreData,

        success : (response : any) => {
            handleLoadMoreResultsSuccess(response, loadMoreFeed);
        },

        error : (response : any) => {
            handleLoadMoreResultsError(response, loadMoreFeed);
        }
    });
}