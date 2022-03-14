# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

Types of changes

* **Features** for initial package features.
* **Added** for new features.
* **Changed** for changes in existing functionality.
* **Deprecated** for soon-to-be removed features.
* **Removed** for now removed features.
* **Fixed** for any bug fixes.
* **Security** in case of vulnerabilities.

## 0.5.0 - 2022-03-14
### Changed
* Upgraded minimum dependency ampedweb/glide-url-helper to 0.3
* Updated feature tests.

## 0.4.1 - 2021-10-15
### Fixed
* Prevent runtime error when filename is full.

## 0.4 - 2021-09-09
### Changed
* Allow glide_url result to be printed directly

## 0.2.2 - 2021-06-11
### Fixed
* fix for unit tests

## 0.2.1 - 2021-05-22
### Fixed
* fix for config to allow for caching.

## 0.2.0 - 2021-03-20

### Changed
* glide_url helper function handles null input gracefully
* Fit constants moved from Size trait to Fit interface
* Watermark constants moved from Watermark trait to Position interface
* Filter constants moved from Effects trait to Filter interface
* Rotation constants moved from Orientation trait to Rotate interface
* All traits moved to `Can` namespace and named appropriately  
  For example: `Effects` is now known as `HasEffects`
* Crop constants moved from Crop trait to Crop interface
* Border constants moved from Border trait to Border interface

### Fixed
* GlideServerServiceProvider crashes when not given an instance of AdapterInterface for watermarkPath.  
  This is done by either passing the configuration paramater directly or, if it is not an instance of 
  AdapterInterface, wrapping it in a Local filesystem instance before passing it.

## 0.1.0

### Added
* .gitignore
* PHP extension requirements
* Orientation trait
* Encode trait
* Crop trait
* Flip Trait
* Size Trait
* PixelDensity Trait
* Adjustment Trait
* Effects Trait
* Border Trait
* DimensionParser Trait
* ColourParser Trait
* Background Trait
* Watermarks Trait

### Changed
* GlideUrl::preset starts an image builder instead of returning an image URL

### Fixed
* Broken unit tests in ImageResponseTest

## 1.0.0 - [Date]

### Features
### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security


[Unreleased]: https://github.com/GinoPane/composer-package-template/compare/v1.0.0...HEAD
