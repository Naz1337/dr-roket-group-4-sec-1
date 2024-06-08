const blocks = ['focus'];


/**
 * This object will store the counts of the blocks
 * @type {Object.<string, number>}
 */
const counts = {};

// parse the get parameter in the url and for every parameter that has the same name in blocks,
// set the value of that parameter into counts object with the name of that parameter as the key
const urlParams = new URLSearchParams(window.location.search);
for (const block of blocks) {
    if (urlParams.has(block)) {
        counts[block] = parseInt(urlParams.get(block));
    }
}

console.log(counts);

for (const block of blocks) {
    const countEl = document.getElementById(block);
    if (!countEl) {
        continue;
    }
    countEl.addEventListener('change', function () {
        // Get the value of the input
        // Set the count in the counts object with the name of the block as the key
        counts[block] = countEl.value;

        // from the current counts object, create a new url with the parameters
        // as the keys and the values as the values in the url parameters but still the same url
        const url = new URL(window.location.href);
        for (const [key, value] of Object.entries(counts)) {
            url.searchParams.set(key, '' + value);
        }

        // redirect to the new url
        window.location.href = url.href;

    });

    if (counts[block] !== undefined)
        countEl.value = counts[block];

}
