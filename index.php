<?php
$arya_learning_path_post_id = function_exists('get_queried_object_id') ? (int) get_queried_object_id() : 0;
if (!$arya_learning_path_post_id && function_exists('get_the_ID')) {
  $arya_learning_path_post_id = (int) get_the_ID();
}

$arya_learning_path_meta_key = '_arya_learning_path_data';
$arya_learning_path_meta_raw = '';
$arya_learning_path_has_meta = false;
$arya_learning_path_data = array('categories' => array());

if ($arya_learning_path_post_id && function_exists('get_post_meta')) {
  $arya_learning_path_meta_raw = get_post_meta($arya_learning_path_post_id, $arya_learning_path_meta_key, true);
}

if (is_array($arya_learning_path_meta_raw)) {
  $arya_learning_path_data = $arya_learning_path_meta_raw;
  $arya_learning_path_has_meta = isset($arya_learning_path_data['categories']);
} elseif (is_string($arya_learning_path_meta_raw) && trim($arya_learning_path_meta_raw) !== '') {
  $arya_learning_path_decoded = json_decode($arya_learning_path_meta_raw, true);
  if (is_array($arya_learning_path_decoded) && isset($arya_learning_path_decoded['categories'])) {
    $arya_learning_path_data = $arya_learning_path_decoded;
    $arya_learning_path_has_meta = true;
  }
}

if (!isset($arya_learning_path_data['categories']) || !is_array($arya_learning_path_data['categories'])) {
  $arya_learning_path_data = array('categories' => array());
  $arya_learning_path_has_meta = false;
}

