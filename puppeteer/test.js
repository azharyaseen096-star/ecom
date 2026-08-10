import puppeteer from 'puppeteer-core';

const browser = await puppeteer.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: false,
    defaultViewport: null,
});

const page = await browser.newPage();

await page.goto('https://en.wikipedia.org', {
    waitUntil: 'networkidle2'
});

// Search box me text likho
await page.locator('input[name="search"]').fill('Pakistan');

// Search button click
await page.locator('button[type="submit"]').click();

// Page load hone ka wait
await page.waitForNavigation({
    waitUntil: 'networkidle2'
});

// Heading
const heading = await page.locator('#firstHeading').innerText();

console.log("Heading:", heading);

// Summary (pehla paragraph)
const summary = await page.locator('.mw-parser-output > p').innerText();

console.log("Summary:");
console.log(summary);

await browser.close();