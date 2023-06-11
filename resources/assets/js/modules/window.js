/**
 * Securely open a new window from given anchor element.
 *
 * @param {HTMLAnchorElement} anchor
 */
function newWindow (anchor) {
    "use strict";

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

export { newWindow };
