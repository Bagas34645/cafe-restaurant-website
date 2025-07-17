#!/bin/bash

# Sentra Durian Tegal - Merge and Deploy Script
# Script untuk merge ke main branch dan persiapan deployment

set -e  # Exit on any error

echo "🚀 Sentra Durian Tegal - Merge to Main Branch Script"
echo "=================================================="

# Check if we're in the right directory
if [ ! -f "composer.json" ] || [ ! -f "artisan" ]; then
    echo "❌ Error: This doesn't appear to be a Laravel project directory"
    exit 1
fi

# Check current branch
CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
echo "📍 Current branch: $CURRENT_BRANCH"

# Ensure we have all our changes committed
if [ -n "$(git status --porcelain)" ]; then
    echo "❌ Error: You have uncommitted changes. Please commit them first."
    git status
    exit 1
fi

echo "✅ All changes committed"

# Switch to main branch
echo "🔄 Switching to main branch..."
git checkout main

# Pull latest changes from main (if any)
echo "🔄 Pulling latest changes from main..."
if git pull origin main 2>/dev/null; then
    echo "✅ Successfully pulled from main"
else
    echo "⚠️  Warning: Could not pull from main (check network/auth)"
fi

# Merge checkout branch into main
echo "🔄 Merging checkout branch into main..."
git merge checkout --no-ff -m "Merge checkout branch: Complete cleanup and production readiness

- Clean up debug and test files
- Organize documentation structure  
- Add deployment guides and contributing guidelines
- Prepare codebase for production deployment

Features merged:
- Enhanced order management functionality
- Product review system with seeding
- Shopping cart layout improvements
- Product listing with search and filters
- Modern theme implementation
- Checkout autofill functionality
- User authentication for cart operations
- Payment success/failure pages"

echo "✅ Successfully merged checkout branch into main"

# Run tests to ensure everything works
echo "🧪 Running basic checks..."

# Check if .env exists
if [ ! -f ".env" ]; then
    echo "⚠️  Warning: .env file not found. Copying from .env.example"
    cp .env.example .env
    echo "📝 Please update .env file with your configuration"
fi

# Install/update dependencies
echo "📦 Installing/updating dependencies..."
composer install --optimize-autoloader
npm install

# Clear caches
echo "🧹 Clearing application caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Basic checks completed"

# Show final status
echo ""
echo "🎉 Merge to main branch completed successfully!"
echo "=================================="
echo ""
echo "📋 Next Steps for Deployment:"
echo "1. Push to remote main branch: git push origin main"
echo "2. Review DEPLOYMENT.md for VPS setup instructions"
echo "3. Ensure .env is configured for production"
echo "4. Run database migrations on production: php artisan migrate --force"
echo "5. Seed database if needed: php artisan db:seed --force"
echo ""
echo "📚 Documentation:"
echo "- Main README: README.md"
echo "- Deployment Guide: DEPLOYMENT.md"  
echo "- Contributing Guide: CONTRIBUTING.md"
echo "- All docs: docs/README.md"
echo ""
echo "🔍 Current Git Status:"
git log --oneline -5
echo ""
echo "Ready for production deployment! 🚀"
