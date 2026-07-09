<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= esc($title ?? 'Fortune One Executive CRM') ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png') ?>"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "tertiary-fixed": "#e1e3e4",
                      "on-surface": "#191c1e",
                      "surface-tint": "#575e70",
                      "primary-fixed": "#dce2f7",
                      "primary-fixed-dim": "#c0c6db",
                      "on-primary": "#ffffff",
                      "tertiary-fixed-dim": "#c5c7c8",
                      "on-tertiary-fixed": "#191c1d",
                      "surface-container-high": "#e7e8ea",
                      "outline-variant": "#c6c6cd",
                      "on-primary-container": "#7d8497",
                      "on-background": "#191c1e",
                      "surface-container-low": "#f3f4f6",
                      "surface-container-highest": "#e1e2e4",
                      "surface-bright": "#f8f9fb",
                      "secondary-fixed-dim": "#c0c7d6",
                      "surface-dim": "#d9dadc",
                      "on-secondary-container": "#5e6572",
                      "surface-container-lowest": "#ffffff",
                      "surface-container": "#edeef0",
                      "primary": "#000000",
                      "tertiary": "#000000",
                      "on-secondary": "#ffffff",
                      "on-error": "#ffffff",
                      "on-primary-fixed": "#141b2b",
                      "surface-variant": "#e1e2e4",
                      "primary-container": "#141b2b",
                      "secondary-fixed": "#dce2f3",
                      "inverse-on-surface": "#f0f1f3",
                      "on-secondary-fixed": "#151c27",
                      "on-primary-fixed-variant": "#404758",
                      "on-surface-variant": "#45464c",
                      "secondary": "#585f6c",
                      "on-error-container": "#93000a",
                      "on-tertiary-container": "#828485",
                      "tertiary-container": "#191c1d",
                      "inverse-surface": "#2e3132",
                      "error": "#ba1a1a",
                      "error-container": "#ffdad6",
                      "secondary-container": "#dce2f3",
                      "on-tertiary": "#ffffff",
                      "surface": "#f8f9fb",
                      "outline": "#76777d",
                      "inverse-primary": "#c0c6db",
                      "on-secondary-fixed-variant": "#404754",
                      "background": "#f8f9fb",
                      "on-tertiary-fixed-variant": "#454748"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "sm": "8px",
                      "unit": "4px",
                      "md": "16px",
                      "gutter": "24px",
                      "container-max": "1440px",
                      "xs": "4px",
                      "lg": "24px",
                      "xl": "48px",
                      "margin-mobile": "16px",
                      "xxl": "80px"
              },
              "fontFamily": {
                      "label-sm": ["Geist"],
                      "display-lg": ["Geist"],
                      "body-md": ["Geist"],
                      "headline-md": ["Geist"],
                      "headline-lg-mobile": ["Geist"],
                      "body-lg": ["Geist"],
                      "headline-lg": ["Geist"],
                      "label-md": ["Geist"]
              },
              "fontSize": {
                      "label-sm": ["11px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                      "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                      "body-md": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                      "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "500"}],
                      "headline-lg-mobile": ["24px", {"lineHeight": "1.2", "fontWeight": "600"}],
                      "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                      "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                      "label-md": ["13px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "500"}]
              }
            },
          },
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #c6c6cd; border-radius: 20px; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="bg-background text-on-surface overflow-hidden">

    <?= $this->include('FortuneOneCRM/common/sidebar') ?>
    
    <?= $this->include('FortuneOneCRM/common/header') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('FortuneOneCRM/common/footer') ?>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
