// When the page loads, execute sortAnimalList() with 'animal_id DESC' as default parameter 
window.onload = function () {
    resetSearchParameters();
}


// Name search filter
var name_filter_input = document.getElementById("name_filter")
name_filter_input.addEventListener("keyup", () => {
    filterAnimalListByName(name_filter_input.value)
})
