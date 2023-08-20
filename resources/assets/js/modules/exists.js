"use strict";

/**
 * Has (Object|Node) been defined? Does (Object|Node) exist?
 *
 * @param {object|array|string} thing
 */
function exists(thing)
{
    return ! (typeof thing === "undefined" ||
        thing === null ||
        thing === false ||
        thing.length < 1);
}

export { exists };
