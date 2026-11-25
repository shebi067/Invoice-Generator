# 🧾 InvoiceMaker — Free Online Invoice Generator & PDF Maker

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> **InvoiceMaker** is a lightweight, responsive, and completely free web-based invoice generator. It enables freelancers, small businesses, contractors, and agencies to create, customize, preview, and download professional PDF invoices in seconds—with no login or subscription required.

---

## 🌟 Key Features

- ⚡ **Interactive Real-Time Builder:** Edit company details, client info, line items, taxes, discounts, and notes with instant live recalculations.
- 🎨 **8 Designer Templates:**
  - **Everyday** (`modern`) — Clean and contemporary default layout.
  - **Studio** (`freelancer`) — Stylish and tailored for creative freelancers.
  - **Standard** (`classic`) — Traditional, structured corporate format.
  - **Mint** (`minimal`) — Subtle accent colors and minimal layout.
  - **Blue Line** (`corporate`) — Professional business and enterprise aesthetic.
  - **Flow** (`wave`) — Modern curved design accents.
  - **Silver** (`simple`) — Sleek monochrome grayscale design.
  - **Aqua** (`signature`) — Deep teal accents with an elegant signature area.
- 🖨️ **Dual Export Options:**
  - **Instant PDF Download:** Client-side generation using `jsPDF` & `html2canvas`.
  - **Print Ready:** Optimized `@media print` stylesheet removing headers, buttons, and margins for clean paper or browser PDF printing.
- 🖼️ **Custom Branding:** Upload your own company logo with live preview and sizing controls.
- 💱 **Multi-Currency & Tax Handling:** Supports custom currencies, discount rates, tax percentages, shipping costs, and payment terms.
- 📱 **Fully Responsive:** Smooth user experience across desktop, tablet, and mobile devices.
- 🔍 **SEO & Meta Ready:** Pre-configured Open Graph, Twitter Cards, and Schema.org (`WebApplication` & `Organization`) JSON-LD structured data.

---

## 🛠️ Tech Stack

- **Backend Framework:** [Laravel](https://laravel.com/) (PHP ^8.3)
- **Frontend Layer:** [Blade Templates](https://laravel.com/docs/blade) + [Alpine.js](https://alpinejs.dev/)
- **Styling:** [Tailwind CSS](https://tailwindcss.com/)
- **PDF & Canvas Rendering:** [jsPDF](https://github.com/parallax/jsPDF) & [html2canvas](https://html2canvas.hertzen.com/)
- **Asset Bundler:** [Vite](https://vitejs.dev/)

---

## 📂 Project Structure

```text
invoicegenerator/
├── app/
│   ├── Http/Controllers/
│   │   └── PageController.php      # Handles builder, template gallery, pages & contact
│   └── Models/
├── config/                         # Laravel configuration files
├── database/                       # Migrations, seeders, and factories
├── public/                         # Public assets (images, fonts, favicons)
├── resources/
│   ├── css/                        # Tailwind and app styles
│   ├── js/                         # JavaScript entries
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php       # Master layout with Alpine.js & PDF scripts
│       ├── pages/
│       │   ├── builder.blade.php   # Custom canvas builder
│       │   ├── customize.blade.php # Template customizer
│       │   ├── templates.blade.php # Free templates gallery
│       │   ├── how-it-works.blade.php
│       │   ├── faqs.blade.php
│       │   └── contact.blade.php
│       └── templates/              # 8 pre-built invoice templates
│           ├── classic.blade.php
│           ├── corporate.blade.php
│           ├── freelancer.blade.php
│           ├── minimal.blade.php
│           ├── modern.blade.php
│           ├── signature.blade.php
│           ├── simple.blade.php
│           └── wave.blade.php
├── routes/
│   └── web.php                     # Application web routes
└── vite.config.js                  # Vite configuration
```

---

## 🚀 Getting Started

Follow these steps to run the application locally on your machine.

### Prerequisites

Ensure you have the following installed:
- **PHP** >= 8.3
- **Composer**
- **Node.js** (v18+ recommended) & **npm**
- **Laravel Herd** (recommended on Windows/Mac) or local server (XAMPP / Laragon / Docker)

### Installation Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/invoicegenerator.git
   cd invoicegenerator
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   ```bash
   # Copy sample environment configuration
   cp .env.example .env

   # Generate Laravel application encryption key
   php artisan key:generate
   ```

5. **Run Database Migrations (Optional / SQLite by default):**
   ```bash
   php artisan migrate
   ```

6. **Build assets & start development server:**

   **Option A — Using Composer dev script (concurrent server + Vite):**
   ```bash
   composer run dev
   ```

   **Option B — Running separately:**
   ```bash
   # Terminal 1: Run Vite bundler
   npm run dev

   # Terminal 2: Run Laravel backend server
   php artisan serve
   ```

   **Option C — If using Laravel Herd:**
   - Place project in your Herd directory (e.g., `~/Herd/invoicegenerator`).
   - Run `npm run dev` or `npm run build`.
   - Open `http://invoicegenerator.test` in your browser.

---

## 🧭 Routes Overview

| Route | Method | Description |
|---|---|---|
| `/` | `GET` | Main interactive invoice maker & generator |
| `/templates` | `GET` | Gallery of 8 ready-to-use invoice templates |
| `/templates/{template}` | `GET` | Dedicated editor for a specific invoice template |
| `/builder` | `GET` | Blank canvas custom invoice builder |
| `/how-it-works` | `GET` | Step-by-step user guide |
| `/faqs` | `GET` | Frequently asked questions |
| `/blog` | `GET` | Invoicing tips, guides & financial articles |
| `/contact` | `GET` / `POST` | Contact support & feedback form |
| `/privacy-policy` | `GET` | Data protection and privacy statement |

---

## 🎨 Available Templates

You can preview and customize templates directly under `/templates`:

| Template Key | Display Name | Theme Color | Best Suited For |
|---|---|---|---|
| `modern` | **Everyday** | `#111827` (Dark Charcoal) | Everyday general billing |
| `freelancer` | **Studio** | `#2A373D` (Slate Dark) | Designers, artists & freelancers |
| `classic` | **Standard** | `#1E293B` (Classic Navy) | Traditional accounting & services |
| `minimal` | **Mint** | `#849B89` (Soft Sage) | Clean minimalist modern look |
| `corporate` | **Blue Line** | `#2B4C7E` (Executive Blue) | Corporate & B2B clients |
| `wave` | **Flow** | `#1F2937` (Modern Flow) | Agencies & modern tech startups |
| `simple` | **Silver** | `#64748B` (Neutral Slate) | Quick receipts & simple billings |
| `signature` | **Aqua** | `#134E4A` (Deep Teal) | Formal agreements & signatures |

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues page](https://github.com/your-username/invoicegenerator/issues).

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is open-sourced under the [MIT License](LICENSE).
