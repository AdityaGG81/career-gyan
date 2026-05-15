<?php

$dir = __DIR__ . '/public/images/careers/engineering-industrial/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$careers = [
    'mechatronics-engineer' => 'Mechatronics Engineer',
    'renewable-energy-engineer' => 'Renewable Energy Engineer',
    'solar-energy-engineer' => 'Solar Energy Engineer',
    'wind-energy-engineer' => 'Wind Energy Engineer',
    'energy-auditor' => 'Energy Auditor',
    'hvac-engineer' => 'HVAC Engineer',
    'piping-engineer' => 'Piping Engineer',
    'structural-design-engineer' => 'Structural Design Engineer',
    'geotechnical-engineer' => 'Geotechnical Engineer',
    'transportation-engineer' => 'Transportation Engineer',
    'highway-engineer' => 'Highway Engineer',
    'bridge-engineer' => 'Bridge Engineer',
    'urban-infrastructure-engineer' => 'Urban Infrastructure Engineer',
    'fire-protection-engineer' => 'Fire Protection Engineer',
    'safety-engineer' => 'Safety Engineer',
    'quality-control-engineer' => 'Quality Control Engineer',
    'maintenance-engineer' => 'Maintenance Engineer',
    'production-engineer' => 'Production Engineer',
    'manufacturing-process-engineer' => 'Manufacturing Process Engineer',
    'packaging-engineer' => 'Packaging Engineer',
    'ceramic-engineer' => 'Ceramic Engineer',
    'polymer-engineer' => 'Polymer Engineer',
    'plastics-engineer' => 'Plastics Engineer',
    'rubber-technologist' => 'Rubber Technologist',
    'welding-engineer' => 'Welding Engineer',
    'ndt-technician' => 'NDT Technician',
    'aerospace-maintenance-engineer' => 'Aerospace Maintenance Engineer',
    'avionics-engineer' => 'Avionics Engineer',
    'drone-engineer' => 'Drone Engineer',
    'telecommunication-engineer' => 'Telecommunication Engineer'
];

$gradients = [
    ['#3b82f6', '#1d4ed8'], ['#10b981', '#047857'], ['#f59e0b', '#b45309'],
    ['#ef4444', '#b91c1c'], ['#8b5cf6', '#6d28d9'], ['#06b6d4', '#0369a1'],
    ['#f43f5e', '#be123c'], ['#84cc16', '#4d7c0f'], ['#14b8a6', '#0f766e'],
    ['#eab308', '#a16207']
];

$shapes = [
    '<circle cx="100" cy="80" r="40" fill="white" opacity="0.1"/>',
    '<rect x="60" y="40" width="80" height="80" rx="20" fill="white" opacity="0.1"/>',
    '<polygon points="100,30 150,110 50,110" fill="white" opacity="0.1"/>',
    '<ellipse cx="100" cy="80" rx="50" ry="30" fill="white" opacity="0.1"/>',
    '<path d="M50 80 Q 100 20 150 80 T 250 80" stroke="white" stroke-width="10" fill="none" opacity="0.1"/>',
    '<rect x="40" y="40" width="120" height="80" fill="white" opacity="0.1"/>'
];

$decorations = [
    '<circle cx="160" cy="40" r="15" fill="white" opacity="0.2"/>',
    '<rect x="30" y="120" width="30" height="30" rx="5" fill="white" opacity="0.2"/>',
    '<polygon points="170,140 190,170 150,170" fill="white" opacity="0.2"/>',
    '<line x1="20" y1="20" x2="60" y2="60" stroke="white" stroke-width="4" opacity="0.2"/>',
    '<path d="M20,100 A40,40 0 0,1 60,60" fill="none" stroke="white" stroke-width="4" opacity="0.2"/>'
];

$i = 0;
foreach ($careers as $slug => $name) {
    $grad = $gradients[$i % count($gradients)];
    $shape = $shapes[($i * 2) % count($shapes)];
    $dec = $decorations[($i * 3) % count($decorations)];
    $i++;

    $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad_' . $slug . '" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:' . $grad[1] . ';stop-opacity:1" />
            <stop offset="100%" style="stop-color:' . $grad[0] . ';stop-opacity:1" />
        </linearGradient>
    </defs>
    <rect width="200" height="200" fill="url(#grad_' . $slug . ')"/>
    ' . $shape . '
    ' . $dec . '
    <g transform="translate(100, 80)">
        <!-- Abstract Representation -->
        <circle r="30" fill="none" stroke="white" stroke-width="2" opacity="0.3"/>
        <path d="M-15,-15 L15,15 M-15,15 L15,-15" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
        <circle r="10" fill="white" opacity="0.4"/>
    </g>
    <text x="100" y="165" font-family="Segoe UI, Roboto, sans-serif" font-size="10" fill="white" text-anchor="middle" font-weight="700" opacity="0.95">' . strtoupper($name) . '</text>
    <rect x="80" y="175" width="40" height="2" fill="white" opacity="0.6"/>
</svg>';

    file_put_contents($dir . $slug . '.svg', $svg);
}

echo "SVGs generated successfully.\n";
