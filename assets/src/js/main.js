import './index-tw.js';
import './popup.js';
import './ajax-reg.js';

document.addEventListener("DOMContentLoaded", () => {
    function initBurgerMenu() {
        const burgerMenuBtn = document.querySelector(".burger-menu");
        const closeBurgerMenuBtn = document.querySelector(".close-burger-menu");
        const popupMenu = document.querySelector(".popup-menu-overlay");
        const headerBtnGroup = document.querySelector(".header-btn-group");
        const primaryLogo = document.querySelector(".primary-logo");

        burgerMenuBtn.addEventListener("click", () => {
            popupMenu.style.transform = "translateX(0%)";
            headerBtnGroup.style.opacity = "0";
            primaryLogo.style.opacity = "0";
        });

        closeBurgerMenuBtn.addEventListener("click", () => {
            popupMenu.style.transform = "translateX(100%)";
            headerBtnGroup.style.opacity = "1";
            primaryLogo.style.opacity = "1";
        });
    }
    initBurgerMenu();

    function checkClearBtn() {
        const clearBtns = document.querySelectorAll(".clear-all-button");
        clearBtns.forEach((clearBtn) => {
            const filterWrapper = document.querySelector(".selected-filters");
            if (filterWrapper.children.length > 0) {
                clearBtn.classList.remove("disabled");
            } else {
                clearBtn.classList.add("disabled");
            }
        });
    }

    function initFilters() {
        const dropdownButtons = document.querySelectorAll(".custom-dropdown-button");
        const dropdownContents = document.querySelectorAll(".custom-dropdown-content");
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const clearAllButtons = document.querySelectorAll(".clear-all-button");
        const selectedFiltersDiv = document.querySelector(".selected-filters");
        const nestedDropdowns = document.querySelectorAll(".nested-dropdown");

        dropdownButtons.forEach((button, index) => {
            button.addEventListener("click", function () {
                const content = dropdownContents[index];
                content.style.display = content.style.display === "flex" ? "none" : "flex";
            });
        });

        nestedDropdowns.forEach((dropdown) => {
            dropdown.addEventListener("click", function (event) {
                event.stopPropagation();
                const content = dropdown.querySelector(".custom-dropdown-content");
                content.style.display = content.style.display === "flex" ? "none" : "flex";
            });
        });

        document.addEventListener("click", function (event) {
            nestedDropdowns.forEach((dropdown) => {
                const content = dropdown.querySelector(".custom-dropdown-content");
                if (!dropdown.contains(event.target) && !content.contains(event.target)) {
                    content.style.display = "none";
                }
            });
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const category = checkbox.name.split("-")[1].slice(0, -2);
                const value = checkbox.value;
                if (this.checked) {
                    addFilter(category, value);
                } else {
                    removeFilter(category, value);
                }
               /*  checkClearBtn(); */
            });
        });

        clearAllButtons.forEach((clearAllButton) => {
            clearAllButton.addEventListener("click", function () {
                clearSelectedFilters();
                /* checkClearBtn(); */
            });
        });

        function addFilter(category, value) {
            removeFilter(category, value);

            const filterItem = document.createElement("div");
            filterItem.className = "filter-item";
            filterItem.dataset.category = category;
            filterItem.dataset.value = value;
            filterItem.innerHTML = `${category}: ${value} <span class="remove-filter">&times;</span>`;
            selectedFiltersDiv.appendChild(filterItem);

            filterItem.querySelector(".remove-filter").addEventListener("click", function () {
                removeFilter(category, value);
                const checkboxes = document.querySelectorAll(`input[name="filter-${category}[]"]`);
                checkboxes.forEach((checkbox) => {
                    if (checkbox.value === value) {
                        checkbox.checked = false;
                    }
                });
               /*  checkClearBtn(); */
            });
        }

        function removeFilter(category, value) {
            const filterItems = document.querySelectorAll(
                `.filter-item[data-category="${category}"][data-value="${value}"]`
            );
            filterItems.forEach((item) => item.remove());
         /*    checkClearBtn(); */
        }

        function clearSelectedFilters() {
            selectedFiltersDiv.innerHTML = "";
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
                checkbox.parentElement.classList.remove("checked");
            });
           /*  checkClearBtn(); */
        }

        document.addEventListener("click", function (event) {
            dropdownContents.forEach((content, index) => {
                if (dropdownButtons[index]) {
                    if (!dropdownButtons[index].contains(event.target) && !content.contains(event.target)) {
                        content.style.display = "none";
                    }
                }
            });
        });

       /*  checkClearBtn(); */
    }

    if (popupData.is_user_logged_in) {
        initFilters();
    } else {
     /*    checkClearBtn(); */
    }

    function showFilters() {
        const showFiltersBtn = document.getElementById("show-filters-btn");
        const filters = document.querySelector(".filter-container");

        showFiltersBtn.addEventListener("click", () => {
            filters.classList.toggle("visible-filters");
        });
    }

    showFilters();

    function initAjaxHandler() {
        const seeMoreButton = document.getElementById("see-more-button");

        seeMoreButton.addEventListener("click", function () {
            if (popupData.is_user_logged_in) {
                let currentCount = parseInt(seeMoreButton.getAttribute("data-count"));
                let newCount = currentCount * 2;
    
                const currentUrl = new URL(window.location.href);
                const params = currentUrl.searchParams;
                params.set("count", newCount);
    
                const ajaxUrl = `/wp-admin/admin-ajax.php?action=load_more_events&${params.toString()}`;
    
                fetch(ajaxUrl)
                    .then((response) => response.text())
                    .then((data) => {
                        document.querySelector(".event-grid-group").innerHTML = data;
                        seeMoreButton.setAttribute("data-count", newCount);
                    })
                    .catch((error) => console.error("Error:", error));
            }
        });
    }

    initAjaxHandler();

    // Partners carousel
    function initCarouselControls(containerSelector, trackSelector, prevBtnSelector, nextBtnSelector) {
        const container = document.querySelector(containerSelector);
        const track = container.querySelector(trackSelector);
        const slides = Array.from(track.children);
        const prevButton = document.querySelector(prevBtnSelector);
        const nextButton = document.querySelector(nextBtnSelector);

        const slideWidth = slides[0].getBoundingClientRect().width;
        const carouselGap = getComputedStyle(container).getPropertyValue("--_carousel-gap").trim().replace("px", "");

        const setSlidePosition = (slide, index) => {
            slide.style.left = (slideWidth + parseFloat(carouselGap)) * index + "px";
        };
        slides.forEach(setSlidePosition);

        const moveToSlide = (track, currentSlide, targetSlide) => {
            track.style.transform = "translateX(-" + targetSlide.style.left + ")";
            currentSlide.classList.remove("current-slide");
            targetSlide.classList.add("current-slide");
        };

        prevButton.addEventListener("click", (e) => {
            const currentSlide = track.querySelector(".current-slide");
            const prevSlide = currentSlide.previousElementSibling;

            if (prevSlide) {
                moveToSlide(track, currentSlide, prevSlide);
            }
        });

        nextButton.addEventListener("click", (e) => {
            const currentSlide = track.querySelector(".current-slide");
            const nextSlide = currentSlide.nextElementSibling;

            if (nextSlide) {
                moveToSlide(track, currentSlide, nextSlide);
            }
        });

        slides[0].classList.add("current-slide");
    }

    initCarouselControls(
        ".carousel-track-container",
        ".carousel-track",
        ".carousel-arrow.prev",
        ".carousel-arrow.next"
    );

    function initStepsCarousel(carouselContainerSelector, trackSelector, interval = 3000) {
        const carouselContainer = document.querySelector(carouselContainerSelector);

        if (carouselContainer == null) return 
        
        const track = carouselContainer.querySelector(trackSelector);
        const slides = Array.from(track.children);
    
        const slideWidth = slides[0].getBoundingClientRect().width;
        let currentSlideIndex = 0;
    
        const setSlidePosition = (slide, index) => {
            slide.style.left = slideWidth * index + "px";
        };
        slides.forEach(setSlidePosition);
    
        const moveToSlide = (track, currentSlide, targetSlide) => {
            track.style.transform = "translateX(-" + targetSlide.style.left + ")";
            currentSlide.classList.remove("current-slide");
            targetSlide.classList.add("current-slide");
        };
    
        const setCurrentSlide = (index) => {
            const currentSlide = track.querySelector(".current-slide");
            const targetSlide = slides[index];
    
            moveToSlide(track, currentSlide, targetSlide);
            currentSlideIndex = index;
        };
    
        slides[0].classList.add("current-slide");
    
        setInterval(() => {
            if (currentSlideIndex < slides.length - 1) {
                setCurrentSlide(currentSlideIndex + 1);
            } else {
                setCurrentSlide(0);
            }
        }, interval);
    }

    setTimeout(() => {
        initStepsCarousel('.carousel-1', '.steps-carousel-track', 3000);
    }, 500);
    setTimeout(() => {
        initStepsCarousel('.carousel-2', '.steps-carousel-track', 3000);
    }, 1000);
    initStepsCarousel('.carousel-3', '.steps-carousel-track', 3000);
    

    window.addEventListener("scroll", function () {
        const navMenu = document.querySelector(".header-primary");
        if (window.scrollY > 1000) {
            navMenu.classList.add("sticky-header");
        } else {
            navMenu.classList.remove("sticky-header");
        }
    });

    function initCookiePolicyBtn() {
        const cookiePolicyContainer = document.querySelector(".cookie-policy");
        const cookiePolicyBtn = document.querySelector(".accept-cookies-btn");

        const cookiePolicyAccepted = localStorage.getItem("cookiePolicyAccepted");

        if (cookiePolicyAccepted) {
            cookiePolicyContainer.classList.add("hidden");
        }

        cookiePolicyBtn.addEventListener("click", () => {
            cookiePolicyContainer.style.transition = "opacity 1s ease-in-out";
            cookiePolicyContainer.style.opacity = "0";
            setTimeout(() => {
                cookiePolicyContainer.classList.add("hidden");
            }, 1000);
            localStorage.setItem("cookiePolicyAccepted", "true");
        });
    }

    initCookiePolicyBtn();
});

