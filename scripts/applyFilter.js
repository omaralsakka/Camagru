
function applyFilter(filterClass){

    switch (filterClass){
        case "frame":
            filterDisplayed.style.width = "640px";
            filterDisplayed.style.height = "480px";
            break;
        case "filterTopRight":
            filterDisplayed.style.alignSelf = "flex-start";
            filterDisplayed.style.width = "320px";
            filterDisplayed.style.height = "240px";
            filterDisplayed.style.margin = "0 0 0 auto";
            break;
        case "filterTopCenter":
            filterDisplayed.style.alignSelf = "flex-start";
            filterDisplayed.style.width = "320px";
            filterDisplayed.style.height = "240px";
            filterDisplayed.style.margin = "-5% auto 100% auto";
            break;
        case "filterBottomCenter":
            filterDisplayed.style.alignSelf = "flex-end";
            filterDisplayed.style.width = "320px";
            filterDisplayed.style.height = "240px";
            filterDisplayed.style.margin = "100% auto 0 auto"; 
            // filterDisplayed.style.margin = "100% auto -5% auto";
            break;
        case "filterBottomRight":
            filterDisplayed.style.alignSelf = "flex-end";
            filterDisplayed.style.width = "320px";
            filterDisplayed.style.height = "240px";
            filterDisplayed.style.margin = "0 0 0 auto";
            break;
    }
}