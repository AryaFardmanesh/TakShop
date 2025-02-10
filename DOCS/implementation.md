# Implementation Documentation

## Technical Overview

### System Architecture
- **Backend**: PHP
- **Frontend**: 
  - HTML5
  - Sass (CSS preprocessor)
  - TypeScript
  - jQuery (DOM manipulation)
- **Build System**: Gulp.js (task automation and asset pipeline)
- **Database**: MySQL

---

## Page Architecture

### Public Pages
1. **Sign In**  
   User authentication portal
2. **Sign Up**  
   New user registration
3. **Products (Home)**  
   Catalog display of available products

### Authenticated User Pages
1. **Profile**  
   - User information management
   - Shopping cart operations (add/remove items)
   - Payment initiation

2. **Product Management**
   - **My Products**  
     User's product inventory management
   - **Add Product**  
     New product creation form
   - **Orders**  
     Purchase orders tracking interface

3. **Payment Gateway**  
   Financial transactions management (purchases/account top-ups)

### Admin Pages
1. **Dashboard**  
   Administrative control panel
   - **Accounts**  
     User account management (view/edit/ban)
   - **Workflow**  
     Sales analytics and platform metrics

---

## Database Schema

### Tables Overview
| Table Name            | Description                              |
|-----------------------|------------------------------------------|
| Accounts              | User account credentials and metadata    |
| Products              | Active product listings                  |
| ProductsRemoved       | Archived/removed products                |
| CartsCategory         | Shopping cart containers                 |
| Carts                 | Individual cart items                    |
| Orders                | Order tracking and status                |
| Payments              | Payment transaction records              |
| PaymentsSessions      | Active payment session management        |

### Detailed Table Structures

#### Accounts
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Unique user identifier (Primary Key) |
| Username       | VARCHAR  | Login credential                     |
| Password       | VARCHAR  | Hashed authentication token          |
| Name           | VARCHAR  | Full name                            |
| PhoneNumber    | VARCHAR  | Contact information                  |
| ZipCode        | VARCHAR  | Location data                        |
| Address        | VARCHAR  | Physical address                     |
| Role           | ENUM     | `Normal` or `Admin`                  |
| Status         | ENUM     | `Ok` or `Ban`                        |
| BanMessage     | VARCHAR  | Reason for account suspension        |
| Date           | DATE     | Account creation date                |

#### Products
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Product identifier (Primary Key)     |
| Owner          | VARCHAR  | Account ID (Foreign Key)             |
| Name           | VARCHAR  | Product title                        |
| Description    | VARCHAR  | Detailed product information         |
| Price          | DECIMAL  | Price of the product                 |
| Count          | INT      | Inventory quantity                   |
| Status         | ENUM     | `Ok` or `Ban`                        |
| BanMessage     | VARCHAR  | Product removal reason               |

*`ProductsRemoved` maintains identical structure to Products*

#### CartsCategory
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Cart identifier (Primary Key)        |
| CartID         | VARCHAR  | Unique cart reference                |
| Owner          | VARCHAR  | Account ID (Foreign Key)             |
| TotalPrice     | DECIMAL  | Aggregated cart value                |

#### Carts
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Entry identifier (Primary Key)       |
| CartID         | VARCHAR  | CartsCategory reference (Foreign Key)|
| ProductID      | VARCHAR  | Product reference (Foreign Key)      |

#### Orders
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Order identifier (Primary Key)       |
| CartID         | VARCHAR  | CartsCategory reference (Foreign Key)|
| Status         | ENUM     | Order state: `Suspended`, `Ready`, `Cancel`, `Payed`, `Ban` |
| BanMessage     | VARCHAR  | Order cancellation reason            |

#### Payments
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Payment ID (Primary Key)             |
| CartID         | VARCHAR  | CartsCategory reference (Foreign Key)|
| Status         | ENUM     | `Ready`, `Cancel`, `Payed`           |

#### PaymentsSessions
| Column         | Type     | Description                          |
|----------------|----------|--------------------------------------|
| ID             | VARCHAR  | Session ID (Primary Key)             |
| CartID         | VARCHAR  | CartsCategory reference (Foreign Key)|

---

## Core Functionality Workflows

### Account Creation
1. Insert new record into Accounts table
2. Generate unique UUID for ID field
3. Store password using secure hashing algorithm
4. Set default role to 'Normal' and status to 'Ok'

### Product Management
**Adding Product:**
1. Verify user authentication
2. Insert new Products record with:
   - Owner = current user's Account.ID
   - Status = 'Ok'
   - Count = initial inventory

**Removing Product:**
1. Copy product record to ProductsRemoved
2. Delete from Products table

### Purchase Process
1. **Cart Creation**
   - Create CartsCategory entry
   - Add selected products to Carts table

2. **Order Initialization**
   - Create Orders record linked to cart
   - Set initial status to 'Suspended'

3. **Payment Processing**
   - Create Payments and PaymentsSessions records
   - Inventory check:
     - Sufficient product quantities
     - Valid payment method
   - **Success**: 
     - Deduct inventory
     - Update Payments.status to 'Payed'
     - Delete PaymentsSessions record
   - **Failure**:
     - Restore inventory quantities
     - Set Payments.status to 'Cancel'
     - Delete PaymentsSessions record

---

# JWT Token
Each token must contain the following information to identify individuals:
- Accounts.ID
- Accounts.Username

---

# Security Considerations
- All sensitive data (passwords/payment info) encrypted at rest
- Role-based access control for admin functions
- Session validation for all authenticated actions
- Transaction rollback capabilities for payment failures

---

# File System
The project file system is as follows:
- DOCS: Project documentation.
- lib: Website PHP source code.
- styles: SASS files for website styles.
- scripts: TypeScript files.
- img: Available images.

## How to build ?
To build the project, you can run the following command in the terminal:
```sh
npm run build
```
And to automatically build the program, you can use the following command (it automatically builds the project when changes are made):
```sh
npm start
```
When the project is built, the SASS files in the 'styles/' directory are compiled and moved to the lib/ directory. It then goes to the scripts/ directory and compiles the TypeScript files and moves them to the 'lib/' directory.
