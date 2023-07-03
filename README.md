# Laravel Discount Finder Application
This Laravel-based application aims to provide a platform for users to find discounts near them and create a list of items they would like to purchase. It also offers a map feature that shows the proximity of desired products. The application is not limited to end-users; it also caters to producers who want to expand their business and reach a larger customer base. The activities on the platform are monitored by one or more admins who can terminate user or producer permissions in case of policy violations.

## User Types and Privileges
### Producers
Producers have a unique profile that includes the following information:

- Business owner or admin name
- Email and contact number
- Business name for marketing purposes
- Service or product location (chosen via a map interface)
- Unique password for signing into the application and managing 
- business and product information
Producers can create posts about their products or services. When adding a product, they can search for existing posts to avoid duplications. If a similar product already exists, they can choose it. Otherwise, they can assign a new name to their product. Each post should include:

- Product name
- Price (original price and discount percentage)
- Link to the product's website
- Detailed description
- Photo for visual representation
Producers can modify or edit their posts if the offer has expired or the product is no longer available.

### Users
Users also have a profile that includes the following information:

- Name and family name
- Email and contact number
- Unique password for accessing their profile
Users can explore all available posts and offers. They can add 
  desired items to their wish list, which is located in their dashboard. The wish list displays item details. The map interface shows stores with a specific logo, indicating their location relative to the user. Clicking on a store displays a gallery of their available products, with each photo serving as a direct link to the product's website. Users can also review and modify their personal data in their dashboard.

While exploring posts, users can rate products and leave comments. Admin approval is required for comments to be published on the product's details page, along with the name of the user who published the comment.

### Admins
Admins have a separate interface to control the flow of the web application. They can monitor users, products, categories, and comments. Admins review and authorize products and comments. Products initially have a passive status and require admin approval to become active and be displayed on the main page. Ratings and comments from users also have a passive status initially and require admin approval to be published. The average rating score contributes to the product's visibility on the main page.

Admins can add new categories and sub-categories for producers to announce their services. They have the authority to make user or producer profiles passive and ban them from the website in case of unauthorized activity. Admins can modify personal data, including passwords, through the admin panel.

## Motivations
This project addresses the essential role of shopping in people's daily lives and the desire for discounts. It aims to create an enjoyable and efficient shopping experience by offering discounts on desired products. Additionally, businesses often struggle to promote their discounts and new products on a large scale. This application seeks to bridge the gap between businesses and end-users by providing a platform where both parties can benefit. The project draws inspiration from existing web applications that offer similar services on a smaller scale but are not integrated.

## Prerequisites
- PHP (>= 7.4)
- Composer
- Laravel (>= 8.x)
- MySQL or any other supported database system

## Installation Steps
- Clone the project repository to your local machine or download the source code as a ZIP file.

- Open a terminal or command prompt and navigate to the project's root directory.

- Run the following command to install the project dependencies:
 ```
composer install
``` 
- Create a new database (MySQL) for the application in your database management system .

- Generate a new application key by running the following command:
 ```
php artisan key:generate
```
- Run the database migrations to set up the required database tables:
 ```
php artisan migrate
```
- Start the local development server by running the following command:
 ```
php artisan serve

```
