---
layout: page
title: Border
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/border
nav_order: 3
---
# Border
{: .no_toc }

See original Glide PHP border docs [here](https://glide.thephpleague.com/1.0/api/border/)

All descriptions in bold italics are directly quoted from the above docs.

***Add a border to the image. Required format: width,color,method.***

[View all supported color formats here](https://glide.thephpleague.com/1.0/api/colors/)

### Method
Sets how the border will be displayed. Available options:
<dl>
  <dt>overlay</dt>
  <dd>Place border on top of image (default).</dd>
  <dt>shrink</dt>
  <dd>Shrink image within border (canvas does not change).</dd>
  <dt>expand</dt>
  <dd>Expands canvas to accommodate border.</dd>
</dl>

Set a blue, 10px wide border, overlayed on top of the image.


```php 
glide_url('/path/to/your_amazing_image.jpeg')->border('10','blue','overlay')->url()
```