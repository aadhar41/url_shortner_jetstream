# **Short URL Management System**

This Laravel application module provides a complete solution for generating, tracking, and managing short URLs, with sophisticated **Role-Based Access Control (RBAC)** to govern user creation rights and data visibility across different organizational levels.

## **🚀 Key Features**

* **URL Creation:** Authenticated **Admin** and **Member** users can generate new short links.
* **Public Redirection:** All active short codes are publicly accessible and redirect to their original destination URLs.
* **Access Tracking:** Tracks the access count for every generated short URL.
* **Data Visibility:** Strict RBAC filtering ensures users only see data relevant to their role and scope.
* **Data Export:** Allows users to download a CSV export of their authorized list of short URLs.

## **🛠️ Project Setup and Installation**

Follow these steps to get the application running on your local machine:

### **1. Clone the Repository**

Clone the project using Git:

```bash
git clone https://github.com/aadhar41/url_shortner_jetstream.git
cd url_shortner_jetstream
```

### **2. Install Dependencies**

Install the project's PHP dependencies via Composer:

```bash
composer install
```

### **3. Environment Configuration**

Duplicate the example environment file and generate a unique application key:

```bash
cp .env.example .env
php artisan key:generate
```

### **4. Database Setup (MySQL Recommended)**

The application is configured to run on MySQL for best performance:

a. **Create Database**: Create a new MySQL database named `url_shortner_jetstream`.

b. **Configure .env**: Update your `.env` file with the connection details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortner_jetstream
DB_USERNAME=root  # Replace with your MySQL username
DB_PASSWORD=      # Replace with your MySQL password
```

### **5. Run Migrations and Seeding**

Run the database migrations to create the necessary tables (users, companies, short_urls). We also recommend running the seeders to create initial users (**SuperAdmin, Admin, Member**) for testing the RBAC rules.

```bash
php artisan migrate --seed
```

### **6. Start the Local Server**

Start the Laravel development server:

```bash
php artisan serve
```

The application will now be accessible at <http://127.0.0.1:8000>.

## **🖼️ Application Screenshots**

### **1. Authentication**

The application features standard Laravel authentication pages for logging in and registering new users.

| Login Screen | Registration Screen |
| :----: | :----: |
| ![Login Screen](public/images/screencapture-127-0-0-1-8000-login-2025-10-15-19_24_21.png) | ![Registration Screen](public/images/screencapture-127-0-0-1-8000-register-2025-10-15-19_24_31.png) |

### **2. Short URL Management**

This section is the core functionality, allowing users (Members and Admins) to generate and track links based on their access policies.

| Short URL List (Empty) | Short URL List (Data) | Create Short URL (Error) |
| :----: | :----: | :----: |
| ![Short URL List Empty](public/images/screencapture-127-0-0-1-8000-web-short-urls-2025-10-15-19_23_55.png) | ![Short URL List Data](public/images/screencapture-127-0-0-1-8000-web-short-urls-2025-10-15-19_25_34.png) | ![Create Short URL Error](public/images/screencapture-127-0-0-1-8000-web-short-urls-create-2025-10-15-19_25_45.png) |

### **3. Client Management (SuperAdmin View)**

The **SuperAdmin** role can manage and onboard clients (companies) through a dedicated interface.

| Client Management List | Invite Client Form |
| :----: | :----: |
| ![Client Management List](public/images/screencapture-127-0-0-1-8000-web-companies-2025-10-15-19_25_06.png) | ![Invite Client Form](public/images/screencapture-127-0-0-1-8000-web-companies-create-2025-10-15-19_25_18.png) |

### **4. RBAC Policy Guide**

The interactive guide simulates the data visibility and permissions for each role.

| RBAC Policy Simulator Dashboard |
| :----: |
| ![RBAC Policy Simulator Dashboard](public/images/screencapture-127-0-0-1-8000-web-dashboard-2025-10-15-19_23_30.png) |

## **🔒 Role-Based Access Control (RBAC) Policy**

The system employs granular authorization rules enforced at the Policy and Controller levels (`ShortUrlPolicy` and `ShortUrlController`) to manage creation permissions and data listings.

### **URL Creation Permissions**

| Role | Can Create New Short URLs? | Reason |
| :---- | :---- | :---- |
| **Member** | ✅ Yes | Enabled for general use. |
| **Admin** | ✅ Yes | Enabled for supervisory use within their company. |
| **SuperAdmin** | ❌ No | Restricted from direct creation. |

### **Data Visibility Rules (/web/short_urls)**

These rules determine which records appear on the main listing page for each role:

| Role | Visibility Scope | Controller Logic Enforcement |
| :---- | :---- | :---- |
| **Member** | **Self-Created Only** | Can only see the short URLs they personally created. |
| **Admin** | **Company Scope** | Can see all short URLs created by *any* user (Admin or Member) within their assigned company. |
| **SuperAdmin** | **Global Scope** | Can see the list of all short URLs across **all** companies. |

### **Single-Record Authorization (View, Edit, Delete)**

* **Member:** Can only view, edit, or delete their own short URLs.
* **Admin:** Can view, edit, or delete any short URL within their company's scope.
* **SuperAdmin:** Can view, edit, or delete any short URL globally.

## **🌐 Public Resolution (Redirection)**

The short URL resolution route (`/short_code`) is intentionally placed **outside** of the Laravel auth middleware, making it publicly resolvable.

* **Rule:** All short URLs should be publicly resolvable and redirect to the original URL.
* **Implementation:** The `ShortUrlController@redirect` method handles the lookup and redirection without requiring user authentication.

## **🤖 Tooling Acknowledgement**

This project's development and documentation benefited from the assistance of AI tools, specifically **Gemini** and **GitHub Copilot**. These tools were used to enhance code clarity, generate robust documentation, and accelerate development efficiency.
