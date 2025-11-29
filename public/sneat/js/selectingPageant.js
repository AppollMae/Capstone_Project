document.getElementById('contest-category').addEventListener('change', function() {
    let selectedCategory = this.value;
    let contestantSelect = document.getElementById('contestant');

    Array.from(contestantSelect.options).forEach(option => {
        if (option.value === "") return; // Keep placeholder
        option.style.display = option.dataset.category === selectedCategory ? '' : 'none';
    });

    contestantSelect.value = "";
});