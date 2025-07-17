# Contributing Guidelines

Terima kasih atas minat Anda untuk berkontribusi pada project Sentra Durian Tegal Website!

## 🎯 Code of Conduct

Semua kontributor diharapkan untuk mengikuti kode etik:
- Bersikap hormat dan profesional
- Tidak melakukan spam atau trolling
- Fokus pada perbaikan dan pengembangan fitur
- Menggunakan bahasa yang sopan dalam komunikasi

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/SQLite
- Git

### Development Setup
1. Fork repository ini
2. Clone fork Anda:
   ```bash
   git clone https://github.com/username/cafe-restaurant-website.git
   cd cafe-restaurant-website
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   ```

## 📝 Pull Request Process

### 1. Create Branch
Buat branch baru untuk fitur/perbaikan:
```bash
git checkout -b feature/nama-fitur
# atau
git checkout -b bugfix/nama-bug
```

### 2. Coding Standards
- **PHP**: Ikuti PSR-12 coding standard
- **JavaScript**: Gunakan ES6+ syntax
- **CSS**: Gunakan BEM methodology atau konsisten dengan Bootstrap classes
- **Blade**: Gunakan proper indentation dan structure

### 3. Commit Guidelines
Format commit message:
```
type(scope): deskripsi singkat

Deskripsi lebih detail jika diperlukan

Fixes #issue_number
```

Types:
- `feat`: Fitur baru
- `fix`: Bug fix
- `docs`: Perubahan dokumentasi
- `style`: Formatting, missing semi colons, etc
- `refactor`: Code refactoring
- `test`: Adding missing tests
- `chore`: Maintenance tasks

Contoh:
```
feat(gallery): tambah fitur upload multiple images

- Implementasi drag & drop upload
- Validasi file type dan size
- Preview image sebelum upload

Fixes #123
```

### 4. Testing
Pastikan semua test pass:
```bash
php artisan test
npm run test
```

### 5. Submit PR
1. Push branch ke fork Anda
2. Buat Pull Request di GitHub
3. Isi template PR dengan lengkap
4. Link ke issue terkait (jika ada)

## 🎨 Style Guide

### PHP Code Style
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Model::where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
```

### JavaScript Style
```javascript
// Use const/let instead of var
const items = document.querySelectorAll('.item');

// Use arrow functions
const handleClick = (event) => {
    event.preventDefault();
    // Handle click
};

// Use template literals
const message = `Hello ${name}!`;
```

### Blade Templates
```blade
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $title }}</h1>
            
            @if($items->count() > 0)
                @foreach($items as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">Tidak ada data tersedia.</p>
            @endif
        </div>
    </div>
</div>
@endsection
```

## 🐛 Bug Reports

Gunakan GitHub Issues untuk melaporkan bug:

### Template Bug Report
```
**Describe the bug**
Deskripsi singkat tentang bug

**To Reproduce**
Steps untuk reproduce behavior:
1. Go to '...'
2. Click on '....'
3. Scroll down to '....'
4. See error

**Expected behavior**
Jelaskan apa yang seharusnya terjadi

**Screenshots**
Jika aplikabel, tambahkan screenshots

**Environment:**
- OS: [e.g. Ubuntu 20.04]
- Browser: [e.g. chrome, safari]
- PHP Version: [e.g. 8.2]
- Laravel Version: [e.g. 12.0]

**Additional context**
Context tambahan tentang problem
```

## ✨ Feature Requests

Gunakan GitHub Issues dengan label "enhancement":

### Template Feature Request
```
**Is your feature request related to a problem?**
Deskripsi problem yang ingin diselesaikan

**Describe the solution you'd like**
Deskripsi solusi yang diinginkan

**Describe alternatives you've considered**
Alternatif solusi yang sudah dipertimbangkan

**Additional context**
Context atau screenshots tambahan
```

## 📊 Project Structure

```
app/
├── Http/Controllers/    # Controllers untuk handle requests
├── Models/             # Eloquent models
├── Middleware/         # Custom middleware
└── helpers.php         # Helper functions

resources/
├── views/             # Blade templates
├── css/               # Stylesheet files
└── js/                # JavaScript files

database/
├── migrations/        # Database schema
├── seeders/          # Sample data
└── factories/        # Model factories

tests/
├── Feature/          # Feature tests
└── Unit/             # Unit tests
```

## 🔍 Code Review Checklist

- [ ] Code mengikuti style guide
- [ ] Tidak ada debug statements (`dd()`, `console.log()`)
- [ ] Dokumentasi code sudah adequate
- [ ] Tests ditambahkan untuk fitur baru
- [ ] Breaking changes didokumentasikan
- [ ] Performance impact sudah dipertimbangkan
- [ ] Security implications sudah diperiksa

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [PHP Standards Recommendations](https://www.php-fig.org/psr/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [JavaScript MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

## 🤝 Community

- GitHub Issues: Untuk bug reports dan feature requests
- GitHub Discussions: Untuk pertanyaan umum dan diskusi
- Email: untuk pertanyaan sensitif atau private

Terima kasih telah berkontribusi! 🎉
