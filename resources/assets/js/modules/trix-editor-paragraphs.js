import Trix from "trix";

"use strict";


/**
 * Replace `div` with `p` for paragraphs on <return>/<enter>.
 */
function replaceDivWithParagraph()
{
    Trix.config.blockAttributes.default.tagName = "p";
    Trix.config.blockAttributes.default.breakOnReturn = true;

    Trix.Block.prototype.breaksOnReturn = function () {
        const attr = this.getLastAttribute();
        const config = Trix.config.blockAttributes[attr ? attr : "default"];

        return config ? config.breakOnReturn : false;
    };

    Trix.LineBreakInsertion.prototype.shouldInsertBlockBreak = function () {
        if (this.block.hasAttributes() &&
            this.block.isListItem() &&
            ! this.block.isEmpty()
        ) {
            return this.startLocation.offset > 0;
        }

        return ! this.shouldBreakFormattedBlock() ? this.breaksOnReturn : false;
    };
}

export { replaceDivWithParagraph };
