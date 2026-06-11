<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang | RynDev Smart Solution</title>
    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ── Tokens ── */
        :root {
            --bg:        #F9F7F4;
            --surface:   #FFFFFF;
            --ink:        #1A1814;
            --ink-muted: #7A756F;
            --rule:       #E3DDD7;
            --accent:     #4A4E8C;
            --warm:       #C4957A;
            --radius:     4px;
            --font-serif: 'DM Serif Display', Georgia, serif;
            --font-sans:  'Inter', system-ui, sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 16px; }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ── Grain texture overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: .028;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        }

        /* ── Typography ── */
        h1, h2, h3 { font-family: var(--font-serif); font-weight: 400; line-height: 1.1; letter-spacing: -.01em; }

        p { line-height: 1.7; color: var(--ink-muted); font-size: .9375rem; }

        a { color: inherit; text-decoration: none; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--rule); border-radius: 99px; }

        /* ── Layout helpers ── */
        .container { max-width: 1160px; margin-inline: auto; padding-inline: clamp(1.25rem, 5vw, 3rem); }
        .section    { padding-block: clamp(4rem, 10vw, 7rem); }

        /* ── Fade-in on scroll ── */
        .reveal { opacity: 0; transform: translateY(18px); transition: opacity .6s ease, transform .6s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ────────────────────────────
           NAVBAR
        ──────────────────────────── */
        .nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(249,247,244,.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--rule);
        }
        .nav__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .nav__brand {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .nav__brand img {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--rule);
        }
        .nav__brand-name {
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: .9375rem;
            color: var(--ink);
            letter-spacing: -.02em;
        }
        .nav__brand-name span { color: var(--accent); }
        .nav__brand-sub {
            display: block;
            font-size: .625rem;
            font-weight: 500;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-top: 1px;
        }
        .nav__links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav__links a {
            font-size: .8125rem;
            font-weight: 500;
            color: var(--ink-muted);
            transition: color .2s;
            letter-spacing: .01em;
        }
        .nav__links a:hover { color: var(--ink); }
        .nav__divider {
            width: 1px;
            height: 18px;
            background: var(--rule);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-family: var(--font-sans);
            font-size: .8125rem;
            font-weight: 500;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background .2s, color .2s, opacity .2s;
            letter-spacing: .01em;
            border: none;
            outline: none;
        }
        .btn--ghost {
            color: var(--ink-muted);
            background: transparent;
            padding: .5rem .75rem;
        }
        .btn--ghost:hover { color: var(--ink); }
        .btn--primary {
            background: var(--ink);
            color: #fff;
            padding: .5625rem 1.25rem;
        }
        .btn--primary:hover { opacity: .82; }
        .btn--outline {
            background: transparent;
            color: var(--ink);
            border: 1px solid var(--rule);
            padding: .5rem 1.125rem;
        }
        .btn--outline:hover { border-color: var(--ink-muted); }

        /* Mobile nav toggle */
        .nav__toggle {
            display: none;
            background: none;
            border: 1px solid var(--rule);
            border-radius: var(--radius);
            padding: .375rem .5rem;
            cursor: pointer;
            color: var(--ink);
        }
        .nav__mobile {
            border-top: 1px solid var(--rule);
            background: var(--bg);
            padding: 1.25rem 0;
        }
        .nav__mobile a {
            display: block;
            padding: .625rem 0;
            font-size: .9rem;
            font-weight: 500;
            color: var(--ink-muted);
            border-bottom: 1px solid var(--rule);
        }
        .nav__mobile a:last-child { border-bottom: none; }

        @media (max-width: 768px) {
            .nav__links, .nav__divider { display: none; }
            .nav__toggle { display: flex; align-items: center; }
        }

        /* ── User dropdown ── */
        .dropdown { position: relative; }
        .dropdown__trigger {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .8125rem;
            font-weight: 500;
            color: var(--ink-muted);
            cursor: pointer;
            padding: .375rem .625rem;
            border-radius: var(--radius);
            border: 1px solid transparent;
            background: transparent;
            transition: border-color .2s, color .2s;
        }
        .dropdown__trigger:hover { color: var(--ink); border-color: var(--rule); }
        .dropdown__trigger svg { width: 14px; height: 14px; transition: transform .25s; }
        .dropdown__trigger.open svg { transform: rotate(180deg); }
        .dropdown__menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            min-width: 180px;
            background: var(--surface);
            border: 1px solid var(--rule);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0,0,0,.07);
            overflow: hidden;
            z-index: 200;
        }
        .dropdown__menu a {
            display: block;
            padding: .625rem 1rem;
            font-size: .8125rem;
            font-weight: 500;
            color: var(--ink-muted);
            transition: background .15s, color .15s;
        }
        .dropdown__menu a:hover { background: var(--bg); color: var(--ink); }
        .dropdown__menu a.danger { color: #b00; }
        .dropdown__menu a.danger:hover { background: #fff5f5; }

        /* ────────────────────────────
           ALERT
        ──────────────────────────── */
        .alert-success {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            z-index: 9000;
            background: var(--surface);
            border: 1px solid #d1fae5;
            border-radius: 12px;
            padding: .875rem 1.125rem;
            display: flex;
            align-items: center;
            gap: .875rem;
            min-width: 280px;
            box-shadow: 0 4px 16px rgba(0,0,0,.06);
            transition: opacity .4s, transform .4s;
        }
        .alert-success__icon {
            width: 34px;
            height: 34px;
            background: #ecfdf5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .alert-success__icon svg { width: 18px; height: 18px; color: #059669; }
        .alert-success__title { font-size: .8rem; font-weight: 600; color: var(--ink); }
        .alert-success__msg { font-size: .75rem; color: var(--ink-muted); margin-top: 1px; }
        .alert-success__close {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-muted);
            padding: .25rem;
            line-height: 1;
            transition: color .15s;
        }
        .alert-success__close:hover { color: var(--ink); }

        /* ────────────────────────────
           HERO
        ──────────────────────────── */
        .hero {
            /* Nilai pertama (2.5rem) = jarak minimal di layar HP 
            Nilai kedua (5vw) = responsivitas di layar sedang
            Nilai ketiga (4.5rem) = batas jarak maksimal di layar laptop/desktop (sebelumnya 9rem)
            */
            padding-block: clamp(2.5rem, 5vw, 4.5rem) clamp(4rem, 8vw, 6rem);
            background: var(--bg);
        }
        .hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-bottom: 2.5rem;
        }
        .hero__eyebrow::before {
            content: '';
            display: inline-block;
            width: 28px;
            height: 1px;
            background: var(--ink-muted);
            flex-shrink: 0;
        }
        .hero__headline {
            font-size: clamp(2.75rem, 6vw, 5.25rem);
            color: var(--ink);
            max-width: 14ch;
            margin-bottom: 1rem;
            line-height: 1.08;
        }
        .hero__headline em {
            font-style: italic;
            color: var(--accent);
            position: relative;
            display: inline-block;
        }
        /* Hand-drawn underline — the signature human element */
        .hero__headline em::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: -2px;
            right: -2px;
            height: 8px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 220 12' fill='none'%3E%3Cpath d='M2 9c28-5 56-8 85-7 29 1 58 4 87 2 14-.9 28-2 42-3.5' stroke='%23C4957A' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/100% 100% no-repeat;
            opacity: .75;
        }
        .hero__sub {
            font-size: 1.0625rem;
            color: var(--ink-muted);
            max-width: 50ch;
            margin-bottom: 2.75rem;
            line-height: 1.75;
        }
        .hero__sub strong { color: var(--ink); font-weight: 600; }
        .hero__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-bottom: 4rem;
        }
        .btn--hero {
            padding: .8125rem 2rem;
            font-size: .9375rem;
        }
        .hero__link {
            font-size: .8125rem;
            font-weight: 500;
            color: var(--ink-muted);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: var(--rule);
            transition: color .2s, text-decoration-color .2s;
        }
        .hero__link:hover { color: var(--ink); text-decoration-color: var(--ink-muted); }
        .hero__image {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--rule);
            box-shadow: 0 24px 60px -10px rgba(26,24,20,.1);
            position: relative;
        }
        .hero__image img {
            width: 100%;
            height: clamp(220px, 40vw, 520px);
            object-fit: cover;
            display: block;
            filter: saturate(.88) brightness(.97);
            transition: transform .8s ease;
        }
        .hero__image:hover img { transform: scale(1.02); }
        .hero__image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26,24,20,.32) 0%, transparent 50%);
            pointer-events: none;
        }
        /* Stat pill inside hero image */
        .hero__stat {
            position: absolute;
            bottom: 1.25rem;
            right: 1.25rem;
            background: rgba(249,247,244,.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.6);
            border-radius: 10px;
            padding: .875rem 1.125rem;
            display: flex;
            flex-direction: column;
        }
        .hero__stat-value { font-family: var(--font-serif); font-size: 1.75rem; color: var(--ink); line-height: 1; }
        .hero__stat-label { font-size: .7rem; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: var(--ink-muted); margin-top: .25rem; }

        /* ────────────────────────────
           STATS BAND
        ──────────────────────────── */
        .stats {
            border-top: 1px solid var(--rule);
            border-bottom: 1px solid var(--rule);
            background: var(--surface);
            padding-block: 2.5rem;
        }
        .stats__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--rule);
        }
        @media (max-width: 640px) {
            .stats__grid { grid-template-columns: repeat(2, 1fr); }
        }
        .stats__item {
            background: var(--surface);
            padding: 2rem 1.75rem;
            display: flex;
            flex-direction: column;
            gap: .375rem;
        }
        .stats__value {
            font-family: var(--font-serif);
            font-size: 2.25rem;
            color: var(--ink);
            line-height: 1;
            letter-spacing: -.02em;
        }
        .stats__label {
            font-size: .75rem;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink-muted);
        }

        /* ────────────────────────────
           CONTENT PAIRS
        ──────────────────────────── */
        .pair {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(2.5rem, 6vw, 5rem);
            align-items: center;
        }
        @media (max-width: 768px) {
            .pair { grid-template-columns: 1fr; }
            .pair--reverse .pair__image { order: -1; }
        }
        .pair__image {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--rule);
        }
        .pair__image img {
            width: 100%;
            height: auto;
            display: block;
            filter: saturate(.9);
        }
        .pair__eyebrow {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--warm);
            margin-bottom: 1rem;
        }
        .pair__title {
            font-size: clamp(1.625rem, 3vw, 2.25rem);
            color: var(--ink);
            margin-bottom: 1.125rem;
        }
        .pair__body {
            margin-bottom: 1.75rem;
        }
        .pair__list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .625rem;
        }
        .pair__list li {
            display: flex;
            align-items: center;
            gap: .625rem;
            font-size: .875rem;
            font-weight: 500;
            color: var(--ink);
        }
        .pair__list li::before {
            content: '';
            width: 16px;
            height: 16px;
            background: var(--ink);
            border-radius: 50%;
            flex-shrink: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none'%3E%3Cpath d='M4 8l2.5 2.5 5-5' stroke='white' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        }

        /* ────────────────────────────
           WORKFLOW (Features)
        ──────────────────────────── */
        .workflow__header {
            max-width: 540px;
            margin-bottom: clamp(3rem, 6vw, 5rem);
        }
        .workflow__eyebrow {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-bottom: 1rem;
        }
        .workflow__title {
            font-size: clamp(1.875rem, 3.5vw, 2.625rem);
            color: var(--ink);
            margin-bottom: .875rem;
        }
        .workflow__steps {
            display: flex;
            flex-direction: column;
            gap: 0;
            border-top: 1px solid var(--rule);
        }
        .step {
            display: grid;
            grid-template-columns: 80px 1fr 1fr;
            gap: 2.5rem;
            align-items: center;
            padding: clamp(2rem, 4vw, 3rem) 0;
            border-bottom: 1px solid var(--rule);
            transition: background .2s;
        }
        .step:hover { background: rgba(255,255,255,.6); }
        @media (max-width: 768px) {
            .step { grid-template-columns: 1fr; gap: 1.25rem; }
            .step__num { font-size: 2rem; }
        }
        .step__num {
            font-family: var(--font-serif);
            font-size: 3rem;
            color: var(--rule);
            line-height: 1;
            letter-spacing: -.03em;
        }
        .step__content {}
        .step__title {
            font-size: 1.1875rem;
            color: var(--ink);
            margin-bottom: .5rem;
        }
        .step__body { font-size: .875rem; }
        .step__image {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--rule);
        }
        .step__image img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
            filter: saturate(.8) brightness(.97);
        }
        @media (max-width: 768px) {
            .step__image { display: none; }
        }

        /* ────────────────────────────
           TESTIMONIALS
        ──────────────────────────── */
        .testi { background: var(--surface); }
        .testi__header { text-align: center; margin-bottom: clamp(2.5rem, 5vw, 4rem); }
        .testi__title { font-size: clamp(1.875rem, 3.5vw, 2.75rem); color: var(--ink); margin-bottom: .75rem; }
        .testi__sub { font-size: .9rem; }
        .testi__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        @media (max-width: 768px) {
            .testi__grid { grid-template-columns: 1fr; }
        }
        .testi__card {
            padding: 2rem;
            border: 1px solid var(--rule);
            border-radius: 8px;
            background: var(--bg);
            transition: border-color .25s, box-shadow .25s;
        }
        .testi__card:hover { border-color: #C4C0BA; box-shadow: 0 6px 20px rgba(0,0,0,.05); }
        .testi__card--featured {
            background: var(--ink);
            border-color: var(--ink);
        }
        .testi__card--featured p { color: rgba(255,255,255,.65); }
        .testi__avatar {
            display: flex;
            align-items: center;
            gap: .875rem;
            margin-bottom: 1.25rem;
        }
        .testi__avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--rule);
        }
        .testi__card--featured .testi__avatar img { border-color: rgba(255,255,255,.2); }
        .testi__name {
            font-size: .875rem;
            font-weight: 600;
            color: var(--ink);
        }
        .testi__card--featured .testi__name { color: #fff; }
        .testi__role {
            font-size: .75rem;
            color: var(--ink-muted);
            font-weight: 500;
        }
        .testi__card--featured .testi__role { color: rgba(255,255,255,.45); }
        .testi__quote {
            font-size: .875rem;
            line-height: 1.7;
            color: var(--ink-muted);
        }
        .testi__quote strong { color: var(--ink); font-weight: 600; }

        /* ────────────────────────────
           FAQ
        ──────────────────────────── */
        .faq { background: var(--bg); }
        .faq__header { max-width: 480px; margin-bottom: clamp(2.5rem, 5vw, 4rem); }
        .faq__eyebrow {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-bottom: 1rem;
        }
        .faq__title {
            font-size: clamp(1.875rem, 3.5vw, 2.75rem);
            color: var(--ink);
            margin-bottom: .75rem;
        }
        .faq__items { border-top: 1px solid var(--rule); }
        .faq__item { border-bottom: 1px solid var(--rule); }
        .faq__trigger {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.375rem 0;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
        }
        .faq__question {
            font-family: var(--font-serif);
            font-size: 1.0625rem;
            color: var(--ink);
            line-height: 1.3;
        }
        .faq__icon {
            width: 28px;
            height: 28px;
            border: 1px solid var(--rule);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background .2s, border-color .2s, transform .3s;
        }
        .faq__icon svg { width: 12px; height: 12px; stroke: var(--ink-muted); transition: transform .3s; }
        .faq__item.open .faq__icon { background: var(--ink); border-color: var(--ink); }
        .faq__item.open .faq__icon svg { stroke: #fff; transform: rotate(45deg); }
        .faq__answer {
            overflow: hidden;
            max-height: 0;
            transition: max-height .4s ease, padding .3s ease;
            padding-bottom: 0;
        }
        .faq__item.open .faq__answer { max-height: 300px; padding-bottom: 1.375rem; }
        .faq__answer p { font-size: .9rem; }
        .faq__footer { margin-top: 2.5rem; font-size: .875rem; color: var(--ink-muted); }
        .faq__footer a { color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }

        /* ────────────────────────────
           CTA
        ──────────────────────────── */
        .cta { padding-block: clamp(4rem, 8vw, 6rem); }
        .cta__box {
            background: var(--ink);
            border-radius: 12px;
            padding: clamp(2.5rem, 6vw, 5rem) clamp(2rem, 5vw, 4rem);
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2.5rem;
            align-items: center;
        }
        @media (max-width: 640px) {
            .cta__box { grid-template-columns: 1fr; }
        }
        .cta__eyebrow {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255,255,255,.4);
            margin-bottom: .875rem;
        }
        .cta__title {
            font-size: clamp(1.875rem, 4vw, 3rem);
            color: #fff;
            margin-bottom: .75rem;
        }
        .cta__title em { color: rgba(196,149,122,.85); }
        .cta__sub { font-size: .9rem; color: rgba(255,255,255,.5); }
        .cta__actions { display: flex; flex-direction: column; gap: .75rem; align-items: flex-start; }
        @media (max-width: 640px) { .cta__actions { flex-direction: row; flex-wrap: wrap; } }
        .btn--cta-primary {
            background: #fff;
            color: var(--ink);
            padding: .8125rem 1.75rem;
            white-space: nowrap;
            font-size: .9rem;
        }
        .btn--cta-primary:hover { background: #F2EFEB; }
        .btn--cta-ghost {
            font-size: .8rem;
            font-weight: 500;
            color: rgba(255,255,255,.45);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: rgba(255,255,255,.2);
            transition: color .2s;
        }
        .btn--cta-ghost:hover { color: rgba(255,255,255,.8); }

        /* ────────────────────────────
           FOOTER
        ──────────────────────────── */
        .footer {
            background: #111008;
            padding-block: 4rem 2.5rem;
        }
        .footer__top {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr;
            gap: clamp(2rem, 5vw, 4rem);
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: 2rem;
        }
        @media (max-width: 768px) {
            .footer__top { grid-template-columns: 1fr 1fr; }
            .footer__brand { grid-column: 1 / -1; }
        }
        .footer__brand-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }
        .footer__brand-logo img {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,.1);
        }
        .footer__brand-name {
            font-family: var(--font-sans);
            font-weight: 700;
            font-size: 1.125rem;
            color: #fff;
            letter-spacing: -.02em;
        }
        .footer__brand-name span { color: #8287C5; }
        .footer__tagline {
            font-size: .875rem;
            color: rgba(255,255,255,.35);
            line-height: 1.75;
            max-width: 32ch;
        }
        .footer__col-label {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: rgba(255,255,255,.25);
            margin-bottom: 1.125rem;
        }
        .footer__links { list-style: none; display: flex; flex-direction: column; gap: .625rem; }
        .footer__links a {
            font-size: .8125rem;
            font-weight: 500;
            color: rgba(255,255,255,.4);
            transition: color .2s;
        }
        .footer__links a:hover { color: rgba(255,255,255,.85); }
        .footer__bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .footer__copy {
            font-size: .75rem;
            color: rgba(255,255,255,.2);
            letter-spacing: .06em;
        }
        .footer__copy span { color: rgba(130,135,197,.4); }
        .footer__tech {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 4px;
            padding: .3rem .65rem;
        }
        .footer__socials { display: flex; gap: .75rem; margin-top: 1.25rem; }
        .footer__social {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color .2s, background .2s;
        }
        .footer__social svg { width: 16px; height: 16px; fill: rgba(255,255,255,.4); transition: fill .2s; }
        .footer__social:hover { border-color: rgba(255,255,255,.3); background: rgba(255,255,255,.05); }
        .footer__social:hover svg { fill: rgba(255,255,255,.8); }

        /* ────────────────────────────
           SECTION BG VARIANTS
        ──────────────────────────── */
        .bg-surface { background: var(--surface); }
        .bg-bg      { background: var(--bg); }

        /* ── Divider rule ── */
        .rule { border: none; border-top: 1px solid var(--rule); }

        /* ────────────────────────────
           MODAL SYSTEM
        ──────────────────────────── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 5000;
            background: rgba(26, 24, 20, 0.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: max(2rem, 5vh) 1.25rem;
            overflow-y: auto;
        }
        .modal {
            background: var(--surface);
            border: 1px solid var(--rule);
            border-radius: 14px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 60px rgba(0,0,0,.12);
            position: relative;
            overflow: hidden;
            max-height: 85vh; /* Batasi tinggi maksimal modal 85% dari tinggi layar */
            display: flex;
            flex-direction: column;
        }
        /* Tambahkan kelas baru ini di bawah .modal */
        .modal__content-wrapper {
            overflow-y: auto;
            padding-bottom: 1.75rem; /* Jarak bawah form */
        }
        /* Subtle grain on modal too */
        .modal::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .025;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        }
        .modal__header {
            padding: 1.75rem 1.75rem 0;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }
        .modal__brand {
            display: flex;
            align-items: center;
            gap: .625rem;
            margin-bottom: 1.25rem;
        }
        .modal__brand img {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid var(--rule);
        }
        .modal__brand-name {
            font-family: var(--font-sans);
            font-size: .875rem;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -.01em;
        }
        .modal__brand-name span { color: var(--accent); }
        .modal__close {
            width: 30px;
            height: 30px;
            border: 1px solid var(--rule);
            border-radius: 50%;
            background: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background .15s, border-color .15s;
            margin-top: -.125rem;
        }
        .modal__close:hover { background: var(--bg); border-color: var(--ink-muted); }
        .modal__close svg { width: 12px; height: 12px; stroke: var(--ink-muted); }
        .modal__title {
            font-size: 1.5rem;
            color: var(--ink);
            margin-bottom: .375rem;
        }
        .modal__sub {
            font-size: .8125rem;
            color: var(--ink-muted);
            margin-bottom: 0;
            line-height: 1.5;
        }
        .modal__body {
            overflow-y: auto;
            padding: 1.375rem 1.75rem 1.75rem;
        }
        /* Tab switcher */
        .modal__tabs {
            display: flex;
            border-bottom: 1px solid var(--rule);
            margin-bottom: 1.5rem;
        }
        .modal__tab {
            flex: 1;
            padding: .75rem 0;
            font-size: .8125rem;
            font-weight: 600;
            color: var(--ink-muted);
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: color .2s, border-color .2s;
            letter-spacing: .01em;
            margin-bottom: -1px;
        }
        .modal__tab.active {
            color: var(--ink);
            border-bottom-color: var(--ink);
        }
        /* Form elements */
        .mform { display: flex; flex-direction: column; gap: 1rem; }
        .mform__row { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
        .mform__field { display: flex; flex-direction: column; gap: .375rem; }
        .mform__label {
            font-size: .75rem;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: .01em;
        }
        .mform__input {
            width: 100%;
            padding: .625rem .875rem;
            background: var(--bg);
            border: 1px solid var(--rule);
            border-radius: 6px;
            font-family: var(--font-sans);
            font-size: .875rem;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }
        .mform__input::placeholder { color: #B8B2AB; }
        .mform__input:focus {
            border-color: var(--accent);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(74,78,140,.08);
        }
        .mform__input.error { border-color: #c0392b; }
        .mform__error {
            font-size: .7rem;
            color: #c0392b;
            font-weight: 500;
        }
        .mform__check {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .mform__check input[type="checkbox"] {
            width: 15px;
            height: 15px;
            border: 1px solid var(--rule);
            border-radius: 3px;
            cursor: pointer;
            accent-color: var(--ink);
        }
        .mform__check label {
            font-size: .78rem;
            color: var(--ink-muted);
            cursor: pointer;
        }
        .mform__check label a { color: var(--accent); text-decoration: underline; text-underline-offset: 2px; }
        .mform__submit {
            width: 100%;
            padding: .75rem 1rem;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-family: var(--font-sans);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s;
            margin-top: .25rem;
        }
        .mform__submit:hover { opacity: .82; }
        .mform__submit:active { transform: scale(.99); }
        /* Divider or */
        .mform__or {
            display: flex;
            align-items: center;
            gap: .75rem;
            color: var(--ink-muted);
            font-size: .75rem;
        }
        .mform__or::before, .mform__or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--rule);
        }
        /* Google button */
        .mform__google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .625rem;
            padding: .6875rem 1rem;
            background: var(--surface);
            border: 1px solid var(--rule);
            border-radius: 6px;
            font-family: var(--font-sans);
            font-size: .8125rem;
            font-weight: 500;
            color: var(--ink);
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, border-color .2s;
        }
        .mform__google:hover { background: var(--bg); border-color: #C4C0BA; }
        .mform__google svg { flex-shrink: 0; }
        /* Switch link at bottom */
        .mform__switch {
            text-align: center;
            font-size: .78rem;
            color: var(--ink-muted);
            padding-top: .5rem;
        }
        .mform__switch button {
            background: none;
            border: none;
            font-weight: 600;
            color: var(--accent);
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 2px;
            font-size: .78rem;
            padding: 0;
        }
    </style>
</head>
<body x-data="{ modal: null }" @keydown.escape.window="modal = null" :class="modal ? 'overflow-hidden' : ''">

    <!-- ══════════════ AUTH MODAL ══════════════ -->
    <div x-show="modal !== null"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="modal-backdrop"
         @click.self="modal = null"
         style="display:none">

        <div x-show="modal !== null"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="modal">

            <div class="modal__header">
                <div>
                    <div class="modal__brand">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                        <span class="modal__brand-name">Ryn<span>Dev</span></span>
                    </div>
                    <h2 class="modal__title" x-text="modal === 'login' ? 'Selamat datang.' : 'Buat akun baru.'"></h2>
                    <p class="modal__sub" x-text="modal === 'login' ? 'Masuk untuk kelola inventarismu.' : 'Bergabung dan mulai gratis hari ini.'"></p>
                </div>
                <button class="modal__close" @click="modal = null" aria-label="Tutup">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>

            <div class="modal__body">

                <!-- Tabs -->
                <div class="modal__tabs">
                    <button class="modal__tab" :class="modal === 'login' ? 'active' : ''" @click="modal = 'login'">Masuk</button>
                    <button class="modal__tab" :class="modal === 'register' ? 'active' : ''" @click="modal = 'register'">Daftar</button>
                </div>

                <!-- ── LOGIN FORM ── -->
                <div x-show="modal === 'login'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                    <form method="POST" action="{{ route('login') }}" class="mform">
                        @csrf
                        <div class="mform__field">
                            <label class="mform__label" for="login_email">Email</label>
                            <input id="login_email" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@contoh.com" required autofocus
                                   class="mform__input @error('email') error @enderror">
                            @error('email')
                                <span class="mform__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mform__field">
                            <label class="mform__label" for="login_password">Kata Sandi</label>
                            <input id="login_password" type="password" name="password"
                                   placeholder="••••••••" required
                                   class="mform__input @error('password') error @enderror">
                            @error('password')
                                <span class="mform__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mform__check">
                            <input id="remember" type="checkbox" name="remember">
                            <label for="remember">Ingat saya di perangkat ini</label>
                        </div>

                        <button type="submit" class="mform__submit">Masuk ke Akun →</button>

                        <div class="mform__or">atau</div>

                        <a href="{{ route('google.login') }}" class="mform__google">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Masuk dengan Google
                        </a>

                        <div class="mform__switch">
                            Belum punya akun? <button type="button" @click="modal = 'register'">Daftar sekarang</button>
                        </div>
                    </form>
                </div>

                <!-- ── REGISTER FORM ── -->
                <div x-show="modal === 'register'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                    <form method="POST" action="{{ route('register') }}" class="mform">
                        @csrf
                        <div class="mform__field">
                            <label class="mform__label" for="reg_name">Nama Lengkap</label>
                            <input id="reg_name" type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Nama kamu" required
                                   class="mform__input @error('name') error @enderror">
                            @error('name')
                                <span class="mform__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mform__field">
                            <label class="mform__label" for="reg_email">Email</label>
                            <input id="reg_email" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@contoh.com" required
                                   class="mform__input @error('email') error @enderror">
                            @error('email')
                                <span class="mform__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mform__row">
                            <div class="mform__field">
                                <label class="mform__label" for="reg_password">Password</label>
                                <input id="reg_password" type="password" name="password"
                                       placeholder="••••••••" required
                                       class="mform__input @error('password') error @enderror">
                            </div>
                            <div class="mform__field">
                                <label class="mform__label" for="reg_password_confirm">Konfirmasi</label>
                                <input id="reg_password_confirm" type="password" name="password_confirmation"
                                       placeholder="••••••••" required
                                       class="mform__input">
                            </div>
                        </div>
                        @error('password')
                            <span class="mform__error">{{ $message }}</span>
                        @enderror

                        <div class="mform__check">
                            <input id="terms" type="checkbox" name="terms" required>
                            <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a></label>
                        </div>

                        <button type="submit" class="mform__submit">Buat Akun →</button>

                        <div class="mform__or">atau</div>

                        <a href="{{ route('google.login') }}" class="mform__google">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Daftar dengan Google
                        </a>

                        <div class="mform__switch">
                            Sudah punya akun? <button type="button" @click="modal = 'login'">Masuk</button>
                        </div>
                    </form>
                </div>

            </div><!-- /modal__body -->
        </div><!-- /modal -->
    </div><!-- /modal-backdrop -->

    <!-- ══════════════ NAVBAR ══════════════ -->
    <nav class="nav" x-data="{ open: false, drop: false }">
        <div class="container">
            <div class="nav__inner">
                <a href="{{ url('/') }}" class="nav__brand">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                    <div>
                        <span class="nav__brand-name">Ryn<span>Dev</span></span>
                        <span class="nav__brand-sub">Smart Inventory</span>
                    </div>
                </a>

                <ul class="nav__links">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#faq">Bantuan</a></li>
                    <li class="nav__divider" aria-hidden="true"></li>

                    @guest
                        <li><button @click="modal = 'login'" class="btn btn--ghost">Masuk</button></li>
                        <li><button @click="modal = 'register'" class="btn btn--primary">Daftar Gratis</button></li>
                    @else
                        <li>
                            <div class="dropdown" x-data="{ dropdownOpen: false }">
                                <button @click="dropdownOpen = !dropdownOpen"
                                        @click.away="dropdownOpen = false"
                                        :class="dropdownOpen ? 'open' : ''"
                                        class="dropdown__trigger">
                                    {{ Auth::user()->name }}
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                                <div x-show="dropdownOpen"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="dropdown__menu">
                                    <a href="/dashboard">Dashboard</a>
                                    <a href="{{ route('logout') }}" class="danger"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>

                <!-- Mobile toggle -->
                <button @click="open = !open" class="nav__toggle" aria-label="Menu">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/>
                        <path x-show="open"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile panel -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="nav__mobile"
                 style="display:none">
                <a href="#beranda" @click="open=false">Beranda</a>
                <a href="#fitur"   @click="open=false">Fitur</a>
                <a href="#faq"     @click="open=false">Bantuan</a>
                @guest
                    <button @click="open=false; $nextTick(() => { modal = 'login' })" style="display:block; width:100%; text-align:left; background:none; border:none; padding:.625rem 0; font-size:.9rem; font-weight:500; color:var(--ink-muted); border-bottom:1px solid var(--rule); cursor:pointer;">Masuk</button>
                    <button @click="open=false; $nextTick(() => { modal = 'register' })" style="display:block; width:100%; text-align:left; background:none; border:none; padding:.625rem 0; font-size:.9rem; font-weight:600; color:var(--accent); cursor:pointer;">Daftar Gratis →</button>
                @else
                    <a href="/dashboard">Dashboard</a>
                    <a href="{{ route('logout') }}" style="color:#b00"
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Keluar</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- ══════════════ ALERT ══════════════ -->
    @if(session('success'))
        <div id="alert-success" class="alert-success">
            <div class="alert-success__icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <div class="alert-success__title">Berhasil</div>
                <div class="alert-success__msg">{{ session('success') }}</div>
            </div>
            <button class="alert-success__close" onclick="dismissAlert()">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
        </div>
        <script>
            function dismissAlert() {
                const el = document.getElementById('alert-success');
                if (el) { el.style.opacity = '0'; el.style.transform = 'translateY(-10px)'; setTimeout(() => el.remove(), 400); }
            }
            setTimeout(dismissAlert, 4000);
        </script>
    @endif

    <!-- ══════════════ HERO ══════════════ -->
    <section class="hero section" id="beranda">
        <div class="container">
            {{-- <div class="hero__eyebrow">Smart Inventory v1.0 · 2026</div> --}}
            <h1 class="hero__headline reveal">
                Kelola Stok Barang<br>
                <em>Tanpa Ribet.</em>
            </h1>
            <p class="hero__sub reveal">
                Satu platform terpadu untuk mengontrol aset gudang secara digital.
                Dapatkan laporan <strong>akurat secara real-time</strong> dan pantau
                pergerakan barang langsung dari browser.
            </p>
            <div class="hero__actions reveal">
                <button @click="modal = 'register'" class="btn btn--primary btn--hero">
                    Mulai Sekarang — Gratis
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5-5 5M6 12h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <a href="#fitur" class="hero__link">Lihat cara kerjanya</a>
            </div>

            <div class="hero__image reveal">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000"
                     alt="Gudang RynDev">
                <div class="hero__image-overlay"></div>
                <div class="hero__stat">
                    <span class="hero__stat-value">1,284</span>
                    <span class="hero__stat-label">Item dikelola</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ STATS BAND ══════════════ -->
    <div class="stats">
        <div class="container">
            <div class="stats__grid">
                <div class="stats__item reveal">
                    <span class="stats__value">99%</span>
                    <span class="stats__label">Akurasi data</span>
                </div>
                <div class="stats__item reveal">
                    <span class="stats__value">24/7</span>
                    <span class="stats__label">Real-time sync</span>
                </div>
                <div class="stats__item reveal">
                    <span class="stats__value">10k+</span>
                    <span class="stats__label">Item dikelola</span>
                </div>
                <div class="stats__item reveal">
                    <span class="stats__value">Full</span>
                    <span class="stats__label">Enkripsi cloud</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════ CONTENT PAIRS ══════════════ -->
    <section class="section bg-bg">
        <div class="container">
            <!-- Pair 1 -->
            <div class="pair reveal" style="margin-bottom: clamp(4rem,8vw,6rem)">
                <div class="pair__image">
                    <img src="https://cdn.devdojo.com/images/december2020/productivity.png" alt="Efisiensi gudang">
                </div>
                <div>
                    <p class="pair__eyebrow">Efisiensi Gudang</p>
                    <h2 class="pair__title">Pantau stok barang tanpa perlu pusing.</h2>
                    <p class="pair__body">Kelola ribuan data barang di gudang sekolah dengan sistem yang terorganisir. RynDev membantu kamu melacak masuk dan keluarnya barang secara real-time.</p>
                    <ul class="pair__list">
                        <li>Update stok otomatis tiap transaksi</li>
                        <li>Pencarian barang super cepat</li>
                        <li>Kategorisasi barang yang rapi</li>
                    </ul>
                </div>
            </div>

            <!-- Pair 2 -->
            <div class="pair pair--reverse reveal">
                <div class="pair__image">
                    <img src="https://cdn.devdojo.com/images/december2020/settings.png" alt="Smart reporting">
                </div>
                <div>
                    <p class="pair__eyebrow">Smart Reporting</p>
                    <h2 class="pair__title">Laporan PDF siap pakai, hanya sekali klik.</h2>
                    <p class="pair__body">Lupakan cara manual yang membosankan. Buat laporan bulanan atau tahunan dalam format PDF profesional dengan desain yang sudah disiapkan.</p>
                    <ul class="pair__list">
                        <li>Export laporan PDF instan</li>
                        <li>Filter data berdasarkan periode</li>
                        <li>Data akurat sesuai database</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ WORKFLOW / FEATURES ══════════════ -->
    <section class="section bg-surface" id="fitur">
        <div class="container">
            <div class="workflow__header reveal">
                <p class="workflow__eyebrow">Cara Kerja</p>
                <h2 class="workflow__title">Tiga langkah untuk sistem inventaris yang beres.</h2>
                <p>Kami rancang sistem yang kompleks menjadi antarmuka yang sederhana dan bisa langsung dipakai.</p>
            </div>

            <div class="workflow__steps">
                <!-- Step 1 -->
                <div class="step reveal">
                    <span class="step__num">01</span>
                    <div class="step__content">
                        <h3 class="step__title">Input Master Data</h3>
                        <p class="step__body">Daftarkan merek dan data barang kamu. Sistem otomatis mengatur struktur database yang optimal untuk pencarian cepat.</p>
                    </div>
                    <div class="step__image">
                        <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="Step 1">
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="step reveal">
                    <span class="step__num">02</span>
                    <div class="step__content">
                        <h3 class="step__title">Transaksi Real-Time</h3>
                        <p class="step__body">Catat barang masuk dan keluar dengan mudah. Stok diperbarui otomatis — kamu selalu punya data terkini.</p>
                    </div>
                    <div class="step__image">
                        <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="Step 2">
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="step reveal">
                    <span class="step__num">03</span>
                    <div class="step__content">
                        <h3 class="step__title">Generate Laporan Otomatis</h3>
                        <p class="step__body">Download laporan stok dalam format PDF atau Excel kapanpun dibutuhkan — cocok untuk kebutuhan audit.</p>
                    </div>
                    <div class="step__image">
                        <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="Step 3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ TESTIMONIALS ══════════════ -->
    <section class="section testi" id="testimoni">
        <div class="container">
            <div class="testi__header reveal">
                <h2 class="testi__title">Dipercaya guru &amp; staf sarpras.</h2>
                <p class="testi__sub">Apa kata mereka setelah pakai RynDev.</p>
            </div>
            <div class="testi__grid">
                <div class="testi__card reveal">
                    <div class="testi__avatar">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" alt="Pak Budi">
                        <div>
                            <div class="testi__name">Pak Budi Santoso</div>
                            <div class="testi__role">Kepala Sarpras</div>
                        </div>
                    </div>
                    <p class="testi__quote">"Dulu pendataan barang pakai buku besar sering hilang datanya. Sekarang pakai <strong>RynDev</strong>, semua stok terpantau jelas dari HP!"</p>
                </div>

                <div class="testi__card testi__card--featured reveal">
                    <div class="testi__avatar">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="Ibu Siti">
                        <div>
                            <div class="testi__name">Ibu Siti Aminah</div>
                            <div class="testi__role">Admin Lab RPL</div>
                        </div>
                    </div>
                    <p class="testi__quote">"Fitur peminjaman barang sangat membantu melacak siapa yang bawa kamera sekolah. Laporannya juga rapi banget!"</p>
                </div>

                <div class="testi__card reveal">
                    <div class="testi__avatar">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Andika">
                        <div>
                            <div class="testi__name">Andika Pratama</div>
                            <div class="testi__role">Ketua OSIS</div>
                        </div>
                    </div>
                    <p class="testi__quote">"Minjam alat buat acara OSIS jadi nggak ribet lagi. Tinggal input, approve, beres. Desainnya juga keren untuk ukuran aplikasi sekolah."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ FAQ ══════════════ -->
    <section class="section faq" id="faq">
        <div class="container">
            <div class="faq__header reveal">
                <p class="faq__eyebrow">Bantuan & Dukungan</p>
                <h2 class="faq__title">Pertanyaan yang sering muncul.</h2>
                <p>Masih bingung? Mungkin jawaban di bawah membantu.</p>
            </div>

            <div class="faq__items">
                <div class="faq__item reveal">
                    <button class="faq__trigger" onclick="toggleFaq(this)">
                        <span class="faq__question">Gimana cara mulai pakai RynDev Smart Inventory?</span>
                        <span class="faq__icon">
                            <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="faq__answer">
                        <p>Klik tombol <strong>"Daftar Gratis"</strong>, isi formulir pendaftaran, dan kamu langsung bisa akses dashboard untuk kelola gudangmu — tanpa instalasi tambahan.</p>
                    </div>
                </div>

                <div class="faq__item reveal">
                    <button class="faq__trigger" onclick="toggleFaq(this)">
                        <span class="faq__question">Apakah datanya bisa diekspor ke PDF atau Excel?</span>
                        <span class="faq__icon">
                            <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="faq__answer">
                        <p>Tentu. RynDev mendukung ekspor otomatis ke <strong>Excel</strong> maupun <strong>PDF</strong> — laporan stok bulanan, riwayat barang masuk/keluar — hanya satu klik.</p>
                    </div>
                </div>

                <div class="faq__item reveal">
                    <button class="faq__trigger" onclick="toggleFaq(this)">
                        <span class="faq__question">Apakah data sekolah aman disimpan di sini?</span>
                        <span class="faq__icon">
                            <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="faq__answer">
                        <p>Sangat aman. Kami menggunakan enkripsi standar industri dan backup berkala. Data hanya bisa diakses oleh akun admin yang terdaftar.</p>
                    </div>
                </div>
            </div>

            <p class="faq__footer reveal">
                Masih ada pertanyaan?
                <a href="https://wa.me/+6288222150964">Hubungi kami lewat WhatsApp.</a>
            </p>
        </div>
    </section>

    <!-- ══════════════ CTA ══════════════ -->
    <section class="cta">
        <div class="container">
            <div class="cta__box reveal">
                <div>
                    <p class="cta__eyebrow">Siap mulai?</p>
                    <h2 class="cta__title">Digitalisasi gudangmu<br><em>sekarang juga.</em></h2>
                    <p class="cta__sub">Efisien, akurat, dan modern — tanpa pusing pencatatan manual.</p>
                </div>
                <div class="cta__actions">
                    <button @click="modal = 'register'" class="btn btn--cta-primary">
                        Daftar Sekarang — Gratis
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5-5 5M6 12h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <a href="#fitur" class="btn--cta-ghost">Lihat cara kerjanya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ FOOTER ══════════════ -->
    <footer class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="footer__brand">
                    <div class="footer__brand-logo">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                        <span class="footer__brand-name">Ryn<span>Dev</span></span>
                    </div>
                    <p class="footer__tagline">
                        Membantu sekolah dan UMKM mendigitalisasi aset mereka dengan sistem manajemen stok yang presisi &amp; efisien.
                    </p>
                    <div class="footer__socials">
                        <a href="https://www.instagram.com/rdiettyaa" class="footer__social" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@rdietyyaa" class="footer__social" aria-label="TikTok">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <p class="footer__col-label">Navigasi</p>
                    <ul class="footer__links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#fitur">Fitur Utama</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <p class="footer__col-label">Legal</p>
                    <ul class="footer__links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer__bottom">
                <p class="footer__copy">&copy; {{ date('Y') }} Ryn Dev Studio. <span>Indonesia.</span></p>
                <span class="footer__tech">Laravel 12 × Tailwind</span>
            </div>
        </div>
    </footer>

    <!-- ══════════════ SCRIPTS ══════════════ -->
    <script>
        /* Scroll reveal */
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        /* FAQ toggle */
        function toggleFaq(btn) {
            const item = btn.closest('.faq__item');
            const wasOpen = item.classList.contains('open');
            document.querySelectorAll('.faq__item.open').forEach(i => i.classList.remove('open'));
            if (!wasOpen) item.classList.add('open');
        }

        /* Stagger reveal children slightly */
        document.querySelectorAll('.stats__grid .stats__item, .testi__grid .testi__card, .workflow__steps .step').forEach((el, i) => {
            el.style.transitionDelay = (i * 80) + 'ms';
        });
    </script>

    {{-- Auto-open modal after validation error.
         Blade logic lives OUTSIDE <script> tags to avoid parser conflicts. --}}
    @if($errors->any())
        @php $openTab = old('name') ? 'register' : 'login'; @endphp
        <script>
            document.addEventListener('alpine:initialized', () => {
                const bd = document.body._x_dataStack?.[0];
                if (bd) bd.modal = '{{ $openTab }}';
            });
        </script>
    @endif

</body>
</html>