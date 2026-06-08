<?php
$arya_study_path_post_id = function_exists('get_queried_object_id') ? (int) get_queried_object_id() : 0;
if (!$arya_study_path_post_id && function_exists('get_the_ID')) {
  $arya_study_path_post_id = (int) get_the_ID();
}

$arya_study_path_meta_key = '_arya_study_paths_data';
$arya_study_default_json = <<<'JSON'
{
  "webAppLevelOne": {
    "title": "وب‌آپ سطح ۱",
    "short": "شروع طراحی وب با HTML، CSS و یک پروژه نهایی",
    "icon": "🌐",
    "accent": "#a0e747",
    "audience": "نوجوانان و تازه‌کارها",
    "duration": "۷ فصل / ۳۰ آیتم",
    "level": "مقدماتی",
    "prerequisite": "ندارد",
    "description": "در این مسیر، اول مفهوم وب را می‌فهمی، بعد HTML و CSS را مرحله‌به‌مرحله تمرین می‌کنی و در پایان یک کارت ویزیت آنلاین می‌سازی.",
    "tags": [
      "HTML",
      "CSS",
      "وب",
      "پروژه محور"
    ],
    "roadmapTitle": "نقشه راه وب‌آپ سطح ۱",
    "roadmapSubtitle": "همان مسیر sample قبلی، اما این بار از آبجکت و انتخاب دسته رندر می‌شود.",
    "items": [
      {
        "type": "chapter",
        "title": "سفر به دنیای وب",
        "note": "اول تصویر کلی وب را می‌سازیم."
      },
      {
        "type": "lesson",
        "title": "مسیر وب",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "وب چیه؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "چرخه حیات",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "ظاهر یا باطن؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "آزمونک: مفاهیم اولیه",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۸ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "قدم اول: HTML",
        "note": "ساختار صفحه را با تگ‌ها می‌سازیم."
      },
      {
        "type": "lesson",
        "title": "HTML چیه",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "کار با متن‌",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تگ های تک",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "آزمونک: HTML مقدماتی",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۸ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "HTML بیشتر",
        "note": "با لینک، تصویر و اسکلت صفحه آشنا می‌شویم."
      },
      {
        "type": "lesson",
        "title": "لینک و اتریبیوت",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۶ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تصویر",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "ساختار صفحه",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تنظیمات صفحه",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "آزمونک: HTML تکمیلی",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۸ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "باگ‌ها، حشرات دردسرساز",
        "note": "دیباگ کردن را از همین ابتدا یاد می‌گیریم."
      },
      {
        "type": "lesson",
        "title": "باگ چیه؟",
        "kind": "درس‌نامه",
        "icon": "🐞",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تگ link",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۱ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "قدم دوم: CSS",
        "note": "به صفحه‌ها ظاهر و شخصیت می‌دهیم."
      },
      {
        "type": "lesson",
        "title": "شروع کار با CSS",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "انتخابگر المان‌ها",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "انتخابگر کلاس",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "انتخابگر شناسه",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "CSS بیشتر",
        "note": "مدل جعبه‌ای، حاشیه و فاصله‌ها را تمرین می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "تعیین ابعاد و حاشیه",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۶ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "مدل جعبه‌ای و پدینگ",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "مارجین",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۳ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "پدینگ یک‌خطی",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۳ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "مارجین یک‌خطی و گِرد کردن لبه‌ها",
        "kind": "درس‌نامه",
        "icon": "🎨",
        "duration": "۱۷ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "پروژه نهایی: کارت ویزیت آنلاین",
        "note": "در پایان، خروجی واقعی می‌سازی."
      },
      {
        "type": "lesson",
        "title": "پروژه‌ها در دنیای واقعی",
        "kind": "درس‌نامه",
        "icon": "🚀",
        "duration": "۱۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "مقدمه‌ای بر پروژه وب‌آپ سطح ۱",
        "kind": "پروژه",
        "icon": "🚀",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "ارسال پروژه",
        "kind": "پروژه",
        "icon": "🚀",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "آن‌چه خواهید دید",
        "kind": "جمع‌بندی",
        "icon": "🏁",
        "duration": "۶ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "گواهی دوره",
        "kind": "جمع‌بندی",
        "icon": "🏅",
        "duration": "۵ دقیقه",
        "url": "#"
      }
    ]
  },
  "pythonStarter": {
    "title": "پایتون خلاق",
    "short": "ورود نرم به برنامه‌نویسی با تمرین‌های کوچک",
    "icon": "🐍",
    "accent": "#ffb23f",
    "audience": "کاملا مبتدی‌ها",
    "duration": "۴ فصل / ۱۳ آیتم",
    "level": "مقدماتی",
    "prerequisite": "آشنایی ساده با کامپیوتر",
    "description": "این مسیر با مفاهیم خیلی ساده شروع می‌شود و قدم‌به‌قدم به شرط‌ها، حلقه‌ها و یک پروژه کوچک می‌رسد.",
    "tags": [
      "Python",
      "منطق",
      "تمرین"
    ],
    "roadmapTitle": "نقشه راه شروع پایتون",
    "roadmapSubtitle": "از اولین چاپ روی صفحه تا ساخت یک بازی کوچک حدس عدد.",
    "items": [
      {
        "type": "chapter",
        "title": "آشنایی با کدنویسی",
        "note": "ذهنیت برنامه‌نویسی را می‌سازیم."
      },
      {
        "type": "lesson",
        "title": "برنامه یعنی چی؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "اولین چاپ با print",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "خطاها دوست ما هستند",
        "kind": "درس‌نامه",
        "icon": "🐞",
        "duration": "۱۰ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "داده‌ها و تصمیم‌ها",
        "note": "با متغیر، عدد و شرط کار می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "متغیر و رشته",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "اعداد و ماشین حساب",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "if و انتخاب مسیر",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "تکرار و لیست",
        "note": "کاری می‌کنیم برنامه چندبار فکر کند."
      },
      {
        "type": "lesson",
        "title": "حلقه for",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "لیست خرید ربات",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تابع‌های کوچک",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "پروژه پایان مسیر",
        "note": "همه چیز را در یک بازی جمع می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "بازی حدس عدد",
        "kind": "پروژه",
        "icon": "🚀",
        "duration": "۴۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "بازبینی و ارتقا",
        "kind": "جمع‌بندی",
        "icon": "🏁",
        "duration": "۱۲ دقیقه",
        "url": "#"
      }
    ]
  },
  "gameLab": {
    "title": "بازی‌سازی کودکانه",
    "short": "طراحی مرحله، قوانین بازی و ساخت نمونه اولیه",
    "icon": "🎮",
    "accent": "#71a9ff",
    "audience": "علاقه‌مندان بازی و داستان",
    "duration": "۳ فصل / ۱۰ آیتم",
    "level": "مقدماتی",
    "prerequisite": "خلاقیت و علاقه به بازی",
    "description": "در این مسیر، ایده بازی را به مرحله، قانون، چالش و نمونه اولیه تبدیل می‌کنی؛ همه چیز پروژه‌محور است.",
    "tags": [
      "Game Design",
      "Prototype",
      "Story"
    ],
    "roadmapTitle": "نقشه راه ساخت اولین بازی",
    "roadmapSubtitle": "از ایده اولیه تا تست با دوستان و بهتر کردن مرحله‌ها.",
    "items": [
      {
        "type": "chapter",
        "title": "ایده و داستان",
        "note": "بازی خوب از یک ایده قابل فهم شروع می‌شود."
      },
      {
        "type": "lesson",
        "title": "قهرمان بازی کیه؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "طراحی دشمن و جایزه",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "قانون برد و باخت",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "مرحله‌سازی",
        "note": "چالش‌ها را جذاب و قابل حل می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "نقشه مرحله اول",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "سختی بازی چقدر باشد؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "صدای بازی و حس موفقیت",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "نمونه اولیه",
        "note": "نسخه قابل بازی می‌سازیم و تست می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "ساخت پروتوتایپ",
        "kind": "پروژه",
        "icon": "🚀",
        "duration": "۴۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تست با دوستان",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "انتشار نسخه اول",
        "kind": "جمع‌بندی",
        "icon": "🏁",
        "duration": "۱۰ دقیقه",
        "url": "#"
      }
    ]
  },
  "aiExplorer": {
    "title": "هوش مصنوعی مقدماتی",
    "short": "آشنایی با داده، پرامپت و پروژه‌های کوچک AI",
    "icon": "🤖",
    "accent": "#ff7d7d",
    "audience": "کنجکاوهای تکنولوژی",
    "duration": "۴ فصل / ۱۲ آیتم",
    "level": "مقدماتی تا متوسط",
    "prerequisite": "منطق پایه و کنجکاوی",
    "description": "این مسیر کمک می‌کند بفهمی AI چطور با داده کار می‌کند، چطور باید سؤال خوب پرسید و چطور یک پروژه کوچک هوشمند ساخت.",
    "tags": [
      "AI",
      "Data",
      "Prompt",
      "Ethics"
    ],
    "roadmapTitle": "نقشه راه ورود به AI",
    "roadmapSubtitle": "تمرکز روی فهم مفاهیم، استفاده درست و ساخت نمونه‌های کوچک.",
    "items": [
      {
        "type": "chapter",
        "title": "AI را بشناس",
        "note": "اول با مفهوم و کاربردها آشنا می‌شویم."
      },
      {
        "type": "lesson",
        "title": "هوش مصنوعی چیست؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "AI کجا اشتباه می‌کند؟",
        "kind": "درس‌نامه",
        "icon": "🐞",
        "duration": "۱۲ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "تمرین تشخیص کاربردها",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "داده و الگو",
        "note": "می‌فهمیم مدل‌ها از داده چه چیزی یاد می‌گیرند."
      },
      {
        "type": "lesson",
        "title": "داده تمیز و داده شلوغ",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۶ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "پیدا کردن الگو",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۲۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "سوگیری و انصاف",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۵ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "پرامپت‌نویسی",
        "note": "درخواست دقیق، خروجی بهتر می‌دهد."
      },
      {
        "type": "lesson",
        "title": "پرامپت خوب یعنی چی؟",
        "kind": "درس‌نامه",
        "icon": "📘",
        "duration": "۱۴ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "ساخت چک‌لیست پرامپت",
        "kind": "تمرین",
        "icon": "🧩",
        "duration": "۱۸ دقیقه",
        "url": "#"
      },
      {
        "type": "chapter",
        "title": "پروژه کوچک",
        "note": "یک دستیار ساده طراحی می‌کنیم."
      },
      {
        "type": "lesson",
        "title": "طراحی دستیار مطالعه",
        "kind": "پروژه",
        "icon": "🚀",
        "duration": "۴۰ دقیقه",
        "url": "#"
      },
      {
        "type": "lesson",
        "title": "ارزیابی پاسخ‌ها",
        "kind": "جمع‌بندی",
        "icon": "🏁",
        "duration": "۱۵ دقیقه",
        "url": "#"
      }
    ]
  }
}
JSON;
$arya_study_paths_data = json_decode($arya_study_default_json, true);
if (!is_array($arya_study_paths_data)) {
  $arya_study_paths_data = array();
}

