import puppeteer from "puppeteer-core";

export async function launchBrowser() {

    const browser = await puppeteer.launch({

        executablePath: "C:\\xampp\\htdocs\\Ecom\\chromium\\win64-1669190\\chrome-win\\chrome.exe",

        headless: true,

        defaultViewport: {
            width: 1366,
            height: 768
        },

        args: [
            "--no-sandbox",
            "--disable-setuid-sandbox",
            "--disable-dev-shm-usage",
            "--disable-gpu",
            "--window-size=1366,768"
        ]

    });

    return browser;

}