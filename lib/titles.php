<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'hylands-house');
    }
  } elseif (is_archive() || is_single()) {
    return __('Newsletters', 'hylands-house');
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'hylands-house'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'hylands-house');
  } else {
    return get_the_title();
  }
}