if ($arya_study_path_post_id && function_exists('get_post_meta')) {
  $arya_study_path_meta_raw = get_post_meta($arya_study_path_post_id, $arya_study_path_meta_key, true);
  if (is_array($arya_study_path_meta_raw)) {
    $arya_study_paths_data = $arya_study_path_meta_raw;
  } elseif (is_string($arya_study_path_meta_raw) && trim($arya_study_path_meta_raw) !== '') {
    $arya_study_path_decoded = json_decode($arya_study_path_meta_raw, true);
    if (is_array($arya_study_path_decoded)) {
      $arya_study_paths_data = $arya_study_path_decoded;
    }
  }
}

$arya_study_path_can_edit = $arya_study_path_post_id && function_exists('current_user_can') && current_user_can('edit_post', $arya_study_path_post_id);
$arya_study_path_json_flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
$arya_study_paths_json = function_exists('wp_json_encode')
  ? wp_json_encode((object) $arya_study_paths_data, $arya_study_path_json_flags)
  : json_encode((object) $arya_study_paths_data, $arya_study_path_json_flags);
$arya_study_path_config = array(
  'postId' => $arya_study_path_post_id,
  'canEdit' => (bool) $arya_study_path_can_edit,
  'ajaxUrl' => function_exists('admin_url') ? admin_url('admin-ajax.php') : '',
  'nonce' => ($arya_study_path_can_edit && function_exists('wp_create_nonce')) ? wp_create_nonce('arya_study_path_' . $arya_study_path_post_id) : '',
  'actions' => array(
    'save' => 'arya_study_path_save',
  ),
);
$arya_study_path_config_json = function_exists('wp_json_encode')
  ? wp_json_encode($arya_study_path_config, $arya_study_path_json_flags)
  : json_encode($arya_study_path_config, $arya_study_path_json_flags);
