//Search Bar Functions
var setSearchResultsHeight = function (searchBar) {
    var searchResults = searchBar.getElementsByClassName("searchResults")[0];
    if (!searchResults) {
        return;
    }
    var searchResultsInner = searchResults.getElementsByClassName("inner")[0];
    if (!searchResultsInner) {
        return;
    }
    searchResults.style.height = searchResultsInner.clientHeight + "px";
    return;
};
var setSeachParameters = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var searchBar = eventTarget.closest(".SearchBar");
    var searchInput = document.getElementById("search-value");
    var postPermalinkContianer = document.getElementById("search-postPermalink");
    var itemPermalink = eventTarget.getAttribute("data-search-result-permalink");
    "";
    var searchResults = document.getElementById("search-results");
    if (!searchBar || !searchInput || !postPermalinkContianer || !itemPermalink || !searchResults) {
        return;
    }
    searchInput.value = eventTarget.innerText;
    postPermalinkContianer.value = itemPermalink;
    searchResults.innerHTML = null;
    searchBar.classList.remove("set");
    searchBar.classList.remove("loading");
    setSearchResultsHeight(searchBar);
    return;
};
var handleSearchResultsSuccess = function (response) {
    var searchResults = document.getElementById("search-results");
    if (!searchResults) {
        return;
    }
    var searchBar = searchResults.closest(".SearchBar");
    if (!searchBar) {
        return;
    }
    if (!response) {
        response = "<div class='noResults'><p class='color-white'>No results found.</p></div>";
    }
    searchResults.innerHTML = response;
    searchBar.classList.remove("loading");
    searchBar.classList.add("set");
    setSearchResultsHeight(searchBar);
    return;
};
var handleSearchResultsError = function (response) {
    return;
};
var handleSearchSubmission = function () {
    event.preventDefault();
    var eventTarget = event.currentTarget || event.target;
    var postPermalinkContianer = document.getElementById("search-postPermalink");
    if (!eventTarget || !postPermalinkContianer) {
        return;
    }
    if (postPermalinkContianer.value) {
        window.location.assign(postPermalinkContianer.value);
        return;
    }
    eventTarget.submit();
    return;
};
var clearSeachParameters = function (searchBar) {
    var postPermalinkContianer = document.getElementById("search-postPermalink");
    if (!searchBar || !postPermalinkContianer) {
        return;
    }
    postPermalinkContianer.value = null;
    return;
};
var getSearchResults = function () {
    var eventTarget = event.currentTarget || event.target;
    if (!eventTarget) {
        return;
    }
    var searchBar = eventTarget.closest(".SearchBar");
    var searchResults = document.getElementById("search-results");
    if (!searchBar || !searchResults) {
        return;
    }
    var postType = searchBar.getAttribute("data-search-post-type") ? searchBar.getAttribute("data-search-post-type") : "any";
    var postsPerPage = searchBar.getAttribute("data-search-post-count") || "";
    var postsPerPageValue = !isNaN(parseInt(postsPerPage)) ? parseInt(postsPerPage) : 3;
    var searchValue = eventTarget.value || "";
    var searchData = {
        action: "getSearchResults",
        postType: postType,
        postsPerPage: postsPerPageValue,
        postSearch: searchValue
    };
    searchResults.innerHTML = null;
    searchBar.classList.remove("set");
    searchBar.classList.add("loading");
    setSearchResultsHeight(searchBar);
    clearSeachParameters(searchBar);
    $.ajax({
        type: 'GET',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: searchData,
        success: function (response) {
            handleSearchResultsSuccess(response);
        },
        error: function (response) {
            handleSearchResultsError(response);
        }
    });
};

//# sourceMappingURL=SearchBarFunctions.js.map
