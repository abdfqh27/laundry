<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hejo Laundry - Layanan Laundry Ramah Lingkungan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a1f0a;
            color: #fff;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(10, 31, 10, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.3);
            background: rgba(10, 31, 10, 0.98);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #16a34a;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .nav-logo:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #16a34a;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #16a34a;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-login {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid rgba(34, 197, 94, 0.3);
        }

        .nav-login:hover {
            color: #16a34a;
            border-color: #16a34a;
            background: rgba(34, 197, 94, 0.1);
        }

        .nav-cta {
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.6);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #fff 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: slideInLeft 1s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-content p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            line-height: 1.8;
            animation: slideInLeft 1s ease-out 0.2s backwards;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            animation: slideInLeft 1s ease-out 0.3s backwards;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #16a34a;
            display: block;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .hero-cta-group {
            display: flex;
            gap: 1rem;
            animation: slideInLeft 1s ease-out 0.4s backwards;
        }

        .btn-primary {
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(34, 197, 94, 0.6);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            padding: 1rem 2rem;
            border: 2px solid #16a34a;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: rgba(34, 197, 94, 0.1);
            transform: translateY(-3px);
        }

        .hero-image {
            position: relative;
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(34, 197, 94, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Trust Badges */
        .trust-badges {
            padding: 3rem 0;
            background: rgba(26, 58, 26, 0.3);
            border-top: 1px solid rgba(34, 197, 94, 0.1);
            border-bottom: 1px solid rgba(34, 197, 94, 0.1);
        }

        .trust-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .trust-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .trust-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .trust-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #fff;
        }

        .trust-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        /* Benefits Section */
        .benefits {
            padding: 6rem 0;
            position: relative;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-block;
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .benefit-card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .benefit-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            border-color: rgba(34, 197, 94, 0.5);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
        }

        .benefit-icon {
            width: 60px;
            height: 60px;
            background: rgba(34, 197, 94, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .benefit-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .benefit-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 6rem 0;
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
        }

        .steps-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .step-card {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
        }

        .step-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .step-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* Services Section */
        .services {
            padding: 6rem 0;
        }

        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #16a34a 0%, #16a34a 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-10px);
            border-color: rgba(34, 197, 94, 0.5);
            background: linear-gradient(135deg, #1f4a1f 0%, #1a3a1a 100%);
        }

        .service-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .service-card p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1rem;
            min-height: 48px;
        }

        .service-features {
            list-style: none;
            margin-bottom: 1.5rem;
            padding: 0;
        }

        .service-features li {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .service-price {
            font-size: 2rem;
            font-weight: 700;
            color: #16a34a;
            margin-bottom: 1rem;
        }

        .service-price-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Pricing Comparison */
        .pricing-comparison {
            padding: 6rem 0;
            background: rgba(26, 58, 26, 0.3);
        }

        .comparison-table {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 20px;
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }

        .comparison-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(34, 197, 94, 0.1);
        }

        .comparison-row:last-child {
            border-bottom: none;
        }

        .comparison-row:first-child {
            background: rgba(34, 197, 94, 0.1);
            font-weight: 600;
        }

        .comparison-cell {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .comparison-cell:first-child {
            justify-content: flex-start;
        }

        /* Social Proof Section */
        .social-proof {
            padding: 6rem 0;
        }

        .testimonials {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            border-color: rgba(34, 197, 94, 0.5);
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .testimonial-info h4 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .testimonial-role {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .testimonial-stars {
            color: #fbbf24;
            margin-bottom: 1rem;
        }

        .testimonial-text {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            font-style: italic;
        }

        /* FAQ Section */
        .faq-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: rgba(10, 31, 10, 0.5);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 15px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: rgba(34, 197, 94, 0.5);
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 1.1rem;
            user-select: none;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 0 1.5rem;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 0 1.5rem 1.5rem;
        }

        .faq-answer p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
        }

        .cta-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            position: relative;
        }

        .cta-section .btn-primary {
            background: white;
            color: #16a34a;
        }

        .cta-section .btn-primary:hover {
            background: rgba(255, 255, 255, 0.9);
        }

        /* Footer */
        .footer {
            background: rgba(10, 31, 10, 0.95);
            border-top: 1px solid rgba(34, 197, 94, 0.2);
            padding: 4rem 0 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: #16a34a;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #16a34a;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(34, 197, 94, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: #16a34a;
            color: white;
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(34, 197, 94, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        /* WhatsApp Button */
        .whatsapp-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25d366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            transition: all 0.3s ease;
            z-index: 999;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.7);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .nav-buttons {
                display: flex;
                gap: 0.5rem;
            }

            .nav-login, .nav-cta {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-cta-group {
                flex-direction: column;
            }

            .hero-image-wrapper {
                height: 300px;
                font-size: 5rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .trust-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .comparison-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .whatsapp-button {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <i class="bi bi-droplet-fill"></i>
                Hejo Laundry
            </a>
            <div class="nav-links">
                <a href="#beranda" class="nav-link">Beranda</a>
                <a href="#layanan" class="nav-link">Layanan</a>
                <a href="#cara-kerja" class="nav-link">Cara Kerja</a>
                <a href="#testimoni" class="nav-link">Testimoni</a>
                <a href="#faq" class="nav-link">FAQ</a>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="nav-login">Login</a>
                <a href="#" class="nav-cta">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Laundry Ramah Lingkungan untuk Masa Depan Lebih Hijau</h1>
                <p>Nikmati layanan laundry eco-friendly dengan deterjen organik, teknologi hemat energi, dan komitmen menjaga kelestarian lingkungan. Bersih untuk pakaian, baik untuk bumi!</p>
                
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">15K+</span>
                        <span class="hero-stat-label">Pelanggan Hijau</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">80K+</span>
                        <span class="hero-stat-label">Cucian Ramah Lingkungan</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">4.9</span>
                        <span class="hero-stat-label">Rating</span>
                    </div>
                </div>

                <div class="hero-cta-group">
                    <a href="#" class="btn-primary">
                        <i class="bi bi-leaf"></i> Mulai Go Green
                    </a>
                    <a href="#layanan" class="btn-secondary">
                        <i class="bi bi-play-circle"></i> Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-image-wrapper">
                    🌿
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="trust-badges">
        <div class="trust-container">
            <div class="trust-grid">
                <div class="trust-item">
                    <div class="trust-icon">🌱</div>
                    <div class="trust-title">Eco-Friendly</div>
                    <div class="trust-desc">100% Deterjen Organik</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">♻️</div>
                    <div class="trust-title">Zero Waste</div>
                    <div class="trust-desc">Kemasan Ramah Lingkungan</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">💚</div>
                    <div class="trust-title">Green Certified</div>
                    <div class="trust-desc">Sertifikat Eco Label</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">⚡</div>
                    <div class="trust-title">Energy Saving</div>
                    <div class="trust-desc">Teknologi Hemat Energi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">KEUNGGULAN HEJO LAUNDRY</span>
                <h2>Mengapa Memilih Hejo Laundry?</h2>
                <p>Komitmen kami untuk lingkungan yang lebih bersih dan masa depan yang lebih hijau</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">🌿</div>
                    <h3>Deterjen Organik</h3>
                    <p>Menggunakan deterjen 100% organik dan biodegradable yang aman untuk kulit sensitif dan tidak mencemari lingkungan</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">💧</div>
                    <h3>Hemat Air 50%</h3>
                    <p>Teknologi mesin cuci modern yang menghemat penggunaan air hingga 50% tanpa mengurangi kualitas hasil cucian</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">⚡</div>
                    <h3>Energi Terbarukan</h3>
                    <p>Menggunakan panel surya untuk memenuhi 70% kebutuhan energi listrik, mengurangi jejak karbon</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">♻️</div>
                    <h3>Kemasan Ramah Lingkungan</h3>
                    <p>Semua kemasan menggunakan bahan daur ulang dan dapat di-recycle kembali untuk zero waste</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🚴</div>
                    <h3>Delivery Eco-Friendly</h3>
                    <p>Armada sepeda listrik dan kendaraan ramah lingkungan untuk antar jemput di radius tertentu</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🌳</div>
                    <h3>Program Tanam Pohon</h3>
                    <p>Setiap 10kg laundry = 1 pohon ditanam! Sudah lebih dari 5.000 pohon ditanam bersama pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="cara-kerja">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">PROSES HEJO</span>
                <h2>Cara Kerja Hejo Laundry</h2>
                <p>4 langkah mudah untuk berkontribusi pada lingkungan yang lebih bersih</p>
            </div>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Pesan & Pilih Hejo Laundry</h3>
                    <p>Daftar dan pilih paket eco-friendly kami. Setiap pemesanan berkontribusi untuk lingkungan</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Pickup Ramah Lingkungan</h3>
                    <p>Tim kami datang dengan kendaraan eco-friendly menggunakan tas laundry yang dapat digunakan ulang</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Cuci dengan Teknologi Hijau</h3>
                    <p>Proses pencucian menggunakan deterjen organik, air daur ulang, dan energi terbarukan</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Antar Dengan Kemasan Eco</h3>
                    <p>Pakaian dikemas dengan bahan ramah lingkungan dan diantar kembali dengan kendaraan listrik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="layanan">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">PAKET ECO-FRIENDLY</span>
                <h2>Pilih Paket Hejo Anda</h2>
                <p>Berbagai pilihan layanan ramah lingkungan dengan harga terjangkau</p>
            </div>
            <div class="service-cards">
                <div class="service-card">
                    <div class="service-icon">🌱</div>
                    <h3>Green Wash</h3>
                    <p>Cuci standar dengan deterjen organik</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Deterjen organik</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Selesai 2-3 hari</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Hemat air 50%</li>
                    </ul>
                    <div class="service-price">Rp 6.000<span class="service-price-label">/kg</span></div>
                    <a href="#" class="btn-primary" style="width: 100%;">Pilih Paket</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚀</div>
                    <h3>Eco Express</h3>
                    <p>Layanan cepat ramah lingkungan 24 jam</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Prioritas hijau</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Selesai 24 jam</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Energi terbarukan</li>
                    </ul>
                    <div class="service-price">Rp 8.000<span class="service-price-label">/kg</span></div>
                    <a href="#" class="btn-primary" style="width: 100%;">Pilih Paket</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">✨</div>
                    <h3>Premium Eco</h3>
                    <p>Perawatan premium ramah lingkungan</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Green dry clean</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Bahan sensitif</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Essential oil wangi</li>
                    </ul>
                    <div class="service-price">Rp 12.000<span class="service-price-label">/kg</span></div>
                    <a href="#" class="btn-primary" style="width: 100%;">Pilih Paket</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">♻️</div>
                    <h3>Eco Iron</h3>
                    <p>Setrika dengan teknologi hemat energi</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Setrika rapi</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Hemat listrik 40%</li>
                        <li><i class="bi bi-check-circle-fill" style="color: #16a34a;"></i> Pewangi alami</li>
                    </ul>
                    <div class="service-price">Rp 4.000<span class="service-price-label">/kg</span></div>
                    <a href="#" class="btn-primary" style="width: 100%;">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Comparison -->
    <section class="pricing-comparison">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">PERBANDINGAN</span>
                <h2>Hejo Laundry vs Laundry Konvensional</h2>
                <p>Lihat perbedaan nyata untuk lingkungan dan dompet Anda</p>
            </div>
            <div class="comparison-table">
                <div class="comparison-row">
                    <div class="comparison-cell">Aspek</div>
                    <div class="comparison-cell">Hejo Laundry</div>
                    <div class="comparison-cell">Konvensional</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell">Deterjen</div>
                    <div class="comparison-cell" style="color: #16a34a; font-weight: 600;">100% Organik</div>
                    <div class="comparison-cell" style="color: rgba(255,255,255,0.5);">Kimia Keras</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell">Penggunaan Air</div>
                    <div class="comparison-cell" style="color: #16a34a; font-weight: 600;">Hemat 50%</div>
                    <div class="comparison-cell" style="color: rgba(255,255,255,0.5);">Boros Air</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell">Energi</div>
                    <div class="comparison-cell" style="color: #16a34a; font-weight: 600;">Solar Panel</div>
                    <div class="comparison-cell" style="color: rgba(255,255,255,0.5);">Listrik PLN</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell">Kemasan</div>
                    <div class="comparison-cell" style="color: #16a34a;">♻️ Daur Ulang</div>
                    <div class="comparison-cell" style="color: #ef4444;">🚫 Plastik</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell">Program Pohon</div>
                    <div class="comparison-cell" style="color: #16a34a;">✓ 1 Pohon/10kg</div>
                    <div class="comparison-cell" style="color: #ef4444;">✗</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section class="social-proof" id="testimoni">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">TESTIMONI</span>
                <h2>Apa Kata Eco Warriors Kami?</h2>
                <p>Ribuan pelanggan peduli lingkungan telah bergabung dengan gerakan hijau kami</p>
            </div>
            <div class="testimonials">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👨</div>
                        <div class="testimonial-info">
                            <h4>Andri Hakim</h4>
                            <div class="testimonial-role">Invesestor Saham</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Akhirnya ada laundry yang benar-benar peduli lingkungan! Senang bisa berkontribusi untuk bumi sambil mendapat pakaian bersih. Program tanam pohonnya juga keren banget!"</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👩</div>
                        <div class="testimonial-info">
                            <h4>Moniqca Sandha</h4>
                            <div class="testimonial-role">Ibu Rumah Tangga</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Deterjen organiknya aman untuk anak saya yang kulitnya sensitif. Senang bisa laundry tanpa rasa bersalah merusak lingkungan. Harga juga masih terjangkau!"</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👨</div>
                        <div class="testimonial-info">
                            <h4>Abdullah F</h4>
                            <div class="testimonial-role">Mahasiswa</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Sebagai generasi muda, saya sangat peduli dengan masa depan bumi. Hejo Laundry membuktikan bahwa bisnis bisa tetap profitable sambil menjaga lingkungan!"</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👩</div>
                        <div class="testimonial-info">
                            <h4>Mila Apriani</h4>
                            <div class="testimonial-role">Dokter</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Deterjen organik sangat penting untuk kesehatan kulit. Hejo Laundry memberikan solusi sempurna: bersih, wangi, dan aman untuk kesehatan serta lingkungan!"</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👨</div>
                        <div class="testimonial-info">
                            <h4>Budi Doremi</h4>
                            <div class="testimonial-role">Pengusaha</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Konsep eco-friendly delivery dengan sepeda listrik sangat inovatif! Perusahaan saya sekarang menggunakan Hejo Laundry untuk uniform karyawan. Green business!"</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👩</div>
                        <div class="testimonial-info">
                            <h4>Nazwa Pradipta</h4>
                            <div class="testimonial-role">Content Creator</div>
                        </div>
                    </div>
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Sudah review Hejo Laundry di channel YouTube saya! Followers suka banget dengan konsep ramah lingkungannya. Kemasan eco-friendly juga Instagram-able!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">FAQ</span>
                <h2>Pertanyaan Seputar Hejo Laundry</h2>
                <p>Temukan jawaban untuk pertanyaan umum tentang layanan eco-friendly kami</p>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apa yang membuat Hejo Laundry berbeda dari laundry biasa?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Kami menggunakan 100% deterjen organik biodegradable, teknologi hemat air 50%, energi terbarukan dari solar panel, kemasan ramah lingkungan, dan armada delivery eco-friendly. Setiap 10kg laundry = 1 pohon ditanam!</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah deterjen organik sama efektifnya dengan deterjen biasa?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Absolut! Deterjen organik kami bahkan lebih baik karena aman untuk kulit sensitif, tidak meninggalkan residu kimia, dan tetap efektif membersihkan noda membandel. Plus, ramah lingkungan dan biodegradable 100%.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana program tanam pohon bekerja?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Setiap akumulasi 10kg laundry yang Anda cuci bersama kami, kami akan menanam 1 pohon atas nama Anda. Anda akan mendapat sertifikat digital dan bisa tracking pertumbuhan pohon melalui aplikasi kami!</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Area mana saja yang dilayani dengan delivery eco-friendly?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Saat ini delivery dengan sepeda listrik tersedia di Jakarta Pusat, Jakarta Selatan, dan sebagian Tangerang dengan radius 5km dari outlet. Area lain menggunakan kendaraan ramah lingkungan hybrid.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah kemasan bisa dikembalikan untuk di-recycle?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Ya! Kami memiliki program recycle kemasan. Kembalikan tas laundry kami saat pickup berikutnya dan dapatkan poin reward. Semua kemasan kami terbuat dari bahan daur ulang dan dapat di-recycle kembali.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Berapa lama waktu pengerjaan untuk layanan eco-friendly?</span>
                        <i class="bi bi-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Green Wash: 2-3 hari, Eco Express: 24 jam. Meskipun menggunakan teknologi ramah lingkungan, kami tetap menjamin kecepatan dan kualitas hasil cucian yang sempurna!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="section-container">
            <h2>Bergabunglah dengan Gerakan Hijau Kami!</h2>
            <p>Daftar sekarang dan dapatkan diskon 15% untuk pemesanan pertama + 1 pohon gratis akan ditanam atas nama Anda. Mari bersama jaga bumi!</p>
            <a href="#" class="btn-primary">
                <i class="bi bi-leaf"></i> Mulai Go Green Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3><i class="bi bi-droplet-fill"></i> Hejo Laundry</h3>
                    <p style="color: rgba(255,255,255,0.7); margin-bottom: 1.5rem;">Laundry ramah lingkungan untuk masa depan yang lebih hijau. Bersih untuk pakaian, baik untuk bumi.</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Layanan Eco</h3>
                    <ul class="footer-links">
                        <li><a href="#layanan">Green Wash</a></li>
                        <li><a href="#layanan">Eco Express</a></li>
                        <li><a href="#layanan">Premium Eco</a></li>
                        <li><a href="#layanan">Eco Iron</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Tentang Kami</h3>
                    <ul class="footer-links">
                        <li><a href="#tentang">Misi Hijau</a></li>
                        <li><a href="#cara-kerja">Cara Kerja</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                        <li><a href="#program">Program Pohon</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Bantuan</h3>
                    <ul class="footer-links">
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#kontak">Hubungi Kami</a></li>
                        <li><a href="#syarat">Syarat & Ketentuan</a></li>
                        <li><a href="#privasi">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Hejo Laundry. All rights reserved. Made by Abdullah Faqih 💚 for Earth in Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://api.whatsapp.com/send?phone=6281395384553&text=Halo%2C%20saya%20ingin%20bergabung%20dengan%20gerakan%20hijau%20Laundry%20Hijau!" 
       class="whatsapp-button" 
       target="_blank"
       rel="noopener noreferrer"
       title="Hubungi kami via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const wasActive = faqItem.classList.contains('active');
                
                // Close all FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Open clicked item if it wasn't active
                if (!wasActive) {
                    faqItem.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>