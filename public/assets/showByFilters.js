function showByFilters() {
    let checkBoxes = document.getElementsByClassName('myCheckbox')
    let currentParameters = ""
    let myType = document.getElementById('myType').textContent.substr(4)
    let url = ""
    console.log(myType)
    for (var i = 0; i < checkBoxes.length; i++) {
        checkBoxes[i].addEventListener("click", function() {
            for (var j = 0; j < checkBoxes.length; j++) {
                if(checkBoxes[j].checked == true) {
                    currentParameters += checkBoxes[j].id + "+"
                }
            }
            console.log(url)
            url = "/show/" + myType + "/" + currentParameters.substr(0, currentParameters.length-1);
            window.location.replace(url)
        })
     }
}
window.onload = showByFilters;