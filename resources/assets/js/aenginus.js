import { replaceDivWithParagraph } from "./modules/trix-editor-paragraphs.js";
import { updateTrixToolbar } from "./modules/trix-editor-toolbar.js";
import { exists } from "./modules/exists.js";
import { newWindow } from "./modules/new-window.js";

import.meta.glob([ "../fonts/**", "../images/**" ]);

// Initialize Trix Editor with customizations.
updateTrixToolbar();
replaceDivWithParagraph();


/**
 * Disappear messages.
 */
document.querySelectorAll("figure.alert").forEach((alert) => setTimeout(() => {
    alert.style.opacity = 0;

    setTimeout(() => alert.remove(), 500);
}, 3000));


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
let imagePreviewers = document.querySelectorAll("body.admin img.image-display");
if (exists(imagePreviewers)) {
    const handlePreview = (input, preview) => {
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];

            if (! file.type.startsWith("image/")) {
                continue;
            }

            preview.file = file;

            const reader = new FileReader();

            reader.onload = (event) => {
                preview.src = event.target.result;
            };

            reader.readAsDataURL(file);
        }
    };

    imagePreviewers.forEach((imagePreview, index) => {
        let fieldset = imagePreview.closest(".form-image");
        let fileInput = fieldset.querySelector(".file-uploader");

        fileInput.addEventListener(
            "change",
            () => handlePreview(fileInput, imagePreview),
            false
        );
    });
}


/**
 * Multi-image replicator.
 */
const repeatable = document.querySelector(".form-images .repeatable-wrapper");
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
