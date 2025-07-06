<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciciloo - Split Bills with Friends</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #071739 0%, #1a2b5c 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .logo img {
            width: auto;
            height: 50px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .get-started-btn {
            background: #fff;
            color: #071739;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .get-started-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Hero Section */
        .hero {
            padding: 4rem 0;
            text-align: center;
            color: #fff;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero .highlight {
            color: #4fc3f7;
            display: block;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn-primary {
            background: #fff;
            color: #071739;
            padding: 1rem 2rem;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary {
            background: transparent;
            color: #fff;
            padding: 1rem 2rem;
            border: 2px solid #fff;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary:hover {
            background: #fff;
            color: #071739;
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            padding: 4rem 0;
            background: #fff;
        }

        .features h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .features-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #e9ecef;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #071739, #1a2b5c);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 2rem 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <a href="#" class="logo">
                <img src="/assets/image/logo.svg" alt="Ciciloo">
            </a>
            {{-- <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul> --}}
            <a href="{{ route('login') }}" class="get-started-btn">Get Started</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>
                    Split Bills with Friends,
                    <span class="highlight">Hassle-Free</span>
                </h1>
                <p>
                    Ciciloo makes it easy to track expenses, split bills, and 
                    settle up with friends. No more awkward money conversations 
                    or complicated spreadsheets.
                </p>
                <div class="hero-buttons">
                    <button class="btn-primary">Get Started Free</button>
                    <button class="btn-secondary">How It Works</button>
                </div>
            </div>
        </section>

        <section class="features" id="features">
            <div class="container">
                <h2>Everything You Need to Split Bills</h2>
                <p class="features-subtitle">
                    Ciciloo makes it simple to manage shared expenses and keep track of IOUs.
                </p>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Easy Expense Tracking</h3>
                        <p>Add expenses instantly and categorize them. Keep track of who paid what and when.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">🔄</div>
                        <h3>Smart Bill Splitting</h3>
                        <p>Split bills equally or customize amounts. Handle complex scenarios with ease.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>Friend Management</h3>
                        <p>Add friends and manage group expenses. Keep everyone on the same page.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Clear Summaries</h3>
                        <p>See who owes what at a glance. Get detailed breakdowns of all expenses.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">💳</div>
                        <h3>Multiple Payment Options</h3>
                        <p>Support for various payment methods. Settle up however works best for you.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3>Secure & Private</h3>
                        <p>Your financial data is protected. Share only what you want with who you want.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Ciciloo. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simple smooth scrolling for navigation links
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

        // Add click handlers for buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function() {
                alert('Button clicked: ' + this.textContent);
            });
        });
    </script>
</body>
</html>