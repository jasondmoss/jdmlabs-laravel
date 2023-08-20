import { exists } from "./exists.js";

"use strict";


/**
 * Securely open a new window from given anchor element.
 *
 * @param {HTMLAnchorElement} anchor
 */
function newWindow (anchor)
{
    anchor.setAttribute("rel", "noopener noreferrer");
    anchor.addEventListener("click", (event) => {
        event.preventDefault();

        let targetUrl = anchor.getAttribute("href");
        let newWindow = window.open(targetUrl, "_blank");

        /**
         * Sever the reference of the new tab/window from the parent.
         *
         * @see https://developer.mozilla.org/en-US/docs/Web/API/Window/opener
         */
        newWindow.opener = null;
    });
}


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

export { newWindow };
