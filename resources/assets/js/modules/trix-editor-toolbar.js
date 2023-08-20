import Trix from "trix";

"use strict";


/**
 * Add custom buttons to the Trix Editor toolbar.
 *
 * @param event
 */
function updateTrixToolbar(event)
{
    const { lang } = Trix.config;

    /**
     * Markup for a 'Full-featured' editor toolbar.
     */
    let toolbarBodyHTML = () => {
        return `
<div class="trix-button-row">
  <span class="trix-button-group trix-button-group--text-tools" data-trix-button-group="text-tools">
    <button type="button" class="trix-button trix-button--icon trix-button--icon-bold" data-trix-attribute="bold" data-trix-key="b" title="${lang.bold}" tabindex="-1">${lang.bold}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-italic" data-trix-attribute="italic" data-trix-key="i" title="${lang.italic}" tabindex="-1">${lang.italic}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-strike" data-trix-attribute="strike" title="${lang.strike}" tabindex="-1">${lang.strike}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-link" data-trix-attribute="href" data-trix-action="link" data-trix-key="k" title="${lang.link}" tabindex="-1">${lang.link}</button>
  </span>
  <span class="trix-button-group trix-button-group--block-tools" data-trix-button-group="block-tools">
    <button type="button" class="trix-button trix-button--icon trix-button--icon-heading-2" data-trix-attribute="heading2" data-trix-action="myAction" title="Heading 2" tabindex="-1">H2</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-heading-3" data-trix-attribute="heading3" data-trix-action="myAction" title="Heading 3" tabindex="-1">H3</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-heading-4" data-trix-attribute="heading4" data-trix-action="myAction" title="Heading 4" tabindex="-1">H4</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-quote" data-trix-attribute="quote" title="${lang.quote}" tabindex="-1">${lang.quote}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-code" data-trix-attribute="code" title="${lang.code}" tabindex="-1">${lang.code}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-bullet-list" data-trix-attribute="bullet" title="${lang.bullets}" tabindex="-1">${lang.bullets}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-number-list" data-trix-attribute="number" title="${lang.numbers}" tabindex="-1">${lang.numbers}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-decrease-nesting-level" data-trix-action="decreaseNestingLevel" title="${lang.outdent}" tabindex="-1">${lang.outdent}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-increase-nesting-level" data-trix-action="increaseNestingLevel" title="${lang.indent}" tabindex="-1">${lang.indent}</button>
  </span>
  <span class="trix-button-group trix-button-group--file-tools" data-trix-button-group="file-tools">
    <button type="button" class="trix-button trix-button--icon trix-button--icon-attach" data-trix-action="attachFiles" title="${lang.attachFiles}" tabindex="-1">${lang.attachFiles}</button>
  </span>
</div>
        `;
    };


    /**
     * Markup for a 'Minimal' editor toolbar.
     */
    let toolbarSummaryHTML = () => {
        return `
<div class="trix-button-row">
  <span class="trix-button-group trix-button-group--summary-tools" data-trix-button-group="summary-tools">
    <button type="button" class="trix-button trix-button--icon trix-button--icon-bold" data-trix-attribute="bold" data-trix-key="b" title="${lang.bold}" tabindex="-1">${lang.bold}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-italic" data-trix-attribute="italic" data-trix-key="i" title="${lang.italic}" tabindex="-1">${lang.italic}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-strike" data-trix-attribute="strike" title="${lang.strike}" tabindex="-1">${lang.strike}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-link" data-trix-attribute="href" data-trix-action="link" data-trix-key="k" title="${lang.link}" tabindex="-1">${lang.link}</button>
    <button type="button" class="trix-button trix-button--icon trix-button--icon-code" data-trix-attribute="code" title="${lang.code}" tabindex="-1">${lang.code}</button>
  </span>
</div>
        `;
    };


    /**
     * Add new buttons to their respective toolbar:
     *  'trix-toolbar-1': Summary (minimal)
     *  'trix-toolbar-2': Body (full-featured)
     */
    const updateToolbars = () => {
        const toolbars = document.querySelectorAll("trix-toolbar");
        const summary = toolbarSummaryHTML();
        const body = toolbarBodyHTML();

        toolbars.forEach((toolbar) => {
            toolbar.innerHTML = (
                toolbar.attributes.id.nodeValue === "trix-toolbar-1"
            ) ? summary : body;

            // Append the 'Dialog' to the toolbar.
            toolbar.innerHTML += `
<div class="trix-dialogs" data-trix-dialogs>
  <div class="trix-dialog trix-dialog--link" data-trix-dialog="href" data-trix-dialog-attribute="href">
    <div class="trix-dialog__link-fields">
      <input type="url" name="href" class="trix-input trix-input--dialog" placeholder="${lang.urlPlaceholder}" aria-label="${lang.url}" required data-trix-input>
      <div class="trix-button-group">
        <input type="button" class="trix-button trix-button--dialog" value="${lang.link}" data-trix-method="setAttribute">
        <input type="button" class="trix-button trix-button--dialog" value="${lang.unlink}" data-trix-method="removeAttribute">
      </div>
    </div>
  </div>
</div>
            `;
        });
    };


    /**
     * Register new buttons before the Trix Editor is initialized.
     */
    document.addEventListener("trix-before-initialize", () => {
        Trix.config.toolbar.getDefaultHTML = toolbarBodyHTML;

        Trix.config.blockAttributes.heading2 = {
            tagName: "h2",
            terminal: true,
            breakOnReturn: true,
            group: false
        };

        Trix.config.blockAttributes.heading3 = {
            tagName: "h3",
            terminal: true,
            breakOnReturn: true,
            group: false
        };

        Trix.config.blockAttributes.heading4 = {
            tagName: "h4",
            terminal: true,
            breakOnReturn: true,
            group: false
        };

        document.addEventListener("trix-initialize", updateToolbars, { once: true });
    });

}

export { updateTrixToolbar };
