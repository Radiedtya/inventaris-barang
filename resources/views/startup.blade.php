<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }} | RynDev Smart Solution</title>
        <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        <style>
            /* ── Tokens ── */
            :root {
                --bg: #f9f7f4;
                --surface: #ffffff;
                --ink: #1a1814;
                --ink-muted: #7a756f;
                --rule: #e3ddd7;
                --accent: #4a4e8c;
                --warm: #c4957a;
                --font-serif: 'DM Serif Display', Georgia, serif;
                --font-sans: 'Inter', system-ui, sans-serif;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html {
                font-size: 16px;
                scroll-behavior: smooth;
            }

            body {
                font-family: var(--font-sans);
                background-color: var(--bg);
                color: var(--ink);
                -webkit-font-smoothing: antialiased;
                overflow-x: hidden;
            }

            /* ── Typography ── */
            h1,
            h2,
            h3 {
                font-family: var(--font-serif);
                font-weight: 400;
                line-height: 1.1;
                letter-spacing: -0.01em;
            }

            p {
                line-height: 1.7;
                color: var(--ink-muted);
                font-size: 0.9375rem;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            /* ── Layout helpers ── */
            .container {
                max-width: 1160px;
                margin-inline: auto;
                padding-inline: clamp(1.25rem, 5vw, 3rem);
            }
            .section {
                padding-block: clamp(4rem, 10vw, 7rem);
            }

            /* ── Fade-in on scroll ── */
            .reveal {
                opacity: 0;
                transform: translateY(18px);
                transition:
                    opacity 0.6s ease,
                    transform 0.6s ease;
            }
            .reveal.visible {
                opacity: 1;
                transform: none;
            }

            /* ────────────────────────────
           NAVBAR - PILL STYLE (Premium)
        ──────────────────────────── */
            .nav-wrapper {
                position: sticky;
                top: 16px;
                z-index: 100;
                padding: 0 1rem;
                margin-bottom: -16px;
                transition: all 0.3s ease;
            }

            .nav-wrapper.scrolled {
                top: 12px;
            }

            .nav-container {
                max-width: 1280px;
                margin: 0 auto;
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 80px;
                box-shadow:
                    0 1px 3px rgba(0, 0, 0, 0.02),
                    0 1px 2px rgba(0, 0, 0, 0.03);
                transition: all 0.3s ease;
            }

            .nav-wrapper.scrolled .nav-container {
                background: rgba(255, 255, 255, 0.98);
                box-shadow:
                    0 8px 24px rgba(0, 0, 0, 0.04),
                    0 1px 3px rgba(0, 0, 0, 0.05);
                border-color: rgba(226, 232, 240, 0.9);
            }

            .nav-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.5rem 1.5rem;
                height: 68px;
                transition: all 0.3s ease;
            }

            .nav-wrapper.scrolled .nav-inner {
                height: 56px;
                padding: 0.25rem 1.5rem;
            }

            /* Brand */
            .brand-link {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
                transition: opacity 0.2s ease;
            }

            .brand-link:hover {
                opacity: 0.85;
            }

            .brand-icon-wrapper {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                overflow: hidden;
                border: 1px solid rgba(226, 232, 240, 0.6);
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                transition: all 0.3s ease;
            }

            .nav-wrapper.scrolled .brand-icon-wrapper {
                width: 32px;
                height: 32px;
            }

            .brand-link:hover .brand-icon-wrapper {
                transform: scale(1.02);
            }

            .brand-icon {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .brand-text {
                display: flex;
                flex-direction: column;
            }

            .brand-name {
                font-size: 0.9375rem;
                font-weight: 700;
                letter-spacing: -0.02em;
                color: #0f172a;
                line-height: 1.2;
            }

            .nav-wrapper.scrolled .brand-name {
                font-size: 0.875rem;
            }

            .brand-name-light {
                font-weight: 400;
                color: #64748b;
            }

            .brand-badge {
                font-size: 0.5625rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: #4a4e8c;
                margin-top: 1px;
            }

            .nav-wrapper.scrolled .brand-badge {
                font-size: 0.5rem;
            }

            /* Desktop Navigation Links - Tengah */
            .nav-links-desktop {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }

            @media (max-width: 1024px) {
                .nav-links-desktop {
                    position: static;
                    transform: none;
                }
            }

            .nav-link {
                font-size: 0.8125rem;
                font-weight: 500;
                color: #64748b;
                text-decoration: none;
                transition: all 0.2s ease;
                padding: 0.375rem 0;
                position: relative;
                cursor: pointer;
            }

            .nav-wrapper.scrolled .nav-link {
                font-size: 0.75rem;
            }

            .nav-link:hover {
                color: #0f172a;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                background: #4a4e8c;
                border-radius: 2px;
                transition: width 0.2s ease;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .nav-link.active {
                color: #0f172a;
            }

            .nav-link.active::after {
                width: 100%;
            }

            .nav-divider {
                width: 1px;
                height: 20px;
                background: #e2e8f0;
                margin: 0 0.25rem;
            }

            .nav-wrapper.scrolled .nav-divider {
                height: 16px;
            }

            /* Right side wrapper */
            .nav-right {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            /* Buttons */
            .btn-ghost {
                background: transparent;
                border: none;
                font-size: 0.8125rem;
                font-weight: 500;
                color: #64748b;
                padding: 0.5rem 1rem;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.2s ease;
                font-family: inherit;
            }

            .nav-wrapper.scrolled .btn-ghost {
                font-size: 0.75rem;
                padding: 0.375rem 0.875rem;
            }

            .btn-ghost:hover {
                color: #0f172a;
                background: #f8fafc;
            }

            .btn-primary {
                background: #0f172a;
                border: none;
                font-size: 0.8125rem;
                font-weight: 600;
                color: white;
                padding: 0.5625rem 1.25rem;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-family: inherit;
            }

            .nav-wrapper.scrolled .btn-primary {
                font-size: 0.75rem;
                padding: 0.4375rem 1rem;
            }

            .btn-primary:hover {
                background: #1e293b;
                transform: translateY(-1px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            }

            .btn-icon {
                width: 14px;
                height: 14px;
            }

            /* Dropdown */
            .dropdown {
                position: relative;
            }

            .dropdown-trigger {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.375rem 0.75rem 0.375rem 0.5rem;
                background: transparent;
                border: 1px solid transparent;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.2s ease;
                font-family: inherit;
            }

            .nav-wrapper.scrolled .dropdown-trigger {
                padding: 0.25rem 0.625rem 0.25rem 0.375rem;
            }

            .dropdown-trigger:hover {
                background: #f8fafc;
                border-color: #e2e8f0;
            }

            .dropdown-trigger.open {
                background: #f8fafc;
                border-color: #e2e8f0;
            }

            .user-avatar {
                width: 28px;
                height: 28px;
                border-radius: 8px;
                overflow: hidden;
                background: #f1f5f9;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .nav-wrapper.scrolled .user-avatar {
                width: 24px;
                height: 24px;
            }

            .avatar-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* Avatar inisial tanpa gambar */
            .avatar-initial {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #4a4e8c;
                color: white;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .user-name {
                font-size: 0.8125rem;
                font-weight: 500;
                color: #334155;
            }

            .nav-wrapper.scrolled .user-name {
                font-size: 0.75rem;
            }

            .dropdown-arrow {
                width: 14px;
                height: 14px;
                color: #94a3b8;
                transition: transform 0.25s ease;
            }

            .dropdown-trigger.open .dropdown-arrow {
                transform: rotate(180deg);
            }

            .dropdown-menu {
                position: absolute;
                right: 0;
                top: calc(100% + 12px);
                min-width: 240px;
                background: white;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
                overflow: hidden;
                z-index: 200;
            }

            .dropdown-header {
                padding: 1rem 1rem;
                border-bottom: 1px solid #f1f5f9;
                background: #fafbfc;
            }

            .dropdown-label {
                font-size: 0.5625rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: #94a3b8;
                margin-bottom: 0.5rem;
            }

            .dropdown-role {
                font-size: 0.75rem;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 0.25rem;
            }

            .dropdown-email {
                font-size: 0.6875rem;
                color: #64748b;
            }

            .dropdown-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.75rem 1rem;
                font-size: 0.8125rem;
                font-weight: 500;
                color: #334155;
                text-decoration: none;
                transition: all 0.15s ease;
            }

            .dropdown-item:hover {
                background: #f8fafc;
                color: #0f172a;
            }

            .dropdown-item-icon {
                width: 16px;
                height: 16px;
                color: #94a3b8;
            }

            .dropdown-item:hover .dropdown-item-icon {
                color: #4a4e8c;
            }

            .dropdown-divider {
                height: 1px;
                background: #f1f5f9;
                margin: 0.25rem 0;
            }

            .dropdown-item-danger {
                color: #e11d48;
            }

            .dropdown-item-danger:hover {
                background: #fff5f5;
                color: #e11d48;
            }

            .dropdown-item-danger:hover .dropdown-item-icon {
                color: #e11d48;
            }

            /* Mobile Menu Button */
            .mobile-menu-btn {
                display: none;
                background: transparent;
                border: 1px solid #e2e8f0;
                border-radius: 40px;
                padding: 0.5rem 0.75rem;
                cursor: pointer;
                color: #64748b;
                transition: all 0.2s ease;
            }

            .mobile-menu-btn:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
            }

            /* Mobile Menu */
            .mobile-menu {
                display: none;
                border-top: 1px solid #e2e8f0;
                background: white;
                padding: 1rem 1.5rem;
                border-radius: 0 0 40px 40px;
                max-height: calc(100vh - 80px);
                overflow-y: auto;
            }

            .mobile-menu.open {
                display: block;
            }

            @media (max-width: 768px) {
                .nav-links-desktop {
                    display: none;
                }

                .mobile-menu-btn {
                    display: flex;
                    align-items: center;
                }

                .nav-wrapper {
                    top: 8px;
                    padding: 0 0.75rem;
                }

                .nav-inner {
                    padding: 0.375rem 1.25rem;
                    height: 60px;
                }

                .nav-wrapper.scrolled .nav-inner {
                    height: 52px;
                }
            }

            .mobile-nav-link {
                display: block;
                padding: 0.75rem 0;
                font-size: 0.875rem;
                font-weight: 500;
                color: #64748b;
                text-decoration: none;
                border-bottom: 1px solid #f1f5f9;
                transition: color 0.2s ease;
                cursor: pointer;
            }

            .mobile-nav-link:last-child {
                border-bottom: none;
            }

            .mobile-nav-link:hover {
                color: #0f172a;
            }

            .mobile-nav-link.active {
                color: #0f172a;
                font-weight: 600;
                border-left: 3px solid #4a4e8c;
                padding-left: 0.75rem;
            }

            .mobile-nav-link-danger {
                color: #e11d48;
            }

            .mobile-nav-link-danger:hover {
                color: #e11d48;
            }

            .mobile-divider {
                height: 1px;
                background: #e2e8f0;
                margin: 0.75rem 0;
            }

            .mobile-btn-ghost {
                display: block;
                width: 100%;
                text-align: center;
                padding: 0.75rem;
                margin: 0.5rem 0;
                font-size: 0.875rem;
                font-weight: 500;
                color: #64748b;
                background: transparent;
                border: 1px solid #e2e8f0;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .mobile-btn-ghost:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
            }

            .mobile-btn-primary {
                display: block;
                width: 100%;
                text-align: center;
                padding: 0.75rem;
                margin: 0.5rem 0;
                font-size: 0.875rem;
                font-weight: 600;
                color: white;
                background: #0f172a;
                border: none;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .mobile-btn-primary:hover {
                background: #1e293b;
                transform: translateY(-1px);
            }

            .mobile-user-info {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.75rem 0;
                margin-bottom: 0.5rem;
                border-bottom: 1px solid #f1f5f9;
            }

            .mobile-avatar {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: #f1f5f9;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #4a4e8c;
                color: white;
                font-weight: 600;
                font-size: 0.875rem;
            }

            .mobile-user-name {
                font-size: 0.875rem;
                font-weight: 600;
                color: #0f172a;
            }

            .mobile-user-role {
                font-size: 0.625rem;
                font-weight: 500;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            /* HERO */
            .hero {
                position: relative;
                padding-block: clamp(4rem, 8vw, 7rem) clamp(4rem, 10vw, 7rem);
                background:
                    linear-gradient(135deg, rgba(249, 247, 244, 0.94) 0%, rgba(249, 247, 244, 0.88) 100%),
                    url('https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&q=80&w=2070');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                margin-top: -20px;
                padding-top: clamp(6rem, 12vw, 9rem);
            }
            .hero__eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--ink-muted);
                margin-bottom: 2rem;
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
            .hero__headline em::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: -2px;
                right: -2px;
                height: 8px;
                background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 220 12' fill='none'%3E%3Cpath d='M2 9c28-5 56-8 85-7 29 1 58 4 87 2 14-.9 28-2 42-3.5' stroke='%23C4957A' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E")
                    center/100% 100% no-repeat;
                opacity: 0.75;
            }
            .hero__sub {
                font-size: 1.0625rem;
                color: var(--ink-muted);
                max-width: 50ch;
                margin-bottom: 2.75rem;
                line-height: 1.75;
            }
            .hero__sub strong {
                color: var(--ink);
                font-weight: 600;
            }
            .hero__actions {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                align-items: center;
                margin-bottom: 4rem;
            }
            .hero__image {
                border-radius: 12px;
                overflow: hidden;
                border: 1px solid var(--rule);
                box-shadow: 0 24px 60px -10px rgba(26, 24, 20, 0.1);
                position: relative;
            }
            .hero__image img {
                width: 100%;
                height: clamp(220px, 40vw, 520px);
                object-fit: cover;
                display: block;
                filter: saturate(0.88) brightness(0.97);
                transition: transform 0.8s ease;
            }
            .hero__image:hover img {
                transform: scale(1.02);
            }
            .hero__image-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(26, 24, 20, 0.32) 0%, transparent 50%);
                pointer-events: none;
            }
            .hero__stat {
                position: absolute;
                bottom: 1.25rem;
                right: 1.25rem;
                background: rgba(249, 247, 244, 0.92);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.6);
                border-radius: 10px;
                padding: 0.875rem 1.125rem;
                display: flex;
                flex-direction: column;
            }
            .hero__stat-value {
                font-family: var(--font-serif);
                font-size: 1.75rem;
                color: var(--ink);
                line-height: 1;
            }
            .hero__stat-label {
                font-size: 0.7rem;
                font-weight: 500;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--ink-muted);
                margin-top: 0.25rem;
            }

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
                .stats__grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            .stats__item {
                background: var(--surface);
                padding: 2rem 1.75rem;
                display: flex;
                flex-direction: column;
                gap: 0.375rem;
            }
            .stats__value {
                font-family: var(--font-serif);
                font-size: 2.25rem;
                color: var(--ink);
                line-height: 1;
                letter-spacing: -0.02em;
            }
            .stats__label {
                font-size: 0.75rem;
                font-weight: 500;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--ink-muted);
            }

            .pair {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: clamp(2.5rem, 6vw, 5rem);
                align-items: center;
            }
            @media (max-width: 768px) {
                .pair {
                    grid-template-columns: 1fr;
                }
                .pair--reverse .pair__image {
                    order: -1;
                }
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
                filter: saturate(0.9);
            }
            .pair__eyebrow {
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.18em;
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
                gap: 0.625rem;
            }
            .pair__list li {
                display: flex;
                align-items: center;
                gap: 0.625rem;
                font-size: 0.875rem;
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

            .workflow__header {
                max-width: 540px;
                margin-bottom: clamp(3rem, 6vw, 5rem);
            }
            .workflow__eyebrow {
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--ink-muted);
                margin-bottom: 1rem;
            }
            .workflow__title {
                font-size: clamp(1.875rem, 3.5vw, 2.625rem);
                color: var(--ink);
                margin-bottom: 0.875rem;
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
                transition: background 0.2s;
            }
            .step:hover {
                background: rgba(255, 255, 255, 0.6);
            }
            @media (max-width: 768px) {
                .step {
                    grid-template-columns: 1fr;
                    gap: 1.25rem;
                }
                .step__num {
                    font-size: 2rem;
                }
            }
            .step__num {
                font-family: var(--font-serif);
                font-size: 3rem;
                color: var(--rule);
                line-height: 1;
                letter-spacing: -0.03em;
            }
            .step__title {
                font-size: 1.1875rem;
                color: var(--ink);
                margin-bottom: 0.5rem;
            }
            .step__body {
                font-size: 0.875rem;
            }
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
                filter: saturate(0.8) brightness(0.97);
            }
            @media (max-width: 768px) {
                .step__image {
                    display: none;
                }
            }

            .testi {
                background: var(--surface);
            }
            .testi__header {
                text-align: center;
                margin-bottom: clamp(2.5rem, 5vw, 4rem);
            }
            .testi__title {
                font-size: clamp(1.875rem, 3.5vw, 2.75rem);
                color: var(--ink);
                margin-bottom: 0.75rem;
            }
            .testi__sub {
                font-size: 0.9rem;
            }
            .testi__grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
            @media (max-width: 768px) {
                .testi__grid {
                    grid-template-columns: 1fr;
                }
            }
            .testi__card {
                padding: 2rem;
                border: 1px solid var(--rule);
                border-radius: 8px;
                background: var(--bg);
                transition:
                    border-color 0.25s,
                    box-shadow 0.25s;
            }
            .testi__card:hover {
                border-color: #c4c0ba;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            }
            .testi__card--featured {
                background: var(--ink);
                border-color: var(--ink);
            }
            .testi__card--featured p {
                color: rgba(255, 255, 255, 0.65);
            }
            .testi__avatar {
                display: flex;
                align-items: center;
                gap: 0.875rem;
                margin-bottom: 1.25rem;
            }
            .testi__avatar img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid var(--rule);
            }
            .testi__card--featured .testi__avatar img {
                border-color: rgba(255, 255, 255, 0.2);
            }
            .testi__name {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--ink);
            }
            .testi__card--featured .testi__name {
                color: #fff;
            }
            .testi__role {
                font-size: 0.75rem;
                color: var(--ink-muted);
                font-weight: 500;
            }
            .testi__card--featured .testi__role {
                color: rgba(255, 255, 255, 0.45);
            }
            .testi__quote {
                font-size: 0.875rem;
                line-height: 1.7;
                color: var(--ink-muted);
            }
            .testi__quote strong {
                color: var(--ink);
                font-weight: 600;
            }

            .faq {
                background: var(--bg);
            }
            .faq__header {
                max-width: 480px;
                margin-bottom: clamp(2.5rem, 5vw, 4rem);
            }
            .faq__eyebrow {
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--ink-muted);
                margin-bottom: 1rem;
            }
            .faq__title {
                font-size: clamp(1.875rem, 3.5vw, 2.75rem);
                color: var(--ink);
                margin-bottom: 0.75rem;
            }
            .faq__items {
                border-top: 1px solid var(--rule);
            }
            .faq__item {
                border-bottom: 1px solid var(--rule);
            }
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
                transition:
                    background 0.2s,
                    border-color 0.2s,
                    transform 0.3s;
            }
            .faq__icon svg {
                width: 12px;
                height: 12px;
                stroke: var(--ink-muted);
                transition: transform 0.3s;
            }
            .faq__item.open .faq__icon {
                background: var(--ink);
                border-color: var(--ink);
            }
            .faq__item.open .faq__icon svg {
                stroke: #fff;
                transform: rotate(45deg);
            }
            .faq__answer {
                overflow: hidden;
                max-height: 0;
                transition:
                    max-height 0.4s ease,
                    padding 0.3s ease;
                padding-bottom: 0;
            }
            .faq__item.open .faq__answer {
                max-height: 300px;
                padding-bottom: 1.375rem;
            }
            .faq__answer p {
                font-size: 0.9rem;
            }
            .faq__footer {
                margin-top: 2.5rem;
                font-size: 0.875rem;
                color: var(--ink-muted);
            }
            .faq__footer a {
                color: var(--accent);
                text-decoration: underline;
                text-underline-offset: 3px;
            }

            .cta {
                padding-block: clamp(4rem, 8vw, 6rem);
            }
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
                .cta__box {
                    grid-template-columns: 1fr;
                }
            }
            .cta__eyebrow {
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.4);
                margin-bottom: 0.875rem;
            }
            .cta__title {
                font-size: clamp(1.875rem, 4vw, 3rem);
                color: #fff;
                margin-bottom: 0.75rem;
            }
            .cta__title em {
                color: rgba(196, 149, 122, 0.85);
            }
            .cta__sub {
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.5);
            }
            .cta__actions {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }
            @media (max-width: 640px) {
                .cta__actions {
                    flex-direction: row;
                    flex-wrap: wrap;
                }
            }
            .btn--cta-primary {
                background: #fff;
                color: var(--ink);
                padding: 0.8125rem 1.75rem;
                white-space: nowrap;
                font-size: 0.9rem;
                border-radius: 40px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s ease;
                cursor: pointer;
                border: none;
            }
            .btn--cta-primary:hover {
                background: #f2efeb;
                transform: translateY(-1px);
            }
            .btn--cta-ghost {
                font-size: 0.8rem;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.45);
                text-decoration: underline;
                text-underline-offset: 3px;
                text-decoration-color: rgba(255, 255, 255, 0.2);
                transition: color 0.2s;
            }
            .btn--cta-ghost:hover {
                color: rgba(255, 255, 255, 0.8);
            }

            .footer {
                background: #111008;
                padding-block: 4rem 2.5rem;
            }
            .footer__top {
                display: grid;
                grid-template-columns: 1.6fr 1fr 1fr;
                gap: clamp(2rem, 5vw, 4rem);
                padding-bottom: 3rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.07);
                margin-bottom: 2rem;
            }
            @media (max-width: 768px) {
                .footer__top {
                    grid-template-columns: 1fr 1fr;
                }
                .footer__brand {
                    grid-column: 1 / -1;
                }
            }
            .footer__brand-logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }
            .footer__brand-logo img {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .footer__brand-name {
                font-family: var(--font-sans);
                font-weight: 700;
                font-size: 1.125rem;
                color: #fff;
                letter-spacing: -0.02em;
            }
            .footer__brand-name span {
                color: #8287c5;
            }
            .footer__tagline {
                font-size: 0.875rem;
                color: rgba(255, 255, 255, 0.35);
                line-height: 1.75;
                max-width: 32ch;
            }
            .footer__col-label {
                font-size: 0.65rem;
                font-weight: 700;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.25);
                margin-bottom: 1.125rem;
            }
            .footer__links {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 0.625rem;
            }
            .footer__links a {
                font-size: 0.8125rem;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.4);
                transition: color 0.2s;
            }
            .footer__links a:hover {
                color: rgba(255, 255, 255, 0.85);
            }
            .footer__bottom {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }
            .footer__copy {
                font-size: 0.75rem;
                color: rgba(255, 255, 255, 0.2);
                letter-spacing: 0.06em;
            }
            .footer__copy span {
                color: rgba(130, 135, 197, 0.4);
            }
            .footer__tech {
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.18);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 4px;
                padding: 0.3rem 0.65rem;
            }
            .footer__socials {
                display: flex;
                gap: 0.75rem;
                margin-top: 1.25rem;
            }
            .footer__social {
                width: 36px;
                height: 36px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition:
                    border-color 0.2s,
                    background 0.2s;
            }
            .footer__social svg {
                width: 16px;
                height: 16px;
                fill: rgba(255, 255, 255, 0.4);
                transition: fill 0.2s;
            }
            .footer__social:hover {
                border-color: rgba(255, 255, 255, 0.3);
                background: rgba(255, 255, 255, 0.05);
            }
            .footer__social:hover svg {
                fill: rgba(255, 255, 255, 0.8);
            }

            .modal-backdrop {
                position: fixed;
                inset: 0;
                z-index: 5000;
                background: rgba(26, 24, 20, 0.5);
                display: flex;
                justify-content: flex-end;
                opacity: 0;
                visibility: hidden;
                transition:
                    opacity 0.3s ease,
                    visibility 0.3s ease;
            }
            .modal-backdrop.active {
                opacity: 1;
                visibility: visible;
            }
            .modal {
                width: 100%;
                max-width: 480px;
                height: 100%;
                background: var(--surface);
                box-shadow: -8px 0 32px rgba(0, 0, 0, 0.1);
                transform: translateX(100%);
                transition: transform 0.3s ease;
                display: flex;
                flex-direction: column;
                overflow-y: auto;
            }
            .modal-backdrop.active .modal {
                transform: translateX(0);
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
                gap: 0.625rem;
                margin-bottom: 1rem;
            }
            .modal__brand img {
                width: 28px;
                height: 28px;
                border-radius: 6px;
                border: 1px solid var(--rule);
            }
            .modal__brand-name {
                font-family: var(--font-sans);
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--ink);
                letter-spacing: -0.01em;
            }
            .modal__brand-name span {
                color: var(--accent);
            }
            .modal__close {
                width: 32px;
                height: 32px;
                border: 1px solid var(--rule);
                border-radius: 50%;
                background: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                transition:
                    background 0.15s,
                    border-color 0.15s;
            }
            .modal__close:hover {
                background: var(--bg);
                border-color: var(--ink-muted);
            }
            .modal__close svg {
                width: 14px;
                height: 14px;
                stroke: var(--ink-muted);
            }
            .modal__title {
                font-size: 1.5rem;
                color: var(--ink);
                margin-bottom: 0.375rem;
                font-family: var(--font-serif);
            }
            .modal__sub {
                font-size: 0.8125rem;
                color: var(--ink-muted);
                margin-bottom: 0;
                line-height: 1.5;
            }
            .modal__body {
                flex: 1;
                padding: 1.5rem 1.75rem 1.75rem;
            }
            .modal__tabs {
                display: flex;
                border-bottom: 1px solid var(--rule);
                margin-bottom: 1.5rem;
            }
            .modal__tab {
                flex: 1;
                padding: 0.75rem 0;
                font-size: 0.8125rem;
                font-weight: 600;
                color: var(--ink-muted);
                background: none;
                border: none;
                border-bottom: 2px solid transparent;
                cursor: pointer;
                transition:
                    color 0.2s,
                    border-color 0.2s;
                letter-spacing: 0.01em;
                margin-bottom: -1px;
            }
            .modal__tab.active {
                color: var(--ink);
                border-bottom-color: var(--ink);
            }
            .mform {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            .mform__row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }
            .mform__field {
                display: flex;
                flex-direction: column;
                gap: 0.375rem;
            }
            .mform__label {
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--ink);
                letter-spacing: 0.01em;
            }
            .mform__input {
                width: 100%;
                padding: 0.625rem 0.875rem;
                background: var(--bg);
                border: 1px solid var(--rule);
                border-radius: 6px;
                font-family: var(--font-sans);
                font-size: 0.875rem;
                color: var(--ink);
                outline: none;
                transition:
                    border-color 0.2s,
                    background 0.2s,
                    box-shadow 0.2s;
            }
            .mform__input::placeholder {
                color: #b8b2ab;
            }
            .mform__input:focus {
                border-color: var(--accent);
                background: var(--surface);
                box-shadow: 0 0 0 3px rgba(74, 78, 140, 0.08);
            }
            .mform__input.error {
                border-color: #c0392b;
            }
            .mform__error {
                font-size: 0.7rem;
                color: #c0392b;
                font-weight: 500;
            }
            .mform__check {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .mform__check input[type='checkbox'] {
                width: 15px;
                height: 15px;
                border: 1px solid var(--rule);
                border-radius: 3px;
                cursor: pointer;
                accent-color: var(--ink);
            }
            .mform__check label {
                font-size: 0.78rem;
                color: var(--ink-muted);
                cursor: pointer;
            }
            .mform__check label a {
                color: var(--accent);
                text-decoration: underline;
                text-underline-offset: 2px;
            }
            .mform__submit {
                width: 100%;
                padding: 0.75rem 1rem;
                background: var(--ink);
                color: #fff;
                border: none;
                border-radius: 40px;
                font-family: var(--font-sans);
                font-size: 0.875rem;
                font-weight: 600;
                cursor: pointer;
                transition: opacity 0.2s;
                margin-top: 0.25rem;
            }
            .mform__submit:hover {
                opacity: 0.82;
                transform: translateY(-1px);
            }
            .mform__or {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: var(--ink-muted);
                font-size: 0.75rem;
            }
            .mform__or::before,
            .mform__or::after {
                content: '';
                flex: 1;
                height: 1px;
                background: var(--rule);
            }
            .mform__google {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.625rem;
                padding: 0.6875rem 1rem;
                background: var(--surface);
                border: 1px solid var(--rule);
                border-radius: 40px;
                font-family: var(--font-sans);
                font-size: 0.8125rem;
                font-weight: 500;
                color: var(--ink);
                cursor: pointer;
                text-decoration: none;
                transition:
                    background 0.2s,
                    border-color 0.2s;
            }
            .mform__google:hover {
                background: var(--bg);
                border-color: #c4c0ba;
            }
            .mform__switch {
                text-align: center;
                font-size: 0.78rem;
                color: var(--ink-muted);
                padding-top: 0.5rem;
            }
            .mform__switch button {
                background: none;
                border: none;
                font-weight: 600;
                color: var(--accent);
                cursor: pointer;
                text-decoration: underline;
                text-underline-offset: 2px;
                font-size: 0.78rem;
                padding: 0;
            }
        </style>
    </head>
    <body x-data="{ modal: null, activeMenu: 'beranda', mobileMenuOpen: false }" @keydown.escape.window="if(modal) { modal = null; closeModal() }" :class="modal ? 'overflow-hidden' : ''">
        <!-- AUTH MODAL -->
        <div id="authModal" class="modal-backdrop" onclick="if (event.target === this) closeModal();">
            <div class="modal">
                <div class="modal__header">
                    <div>
                        <div class="modal__brand">
                            <img src="{{ asset('logo.png') }}" alt="Logo" />
                            <span class="modal__brand-name">
                                Ryn
                                <span>Dev</span>
                            </span>
                        </div>
                        <h2 class="modal__title" id="modalTitle">Selamat datang.</h2>
                        <p class="modal__sub" id="modalSub">Masuk untuk kelola inventarismu.</p>
                    </div>
                    <button class="modal__close" onclick="closeModal()" aria-label="Tutup">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke-width="2" stroke-linecap="round" /></svg>
                    </button>
                </div>
                <div class="modal__body">
                    <div class="modal__tabs">
                        <button class="modal__tab" id="tabLogin" onclick="switchTab('login')">Masuk</button>
                        <button class="modal__tab" id="tabRegister" onclick="switchTab('register')">Daftar</button>
                    </div>
                    <div id="loginForm">
                        <form method="POST" action="{{ route('login') }}" class="mform">
                            @csrf
                            <div class="mform__field">
                                <label class="mform__label" for="login_email">Email</label>
                                <input
                                    id="login_email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="nama@contoh.com"
                                    required
                                    autofocus
                                    class="mform__input @error('email') error @enderror" />
                                @error('email')
                                    <span class="mform__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mform__field">
                                <label class="mform__label" for="login_password">Kata Sandi</label>
                                <input
                                    id="login_password"
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    class="mform__input @error('password') error @enderror" />
                                @error('password')
                                    <span class="mform__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mform__check">
                                <input id="remember" type="checkbox" name="remember" />
                                <label for="remember">Ingat saya di perangkat ini</label>
                            </div>
                            <button type="submit" class="mform__submit">Masuk ke Akun →</button>
                            <div class="mform__or">atau</div>
                            <a href="{{ route('google.login') }}" class="mform__google">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                Masuk dengan Google
                            </a>
                            <div class="mform__switch">
                                Belum punya akun?
                                <button type="button" onclick="switchTab('register')">Daftar sekarang</button>
                            </div>
                        </form>
                    </div>
                    <div id="registerForm" style="display: none">
                        <form method="POST" action="{{ route('register') }}" class="mform">
                            @csrf
                            <div class="mform__field">
                                <label class="mform__label" for="reg_name">Nama Lengkap</label>
                                <input
                                    id="reg_name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Nama kamu"
                                    required
                                    class="mform__input @error('name') error @enderror" />
                                @error('name')
                                    <span class="mform__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mform__field">
                                <label class="mform__label" for="reg_email">Email</label>
                                <input
                                    id="reg_email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="nama@contoh.com"
                                    required
                                    class="mform__input @error('email') error @enderror" />
                                @error('email')
                                    <span class="mform__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mform__row">
                                <div class="mform__field">
                                    <label class="mform__label" for="reg_password">Password</label>
                                    <input
                                        id="reg_password"
                                        type="password"
                                        name="password"
                                        placeholder="••••••••"
                                        required
                                        class="mform__input @error('password') error @enderror" />
                                </div>
                                <div class="mform__field">
                                    <label class="mform__label" for="reg_password_confirm">Konfirmasi</label>
                                    <input id="reg_password_confirm" type="password" name="password_confirmation" placeholder="••••••••" required class="mform__input" />
                                </div>
                            </div>
                            @error('password')
                                <span class="mform__error">{{ $message }}</span>
                            @enderror

                            <div class="mform__check">
                                <input id="terms" type="checkbox" name="terms" required />
                                <label for="terms">
                                    Saya setuju dengan
                                    <a href="#">Syarat & Ketentuan</a>
                                </label>
                            </div>
                            <button type="submit" class="mform__submit">Buat Akun →</button>
                            <div class="mform__or">atau</div>
                            <a href="{{ route('google.login') }}" class="mform__google">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                Daftar dengan Google
                            </a>
                            <div class="mform__switch">
                                Sudah punya akun?
                                <button type="button" onclick="switchTab('login')">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════ NAVBAR PREMIUM PILL STYLE ══════════════ -->
        <nav class="nav-wrapper" x-data="{ open: false, isScrolled: false }" @scroll.window="isScrolled = (window.pageYOffset > 10)" :class="isScrolled ? 'scrolled' : ''">
            <div class="nav-container">
                <div class="nav-inner">
                    <!-- Brand - Kiri -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="brand-link group">
                            <div class="brand-icon-wrapper">
                                <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-icon" />
                            </div>
                            <div class="brand-text">
                                <span class="brand-name">
                                    Ryn
                                    <span class="brand-name-light">Dev</span>
                                </span>
                                <span class="brand-badge">Smart Inventory</span>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation - Tengah -->
                    <div class="nav-links-desktop">
                        <a href="#beranda" class="nav-link" :class="activeMenu === 'beranda' ? 'active' : ''" @click="activeMenu = 'beranda'">Beranda</a>
                        <a href="#fitur" class="nav-link" :class="activeMenu === 'fitur' ? 'active' : ''" @click="activeMenu = 'fitur'">Fitur</a>
                        <a href="#testimoni" class="nav-link" :class="activeMenu === 'testimoni' ? 'active' : ''" @click="activeMenu = 'testimoni'">Testimoni</a>
                        <a href="#faq" class="nav-link" :class="activeMenu === 'faq' ? 'active' : ''" @click="activeMenu = 'faq'">FAQ</a>
                    </div>

                    <!-- Right side wrapper -->
                    <div class="nav-right">
                        <div class="nav-divider"></div>

                        @guest
                            <button onclick="openModal('login')" class="btn-ghost">Masuk</button>
                            <button onclick="openModal('register')" class="btn-primary">
                                Daftar Gratis
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7l5 5-5 5M6 12h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        @else
                            <div class="dropdown" x-data="{ dropdownOpen: false }">
                                <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="dropdown-trigger" :class="dropdownOpen ? 'open' : ''">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                    <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div
                                    x-show="dropdownOpen"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="dropdown-menu"
                                    style="display: none">
                                    <div class="dropdown-header">
                                        <p class="dropdown-label">Otoritas</p>
                                        <p class="dropdown-role capitalize">{{ Auth::user()->role }}</p>
                                        <p class="dropdown-email truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    @if (Auth::user()->role == 'admin')
                                        <a href="/dashboard/admin" class="dropdown-item">
                                            <svg class="dropdown-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                                    stroke-width="2" />
                                            </svg>
                                            Dashboard Admin
                                        </a>
                                    @else
                                        <a href="/dashboard" class="dropdown-item">
                                            <svg class="dropdown-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" />
                                            </svg>
                                            Dashboard Saya
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <a
                                        href="{{ route('logout') }}"
                                        class="dropdown-item dropdown-item-danger"
                                        onclick="
                                            event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                        ">
                                        <svg class="dropdown-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" />
                                        </svg>
                                        Keluar Aplikasi
                                    </a>
                                </div>
                            </div>
                        @endguest

                        <!-- Mobile Menu Button -->
                        <button @click="open = !open" class="mobile-menu-btn">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div
                    x-show="open"
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mobile-menu"
                    x-bind:class="open ? 'open' : ''">
                    @guest
                        <a href="#beranda" class="mobile-nav-link" :class="activeMenu === 'beranda' ? 'active' : ''" @click="open=false; activeMenu='beranda'">Beranda</a>
                        <a href="#fitur" class="mobile-nav-link" :class="activeMenu === 'fitur' ? 'active' : ''" @click="open=false; activeMenu='fitur'">Fitur</a>
                        <a href="#testimoni" class="mobile-nav-link" :class="activeMenu === 'testimoni' ? 'active' : ''" @click="open=false; activeMenu='testimoni'">Testimoni</a>
                        <a href="#faq" class="mobile-nav-link" :class="activeMenu === 'faq' ? 'active' : ''" @click="open=false; activeMenu='faq'">FAQ</a>
                        <div class="mobile-divider"></div>
                        <button
                            onclick="
                                openModal('login');
                                open = false;
                            "
                            class="mobile-btn-ghost">
                            Masuk
                        </button>
                        <button
                            onclick="
                                openModal('register');
                                open = false;
                            "
                            class="mobile-btn-primary">
                            Daftar Gratis →
                        </button>
                    @else
                        <div class="mobile-user-info">
                            <div class="mobile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <div>
                                <p class="mobile-user-name">{{ Auth::user()->name }}</p>
                                <p class="mobile-user-role capitalize">{{ Auth::user()->role }} Account</p>
                            </div>
                        </div>
                        <a href="#beranda" class="mobile-nav-link" :class="activeMenu === 'beranda' ? 'active' : ''" @click="open=false; activeMenu='beranda'">Beranda</a>
                        <a href="#fitur" class="mobile-nav-link" :class="activeMenu === 'fitur' ? 'active' : ''" @click="open=false; activeMenu='fitur'">Fitur</a>
                        <a href="#testimoni" class="mobile-nav-link" :class="activeMenu === 'testimoni' ? 'active' : ''" @click="open=false; activeMenu='testimoni'">Testimoni</a>
                        <a href="#faq" class="mobile-nav-link" :class="activeMenu === 'faq' ? 'active' : ''" @click="open=false; activeMenu='faq'">FAQ</a>
                        <div class="mobile-divider"></div>
                        @if (Auth::user()->role == 'admin')
                            <a href="/dashboard/admin" class="mobile-nav-link">Dashboard Admin</a>
                        @else
                            <a href="/dashboard" class="mobile-nav-link">Dashboard Saya</a>
                        @endif
                        <a
                            href="{{ route('logout') }}"
                            class="mobile-nav-link mobile-nav-link-danger"
                            onclick="
                                event.preventDefault();
                                document.getElementById('logout-form-mobile').submit();
                            ">
                            Keluar Aplikasi
                        </a>
                    @endguest
                </div>
            </div>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form>

        <!-- ALERT -->
        @if (session('success'))
            <div id="alert-success" class="alert-success">
                <div class="alert-success__icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <div class="alert-success__title">Berhasil</div>
                    <div class="alert-success__msg">{{ session('success') }}</div>
                </div>
                <button class="alert-success__close" onclick="dismissAlert()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke-width="2" stroke-linecap="round" /></svg>
                </button>
            </div>
            <script>
                function dismissAlert() {
                    const e = document.getElementById('alert-success');
                    if (e) {
                        e.style.opacity = '0';
                        e.style.transform = 'translateY(-10px)';
                        setTimeout(() => e.remove(), 400);
                    }
                }
                setTimeout(dismissAlert, 4000);
            </script>
        @endif

        <!-- HERO SECTION -->
        <section class="hero section" id="beranda">
            <div class="container">
                <div class="hero__eyebrow reveal">Smart Inventory v1.0</div>
                <h1 class="hero__headline reveal">
                    Kelola Stok Barang
                    <br />
                    <em>Tanpa Ribet.</em>
                </h1>
                <p class="hero__sub reveal">
                    Satu platform terpadu untuk mengontrol aset gudang secara digital. Dapatkan laporan
                    <strong>akurat secara real-time</strong>
                    dan pantau pergerakan barang langsung dari browser.
                </p>
                <div class="hero__actions reveal">
                    <button onclick="openModal('register')" class="btn-primary" style="padding: 0.8125rem 2rem; font-size: 0.9375rem">
                        Mulai Sekarang — Gratis
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M13 7l5 5-5 5M6 12h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <a href="#fitur" class="hero__link">Lihat cara kerjanya</a>
                </div>
                <div class="hero__image reveal">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000" alt="Gudang RynDev" />
                    <div class="hero__image-overlay"></div>
                    <div class="hero__stat">
                        <span class="hero__stat-value">1,284+</span>
                        <span class="hero__stat-label">Item dikelola</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS BAND -->
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

        <!-- CONTENT PAIRS -->
        <section class="section bg-bg">
            <div class="container">
                <div class="pair reveal" style="margin-bottom: clamp(4rem, 8vw, 6rem)">
                    <div class="pair__image"><img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&q=80&w=2070" alt="Manajemen stok modern" /></div>
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
                <div class="pair pair--reverse reveal">
                    <div class="pair__image"><img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=2070" alt="Laporan dan analitik" /></div>
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

        <!-- WORKFLOW -->
        <section class="section bg-surface" id="fitur">
            <div class="container">
                <div class="workflow__header reveal">
                    <p class="workflow__eyebrow">Cara Kerja</p>
                    <h2 class="workflow__title">Tiga langkah untuk sistem inventaris yang beres.</h2>
                    <p>Kami rancang sistem yang kompleks menjadi antarmuka yang sederhana dan bisa langsung dipakai.</p>
                </div>
                <div class="workflow__steps">
                    <div class="step reveal">
                        <span class="step__num">01</span>
                        <div class="step__content">
                            <h3 class="step__title">Input Master Data</h3>
                            <p class="step__body">Daftarkan merek dan data barang kamu. Sistem otomatis mengatur struktur database yang optimal untuk pencarian cepat.</p>
                        </div>
                        <div class="step__image"><img src="https://images.unsplash.com/photo-1554774853-719586f82d77?auto=format&fit=crop&q=80&w=2070" alt="Input data" /></div>
                    </div>
                    <div class="step reveal">
                        <span class="step__num">02</span>
                        <div class="step__content">
                            <h3 class="step__title">Transaksi Real-Time</h3>
                            <p class="step__body">Catat barang masuk dan keluar dengan mudah. Stok diperbarui otomatis — kamu selalu punya data terkini.</p>
                        </div>
                        <div class="step__image"><img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2070" alt="Transaksi" /></div>
                    </div>
                    <div class="step reveal">
                        <span class="step__num">03</span>
                        <div class="step__content">
                            <h3 class="step__title">Generate Laporan Otomatis</h3>
                            <p class="step__body">Download laporan stok dalam format PDF atau Excel kapanpun dibutuhkan — cocok untuk kebutuhan audit.</p>
                        </div>
                        <div class="step__image"><img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&q=80&w=2070" alt="Laporan" /></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="section testi" id="testimoni">
            <div class="container">
                <div class="testi__header reveal">
                    <h2 class="testi__title">Dipercaya guru &amp; staf sarpras.</h2>
                    <p class="testi__sub">Apa kata mereka setelah pakai RynDev.</p>
                </div>
                <div class="testi__grid">
                    <div class="testi__card reveal">
                        <div class="testi__avatar">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" alt="Pak Budi" />
                            <div>
                                <div class="testi__name">Pak Budi Santoso</div>
                                <div class="testi__role">Kepala Sarpras</div>
                            </div>
                        </div>
                        <p class="testi__quote">
                            "Dulu pendataan barang pakai buku besar sering hilang datanya. Sekarang pakai
                            <strong>RynDev</strong>
                            , semua stok terpantau jelas dari HP!"
                        </p>
                    </div>
                    <div class="testi__card testi__card--featured reveal">
                        <div class="testi__avatar">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="Ibu Siti" />
                            <div>
                                <div class="testi__name">Ibu Siti Aminah</div>
                                <div class="testi__role">Admin Lab RPL</div>
                            </div>
                        </div>
                        <p class="testi__quote">"Fitur peminjaman barang sangat membantu melacak siapa yang bawa kamera sekolah. Laporannya juga rapi banget!"</p>
                    </div>
                    <div class="testi__card reveal">
                        <div class="testi__avatar">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Andika" />
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

        <!-- FAQ -->
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
                                <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round" /></svg>
                            </span>
                        </button>
                        <div class="faq__answer">
                            <p>
                                Klik tombol
                                <strong>"Daftar Gratis"</strong>
                                , isi formulir pendaftaran, dan kamu langsung bisa akses dashboard untuk kelola gudangmu — tanpa instalasi tambahan.
                            </p>
                        </div>
                    </div>
                    <div class="faq__item reveal">
                        <button class="faq__trigger" onclick="toggleFaq(this)">
                            <span class="faq__question">Apakah datanya bisa diekspor ke PDF atau Excel?</span>
                            <span class="faq__icon">
                                <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round" /></svg>
                            </span>
                        </button>
                        <div class="faq__answer">
                            <p>
                                Tentu. RynDev mendukung ekspor otomatis ke
                                <strong>Excel</strong>
                                maupun
                                <strong>PDF</strong>
                                — laporan stok bulanan, riwayat barang masuk/keluar — hanya satu klik.
                            </p>
                        </div>
                    </div>
                    <div class="faq__item reveal">
                        <button class="faq__trigger" onclick="toggleFaq(this)">
                            <span class="faq__question">Apakah data sekolah aman disimpan di sini?</span>
                            <span class="faq__icon">
                                <svg fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round" /></svg>
                            </span>
                        </button>
                        <div class="faq__answer"><p>Sangat aman. Kami menggunakan enkripsi standar industri dan backup berkala. Data hanya bisa diakses oleh akun admin yang terdaftar.</p></div>
                    </div>
                </div>
                <p class="faq__footer reveal">
                    Masih ada pertanyaan?
                    <a href="https://wa.me/+6288222150964">Hubungi kami lewat WhatsApp.</a>
                </p>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta">
            <div class="container">
                <div class="cta__box reveal">
                    <div>
                        <p class="cta__eyebrow">Siap mulai?</p>
                        <h2 class="cta__title">
                            Digitalisasi gudangmu
                            <br />
                            <em>sekarang juga.</em>
                        </h2>
                        <p class="cta__sub">Efisien, akurat, dan modern — tanpa pusing pencatatan manual.</p>
                    </div>
                    <div class="cta__actions">
                        <button onclick="openModal('register')" class="btn--cta-primary">
                            Daftar Sekarang — Gratis
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 7l5 5-5 5M6 12h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <a href="#fitur" class="btn--cta-ghost">Lihat cara kerjanya</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="footer__top">
                    <div class="footer__brand">
                        <div class="footer__brand-logo">
                            <img src="{{ asset('logo.png') }}" alt="Logo" />
                            <span class="footer__brand-name">
                                Ryn
                                <span>Dev</span>
                            </span>
                        </div>
                        <p class="footer__tagline">Membantu sekolah dan UMKM mendigitalisasi aset mereka dengan sistem manajemen stok yang presisi &amp; efisien.</p>
                        <div class="footer__socials">
                            <a href="https://www.instagram.com/rdiettyaa" class="footer__social" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z" />
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/@rdietyyaa" class="footer__social" aria-label="TikTok">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
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
                    <p class="footer__copy">
                        &copy; {{ date('Y') }} Ryn Dev Studio.
                        <span>Indonesia.</span>
                    </p>
                    <span class="footer__tech">Laravel 12 × Tailwind</span>
                </div>
            </div>
        </footer>

        <script>
            // Scroll reveal
            const revealObserver = new IntersectionObserver((entries) => { entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); } }); }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

            // FAQ toggle
            function toggleFaq(btn) { const item = btn.closest('.faq__item'); const wasOpen = item.classList.contains('open'); document.querySelectorAll('.faq__item.open').forEach(i => i.classList.remove('open')); if (!wasOpen) item.classList.add('open'); }

            // Stagger reveal
            document.querySelectorAll('.stats__grid .stats__item, .testi__grid .testi__card, .workflow__steps .step').forEach((el, i) => { el.style.transitionDelay = (i * 80) + 'ms'; });

            // Modal functions
            function openModal(type) {
                const modal = document.getElementById('authModal');
                const loginForm = document.getElementById('loginForm');
                const registerForm = document.getElementById('registerForm');
                const modalTitle = document.getElementById('modalTitle');
                const modalSub = document.getElementById('modalSub');
                const tabLogin = document.getElementById('tabLogin');
                const tabRegister = document.getElementById('tabRegister');
                if (type === 'login') {
                    loginForm.style.display = 'block';
                    registerForm.style.display = 'none';
                    modalTitle.textContent = 'Selamat datang.';
                    modalSub.textContent = 'Masuk untuk kelola inventarismu.';
                    tabLogin.classList.add('active');
                    tabRegister.classList.remove('active');
                } else {
                    loginForm.style.display = 'none';
                    registerForm.style.display = 'block';
                    modalTitle.textContent = 'Buat akun baru.';
                    modalSub.textContent = 'Bergabung dan mulai gratis hari ini.';
                    tabRegister.classList.add('active');
                    tabLogin.classList.remove('active');
                }
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() { const modal = document.getElementById('authModal'); modal.classList.remove('active'); document.body.style.overflow = ''; }

            function switchTab(type) {
                const loginForm = document.getElementById('loginForm');
                const registerForm = document.getElementById('registerForm');
                const modalTitle = document.getElementById('modalTitle');
                const modalSub = document.getElementById('modalSub');
                const tabLogin = document.getElementById('tabLogin');
                const tabRegister = document.getElementById('tabRegister');
                if (type === 'login') {
                    loginForm.style.display = 'block';
                    registerForm.style.display = 'none';
                    modalTitle.textContent = 'Selamat datang.';
                    modalSub.textContent = 'Masuk untuk kelola inventarismu.';
                    tabLogin.classList.add('active');
                    tabRegister.classList.remove('active');
                } else {
                    loginForm.style.display = 'none';
                    registerForm.style.display = 'block';
                    modalTitle.textContent = 'Buat akun baru.';
                    modalSub.textContent = 'Bergabung dan mulai gratis hari ini.';
                    tabRegister.classList.add('active');
                    tabLogin.classList.remove('active');
                }
            }

            document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeModal(); } });

            // Navbar scroll effect
            window.addEventListener('scroll', function() { const wrapper = document.querySelector('.nav-wrapper'); if (wrapper) { if (window.scrollY > 10) { wrapper.classList.add('scrolled'); } else { wrapper.classList.remove('scrolled'); } } });

            // Update active menu based on scroll position (tanpa perlu klik)
            function updateActiveMenuOnScroll() {
                const sections = [
                    { id: 'beranda', element: document.getElementById('beranda') },
                    { id: 'fitur', element: document.getElementById('fitur') },
                    { id: 'testimoni', element: document.getElementById('testimoni') },
                    { id: 'faq', element: document.getElementById('faq') }
                ];

                const scrollPosition = window.scrollY + 150;

                for (const section of sections) {
                    if (section.element) {
                        const offsetTop = section.element.offsetTop;
                        const offsetBottom = offsetTop + section.element.offsetHeight;

                        if (scrollPosition >= offsetTop && scrollPosition < offsetBottom) {
                            if (window.activeMenu !== section.id) {
                                window.activeMenu = section.id;
                                // Update Alpine.js activeMenu
                                const alpineData = document.querySelector('[x-data]').__x?.$data;
                                if (alpineData) alpineData.activeMenu = section.id;
                            }
                            break;
                        }
                    }
                }
            }

            window.addEventListener('scroll', updateActiveMenuOnScroll);
            window.addEventListener('load', updateActiveMenuOnScroll);

            // Auto open modal if there are validation errors
            @if($errors->any())
                document.addEventListener('DOMContentLoaded', function() { @php $openTab = old('name') ? 'register' : 'login'; @endphp openModal('{{ $openTab }}'); });
            @endif
        </script>
    </body>
</html>
