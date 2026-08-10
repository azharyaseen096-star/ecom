import { launchBrowser } from "./browser.js";

const browser = await launchBrowser();

const page = await browser.newPage();

await page.goto("https://en.wikipedia.org", {
    waitUntil: "networkidle2"
});

console.log(await page.title());

await browser.close();