?>
  <style>
    :root {
      --bg: #fff7e5;
      --bg-2: #edf8df;
      --ink: #141811;
      --muted: #65705d;
      --surface: rgba(255, 255, 250, 0.82);
      --surface-strong: #fffdf4;
      --line: rgba(20, 24, 17, 0.12);
      --lime: #a0e747;
      --lime-dark: #62a90f;
      --orange: #ffb23f;
      --blue: #71a9ff;
      --pink: #ff7d7d;
      --shadow: 0 28px 80px rgba(35, 45, 24, 0.15);
      --hard-shadow: 0 8px 0 var(--ink);
      --radius-xl: 34px;
      --radius-lg: 26px;
      --radius-md: 18px;
      --font: "Vazirmatn", "Dana", "IRANYekan", Tahoma, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      min-height: 100vh;
      margin: 0;
      background:
        radial-gradient(circle at 9% 10%, rgba(255, 178, 63, 0.36), transparent 22rem),
        radial-gradient(circle at 92% 2%, rgba(160, 231, 71, 0.34), transparent 26rem),
        radial-gradient(circle at 72% 82%, rgba(113, 169, 255, 0.24), transparent 26rem),
        linear-gradient(145deg, var(--bg) 0%, #fffdf3 44%, var(--bg-2) 100%);
      color: var(--ink);
      font-family: var(--font);
      overflow-x: hidden;
    }

    body::before {
      position: fixed;
      inset: 0;
      z-index: -2;
      background-image:
        linear-gradient(rgba(20, 24, 17, 0.045) 1px, transparent 1px),
        linear-gradient(90deg, rgba(20, 24, 17, 0.045) 1px, transparent 1px);
      background-size: 34px 34px;
      content: "";
      mask-image: linear-gradient(to bottom, #000, transparent 82%);
    }

    body::after {
      position: fixed;
      inset: auto -9rem -11rem auto;
      z-index: -1;
      width: 30rem;
      height: 30rem;
      border: 3px solid rgba(20, 24, 17, 0.08);
      border-radius: 46% 54% 63% 37%;
      background: rgba(255, 125, 125, 0.13);
      content: "";
      transform: rotate(-18deg);
      pointer-events: none;
    }

    button,
    input {
      font: inherit;
    }

    button {
      cursor: pointer;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .study-app {
      width: min(1180px, calc(100% - 32px));
      margin: 0 auto;
      padding: clamp(28px, 4vw, 54px) 0 74px;
    }

    .choice-scene {
      display: grid;
      grid-template-columns: minmax(0, 1.05fr) minmax(360px, 0.95fr);
      align-items: center;
      min-height: calc(100vh - 96px);
      gap: clamp(28px, 5vw, 70px);
    }

    .hero-panel {
      position: relative;
      isolation: isolate;
    }

    .hero-panel::before,
    .hero-panel::after {
      position: absolute;
      z-index: -1;
      border: 3px solid var(--ink);
      content: "";
      pointer-events: none;
    }

    .hero-panel::before {
      inset: -18px auto auto 12%;
      width: 88px;
      height: 88px;
      border-radius: 28px;
      background: var(--lime);
      transform: rotate(12deg);
      box-shadow: var(--hard-shadow);
    }

    .hero-panel::after {
      inset: auto 8% -18px auto;
      width: 116px;
      height: 62px;
      border-radius: 999px;
      background: var(--orange);
      transform: rotate(-10deg);
      box-shadow: var(--hard-shadow);
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      width: fit-content;
      padding: 10px 15px;
      border: 1px solid var(--line);
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.72);
      color: #415232;
      box-shadow: 0 14px 36px rgba(35, 45, 24, 0.08);
      font-weight: 900;
    }

    .eyebrow::before {
      width: 11px;
      height: 11px;
      border-radius: 50%;
      background: var(--lime);
      box-shadow: 0 0 0 7px rgba(160, 231, 71, 0.25);
      content: "";
    }

    h1 {
      max-width: 820px;
      margin: 26px 0 18px;
      font-size: clamp(3rem, 7.2vw, 6.9rem);
      line-height: 0.98;
      letter-spacing: -0.085em;
    }

    .title-splash {
      position: relative;
      display: inline-block;
      padding-inline: 12px;
    }

    .title-splash::after {
      position: absolute;
      inset: auto 0 10px;
      z-index: -1;
      height: 30%;
      border: 3px solid var(--ink);
      border-radius: 999px;
      background: var(--lime);
      content: "";
      transform: rotate(-2deg);
    }

    .hero-copy {
      max-width: 660px;
      margin: 0;
      color: var(--muted);
      font-size: clamp(1rem, 1.45vw, 1.22rem);
      line-height: 2.05;
    }

    .mini-stats {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-top: 28px;
    }

    .mini-stat {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 14px;
      border: 2px solid var(--ink);
      border-radius: 16px;
      background: var(--surface-strong);
      box-shadow: 0 5px 0 var(--ink);
      font-weight: 900;
    }

    .picker-card {
      position: relative;
      padding: clamp(20px, 3vw, 30px);
      border: 3px solid var(--ink);
      border-radius: var(--radius-xl);
      background: var(--surface);
      box-shadow: var(--shadow), var(--hard-shadow);
      backdrop-filter: blur(16px);
      overflow: hidden;
    }

    .picker-card::before {
      position: absolute;
      inset: 18px 18px auto auto;
      width: 70px;
      height: 70px;
      border-radius: 24px;
      background: rgba(113, 169, 255, 0.28);
      content: "";
      transform: rotate(12deg);
    }

    .picker-head {
      position: relative;
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 18px;
      margin-bottom: 20px;
    }

    .picker-head h2 {
      margin: 0 0 8px;
      font-size: clamp(1.45rem, 2.5vw, 2.15rem);
      letter-spacing: -0.045em;
    }

    .picker-head p {
      margin: 0;
      color: var(--muted);
      line-height: 1.8;
    }

    .spark-badge {
      display: grid;
      flex: 0 0 auto;
      width: 54px;
      height: 54px;
      place-items: center;
      border: 3px solid var(--ink);
      border-radius: 18px;
      background: var(--orange);
      box-shadow: 0 6px 0 var(--ink);
      font-size: 1.5rem;
      transform: rotate(-7deg);
    }

    .search-box {
      position: relative;
      margin-bottom: 14px;
    }

    .search-box svg {
      position: absolute;
      inset: 50% 16px auto auto;
      width: 22px;
      height: 22px;
      color: var(--muted);
      transform: translateY(-50%);
      pointer-events: none;
    }

    .search-box input {
      width: 100%;
      min-height: 58px;
      padding: 0 50px 0 18px;
      border: 2px solid var(--ink);
      border-radius: 20px;
      outline: none;
      background: #fffef8;
      color: var(--ink);
      box-shadow: 0 5px 0 var(--ink);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .search-box input:focus {
      box-shadow: 0 8px 0 var(--ink);
      transform: translateY(-3px);
    }

    .category-list {
      display: grid;
      gap: 12px;
      max-height: 442px;
      padding: 4px 0 8px;
      overflow: auto;
      scrollbar-width: thin;
    }

    .category-card {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 14px;
      width: 100%;
      padding: 14px;
      border: 2px solid rgba(20, 24, 17, 0.18);
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.72);
      color: var(--ink);
      text-align: start;
      transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
    }

    .category-card:hover,
    .category-card.active {
      border-color: var(--ink);
      background: color-mix(in srgb, var(--path-accent, var(--lime)) 22%, white);
      box-shadow: 0 7px 0 var(--ink);
      transform: translateY(-3px);
    }

    .category-icon {
      display: grid;
      width: 54px;
      height: 54px;
      place-items: center;
      border: 2px solid var(--ink);
      border-radius: 18px;
      background: var(--path-accent, var(--lime));
      font-size: 1.55rem;
      box-shadow: 0 4px 0 var(--ink);
    }

    .category-title {
      display: block;
      margin-bottom: 4px;
      font-size: 1.05rem;
      font-weight: 950;
    }

    .category-desc {
      display: block;
      color: var(--muted);
      font-size: 0.9rem;
      line-height: 1.75;
    }

    .category-count {
      justify-self: end;
      padding: 8px 10px;
      border-radius: 999px;
      background: rgba(20, 24, 17, 0.08);
      color: #35402d;
      font-size: 0.82rem;
      font-weight: 900;
      white-space: nowrap;
    }

    .empty-state {
      padding: 22px;
      border: 2px dashed rgba(20, 24, 17, 0.22);
      border-radius: 22px;
      color: var(--muted);
      text-align: center;
    }

    .picker-actions {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      margin-top: 18px;
    }

    .selected-label {
      color: var(--muted);
      font-size: 0.92rem;
      line-height: 1.7;
    }

    .selected-label strong {
      display: block;
      color: var(--ink);
      font-size: 1rem;
    }

    .start-learning,
    .change-path {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      min-height: 52px;
      padding: 0 18px;
      border: 3px solid var(--ink);
      border-radius: 18px;
      background: var(--lime);
      color: var(--ink);
      box-shadow: 0 7px 0 var(--ink);
      font-weight: 950;
      transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
      white-space: nowrap;
    }

    .start-learning:hover:not(:disabled),
    .change-path:hover {
      box-shadow: 0 4px 0 var(--ink);
      transform: translateY(3px);
    }

    .start-learning:disabled {
      cursor: not-allowed;
      opacity: 0.48;
    }

    .path-scene {
      display: none;
      animation: reveal 0.44s ease both;
    }

    .is-viewing .choice-scene {
      display: none;
    }

    .is-viewing .path-scene {
      display: block;
    }

    .path-top {
      display: grid;
      grid-template-columns: minmax(0, 1fr) auto;
      align-items: start;
      gap: 18px;
      margin-bottom: 26px;
    }

    .path-title-card {
      position: relative;
      padding: clamp(20px, 3vw, 34px);
      border: 3px solid var(--ink);
      border-radius: var(--radius-xl);
      background:
        linear-gradient(135deg, color-mix(in srgb, var(--active-accent, var(--lime)) 22%, transparent), transparent 44%),
        rgba(255, 255, 250, 0.86);
      box-shadow: var(--shadow), var(--hard-shadow);
      overflow: hidden;
    }

    .path-title-card::after {
      position: absolute;
      inset: auto 28px -40px auto;
      width: 160px;
      height: 160px;
      border: 28px solid color-mix(in srgb, var(--active-accent, var(--lime)) 45%, transparent);
      border-radius: 50%;
      content: "";
    }

    .path-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
      padding: 9px 13px;
      border-radius: 999px;
      background: rgba(20, 24, 17, 0.08);
      color: #425136;
      font-weight: 900;
    }

    .path-title-card h2 {
      position: relative;
      z-index: 1;
      max-width: 780px;
      margin: 0 0 12px;
      font-size: clamp(2.1rem, 5vw, 4.8rem);
      line-height: 1.03;
      letter-spacing: -0.065em;
    }

    .path-title-card p {
      position: relative;
      z-index: 1;
      max-width: 780px;
      margin: 0;
      color: var(--muted);
      font-size: 1.06rem;
      line-height: 1.95;
    }

    .change-path {
      background: #fffdf4;
    }

    .path-layout {
      display: grid;
      grid-template-columns: minmax(270px, 0.34fr) minmax(0, 0.66fr);
      gap: 24px;
      align-items: start;
    }

    .detail-card,
    .roadmap-card {
      border: 3px solid var(--ink);
      border-radius: var(--radius-xl);
      background: rgba(255, 255, 250, 0.86);
      box-shadow: var(--shadow);
      backdrop-filter: blur(16px);
    }

    .detail-card {
      position: sticky;
      top: 22px;
      padding: 24px;
    }

    .detail-icon {
      display: grid;
      width: 72px;
      height: 72px;
      margin-bottom: 16px;
      place-items: center;
      border: 3px solid var(--ink);
      border-radius: 24px;
      background: var(--active-accent, var(--lime));
      box-shadow: 0 7px 0 var(--ink);
      font-size: 2.05rem;
      transform: rotate(-4deg);
    }

    .detail-card h3 {
      margin: 0 0 10px;
      font-size: 1.65rem;
      letter-spacing: -0.035em;
    }

    .detail-card p {
      margin: 0 0 18px;
      color: var(--muted);
      line-height: 1.85;
    }

    .meta-list {
      display: grid;
      gap: 10px;
      margin-bottom: 18px;
    }

    .meta-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 12px;
      border: 1px solid var(--line);
      border-radius: 16px;
      background: rgba(255, 255, 255, 0.56);
    }

    .meta-item span {
      color: var(--muted);
      font-size: 0.88rem;
    }

    .meta-item strong {
      font-size: 0.94rem;
    }

    .tag-list {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .tag-list span {
      padding: 8px 10px;
      border-radius: 999px;
      background: color-mix(in srgb, var(--active-accent, var(--lime)) 20%, white);
      color: #394433;
      font-size: 0.84rem;
      font-weight: 900;
    }

    .roadmap-card {
      overflow: hidden;
    }

    .roadmap-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 24px 26px;
      border-bottom: 2px solid var(--line);
      background:
        linear-gradient(90deg, color-mix(in srgb, var(--active-accent, var(--lime)) 18%, transparent), transparent),
        rgba(255, 255, 255, 0.5);
    }

    .roadmap-header h3 {
      margin: 0 0 6px;
      font-size: 1.5rem;
      letter-spacing: -0.035em;
    }

    .roadmap-header p {
      margin: 0;
      color: var(--muted);
      line-height: 1.7;
    }

    .progress-pill {
      flex: 0 0 auto;
      padding: 11px 14px;
      border: 2px solid var(--ink);
      border-radius: 999px;
      background: var(--active-accent, var(--lime));
      box-shadow: 0 5px 0 var(--ink);
      font-weight: 950;
      white-space: nowrap;
    }

    .roadmap-body {
      padding: clamp(18px, 3vw, 34px);
    }

    .chapter-block {
      margin-bottom: 28px;
    }

    .chapter-block:last-child {
      margin-bottom: 0;
    }

    .chapter-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 18px;
      padding: 13px 16px;
      border: 2px solid var(--ink);
      border-radius: 20px;
      background: #fffdf4;
      box-shadow: 0 5px 0 var(--ink);
    }

    .chapter-head strong {
      font-size: 1.05rem;
    }

    .chapter-head span {
      color: var(--muted);
      font-size: 0.9rem;
    }

    .map-track {
      position: relative;
      isolation: isolate;
      min-height: 120px;
      padding: 8px 0 4px;
    }

    .map-track::before {
      position: absolute;
      inset: 18px 28px;
      z-index: -2;
      border-radius: 28px;
      background:
        radial-gradient(circle, rgba(20, 24, 17, 0.08) 1.3px, transparent 1.3px) 0 0 / 18px 18px,
        color-mix(in srgb, var(--active-accent, var(--lime)) 9%, transparent);
      content: "";
    }

    .road-lines {
      position: absolute;
      inset: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: visible;
    }

    .road-depth {
      fill: none;
      stroke: rgba(20, 24, 17, 0.2);
      stroke-linecap: round;
      stroke-linejoin: round;
      stroke-width: 16;
    }

    .road-top {
      fill: none;
      stroke: var(--active-accent, var(--lime));
      stroke-dasharray: 10 14;
      stroke-linecap: round;
      stroke-linejoin: round;
      stroke-width: 6;
      animation: roadDash 22s linear infinite;
    }

    .road-row {
      display: grid;
      grid-template-columns: repeat(3, minmax(88px, 1fr));
      min-height: 142px;
      align-items: start;
      animation: riseIn 0.44s ease both;
      animation-delay: var(--item-delay, 0s);
    }

    .road-node-wrap {
      display: flex;
      justify-content: center;
    }

    .road-pos-1 {
      grid-column: 1;
    }

    .road-pos-2 {
      grid-column: 2;
    }

    .road-pos-3 {
      grid-column: 3;
    }

    .lesson-link {
      position: relative;
      display: grid;
      justify-items: center;
      width: min(168px, 100%);
      text-align: center;
    }

    .step-orb {
      display: grid;
      width: 82px;
      height: 64px;
      place-items: center;
      border: 3px solid var(--ink);
      border-radius: 24px;
      background: var(--active-accent, var(--lime));
      box-shadow: 0 8px 0 var(--ink);
      font-size: 1.65rem;
      transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .lesson-link:hover .step-orb {
      box-shadow: 0 4px 0 var(--ink);
      transform: translateY(4px) rotate(-2deg);
    }

    .step-card {
      display: block;
      width: 100%;
      margin-top: 14px;
      padding: 11px 10px;
      border: 1px solid rgba(20, 24, 17, 0.1);
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.76);
      box-shadow: 0 10px 28px rgba(35, 45, 24, 0.08);
      backdrop-filter: blur(12px);
    }

    .lesson-title {
      display: block;
      font-size: 0.93rem;
      font-weight: 950;
      line-height: 1.65;
    }

    .lesson-meta {
      display: block;
      margin-top: 3px;
      color: var(--muted);
      font-size: 0.78rem;
      line-height: 1.6;
    }

    .kind-practice .step-orb {
      background: var(--orange);
    }

    .kind-project .step-orb {
      background: var(--blue);
    }

    .kind-recap .step-orb {
      background: var(--pink);
    }

    @keyframes riseIn {
      from {
        opacity: 0;
        transform: translateY(18px) scale(0.98);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @keyframes reveal {
      from {
        opacity: 0;
        transform: translateY(18px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes roadDash {
      to {
        stroke-dashoffset: -240;
      }
    }

    @media (max-width: 980px) {
      .choice-scene,
      .path-layout,
      .path-top {
        grid-template-columns: 1fr;
      }

      .choice-scene {
        min-height: auto;
        padding-top: 18px;
      }

      .detail-card {
        position: static;
      }

      .change-path {
        justify-self: start;
      }
    }

    @media (max-width: 620px) {
      .study-app {
        width: min(100% - 22px, 1180px);
        padding-bottom: 42px;
      }

      h1 {
        font-size: clamp(2.45rem, 15vw, 4.2rem);
      }

      .picker-card,
      .path-title-card,
      .detail-card,
      .roadmap-card {
        border-radius: 25px;
      }

      .category-card {
        grid-template-columns: auto 1fr;
      }

      .category-count {
        grid-column: 2;
        justify-self: start;
      }

      .picker-actions,
      .roadmap-header,
      .chapter-head {
        align-items: stretch;
        flex-direction: column;
      }

      .start-learning,
      .change-path,
      .progress-pill {
        width: 100%;
      }

      .roadmap-body {
        padding-inline: 10px;
      }

      .road-row {
        grid-template-columns: repeat(3, minmax(70px, 1fr));
        min-height: 152px;
      }

      .lesson-link {
        width: 116px;
      }

      .step-orb {
        width: 70px;
        height: 58px;
      }

      .lesson-title {
        font-size: 0.82rem;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        scroll-behavior: auto !important;
        transition: none !important;
        animation: none !important;
      }
    }


    .lesson-link.is-visited .step-orb {
      background: #edf8df;
      box-shadow: 0 4px 0 var(--ink);
      transform: translateY(4px);
    }

    .lesson-link.is-visited .step-card {
      border: 2px solid var(--lime-dark);
      background: color-mix(in srgb, var(--lime) 18%, white);
    }

    .visited-badge {
      display: inline-flex;
      width: fit-content;
      margin-top: 6px;
      padding: 4px 8px;
      border-radius: 999px;
      background: rgba(98, 169, 15, 0.14);
      color: var(--lime-dark);
      font-size: 0.72rem;
      font-weight: 950;
    }

    .study-admin-bar,
    .study-admin-panel {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
      margin-top: 16px;
      padding: 12px;
      border: 2px solid var(--ink);
      border-radius: 20px;
      background: rgba(255, 253, 244, 0.9);
      box-shadow: 0 5px 0 var(--ink);
    }

    .study-admin-panel {
      justify-content: space-between;
      margin-bottom: 18px;
    }

    .study-admin-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 42px;
      padding: 0 14px;
      border: 2px solid var(--ink);
      border-radius: 14px;
      background: var(--lime);
      color: var(--ink);
      box-shadow: 0 4px 0 var(--ink);
      font-weight: 950;
    }

    .study-admin-btn.secondary {
      background: #fffdf4;
    }

    .study-admin-btn.danger {
      background: var(--pink);
    }

    .study-admin-btn:disabled {
      opacity: 0.55;
      cursor: not-allowed;
    }

    .study-admin-status {
      color: var(--muted);
      font-weight: 900;
      line-height: 1.8;
    }

    .study-admin-status.is-success {
      color: var(--lime-dark);
    }

    .study-admin-status.is-error {
      color: #c0392b;
    }

    .study-modal {
      position: fixed;
      inset: 0;
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 18px;
      background: rgba(20, 24, 17, 0.54);
      direction: rtl;
    }

    .study-modal[hidden] {
      display: none !important;
    }

    .study-modal-card {
      width: min(980px, 100%);
      max-height: 92vh;
      padding: 20px;
      border: 3px solid var(--ink);
      border-radius: 28px;
      background: #fffdf4;
      box-shadow: var(--shadow), var(--hard-shadow);
      overflow: auto;
    }

    .study-modal-head,
    .study-modal-foot,
    .study-item-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
    }

    .study-modal-head h3 {
      margin: 0;
      font-size: 1.45rem;
    }

    .study-form-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px;
      margin: 16px 0;
    }

    .study-field {
      display: grid;
      gap: 6px;
      font-weight: 900;
    }

    .study-field.full {
      grid-column: 1 / -1;
    }

    .study-field input,
    .study-field textarea,
    .study-field select {
      width: 100%;
      padding: 10px 12px;
      border: 2px solid rgba(20, 24, 17, 0.22);
      border-radius: 14px;
      outline: none;
      background: #fff;
      color: var(--ink);
      font: inherit;
    }

    .study-field textarea {
      min-height: 92px;
      resize: vertical;
    }

    .study-items-editor {
      display: grid;
      gap: 12px;
      margin: 16px 0;
    }

    .study-item-row {
      padding: 12px;
      border: 2px solid rgba(20, 24, 17, 0.16);
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.7);
    }

    .study-item-row.is-chapter {
      background: color-mix(in srgb, var(--orange) 18%, white);
    }

    .study-item-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 10px;
    }

    @media (max-width: 720px) {
      .study-form-grid {
        grid-template-columns: 1fr;
      }
    }

  </style>

