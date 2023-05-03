//Search Bar Functions
const setSearchResultsHeight : (searchBar : HTMLElement) => void = (searchBar) => {
    const searchResults : any = searchBar.getElementsByClassName("searchResults")[0];

    if (!searchResults) { return; }

    const searchResultsInner : any = searchResults.getElementsByClassName("inner")[0];

    if (!searchResultsInner) { return; }

    searchResults.style.height = searchResultsInner.clientHeight + "px";

    return;
}
const setSeachParameters : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const searchBar : any = eventTarget.closest(".SearchBar");
    const searchInput : any = document.getElementById("search-value");
    const postPermalinkContianer : any = document.getElementById("search-postPermalink");
    const itemPermalink : string = eventTarget.getAttribute("data-search-result-permalink") ; "";
    const searchResults : any = document.getElementById("search-results");

    if (!searchBar || !searchInput || !postPermalinkContianer || !itemPermalink || !searchResults) { return; }

    searchInput.value = eventTarget.innerText;
    postPermalinkContianer.value = itemPermalink;
    searchResults.innerHTML = null;
    searchBar.classList.remove("set");
    searchBar.classList.remove("loading");

    setSearchResultsHeight(searchBar);

    return; 
}

const handleSearchResultsSuccess : (response : any) => void = (response) => {
    const searchResults : any = document.getElementById("search-results");

    if (!searchResults) { return; }

    const searchBar : any = searchResults.closest(".SearchBar");

    if (!searchBar) { return; }
    
    if (!response) { response = "<div class='noResults'><p class='color-white'>No results found.</p></div>"; }

    searchResults.innerHTML = response;
    searchBar.classList.remove("loading");
    searchBar.classList.add("set");

    setSearchResultsHeight(searchBar);

    return;
}
const handleSearchResultsError : (response : any) => void = (response) => {

    return;
}
const handleSearchSubmission : () => void = () => {
    event.preventDefault();

    const eventTarget : any = event.currentTarget || event.target;
    const postPermalinkContianer : any = document.getElementById("search-postPermalink");

    if (!eventTarget || !postPermalinkContianer) { return; }

    if (postPermalinkContianer.value) { window.location.assign(postPermalinkContianer.value); return; }

    eventTarget.submit();

    return;
}

const clearSeachParameters : (searchBar : HTMLElement) => void = (searchBar) => {
    const postPermalinkContianer : any = document.getElementById("search-postPermalink");

    if (!searchBar || !postPermalinkContianer) { return; }

    postPermalinkContianer.value = null;

    return; 
}

const getSearchResults : () => void = () => {
    const eventTarget : any = event.currentTarget || event.target;

    if (!eventTarget) { return; }

    const searchBar : any = eventTarget.closest(".SearchBar");
    const searchResults : any = document.getElementById("search-results");

    if (!searchBar || !searchResults) { return; }

    const postType : string = searchBar.getAttribute("data-search-post-type") ? searchBar.getAttribute("data-search-post-type") : "any";
    const postsPerPage : string = searchBar.getAttribute("data-search-post-count") || "";
    const postsPerPageValue : number = !isNaN(parseInt(postsPerPage)) ? parseInt(postsPerPage) : 3;
    const searchValue : string = eventTarget.value || "";
    const searchData : any = {
        action       : "getSearchResults",
        postType     : postType,
        postsPerPage : postsPerPageValue,
        postSearch   : searchValue
    };

    searchResults.innerHTML = null;
    searchBar.classList.remove("set");
    searchBar.classList.add("loading");

    setSearchResultsHeight(searchBar);
    clearSeachParameters(searchBar);

    $.ajax({
        type     : 'GET',
        url      : '/wp-admin/admin-ajax.php',
        dataType : 'html',
        data     : searchData,

        success : (response : any) => {
            handleSearchResultsSuccess(response);
        },

        error : (response : any) => {
            handleSearchResultsError(response);
        }
    });
}