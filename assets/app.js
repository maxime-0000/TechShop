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

function initialiserCatalogue() {
    const catalogue = document.querySelector("[data-catalogue]");

    if (!catalogue) {
        return;
    }

    void chargerCatalogue(catalogue);
}

async function chargerCatalogue(catalogue) {
    const statut = catalogue.querySelector("[data-catalogue-status]");
    const resultats = catalogue.querySelector("[data-catalogue-results]");

    statut.textContent = "Chargement du catalogue...";

    try {
        const url = new URL(catalogue.dataset.apiUrl, window.location.origin);
        url.searchParams.set("page", "1");
        url.searchParams.set("per_page", "10");

        const response = await fetch(url, {
            headers: { Accept: "application/json" },
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP ${response.status}`);
        }

        const produits = await response.json();

        if (!Array.isArray(produits)) {
            throw new Error("La réponse du catalogue est invalide.");
        }

        afficherProduits(produits, resultats);
        statut.textContent =
            produits.length === 0
                ? "Aucun produit n’est disponible pour le moment."
                : `${produits.length} produit(s) affiché(s).`;
    } catch (erreur) {
        console.error("Erreur lors du chargement du catalogue :", erreur);
        resultats.replaceChildren();
        statut.textContent =
            "Impossible de charger le catalogue. Réessayez dans un instant.";
    }
}

function afficherProduits(produits, conteneur) {
    conteneur.replaceChildren();

    for (const produit of produits) {
        const carte = document.createElement("article");
        carte.className = "carte";

        if (produit.imageUrl) {
            const image = document.createElement("img");
            image.className = "carte-image";
            image.src = produit.imageUrl;
            image.alt = produit.nom
                ? `Image du produit ${produit.nom}`
                : "Image du produit";
            image.loading = "lazy";
            image.referrerPolicy = "no-referrer";
            carte.append(image);
        }

        const titre = document.createElement("h2");
        titre.textContent = produit.nom ?? "Produit sans nom";
        carte.append(titre);

        const description = document.createElement("p");
        description.className = "carte-description";
        description.textContent =
            produit.description ?? "Aucune description disponible.";
        carte.append(description);

        const prix = document.createElement("p");
        prix.className = "carte-prix";
        prix.textContent = new Intl.NumberFormat("fr-FR", {
            style: "currency",
            currency: "EUR",
        }).format(Number(produit.prix));
        carte.append(prix);

        const stock = document.createElement("p");
        stock.className = "carte-stock";
        const quantite = Number(produit.quantite ?? 0);
        stock.dataset.outOfStock = String(quantite <= 0);
        stock.textContent =
            quantite > 0 ? `${quantite} en stock` : "Rupture de stock";
        carte.append(stock);

        const catalogue = document.querySelector("[data-catalogue]");

        const formulaire = document.createElement("form");
        formulaire.method = "POST";
        formulaire.action = catalogue.dataset.panierUrl.replace(/\/0$/, `/${produit.id}`);

        const token = document.createElement("input");
        token.type = "hidden";
        token.name = "_token";
        token.value = catalogue.dataset.csrfToken;

        const bouton = document.createElement("button");
        bouton.type = "submit";
        bouton.className = "btn btn-primary";
        bouton.textContent = "Ajouter au panier";

        formulaire.append(token, bouton);
        carte.append(formulaire);

        conteneur.append(carte);
    }
}

initialiserCatalogue();
