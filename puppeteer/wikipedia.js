import { launchBrowser } from "./browser.js";

export async function scrapeWikipedia(search) {

    const browser = await launchBrowser();
    const page = await browser.newPage();

    try {

        // Browser ko thoda real user jaisa banao
        await page.setUserAgent(
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36"
        );

        // Direct Wikipedia article open karo
        const url = `https://en.wikipedia.org/wiki/${encodeURIComponent(search)}`;

        await page.goto(url, {
            waitUntil: "domcontentloaded",
            timeout: 60000
        });

        // Heading ka wait
        await page.waitForSelector("#firstHeading", {
            timeout: 60000
        });

        // Page ko thoda load hone do
        await new Promise(resolve => setTimeout(resolve, 1000));

        const data = await page.evaluate(() => {

            // Title
            const title =
                document.querySelector("#firstHeading")?.innerText.trim() || "";

            // Summary
            let summary = "";

            const selectors = [
                ".mw-parser-output > p",
                ".mw-content-ltr p",
                "#mw-content-text p",
                "article p",
                "main p"
            ];

            for (const selector of selectors) {

                const paragraphs = document.querySelectorAll(selector);

                for (const p of paragraphs) {

                    const text = p.innerText.trim();

                    if (text.length > 80) {
                        summary = text;
                        break;
                    }

                }

                if (summary) break;

            }

            // Image
            let image = "";

            const img = document.querySelector(".infobox img");

            if (img) {

                image = img.src.startsWith("http")
                    ? img.src
                    : "https:" + img.src;

            }

            return {

                success: true,

                title,

                summary,

                image,

                url: window.location.href

            };

        });

        await browser.close();

        return data;

    } catch (error) {

        await browser.close();

        return {

            success: false,

            message: error.message

        };

    }

}