<main class="study-app" id="studyApp">
    <section class="choice-scene" aria-labelledby="heroTitle">
      <div class="hero-panel">
        <div class="eyebrow">تصمیم‌گیری مسیر، قبل از نمایش رودمپ</div>
        <h1 id="heroTitle">اول دسته‌ات رو انتخاب کن، بعد <span class="title-splash">نقشه راه</span> رو ببین.</h1>
        <p class="hero-copy">
          این نمونه فقط با یک آبجکت جاوااسکریپتی کار می‌کند: هر دسته، توضیحات، فصل‌ها و آیتم‌های مسیر مطالعه خودش را دارد و رابط کاربری بعد از انتخاب کاربر همان مسیر را می‌سازد.
        </p>
        <div class="mini-stats" aria-label="ویژگی‌ها">
          <span class="mini-stat">✦ بدون هدر و فوتر</span>
          <span class="mini-stat">☄ آبجکت محور</span>
          <span class="mini-stat">🧭 نمایش شرطی مسیر</span>
        </div>
      </div>

      <aside class="picker-card" aria-label="انتخاب دسته یادگیری">
        <div class="picker-head">
          <div>
            <h2>چی می‌خوای یاد بگیری؟</h2>
            <p>یک دسته را انتخاب کن؛ تا قبل از انتخاب، مسیر مطالعه نمایش داده نمی‌شود.</p>
          </div>
          <span class="spark-badge" aria-hidden="true">✺</span>
        </div>

        <label class="search-box" for="categorySearch">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="m21 21-4.35-4.35M10.8 18a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Z" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" />
          </svg>
          <input id="categorySearch" type="search" placeholder="جستجو: وب، پایتون، بازی، هوش مصنوعی..." autocomplete="off" />
        </label>

        <div class="category-list" id="categoryList" role="listbox" aria-label="لیست دسته‌ها"></div>

        <div class="picker-actions">
          <div class="selected-label" id="selectedLabel">هنوز دسته‌ای انتخاب نشده است.</div>
          <button class="start-learning" id="startLearning" type="button" disabled>
            ورود به مسیر
            <span aria-hidden="true">←</span>
          </button>
        </div>
      </aside>
    </section>

    <section class="path-scene" id="pathScene" aria-live="polite">
      <div class="path-top">
        <div class="path-title-card" id="pathTitleCard">
          <div class="path-kicker" id="pathKicker">مسیر انتخاب‌شده</div>
          <h2 id="pathTitle">مسیر مطالعه</h2>
          <p id="pathDescription">بعد از انتخاب دسته، توضیحات مسیر اینجا نمایش داده می‌شود.</p>
        </div>
        <button class="change-path" id="changePath" type="button">تغییر دسته</button>
      </div>

      <div class="path-layout">
        <aside class="detail-card" id="detailCard"></aside>
        <section class="roadmap-card" aria-labelledby="roadmapTitle">
          <div class="roadmap-header">
            <div>
              <h3 id="roadmapTitle">مسیر مطالعه</h3>
              <p id="roadmapSubtitle">آیتم‌های مسیر بر اساس دسته انتخابی ساخته می‌شوند.</p>
            </div>
            <div class="progress-pill" id="progressPill">۰ آیتم</div>
          </div>
          <div class="roadmap-body" id="roadmap"></div>
        </section>
      </div>
    </section>
  </main>

