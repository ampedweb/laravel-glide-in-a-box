---
layout: page
title: Background
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/background
nav_order: 2
---
# Background
{: .no_toc }

See original Glide PHP background docs [here](https://glide.thephpleague.com/1.0/api/background/)

All descriptions in bold italics are directly quoted from the above docs.

Sets the background color of the image. See colors for more information on the available color formats.

[View all supported color formats here](https://glide.thephpleague.com/1.0/api/colors/)

Set the background colour of the image to blue

```php 
glide_url('/path/to/your_amazing_image.jpeg')->bg('blue')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->background('blue')->url()

//OR with HEX codes (greyish)

glide_url('/path/to/your_amazing_image.jpeg')->bg('CCC')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->background('CCC')->url()
```