function updateContestTypes() {
    const category = document.getElementById("contest-category").value;
    const typeSelect = document.getElementById("contest-type");
    const container = document.getElementById("group-name-container");

    // Reset type select and container
    typeSelect.innerHTML =
        '<option value="" selected disabled>-- Select Contest Type --</option>';
    container.innerHTML = "";

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

    // Populate type select dropdown
    types.forEach(function (type) {
        const option = document.createElement("option");
        option.value = type;
        option.textContent = type;
        typeSelect.appendChild(option);
    });

    typeSelect.onchange = function () {
        renderTypeInput(typeSelect.value, container, ""); // empty suffix for default form
    };
}

function ContestTypes(id) {
    const category = document.getElementById("contest-category-" + id).value;
    const typeSelect = document.getElementById("contest-type-" + id);
    const container = document.getElementById("group-name-container-" + id);

    // Reset type select and container
    typeSelect.innerHTML =
        '<option value="" selected disabled>-- Select Contest Type --</option>';
    container.innerHTML = "";

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

    types.forEach(function (type) {
        const option = document.createElement("option");
        option.value = type;
        option.textContent = type;
        if (type === typeSelect.getAttribute("data-selected")) {
            option.selected = true;
        }
        typeSelect.appendChild(option);
    });

    // Trigger input rendering on load and on change
    renderTypeInput(typeSelect.value, container, id);

    typeSelect.onchange = function () {
        renderTypeInput(this.value, container, id);
    };
}

// Helper function to render Duo/Group input
function renderTypeInput(selected, container, id) {
    container.innerHTML = "";

    if (selected === "Duo") {
        const label = document.createElement("label");
        label.setAttribute("for", `duo-name-${id}`);
        label.className = "form-label";
        label.textContent = "Duo Name";

        const input = document.createElement("input");
        input.type = "text";
        input.name = "duo_name";
        input.id = `duo-name-${id}`;
        input.className = "form-control mt-2";
        input.placeholder = "e.g. John & Jane";

        container.appendChild(label);
        container.appendChild(input);
    } else if (selected === "Group" || selected === "Team") {
        const label = document.createElement("label");
        label.setAttribute("for", `group-name-${id}`);
        label.className = "form-label";
        label.textContent = "Enter Group/Team Name";

        const input = document.createElement("input");
        input.type = "text";
        input.name = "group_team";
        input.id = `group-name-${id}`;
        input.className = "form-control mt-2";
        input.placeholder = "e.g. Team Alpha";

        container.appendChild(label);
        container.appendChild(input);
    }
}

document.querySelectorAll("[id^=contest-type-]").forEach((el) => {
    const id = el.id.replace("contest-type-", "");
    ContestTypes(id);
});
