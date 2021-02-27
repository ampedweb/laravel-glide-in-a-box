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

## [Unreleased]

### Changed
* Fit constants moved from Size trait to Fit interface
* Watermark constants moved from Watermark trait to Position interface
* Filter constants moved from Effects trait to Filter interface
* Rotation constants moved from Orientation trait to Rotate interface
* All traits moved to `Can` namespace and named appropriately  
  For example: `Effects` is now known as `HasEffects`

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
