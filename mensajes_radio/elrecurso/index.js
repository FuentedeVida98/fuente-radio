document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");

    cards.forEach((card) => {
        card.addEventListener("click", () => {
            const cardBody = card.querySelector(".card_body");
            cardBody.classList.toggle("expanded");
        });
    });
});