<?php if ($arya_study_path_can_edit) : ?>
  <div id="studyPathEditorModal" class="study-modal" hidden>
    <div class="study-modal-card">
      <div class="study-modal-head">
        <h3 id="studyPathEditorTitle">ویرایش مسیر مطالعه</h3>
        <button type="button" class="study-admin-btn secondary" onclick="document.getElementById('studyPathEditorModal').hidden = true">بستن</button>
      </div>
      <div id="studyPathEditorContent"></div>
    </div>
  </div>
<?php endif; ?>

  <script>
    const STUDY_PATH_CONFIG = <?php echo $arya_study_path_config_json; ?>;
    const STUDY_PATH_DATA = <?php echo $arya_study_paths_json; ?>;

    let learningPaths = normalizeStudyPaths(STUDY_PATH_DATA);
    const app = document.getElementById("studyApp");
    const categorySearch = document.getElementById("categorySearch");
    const categoryList = document.getElementById("categoryList");
    const selectedLabel = document.getElementById("selectedLabel");
    const startLearning = document.getElementById("startLearning");
    const changePath = document.getElementById("changePath");
    const pathTitleCard = document.getElementById("pathTitleCard");
    const pathKicker = document.getElementById("pathKicker");
    const pathTitle = document.getElementById("pathTitle");
    const pathDescription = document.getElementById("pathDescription");
    const detailCard = document.getElementById("detailCard");
    const roadmapTitle = document.getElementById("roadmapTitle");
    const roadmapSubtitle = document.getElementById("roadmapSubtitle");
    const progressPill = document.getElementById("progressPill");
    const roadmap = document.getElementById("roadmap");

    let selectedKey = null;
    let adminStatus = "";
    let adminStatusType = "";
    const visitedStorageKey = `aryaStudyVisited:${STUDY_PATH_CONFIG.postId || window.location.pathname}`;
    const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];

    function normalizeStudyPaths(data) {
      if (!data || typeof data !== "object" || Array.isArray(data)) return {};
      Object.entries(data).forEach(([key, path]) => {
        if (!path || typeof path !== "object") delete data[key];
        else if (!Array.isArray(path.items)) path.items = [];
      });
      return data;
    }

    function toPersianNumber(value) {
      return value.toString().replace(/\d/g, (digit) => persianDigits[digit]);
    }

    function escapeHTML(value) {
      return String(value ?? "").replace(/[&<>"']/g, (char) => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#039;"
      }[char]));
    }

    function getEntries() {
      return Object.entries(learningPaths).map(([key, value]) => ({ key, ...value }));
    }

    function getLessons(path) {
      return (path.items || []).filter((item) => item.type === "lesson");
    }

    function getChapters(path) {
      return (path.items || []).filter((item) => item.type === "chapter");
    }

    function normalize(value) {
      return String(value ?? "").trim().toLowerCase();
    }

    function getKindClass(kind) {
      if (kind === "تمرین") return "kind-practice";
      if (kind === "پروژه") return "kind-project";
      if (kind === "جمع‌بندی") return "kind-recap";
      return "kind-lesson";
    }

    function getVisitedMap() {
      try {
        return JSON.parse(localStorage.getItem(visitedStorageKey) || "{}");
      } catch (error) {
        return {};
      }
    }

    function setVisitedMap(map) {
      localStorage.setItem(visitedStorageKey, JSON.stringify(map));
    }

    function lessonVisitId(pathKey, item, index) {
      return `${pathKey}:${index}:${String(item.title || "lesson").trim()}`;
    }

    function markLessonVisited(pathKey, item, index) {
      const visited = getVisitedMap();
      visited[lessonVisitId(pathKey, item, index)] = Date.now();
      setVisitedMap(visited);
    }

    function isLessonVisited(pathKey, item, index) {
      return Boolean(getVisitedMap()[lessonVisitId(pathKey, item, index)]);
    }

    function createDefaultPath() {
      return {
        title: "مسیر مطالعه جدید",
        short: "توضیح کوتاه مسیر مطالعه",
        icon: "📘",
        accent: "#a0e747",
        audience: "مخاطبان مسیر",
        duration: "۱ فصل / ۱ آیتم",
        level: "مقدماتی",
        prerequisite: "ندارد",
        description: "توضیح کامل مسیر مطالعه را اینجا بنویسید.",
        tags: ["مسیر", "مطالعه"],
        roadmapTitle: "نقشه راه مسیر جدید",
        roadmapSubtitle: "فصل‌ها و آیتم‌های مسیر از اینجا ساخته می‌شوند.",
        items: [
          { type: "chapter", title: "فصل اول", note: "توضیح کوتاه فصل" },
          { type: "lesson", title: "آیتم اول", kind: "درس‌نامه", icon: "📘", duration: "۱۰ دقیقه", url: "#" }
        ]
      };
    }

    function uniquePathKey(base = "studyPath") {
      const clean = String(base).trim().replace(/[^A-Za-z0-9_-]+/g, "-") || "studyPath";
      let key = clean;
      let index = 1;
      while (learningPaths[key]) {
        index += 1;
        key = `${clean}-${index}`;
      }
      return key;
    }

    function renderAdminStatus(container) {
      if (!STUDY_PATH_CONFIG.canEdit || !container) return;
      const status = document.createElement("div");
      status.className = `study-admin-status${adminStatusType ? " is-" + adminStatusType : ""}`;
      status.textContent = adminStatus || "تغییرات مسیر مطالعه با AJAX در متای همین برگه ذخیره می‌شود.";
      container.appendChild(status);
    }

    function setAdminStatus(message, type = "") {
      adminStatus = message;
      adminStatusType = type;
      document.querySelectorAll(".study-admin-status").forEach((status) => {
        status.textContent = message;
        status.classList.remove("is-success", "is-error");
        if (type === "success") status.classList.add("is-success");
        if (type === "error") status.classList.add("is-error");
      });
    }

    function renderCategories(filter = "") {
      const query = normalize(filter);
      const entries = getEntries().filter((path) => {
        const searchable = `${path.title} ${path.short} ${(path.tags || []).join(" ")}`;
        return normalize(searchable).includes(query);
      });

      categoryList.innerHTML = "";

      if (!entries.length) {
        categoryList.innerHTML = '<div class="empty-state">دسته‌ای با این جستجو پیدا نشد.</div>';
      } else {
        entries.forEach((path) => {
          const lessonCount = getLessons(path).length;
          const card = document.createElement("button");
          card.type = "button";
          card.className = `category-card${path.key === selectedKey ? " active" : ""}`;
          card.setAttribute("role", "option");
          card.setAttribute("aria-selected", path.key === selectedKey ? "true" : "false");
          card.style.setProperty("--path-accent", path.accent || "#a0e747");
          card.innerHTML = `
            <span class="category-icon" aria-hidden="true">${escapeHTML(path.icon || "📘")}</span>
            <span>
              <span class="category-title">${escapeHTML(path.title || "بدون عنوان")}</span>
              <span class="category-desc">${escapeHTML(path.short || "")}</span>
            </span>
            <span class="category-count">${toPersianNumber(lessonCount)} آیتم</span>
          `;
          card.addEventListener("click", () => selectCategory(path.key));
          categoryList.appendChild(card);
        });
      }

      renderPickerAdminBar();
    }

    function renderPickerAdminBar() {
      if (!STUDY_PATH_CONFIG.canEdit) return;
      const bar = document.createElement("div");
      bar.className = "study-admin-bar";
      bar.innerHTML = `
        <button type="button" class="study-admin-btn" data-study-admin="add-path">افزودن مسیر جدید</button>
        <button type="button" class="study-admin-btn secondary" data-study-admin="edit-selected" ${selectedKey ? "" : "disabled"}>ویرایش مسیر انتخابی</button>
        <button type="button" class="study-admin-btn secondary" data-study-admin="save">ذخیره JSON</button>
      `;
      renderAdminStatus(bar);
      bar.addEventListener("click", (event) => {
        const button = event.target.closest("button[data-study-admin]");
        if (!button) return;
        const action = button.dataset.studyAdmin;
        if (action === "add-path") addNewPath();
        if (action === "edit-selected" && selectedKey) openPathEditor(selectedKey);
        if (action === "save") saveStudyPaths(button);
      });
      categoryList.appendChild(bar);
    }

    function selectCategory(key) {
      selectedKey = key;
      const path = learningPaths[key];
      selectedLabel.innerHTML = `<strong>${escapeHTML(path.title)}</strong>${escapeHTML(path.short)}`;
      startLearning.disabled = false;
      renderCategories(categorySearch.value);
    }

    function renderDetail(path) {
      const lessonCount = getLessons(path).length;
      const chapterCount = getChapters(path).length;
      detailCard.innerHTML = `
        <div class="detail-icon" aria-hidden="true">${escapeHTML(path.icon || "📘")}</div>
        <h3>${escapeHTML(path.title || "")}</h3>
        <p>${escapeHTML(path.short || "")}</p>
        <div class="meta-list">
          <div class="meta-item"><span>فصل‌ها</span><strong>${toPersianNumber(chapterCount)} فصل</strong></div>
          <div class="meta-item"><span>آیتم‌ها</span><strong>${toPersianNumber(lessonCount)} آیتم</strong></div>
          <div class="meta-item"><span>سطح</span><strong>${escapeHTML(path.level || "")}</strong></div>
          <div class="meta-item"><span>پیش‌نیاز</span><strong>${escapeHTML(path.prerequisite || "")}</strong></div>
          <div class="meta-item"><span>مخاطب</span><strong>${escapeHTML(path.audience || "")}</strong></div>
        </div>
        <div class="tag-list">${(path.tags || []).map((tag) => `<span>${escapeHTML(tag)}</span>`).join("")}</div>
      `;
    }

    function renderPathAdminPanel() {
      if (!STUDY_PATH_CONFIG.canEdit || !selectedKey) return;
      const existing = document.querySelector(".study-admin-panel");
      if (existing) existing.remove();
      const panel = document.createElement("div");
      panel.className = "study-admin-panel";
      panel.innerHTML = `
        <div class="study-admin-status${adminStatusType ? " is-" + adminStatusType : ""}">${escapeHTML(adminStatus || "مسیر، فصل‌ها، آیتم‌ها، لینک و آیکن از این بخش قابل ویرایش هستند.")}</div>
        <div class="study-item-actions">
          <button type="button" class="study-admin-btn" data-path-action="edit">ویرایش مسیر و آیتم‌ها</button>
          <button type="button" class="study-admin-btn secondary" data-path-action="save">ذخیره JSON</button>
          <button type="button" class="study-admin-btn danger" data-path-action="delete">حذف مسیر</button>
        </div>
      `;
      panel.addEventListener("click", (event) => {
        const button = event.target.closest("button[data-path-action]");
        if (!button) return;
        if (button.dataset.pathAction === "edit") openPathEditor(selectedKey);
        if (button.dataset.pathAction === "save") saveStudyPaths(button);
        if (button.dataset.pathAction === "delete") deleteSelectedPath();
      });
      document.querySelector(".path-layout").before(panel);
    }

    function createChapterBlock(chapter, index) {
      const block = document.createElement("section");
      block.className = "chapter-block";
      block.innerHTML = `
        <div class="chapter-head">
          <strong>${toPersianNumber(index + 1)}. ${escapeHTML(chapter.title)}</strong>
          <span>${escapeHTML(chapter.note || "")}</span>
        </div>
        <div class="map-track">
          <svg class="road-lines" aria-hidden="true"></svg>
        </div>
      `;
      roadmap.appendChild(block);
      return block.querySelector(".map-track");
    }

    function renderRoadmap(path) {
      const lessons = getLessons(path);
      const visited = lessons.filter((item, index) => isLessonVisited(selectedKey, item, index)).length;
      roadmap.innerHTML = "";
      roadmapTitle.textContent = path.roadmapTitle || "مسیر مطالعه";
      roadmapSubtitle.textContent = path.roadmapSubtitle || "";
      progressPill.textContent = `${toPersianNumber(visited)} از ${toPersianNumber(lessons.length)} بازدید شده`;

      let currentTrack = null;
      let chapterIndex = -1;
      let lessonIndexInChapter = 0;
      let totalLessonIndex = 0;
      const positionPattern = [2, 1, 2, 3, 2, 1, 3];

      (path.items || []).forEach((item) => {
        if (item.type === "chapter") {
          chapterIndex += 1;
          lessonIndexInChapter = 0;
          currentTrack = createChapterBlock(item, chapterIndex);
          return;
        }

        if (!currentTrack) {
          currentTrack = createChapterBlock({ title: path.roadmapTitle || path.title, note: "" }, 0);
        }

        const position = positionPattern[lessonIndexInChapter % positionPattern.length];
        const lessonVisitIndex = totalLessonIndex;
        const row = document.createElement("div");
        const visitedClass = isLessonVisited(selectedKey, item, lessonVisitIndex) ? " is-visited" : "";
        row.className = "road-row";
        row.style.setProperty("--item-delay", `${Math.min(totalLessonIndex * 0.035, 0.6)}s`);
        row.innerHTML = `
          <div class="road-node-wrap road-pos-${position}">
            <a class="lesson-link ${getKindClass(item.kind)}${visitedClass}" href="${escapeHTML(item.url || "#")}" data-lesson-index="${lessonVisitIndex}" aria-label="مشاهده ${escapeHTML(item.title)}">
              <span class="step-orb"><span aria-hidden="true">${escapeHTML(item.icon || "📘")}</span></span>
              <span class="step-card">
                <span class="lesson-title">${escapeHTML(item.title)}</span>
                <span class="lesson-meta">${escapeHTML(item.kind || "درس‌نامه")} · ${escapeHTML(item.duration || "")}</span>
                ${visitedClass ? '<span class="visited-badge">مشاهده شده</span>' : ""}
              </span>
            </a>
          </div>
        `;
        const link = row.querySelector(".lesson-link");
        link.addEventListener("click", () => {
          markLessonVisited(selectedKey, item, lessonVisitIndex);
        });
        currentTrack.appendChild(row);
        lessonIndexInChapter += 1;
        totalLessonIndex += 1;
      });

      scheduleDrawRoadLines();
    }

    function getNodeCenter(node, containerRect) {
      const rect = node.getBoundingClientRect();
      return {
        x: rect.left - containerRect.left + rect.width / 2,
        y: rect.top - containerRect.top + rect.height / 2
      };
    }

    function drawRoadLines() {
      document.querySelectorAll(".map-track").forEach((track) => {
        const lines = track.querySelector(".road-lines");
        const nodes = [...track.querySelectorAll(".step-orb")];
        const rect = track.getBoundingClientRect();
        const width = Math.max(rect.width, 1);
        const height = Math.max(track.scrollHeight, rect.height, 1);

        lines.setAttribute("viewBox", `0 0 ${width} ${height}`);
        lines.innerHTML = "";

        nodes.slice(0, -1).forEach((node, index) => {
          const start = getNodeCenter(node, rect);
          const end = getNodeCenter(nodes[index + 1], rect);
          const deltaY = end.y - start.y;
          const direction = end.x > start.x ? 1 : -1;
          const sway = Math.max(34, Math.min(90, Math.abs(end.x - start.x) * 0.72));
          const controlOneX = start.x + (end.x - start.x) * 0.18 + direction * sway;
          const controlTwoX = start.x + (end.x - start.x) * 0.82 - direction * sway;
          const controlOneY = start.y + deltaY * 0.26;
          const controlTwoY = end.y - deltaY * 0.26;
          const pathData = `M ${start.x} ${start.y} C ${controlOneX} ${controlOneY}, ${controlTwoX} ${controlTwoY}, ${end.x} ${end.y}`;

          ["road-depth", "road-top"].forEach((className) => {
            const pathEl = document.createElementNS("http://www.w3.org/2000/svg", "path");
            pathEl.setAttribute("class", className);
            pathEl.setAttribute("d", pathData);
            lines.appendChild(pathEl);
          });
        });
      });
    }

    function scheduleDrawRoadLines() {
      requestAnimationFrame(drawRoadLines);
    }

    function showSelectedPath() {
      if (!selectedKey) return;
      const path = learningPaths[selectedKey];
      app.style.setProperty("--active-accent", path.accent || "#a0e747");
      pathTitleCard.style.setProperty("--active-accent", path.accent || "#a0e747");
      pathKicker.textContent = `${path.icon || "📘"} مسیر انتخاب‌شده`;
      pathTitle.textContent = path.title || "مسیر مطالعه";
      pathDescription.textContent = path.description || "";
      renderDetail(path);
      app.classList.add("is-viewing");
      renderRoadmap(path);
      renderPathAdminPanel();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    function backToPicker() {
      app.classList.remove("is-viewing");
      requestAnimationFrame(() => categorySearch.focus());
    }

    function addNewPath() {
      const key = uniquePathKey("study-path");
      learningPaths[key] = createDefaultPath();
      selectCategory(key);
      openPathEditor(key);
      setAdminStatus("مسیر جدید ساخته شد. بعد از تکمیل، ذخیره JSON را بزنید.", "success");
    }

    function deleteSelectedPath() {
      if (!selectedKey || !confirm("آیا از حذف این مسیر مطالعه مطمئن هستید؟")) return;
      delete learningPaths[selectedKey];
      selectedKey = null;
      app.classList.remove("is-viewing");
      selectedLabel.textContent = "هنوز دسته‌ای انتخاب نشده است.";
      startLearning.disabled = true;
      renderCategories(categorySearch.value);
      saveStudyPaths(null, "مسیر حذف شد و JSON ذخیره شد.");
    }

    function openPathEditor(key) {
      const modal = document.getElementById("studyPathEditorModal");
      const content = document.getElementById("studyPathEditorContent");
      const title = document.getElementById("studyPathEditorTitle");
      const path = learningPaths[key];
      if (!modal || !content || !path) return;

      title.textContent = `ویرایش مسیر: ${path.title || key}`;
      const items = JSON.parse(JSON.stringify(path.items || []));
      content.innerHTML = `
        <form id="studyPathForm">
          <div class="study-form-grid">
            <label class="study-field"><span>کلید مسیر</span><input id="studyPathKey" value="${escapeHTML(key)}"></label>
            <label class="study-field"><span>عنوان</span><input id="studyPathTitleInput" value="${escapeHTML(path.title || "")}"></label>
            <label class="study-field"><span>توضیح کوتاه</span><input id="studyPathShort" value="${escapeHTML(path.short || "")}"></label>
            <label class="study-field"><span>آیکن مسیر</span><input id="studyPathIcon" value="${escapeHTML(path.icon || "📘")}"></label>
            <label class="study-field"><span>رنگ مسیر</span><input id="studyPathAccent" value="${escapeHTML(path.accent || "#a0e747")}"></label>
            <label class="study-field"><span>مخاطب</span><input id="studyPathAudience" value="${escapeHTML(path.audience || "")}"></label>
            <label class="study-field"><span>مدت/تعداد</span><input id="studyPathDuration" value="${escapeHTML(path.duration || "")}"></label>
            <label class="study-field"><span>سطح</span><input id="studyPathLevel" value="${escapeHTML(path.level || "")}"></label>
            <label class="study-field"><span>پیش‌نیاز</span><input id="studyPathPrerequisite" value="${escapeHTML(path.prerequisite || "")}"></label>
            <label class="study-field"><span>برچسب‌ها با کاما</span><input id="studyPathTags" value="${escapeHTML((path.tags || []).join(", "))}"></label>
            <label class="study-field full"><span>توضیح کامل</span><textarea id="studyPathDescriptionInput">${escapeHTML(path.description || "")}</textarea></label>
            <label class="study-field"><span>عنوان رودمپ</span><input id="studyPathRoadmapTitle" value="${escapeHTML(path.roadmapTitle || "")}"></label>
            <label class="study-field"><span>زیرعنوان رودمپ</span><input id="studyPathRoadmapSubtitle" value="${escapeHTML(path.roadmapSubtitle || "")}"></label>
          </div>
          <div class="study-admin-bar">
            <button type="button" class="study-admin-btn" id="addChapterRow">افزودن فصل</button>
            <button type="button" class="study-admin-btn secondary" id="addLessonRow">افزودن آیتم</button>
            <span class="study-admin-status">فصل‌ها و آیتم‌ها به ترتیب زیر نمایش داده می‌شوند.</span>
          </div>
          <div class="study-items-editor" id="studyItemsEditor"></div>
          <div class="study-modal-foot">
            <button type="submit" class="study-admin-btn">ذخیره تغییرات</button>
            <button type="button" class="study-admin-btn secondary" id="cancelStudyPathEdit">انصراف</button>
          </div>
        </form>
      `;

      const itemsEditor = document.getElementById("studyItemsEditor");
      const renderItems = () => {
        itemsEditor.innerHTML = "";
        if (!items.length) {
          itemsEditor.innerHTML = '<div class="empty-state">هنوز فصل یا آیتمی ثبت نشده است.</div>';
          return;
        }
        items.forEach((item, index) => itemsEditor.appendChild(renderEditorItemRow(item, index)));
      };

      document.getElementById("addChapterRow").addEventListener("click", () => {
        items.push({ type: "chapter", title: "فصل جدید", note: "" });
        renderItems();
      });
      document.getElementById("addLessonRow").addEventListener("click", () => {
        items.push({ type: "lesson", title: "آیتم جدید", kind: "درس‌نامه", icon: "📘", duration: "۱۰ دقیقه", url: "#" });
        renderItems();
      });
      document.getElementById("cancelStudyPathEdit").addEventListener("click", closePathEditor);
      itemsEditor.addEventListener("click", (event) => {
        const button = event.target.closest("button[data-item-action]");
        if (!button) return;
        syncEditorItems(itemsEditor, items);
        const index = Number(button.closest(".study-item-row").dataset.index);
        const action = button.dataset.itemAction;
        if (action === "delete") items.splice(index, 1);
        if (action === "up" && index > 0) {
          const current = items[index];
          items[index] = items[index - 1];
          items[index - 1] = current;
        }
        if (action === "down" && index < items.length - 1) {
          const current = items[index];
          items[index] = items[index + 1];
          items[index + 1] = current;
        }
        renderItems();
      });
      document.getElementById("studyPathForm").addEventListener("submit", (event) => {
        event.preventDefault();
        syncEditorItems(itemsEditor, items);
        const nextKey = uniquePathKeyForRename(key, document.getElementById("studyPathKey").value);
        const nextPath = {
          title: document.getElementById("studyPathTitleInput").value.trim() || "مسیر بدون عنوان",
          short: document.getElementById("studyPathShort").value,
          icon: document.getElementById("studyPathIcon").value || "📘",
          accent: document.getElementById("studyPathAccent").value || "#a0e747",
          audience: document.getElementById("studyPathAudience").value,
          duration: document.getElementById("studyPathDuration").value,
          level: document.getElementById("studyPathLevel").value,
          prerequisite: document.getElementById("studyPathPrerequisite").value,
          description: document.getElementById("studyPathDescriptionInput").value,
          tags: document.getElementById("studyPathTags").value.split(",").map((tag) => tag.trim()).filter(Boolean),
          roadmapTitle: document.getElementById("studyPathRoadmapTitle").value,
          roadmapSubtitle: document.getElementById("studyPathRoadmapSubtitle").value,
          items
        };
        if (nextKey !== key) delete learningPaths[key];
        learningPaths[nextKey] = nextPath;
        selectedKey = nextKey;
        closePathEditor();
        selectCategory(nextKey);
        showSelectedPath();
        saveStudyPaths(null, "تغییرات مسیر ذخیره شد.");
      });

      renderItems();
      modal.hidden = false;
    }

    function uniquePathKeyForRename(oldKey, rawKey) {
      const requested = String(rawKey || oldKey).trim().replace(/[^A-Za-z0-9_-]+/g, "-") || oldKey;
      if (requested === oldKey) return oldKey;
      return uniquePathKey(requested);
    }

    function renderEditorItemRow(item, index) {
      const row = document.createElement("div");
      row.className = `study-item-row${item.type === "chapter" ? " is-chapter" : ""}`;
      row.dataset.index = String(index);
      if (item.type === "chapter") {
        row.innerHTML = `
          <div class="study-item-head"><strong>فصل</strong><span>${toPersianNumber(index + 1)}</span></div>
          <div class="study-form-grid">
            <label class="study-field"><span>عنوان فصل</span><input data-field="title" value="${escapeHTML(item.title || "")}"></label>
            <label class="study-field"><span>توضیح فصل</span><input data-field="note" value="${escapeHTML(item.note || "")}"></label>
          </div>
          ${itemActionsMarkup()}
        `;
      } else {
        row.innerHTML = `
          <div class="study-item-head"><strong>آیتم مسیر</strong><span>${escapeHTML(item.kind || "درس‌نامه")}</span></div>
          <div class="study-form-grid">
            <label class="study-field"><span>عنوان آیتم</span><input data-field="title" value="${escapeHTML(item.title || "")}"></label>
            <label class="study-field"><span>نوع</span><input data-field="kind" value="${escapeHTML(item.kind || "درس‌نامه")}"></label>
            <label class="study-field"><span>آیکن</span><input data-field="icon" value="${escapeHTML(item.icon || "📘")}"></label>
            <label class="study-field"><span>مدت</span><input data-field="duration" value="${escapeHTML(item.duration || "")}"></label>
            <label class="study-field full"><span>لینک</span><input data-field="url" value="${escapeHTML(item.url || "#")}"></label>
          </div>
          ${itemActionsMarkup()}
        `;
      }
      return row;
    }

    function itemActionsMarkup() {
      return `
        <div class="study-item-actions">
          <button type="button" class="study-admin-btn secondary" data-item-action="up">بالا</button>
          <button type="button" class="study-admin-btn secondary" data-item-action="down">پایین</button>
          <button type="button" class="study-admin-btn danger" data-item-action="delete">حذف</button>
        </div>
      `;
    }

    function syncEditorItems(container, items) {
      const nextItems = [...container.querySelectorAll(".study-item-row")].map((row) => {
        const source = items[Number(row.dataset.index)] || {};
        if (source.type === "chapter") {
          return {
            type: "chapter",
            title: row.querySelector('[data-field="title"]').value,
            note: row.querySelector('[data-field="note"]').value
          };
        }
        return {
          type: "lesson",
          title: row.querySelector('[data-field="title"]').value,
          kind: row.querySelector('[data-field="kind"]').value,
          icon: row.querySelector('[data-field="icon"]').value,
          duration: row.querySelector('[data-field="duration"]').value,
          url: row.querySelector('[data-field="url"]').value || "#"
        };
      });
      items.splice(0, items.length, ...nextItems);
    }

    function closePathEditor() {
      const modal = document.getElementById("studyPathEditorModal");
      const content = document.getElementById("studyPathEditorContent");
      if (modal) modal.hidden = true;
      if (content) content.innerHTML = "";
    }

    function saveStudyPaths(button = null, successMessage = "JSON مسیر مطالعه ذخیره شد.") {
      if (!STUDY_PATH_CONFIG.canEdit) return Promise.resolve();
      const request = new FormData();
      request.append("action", STUDY_PATH_CONFIG.actions.save);
      request.append("nonce", STUDY_PATH_CONFIG.nonce);
      request.append("post_id", STUDY_PATH_CONFIG.postId);
      request.append("data", JSON.stringify(learningPaths));
      if (button) button.disabled = true;
      setAdminStatus("در حال ذخیره...", "");
      return fetch(STUDY_PATH_CONFIG.ajaxUrl, {
        method: "POST",
        credentials: "same-origin",
        body: request
      })
        .then((response) => response.json())
        .then((response) => {
          if (!response.success) {
            throw new Error(response.data && response.data.message ? response.data.message : "ذخیره انجام نشد");
          }
          learningPaths = normalizeStudyPaths(response.data.data || learningPaths);
          renderCategories(categorySearch.value);
          if (selectedKey && learningPaths[selectedKey] && app.classList.contains("is-viewing")) showSelectedPath();
          setAdminStatus(successMessage, "success");
        })
        .catch((error) => {
          setAdminStatus(error.message, "error");
          throw error;
        })
        .finally(() => {
          if (button) button.disabled = false;
        });
    }

    categorySearch.addEventListener("input", (event) => renderCategories(event.target.value));
    startLearning.addEventListener("click", showSelectedPath);
    changePath.addEventListener("click", backToPicker);
    window.addEventListener("resize", scheduleDrawRoadLines);
    window.addEventListener("storage", () => {
      if (selectedKey && app.classList.contains("is-viewing")) renderRoadmap(learningPaths[selectedKey]);
    });

    renderCategories();
  </script>
