function showByFilters() {
	console.log("hey")
	let checkBoxes = document.getElementsByclass('myCheckbox')
	checkBoxes.forEach(function(element) {
		element.addEventListener("Click", function() {
			console.log("hey")
			checkBoxes.forEach(function(checkBox) {
				console.log("hey")
				if(element.checked == true);
				console.log("hey")
			})
		})
	})
}

