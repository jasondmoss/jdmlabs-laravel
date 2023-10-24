import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);

(function () {
    "use strict";

    function supportsPopover()
    {
        return HTMLElement.prototype.hasOwnProperty("popover");
    }

    const popoverSupported = supportsPopover();
    console.log(popoverSupported);


    /*const overlayToggle = document.getElementById("toggle");
    if (exists(overlayToggle)) {
        const panel = document.querySelector("dialog.panel");
        const close = panel.querySelector(".close-button");

        window.addEventListener("click", (event) => {
            if (overlayToggle.contains(event.target)) {
                panel.classList.toggle("open");
            } else if (! (
                overlayToggle.contains(event.target) ||
                panel.contains(event.target)
            ) || close.contains(event.target)) {
                panel.classList.remove("open");
            }
        });

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && panel.classList.contains("open")) {
                panel.classList.remove("open");
            }
        });
    }*/
})();
