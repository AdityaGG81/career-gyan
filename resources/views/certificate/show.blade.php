<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Certificate of Completion | CareerGyan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800&family=Playfair+Display:ital,wght@0,500;0,700;1,600&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    
    <style>
        :root {
            --brand-blue: #1a56db;
            --brand-dark: #0f172a;
            --brand-light: #e8f0fe;
            --gold: #d4af37;
            --gold-dark: #b8860b;
            --border-color: #cbd5e1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        /* Controls */
        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            z-index: 100;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: white;
            color: var(--brand-dark);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            transition: all 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .btn-primary {
            background: var(--brand-blue);
            color: white;
            border-color: var(--brand-blue);
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* Responsive Container */
        .certificate-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: visible;
            padding: 20px 0;
            min-height: 650px;
        }

        /* Certificate Wrapper - Fixed resolution for layout safety */
        .certificate-wrapper {
            background: white;
            width: 900px;
            height: 636px;
            position: relative;
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.15);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            transform-origin: center center;
            flex-shrink: 0;
        }

        /* Premium Brand Blue & Gold Border */
        .certificate-border {
            border: 10px solid var(--brand-blue);
            outline: 2px solid var(--gold);
            outline-offset: -18px;
            width: 100%;
            height: 100%;
            padding: 40px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(250,252,255,1) 100%);
        }

        .corner-element {
            position: absolute;
            width: 35px;
            height: 35px;
            border: 3px solid var(--gold);
            z-index: 2;
        }

        .top-left { top: 25px; left: 25px; border-right: none; border-bottom: none; }
        .top-right { top: 25px; right: 25px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: 25px; left: 25px; border-right: none; border-top: none; }
        .bottom-right { bottom: 25px; right: 25px; border-left: none; border-top: none; }

        /* Header block */
        .header-section {
            text-align: center;
            margin-top: 10px;
        }

        .logo-text {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 22px;
            color: var(--brand-blue);
            letter-spacing: 3px;
            margin-bottom: 5px;
        }

        .logo-sub {
            font-size: 10px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .certificate-title {
            font-family: 'Cinzel', serif;
            font-weight: 800;
            font-size: 34px;
            color: var(--brand-dark);
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        .presentation-line {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 16px;
            color: #475569;
            margin-bottom: 15px;
        }

        /* Student Name */
        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 36px;
            color: var(--brand-dark);
            border-bottom: 2px solid var(--brand-blue);
            padding-bottom: 5px;
            min-width: 340px;
            text-align: center;
            margin-bottom: 18px;
            display: inline-block;
        }

        /* Description text */
        .description-text {
            text-align: center;
            font-size: 13.5px;
            color: #334155;
            line-height: 1.6;
            max-width: 680px;
            margin-bottom: 25px;
        }

        .description-text strong {
            color: var(--brand-blue);
            font-weight: 700;
        }

        /* Footer block (signatures & date) */
        .footer-section {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            padding: 0 35px;
        }

        .sig-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 220px;
            position: relative;
        }

        .sig-image-container {
            height: 85px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-bottom: 5px;
        }

        .sig-image-container img {
            max-height: 85px;
            max-width: 250px;
            object-fit: contain;
            /* Negative margin to pull transparent signature down over line naturally */
            margin-bottom: -15px; 
        }

        .sig-line {
            width: 100%;
            border-top: 1px solid #94a3b8;
            margin-bottom: 6px;
        }

        .sig-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--brand-dark);
            text-align: center;
        }

        .sig-sub {
            font-size: 9px;
            color: #64748b;
            text-align: center;
            margin-top: 2px;
        }

        /* Gold Seal SVG */
        .gold-seal-container {
            position: absolute;
            bottom: 45px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }

        .gold-seal {
            width: 75px;
            height: 75px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.12));
        }

        /* Verification metadata */
        .verification-block {
            font-size: 8px;
            color: #94a3b8;
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
            letter-spacing: 0.5px;
        }

        /* Print styling rules */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
                display: block;
            }

            .controls {
                display: none !important;
            }

            .certificate-container {
                padding: 0 !important;
                margin: 0 !important;
                min-height: 0 !important;
                height: 100vh !important;
                width: 100% !important;
                display: block !important;
            }

            .certificate-wrapper {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 0 !important;
                transform: none !important;
                width: 297mm !important; /* Full A4 Landscape width */
                height: 210mm !important; /* Full A4 Landscape height */
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                display: flex !important;
            }

            .certificate-border {
                border-width: 10px !important;
                padding: 40px !important;
                background: white !important;
                width: 100% !important;
                height: 100% !important;
            }

            @page {
                size: A4 landscape;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="controls">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fa-solid fa-print"></i> Print Certificate / Save as PDF
        </button>
        <button onclick="window.close()" class="btn">
            <i class="fa-solid fa-xmark"></i> Close Window
        </button>
    </div>

    <div class="certificate-container" id="certContainer">
        <div class="certificate-wrapper" id="certWrapper">
            <div class="certificate-border">
                <!-- Corners -->
                <div class="corner-element top-left"></div>
                <div class="corner-element top-right"></div>
                <div class="corner-element bottom-left"></div>
                <div class="corner-element bottom-right"></div>

                <!-- Header -->
                <div class="header-section">
                    <div class="logo-text">CareerGyan</div>
                    <div class="logo-sub">Indian Institute of Career Management</div>
                    <h1 class="certificate-title">Certificate of Achievement</h1>
                    <p class="presentation-line">This digital certificate is proudly presented to</p>
                </div>

                <!-- Recipient -->
                <div class="recipient-name">{{ $name }}</div>

                <!-- Description -->
                <div class="description-text">
                    For successfully completing the <strong>{{ $testTitle }}</strong>, demonstrating outstanding cognitive capability, critical analysis, and natural aptitude in <strong>{{ $topCareer }}</strong>.
                </div>

                <!-- Gold Seal in middle bottom -->
                <div class="gold-seal-container">
                    <svg class="gold-seal" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="#d4af37" stroke="#aa771c" stroke-width="2"/>
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#fff" stroke-width="1.5" stroke-dasharray="5 3"/>
                        <path d="M50 15 L55 35 L75 35 L60 48 L65 68 L50 55 L35 68 L40 48 L25 35 L45 35 Z" fill="#fff" opacity="0.95"/>
                        <path d="M40 75 L30 95 L50 88 L70 95 L60 75 Z" fill="#aa771c" opacity="0.8" style="transform-origin: 50% 50%; transform: rotate(180deg) scale(0.8); z-index: -1;"/>
                    </svg>
                </div>

                <!-- Signatures (Aligned side-by-side: Left Date, Right Signature) -->
                <div class="footer-section">
                    <!-- Date -->
                    <div class="sig-block" style="align-items: flex-start; width: 200px;">
                        <div class="sig-image-container" style="align-items: center; font-size: 14px; font-weight: 700; color: var(--brand-dark);">
                            {{ $date }}
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-title" style="text-align: left;">Verification Date</div>
                        <div class="sig-sub" style="text-align: left;">Valid Certificate ID</div>
                    </div>

                    <!-- Signature of Founder -->
                    <div class="sig-block" style="width: 220px;">
                        <div class="sig-image-container">
                            @if(file_exists(public_path('images/about/signature.png')))
                                <img src="{{ asset('images/about/signature.png') }}" alt="Signature of Founder">
                            @elseif(file_exists(public_path('images/about/signature.jpg')))
                                <img src="{{ asset('images/about/signature.jpg') }}" alt="Signature of Founder">
                            @else
                                <div style="font-family: 'Playfair Display', serif; font-size: 18px; font-style: italic; font-weight: 700; color: var(--brand-dark); letter-spacing: 1px;">D. D. Kakad</div>
                            @endif
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-title">Mr. Dyaneshwar D. Kakad</div>
                        <div class="sig-sub">Founder, IICM & CareerGyan</div>
                    </div>
                </div>

                <!-- Metadata/Security verification -->
                <div class="verification-block">
                    Verification ID: {{ strtoupper($uuid) }} • Securely generated at careergyan.in
                </div>
            </div>
        </div>
    </div>

    <script>
        function scaleCertificate() {
            const wrapper = document.getElementById('certWrapper');
            const container = document.getElementById('certContainer');
            if (!wrapper || !container) return;

            // Reset scale and height first
            wrapper.style.transform = 'none';
            container.style.height = 'auto';
            container.style.minHeight = '650px';

            const containerWidth = container.offsetWidth;
            const designWidth = 900;
            const designHeight = 636;

            if (containerWidth < designWidth) {
                // Calculate scale ratio based on available width
                const scale = (containerWidth - 20) / designWidth; // 10px padding on each side
                wrapper.style.transform = `scale(${scale})`;
                container.style.height = (designHeight * scale + 40) + 'px';
                container.style.minHeight = '0';
            } else {
                container.style.height = '636px';
            }
        }

        window.addEventListener('load', scaleCertificate);
        window.addEventListener('resize', scaleCertificate);
        // Force scaling after fonts are loaded for accuracy
        document.fonts.ready.then(scaleCertificate);
    </script>
</body>
</html>
