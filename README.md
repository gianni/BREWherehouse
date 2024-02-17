# BREWherehouse

🍺 A Beer catalog featuring a login page and a paginated view of all available beers. 🍻

[![GitHub Actions](https://img.shields.io/badge/GitHub%20Actions-enabled-brightgreen)](https://github.com/features/actions)
[![PHP Test](https://github.com/gianni/beers/actions/workflows/php-test.yml/badge.svg)](https://github.com/gianni/beers/actions/workflows/php-test.yml)
[![PHPStan](https://github.com/gianni/beers/actions/workflows/phpstan.yml/badge.svg)](https://github.com/gianni/beers/actions/workflows/phpstan.yml)

## Technologies

- [![PHP](https://img.shields.io/badge/PHP-8.2-purple)](https://www.php.net/)
The 8.2 version of PHP, bringing new features and improvements.
- [![Apache2](https://img.shields.io/badge/Apache2-latest-yellow)](https://httpd.apache.org/)
The web server for serving your PHP application.
- [![Docker](https://img.shields.io/badge/Docker-latest-blue)](https://www.docker.com/)
A containerization platform for packaging, distributing, and running applications.
- [![!Laravel](https://img.shields.io/badge/Laravel-10-red)](https://laravel.com/)
The backend framework for building robust and scalable web applications.
- [![Vue.js](https://img.shields.io/badge/Vue.js-3.4-green)](https://vuejs.org/)
The progressive JavaScript framework for building user interfaces.
- [![Pest PHP](https://img.shields.io/badge/Pest%20PHP-latest-blue)](https://pestphp.com/)
A delightful PHP Testing Framework with a focus on simplicity.
- [![JWT Token](https://img.shields.io/badge/JWT%20Token-secure-green)](https://jwt.io/)
JSON Web Tokens for secure and stateless authentication.
- [![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-2.2.19-blueviolet)](https://tailwindcss.com/)



## Features

- 🚀 **User Authentication**: Secure login page for user authentication (JWT).
- 🍺 **Beer Catalog**: Explore a wide variety of beers with pagination support.
## Getting Started

### Prerequisites

- [VSCode](https://code.visualstudio.com/)
- [Docker](https://www.docker.com/get-started)

### Installation

1. Clone the repository:

   ```bash
   git clone git@github.com:gianni/BREWherehouse.git
   ```
2. Move to the directory:

   ```bash
   cd BREWherehouse
   ```
3. Open VSCode:

   ```bash
   code .
   ```
4. Start DevContainer:
   
   In the VSCode menu

   Riquadro Comandi > DevContainer: Rebuild and reopen in container

5. Install php and npm packages:

   In the shell of the DevConatainer execute these commands.

   ```bash
   composer install
   npm install
   ```

6. Create a .env file:

   ```bash
   cp .env.example .env
   ```

7. Start Apache and ViteJs server:

   ```bash
   service apache2 start
   npm run dev
   ```

8. Generate keys:

   ```bash
   php artisan key:generate
   php artisan jwt:secret
   ```

9. Execute migration and seed the database:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```
10. Add local domain to the hosts file (root user):

      ```bash
      echo "127.0.0.1 www.brewherehouse.loc" >> /etc/hosts
      ```

11. Point the browser to this url
   
      ```bash
      http://www.brewherehouse.loc:8080
      ```
