<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== MODERN PASTEL PALETTE ===== 
           #E8EDE7  (soft cream/beige background)
           #C8D5B9  (pastel sage green)
           #8FA67E  (muted olive green)
           #68896B  (soft forest green)
           #A0937D  (warm taupe/brown)
           #6B7B6E  (soft gray-green)
           #F5F7F4  (off-white)
        */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        :root {
            --bg-primary: #F5F7F4;
            --bg-secondary: #E8EDE7;
            --text-primary: #3d4a3e;
            --text-secondary: #6B7B6E;
            --accent-green: #68896B;
            --accent-sage: #8FA67E;
            --accent-light: #C8D5B9;
            --accent-taupe: #A0937D;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-secondary);
        }

        /* Modern Minimal Navbar */
        .navbar-modern {
            background-color: var(--bg-primary);
            padding: 1rem 2rem;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--accent-light);
            position: relative;
            z-index: 1000;
        }

        .navbar-brand-modern {
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: var(--transition);
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
        }

        .navbar-brand-modern:hover {
            color: var(--accent-green);
            transform: translateY(-1px);
        }

        .navbar-brand-modern i {
            margin-right: 10px;
            font-size: 1.3rem;
            color: var(--accent-sage);
        }

        .nav-item-modern {
            margin: 0 0.25rem;
            position: relative;
        }

        .nav-link-modern {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.6rem 1rem !important;
            border-radius: 12px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            letter-spacing: 0.2px;
        }

        .nav-link-modern i {
            margin-right: 8px;
            font-size: 1rem;
            opacity: 0.8;
        }

        .nav-link-modern:hover {
            color: var(--accent-green) !important;
            background-color: rgba(200, 213, 185, 0.3);
            transform: translateY(-1px);
        }

        .nav-link-modern.active {
            background-color: var(--accent-green);
            color: var(--white) !important;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(104, 137, 107, 0.2);
        }

        .nav-link-modern.active i {
            opacity: 1;
        }

        /* Mobile Toggle Button */
        .navbar-toggler-modern {
            border: none;
            outline: none;
            padding: 0.5rem;
            background-color: var(--bg-secondary);
            border-radius: 8px;
            transition: var(--transition);
        }

        .navbar-toggler-modern:hover {
            background-color: var(--accent-light);
        }

        .navbar-toggler-modern:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon-modern {
            background-image: none;
            position: relative;
            width: 26px;
            height: 2px;
            background-color: var(--text-primary);
            display: block;
            transition: var(--transition);
            border-radius: 2px;
        }

        .navbar-toggler-icon-modern::before,
        .navbar-toggler-icon-modern::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: var(--text-primary);
            left: 0;
            transition: var(--transition);
            border-radius: 2px;
        }

        .navbar-toggler-icon-modern::before {
            top: -8px;
        }

        .navbar-toggler-icon-modern::after {
            top: 8px;
        }

        .navbar-toggler-modern[aria-expanded="true"] .navbar-toggler-icon-modern {
            background-color: transparent;
        }

        .navbar-toggler-modern[aria-expanded="true"] .navbar-toggler-icon-modern::before {
            transform: rotate(45deg);
            top: 0;
        }

        .navbar-toggler-modern[aria-expanded="true"] .navbar-toggler-icon-modern::after {
            transform: rotate(-45deg);
            top: 0;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar-modern {
                padding: 1rem 1.5rem;
            }

            .navbar-collapse-modern {
                background-color: var(--white);
                padding: 1.5rem;
                border-radius: 12px;
                box-shadow: var(--shadow-md);
                margin-top: 1rem;
                border: 1px solid var(--accent-light);
            }

            .nav-item-modern {
                margin: 0.3rem 0;
            }

            .nav-link-modern {
                padding: 0.75rem 1rem !important;
                justify-content: flex-start;
            }
        }

        /* User Dropdown */
        .user-dropdown {
            margin-left: 1rem;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-light);
            transition: var(--transition);
        }

        .user-avatar:hover {
            border-color: var(--accent-sage);
            transform: scale(1.05);
        }

        .dropdown-menu-modern {
            background-color: var(--white);
            border: 1px solid var(--accent-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-top: 0.5rem !important;
            padding: 0.5rem;
        }

        .dropdown-item-modern {
            color: var(--text-primary);
            padding: 0.6rem 1rem;
            transition: var(--transition);
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .dropdown-item-modern:hover {
            background-color: var(--accent-light);
            color: var(--accent-green);
            transform: translateX(4px);
        }

        .dropdown-item-modern i {
            margin-right: 8px;
            color: var(--text-secondary);
        }

        .dropdown-divider-modern {
            border-color: var(--accent-light);
            margin: 0.5rem 0;
        }

        /* Additional styling for better appearance */
        .container-fluid {
            max-width: 1400px;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-modern">
        <div class="container-fluid">
            <a class="navbar-brand navbar-brand-modern" href="index.php">
                <i class="fas fa-car"></i> Rent-a-Car
            </a>
            
            <button class="navbar-toggler navbar-toggler-modern" type="button" data-bs-toggle="collapse" data-bs-target="#navbarModern" aria-controls="navbarModern" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon-modern"></span>
            </button>
            
            <div class="collapse navbar-collapse navbar-collapse-modern" id="navbarModern">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item nav-item-modern">
                        <a class="nav-link nav-link-modern" href="korisnici.php">
                            <i class="fas fa-users"></i> Korisnici
                        </a>
                    </li>
                    <li class="nav-item nav-item-modern">
                        <a class="nav-link nav-link-modern" href="pregled_rezervacija.php">
                            <i class="fas fa-calendar-check"></i> Rezervacije
                        </a>
                    </li>
                    <li class="nav-item nav-item-modern">
                        <a class="nav-link nav-link-modern" href="pregled_vozila.php">
                            <i class="fas fa-car-side"></i> Vozila
                        </a>
                    </li>
                    <li class="nav-item nav-item-modern">
                        <a class="nav-link nav-link-modern" href="statistika.php">
                            <i class="fas fa-chart-line"></i> Statistika
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop() || 'index.php';
            const navLinks = document.querySelectorAll('.nav-link-modern');
            
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (currentPage === linkHref) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>