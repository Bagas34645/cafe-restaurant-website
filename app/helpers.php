<?php

if (!function_exists('cms_content')) {
  /**
   * Get content from CMS by key
   *
   * @param string $key
   * @param string|null $default
   * @return string|null
   */
  function cms_content($key, $default = null)
  {
    return \App\Models\Content::getByKey($key, $default);
  }
}

if (!function_exists('cms_content_with_meta')) {
  /**
   * Get content with metadata from CMS by key
   *
   * @param string $key
   * @return \App\Models\Content|null
   */
  function cms_content_with_meta($key)
  {
    return \App\Models\Content::getContentWithMeta($key);
  }
}

if (!function_exists('cms_image')) {
  /**
   * Get image URL from CMS content
   *
   * @param string $key
   * @param string|null $default
   * @return string
   */
  function cms_image($key, $default = null)
  {
    $imagePath = \App\Models\Content::getByKey($key, $default);

    if (!$imagePath) {
      return $default ?: asset('images/placeholder.jpg');
    }

    // Check if it's already a full path (starts with images/)
    if (str_starts_with($imagePath, 'images/')) {
      return asset($imagePath);
    }

    // Otherwise, it's stored in storage
    return asset('storage/' . $imagePath);
  }
}

if (!function_exists('cms_section')) {
  /**
   * Get all content for a specific section
   *
   * @param string $section
   * @return \Illuminate\Database\Eloquent\Collection
   */
  function cms_section($section)
  {
    return \App\Models\Content::active()->bySection($section)->orderBy('order')->get();
  }
}
