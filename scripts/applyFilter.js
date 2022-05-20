
function applyFilter(filterClass){

    switch (filterClass){
        case "frame":
            filterDisplayed.style.width = "33.3vw";
            filterDisplayed.style.height = "49.8vh";
            break;
        case "filterTopRight":
            filterDisplayed.style.alignSelf = "flex-start";
            filterDisplayed.style.width = "16.66vw";
            filterDisplayed.style.height = "24.92vh";
            filterDisplayed.style.margin = "0 0 0 auto";
            break;
        case "filterTopCenter":
            filterDisplayed.style.alignSelf = "flex-start";
            filterDisplayed.style.width = "16.66vw";
            filterDisplayed.style.height = "24.92vh";
            filterDisplayed.style.margin = "-5% auto 100% auto";
            break;
        case "filterBottomCenter":
            filterDisplayed.style.alignSelf = "flex-end";
            filterDisplayed.style.width = "16.66vw";
            filterDisplayed.style.height = "24.92vh";
            filterDisplayed.style.margin = "100% auto 0 auto"; 
            // filterDisplayed.style.margin = "100% auto -5% auto";
            break;
        case "filterBottomRight":
            filterDisplayed.style.alignSelf = "flex-end";
            filterDisplayed.style.width = "16.66vw";
            filterDisplayed.style.height = "24.92vh";
            filterDisplayed.style.margin = "0 0 0 auto";
            break;
    }
}