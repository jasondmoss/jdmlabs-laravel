import { replaceDivWithParagraph } from "./modules/trix-editor-paragraphs.js";
import { updateTrixToolbar } from "./modules/trix-editor-toolbar.js";
import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);

// Initialize Trix Editor with our custom functionality.
updateTrixToolbar();
replaceDivWithParagraph();


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


/**
 * Temporary image preview.
 */
const single = document.querySelector(".container--images.single .wrapper");
if (exists(single)) {
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


/**
 * Submit form on button click.
 */
const entryForm = document.getElementById("entryForm");
if (exists(entryForm)) {
    entryForm.querySelector("button[type=submit]")
        .addEventListener("click", (event) => entryForm.submit());
}
