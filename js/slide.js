document.addEventListener("DOMContentLoaded", () => {
    const cardBoxes = document.querySelectorAll(".card-box");
    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".cd");
        i=cards.length+1;
        cards.forEach((card) => {
            card.style.transform = "rotate(-2deg)";
            card.style.zIndex = i--;
        });
    });
    
    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".cd");
        
        cardBox.addEventListener("mouseenter", () => {
            cards.forEach((card, index) => {
                card.style.transition = "transform 0.5s ease, z-index 0.5s ease";
                const translateXValues = [400, 320, 250, 180, 96, 20];
                const rotateValue = 2;
                
                card.style.transform = `translateX(${translateXValues[index]}%) rotate(${rotateValue}deg)`;
            });
        });
        
        cardBox.addEventListener("mouseleave", () => {
            cards.forEach((card) => {
                card.style.transform = "rotate(-2deg)";
            });
        });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const cardBoxes = document.querySelectorAll(".card-box");
    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".acd");
        i=cards.length+1;
        cards.forEach((card) => {
            card.style.transform = "rotate(2deg)";
            card.style.zIndex = i--;
        });
    });

    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".acd");

        cardBox.addEventListener("mouseenter", () => {
            cards.forEach((card, index) => {
                card.style.transition = "transform 0.5s ease, z-index 0.5s ease";
                const translateXValues = [20, 96, 180, 250, 320, 400];
                const rotateValue = -2;

                card.style.transform = `translateX(${-translateXValues[index]}%) rotate(${rotateValue}deg)`;
            });
        });

        cardBox.addEventListener("mouseleave", () => {
            cards.forEach((card) => {
                card.style.transform = "rotate(2deg)";
            });
        });
    });
});



document.addEventListener("DOMContentLoaded", () => {
    const cardBoxes = document.querySelectorAll(".card-box");
    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".cr");
        cards.forEach((card, index) => {
            const initialDeg = [-8,-4,0,4,8];
            const initialTranslateXvalues = [-16,-8,0,8,16];
            const initialz = [3,4,5,4,3];
            card.style.transform = `translateX(${initialTranslateXvalues[index]}%) rotate(${initialDeg[index]}deg)`;
            card.style.zIndex = initialz[index];
        });
    });
    
    cardBoxes.forEach((cardBox) => {
        const cards = cardBox.querySelectorAll(".cr");
        
        cardBox.addEventListener("mouseenter", () => {
            cards.forEach((card, index) => {
                card.style.transition = "transform 0.5s ease";
                const translateXValues = [-190,-100,0,100,190];
                const translateYValues = [30,10,0,10,30];
                const rotateValues = [-28,-14,0,14,28];
                card.style.transform = `translateX(${translateXValues[index]}%) translateY(${translateYValues[index]}%) rotate(${rotateValues[index]}deg)`;
            });
        });
        
        cardBox.addEventListener("mouseleave", () => {
            cards.forEach((card, index) => {
                const initialDeg = [-8,-4,0,4,8];
                const initialTranslateXvalues = [-16,-8,0,8,16];
                card.style.transform = `translateX(${initialTranslateXvalues[index]}%) rotate(${initialDeg[index]}deg)`;
            });
        });
    });
});
