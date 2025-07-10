<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciciloo - Split Bills with Friends</title>
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background: linear-gradient(135deg, #071739 0%, #1a2b5c 100%); min-height: 100vh;">
    <header id="main-header" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 1rem 0; position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="#" style="display: flex; align-items: center; gap: 0.5rem; font-size: 1.8rem; font-weight: bold; color: #fff; text-decoration: none;">
                <img src="/assets/image/logo.svg" alt="Ciciloo" style="width: auto; height: 50px; object-fit: contain;">
            </a>
            <nav id="nav-links" style="display: flex; align-items: center; gap: 1.5rem;">
                <a href="#features" class="nav-link" style="color: #fff; font-weight: 600; text-decoration: none; transition: all 0.3s; padding: 0.5rem 1rem;">Features</a>
                <a href="#how-it-works" class="nav-link" style="color: #fff; font-weight: 600; text-decoration: none; transition: all 0.3s; padding: 0.5rem 1rem;">How It Works</a>
                <a href="#faq" class="nav-link" style="color: #fff; font-weight: 600; text-decoration: none; transition: all 0.3s; padding: 0.5rem 1rem;">FAQ</a>
                <a href="{{ route('login') }}" id="get-started-btn" style="background: #fff; color: #071739; padding: 0.8rem 1.5rem; border: none; border-radius: 25px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none;">Get Started</a>
            </nav>
        </div>
    </header>

    <main>
        <section style="padding: 4rem 0; text-align: center; color: #fff;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1 style="font-size: 3.5rem; margin-bottom: 1rem; font-weight: 700; line-height: 1.2;">
                    Split Bills with Friends, <span style="color: #4fc3f7; display: block;">Hassle-Free</span>
                </h1>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Ciciloo makes it easy to track expenses, split bills, and settle up with friends. No more awkward money conversations or complicated spreadsheets.
                </p>
            </div>
        </section>

        <section id="features" style="padding: 4rem 0; background: #fff;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Everything You Need to Split Bills</h2>
                <p style="text-align: center; font-size: 1.2rem; color: #666; margin-bottom: 3rem;">Ciciloo makes it simple to manage shared expenses and keep track of IOUs.</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; transition: all 0.3s; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">💰</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Easy Expense Tracking</h3>
                        <p style="color: #666; line-height: 1.6;">Add expenses instantly and categorize them. Keep track of who paid what and when.</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; transition: all 0.3s; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">🔄</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Smart Bill Splitting</h3>
                        <p style="color: #666; line-height: 1.6;">Split bills equally or customize amounts. Handle complex scenarios with ease.</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; transition: all 0.3s; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">👥</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Friend Management</h3>
                        <p style="color: #666; line-height: 1.6;">Add friends and manage group expenses. Keep everyone on the same page.</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; transition: all 0.3s; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">📊</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Clear Summaries</h3>
                        <p style="color: #666; line-height: 1.6;">See who owes what at a glance. Get detailed breakdowns of all expenses.</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; transition: all 0.3s; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">🔒</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Secure & Private</h3>
                        <p style="color: #666; line-height: 1.6;">Your financial data is protected. Share only what you want with who you want.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" style="padding: 4rem 0; background-color: #e6f0fa;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 1rem; color: #333;">How Ciciloo Works</h2>
                <p style="text-align: center; font-size: 1.2rem; color: #666; margin-bottom: 3rem;">Split bills in three simple steps</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div style="background: #fff; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem;">📝</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Add an Expense</h3>
                        <p style="color: #666; line-height: 1.6;">Enter a bill amount, select who paid, and add a description or photo of the receipt.</p>
                    </div>
                    <div style="background: #fff; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem;">💰</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Split with Friends</h3>
                        <p style="color: #666; line-height: 1.6;">Choose who to split with and how to divide the bill - by equal, by percentage, or by items.</p>
                    </div>
                    <div style="background: #fff; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #071739, #1a2b5c); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem;">✅</div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #333;">Settle Up</h3>
                        <p style="color: #666; line-height: 1.6;">Pay friends directly through the app or record cash payments to keep balances updated.</p>
                    </div>
                </div>
            </div>
        </section>

        <section style="padding: 4rem 0; background-color: #fff;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Loved by Friends Everywhere</h2>
                <p style="text-align: center; font-size: 1.2rem; color: #666; margin-bottom: 3rem;">See what our users have to say about Ciciloo</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <img src="https://i.pinimg.com/736x/bb/a3/83/bba3836c7ba325fcf65c0351f1ae9540.jpg" alt="Sarah T." style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 1rem;" onerror="this.src='/placeholder-image.jpg';">
                            <div style="text-align: left;">
                                <p style="font-weight: 600; color: #333; margin: 0;">Sarah T.</p>
                                <p style="color: #666; margin: 0;">Group Trip Organizer</p>
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6;">"Ciciloo saved our friendship during our trip to Europe! No more awkward who owes what conversations."</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <img src="https://img-highend.okezone.com/okz/900/pictureArticle/images_z79U7V6y_xiJ904.jpg" alt="Mike R." style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 1rem;" onerror="this.src='/placeholder-image.jpg';">
                            <div style="text-align: left;">
                                <p style="font-weight: 600; color: #333; margin: 0;">Mike R.</p>
                                <p style="color: #666; margin: 0;">Roommate</p>
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6;">"We use Ciciloo for all our apartment expenses. It's so easy to track who paid for what and keep everything fair."</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 15px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <img src="https://assets.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/63/2023/07/18/278904010_332434105540706_5703095942165431083_n-1813902612.jpg" alt="Jamie L." style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 1rem;" onerror="this.src='/placeholder-image.jpg';">
                            <div style="text-align: left;">
                                <p style="font-weight: 600; color: #333; margin: 0;">Jamie L.</p>
                                <p style="color: #666; margin: 0;">Friend Group Treasurer</p>
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6;">"My friend group uses Ciciloo for everything from dinners to concert tickets. It keeps everything transparent and fair."</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" style="padding: 4rem 0; background-color: #e6f0fa;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Frequently Asked Questions</h2>
                <p style="text-align: center; font-size: 1.2rem; color: #666; margin-bottom: 3rem;">Everything you need to know about Ciciloo</p>
                <div style="display: grid; gap: 1rem; margin-top: 2rem;">
                    <div style="background: #fff; border-radius: 15px; border: 1px solid #e9ecef; overflow: hidden;">
                        <button style="width: 100%; padding: 1rem; text-align: left; background: none; border: none; font-size: 1.2rem; color: #333; cursor: pointer;" onclick="toggleFAQ('faq1')">
                            Is Ciciloo free to use? <img src="/storage/chevron-down.svg" alt="Chevron Down" style="float: right; width: 16px; height: 16px;">
                        </button>
                        <div id="faq1" style="display: none; padding: 1rem; color: #666;">
                            Yes! Ciciloo is completely free to use for basic bill splitting and expense tracking. We offer premium features for users with a subscription.
                        </div>
                    </div>
                    <div style="background: #fff; border-radius: 15px; border: 1px solid #e9ecef; overflow: hidden;">
                        <button style="width: 100%; padding: 1rem; text-align: left; background: none; border: none; font-size: 1.2rem; color: #333; cursor: pointer;" onclick="toggleFAQ('faq2')">
                            Do my friends need to have the account too? <img src="/storage/chevron-down.svg" alt="Chevron Down" style="float: right; width: 16px; height: 16px;">
                        </button>
                        <div id="faq2" style="display: none; padding: 1rem; color: #666;">
                            For the best experience, we recommend everyone has account. However, you can add people via email who don't have account yet, and they'll receive notifications about expenses.
                        </div>
                    </div>
                    <div style="background: #fff; border-radius: 15px; border: 1px solid #e9ecef; overflow: hidden;">
                        <button style="width: 100%; padding: 1rem; text-align: left; background: none; border: none; font-size: 1.2rem; color: #333; cursor: pointer;" onclick="toggleFAQ('faq3')">
                            Can I use Ciciloo on my phone? <img src="/storage/chevron-down.svg" alt="Chevron Down" style="float: right; width: 16px; height: 16px;">
                        </button>
                        <div id="faq3" style="display: none; padding: 1rem; color: #666;">
                            Absolutely! Ciciloo is fully responsive and works great on mobile devices. You can manage your expenses and split bills on the go.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer style="background: #071739; color: #fff; text-align: center; padding: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <p>© 2025 Ciciloo. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleFAQ(id) {
            const faqContent = document.getElementById(id);
            if (faqContent.style.display === 'block') {
                faqContent.style.display = 'none';
            } else {
                faqContent.style.display = 'block';
            }
        }

        // Scroll-based styling
        window.addEventListener('scroll', () => {
            const header = document.getElementById('main-header');
            const navLinks = document.querySelectorAll('.nav-link');
            const getStartedBtn = document.getElementById('get-started-btn');
            const scrollPosition = window.scrollY;

            if (scrollPosition > 200) { // Change style after scrolling 200px (past hero)
                header.style.background = 'rgba(255, 255, 255, 0.1)'; // Keep transparent background
                header.style.borderBottom = '1px solid rgba(255, 255, 255, 0.1)'; // Keep transparent border
                
                // Change navigation links to blue
                navLinks.forEach(link => {
                    link.style.color = '#071739';
                });
                
                // Change Get Started button to blue background with white text
                getStartedBtn.style.background = '#071739';
                getStartedBtn.style.color = '#fff';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.1)'; // Revert to translucent
                header.style.borderBottom = '1px solid rgba(255, 255, 255, 0.1)'; // Revert border
                
                // Revert navigation links to white
                navLinks.forEach(link => {
                    link.style.color = '#fff';
                });
                
                // Revert Get Started button to white background with blue text
                getStartedBtn.style.background = '#fff';
                getStartedBtn.style.color = '#071739';
            }
        });
    </script>
</body>
</html>