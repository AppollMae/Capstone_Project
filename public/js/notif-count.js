document.addEventListener("DOMContentLoaded", function () {
    const underReviewLink = document.getElementById("underReviewLink");
    const permitBadge = document.getElementById("permitBadge");

    if (underReviewLink && permitBadge) {
        underReviewLink.addEventListener("click", function () {
            permitBadge.remove(); // removes badge in parent menu
        });
    }
});