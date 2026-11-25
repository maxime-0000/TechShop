import "./stimulus_bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

document.querySelectorAll("[data-product-carousel]").forEach((carousel) => {
    const slides = [...carousel.querySelectorAll("[data-carousel-slide]")];
    const previousButton = carousel.querySelector("[data-carousel-previous]");
    const nextButton = carousel.querySelector("[data-carousel-next]");
    const toggleButton = carousel.querySelector("[data-carousel-toggle]");
    if (slides.length < 2 || !previousButton || !nextButton || !toggleButton) {
        return;
    }

    const currentSlideLabel = carousel.querySelector("[data-carousel-current]");
    const toggleIcon = carousel.querySelector("[data-carousel-toggle-icon]");
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;
    let currentIndex = 0;
    let isPaused = prefersReducedMotion;
    let isHovering = false;
    let isFocused = false;
    let autoplayTimer;

    const showSlide = (index) => {
        currentIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === currentIndex;
            slide.hidden = !isActive;
            slide.classList.toggle("is-active", isActive);
            slide.setAttribute("aria-hidden", String(!isActive));
        });

        currentSlideLabel.textContent = String(currentIndex + 1);
    };

    const stopAutoplay = () => {
        window.clearInterval(autoplayTimer);
        autoplayTimer = undefined;
    };

    const startAutoplay = () => {
        stopAutoplay();

        if (!isPaused && !isHovering && !isFocused && !document.hidden) {
            autoplayTimer = window.setInterval(
                () => showSlide(currentIndex + 1),
                5000,
            );
        }
    };

    previousButton.addEventListener("click", () => {
        showSlide(currentIndex - 1);
        startAutoplay();
    });

    nextButton.addEventListener("click", () => {
        showSlide(currentIndex + 1);
        startAutoplay();
    });

    toggleButton.addEventListener("click", () => {
        isPaused = !isPaused;
        toggleButton.setAttribute("aria-pressed", String(isPaused));
        toggleButton.setAttribute(
            "aria-label",
            isPaused
                ? "Reprendre le carrousel"
                : "Mettre le carrousel en pause",
        );
        toggleIcon.textContent = isPaused ? "▶" : "Ⅱ";
        startAutoplay();
    });

    carousel.addEventListener("mouseenter", () => {
        isHovering = true;
        stopAutoplay();
    });
    carousel.addEventListener("mouseleave", () => {
        isHovering = false;
        startAutoplay();
    });
    carousel.addEventListener("focusin", () => {
        isFocused = true;
        stopAutoplay();
    });
    carousel.addEventListener("focusout", (event) => {
        if (!carousel.contains(event.relatedTarget)) {
            isFocused = false;
            startAutoplay();
        }
    });
    document.addEventListener("visibilitychange", startAutoplay);

    showSlide(0);
    if (isPaused) {
        toggleButton.setAttribute("aria-pressed", "true");
        toggleButton.setAttribute("aria-label", "Reprendre le carrousel");
        toggleIcon.textContent = "▶";
    }
    startAutoplay();
});

