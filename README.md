# FSTtech E-Commerce Website

## Project Overview
FSTtech E-Commerce Website is a full-stack PHP application that showcases a consumer electronics storefront along with the administrative tooling required to run it. Customers can browse featured products, manage shopping carts and wish lists, and submit orders, while administrators curate the catalogue, monitor orders, and respond to incoming messages. The project is ideal for demonstrating an end-to-end retail workflow that covers catalog discovery, customer self-service, order fulfillment, and back-office operations.

## Technologies and Tools Used
- **Programming Languages:** PHP 8+, HTML5, CSS3, JavaScript (ES6)
- **Frameworks & Libraries:** [Swiper](https://swiperjs.com/) for carousels, Font Awesome for iconography
- **Database:** MySQL/MariaDB accessed via PHP Data Objects (PDO)
- **Server Runtime:** Apache or Nginx with PHP module, or PHP's built-in development server
- **Tooling:** phpMyAdmin (or any MySQL client) for database management, optional local stacks such as XAMPP/WAMP/Laragon
- **Assets:** Responsive layouts powered by custom stylesheets (`css/style.css`, `css/admin_style.css`) and JavaScript utilities (`js/script.js`, `js/admin_script.js`)

## Features
### Customer-Facing Experience
- **Modern landing page:** Hero carousel and highlights on `accuel.php` driven by Swiper provide quick access to promotions and new arrivals.
- **Product catalogue:** `magasin.php` lists inventory with image galleries, pricing, and quantity controls, while `aperçu_rapide.php` offers detailed previews.
- **Search and discovery:** `page_recherche.php` delivers keyword search and filters, and the home page shows the six most recent items.
- **Wishlist management:** Authenticated users can toggle favorites which persist in the `liste` table and are accessible via `liste_souhaits.php`.
- **Shopping cart and checkout:** `panier.php` supports quantity updates and bulk removal, and `vérifier.php` captures shipping details and payment method for order creation.
- **Order tracking:** `ordres.php` summarizes past purchases and payment statuses for each user.
- **Account self-service:** Visitors can register (`utilisateur_registre.php`), log in (`utilisateur_login.php`), and update their profile information on `mise_jour_utilisateurs.php`.
- **Customer support:** `contact.php` posts inquiries to the `messages` table so administrators can review responses.

### Administrative Back Office
- **Authentication & roles:** Admins log in via `admin/admin_login.php` and can register additional admins from `admin/register_admin.php`.
- **Dashboard analytics:** `admin/tableau_bord.php` surfaces revenue summaries, order counts, and inventory insights.
- **Product management:** `admin/produits.php` enables CRUD operations with multi-image uploads and synchronizes deletions across carts and wish lists.
- **Order management:** `admin/commandes_passées.php` lets staff update payment states and review customer details.
- **Customer management:** Administrators can inspect and delete accounts through `admin/comptes_utilisateur.php` and curate staff records with `admin/comptes_admin.php`.
- **Inbox management:** `admin/messages.php` lists all contact form submissions for follow-up.
- **Profile management:** Admins may update their credentials in `admin/mise_jour_profil.php`.

### Project Assets & Documentation
- UML diagrams (`UML Use Case Diagram.jpg`, `Class diagram.jpg`) and data modeling artifacts (`MCD.png`) illustrate the system design.
- Screenshot assets (`User.png`, `Admin.png`) capture representative user and admin interface states.

## Setup and Installation
1. **Install prerequisites**
   - PHP 8 or newer with PDO and GD extensions
   - MySQL or MariaDB server
   - A web server (Apache/Nginx) or use `php -S` for development
   - Optional: XAMPP/WAMP/Laragon bundles for quick local environments
2. **Clone the repository**
   ```bash
   git clone https://github.com/ESSADIKINE/e-commerce-Website.git
   cd e-commerce-Website
   ```
3. **Place the project in your web root**
   - For XAMPP, copy the folder into `htdocs/`
   - For PHP's built-in server, stay inside the repository root
4. **Configure the database**
   - Create a database named `shop`
   - Import the schema and seed data from `shop.sql` using phpMyAdmin or `mysql` CLI:
     ```bash
     mysql -u root -p shop < shop.sql
     ```
5. **Update database credentials**
   - Edit `composantes/connecter.php` if your MySQL username, password, or host differs from the defaults (`root` with no password on `localhost`)
6. **Enable file uploads**
   - Ensure the `uploaded_img/` directory is writable so product image uploads succeed
7. **Launch the application**
   - With PHP's dev server: `php -S localhost:8000`
   - Visit `http://localhost:8000/accuel.php` for the storefront or `http://localhost:8000/admin/admin_login.php` for the admin panel
   - When using Apache/Nginx, ensure virtual hosts point to the repository root and restart the service

## Usage
### Customer Journey
1. Navigate to `/accuel.php` to explore featured products via the homepage carousel.
2. Browse the full catalogue on `/magasin.php`, use the search form at `/page_recherche.php`, and open quick views for detailed descriptions.
3. Create an account at `/utilisateur_registre.php` or sign in through `/utilisateur_login.php` to unlock cart and wishlist functionality.
4. Add products to the wishlist or cart, adjust quantities, and proceed to checkout via `/vérifier.php` to place orders.
5. Review order history on `/ordres.php`, manage saved items on `/liste_souhaits.php`, and update profile information through `/mise_jour_utilisateurs.php`.
6. Reach out to support through `/contact.php`; messages become visible to staff in the admin inbox.

### Administrator Workflow
1. Log in at `/admin/admin_login.php` using credentials stored in the `admins` table (seeded in `shop.sql`). If needed, insert a new admin via SQL or log in with an existing account to access `/admin/register_admin.php`.
2. Monitor sales metrics and recent activity on `/admin/tableau_bord.php`.
3. Manage products (`/admin/produits.php`), including uploading images, editing descriptions, or deleting listings (which automatically removes related cart and wishlist entries).
4. Review active orders on `/admin/commandes_passées.php`, updating payment statuses as necessary.
5. Maintain customer and staff records through `/admin/comptes_utilisateur.php` and `/admin/comptes_admin.php`.
6. Respond to inquiries listed in `/admin/messages.php` and adjust administrator credentials via `/admin/mise_jour_profil.php`.

For additional UI context, consult the screenshots and diagrams in the repository root and `project images/` directory.
