import { scrapeWikipedia } from "./wikipedia.js";
import { scrapeWebsite } from "./universal.js";
import { scrapeLinkedIn } from "./linkedin.js";

const input = process.argv.slice(2).join(" ").trim();

if (!input) {

    console.log(JSON.stringify({

        success: false,

        message: "No search keyword."

    }));

    process.exit(1);

}

const isUrl = /^https?:\/\//i.test(input);

try {

    let result;

    if (isUrl) {

        const url = input.toLowerCase();

        // ==========================
        // LinkedIn
        // ==========================

        if (url.includes("linkedin.com")) {

            console.log("LinkedIn Scraper Started...");

            result = await scrapeLinkedIn(input);

        }

        // ==========================
        // GitHub
        // ==========================

        else if (url.includes("github.com")) {

            console.log("GitHub Scraper Started...");

            result = await scrapeWebsite(input);

        }

        // ==========================
        // Universal Website
        // ==========================

        else {

            console.log("Universal Website Scraper Started...");

            result = await scrapeWebsite(input);

        }

    }

    // ==========================
    // Wikipedia Search
    // ==========================

    else {

        console.log("Wikipedia Scraper Started...");

        result = await scrapeWikipedia(input);

    }

    // ==========================
    // Remove Heavy Data
    // ==========================

    if (result) {

        delete result.html;
        delete result.pageText;

    }

    console.log(JSON.stringify(result, null, 2));

}

catch (error) {

    console.log(JSON.stringify({

        success: false,

        message: error.message,

        stack: error.stack

    }, null, 2));

}