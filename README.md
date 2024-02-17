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
   git clone git@github.com:gianni/beers.git
   ```
2. Move to the directory:

   ```bash
   cd beers
   ```
3. Open VSCode:

   ```bash
   code .
   ```
4. Start DevContainer:

5. Install php and npm packages:

    In the terminal of the DevConatainer

   ```bash
   composer install
   ```
   ```bash
   npm install
   ```
6. Start Apache and ViteJs server:

   ```bash
   service apache2 start
   ```

   ```bash
   npm run dev
   ```
7. Create a .env file:

   ```bash
   cp .env.example .env
   ```
8. Execute migration and seed the database:

   ```bash
   php artisan migrate
   ```
   
   ```bash
   php artisan db:seed
   ```
9. Add local domain to the hosts file (root user):

   ```bash
   echo "127.0.0.1 www.brewherehouse.loc" >> /etc/hosts
   ```

10. Point the browser to this url
    ```bash
    http://www.brewherehouse.loc
    ```
