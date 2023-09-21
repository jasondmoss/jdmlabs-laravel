import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import FloatingFocus from '@q42/floating-focus-a11y';
new FloatingFocus();

import.meta.glob([ "../fonts/**", "../images/**" ]);

(function () {
    "use strict";

    const focusPlate = document.getElementById("FocusPlate");
    if (exists(focusPlate)) {
        const mainmenu = document.querySelector(".site--header menu.main");

        mainmenu.addEventListener("mouseenter", () => {
            focusPlate.classList.add("hover-focus");
            mainmenu.classList.add("hover-focus");
        });
        mainmenu.addEventListener("mouseleave", () => {
            focusPlate.classList.remove("hover-focus");
            mainmenu.classList.remove("hover-focus");
        });
    }

    const overlayToggle = document.getElementById("toggle");
    if (exists(overlayToggle)) {
        const panel = document.querySelector("div.panel");

        window.addEventListener("click", (event) => {
            if (overlayToggle.contains(event.target)) {
                panel.classList.toggle("open");
            } else if (! (
                overlayToggle.contains(event.target) ||
                panel.contains(event.target)
            )) {
                panel.classList.remove("open");
            }
        });

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && panel.classList.contains("open")) {
                panel.classList.remove("open");
            }
        });
    }
})();
