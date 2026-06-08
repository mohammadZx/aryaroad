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

  <script>
      
    const DATA = def
    const levelsEl = document.getElementById('levels');
    const detailSection = document.getElementById('detailSection');
    const sticky = document.getElementById('sticky');

    let breadcrumb = [];
    let nodeMap = new Map();

    renderLevel(DATA.categories, 0);

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

      nodes.forEach(node => {
        const item = document.createElement('div');
        item.className = 'tree-item';
        item.dataset.id = node.id;
        item.innerHTML = `
      <div class="thumb"><img src="${node.image}"></div>
      <div class="title">${node.title}</div>
      <div class="desc">${node.description || ''}</div>
    `;

        nodeMap.set(node.id, item);

        item.onclick = () => {
          breadcrumb = breadcrumb.slice(0, levelIndex);
          breadcrumb.push({ id: node.id, title: node.title });
          updateSticky();

          document.querySelectorAll('.tree-item').forEach(i => i.classList.remove('active'));
          item.classList.add('active');

          if (node.children) {
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
      detailSection.innerHTML = `
    <div class="path-box" id="productSection">
      <h3>${path.title}</h3>
      <div class="discription">${path.description}</div>
      <div class="course-grid">
        ${path.courses.map(c => `
          <div class="course">
            <img src="${c.image}">
            <div class="title">${c.title}</div>
            <div class="meta">
              <span>${c.duration}</span>
              <span class="price">${formatPrice(c.price)}</span>
            </div>
            <a href="${c.link}">مشاهده جزئیات دوره</a>
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
  </script>