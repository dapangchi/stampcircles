/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dependencies = {
  layers: [
    {
      name: "../magiBrowse/main.js",
      layerDependencies: [],
      dependencies: ["magiBrowse.main"]
    }
  ],
  prefixes: [
      ["acmeDijit", "../../acmecorp/acmeDijit"],
      ["acmeLib", "../../acmecorp/acmeLib"],
      ["magiBrowse", "../../magiBrowse"]
  ]
}
