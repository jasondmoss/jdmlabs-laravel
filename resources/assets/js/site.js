// Local modules.
import "alpinejs";
// import { document } from "postcss";
import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);


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
if (document.querySelector("body.admin")) {
    /**
     * Create a {position: sticky} 'event'.
     */
    const listingHeader = document.getElementById("listingHeader");
    if (exists(listingHeader)) {
        const observer = new IntersectionObserver(
            ([ entry ]) => entry.target.toggleAttribute("stuck", entry.intersectionRatio < 1),
            {
                threshold: [ 1 ]
            }
        );

        observer.observe(listingHeader);
    }

    /*const form = document.querySelector("");
    if (exists(form)) {
        const button = form.querySelector(".button--submit");
        if (exists(button)) {
            button.addEventListener("click", (event) => {
                event.preventDefault();

                form.submit();
            });
        }
    }*/


    const single = document.querySelector(".container--images.single .wrapper");
    if (exists(single)) {
        /**
         * Temporary image preview.
         */
        const input = single.querySelector(".file-uploader");
        input.addEventListener("change", () => {
            const file = input.files;

            if (file) {
                const fileReader = new FileReader();
                const preview = single.querySelector(".image-previewer");

                fileReader.onload = (event) => {
                    preview.setAttribute("src", event.target.result);
                };

                fileReader.readAsDataURL(file[0]);
            }
        });
    }


    /**
     * Multi-image replicator.
     */
    const multi = document.querySelector(".container--images.multi .wrapper");
    if (exists(multi)) {
        const repeatable = multi.querySelector(".repeatable");
        const repeater = multi.parentElement.querySelector(".repeater");

        repeater.addEventListener("click", () => {
            let num = multi.querySelectorAll(".repeatable").length;
            let cloned = repeatable.cloneNode(true);

            cloned.querySelector(".file-uploader").setAttribute("name", "showcase_images[" + num + "][file]");
            cloned.querySelector(".label").setAttribute("name", "showcase_images[" + num + "][label]");
            cloned.querySelector(".alt").setAttribute("name", "showcase_images[" + num + "][alt]");
            cloned.querySelector(".caption").setAttribute("name", "showcase_images[" + num + "][caption]");

            multi.appendChild(cloned);
        });
    }
}
