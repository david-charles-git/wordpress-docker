//Load More Functions
var setLoadMoreResultsHeight = function (loadMoreFeed) {
    if (!loadMoreFeed) {
        return;
    }
    var loadMoreOuter = loadMoreFeed.getElementsByClassName("outer")[0];
    var loadMoreInner = loadMoreFeed.getElementsByClassName("inner")[0];
    if (!loadMoreInner || !loadMoreOuter) {
        return;
    }
    loadMoreOuter.style.height = loadMoreInner.clientHeight + "px";
    return;
};
var setLoadMoreFeedostOffset = function (loadMoreFeed) {
    if (!loadMoreFeed) {
        return;
    }
    var items = loadMoreFeed.getElementsByClassName("item");
    loadMoreFeed.setAttribute("data-load-more-post-offset", items.length);
    return;
};
var handleLoadMoreResultsSuccess = function (response, loadMoreFeed) {
    if (!loadMoreFeed) {
        return;
    }
    var loadMoreInner = loadMoreFeed.getElementsByClassName("inner")[0];
    if (!loadMoreInner) {
        return;
    }
    var jsonResponse = JSON.parse(response);
    if (jsonResponse.allPostsDispalyed) {
        loadMoreFeed.classList.add("end");
    }
    loadMoreInner.innerHTML = loadMoreInner.innerHTML + jsonResponse.content;
    loadMoreFeed.classList.remove("loading");
    loadMoreFeed.classList.add("set");
    setLoadMoreResultsHeight(loadMoreFeed);
    setLoadMoreFeedostOffset(loadMoreFeed);
    return;
};
var handleLoadMoreResultsError = function (response, loadMoreFeed) {
    if (!loadMoreFeed) {
        return;
    }
    return;
};
var getLoadMoreResults = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var loadMoreFeed = eventTarget.closest(".LoadMoreFeed");
    var loadMoreInner = document.getElementsByClassName("inner")[0];
    if (!loadMoreFeed || !loadMoreInner) {
        return;
    }
    var postType = loadMoreFeed.getAttribute("data-load-more-post-type") || "any";
    var postsPerPage = loadMoreFeed.getAttribute("data-load-more-posts-per-page") || "";
    var postOffest = loadMoreFeed.getAttribute("data-load-more-post-offset") || "";
    var postsPerPageValue = !isNaN(parseInt(postsPerPage)) ? parseInt(postsPerPage) : 9;
    var postOffestValue = !isNaN(parseInt(postOffest)) ? parseInt(postOffest) : 0;
    var searchValue = loadMoreFeed.getAttribute("data-load-more-search-value") || "";
    var loadMoreData = {
        action: "getLoadMoreResults",
        postType: postType,
        postsPerPage: postsPerPageValue,
        postOffset: postOffestValue,
        searchValue: searchValue
    };
    loadMoreFeed.classList.remove("set");
    loadMoreFeed.classList.add("loading");
    setLoadMoreResultsHeight(loadMoreFeed);
    $.ajax({
        type: 'GET',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: loadMoreData,
        success: function (response) {
            handleLoadMoreResultsSuccess(response, loadMoreFeed);
        },
        error: function (response) {
            handleLoadMoreResultsError(response, loadMoreFeed);
        }
    });
};

//# sourceMappingURL=LoadMoreFunctions.js.map
