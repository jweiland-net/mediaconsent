# TYPO3 Extension `mediaconsent`

[![Packagist][packagist-logo-stable]][extension-packagist-url]
[![Latest Stable Version][extension-build-shield]][extension-ter-url]
[![Total Downloads][extension-downloads-badge]][extension-packagist-url]
[![Monthly Downloads][extension-monthly-downloads]][extension-packagist-url]
[![TYPO3 13.4][TYPO3-shield]][TYPO3-13-url]

![Build Status](https://github.com/jweiland-net/mediaconsent/actions/workflows/ci.yml/badge.svg)

This extension loads HTML content only after the user has clicked on a short note expressing his/her agreement to see it.

It is useful for embedding HTML snippets (often called widgets) from social media content providers like Facebook, Twitter and others. If the user does not agree, no widget is shown and no personal data (IP number etc.) is transferred to the social media provider.

The extension provides a new content element called "Media Consent Opt-In" which has two specific fields: one for the HTML snippet embedding the content, another for selecting the content provider (Facebook, Twitter...)

## Routing

To make the extension work with TYPO3's new routing, you should add a page type suffix for the reload page type, similar to this example:

```
routeEnhancers:
  PageTypeSuffix:
    map:
      mediaconsent.html: 122
```
<!-- MARKDOWN LINKS & IMAGES -->

[extension-build-shield]: https://poser.pugx.org/jweiland/mediaconsent/v/stable.svg?style=for-the-badge

[extension-downloads-badge]: https://poser.pugx.org/jweiland/mediaconsent/d/total.svg?style=for-the-badge

[extension-monthly-downloads]: https://poser.pugx.org/jweiland/mediaconsent/d/monthly?style=for-the-badge

[extension-ter-url]: https://extensions.typo3.org/extension/mediaconsent/

[extension-packagist-url]: https://packagist.org/packages/jweiland/mediaconsent/

[packagist-logo-stable]: https://img.shields.io/badge/--grey.svg?style=for-the-badge&logo=packagist&logoColor=white

[TYPO3-13-url]: https://get.typo3.org/version/13

[TYPO3-shield]: https://img.shields.io/badge/TYPO3-13.4-green.svg?style=for-the-badge&logo=typo3
