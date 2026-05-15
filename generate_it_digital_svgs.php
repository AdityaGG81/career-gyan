<?php

$dir = __DIR__ . '/public/images/careers/it-digital-technology/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$svgs = [
    'devops-engineer' => [
        'bg' => '#1e3a8a', 'bg2' => '#3b82f6',
        'content' => '
        <path d="M50 100 Q100 50 150 100 T50 100" fill="none" stroke="#93c5fd" stroke-width="8" stroke-dasharray="10,5" stroke-linecap="round"/>
        <path d="M50 100 Q100 150 150 100 T50 100" fill="none" stroke="#93c5fd" stroke-width="8" stroke-dasharray="10,5" stroke-linecap="round"/>
        <circle cx="50" cy="100" r="15" fill="#60a5fa"/>
        <circle cx="150" cy="100" r="15" fill="#60a5fa"/>
        <circle cx="100" cy="100" r="25" fill="#bfdbfe"/>
        <path d="M90 100 L110 100 M100 90 L100 110" stroke="#1d4ed8" stroke-width="4"/>
        '
    ],
    'machine-learning-engineer' => [
        'bg' => '#4c1d95', 'bg2' => '#8b5cf6',
        'content' => '
        <circle cx="100" cy="100" r="40" fill="none" stroke="#c4b5fd" stroke-width="6"/>
        <path d="M60 100 L140 100 M100 60 L100 140 M72 72 L128 128 M72 128 L128 72" stroke="#ddd6fe" stroke-width="4"/>
        <circle cx="100" cy="100" r="15" fill="#f5f3ff"/>
        <circle cx="60" cy="100" r="8" fill="#a78bfa"/>
        <circle cx="140" cy="100" r="8" fill="#a78bfa"/>
        <circle cx="100" cy="60" r="8" fill="#a78bfa"/>
        <circle cx="100" cy="140" r="8" fill="#a78bfa"/>
        '
    ],
    'deep-learning-engineer' => [
        'bg' => '#1e1b4b', 'bg2' => '#4f46e5',
        'content' => '
        <circle cx="50" cy="60" r="10" fill="#a5b4fc"/><circle cx="50" cy="100" r="10" fill="#a5b4fc"/><circle cx="50" cy="140" r="10" fill="#a5b4fc"/>
        <circle cx="100" cy="80" r="10" fill="#c7d2fe"/><circle cx="100" cy="120" r="10" fill="#c7d2fe"/>
        <circle cx="150" cy="100" r="10" fill="#e0e7ff"/>
        <path d="M60 60 L90 80 M60 60 L90 120 M60 100 L90 80 M60 100 L90 120 M60 140 L90 80 M60 140 L90 120" stroke="#818cf8" stroke-width="2"/>
        <path d="M110 80 L140 100 M110 120 L140 100" stroke="#818cf8" stroke-width="2"/>
        '
    ],
    'nlp-engineer' => [
        'bg' => '#064e3b', 'bg2' => '#10b981',
        'content' => '
        <path d="M40 70 Q 100 20 160 70 L160 110 Q 100 160 40 110 Z" fill="#6ee7b7" rx="10"/>
        <circle cx="80" cy="90" r="10" fill="#064e3b"/>
        <circle cx="120" cy="90" r="10" fill="#064e3b"/>
        <path d="M90 110 Q 100 120 110 110" fill="none" stroke="#064e3b" stroke-width="6" stroke-linecap="round"/>
        <path d="M50 140 L80 120" stroke="#6ee7b7" stroke-width="15" stroke-linecap="round"/>
        '
    ],
    'computer-vision-engineer' => [
        'bg' => '#831843', 'bg2' => '#db2777',
        'content' => '
        <rect x="40" y="60" width="120" height="80" fill="none" stroke="#fbcfe8" stroke-width="8" rx="10"/>
        <path d="M40 80 L60 80 M40 120 L60 120 M140 80 L160 80 M140 120 L160 120" stroke="#f9a8d4" stroke-width="4"/>
        <path d="M80 60 L80 80 M120 60 L120 80 M80 120 L80 140 M120 120 L120 140" stroke="#f9a8d4" stroke-width="4"/>
        <circle cx="100" cy="100" r="20" fill="#f472b6"/>
        <circle cx="100" cy="100" r="8" fill="#831843"/>
        '
    ],
    'data-engineer' => [
        'bg' => '#0f172a', 'bg2' => '#475569',
        'content' => '
        <ellipse cx="100" cy="50" rx="40" ry="15" fill="#94a3b8"/>
        <path d="M60 50 L60 80 A40 15 0 0 0 140 80 L140 50" fill="#cbd5e1"/>
        <ellipse cx="100" cy="80" rx="40" ry="15" fill="#94a3b8"/>
        <path d="M60 80 L60 110 A40 15 0 0 0 140 110 L140 80" fill="#e2e8f0"/>
        <ellipse cx="100" cy="110" rx="40" ry="15" fill="#94a3b8"/>
        <path d="M60 110 L60 140 A40 15 0 0 0 140 140 L140 110" fill="#f1f5f9"/>
        <ellipse cx="100" cy="140" rx="40" ry="15" fill="#cbd5e1"/>
        '
    ],
    'data-analyst' => [
        'bg' => '#14532d', 'bg2' => '#22c55e',
        'content' => '
        <rect x="50" y="100" width="20" height="40" fill="#86efac" rx="2"/>
        <rect x="90" y="70" width="20" height="70" fill="#4ade80" rx="2"/>
        <rect x="130" y="40" width="20" height="100" fill="#bbf7d0" rx="2"/>
        <path d="M40 140 L160 140" stroke="#dcfce7" stroke-width="6" stroke-linecap="round"/>
        <path d="M60 90 L100 60 L140 30" stroke="#f0fdf4" stroke-width="4" fill="none" stroke-linecap="round"/>
        <circle cx="60" cy="90" r="4" fill="#f0fdf4"/>
        <circle cx="100" cy="60" r="4" fill="#f0fdf4"/>
        <circle cx="140" cy="30" r="4" fill="#f0fdf4"/>
        '
    ],
    'bi-analyst' => [
        'bg' => '#78350f', 'bg2' => '#d97706',
        'content' => '
        <circle cx="100" cy="100" r="50" fill="#fde68a"/>
        <path d="M100 100 L100 50 A50 50 0 0 1 150 100 Z" fill="#f59e0b"/>
        <path d="M100 100 L150 100 A50 50 0 0 1 50 100 Z" fill="#b45309"/>
        <circle cx="100" cy="100" r="15" fill="#fffbeb"/>
        <rect x="140" y="40" width="30" height="15" fill="#fcd34d" rx="4"/>
        '
    ],
    'ai-product-manager' => [
        'bg' => '#3b0764', 'bg2' => '#9333ea',
        'content' => '
        <rect x="60" y="40" width="80" height="120" fill="#d8b4fe" rx="10"/>
        <path d="M60 70 L140 70" stroke="#f3e8ff" stroke-width="4"/>
        <circle cx="100" cy="110" r="20" fill="#a855f7"/>
        <path d="M100 95 L100 125 M85 110 L115 110" stroke="#f3e8ff" stroke-width="4"/>
        <circle cx="100" cy="55" r="5" fill="#7e22ce"/>
        '
    ],
    'prompt-engineer' => [
        'bg' => '#0f766e', 'bg2' => '#14b8a6',
        'content' => '
        <path d="M50 70 L70 90 L50 110" stroke="#ccfbf1" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <line x1="90" y1="110" x2="140" y2="110" stroke="#99f6e4" stroke-width="8" stroke-linecap="round"/>
        <rect x="145" y="100" width="10" height="20" fill="#5eead4" />
        '
    ],
    'mlops-engineer' => [
        'bg' => '#9d174d', 'bg2' => '#e11d48',
        'content' => '
        <circle cx="100" cy="100" r="45" fill="none" stroke="#fecdd3" stroke-width="10" stroke-dasharray="20,10"/>
        <polygon points="100,70 120,110 80,110" fill="#fb7185"/>
        <path d="M100 55 L100 45 L115 45" stroke="#fecdd3" stroke-width="6" fill="none"/>
        <path d="M100 145 L100 155 L85 155" stroke="#fecdd3" stroke-width="6" fill="none"/>
        '
    ],
    'site-reliability-engineer' => [
        'bg' => '#b45309', 'bg2' => '#f59e0b',
        'content' => '
        <rect x="50" y="50" width="100" height="40" fill="#fde68a" rx="5"/>
        <rect x="50" y="110" width="100" height="40" fill="#fcd34d" rx="5"/>
        <circle cx="130" cy="70" r="8" fill="#16a34a"/>
        <circle cx="130" cy="130" r="8" fill="#16a34a"/>
        <line x1="100" y1="90" x2="100" y2="110" stroke="#fef3c7" stroke-width="6"/>
        <path d="M60 70 L80 70 M60 130 L80 130" stroke="#b45309" stroke-width="4" stroke-linecap="round"/>
        '
    ],
    'backend-developer' => [
        'bg' => '#1e3a8a', 'bg2' => '#2563eb',
        'content' => '
        <rect x="60" y="40" width="80" height="120" fill="#93c5fd" rx="8"/>
        <line x1="60" y1="70" x2="140" y2="70" stroke="#60a5fa" stroke-width="4"/>
        <line x1="60" y1="100" x2="140" y2="100" stroke="#60a5fa" stroke-width="4"/>
        <line x1="60" y1="130" x2="140" y2="130" stroke="#60a5fa" stroke-width="4"/>
        <circle cx="120" cy="55" r="5" fill="#1e3a8a"/>
        <circle cx="120" cy="85" r="5" fill="#1e3a8a"/>
        <circle cx="120" cy="115" r="5" fill="#1e3a8a"/>
        '
    ],
    'frontend-developer' => [
        'bg' => '#4c1d95', 'bg2' => '#7c3aed',
        'content' => '
        <rect x="40" y="50" width="120" height="90" fill="#c4b5fd" rx="5"/>
        <rect x="40" y="50" width="120" height="20" fill="#8b5cf6" rx="5"/>
        <circle cx="55" cy="60" r="4" fill="#f5f3ff"/>
        <circle cx="70" cy="60" r="4" fill="#f5f3ff"/>
        <circle cx="85" cy="60" r="4" fill="#f5f3ff"/>
        <rect x="50" y="80" width="60" height="50" fill="#ede9fe" rx="2"/>
        <rect x="120" y="80" width="30" height="50" fill="#ede9fe" rx="2"/>
        <path d="M90 140 L110 140 M100 140 L100 160 M70 160 L130 160" stroke="#c4b5fd" stroke-width="6"/>
        '
    ],
    'mobile-app-developer' => [
        'bg' => '#064e3b', 'bg2' => '#10b981',
        'content' => '
        <rect x="65" y="30" width="70" height="140" fill="#a7f3d0" rx="10"/>
        <rect x="75" y="40" width="50" height="100" fill="#ecfdf5" rx="5"/>
        <circle cx="100" cy="155" r="5" fill="#34d399"/>
        <rect x="85" y="60" width="30" height="10" fill="#6ee7b7" rx="2"/>
        <rect x="85" y="80" width="30" height="10" fill="#6ee7b7" rx="2"/>
        <rect x="85" y="100" width="30" height="10" fill="#6ee7b7" rx="2"/>
        '
    ],
    'android-developer' => [
        'bg' => '#166534', 'bg2' => '#22c55e',
        'content' => '
        <path d="M60 100 A40 40 0 0 1 140 100 Z" fill="#bbf7d0"/>
        <rect x="60" y="105" width="80" height="60" fill="#bbf7d0" rx="10"/>
        <circle cx="85" cy="85" r="4" fill="#166534"/>
        <circle cx="115" cy="85" r="4" fill="#166534"/>
        <path d="M75 60 L65 40 M125 60 L135 40" stroke="#bbf7d0" stroke-width="4" stroke-linecap="round"/>
        '
    ],
    'ios-developer' => [
        'bg' => '#0f172a', 'bg2' => '#334155',
        'content' => '
        <path d="M100 130 C70 130 70 80 100 80 C120 80 130 90 130 100 A20 20 0 0 0 115 110 C115 130 100 130 100 130 Z" fill="#e2e8f0"/>
        <path d="M100 80 C110 80 110 60 100 60 C90 60 90 80 100 80 Z" fill="#e2e8f0"/>
        <rect x="70" y="150" width="60" height="4" fill="#cbd5e1" rx="2"/>
        '
    ],
    'flutter-developer' => [
        'bg' => '#0c4a6e', 'bg2' => '#0284c7',
        'content' => '
        <path d="M110 50 L140 80 L70 150 L40 120 Z" fill="#bae6fd"/>
        <path d="M100 120 L130 150 L160 150 L100 90 Z" fill="#bae6fd"/>
        <path d="M110 110 L130 130 L100 130 Z" fill="#7dd3fc"/>
        '
    ],
    'react-developer' => [
        'bg' => '#1e3a8a', 'bg2' => '#3b82f6',
        'content' => '
        <ellipse cx="100" cy="100" rx="20" ry="50" fill="none" stroke="#93c5fd" stroke-width="6" transform="rotate(30 100 100)"/>
        <ellipse cx="100" cy="100" rx="20" ry="50" fill="none" stroke="#93c5fd" stroke-width="6" transform="rotate(90 100 100)"/>
        <ellipse cx="100" cy="100" rx="20" ry="50" fill="none" stroke="#93c5fd" stroke-width="6" transform="rotate(150 100 100)"/>
        <circle cx="100" cy="100" r="10" fill="#bfdbfe"/>
        '
    ],
    'laravel-developer' => [
        'bg' => '#7f1d1d', 'bg2' => '#dc2626',
        'content' => '
        <path d="M50 50 L80 100 L50 150 L110 150 L150 50 Z" fill="#fecaca"/>
        <path d="M80 100 L110 150 L150 50 Z" fill="#fca5a5"/>
        <circle cx="150" cy="50" r="10" fill="#fee2e2"/>
        '
    ],
    'wordpress-developer' => [
        'bg' => '#172554', 'bg2' => '#1e40af',
        'content' => '
        <circle cx="100" cy="100" r="50" fill="none" stroke="#bfdbfe" stroke-width="10"/>
        <path d="M65 80 L80 140 L100 90 L120 140 L135 80" stroke="#bfdbfe" stroke-width="6" fill="none" stroke-linejoin="round"/>
        '
    ],
    'qa-tester' => [
        'bg' => '#064e3b', 'bg2' => '#10b981',
        'content' => '
        <rect x="50" y="40" width="100" height="120" fill="#a7f3d0" rx="8"/>
        <path d="M70 70 L90 90 L130 50" stroke="#059669" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M70 110 L90 130 L130 90" stroke="#059669" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="70" y="140" width="60" height="8" fill="#6ee7b7" rx="4"/>
        '
    ],
    'software-tester' => [
        'bg' => '#4c1d95', 'bg2' => '#8b5cf6',
        'content' => '
        <path d="M70 60 L130 60 A20 20 0 0 1 150 80 L150 120 A20 20 0 0 1 130 140 L70 140 A20 20 0 0 1 50 120 L50 80 A20 20 0 0 1 70 60 Z" fill="#ddd6fe"/>
        <circle cx="100" cy="100" r="20" fill="#8b5cf6"/>
        <circle cx="100" cy="100" r="8" fill="#f5f3ff"/>
        <path d="M120 120 L140 140" stroke="#ddd6fe" stroke-width="8" stroke-linecap="round"/>
        '
    ],
    'automation-tester' => [
        'bg' => '#9d174d', 'bg2' => '#e11d48',
        'content' => '
        <rect x="50" y="50" width="100" height="80" fill="#fecdd3" rx="10"/>
        <path d="M50 80 L150 80" stroke="#fb7185" stroke-width="4"/>
        <path d="M90 100 L100 110 L120 90" stroke="#e11d48" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="70" y="130" width="60" height="20" fill="#fda4af" rx="5"/>
        <circle cx="100" cy="140" r="5" fill="#fecdd3"/>
        '
    ],
    'penetration-tester' => [
        'bg' => '#1e1b4b', 'bg2' => '#4f46e5',
        'content' => '
        <path d="M100 40 L150 60 L150 110 C150 140 100 170 100 170 C100 170 50 140 50 110 L50 60 Z" fill="none" stroke="#c7d2fe" stroke-width="10"/>
        <path d="M80 90 L120 130 M120 90 L80 130" stroke="#ef4444" stroke-width="10" stroke-linecap="round"/>
        '
    ],
    'security-analyst' => [
        'bg' => '#14532d', 'bg2' => '#22c55e',
        'content' => '
        <circle cx="100" cy="100" r="50" fill="#86efac"/>
        <circle cx="100" cy="100" r="30" fill="#14532d"/>
        <path d="M90 100 L100 110 L120 85" stroke="#4ade80" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="90" y="30" width="20" height="20" fill="#bbf7d0" rx="4"/>
        '
    ],
    'soc-analyst' => [
        'bg' => '#0f172a', 'bg2' => '#334155',
        'content' => '
        <rect x="40" y="60" width="50" height="40" fill="#cbd5e1" rx="4"/>
        <rect x="110" y="60" width="50" height="40" fill="#cbd5e1" rx="4"/>
        <rect x="75" y="110" width="50" height="40" fill="#cbd5e1" rx="4"/>
        <circle cx="100" cy="100" r="15" fill="#f87171"/>
        <path d="M100 85 L100 115" stroke="#fee2e2" stroke-width="4"/>
        <path d="M85 100 L115 100" stroke="#fee2e2" stroke-width="4"/>
        '
    ],
    'ethical-hacker' => [
        'bg' => '#1e3a8a', 'bg2' => '#2563eb',
        'content' => '
        <rect x="40" y="50" width="120" height="80" fill="#1e40af" rx="5"/>
        <path d="M50 70 L70 90 L50 110" stroke="#60a5fa" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <line x1="80" y1="110" x2="110" y2="110" stroke="#60a5fa" stroke-width="6" stroke-linecap="round"/>
        <path d="M140 130 C150 130 160 140 160 150" stroke="#93c5fd" stroke-width="6" fill="none" stroke-linecap="round"/>
        <path d="M140 110 C160 110 170 120 170 140" stroke="#93c5fd" stroke-width="4" fill="none" stroke-linecap="round"/>
        '
    ],
    'digital-forensics-analyst' => [
        'bg' => '#78350f', 'bg2' => '#b45309',
        'content' => '
        <rect x="50" y="40" width="100" height="120" fill="#fde68a" rx="5"/>
        <circle cx="100" cy="100" r="30" fill="none" stroke="#d97706" stroke-width="8"/>
        <line x1="120" y1="120" x2="140" y2="140" stroke="#d97706" stroke-width="10" stroke-linecap="round"/>
        <line x1="70" y1="60" x2="130" y2="60" stroke="#fcd34d" stroke-width="6" stroke-linecap="round"/>
        <line x1="70" y1="80" x2="100" y2="80" stroke="#fcd34d" stroke-width="6" stroke-linecap="round"/>
        '
    ],
    'network-security-engineer' => [
        'bg' => '#4c1d95', 'bg2' => '#6d28d9',
        'content' => '
        <rect x="80" y="40" width="40" height="120" fill="#c4b5fd" rx="5"/>
        <rect x="40" y="80" width="120" height="40" fill="#c4b5fd" rx="5"/>
        <rect x="90" y="90" width="20" height="20" fill="#f5f3ff" rx="4"/>
        <path d="M60 40 L60 60 M140 40 L140 60 M60 140 L60 160 M140 140 L140 160" stroke="#ede9fe" stroke-width="6" stroke-linecap="round"/>
        '
    ],
    'cloud-architect' => [
        'bg' => '#0ea5e9', 'bg2' => '#38bdf8',
        'content' => '
        <path d="M60 100 A20 20 0 0 1 60 60 A30 30 0 0 1 120 50 A25 25 0 0 1 140 90 A20 20 0 0 1 140 130 L60 130 A20 20 0 0 1 60 100 Z" fill="#e0f2fe"/>
        <circle cx="80" cy="90" r="15" fill="#bae6fd"/>
        <circle cx="110" cy="95" r="10" fill="#bae6fd"/>
        <path d="M100 130 L100 160 M90 150 L110 150" stroke="#e0f2fe" stroke-width="6" stroke-linecap="round"/>
        '
    ],
    'solutions-architect' => [
        'bg' => '#b45309', 'bg2' => '#f59e0b',
        'content' => '
        <rect x="40" y="80" width="40" height="40" fill="#fde68a" rx="5"/>
        <rect x="120" y="50" width="40" height="40" fill="#fcd34d" rx="5"/>
        <rect x="120" y="110" width="40" height="40" fill="#fcd34d" rx="5"/>
        <path d="M80 100 L100 100 M100 100 L100 70 M100 70 L120 70 M100 100 L100 130 M100 130 L120 130" stroke="#fef3c7" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        '
    ],
    'erp-consultant' => [
        'bg' => '#0f766e', 'bg2' => '#14b8a6',
        'content' => '
        <rect x="60" y="50" width="80" height="80" fill="#ccfbf1" rx="10"/>
        <path d="M60 70 L140 70" stroke="#99f6e4" stroke-width="4"/>
        <rect x="75" y="85" width="20" height="20" fill="#2dd4bf" rx="2"/>
        <rect x="105" y="85" width="20" height="20" fill="#2dd4bf" rx="2"/>
        <circle cx="100" cy="130" r="10" fill="#ccfbf1"/>
        <path d="M100 130 L100 160 M80 160 L120 160" stroke="#ccfbf1" stroke-width="4" stroke-linecap="round"/>
        '
    ],
    'crm-developer' => [
        'bg' => '#c2410c', 'bg2' => '#ea580c',
        'content' => '
        <circle cx="100" cy="80" r="30" fill="#ffedd5"/>
        <path d="M50 150 Q 100 100 150 150" fill="none" stroke="#ffedd5" stroke-width="20" stroke-linecap="round"/>
        <circle cx="130" cy="60" r="15" fill="#fed7aa"/>
        <circle cx="70" cy="60" r="15" fill="#fed7aa"/>
        <path d="M90 85 Q 100 95 110 85" fill="none" stroke="#ea580c" stroke-width="4" stroke-linecap="round"/>
        '
    ],
    'technical-support-engineer' => [
        'bg' => '#1e3a8a', 'bg2' => '#2563eb',
        'content' => '
        <rect x="50" y="60" width="100" height="70" fill="#bfdbfe" rx="5"/>
        <path d="M50 130 L150 130 L160 145 L40 145 Z" fill="#93c5fd"/>
        <path d="M100 60 L100 40 M90 40 L110 40" stroke="#dbeafe" stroke-width="4" stroke-linecap="round"/>
        <circle cx="120" cy="95" r="15" fill="#1e40af"/>
        <path d="M115 95 L125 95 M120 90 L120 100" stroke="#bfdbfe" stroke-width="3" stroke-linecap="round"/>
        '
    ]
];

foreach ($svgs as $slug => $data) {
    $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad_' . $slug . '" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:' . $data['bg'] . ';stop-opacity:1" />
            <stop offset="100%" style="stop-color:' . $data['bg2'] . ';stop-opacity:1" />
        </linearGradient>
    </defs>
    <rect width="200" height="200" fill="url(#grad_' . $slug . ')"/>
    <g transform="scale(0.9) translate(10, 5)">
    ' . $data['content'] . '
    </g>
    <text x="100" y="175" font-family="Segoe UI, Roboto, Helvetica, Arial, sans-serif" font-size="11" fill="white" text-anchor="middle" font-weight="600" opacity="0.9">' . strtoupper(str_replace('-', ' ', $slug)) . '</text>
    <rect x="80" y="185" width="40" height="2" fill="white" opacity="0.5"/>
</svg>';

    file_put_contents($dir . $slug . '.svg', $svg);
}

echo "35 Unique SVGs generated successfully for IT & Digital Technology.\n";
