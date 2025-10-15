# **Short URL Management System**

This Laravel application module provides a complete solution for generating, tracking, and managing short URLs, with sophisticated Role-Based Access Control (RBAC) to govern user creation rights and data visibility across different organizational levels.

## **🚀 Key Features**

* **URL Creation:** Authenticated **Admin** and **Member** users can generate new short links.  
* **Public Redirection:** All active short codes are publicly accessible and redirect to their original destination URLs.  
* **Access Tracking:** Tracks the access count for every generated short URL.  
* **Data Visibility:** Strict RBAC filtering ensures users only see data relevant to their role and scope.  
* **Data Export:** Allows users to download a CSV export of their authorized list of short URLs.

## **🔒 Role-Based Access Control (RBAC) Policy**

The system employs granular authorization rules enforced at the Policy and Controller levels (ShortUrlPolicy and ShortUrlController) to manage creation permissions and data listings.

### **URL Creation Permissions**

| Role | Can Create New Short URLs? | Reason |
| :---- | :---- | :---- |
| **Member** | ✅ Yes | Enabled for general use. |
| **Admin** | ✅ Yes | Enabled for supervisory use within their company. |
| **SuperAdmin** | ❌ No | Restricted from direct creation. |

### **Data Visibility Rules (/web/short\_urls)**

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

The short URL resolution route (/short\_code) is intentionally placed **outside** of the Laravel auth middleware, making it publicly resolvable.

* **Rule:** All short URLs should be publicly resolvable and redirect to the original URL.  
* **Implementation:** The ShortUrlController@redirect method handles the lookup and redirection without requiring user authentication.