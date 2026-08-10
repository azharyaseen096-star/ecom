import fs from "fs";
import path from "path";

import { launchBrowser } from "./browser.js";
import { unique, cleanText } from "./utils.js";


export async function scrapeWebsite(url) {


    const browser = await launchBrowser();

    const page = await browser.newPage();


    try {


        // ==========================
        // Browser Settings
        // ==========================


        await page.setViewport({

            width:1600,

            height:900

        });



        await page.setUserAgent(

            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/138.0 Safari/537.36"

        );



        await page.setExtraHTTPHeaders({

            "Accept-Language":
            "en-US,en;q=0.9"

        });



        // ==========================
        // Block Heavy Resources
        // ==========================


        await page.setRequestInterception(true);


        page.on("request", request => {


            const type = request.resourceType();


            if(

                type === "media" ||

                type === "font"

            ){

                request.abort();

            }

            else {

                request.continue();

            }


        });



        // ==========================
        // Open Website
        // ==========================


        try {


            await page.goto(url, {


                waitUntil:"domcontentloaded",


                timeout:60000


            });



        }

        catch(error){


            console.log(

                "Page load warning:",

                error.message

            );


        }



        await page.waitForTimeout(3000);
        // ==========================
// Screenshot Folder
// ==========================


const folder = path.join(

    process.cwd(),

    "screenshots"

);



if (!fs.existsSync(folder)) {


    fs.mkdirSync(folder, {

        recursive:true

    });


}



// ==========================
// Screenshot
// ==========================


try {


    await page.screenshot({


        path:path.join(

            folder,

            "page.png"

        ),


        fullPage:true


    });


}

catch(error){


    console.log(

        "Screenshot error:",

        error.message

    );


}



// ==========================
// PDF
// ==========================


try {


    await page.pdf({


        path:path.join(

            folder,

            "page.pdf"

        ),


        format:"A4",


        printBackground:true


    });


}

catch(error){


    console.log(

        "PDF error:",

        error.message

    );


}



// ==========================
// HTML
// ==========================


const html = await page.content();



// ==========================
// Page Data Extraction
// ==========================


const data = await page.evaluate(() => {


    const meta = (name) => {


        const el =

            document.querySelector(

                `meta[name="${name}"]`

            )

            ||

            document.querySelector(

                `meta[property="${name}"]`

            );



        return el ? el.content : "";

    };



    const title = document.title || "";



    const description = meta("description");



    const keywords = meta("keywords");



    const language =

        document.documentElement.lang || "";



    const canonical =

        document.querySelector(

            "link[rel='canonical']"

        )?.href || "";



    const favicon =

        document.querySelector(

            "link[rel*='icon']"

        )?.href || "";



    const og = {


        title:meta("og:title"),


        description:meta("og:description"),


        image:meta("og:image"),


        type:meta("og:type")


    };



    const headings = {};



    [

        "h1",

        "h2",

        "h3",

        "h4",

        "h5",

        "h6"

    ].forEach(tag => {


        headings[tag] =

            [

                ...document.querySelectorAll(tag)

            ]

            .map(item => item.innerText.trim())

            .filter(Boolean);


    });



    const paragraphs =

        [

            ...document.querySelectorAll("p")

        ]

        .map(p => p.innerText.trim())

        .filter(

            text => text.length > 20

        );



    const images =

        [

            ...document.images

        ]

        .map(img => img.src)

        .filter(Boolean);



    const links =

        [

            ...document.querySelectorAll("a")

        ]

        .map(a => ({

            text:a.innerText.trim(),

            href:a.href

        }))

        .filter(item => item.href);
        // ==========================
// Internal / External Links
// ==========================


const host = window.location.hostname;



const internalLinks = links.filter(link => {


    try {


        return new URL(link.href).hostname === host;


    }

    catch {


        return false;


    }


});



const externalLinks = links.filter(link => {


    try {


        return new URL(link.href).hostname !== host;


    }

    catch {


        return false;


    }


});



// ==========================
// Lists
// ==========================


const lists =

    [

        ...document.querySelectorAll("ul li, ol li")

    ]

    .map(li => li.innerText.trim())

    .filter(Boolean);




// ==========================
// Buttons
// ==========================


const buttons =

    [

        ...document.querySelectorAll("button")

    ]

    .map(btn => btn.innerText.trim())

    .filter(Boolean);




// ==========================
// Forms
// ==========================


const forms =

    [

        ...document.forms

    ]

    .map(form => ({


        action:form.action,


        method:form.method,


        id:form.id,


        name:form.name


    }));




// ==========================
// Tables
// ==========================


const tables =

    [

        ...document.querySelectorAll("table")

    ]

    .map(table => {


        return [

            ...table.rows

        ]

        .map(row => {


            return [

                ...row.cells

            ]

            .map(cell => cell.innerText.trim());


        });


    });




// ==========================
// Meta Tags
// ==========================


const metaTags =

    [

        ...document.querySelectorAll("meta")

    ]

    .map(meta => ({


        name:

            meta.getAttribute("name"),


        property:

            meta.getAttribute("property"),


        content:

            meta.getAttribute("content")


    }));




// ==========================
// Emails
// ==========================


const emailRegex =

/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/g;



const emails =

    [

        ...new Set(

            document.body.innerText.match(emailRegex) || []

        )

    ];




// ==========================
// Phones
// ==========================


const phoneRegex =

/(\+?\d[\d\s().-]{7,}\d)/g;



const phones =

    [

        ...new Set(

            document.body.innerText.match(phoneRegex) || []

        )

    ];




// ==========================
// Social Links
// ==========================


const social = {


    facebook:[],


    instagram:[],


    linkedin:[],


    github:[],


    twitter:[],


    youtube:[],


    tiktok:[]


};



links.forEach(link => {


    const href = link.href.toLowerCase();



    if(href.includes("facebook"))

        social.facebook.push(link.href);



    if(href.includes("instagram"))

        social.instagram.push(link.href);



    if(href.includes("linkedin"))

        social.linkedin.push(link.href);



    if(href.includes("github"))

        social.github.push(link.href);



    if(

        href.includes("twitter")

        ||

        href.includes("x.com")

    )

        social.twitter.push(link.href);



    if(href.includes("youtube"))

        social.youtube.push(link.href);



    if(href.includes("tiktok"))

        social.tiktok.push(link.href);


});




// ==========================
// Page Text
// ==========================


const pageText = document.body.innerText;




return {


    success:true,


    url:window.location.href,


    title,


    description,


    keywords,


    language,


    canonical,


    favicon,


    og,


    headings,


    paragraphs,


    images,


    links,


    internalLinks,


    externalLinks,


    lists,


    buttons,


    forms,


    tables,


    metaTags,


    emails,


    phones,


    social,


    pageText


};



});
// ==========================
// Clean Data
// ==========================


data.images = unique(

    data.images || []

);



data.paragraphs = unique(

    (data.paragraphs || [])

    .map(cleanText)

);



data.lists = unique(

    (data.lists || [])

    .map(cleanText)

);



data.buttons = unique(

    (data.buttons || [])

    .map(cleanText)

);



data.emails = unique(

    data.emails || []

);



data.phones = unique(

    data.phones || []

);



data.links = unique(

    data.links || []

);



data.internalLinks = unique(

    data.internalLinks || []

);



data.externalLinks = unique(

    data.externalLinks || []

);



data.pageText = cleanText(

    data.pageText || ""

);



Object.keys(data.social).forEach(key => {


    data.social[key] = unique(

        data.social[key]

    );


});




// ==========================
// Close Browser
// ==========================


await browser.close();




// ==========================
// Final Response
// ==========================


return {


    ...data,


    html,


    screenshot:

    "screenshots/page.png",


    pdf:

    "screenshots/page.pdf",



    stats:{


        images:

        data.images.length,



        links:

        data.links.length,



        internalLinks:

        data.internalLinks.length,



        externalLinks:

        data.externalLinks.length,



        emails:

        data.emails.length,



        phones:

        data.phones.length,



        headings:

        Object.values(data.headings)

        .reduce(

            (a,b)=>a+b.length,

            0

        ),



        paragraphs:

        data.paragraphs.length,



        buttons:

        data.buttons.length,



        forms:

        data.forms.length,



        tables:

        data.tables.length


    }


};



}

catch(error){



console.log(

    "SCRAPER ERROR:",

    error.message

);



try{


    await browser.close();


}

catch(e){}




return {


    success:false,


    message:

    "Website scraping failed",



    error:

    error.message


};



}



}