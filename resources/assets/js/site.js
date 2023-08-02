// 3rd party import.
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/*import Choices from "choices.js";
window.Choices = Choices;*/


// Local modules.
import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);

(function (window) {
    window.addEventListener("load", () => {
        /**
         * Are we in the administration area?
         */
        const isAdmin = document.querySelector("body.admin");

        /**
         * Open external links in secure new tab/window.
         */
        document.querySelectorAll("a").forEach((link) => {
            const href = link.getAttribute("href");
            const rel = link.getAttribute("rel");

            if (! exists(href)) {
                return false;
            }

            let isExternal = ! (
                    href.startsWith("/") ||
                    href.startsWith("?") ||
                    href.startsWith("#") ||
                    href.includes("jdmlabs") || href.includes(".test")
                ) ||
                (exists(rel) ? rel.includes("external") : false);

            if (isExternal) {
                newWindow(link);
            }
        });


        // Admin only.
        if (isAdmin) {
            /**
             * Create a {position: sticky} 'event'.
             */
            const listingHeader = document.getElementById("listingHeader");
            if (exists(listingHeader)) {
                const observer = new IntersectionObserver(
                    ([entry]) => entry.target.toggleAttribute("stuck", entry.intersectionRatio < 1),
                    {
                        threshold: [1]
                    }
                );

                observer.observe(listingHeader);
            }


            // /**
            //  * Temporary image preview.
            //  */
            // const fileInput = document.getElementById("signature_image");
            // if (exists(fileInput)) {
            //     fileInput.addEventListener('change', () => {
            //         const file = fileInput.files;
            //
            //         if (file) {
            //             const fileReader = new FileReader();
            //             const preview = document.getElementById("previewer");
            //
            //             fileReader.onload = event => {
            //                 console.log(event.target.result);
            //                 preview.setAttribute('src', event.target.result);
            //             };
            //
            //             fileReader.readAsDataURL(file[0]);
            //         }
            //     });
            // }

        }

    }, false);
})(window);

/* <> */
