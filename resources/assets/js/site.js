// 3rd Party.
import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import Choices from "choices.js";
window.Choices = Choices;


// Local Modules.
import {exists} from "./modules/exists.js";
import {newWindow} from "./modules/window.js";

import.meta.glob([
    "../fonts/**",
    "../images/**"
]);

(function (window) {
    window.addEventListener("load", () => {

        /**
         * Open external links in new tab/window.
         */
        document.querySelectorAll("a").forEach((link) => {
            const href = link.getAttribute("href");
            const rel = link.getAttribute("rel");

            if (! exists(href)) {
                return false;
            }

            // isExternal.
            let isExternal = ! (
                    href.startsWith("/") ||
                    href.startsWith("?") ||
                    href.startsWith("#") ||
                    href.includes("jdmlabs") || href.includes(".test")
                ) ||
                // Flagged as external.
                (exists(rel) ? rel.includes("external") : false);

            if (isExternal) {
                // Securely open external link in new tab/window.
                newWindow(link);
            }
        });

        let categorySelect = document.getElementById('taxonomy');
        if (exists(categorySelect)) {
            new Choices(categorySelect, {
                position: "bottom",
                removeItemButton: true,
                duplicateItemsAllowed: false
            });
        }

        /**
         * Temporary image preview.
         */
        const fileInput = document.getElementById("signature_image");
        if (exists(fileInput)) {
            fileInput.addEventListener('change', () => {
                const file = fileInput.files;

                if (file) {
                    const fileReader = new FileReader();
                    const preview = document.getElementById("previewer");

                    fileReader.onload = event => {
                        console.log(event.target.result);
                        preview.setAttribute('src', event.target.result);
                    };

                    fileReader.readAsDataURL(file[0]);
                }
            });
        }

    }, false);
})(window);

/* <> */
