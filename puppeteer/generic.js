import { launchBrowser } from "./browser.js";

export async function scrapeWebsite(url){

    const browser = await launchBrowser();

    const page = await browser.newPage();

    await page.goto(url,{
        waitUntil:"networkidle2"
    });

    // Generic Scraper

    await browser.close();

}