<?php
/**
 * AJAX handlers for the visual learning-path landing editor.
 *
 * Include this file from the active theme functions.php:
 * require_once get_stylesheet_directory() . '/learning-path-functions.php';
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!defined('ARYA_LEARNING_PATH_META_KEY')) {
  define('ARYA_LEARNING_PATH_META_KEY', '_arya_learning_path_data');
}

if (!defined('ARYA_STUDY_PATH_META_KEY')) {
  define('ARYA_STUDY_PATH_META_KEY', '_arya_study_paths_data');
}

add_action('wp_ajax_arya_learning_path_save', 'arya_learning_path_save_ajax');
add_action('wp_ajax_arya_learning_path_product', 'arya_learning_path_product_ajax');
add_action('wp_ajax_arya_study_path_save', 'arya_study_path_save_ajax');

function arya_learning_path_verify_editor_request() {
  $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

  if (!$post_id || !current_user_can('edit_post', $post_id)) {
    wp_send_json_error(array('message' => 'شما اجازه ویرایش این برگه را ندارید.'), 403);
  }

  check_ajax_referer('arya_learning_path_' . $post_id, 'nonce');

  return $post_id;
}

function arya_study_path_verify_editor_request() {
  $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

  if (!$post_id || !current_user_can('edit_post', $post_id)) {
    wp_send_json_error(array('message' => 'شما اجازه ویرایش این برگه را ندارید.'), 403);
  }

  check_ajax_referer('arya_study_path_' . $post_id, 'nonce');

  return $post_id;
}

function arya_learning_path_save_ajax() {
  $post_id = arya_learning_path_verify_editor_request();

  if (!isset($_POST['data'])) {
    wp_send_json_error(array('message' => 'داده‌ای برای ذخیره ارسال نشده است.'), 400);
  }

  $raw_data = wp_unslash($_POST['data']);
  $decoded = json_decode($raw_data, true);

  if (!is_array($decoded) || !isset($decoded['categories']) || !is_array($decoded['categories'])) {
    wp_send_json_error(array('message' => 'ساختار JSON معتبر نیست.'), 400);
  }

  $sanitized = arya_learning_path_sanitize_data($decoded);
  update_post_meta(
    $post_id,
    ARYA_LEARNING_PATH_META_KEY,
    wp_json_encode($sanitized, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
  );

  wp_send_json_success(array('data' => $sanitized));
}

function arya_learning_path_product_ajax() {
  arya_learning_path_verify_editor_request();

  if (!function_exists('wc_get_product')) {
    wp_send_json_error(array('message' => 'WooCommerce در دسترس نیست.'), 400);
  }

  $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
  $product = $product_id ? wc_get_product($product_id) : false;

  if (!$product) {
    wp_send_json_error(array('message' => 'محصول پیدا نشد.'), 404);
  }

  $price = 0;
  if ($product->is_type('variable')) {
    $max_price = $product->get_variation_price('max', false);
    $price = $max_price !== '' ? (float) wc_get_price_to_display($product, array('price' => $max_price)) : 0;
  } else {
    $price = (float) wc_get_price_to_display($product);
  }

  $image_id = $product->get_image_id();
  $image = $image_id ? wp_get_attachment_image_url($image_id, 'medium_large') : '';
  if (!$image && function_exists('wc_placeholder_img_src')) {
    $image = wc_placeholder_img_src('medium_large');
  }

  $description = $product->get_short_description();
  if (!$description) {
    $description = wp_trim_words(wp_strip_all_tags($product->get_description()), 35, '...');
  }

  $duration = get_post_meta($product_id, '_duration', true);
  if (!$duration) {
    $duration = get_post_meta($product_id, 'duration', true);
  }

  wp_send_json_success(array(
    'course' => array(
      'product_id' => $product_id,
      'title' => html_entity_decode($product->get_name(), ENT_QUOTES, get_bloginfo('charset')),
      'duration' => sanitize_text_field($duration),
      'price' => $price,
      'rating' => (float) $product->get_average_rating(),
      'link' => get_permalink($product_id),
      'image' => esc_url_raw($image),
      'description' => wp_kses_post($description),
      'level' => 'متوسط',
      'featured' => (bool) $product->is_featured(),
    ),
  ));
}

function arya_study_path_save_ajax() {
  $post_id = arya_study_path_verify_editor_request();

  if (!isset($_POST['data'])) {
    wp_send_json_error(array('message' => 'داده‌ای برای ذخیره ارسال نشده است.'), 400);
  }

  $raw_data = wp_unslash($_POST['data']);
  $decoded = json_decode($raw_data, true);

  if (!is_array($decoded)) {
    wp_send_json_error(array('message' => 'ساختار JSON مسیر مطالعه معتبر نیست.'), 400);
  }

  $sanitized = arya_study_path_sanitize_paths($decoded);
  update_post_meta(
    $post_id,
    ARYA_STUDY_PATH_META_KEY,
    wp_json_encode($sanitized, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
  );

  wp_send_json_success(array('data' => $sanitized));
}

function arya_learning_path_sanitize_data($data) {
  $categories = isset($data['categories']) && is_array($data['categories']) ? $data['categories'] : array();

  return array(
    'categories' => arya_learning_path_sanitize_nodes($categories),
  );
}

function arya_learning_path_sanitize_nodes($nodes) {
  $sanitized = array();

  foreach ($nodes as $node) {
    if (!is_array($node)) {
      continue;
    }

    $item = array(
      'id' => isset($node['id']) ? sanitize_key($node['id']) : '',
      'title' => isset($node['title']) ? sanitize_text_field($node['title']) : '',
      'description' => isset($node['description']) ? sanitize_textarea_field($node['description']) : '',
      'childhint' => isset($node['childhint']) ? wp_kses_post($node['childhint']) : '',
      'image' => isset($node['image']) ? esc_url_raw($node['image']) : '',
    );

    if (isset($node['children']) && is_array($node['children'])) {
      $item['children'] = arya_learning_path_sanitize_nodes($node['children']);
    }

    if (isset($node['path']) && is_array($node['path'])) {
      $item['path'] = arya_learning_path_sanitize_path($node['path']);
    }

    $sanitized[] = $item;
  }

  return $sanitized;
}

function arya_learning_path_sanitize_path($path) {
  $courses = isset($path['courses']) && is_array($path['courses']) ? $path['courses'] : array();

  return array(
    'title' => isset($path['title']) ? sanitize_text_field($path['title']) : '',
    'description' => isset($path['description']) ? wp_kses_post($path['description']) : '',
    'courses' => arya_learning_path_sanitize_courses($courses),
  );
}

function arya_learning_path_sanitize_courses($courses) {
  $sanitized = array();

  foreach ($courses as $course) {
    if (!is_array($course)) {
      continue;
    }

    $price = isset($course['price']) ? (float) $course['price'] : 0;
    $rating = isset($course['rating']) ? (float) $course['rating'] : 0;

    $sanitized[] = array(
      'product_id' => isset($course['product_id']) ? absint($course['product_id']) : 0,
      'title' => isset($course['title']) ? sanitize_text_field($course['title']) : '',
      'duration' => isset($course['duration']) ? sanitize_text_field($course['duration']) : '',
      'price' => $price,
      'rating' => $rating,
      'link' => isset($course['link']) ? esc_url_raw($course['link']) : '',
      'image' => isset($course['image']) ? esc_url_raw($course['image']) : '',
      'description' => isset($course['description']) ? wp_kses_post($course['description']) : '',
      'level' => isset($course['level']) ? sanitize_text_field($course['level']) : '',
      'featured' => !empty($course['featured']),
    );
  }

  return $sanitized;
}

function arya_study_path_sanitize_paths($paths) {
  $sanitized = array();

  foreach ($paths as $key => $path) {
    if (!is_array($path)) {
      continue;
    }

    $safe_key = arya_study_path_sanitize_path_key($key);
    if (!$safe_key) {
      $safe_key = 'study-path-' . (count($sanitized) + 1);
    }

    while (isset($sanitized[$safe_key])) {
      $safe_key .= '-' . (count($sanitized) + 1);
    }

    $tags = array();
    if (isset($path['tags']) && is_array($path['tags'])) {
      foreach ($path['tags'] as $tag) {
        $tags[] = sanitize_text_field($tag);
      }
    }

    $sanitized[$safe_key] = array(
      'title' => isset($path['title']) ? sanitize_text_field($path['title']) : '',
      'short' => isset($path['short']) ? sanitize_textarea_field($path['short']) : '',
      'icon' => isset($path['icon']) ? sanitize_text_field($path['icon']) : '',
      'accent' => isset($path['accent']) ? arya_study_path_sanitize_accent($path['accent']) : '#a0e747',
      'audience' => isset($path['audience']) ? sanitize_text_field($path['audience']) : '',
      'duration' => isset($path['duration']) ? sanitize_text_field($path['duration']) : '',
      'level' => isset($path['level']) ? sanitize_text_field($path['level']) : '',
      'prerequisite' => isset($path['prerequisite']) ? sanitize_text_field($path['prerequisite']) : '',
      'description' => isset($path['description']) ? sanitize_textarea_field($path['description']) : '',
      'tags' => $tags,
      'roadmapTitle' => isset($path['roadmapTitle']) ? sanitize_text_field($path['roadmapTitle']) : '',
      'roadmapSubtitle' => isset($path['roadmapSubtitle']) ? sanitize_textarea_field($path['roadmapSubtitle']) : '',
      'items' => isset($path['items']) && is_array($path['items']) ? arya_study_path_sanitize_items($path['items']) : array(),
    );
  }

  return $sanitized;
}

function arya_study_path_sanitize_accent($accent) {
  $accent = sanitize_text_field($accent);
  if (function_exists('sanitize_hex_color')) {
    $hex = sanitize_hex_color($accent);
    if ($hex) {
      return $hex;
    }
  }

  return preg_match('/^#[0-9a-fA-F]{3,6}$/', $accent) ? $accent : '#a0e747';
}

function arya_study_path_sanitize_path_key($key) {
  $key = sanitize_text_field($key);
  $key = preg_replace('/[^A-Za-z0-9_-]+/', '-', $key);
  $key = trim($key, '-_');

  return $key;
}

function arya_study_path_sanitize_items($items) {
  $sanitized = array();

  foreach ($items as $item) {
    if (!is_array($item)) {
      continue;
    }

    $type = isset($item['type']) && $item['type'] === 'chapter' ? 'chapter' : 'lesson';

    if ($type === 'chapter') {
      $sanitized[] = array(
        'type' => 'chapter',
        'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
        'note' => isset($item['note']) ? sanitize_textarea_field($item['note']) : '',
      );
      continue;
    }

    $url = isset($item['url']) ? trim((string) $item['url']) : '#';
    if ($url !== '#') {
      $url = esc_url_raw($url);
    }
    if (!$url) {
      $url = '#';
    }

    $sanitized[] = array(
      'type' => 'lesson',
      'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
      'kind' => isset($item['kind']) ? sanitize_text_field($item['kind']) : '',
      'icon' => isset($item['icon']) ? sanitize_text_field($item['icon']) : '',
      'duration' => isset($item['duration']) ? sanitize_text_field($item['duration']) : '',
      'url' => $url,
    );
  }

  return $sanitized;
}
