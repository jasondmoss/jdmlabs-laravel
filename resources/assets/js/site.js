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

import.meta.glob([
    "../fonts/**",
    "../images/**"
]);

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


            const imageContainers = document.querySelectorAll(".container--images");
            if (exists(imageContainers)) {
                imageContainers.forEach((container) => {

                    /**
                     * Temporary image preview.
                     */
                    const inputs = container.querySelectorAll(".uploader");
                    inputs.forEach((input) => input.addEventListener("change", () => {
                        const file = input.files;

                        if (file) {
                            const fileReader = new FileReader();
                            const preview = container.querySelector(".image-previewer");

                            fileReader.onload = event => {
                                console.log(event.target.result);
                                preview.setAttribute("src", event.target.result);
                            };

                            fileReader.readAsDataURL(file[0]);
                        }
                    }))


                    /**
                     * Showcase image replicator.
                     */
                    const repeater = container.querySelector("button.repeater")
                    if (exists(repeater)) {

                        repeater.addEventListener("click", (event) => {
                            event.preventDefault();

                            const repeatable = container.querySelectorAll(".repeatable");
                            let num = repeatable.length;
                            let cloned = repeatable[0].cloneNode(true);

                            cloned.querySelector(".uploader").setAttribute("name", "showcase_images[" + num + "][file]");
                            cloned.querySelector(".label").setAttribute("name", "showcase_images[" + num + "][label]");
                            cloned.querySelector(".alt").setAttribute("name", "showcase_images[" + num + "][alt]");
                            cloned.querySelector(".caption").setAttribute("name", "showcase_images[" + num + "][caption]");

                            container.insertBefore(cloned, repeatable[0]);
                        });
                    }
                });
            }
        }

    }, false);
})(window);

/* <> */
