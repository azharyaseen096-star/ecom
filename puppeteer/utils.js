export function unique(array) {

    return [...new Set(array)];

}

export function cleanText(text) {

    return text
        .replace(/\s+/g, " ")
        .trim();

}