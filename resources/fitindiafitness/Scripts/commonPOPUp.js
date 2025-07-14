function showbus(divId, ImageId) {
    if (document.getElementById(divId).style.display == "none") {
        document.getElementById(divId).style.display = "block";
        document.getElementById(ImageId).setAttribute("src", "images/arrow_17.gif");
        document.getElementById("<%=hf.ClientID %>").value = divId;
    }
    else {
        document.getElementById(divId).style.display = "none";
        document.getElementById(ImageId).setAttribute("src", "images/arrow_18.gif");
    }
}
function ShowPopUp() {
    document.getElementById("ctl00_ContentPlaceHolder1_divInner").style.display = "block";
    document.getElementById("ctl00_ContentPlaceHolder1_divOuter").style.display = "block";
}
function ClosePopUp() {
    document.getElementById("ctl00_ContentPlaceHolder1_divInner").style.display = "none"; 
document.getElementById("ctl00_ContentPlaceHolder1_divOuter").style.display = "none";
}
function ClosePopUpM() {
    document.getElementById("ctl00_divInner").style.display = "none";
    document.getElementById("ctl00_divOuter").style.display = "none";
}