if (!function_exists('arya_learning_path_product_course_for_display')) {
  function arya_learning_path_product_course_for_display($course) {
    if (!is_array($course) || empty($course['product_id']) || !function_exists('wc_get_product')) {
      return is_array($course) ? $course : array();
    }

    $product_id = absint($course['product_id']);
    $product = $product_id ? wc_get_product($product_id) : false;

    if (!$product) {
      return $course;
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

    $duration = get_post_meta($product_id, '_duration', true);
    if (!$duration) {
      $duration = get_post_meta($product_id, 'duration', true);
    }

    $course['product_id'] = $product_id;
    $course['title'] = html_entity_decode($product->get_name(), ENT_QUOTES, get_bloginfo('charset'));
    $course['duration'] = $duration ? sanitize_text_field($duration) : (isset($course['duration']) ? $course['duration'] : '');
    $course['price'] = $price;
    $course['rating'] = (float) $product->get_average_rating();
    $course['link'] = get_permalink($product_id);
    $course['image'] = $image;
    $course['featured'] = (bool) $product->is_featured();

    return $course;
  }
}

if (!function_exists('arya_learning_path_hydrate_products_for_display')) {
  function arya_learning_path_hydrate_products_for_display($data) {
    if (!isset($data['categories']) || !is_array($data['categories'])) {
      return array('categories' => array());
    }

    $data['categories'] = arya_learning_path_hydrate_nodes_for_display($data['categories']);
    return $data;
  }
}

if (!function_exists('arya_learning_path_hydrate_nodes_for_display')) {
  function arya_learning_path_hydrate_nodes_for_display($nodes) {
    foreach ($nodes as $node_index => $node) {
      if (!is_array($node)) {
        continue;
      }

      if (isset($node['path']['courses']) && is_array($node['path']['courses'])) {
        foreach ($node['path']['courses'] as $course_index => $course) {
          $nodes[$node_index]['path']['courses'][$course_index] = arya_learning_path_product_course_for_display($course);
        }
      }

      if (isset($node['children']) && is_array($node['children'])) {
        $nodes[$node_index]['children'] = arya_learning_path_hydrate_nodes_for_display($node['children']);
      }
    }

    return $nodes;
  }
}

$arya_learning_path_data = arya_learning_path_hydrate_products_for_display($arya_learning_path_data);
$arya_learning_path_can_edit = $arya_learning_path_post_id && function_exists('current_user_can') && current_user_can('edit_post', $arya_learning_path_post_id);
$arya_learning_path_json_flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
$arya_learning_path_json = function_exists('wp_json_encode')
  ? wp_json_encode($arya_learning_path_data, $arya_learning_path_json_flags)
  : json_encode($arya_learning_path_data, $arya_learning_path_json_flags);
$arya_learning_path_config = array(
  'postId' => $arya_learning_path_post_id,
  'canEdit' => (bool) $arya_learning_path_can_edit,
  'ajaxUrl' => function_exists('admin_url') ? admin_url('admin-ajax.php') : '',
  'nonce' => ($arya_learning_path_can_edit && function_exists('wp_create_nonce')) ? wp_create_nonce('arya_learning_path_' . $arya_learning_path_post_id) : '',
  'actions' => array(
    'save' => 'arya_learning_path_save',
    'product' => 'arya_learning_path_product',
  ),
);
$arya_learning_path_config_json = function_exists('wp_json_encode')
  ? wp_json_encode($arya_learning_path_config, $arya_learning_path_json_flags)
  : json_encode($arya_learning_path_config, $arya_learning_path_json_flags);
?>
  <style>
    
    * {
        scroll-margin-top: 75px;
    }
    :root {
      --primary: #ff004c;
      --primary-soft: rgba(255, 0, 76, .12);
      --text: #111827;
      --muted: #6b7280;
      --card: #f9fafb;
      --border: #e5e7eb;
      --radius: 18px;
    }

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      background: #eae9e9;
      color: var(--text)
    }

    .app {
      max-width: 1080px;
      margin: auto;
      padding: 18px
    }

    .header {
      text-align: center;
      margin-bottom: 18px
    }

    .header h1 {
      margin: 0;
      font-size: 26px;
      font-weight: 900
    }

    .lead {
      color: var(--muted)
    }

    .level {
      margin-top: 18px
    }

    .tree {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 15px 5px;
    }

    .tree-item {
      background: #fff;
      border-radius: 16px;
      padding: 0;
      text-align: center;
      cursor: pointer;
      transition: .2s;
          border: 1px solid #e6e6e6ee;
    }

    .tree-item:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 26px rgba(0, 0, 0, .06);
    }

    .tree-item.active {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px var(--primary-soft);
    }

    .thumb {
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 8px;
      padding: 5px;
    }

    .thumb img {
      width: 80px;
      height: 80px;
      object-fit: cover;
    }

 
    .tree-item .desc {
      font-size: 11px;
      color: var(--muted)
    }
    .tree-item .title{
      font-size: 12px;
      font-weight: 800

    }

    .path-box {
      margin-top: 26px;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 16px;
    }

    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 12px;
      margin-top: 12px;
    }

    .course {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px;
    }

    .course img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
    }

    .course .title {
      font-weight: 800;
      margin-top: 6px
    }

    .meta {
      display: flex;
      justify-content: space-between;
      font-size: 13px;
      color: var(--muted)
    }

    .price {
      color: var(--primary);
      font-weight: 900
    }

    .course a {
      display: block;
      margin-top: 8px;
      text-align: center;
      padding: 8px;
      background: var(--primary);
      color: #fff;
      border-radius: 999px;
      text-decoration: none;
      font-weight: 700;
    }

    .sticky {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: #fff;
      border-top: 1px solid var(--border);
      padding: 10px;
      display: flex;
      gap: 8px;
      justify-content: center;
      z-index: 20;
    }

    .pill {
      padding: 8px 14px;
      border-radius: 999px;
      background: var(--primary-soft);
      color: var(--primary);
      font-weight: 700;
      font-size: 13px;
      cursor: pointer;
    }

    /* ====== Hero Section ====== */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      padding: 40px 20px;
      background: linear-gradient(135deg, #f7f9ff 0%, #ffffff 100%);
      border-radius: 18px;
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    /* محتوا */
    .hero__content {
      flex: 1;
      min-width: 280px;
    }

    /* متن */
    .hero__text {
      font-size: 22px;
      line-height: 1.5;
      color: #1f2a44;
      font-weight: 600;
      margin-bottom: 24px;
    }

    /* دکمه‌ها */
    .actions {
      display: flex;
      gap: 14px;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn-primary {
      padding: 12px 22px;
      border: none;
      border-radius: 12px;
      background: #2b6cff;
      color: #fff;
      font-weight: 700;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(43, 108, 255, 0.35);
    }

    .btn-call {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      border: 1px solid #d8e0f5;
      border-radius: 12px;
      background: #fff;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-call:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .avatars {
      display: flex;
      align-items: center;
      gap: -8px;
    }

    .avatars img {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: 2px solid #fff;
      object-fit: cover;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* ویدیو */
    #heroVideo, #heroImage {
      width: 520px;
      max-width: 100%;
      height: auto;
      border-radius: 18px;
      border: 1px solid #e8edf7;
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
    }

    /* ====== Responsive ====== */
    @media (max-width: 980px) {
      .hero {
        gap: 20px;
        padding: 30px 16px;
      }

      .hero__text {
        font-size: 20px;
      }

      #heroVideo {
        width: 420px;
      }
    }

    @media (max-width: 720px) {
      .hero {
        flex-direction: column;
        align-items: stretch;
      }

      .sticky{
        bottom: 62px;
      }

      #heroVideo {
        width: 100%;
        order: 2;
      }

      .hero__content {
        order: 1;
      }

      .actions {
        justify-content: flex-start;
      }
        .tree {
          grid-template-columns: repeat(auto-fill, minmax(106px, 1fr));
      }
    }

    .level-hint {
      background: #efefefee;
      border: 1px solid #ccce;
      border-radius: 5px;
      padding: 7px;
      margin-bottom: 10px;
    }

    .level-hint::before {
      content: "!";
      display: inline-block;
      width: 25px;
      height: 25px;
      text-align: center;
      vertical-align: middle;
      background: #ff004c;
      color: white;
      border-radius: 50%;
      margin-left: 7px;
    }
    .start {
    padding: 10px;
    margin-top: 20px;
    background: white;
    border-radius: 18px;
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.08);
}

    .lp-admin-box {
      margin-top: 14px;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px;
      box-shadow: 0 10px 24px rgba(0, 0, 0, .05);
      direction: rtl;
    }

    .lp-admin-box--empty {
      max-width: 1080px;
      margin: 18px auto 0;
      text-align: center;
    }

    .lp-admin-title {
      font-weight: 900;
      margin-bottom: 8px;
    }

    .lp-admin-actions,
    .lp-course-row__head,
    .lp-modal__head,
    .lp-modal__foot {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .lp-admin-actions,
    .lp-course-row__head,
    .lp-modal__head,
    .lp-modal__foot {
      justify-content: space-between;
    }

    .lp-admin-status {
      margin-top: 8px;
      min-height: 20px;
      color: var(--muted);
      font-weight: 700;
      font-size: 12px;
    }

    .lp-admin-status.is-error {
      color: #dc2626;
    }

    .lp-admin-status.is-success {
      color: #059669;
    }

    .lp-btn {
      border: 0;
      border-radius: 999px;
      padding: 8px 12px;
      cursor: pointer;
      color: #fff;
      background: var(--primary);
      font-weight: 800;
      font-size: 12px;
    }

    .lp-btn--secondary {
      background: #6b7280;
    }

    .lp-btn--success {
      background: #059669;
    }

    .lp-btn--warning {
      background: #d97706;
    }

    .lp-btn--danger {
      background: #dc2626;
    }

    .lp-btn:disabled {
      opacity: .55;
      cursor: not-allowed;
    }

    .lp-field {
      display: grid;
      gap: 6px;
      margin-bottom: 12px;
    }

    .lp-field label {
      font-weight: 800;
      color: #374151;
      font-size: 13px;
    }

    .lp-input,
    .lp-textarea,
    .lp-select {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      padding: 9px 10px;
      font: inherit;
      background: #fff;
    }

    .lp-textarea {
      min-height: 120px;
      resize: vertical;
      direction: rtl;
    }

    .lp-empty {
      padding: 14px;
      color: var(--muted);
      border: 1px dashed #d1d5db;
      border-radius: 12px;
      text-align: center;
    }

    .lp-modal {
      position: fixed;
      inset: 0;
      z-index: 10000;
      background: rgba(17, 24, 39, .55);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 18px;
      direction: rtl;
    }

    .lp-modal[hidden] {
      display: none !important;
    }

    .lp-modal__card {
      width: min(920px, 100%);
      max-height: 92vh;
      overflow: auto;
      background: #fff;
      border-radius: 18px;
      padding: 18px;
      box-shadow: 0 30px 80px rgba(0, 0, 0, .28);
    }

    .lp-modal__head,
    .lp-modal__foot {
      margin-bottom: 12px;
    }

    .lp-modal__head h3 {
      margin: 0 0 14px;
      font-size: 18px;
      font-weight: 900;
    }

    .lp-modal__grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px;
    }

    .lp-modal__full {
      grid-column: 1 / -1;
    }

    .lp-courses {
      display: grid;
      gap: 12px;
      margin: 14px 0;
    }

    .lp-course-row {
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px;
      background: #f9fafb;
    }

    .lp-course-row__head {
      margin-bottom: 10px;
      font-weight: 900;
    }

    .lp-product-tools {
      display: grid;
      grid-template-columns: minmax(120px, 1fr) auto;
      gap: 8px;
      align-items: end;
      margin-bottom: 12px;
      padding: 10px;
      background: #eef2ff;
      border-radius: 12px;
    }

    @media (max-width: 780px) {
      .lp-modal__grid {
        grid-template-columns: 1fr;
      }

      .lp-product-tools {
        grid-template-columns: 1fr;
      }
    }


  </style>


  <div class="app">
    <section class="hero" aria-label="hero">
      <div>
        <h1>از کجا شروع کنم؟</h1>
        <p>با تکمیل فرم زیر و یا تماس با کارشناسان ما به خوبی با مسیر یادگیری مهارت خود آشنا می شوید.</p>
        <div class="actions">
          <a class="btn-primary" href="#levels" id="startBtn">شروع مشاوره</a>
          <button class="btn-call" id="callBtn">
            <div class="avatars">

            </div>
            <span>☎ مشاوره تلفنی</span>
          </button>
        </div>
      </div>
    <img src="https://www.aryatehran.com/wp-content/uploads/2026/01/image_1769669423148768.webp" alt="" id="heroImage">
    </section>

    <div class="start">
    <h3>به کدام حوزه علاقه مند هستید؟ آن را انتخاب کنید</h3>
    <p>از میان دسته بندی های زیر گزینه ای که بدان علاقه مند هستید را انتخاب کنید تا با چند سوال ساده مسیر یادگیری موضوع دلخواه خود را بیابید! </p>
    </div>
    <section id="levels"></section>
    <section id="detailSection"></section>

  </div>

  <div id="sticky" class="sticky"></div>
  <?php if ($arya_learning_path_can_edit) : ?>
    <div id="lpEditorModal" class="lp-modal" hidden>
      <div class="lp-modal__card">
        <div class="lp-modal__head">
          <h3 id="lpModalTitle">ویرایش آیتم</h3>
          <button type="button" class="lp-btn lp-btn--secondary" id="lpCloseModal">بستن</button>
        </div>
        <div id="lpModalContent"></div>
      </div>
    </div>
  <?php endif; ?>

  <script>
    const ARYA_LEARNING_PATH_CONFIG = <?php echo $arya_learning_path_config_json; ?>;
    const ARYA_LEARNING_PATH_META_DATA = <?php echo $arya_learning_path_json; ?>;
    const ARYA_LEARNING_PATH_HAS_META = <?php echo $arya_learning_path_has_meta ? 'true' : 'false'; ?>;

    let DATA = normalizeLearningPathData(
      ARYA_LEARNING_PATH_HAS_META
        ? ARYA_LEARNING_PATH_META_DATA
        : (typeof def !== 'undefined' ? def : ARYA_LEARNING_PATH_META_DATA)
    );
    const levelsEl = document.getElementById('levels');
    const detailSection = document.getElementById('detailSection');
    const sticky = document.getElementById('sticky');

    let breadcrumb = [];
    let nodeMap = new Map();
    let selectedPath = null;
    let adminStatus = '';
    let adminStatusType = '';

    renderLanding();

    function normalizeLearningPathData(data) {
      if (typeof data === 'string') {
        try {
          data = JSON.parse(data);
        } catch (error) {
          data = {};
        }
      }
      if (!data || typeof data !== 'object' || !Array.isArray(data.categories)) {
        return { categories: [] };
      }
      return data;
    }

    function cloneLearningPathData(data) {
      return JSON.parse(JSON.stringify(normalizeLearningPathData(data)));
    }

    function renderLanding() {
      breadcrumb = [];
      nodeMap = new Map();
      levelsEl.innerHTML = '';
      detailSection.innerHTML = '';
      sticky.innerHTML = '';
      if (!DATA.categories || !DATA.categories.length) {
        renderAdminEmptyState();
        return;
      }
      renderLevel(DATA.categories || [], 0, {}, []);
    }

    function escapeHtml(value) {
      return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function coursePriceLabel(course) {
      if (course.priceLabel) {
        return course.priceLabel;
      }
      const price = Number(course.price || 0);
      return price > 0 ? formatPrice(price) : 'نیاز به استعلام';
    }

    function renderLevel(nodes, levelIndex, parent = {}, pathPrefix = []) {
      // پاک کردن همه سطوح از levelIndex به بعد
      const levels = [...levelsEl.children];
      for (let i = levels.length - 1; i >= levelIndex; i--) {
        levels[i].remove();
      }

      const level = document.createElement('div');
      level.className = 'level';
      const grid = document.createElement('div');
      grid.className = 'tree';

      (nodes || []).forEach((node, nodeIndex) => {
        const path = pathPrefix.concat(nodeIndex);
        const item = document.createElement('div');
        item.className = 'tree-item';
        item.dataset.id = node.id;
        item.innerHTML = `
      <div class="thumb"><img src="${escapeHtml(node.image || '')}" alt="${escapeHtml(node.title || '')}"></div>
      <div class="title">${escapeHtml(node.title || '')}</div>
      <div class="desc">${escapeHtml(node.description || '')}</div>
    `;

        nodeMap.set(node.id, item);

        item.onclick = () => {
          selectedPath = path;
          breadcrumb = breadcrumb.slice(0, levelIndex);
          breadcrumb.push({ id: node.id, title: node.title });
          updateSticky();

          document.querySelectorAll('.tree-item').forEach(i => i.classList.remove('active'));
          item.classList.add('active');

          if (node.children && node.children.length) {
            renderLevel(node.children, levelIndex + 1, node, path);
          } else {
            // اگر children ندارد، مطمئن شو سطوح بعدی پاک شده‌اند
            const levels = [...levelsEl.children];
            for (let i = levels.length - 1; i > levelIndex; i--) {
              levels[i].remove();
            }
          }

          if (node.path || ARYA_LEARNING_PATH_CONFIG.canEdit) {
            renderSelectedDetail(node, path);
            setTimeout(() => detailSection.scrollIntoView({ behavior: 'smooth' }), 100);
          } else {
            detailSection.innerHTML = '';
          }
        };

        grid.appendChild(item);
      });

      if (parent.childhint) {
        const hint = document.createElement('div');
        hint.classList.add('level-hint');
        hint.innerHTML = `${parent.childhint}`;
        level.appendChild(hint);
      }

      level.appendChild(grid);
      levelsEl.appendChild(level);

      // فقط اگر اولین سطح نیست، اسکرول کنیم
      if (levelIndex > 0) {
        level.scrollIntoView({ behavior: 'smooth' });
      }
    }

    function renderPath(path) {
      detailSection.innerHTML = getPathMarkup(path);
    }

    function updateSticky() {
      sticky.innerHTML = '';
      breadcrumb.forEach(b => {
        const pill = document.createElement('span');
        pill.className = 'pill';
        pill.textContent = b.title;
        pill.onclick = () => {
          const el = nodeMap.get(b.id);
          if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            document.querySelectorAll('.tree-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
          }
        };
        sticky.appendChild(pill);
      });
    }

    function formatPrice(n) {
      return new Intl.NumberFormat('fa-IR').format(n) + ' تومان';
    }

    initInlineLearningPathEditor();

    function initInlineLearningPathEditor() {
      if (!ARYA_LEARNING_PATH_CONFIG.canEdit) return;

      const modal = document.getElementById('lpEditorModal');
      const closeButton = document.getElementById('lpCloseModal');
      if (!modal || !closeButton) return;

      closeButton.addEventListener('click', closeEditorModal);
      modal.addEventListener('click', (event) => {
        if (event.target === modal) closeEditorModal();
      });
    }

    function createEditorNode() {
      return {
        id: 'node_' + Date.now() + '_' + Math.floor(Math.random() * 1000),
        title: 'زمینه جدید',
        description: '',
        childhint: '',
        image: 'https://images.unsplash.com/photo-1543353071-873f17a7a088',
        children: []
      };
    }

    function renderAdminEmptyState() {
      if (!ARYA_LEARNING_PATH_CONFIG.canEdit) return;
      levelsEl.innerHTML = `
        <div class="lp-admin-box lp-admin-box--empty">
          <div class="lp-admin-title">هنوز زمینه‌ای برای این مسیر ثبت نشده است.</div>
          <p>برای شروع، اولین زمینه را بسازید و سپس فرزند، توضیحات و دوره‌ها را روی همان کارت‌ها مدیریت کنید.</p>
          <button type="button" class="lp-btn lp-btn--success" id="lpCreateFirstNode">ایجاد زمینه اولیه</button>
          <div class="lp-admin-status ${adminStatusType ? 'is-' + adminStatusType : ''}">${escapeHtml(adminStatus)}</div>
        </div>
      `;
      document.getElementById('lpCreateFirstNode').addEventListener('click', () => {
        const node = createEditorNode();
        DATA.categories.push(node);
        selectedPath = [DATA.categories.length - 1];
        openNodeEditor(node, selectedPath);
        renderLanding();
      });
    }

    function renderSelectedDetail(node, path) {
      const adminMarkup = ARYA_LEARNING_PATH_CONFIG.canEdit ? getAdminControlsMarkup(node) : '';
      const pathMarkup = node.path ? getPathMarkup(node.path) : '';
      detailSection.innerHTML = adminMarkup + pathMarkup;
      bindAdminControls(node, path);
    }

    function getAdminControlsMarkup(node) {
      const coursesCount = node.path && Array.isArray(node.path.courses) ? node.path.courses.length : 0;
      return `
        <div class="lp-admin-box">
          <div class="lp-admin-title">مدیریت آیتم: ${escapeHtml(node.title || 'بدون عنوان')}</div>
          <div class="lp-admin-actions">
            <button type="button" class="lp-btn lp-btn--success" data-lp-action="add-child">افزودن فرزند</button>
            <button type="button" class="lp-btn" data-lp-action="edit-node">ویرایش توضیحات</button>
            <button type="button" class="lp-btn lp-btn--warning" data-lp-action="edit-courses">مدیریت دوره‌ها (${coursesCount})</button>
            <button type="button" class="lp-btn lp-btn--secondary" data-lp-action="save">ذخیره JSON</button>
            <button type="button" class="lp-btn lp-btn--danger" data-lp-action="delete">حذف آیتم</button>
          </div>
          <div class="lp-admin-status ${adminStatusType ? 'is-' + adminStatusType : ''}">${escapeHtml(adminStatus || 'تغییرات پس از ذخیره JSON در متای همین برگه ثبت می‌شود.')}</div>
        </div>
      `;
    }

    function bindAdminControls(node, path) {
      if (!ARYA_LEARNING_PATH_CONFIG.canEdit) return;

      detailSection.querySelectorAll('[data-lp-action]').forEach(button => {
        button.addEventListener('click', () => {
          const action = button.dataset.lpAction;
          if (action === 'add-child') {
            addChildNodeInline(node, path);
          } else if (action === 'edit-node' || action === 'edit-courses') {
            openNodeEditor(node, path, action === 'edit-courses' ? 'courses' : 'node');
          } else if (action === 'save') {
            saveLearningPathMeta(button);
          } else if (action === 'delete') {
            deleteNodeInline(path);
          }
        });
      });
    }

    function addChildNodeInline(node, path) {
      if (!Array.isArray(node.children)) node.children = [];
      const child = createEditorNode();
      node.children.push(child);
      selectedPath = path.concat(node.children.length - 1);
      openNodeEditor(child, selectedPath);
      setAdminStatus('فرزند جدید ایجاد شد. بعد از تکمیل فرم، ذخیره تغییرات را بزنید.', 'success');
    }

    function deleteNodeInline(path) {
      if (!confirm('آیا از حذف این آیتم و همه فرزندان آن مطمئن هستید؟')) return;
      getSiblingList(path).splice(path[path.length - 1], 1);
      selectedPath = null;
      saveLearningPathMeta(null, 'آیتم حذف شد و JSON ذخیره شد.');
    }

    function getNode(path) {
      let list = DATA.categories;
      let node = null;
      for (const index of path) {
        node = list[index];
        if (!node) return null;
        list = node.children || [];
      }
      return node;
    }

    function getSiblingList(path) {
      if (path.length === 1) return DATA.categories;
      const parent = getNode(path.slice(0, -1));
      if (!parent.children) parent.children = [];
      return parent.children;
    }

    function getPathMarkup(path) {
      const courses = Array.isArray(path.courses) ? path.courses : [];
      return `
    <div class="path-box" id="productSection">
      <h3>${escapeHtml(path.title || '')}</h3>
      <div class="discription">${path.description || ''}</div>
      <div class="course-grid">
        ${courses.map(c => `
          <div class="course">
            <img src="${escapeHtml(c.image || '')}" alt="${escapeHtml(c.title || '')}">
            <div class="title">${escapeHtml(c.title || '')}</div>
            <div class="meta">
              <span>${escapeHtml(c.duration || '')}</span>
              <span class="price">${escapeHtml(coursePriceLabel(c))}</span>
            </div>
            <a href="${escapeHtml(c.link || '#')}">مشاهده جزئیات دوره</a>
          </div>
        `).join('')}
      </div>
    </div>
  `;
    }

    function openNodeEditor(node, path, mode = 'node') {
      const modal = document.getElementById('lpEditorModal');
      const modalTitle = document.getElementById('lpModalTitle');
      const modalContent = document.getElementById('lpModalContent');
      if (!modal || !modalContent) return;

      const pathData = node.path || { title: '', description: '', courses: [] };
      const courses = Array.isArray(pathData.courses) ? JSON.parse(JSON.stringify(pathData.courses)) : [];

      modalTitle.textContent = mode === 'courses' ? 'مدیریت دوره‌ها' : 'ویرایش آیتم';
      modalContent.innerHTML = `
        <form id="lpNodeForm">
          <div class="lp-modal__grid">
            <div class="lp-field">
              <label for="lpNodeTitle">عنوان کارت</label>
              <input id="lpNodeTitle" class="lp-input" value="${escapeHtml(node.title || '')}">
            </div>
            <div class="lp-field">
              <label for="lpNodeId">شناسه ID</label>
              <input id="lpNodeId" class="lp-input" value="${escapeHtml(node.id || '')}">
            </div>
            <div class="lp-field lp-modal__full">
              <label for="lpNodeDescription">توضیحات کارت</label>
              <textarea id="lpNodeDescription" class="lp-textarea">${escapeHtml(node.description || '')}</textarea>
            </div>
            <div class="lp-field lp-modal__full">
              <label for="lpNodeChildhint">توضیح/راهنمای فرزندان</label>
              <textarea id="lpNodeChildhint" class="lp-textarea">${escapeHtml(node.childhint || '')}</textarea>
            </div>
            <div class="lp-field lp-modal__full">
              <label for="lpNodeImage">آدرس تصویر کارت</label>
              <input id="lpNodeImage" class="lp-input" value="${escapeHtml(node.image || '')}">
            </div>
            <div class="lp-field lp-modal__full">
              <label>
                <input type="checkbox" id="lpPathEnabled" ${node.path ? 'checked' : ''}>
                این آیتم مسیر آموزشی و دوره داشته باشد
              </label>
            </div>
            <div class="lp-field lp-modal__full">
              <label for="lpPathTitle">عنوان مسیر آموزشی</label>
              <input id="lpPathTitle" class="lp-input" value="${escapeHtml(pathData.title || '')}">
            </div>
            <div class="lp-field lp-modal__full">
              <label for="lpPathDescription">توضیحات مسیر آموزشی (HTML)</label>
              <textarea id="lpPathDescription" class="lp-textarea">${escapeHtml(pathData.description || '')}</textarea>
            </div>
          </div>
          <div class="lp-product-tools">
            <div class="lp-field" style="margin-bottom:0">
              <label for="lpProductId">افزودن دوره فقط با شناسه محصول</label>
              <input id="lpProductId" class="lp-input" inputmode="numeric" placeholder="مثلا 1234">
            </div>
            <button type="button" class="lp-btn lp-btn--warning" id="lpAddProductCourse">فراخوانی و افزودن</button>
          </div>
          <div id="lpCoursesEditor" class="lp-courses"></div>
          <div class="lp-modal__foot">
            <button type="submit" class="lp-btn lp-btn--success">ذخیره تغییرات</button>
            <button type="button" class="lp-btn lp-btn--secondary" id="lpCancelNode">انصراف</button>
          </div>
        </form>
      `;

      const coursesEl = document.getElementById('lpCoursesEditor');
      const productInput = document.getElementById('lpProductId');
      const addProductButton = document.getElementById('lpAddProductCourse');

      const renderCourses = () => {
        coursesEl.innerHTML = '';
        if (!courses.length) {
          coursesEl.innerHTML = '<div class="lp-empty">هیچ دوره‌ای اضافه نشده است. دوره‌ها باید با شناسه محصول فراخوانی شوند.</div>';
          return;
        }
        courses.forEach((course, index) => {
          const row = document.createElement('div');
          row.className = 'lp-course-row';
          row.dataset.index = String(index);
          row.innerHTML = `
            <div class="lp-course-row__head">
              <span>${escapeHtml(course.title || 'محصول بدون عنوان')}</span>
              <span>${escapeHtml(coursePriceLabel(course))}</span>
            </div>
            <div class="meta">
              <span>شناسه محصول: ${escapeHtml(course.product_id || 'ثبت نشده')}</span>
              <span>${escapeHtml(course.duration || '')}</span>
            </div>
            <div class="lp-admin-actions" style="margin-top:10px">
              <button type="button" class="lp-btn lp-btn--secondary" data-course-action="refresh">به‌روزرسانی از محصول</button>
              <button type="button" class="lp-btn lp-btn--secondary" data-course-action="up">بالا</button>
              <button type="button" class="lp-btn lp-btn--secondary" data-course-action="down">پایین</button>
              <button type="button" class="lp-btn lp-btn--danger" data-course-action="delete">حذف</button>
            </div>
          `;
          coursesEl.appendChild(row);
        });
      };

      addProductButton.addEventListener('click', () => {
        const productId = productInput.value.trim();
        if (!productId) {
          setAdminStatus('شناسه محصول را وارد کنید.', 'error');
          return;
        }
        fetchProductCourse(productId, addProductButton)
          .then(course => {
            courses.push(course);
            document.getElementById('lpPathEnabled').checked = true;
            productInput.value = '';
            renderCourses();
            setAdminStatus('دوره از محصول خوانده شد. برای ذخیره نهایی، تغییرات را ذخیره کنید.', 'success');
          })
          .catch(error => setAdminStatus(error.message, 'error'));
      });

      coursesEl.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-course-action]');
        if (!button) return;
        const index = Number(button.closest('.lp-course-row').dataset.index);
        const action = button.dataset.courseAction;
        if (action === 'delete') {
          courses.splice(index, 1);
          renderCourses();
        } else if (action === 'up' && index > 0) {
          const current = courses[index];
          courses[index] = courses[index - 1];
          courses[index - 1] = current;
          renderCourses();
        } else if (action === 'down' && index < courses.length - 1) {
          const current = courses[index];
          courses[index] = courses[index + 1];
          courses[index + 1] = current;
          renderCourses();
        } else if (action === 'refresh') {
          const productId = courses[index].product_id;
          if (!productId) {
            setAdminStatus('این دوره شناسه محصول ندارد.', 'error');
            return;
          }
          fetchProductCourse(productId, button)
            .then(course => {
              courses[index] = course;
              renderCourses();
              setAdminStatus('اطلاعات دوره از محصول به‌روز شد.', 'success');
            })
            .catch(error => setAdminStatus(error.message, 'error'));
        }
      });

      document.getElementById('lpCancelNode').addEventListener('click', closeEditorModal);
      document.getElementById('lpNodeForm').addEventListener('submit', (event) => {
        event.preventDefault();
        node.title = document.getElementById('lpNodeTitle').value.trim() || 'بدون عنوان';
        node.id = document.getElementById('lpNodeId').value.trim() || node.id;
        node.description = document.getElementById('lpNodeDescription').value;
        node.childhint = document.getElementById('lpNodeChildhint').value;
        node.image = document.getElementById('lpNodeImage').value;

        if (document.getElementById('lpPathEnabled').checked) {
          node.path = {
            title: document.getElementById('lpPathTitle').value,
            description: document.getElementById('lpPathDescription').value,
            courses
          };
        } else {
          delete node.path;
        }

        selectedPath = path;
        closeEditorModal();
        saveLearningPathMeta(null, 'تغییرات ذخیره شد.');
      });

      renderCourses();
      modal.hidden = false;

      if (mode === 'courses') {
        setTimeout(() => productInput.focus(), 50);
      }
    }

    function closeEditorModal() {
      const modal = document.getElementById('lpEditorModal');
      const modalContent = document.getElementById('lpModalContent');
      if (modal) modal.hidden = true;
      if (modalContent) modalContent.innerHTML = '';
    }

    function fetchProductCourse(productId, button) {
      const request = new FormData();
      request.append('action', ARYA_LEARNING_PATH_CONFIG.actions.product);
      request.append('nonce', ARYA_LEARNING_PATH_CONFIG.nonce);
      request.append('post_id', ARYA_LEARNING_PATH_CONFIG.postId);
      request.append('product_id', productId);

      if (button) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.textContent = 'در حال دریافت...';
      }

      return fetch(ARYA_LEARNING_PATH_CONFIG.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: request
      })
        .then(response => response.json())
        .then(response => {
          if (!response.success) {
            throw new Error(response.data && response.data.message ? response.data.message : 'خطا در دریافت محصول');
          }
          return response.data.course;
        })
        .finally(() => {
          if (button) {
            button.disabled = false;
            button.textContent = button.dataset.originalText || 'فراخوانی';
          }
        });
    }

    function saveLearningPathMeta(button = null, successMessage = 'JSON در دیتابیس ذخیره شد.') {
      if (!ARYA_LEARNING_PATH_CONFIG.canEdit) return Promise.resolve();
      if (!ARYA_LEARNING_PATH_CONFIG.ajaxUrl || !ARYA_LEARNING_PATH_CONFIG.nonce) {
        setAdminStatus('تنظیمات AJAX وردپرس در دسترس نیست.', 'error');
        return Promise.reject(new Error('تنظیمات AJAX وردپرس در دسترس نیست.'));
      }

      const request = new FormData();
      request.append('action', ARYA_LEARNING_PATH_CONFIG.actions.save);
      request.append('nonce', ARYA_LEARNING_PATH_CONFIG.nonce);
      request.append('post_id', ARYA_LEARNING_PATH_CONFIG.postId);
      request.append('data', JSON.stringify(DATA));

      if (button) button.disabled = true;
      setAdminStatus('در حال ذخیره JSON...', '');

      return fetch(ARYA_LEARNING_PATH_CONFIG.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: request
      })
        .then(response => response.json())
        .then(response => {
          if (!response.success) {
            throw new Error(response.data && response.data.message ? response.data.message : 'ذخیره انجام نشد');
          }
          DATA = normalizeLearningPathData(response.data.data || DATA);
          renderLanding();
          renderSelectedPathAfterRefresh();
          setAdminStatus(successMessage, 'success');
        })
        .catch(error => {
          setAdminStatus(error.message, 'error');
          throw error;
        })
        .finally(() => {
          if (button) button.disabled = false;
        });
    }

    function setAdminStatus(message, type) {
      adminStatus = message;
      adminStatusType = type || '';
      document.querySelectorAll('.lp-admin-status').forEach(statusEl => {
        statusEl.textContent = message;
        statusEl.classList.remove('is-success', 'is-error');
        if (type === 'success') statusEl.classList.add('is-success');
        if (type === 'error') statusEl.classList.add('is-error');
      });
    }

    function renderSelectedPathAfterRefresh() {
      if (!selectedPath) return;
      const node = getNode(selectedPath);
      if (node) {
        renderSelectedDetail(node, selectedPath);
      }
    }
  </script>