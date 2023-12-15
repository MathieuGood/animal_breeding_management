window.onload = function () {
    updateCompatiblePartners('');
}

let select_breed = document.getElementById('select_breed')
let select_male = document.getElementById('select_male')
let select_female = document.getElementById('select_female')
let start_mating = document.getElementById('start_mating')


// Event listener on breed selection
select_breed.addEventListener('change', () => {

    if (select_breed.value != 'Select breed') {
        updateCompatiblePartners(select_breed.value)
        // Make male and female select enabled if breed chosen
        select_male.disabled = false
        select_female.disabled = false

    } else {
        updateCompatiblePartners('')
        // Make male and female select disabled if no breed chosen
        select_male.disabled = true
        select_female.disabled = true
    }
})


// When button clicked
start_mating.addEventListener('click', () => {

    // Get values breed, male and female from select
    let breed = document.getElementById('select_breed').value
    let male = document.getElementById('select_male').value
    let female = document.getElementById('select_female').value

    // If there is a valid input for each id, create new animal
    if (breed > 0 && male > 0 && female > 0) {

        createNewAnimal(breed, male, female, 'breeding')

    } else {

        console.log('Data missing')
    }
})