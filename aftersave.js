var unsaved = false;
var allow=4;
function unloadPage(){ 
    if(unsaved){
        return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
    }
}

window.onbeforeunload = unloadPage;