<?php
session_start();

// Si el usuario ya está autenticado, redirigirlo al dashboard
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelDreams - Tu Agencia de Viajes</title>
    <link rel="icon" href="img/logito.webp" type="image/x-icon" sizes="16x16">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            scroll-behavior: smooth;
        }

        /* Header y Navegación */
        header {
            background-color: #2c3e50;
            padding: 1rem;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #3498db;
        }

        .menu-toggle {
            display: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(58, 55, 55, 0.5), rgba(0,0,0,0.5)), url('img/mountains-7499281_1920.jpg') center/cover; /* Imagen de fondo */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 0 1rem;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            background-color: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .cta-button:hover {
            background-color: #c0392b;
        }

        /* Destinos */
        .destinations {
            padding: 4rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            padding-top: 60px;
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .destination-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }

        .destination-card:hover {
            transform: translateY(-10px);
        }

        .destination-img {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .destination-info {
            padding: 1.5rem;
            background-color: white;
        }

        .destination-info h3 {
            margin-bottom: 0.5rem;
        }

        .destination-info p {
            color: #666;
            margin-bottom: 1rem;
        }

        .price {
            color: #e74c3c;
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Formulario de Reserva */
        .booking-form {
            padding: 4rem 1rem;
            max-width: 800px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .submit-button {
            background-color: #2ecc71;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .submit-button:hover {
            background-color: #27ae60;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 3rem 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
        }

        .footer-section p, 
        .footer-section a {
            color: #bdc3c7;
            margin-bottom: 0.5rem;
            display: block;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #2c3e50;
                flex-direction: column;
                padding: 1rem;
                text-align: center;
            }

            .nav-links.active {
                display: flex;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .destinations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">TravelDreams</div>
            <div class="nav-links">
                <a href="#inicio">Inicio</a>
                <a href="#destinos">Destinos</a>
                <a href="#reserva">Reserva</a>
                <a href="#contacto">Contacto</a>
                <a href="login.php">Iniciar Sesion</a>
                
            </div>
            <div class="menu-toggle">☰</div>
        </nav>
    </header>

    <section class="hero" id="inicio">
        <div class="hero-content">
            <h1>Descubre el mundo con nosotros</h1>
            <p>Los mejores destinos y experiencias inolvidables te esperan</p>
            <a href="#reserva" class="cta-button">¡Reserva ahora!</a>
        </div>
    </section>

    <section class="destinations" id="destinos">
        <h2 class="section-title">Destinos Populares</h2>
        <div class="destinations-grid">
            <!-- Destino 1 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/paris-3881047_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Paris, Francia</h3>
                    <p>La ciudad del amor y la luz. Descubre la magia de la Torre Eiffel y los Campos Elíseos.</p>
                    <span class="price">Desde $1,299</span>
                </div>
            </div>
            <!-- Destino 2 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/bali-7969001_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Bali, Indonesia</h3>
                    <p>Playas paradisíacas, templos antiguos y cultura única te esperan en este destino tropical.</p>
                    <span class="price">Desde $1,499</span>
                </div>
            </div>
            <!-- Destino 3 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/night-4336403_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Tokio, Japón</h3>
                    <p>La mezcla perfecta entre lo tradicional y lo moderno. Vive la experiencia japonesa única.</p>
                    <span class="price">Desde $1,800</span>
                </div>
            </div>
            <!-- Destino 4 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/rome-4087275_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Roma, Italia</h3>
                    <p>Historia antigua, arquitectura impresionante y la deliciosa gastronomía italiana te esperan.</p>
                    <span class="price">Desde $1,100</span>
                </div>
            </div>
            <!-- Destino 5 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/sydney-opera-house-354375_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Sydney, Australia</h3>
                    <p>Disfruta de las hermosas playas y el icónico Opera House en una de las ciudades más vibrantes del mundo.</p>
                    <span class="price">Desde $2,500</span>
                </div>
            </div>
            <!-- Destino 6 -->
            <div class="destination-card">
                <div class="destination-img" style="background-image: url('img/architecture-5214047_1280.jpg')"></div>
                <div class="destination-info">
                    <h3>Cape Town, Sudáfrica</h3>
                    <p>Maravillosos paisajes naturales, cultura vibrante y una ciudad rodeada de montañas y playas.</p>
                    <span class="price">Desde $1,899</span>
                </div>
            </div>
        </div>
    </section>

    <section class="booking-form" id="reserva">
        <h2 class="section-title">Formulario de Reserva</h2>
        <form>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="destination">Destino</label>
                <select id="destination" name="destination" required>
                    <option value="paris">Paris</option>
                    <option value="bali">Bali</option>
                    <option value="tokio">Tokio</option>
                    <option value="roma">Roma</option>
                    <option value="sydney">Sydney</option>
                    <option value="capetown">Cape Town</option>
                </select>
            </div>
            <button type="submit" class="submit-button">Reservar</button>
        </form>
        
    </section>

    <footer id="contacto">
        <div class="footer-content">
            <div class="footer-section">
                <h4>TravelDreams</h4>
                <p>Tu agencia de viajes online, especializada en crear experiencias inolvidables.</p>
            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>+1 800 123 456</p>
                <p>info@traveldreams.com</p>
            </div>
            <div class="footer-section">
                <h4>Síguenos</h4>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
        
    <script>
        function toggleForm(formType) {
            if (formType === 'login') {
                document.getElementById('login-form').classList.add('active');
                document.getElementById('register-form').classList.remove('active');
            } else if (formType === 'register') {
                document.getElementById('register-form').classList.add('active');
                document.getElementById('login-form').classList.remove('active');
            }
        }
    </script>

</body>
</html>

    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>
