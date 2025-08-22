function adminContestTypes() {
    const category = document.getElementById("contest-category").value;
    const typeSelect = document.getElementById("contest-type");

    // Reset contest type dropdown
    typeSelect.innerHTML =
        '<option value="" selected disabled>-- Select Contest Type --</option>';

    let types = [];

    switch (category) {
        case "Singing Contest":
        case "Dance Contest":
        case "Talent Show":
        case "Battle of the Bands":
            types = ["Solo", "Duo", "Group"];
            break;
        case "Pageant":
        case "Mr. & Ms. Contest":
        case "Modeling Contest":
        case "Spoken Word / Poetry":
            types = ["Individual"];
            break;
        case "Quiz Bee":
        case "Debate":
            types = ["Individual", "Team"];
            break;
        case "Essay Writing":
        case "Poster Making":
        case "Drawing Contest":
        case "Photography Contest":
        case "Cooking Contest":
            types = ["Individual"];
            break;
        case "Cosplay Competition":
            types = ["Solo", "Group"];
            break;
    }

    // Populate contest type options
    types.forEach(function (type) {
        const option = document.createElement("option");
        option.value = type;
        option.textContent = type;
        typeSelect.appendChild(option);
    });
}
