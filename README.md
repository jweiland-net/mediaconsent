# TYPO3 Extension `mediaconsent`

[![Latest Stable Version](https://poser.pugx.org/jweiland/mediaconsent/v/stable.svg)](https://packagist.org/packages/jweiland/mediaconsent)
[![TYPO3 12.4](https://img.shields.io/badge/TYPO3-12.4-green.svg)](https://get.typo3.org/version/12)
[![Total Downloads](https://poser.pugx.org/jweiland/mediaconsent/downloads.svg)](https://packagist.org/packages/jweiland/mediaconsent)
[![Monthly Downloads](https://poser.pugx.org/jweiland/mediaconsent/d/monthly)](https://packagist.org/packages/jweiland/mediaconsent)
![Build Status](https://github.com/jweiland-net/mediaconsent/actions/workflows/testscorev12.yml/badge.svg)

[View documentation in detail](https://docs.typo3.org/p/jweiland/mediaconsent/main/en-us/)

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
