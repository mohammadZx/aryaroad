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

    .lp-editor {
      max-width: 1080px;
      margin: 24px auto 90px;
      padding: 16px;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 14px 40px rgba(0, 0, 0, .06);
      direction: rtl;
      font-size: 14px;
    }

    .lp-editor[hidden],
    .lp-editor__body[hidden],
    .lp-hidden {
      display: none !important;
    }

    .lp-editor__header,
    .lp-editor__actions,
    .lp-editor__node-head,
    .lp-course-row__head {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .lp-editor__header {
      justify-content: space-between;
    }

    .lp-editor__header h2 {
      margin: 0;
      font-size: 18px;
      font-weight: 900;
    }

    .lp-editor__body {
      margin-top: 16px;
      display: grid;
      grid-template-columns: minmax(0, 2fr) minmax(260px, 1fr);
      gap: 16px;
    }

    .lp-editor__panel {
      background: #f9fafb;
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px;
    }

    .lp-editor__panel h3 {
      margin: 0 0 10px;
      font-size: 15px;
      font-weight: 900;
    }

    .lp-editor__tree {
      display: grid;
      gap: 10px;
    }

    .lp-editor__node {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 10px;
    }

    .lp-editor__node-head {
      justify-content: space-between;
    }

    .lp-editor__node-title {
      font-weight: 900;
    }

    .lp-editor__node-meta {
      margin-top: 6px;
      color: var(--muted);
      font-size: 12px;
      line-height: 1.8;
    }

    .lp-editor__children {
      margin: 10px 14px 0 0;
      padding-right: 12px;
      border-right: 2px solid var(--border);
      display: grid;
      gap: 10px;
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

    .lp-json-draft {
      min-height: 300px;
      direction: ltr;
      text-align: left;
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
      font-size: 12px;
    }

    .lp-status {
      min-height: 20px;
      color: var(--muted);
      font-weight: 700;
    }

    .lp-status.is-error {
      color: #dc2626;
    }

    .lp-status.is-success {
      color: #059669;
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
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
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
      justify-content: space-between;
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
      .lp-editor__body,
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
    <section id="learningPathEditor" class="lp-editor" aria-label="ویرایشگر مسیر آموزشی">
      <div class="lp-editor__header">
        <div>
          <h2>ویرایش بصری مسیر آموزشی</h2>
          <div class="lp-status" id="lpEditorStatus">تغییرات بعد از ذخیره به متای همین برگه منتقل می‌شود.</div>
        </div>
        <div class="lp-editor__actions">
          <button type="button" class="lp-btn lp-btn--secondary" id="lpToggleEditor">نمایش/مخفی کردن ویرایشگر</button>
          <button type="button" class="lp-btn lp-btn--success" id="lpSaveMeta">ذخیره در متا</button>
        </div>
      </div>
      <div class="lp-editor__body" id="lpEditorBody" hidden>
        <div class="lp-editor__panel">
          <div class="lp-editor__header">
            <h3>ساختار دسته‌بندی‌ها</h3>
            <button type="button" class="lp-btn lp-btn--success" id="lpAddRoot">افزودن دسته‌بندی ریشه</button>
          </div>
          <div id="lpEditorTree" class="lp-editor__tree"></div>
        </div>
        <div class="lp-editor__panel">
          <h3>JSON موقت و قابل اعمال</h3>
          <div class="lp-field">
            <label for="lpJsonDraft">در صورت نیاز JSON را دستی ویرایش کنید و سپس روی اعمال JSON بزنید.</label>
            <textarea id="lpJsonDraft" class="lp-textarea lp-json-draft" spellcheck="false"></textarea>
          </div>
          <div class="lp-editor__actions">
            <button type="button" class="lp-btn lp-btn--warning" id="lpApplyJson">اعمال JSON</button>
            <button type="button" class="lp-btn lp-btn--secondary" id="lpCopyJson">کپی JSON</button>
          </div>
        </div>
      </div>
    </section>
    <div id="lpEditorModal" class="lp-modal" hidden>
      <div class="lp-modal__card">
        <div class="lp-modal__head">
          <h3 id="lpModalTitle">ویرایش گره</h3>
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
      renderLevel(DATA.categories || [], 0);
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

    function renderLevel(nodes, levelIndex, parent = {}) {
      // پاک کردن همه سطوح از levelIndex به بعد
      const levels = [...levelsEl.children];
      for (let i = levels.length - 1; i >= levelIndex; i--) {
        levels[i].remove();
      }

      const level = document.createElement('div');
      level.className = 'level';
      const grid = document.createElement('div');
      grid.className = 'tree';

      (nodes || []).forEach(node => {
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
          breadcrumb = breadcrumb.slice(0, levelIndex);
          breadcrumb.push({ id: node.id, title: node.title });
          updateSticky();

          document.querySelectorAll('.tree-item').forEach(i => i.classList.remove('active'));
          item.classList.add('active');

          if (node.children && node.children.length) {
            renderLevel(node.children, levelIndex + 1, node);
          } else {
            // اگر children ندارد، مطمئن شو سطوح بعدی پاک شده‌اند
            const levels = [...levelsEl.children];
            for (let i = levels.length - 1; i > levelIndex; i--) {
              levels[i].remove();
            }
          }

          if (node.path) {
            renderPath(node.path);
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
      const courses = Array.isArray(path.courses) ? path.courses : [];
      detailSection.innerHTML = `
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

    initLearningPathEditor();

    function initLearningPathEditor() {
      if (!ARYA_LEARNING_PATH_CONFIG.canEdit) return;

      const editor = document.getElementById('learningPathEditor');
      const body = document.getElementById('lpEditorBody');
      const treeEl = document.getElementById('lpEditorTree');
      const statusEl = document.getElementById('lpEditorStatus');
      const jsonDraft = document.getElementById('lpJsonDraft');
      const modal = document.getElementById('lpEditorModal');
      const modalTitle = document.getElementById('lpModalTitle');
      const modalContent = document.getElementById('lpModalContent');
      let editorData = cloneLearningPathData(DATA);

      if (!editor || !body || !treeEl || !jsonDraft || !modal) return;

      document.getElementById('lpToggleEditor').addEventListener('click', () => {
        body.hidden = !body.hidden;
      });

      document.getElementById('lpAddRoot').addEventListener('click', () => {
        editorData.categories.push(createEditorNode());
        renderEditorTree();
      });

      document.getElementById('lpApplyJson').addEventListener('click', () => {
        try {
          editorData = normalizeLearningPathData(JSON.parse(jsonDraft.value));
          DATA = cloneLearningPathData(editorData);
          renderLanding();
          renderEditorTree();
          setEditorStatus('JSON روی پیش‌نمایش اعمال شد. برای ماندگاری، ذخیره در متا را بزنید.', 'success');
        } catch (error) {
          setEditorStatus('JSON معتبر نیست: ' + error.message, 'error');
        }
      });

      document.getElementById('lpCopyJson').addEventListener('click', () => {
        navigator.clipboard.writeText(jsonDraft.value).then(() => {
          setEditorStatus('JSON کپی شد.', 'success');
        }).catch(() => {
          setEditorStatus('امکان کپی خودکار وجود نداشت.', 'error');
        });
      });

      document.getElementById('lpSaveMeta').addEventListener('click', saveEditorMeta);
      document.getElementById('lpCloseModal').addEventListener('click', closeModal);
      modal.addEventListener('click', (event) => {
        if (event.target === modal) closeModal();
      });

      renderEditorTree();

      function createEditorNode() {
        return {
          id: 'node_' + Date.now() + '_' + Math.floor(Math.random() * 1000),
          title: 'عنوان جدید',
          description: '',
          childhint: '',
          image: 'https://images.unsplash.com/photo-1543353071-873f17a7a088',
          children: []
        };
      }

      function createEditorCourse() {
        return {
          product_id: '',
          title: 'دوره جدید',
          duration: '',
          price: 0,
          rating: 0,
          link: '#',
          image: '',
          description: '',
          level: 'متوسط',
          featured: false
        };
      }

      function renderEditorTree() {
        treeEl.innerHTML = '';
        if (!editorData.categories.length) {
          treeEl.innerHTML = '<div class="lp-empty">هیچ دسته‌بندی ثبت نشده است.</div>';
        } else {
          editorData.categories.forEach((node, index) => {
            treeEl.appendChild(renderEditorNode(node, [index]));
          });
        }
        updateDraftJson();
      }

      function renderEditorNode(node, path) {
        const nodeEl = document.createElement('article');
        nodeEl.className = 'lp-editor__node';

        const head = document.createElement('div');
        head.className = 'lp-editor__node-head';
        head.innerHTML = `
          <div>
            <div class="lp-editor__node-title">${escapeHtml(node.title || 'بدون عنوان')}</div>
            <div class="lp-editor__node-meta">شناسه: ${escapeHtml(node.id || '')}</div>
          </div>
        `;

        const actions = document.createElement('div');
        actions.className = 'lp-editor__actions';
        actions.appendChild(makeButton('ویرایش', 'lp-btn', () => openNodeModal(path)));
        actions.appendChild(makeButton('افزودن فرزند', 'lp-btn lp-btn--success', () => {
          if (!Array.isArray(node.children)) node.children = [];
          node.children.push(createEditorNode());
          renderEditorTree();
        }));
        actions.appendChild(makeButton('بالا', 'lp-btn lp-btn--secondary', () => moveNode(path, -1)));
        actions.appendChild(makeButton('پایین', 'lp-btn lp-btn--secondary', () => moveNode(path, 1)));
        actions.appendChild(makeButton('حذف', 'lp-btn lp-btn--danger', () => deleteNode(path)));
        head.appendChild(actions);
        nodeEl.appendChild(head);

        const meta = document.createElement('div');
        meta.className = 'lp-editor__node-meta';
        const courseCount = node.path && Array.isArray(node.path.courses) ? node.path.courses.length : 0;
        meta.innerHTML = `
          ${node.description ? '<div>توضیحات: ' + escapeHtml(node.description).slice(0, 120) + '</div>' : ''}
          ${node.childhint ? '<div>راهنمای فرزند: ' + escapeHtml(node.childhint).slice(0, 120) + '</div>' : ''}
          ${node.path ? '<div>مسیر آموزشی: ' + escapeHtml(node.path.title || '') + ' / دوره‌ها: ' + courseCount + '</div>' : ''}
        `;
        nodeEl.appendChild(meta);

        if (Array.isArray(node.children) && node.children.length) {
          const childrenEl = document.createElement('div');
          childrenEl.className = 'lp-editor__children';
          node.children.forEach((child, index) => {
            childrenEl.appendChild(renderEditorNode(child, path.concat(index)));
          });
          nodeEl.appendChild(childrenEl);
        }

        return nodeEl;
      }

      function makeButton(text, className, onClick) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = className;
        button.textContent = text;
        button.addEventListener('click', onClick);
        return button;
      }

      function getNode(path) {
        let list = editorData.categories;
        let node = null;
        for (const index of path) {
          node = list[index];
          if (!node) return null;
          list = node.children || [];
        }
        return node;
      }

      function getSiblingList(path) {
        if (path.length === 1) return editorData.categories;
        const parent = getNode(path.slice(0, -1));
        if (!parent.children) parent.children = [];
        return parent.children;
      }

      function moveNode(path, direction) {
        const siblings = getSiblingList(path);
        const index = path[path.length - 1];
        const nextIndex = index + direction;
        if (nextIndex < 0 || nextIndex >= siblings.length) return;
        const current = siblings[index];
        siblings[index] = siblings[nextIndex];
        siblings[nextIndex] = current;
        renderEditorTree();
      }

      function deleteNode(path) {
        if (!confirm('آیا از حذف این مورد و همه فرزندان آن مطمئن هستید؟')) return;
        getSiblingList(path).splice(path[path.length - 1], 1);
        renderEditorTree();
      }

      function openNodeModal(path) {
        const node = getNode(path);
        if (!node) return;
        const pathData = node.path || { title: '', description: '', courses: [] };
        const courses = Array.isArray(pathData.courses) ? JSON.parse(JSON.stringify(pathData.courses)) : [];

        modalTitle.textContent = 'ویرایش: ' + (node.title || 'بدون عنوان');
        modalContent.innerHTML = `
          <form id="lpNodeForm">
            <div class="lp-modal__grid">
              <div class="lp-field">
                <label for="lpNodeTitle">عنوان</label>
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
                <label for="lpNodeChildhint">راهنمای سطح بعدی (HTML مجاز)</label>
                <textarea id="lpNodeChildhint" class="lp-textarea">${escapeHtml(node.childhint || '')}</textarea>
              </div>
              <div class="lp-field lp-modal__full">
                <label for="lpNodeImage">آدرس تصویر</label>
                <input id="lpNodeImage" class="lp-input" value="${escapeHtml(node.image || '')}">
              </div>
              <div class="lp-field lp-modal__full">
                <label>
                  <input type="checkbox" id="lpPathEnabled" ${node.path ? 'checked' : ''}>
                  فعال بودن مسیر آموزشی برای این گره
                </label>
              </div>
              <div class="lp-field lp-modal__full">
                <label for="lpPathTitle">عنوان مسیر</label>
                <input id="lpPathTitle" class="lp-input" value="${escapeHtml(pathData.title || '')}">
              </div>
              <div class="lp-field lp-modal__full">
                <label for="lpPathDescription">توضیحات مسیر (HTML)</label>
                <textarea id="lpPathDescription" class="lp-textarea">${escapeHtml(pathData.description || '')}</textarea>
              </div>
            </div>
            <div class="lp-modal__head">
              <h3>دوره‌ها</h3>
              <button type="button" class="lp-btn lp-btn--success" id="lpAddCourse">افزودن دوره</button>
            </div>
            <div id="lpCoursesEditor" class="lp-courses"></div>
            <div class="lp-modal__foot">
              <button type="submit" class="lp-btn lp-btn--success">ذخیره تغییرات گره</button>
              <button type="button" class="lp-btn lp-btn--secondary" id="lpCancelNode">انصراف</button>
            </div>
          </form>
        `;

        const coursesEl = document.getElementById('lpCoursesEditor');
        const renderCourses = () => {
          coursesEl.innerHTML = '';
          if (!courses.length) {
            coursesEl.innerHTML = '<div class="lp-empty">هیچ دوره‌ای ثبت نشده است.</div>';
            return;
          }
          courses.forEach((course, index) => coursesEl.appendChild(renderCourseRow(course, index)));
        };

        document.getElementById('lpAddCourse').addEventListener('click', () => {
          syncCoursesFromRows();
          courses.push(createEditorCourse());
          renderCourses();
        });
        document.getElementById('lpCancelNode').addEventListener('click', closeModal);
        document.getElementById('lpNodeForm').addEventListener('submit', (event) => {
          event.preventDefault();
          node.title = document.getElementById('lpNodeTitle').value.trim();
          node.id = document.getElementById('lpNodeId').value.trim() || node.id;
          node.description = document.getElementById('lpNodeDescription').value;
          node.childhint = document.getElementById('lpNodeChildhint').value;
          node.image = document.getElementById('lpNodeImage').value;
          if (document.getElementById('lpPathEnabled').checked) {
            node.path = {
              title: document.getElementById('lpPathTitle').value,
              description: document.getElementById('lpPathDescription').value,
              courses: collectCoursesFromModal()
            };
          } else {
            delete node.path;
          }
          DATA = cloneLearningPathData(editorData);
          renderLanding();
          renderEditorTree();
          closeModal();
          setEditorStatus('تغییرات در پیش‌نمایش اعمال شد. برای ذخیره دائمی، ذخیره در متا را بزنید.', 'success');
        });

        coursesEl.addEventListener('click', (event) => {
          const button = event.target.closest('button[data-course-action]');
          if (!button) return;
          const row = button.closest('.lp-course-row');
          const index = Number(row.dataset.index);
          const action = button.dataset.courseAction;
          if (action !== 'product') {
            syncCoursesFromRows();
          }
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
          } else if (action === 'product') {
            fetchProductIntoRow(row, button);
          }
        });

        renderCourses();
        modal.hidden = false;

        function syncCoursesFromRows() {
          courses.splice(0, courses.length, ...collectCoursesFromModal());
        }
      }

      function renderCourseRow(course, index) {
        const row = document.createElement('div');
        row.className = 'lp-course-row';
        row.dataset.index = String(index);
        row.innerHTML = `
          <div class="lp-course-row__head">
            <span>دوره ${index + 1}: ${escapeHtml(course.title || 'بدون عنوان')}</span>
            <span class="lp-editor__actions">
              <button type="button" class="lp-btn lp-btn--secondary" data-course-action="up">بالا</button>
              <button type="button" class="lp-btn lp-btn--secondary" data-course-action="down">پایین</button>
              <button type="button" class="lp-btn lp-btn--danger" data-course-action="delete">حذف</button>
            </span>
          </div>
          <div class="lp-product-tools">
            <div class="lp-field" style="margin-bottom:0">
              <label>شناسه محصول ووکامرس</label>
              <input class="lp-input" data-course-field="product_id" value="${escapeHtml(course.product_id || '')}" inputmode="numeric">
            </div>
            <button type="button" class="lp-btn lp-btn--warning" data-course-action="product">دریافت از محصول</button>
          </div>
          <div class="lp-modal__grid">
            <div class="lp-field">
              <label>عنوان دوره</label>
              <input class="lp-input" data-course-field="title" value="${escapeHtml(course.title || '')}">
            </div>
            <div class="lp-field">
              <label>مدت زمان</label>
              <input class="lp-input" data-course-field="duration" value="${escapeHtml(course.duration || '')}">
            </div>
            <div class="lp-field">
              <label>قیمت (تومان)</label>
              <input type="number" class="lp-input" data-course-field="price" value="${escapeHtml(course.price || 0)}">
            </div>
            <div class="lp-field">
              <label>امتیاز</label>
              <input type="number" step="0.1" class="lp-input" data-course-field="rating" value="${escapeHtml(course.rating || 0)}">
            </div>
            <div class="lp-field lp-modal__full">
              <label>لینک دوره</label>
              <input class="lp-input" data-course-field="link" value="${escapeHtml(course.link || '#')}">
            </div>
            <div class="lp-field lp-modal__full">
              <label>آدرس تصویر</label>
              <input class="lp-input" data-course-field="image" value="${escapeHtml(course.image || '')}">
            </div>
            <div class="lp-field">
              <label>سطح</label>
              <select class="lp-select" data-course-field="level">
                <option value="مقدماتی" ${course.level === 'مقدماتی' ? 'selected' : ''}>مقدماتی</option>
                <option value="متوسط" ${!course.level || course.level === 'متوسط' ? 'selected' : ''}>متوسط</option>
                <option value="پیشرفته" ${course.level === 'پیشرفته' ? 'selected' : ''}>پیشرفته</option>
              </select>
            </div>
            <div class="lp-field">
              <label>
                <input type="checkbox" data-course-field="featured" ${course.featured ? 'checked' : ''}>
                دوره ویژه
              </label>
            </div>
            <div class="lp-field lp-modal__full">
              <label>توضیحات دوره</label>
              <textarea class="lp-textarea" data-course-field="description">${escapeHtml(course.description || '')}</textarea>
            </div>
          </div>
        `;
        return row;
      }

      function collectCoursesFromModal() {
        return [...document.querySelectorAll('#lpCoursesEditor .lp-course-row')].map(row => ({
          product_id: row.querySelector('[data-course-field="product_id"]').value.trim(),
          title: row.querySelector('[data-course-field="title"]').value,
          duration: row.querySelector('[data-course-field="duration"]').value,
          price: Number(row.querySelector('[data-course-field="price"]').value || 0),
          rating: Number(row.querySelector('[data-course-field="rating"]').value || 0),
          link: row.querySelector('[data-course-field="link"]').value,
          image: row.querySelector('[data-course-field="image"]').value,
          description: row.querySelector('[data-course-field="description"]').value,
          level: row.querySelector('[data-course-field="level"]').value,
          featured: row.querySelector('[data-course-field="featured"]').checked
        })).filter(course => course.title.trim());
      }

      function fetchProductIntoRow(row, button) {
        const productId = row.querySelector('[data-course-field="product_id"]').value.trim();
        if (!productId) {
          setEditorStatus('شناسه محصول را وارد کنید.', 'error');
          return;
        }
        const request = new FormData();
        request.append('action', ARYA_LEARNING_PATH_CONFIG.actions.product);
        request.append('nonce', ARYA_LEARNING_PATH_CONFIG.nonce);
        request.append('post_id', ARYA_LEARNING_PATH_CONFIG.postId);
        request.append('product_id', productId);

        button.disabled = true;
        button.textContent = 'در حال دریافت...';
        fetch(ARYA_LEARNING_PATH_CONFIG.ajaxUrl, {
          method: 'POST',
          credentials: 'same-origin',
          body: request
        })
          .then(response => response.json())
          .then(response => {
            if (!response.success) {
              throw new Error(response.data && response.data.message ? response.data.message : 'خطا در دریافت محصول');
            }
            const course = response.data.course || {};
            Object.entries(course).forEach(([key, value]) => {
              const field = row.querySelector(`[data-course-field="${key}"]`);
              if (!field) return;
              if (field.type === 'checkbox') {
                field.checked = Boolean(value);
              } else {
                field.value = value ?? '';
              }
            });
            setEditorStatus('اطلاعات محصول دریافت شد. برای اعمال نهایی، تغییرات گره را ذخیره کنید.', 'success');
          })
          .catch(error => setEditorStatus(error.message, 'error'))
          .finally(() => {
            button.disabled = false;
            button.textContent = 'دریافت از محصول';
          });
      }

      function closeModal() {
        modal.hidden = true;
        modalContent.innerHTML = '';
      }

      function updateDraftJson() {
        jsonDraft.value = JSON.stringify(editorData, null, 2);
      }

      function saveEditorMeta() {
        if (!ARYA_LEARNING_PATH_CONFIG.ajaxUrl || !ARYA_LEARNING_PATH_CONFIG.nonce) {
          setEditorStatus('تنظیمات AJAX وردپرس در دسترس نیست.', 'error');
          return;
        }
        const button = document.getElementById('lpSaveMeta');
        const request = new FormData();
        request.append('action', ARYA_LEARNING_PATH_CONFIG.actions.save);
        request.append('nonce', ARYA_LEARNING_PATH_CONFIG.nonce);
        request.append('post_id', ARYA_LEARNING_PATH_CONFIG.postId);
        request.append('data', JSON.stringify(editorData));

        button.disabled = true;
        setEditorStatus('در حال ذخیره...', '');
        fetch(ARYA_LEARNING_PATH_CONFIG.ajaxUrl, {
          method: 'POST',
          credentials: 'same-origin',
          body: request
        })
          .then(response => response.json())
          .then(response => {
            if (!response.success) {
              throw new Error(response.data && response.data.message ? response.data.message : 'ذخیره انجام نشد');
            }
            editorData = normalizeLearningPathData(response.data.data || editorData);
            DATA = cloneLearningPathData(editorData);
            renderLanding();
            renderEditorTree();
            setEditorStatus('ذخیره شد و پیش‌نمایش با متای جدید به‌روز شد.', 'success');
          })
          .catch(error => setEditorStatus(error.message, 'error'))
          .finally(() => {
            button.disabled = false;
          });
      }

      function setEditorStatus(message, type) {
        statusEl.textContent = message;
        statusEl.classList.remove('is-success', 'is-error');
        if (type === 'success') statusEl.classList.add('is-success');
        if (type === 'error') statusEl.classList.add('is-error');
      }
    }
  </script>