document.addEventListener("DOMContentLoaded", function() {
    const animatedFromLeftElements = document.querySelectorAll(".animate-from-left");
    const animatedFromRightElements = document.querySelectorAll(".animate-from-right");

    function checkAnimation() {
        const threshold = window.innerHeight * 0.8;
        const scrollPosition = window.scrollY;

        animatedFromLeftElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            if (elementTop < threshold && elementBottom > 0) {
                element.classList.add("animated");
            } else {
                element.classList.remove("animated");
            }
        });

        animatedFromRightElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            if (elementTop < threshold && elementBottom > 0) {
                element.classList.add("animated");
            } else {
                element.classList.remove("animated");
            }
        });
    }

    // Initial check
    checkAnimation();

    // Check again on scroll
    window.addEventListener("scroll", checkAnimation);
});
