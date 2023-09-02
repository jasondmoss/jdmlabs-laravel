import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import FloatingFocus from '@q42/floating-focus-a11y';
new FloatingFocus();

import.meta.glob([ "../fonts/**", "../images/**" ]);

(function () {
    "use strict";

    const overlayToggle = document.getElementById("toggle");
    if (exists(overlayToggle)) {
        const panel = document.querySelector("div.panel");

        window.addEventListener("click", (event) => {
            if (overlayToggle.contains(event.target)) {
                panel.classList.toggle("open");
            }
        });

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && panel.classList.contains("open")) {
                panel.classList.remove("open");
            }
        });
    }
})();
