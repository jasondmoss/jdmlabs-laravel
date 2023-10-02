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
        ([ entry ]) => entry
            .target
            .toggleAttribute("stuck", entry.intersectionRatio < 1),
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
    const input = single.querySelector(".file");
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
const repeatable = document.querySelector(".showcase-images .repeatable-wrapper");
if (exists(repeatable)) {
    const repeater = repeatable.parentElement.querySelector("button.repeater");
    let fieldsetCount = 0;

    repeater.addEventListener("click", (event) => {
        let cloned = event
            .target
            .offsetParent
            .querySelector("div.repeatable")
            .cloneNode(true);

        fieldsetCount++;

        cloned.querySelectorAll(".repeatable input").forEach((field, index) => {
            let fieldName = field.getAttribute("name");
            let fieldNameLabel = fieldName.match(/\[([a-z]+)\]/)[1];

            field.setAttribute(
                "name",
                "showcase_images[" + fieldsetCount +"][" + fieldNameLabel + "]"
            );

            if (field.value !== "showcase") {
                field.value = null;
            }
        });

        repeatable.appendChild(cloned);
    });
}


/**
 * Submit form on button click.
 */
const entryForm = document.getElementById("entryForm");
if (exists(entryForm)) {
    entryForm.querySelector("button.form-submit")
        .addEventListener("click", () => entryForm.submit());
}
