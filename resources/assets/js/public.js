/*import { TrixEditor } from "./modules/trix-editor.js";*/
import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);

(function () {
    "use strict";

    const overlayToggle = document.getElementById("toggle");
    if (exists(overlayToggle)) {
        overlayToggle.addEventListener("click", function ()  {
            // this.classList.toggle("toggle-active");
            // document.getElementById("overlay").classList.toggle("nav-active");
            this.parentElement.classList.toggle("open");
        });
    }
})();
