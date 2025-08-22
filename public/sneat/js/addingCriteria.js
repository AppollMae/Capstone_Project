let criteriaIndex = 1;

function addCriteriaField() {
    const wrapper = document.getElementById("criteria-wrapper");

    const group = document.createElement("div");
    group.className = "mb-3 criteria-group position-relative";
    group.setAttribute("data-index", criteriaIndex); // for identifying

    // Name label and input
    const nameLabel = document.createElement("label");
    nameLabel.className = "form-label";
    nameLabel.setAttribute("for", `criteria-name-${criteriaIndex}`);
    nameLabel.textContent = `Name of Criteria ${criteriaIndex + 1}`;

    const nameInput = document.createElement("input");
    nameInput.type = "text";
    nameInput.className = "form-control mb-2";
    nameInput.id = `criteria-name-${criteriaIndex}`;
    nameInput.name = "name[]";
    nameInput.placeholder = "e.g. Stage Presence";
    nameInput.required = true;

    // Percentage label and input
    const percentageLabel = document.createElement("label");
    percentageLabel.className = "form-label";
    percentageLabel.setAttribute("for", `criteria-percentage-${criteriaIndex}`);
    percentageLabel.textContent = "Percentage";

    const percentageInput = document.createElement("input");
    percentageInput.type = "number";
    percentageInput.className = "form-control percentage-input";
    percentageInput.id = `criteria-percentage-${criteriaIndex}`;
    percentageInput.name = "percentage[]";
    percentageInput.placeholder = "e.g. 20";
    percentageInput.min = 1;
    percentageInput.max = 100;
    percentageInput.required = true;

    percentageInput.addEventListener("input", calculateTotalPercentage);

    // Delete button
    const deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.className = "btn btn-sm btn-danger position-absolute";
    deleteBtn.style.top = "0";
    deleteBtn.style.right = "0";
    deleteBtn.textContent = "×";
    deleteBtn.title = "Remove this criteria";
    deleteBtn.onclick = function () {
        group.remove();
        calculateTotalPercentage();
    };

    group.appendChild(nameLabel);
    group.appendChild(nameInput);
    group.appendChild(percentageLabel);
    group.appendChild(percentageInput);
    group.appendChild(deleteBtn);

    wrapper.appendChild(group);
    criteriaIndex++;
    calculateTotalPercentage();
}

function calculateTotalPercentage() {
    const inputs = document.querySelectorAll(".percentage-input");
    let total = 0;

    inputs.forEach((input) => {
        const value = parseFloat(input.value);
        if (!isNaN(value)) {
            total += value;
        }
    });

    document.getElementById("total-percentage").value = total;
}

function clearCriteriaFields() {
    const wrapper = document.getElementById("criteria-wrapper");
    wrapper.innerHTML = "";
    criteriaIndex = 0;
    addCriteriaField();
    document.getElementById("total-percentage").value = 0;
}
