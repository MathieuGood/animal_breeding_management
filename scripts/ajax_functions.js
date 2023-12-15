
// Set all the search parameters (filter and sort) stored in SESSION to default
function resetSearchParameters() {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            sort: 'id_animal DESC',
            breed_filter: '',
            sex_filter: '',
            name_filter: '',
            current_page: '1',
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
            name_filter_input.value = ""
        }
    });
}

// Create a random animal and then update animal list
function createRandomAnimalsAndUpdateList(number) {
    $.ajax({
        type: "POST",
        url: "components/create_random_animal.php",
        data: {
            amount_to_create: number,
        },
        // If the ajax query returns a success, update the table
        success: resetSearchParameters()
    });
}


// Sort animal list
function sortAnimalList(type) {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            sort: type,
            current_page: '1',
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
            trigger_listener = true
        }
    });
}


// Filter animal list by name
function filterAnimalListByName(type) {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            name_filter: type,
            current_page: '1',
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
        }
    });
}


// Filter animal list by breed
function filterAnimalListByBreed(type) {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            breed_filter: type,
            current_page: '1',
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
        }
    });
}


// Filter animal list by sex
function filterAnimalListBySex(type) {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            sex_filter: type,
            current_page: '1',
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
        }
    });
}


// Navigate to input current_page number
function pageAnimalList(page_number) {
    $.ajax({
        type: "POST",
        url: "components/update_animal_list.php",
        data: {
            current_page: page_number,
        },
        // If the ajax query returns a success, update the table
        success: function (data) {
            let animal_list_table = document.getElementById("animal_list");
            animal_list_table.innerHTML = data;
        }
    });
}


        // Creating new animal from custom mating
        function createNewAnimal(id_breed, id_father, id_mother, origin_type) {
            $.ajax({
                type: "POST",
                url: "components/create_new_animal.php",
                data: {
                    id_breed: id_breed,
                    id_father: id_father,
                    id_mother: id_mother,
                    origin: origin_type
                },
                // If the ajax query returns a success, display pop-up
                // and remove the content in the background
                success: function (data) {

                    let new_animal_popup = document.getElementById("new_animal_popup");
                    new_animal_popup.innerHTML = data;

                    let main_content = document.getElementById("main-content")
                    main_content.remove()
                }
            });
        }


        // Update the <select> with compatible partners for mating (matching breed)
        function updateCompatiblePartners(id_breed) {
            $.ajax({
                type: "POST",
                url: "components/update_compatible_partners.php",
                data: {
                    breed: id_breed,
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let compatible_partners = document.getElementById("select_animals_to_breed")
                    compatible_partners.innerHTML = data
                }
            });
        }