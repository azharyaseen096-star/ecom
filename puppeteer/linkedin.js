import fs from "fs";
import path from "path";
import { launchBrowser } from "./browser.js";

export async function scrapeLinkedIn(url) {

    const browser = await launchBrowser();

    const page = await browser.newPage();

    try {

        // =====================================
        // Browser Settings
        // =====================================

        await page.setViewport({

            width: 1400,

            height: 900

        });

        await page.setUserAgent(

            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36"

        );

        // =====================================
        // Open LinkedIn
        // =====================================

        await page.goto(url, {

            waitUntil: "networkidle2",

            timeout: 90000

        });

        // =====================================
        // Wait
        // =====================================

        await page.waitForTimeout(3000);

        // =====================================
        // Auto Scroll
        // =====================================

        await page.evaluate(async () => {

            await new Promise(resolve => {

                let totalHeight = 0;

                const distance = 500;

                const timer = setInterval(() => {

                    window.scrollBy(0, distance);

                    totalHeight += distance;

                    if (totalHeight >= document.body.scrollHeight) {

                        clearInterval(timer);

                        resolve();

                    }

                }, 300);

            });

        });

        // =====================================
        // Screenshot Folder
        // =====================================

        const folder = path.join(process.cwd(), "screenshots");

        if (!fs.existsSync(folder)) {

            fs.mkdirSync(folder, { recursive: true });

        }

        // =====================================
        // Screenshot
        // =====================================

        await page.screenshot({

            path: path.join(folder, "linkedin.png"),

            fullPage: true

        });

        // =====================================
        // PDF
        // =====================================

        await page.pdf({

            path: path.join(folder, "linkedin.pdf"),

            format: "A4",

            printBackground: true

        });
                // =====================================
        // Extract Data
        // =====================================

        const data = await page.evaluate(() => {

            const getText = (selector) => {

                const el = document.querySelector(selector);

                return el ? el.innerText.trim() : "";

            };

            const getAllText = (selector) => {

                return [...document.querySelectorAll(selector)]

                    .map(e => e.innerText.trim())

                    .filter(Boolean);

            };

            const getLinks = () => {

                return [...document.querySelectorAll("a")]

                    .map(link => ({

                        text: link.innerText.trim(),

                        href: link.href

                    }))

                    .filter(item => item.href);

            };

            const getImages = () => {

                return [...document.images]

                    .map(img => img.src)

                    .filter(Boolean);

            };

            const headings = {};

            ["h1","h2","h3","h4","h5","h6"].forEach(tag=>{

                headings[tag]=getAllText(tag);

            });

            const paragraphs=getAllText("p");

            return {

                success:true,

                url:window.location.href,

                title:document.title,

                name:getText("h1"),

                headline:getText(".text-body-medium"),

                location:getText(".text-body-small"),

                image:document.querySelector("img")?.src || "",

                headings,

                paragraphs,

                images:getImages(),

                links:getLinks(),

                pageText:document.body.innerText

            };

        });
                // =====================================
        // Emails
        // =====================================

        const emailRegex =
            /[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/g;

        data.emails = [
            ...new Set(data.pageText.match(emailRegex) || [])
        ];

        // =====================================
        // Phone Numbers
        // =====================================

        const phoneRegex =
            /(\+?\d[\d\s().-]{7,20}\d)/g;

        data.phones = [
            ...new Set(data.pageText.match(phoneRegex) || [])
        ];

        // =====================================
        // Social Links
        // =====================================

        data.social = {

            linkedin: [],
            github: [],
            facebook: [],
            instagram: [],
            twitter: [],
            youtube: [],
            tiktok: []

        };

        data.links.forEach(link => {

            const href = (link.href || "").toLowerCase();

            if (href.includes("linkedin.com"))
                data.social.linkedin.push(link.href);

            if (href.includes("github.com"))
                data.social.github.push(link.href);

            if (href.includes("facebook.com"))
                data.social.facebook.push(link.href);

            if (href.includes("instagram.com"))
                data.social.instagram.push(link.href);

            if (
                href.includes("twitter.com") ||
                href.includes("x.com")
            )
                data.social.twitter.push(link.href);

            if (href.includes("youtube.com"))
                data.social.youtube.push(link.href);

            if (href.includes("tiktok.com"))
                data.social.tiktok.push(link.href);

        });

        // =====================================
        // Experience
        // =====================================

        data.experience = [];

        const expMatch = data.pageText.match(
            /Experience([\s\S]*?)Education/i
        );

        if (expMatch) {

            data.experience = expMatch[1]
                .split("\n")
                .map(item => item.trim())
                .filter(item => item.length > 2)
                .slice(0, 30);

        }

        // =====================================
        // Education
        // =====================================

        data.education = [];

        const eduMatch = data.pageText.match(
            /Education([\s\S]*?)Skills/i
        );

        if (eduMatch) {

            data.education = eduMatch[1]
                .split("\n")
                .map(item => item.trim())
                .filter(item => item.length > 2)
                .slice(0, 30);

        }

        // =====================================
        // Skills
        // =====================================

        data.skills = [];

        const skillMatch = data.pageText.match(
            /Skills([\s\S]*)/i
        );

        if (skillMatch) {

            data.skills = skillMatch[1]
                .split("\n")
                .map(item => item.trim())
                .filter(item => item.length > 1)
                .slice(0, 100);

        }

        // =====================================
        // Remove Duplicate Values
        // =====================================

        data.images = [...new Set(data.images)];

        data.emails = [...new Set(data.emails)];

        data.phones = [...new Set(data.phones)];

        data.skills = [...new Set(data.skills)];

        data.experience = [...new Set(data.experience)];

        data.education = [...new Set(data.education)];
                // =====================================
        // Cleanup
        // =====================================

        delete data.pageText;

        // Remove duplicate social links

        Object.keys(data.social).forEach(key => {

            data.social[key] = [...new Set(data.social[key])];

        });

        // Add screenshot & PDF paths

        data.screenshot = path.join(folder, "linkedin.png");

        data.pdf = path.join(folder, "linkedin.pdf");

        // =====================================
        // Close Browser
        // =====================================

        await browser.close();

        return data;

    } catch (error) {

        try {

            await page.screenshot({

                path: path.join(folder, "linkedin-error.png"),

                fullPage: true

            });

        } catch (e) {

            // Ignore screenshot error

        }

        await browser.close();

        return {

            success: false,

            message: error.message,

            url,

            screenshot: path.join(folder, "linkedin-error.png")

        };

    }

}