
function applyFilter(filterClass){

    switch (filterClass){
        case "frame":
            filterImg.style.width = "640px";
            filterImg.style.height = "480px";
            break;
        case "filterTopRight":
            filterImg.style.alignSelf = "flex-start";
            filterImg.style.width = "320px";
            filterImg.style.height = "240px";
            filterImg.style.margin = "0 0 0 auto";
            break;
        case "filterTopCenter":
            filterImg.style.alignSelf = "flex-start";
            filterImg.style.width = "320px";
            filterImg.style.height = "240px";
            filterImg.style.margin = "-5% auto 100% auto";
            break;
        case "filterBottomCenter":
            filterImg.style.alignSelf = "flex-end";
            filterImg.style.width = "320px";
            filterImg.style.height = "240px";
            filterImg.style.margin = "100% auto 0 auto"; 
            // filterImg.style.margin = "100% auto -5% auto";
            break;
        case "filterBottomRight":
            filterImg.style.alignSelf = "flex-end";
            filterImg.style.width = "320px";
            filterImg.style.height = "240px";
            filterImg.style.margin = "0 0 0 auto";
            break;
    }
}