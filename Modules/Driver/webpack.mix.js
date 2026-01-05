const dotenvExpand = require("dotenv-expand");
dotenvExpand(
    require("dotenv").config({
        path: "../../.env",
    })
);

const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

/**
 * Set Laravel public path
 * This ensures assets are generated into /public
 */
mix.setPublicPath("../../public").mergeManifest();

/**
 * Driver module assets
 */
mix.js(__dirname + "/Resources/assets/js/app.js", "js/driver.js").sass(
    __dirname + "/Resources/assets/sass/app.scss",
    "css/driver.css"
);

/**
 * Versioning for production
 */
if (mix.inProduction()) {
    mix.version();
}
