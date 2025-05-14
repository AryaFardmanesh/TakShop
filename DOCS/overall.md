# Overview

This document provides an in-depth technical overview of the project. The project is a shopping website similar to DigiKala, though on a much smaller scale. Users can browse, purchase, or add products, while site administrators have the ability to review and manage the entire site. In this documentation, we examine the project from a technical standpoint, detailing the architecture, tools, build process, and file structure.

# Tools and Technologies

This project leverages several tools and technologies to ensure a robust, maintainable, and efficient development process. The tools are organized into the following categories:

## Front-End

- **HTML:** Provides the structure and content for web pages.
- **SASS:** A CSS preprocessor that enables the creation of clean, modular, and maintainable styles.
- **TypeScript:** Offers type safety and object-oriented programming features for writing secure and scalable client-side code.
- **jQuery:** Simplifies DOM manipulation and enhances the interactivity of web pages.

## Back-End

- **PHP:** Handles server-side logic and dynamic content generation.

## Database

- **MySQL:** Serves as the relational database management system, chosen for its ease of integration with PHP and its reliability.

## Build System

- **Gulp.js:** Automates tasks and manages the asset pipeline. Gulp is used for compiling SASS to CSS, transpiling TypeScript to JavaScript, and copying static assets.

# Build Process

Follow these steps to build the application:

1. **Clone the Repository:**

   ```sh
   git clone https://github.com/AryaFardmanesh/TakShop.git
   ```

2. **Install Dependencies:**

   Navigate to the project directory and run:

   ```sh
   npm install
   ```

3. **Build the Project:**

   Compile the assets and build the project by executing:

   ```sh
   npm run build
   ```

4. **Development Mode:**

   For a more streamlined development experience, run the following command to automatically rebuild the project whenever changes are made:

   ```sh
   npm run start
   ```

# Project File Structure

The file system of this project is organized to clearly separate public assets from source code, ensuring both security and maintainability. Below is the directory structure along with a brief explanation of each component:

```unix-tree
project/
├── .git/                 	   # Git repository
├── DOCS/                 	   # Documentation files
│   ├── overall.md        	   # General project documentation
│   └── implementation.md 	   # Detailed implementation documentation
├── database/               	# All SQLs file
│   └── init.sql/           	# The queries for initialization of database
├── public/               	   # Publicly accessible files (Output)
│   ├── assets/           	   # All assets
│   │   ├── images/           # Image assets
│   │   ├── fonts/           	# The fonts used in website
│   │   └── repo/           	# Libraries repository
│   └── {page_name}/      	   # Directory for individual site pages
│       ├── {page_name}.php 	# Front-end PHP file for the page
│       ├── main.js       	   # JavaScript compiled from TypeScript
│       └── main.css      	   # CSS compiled from SASS
├── src/                  	   # PHP source files (non-public)
│   ├── utils/            	   # Utility functions and application helpers
│   ├── models/           	   # Backend models representing data structures
│   ├── services/      	      # Services managing business logic
│   └── config.php        	   # Main PHP configuration file
├── scripts/              	   # TypeScript source files
│   ├── modules/      	      # All modules and functions
│   └── {page_name}/      	   # Directory for page-specific scripts (e.g., login)
│       └── main.ts       	   # Main TypeScript file for the page
├── styles/               	   # SASS source files
│   ├── components/       	   # Styles for reusable components
│   ├── pages/            	   # Page-specific style files
│   ├── _config.scss      	   # Global style variables and settings
│   └── _mixins.scss      	   # SASS mixins and functions
├── config.js             	   # Global configuration file for Gulp tasks
├── gulpfile.js           	   # Gulp task definitions (e.g., SASS compilation, TS transpilation)
├── package.json          	   # Node.js package definitions for Gulp and front-end dependencies
├── tsconfig.json         	   # TypeScript compiler configuration
├── .gitignore             	# The ignore file for git
├── AUTHORS.txt             	# The authors (contributors) list
├── README.md             	   # The README file
├── SECURITY.md             	# The SECURITY file
└── LICENSE             	   # The LICENSE file
```

This structure ensures that:
- **Security:** Sensitive PHP code remains outside of the public directory.
- **Modularity:** Files are grouped by function, making the system easier to maintain and scale.
- **Clarity:** Developers can quickly identify and navigate between different parts of the project.
