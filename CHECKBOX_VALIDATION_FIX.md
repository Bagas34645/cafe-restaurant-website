# Perbaikan Error: "The is available field must be true or false"

## Masalah
Error validation terjadi pada field `is_available` di form Edit Product dengan pesan:
```
The is available field must be true or false.
```

## Root Cause
1. **Validation rule terlalu ketat**: `'is_available' => 'boolean'` tidak menerima value yang tidak dikirim
2. **Checkbox behavior**: HTML checkbox tidak mengirim nilai apapun ketika tidak dicentang
3. **Laravel validation**: Rule `boolean` memerlukan value yang ada dan valid

## Perbaikan yang Dilakukan

### 1. ProductController.php - Validation Rules
**Before:**
```php
'is_available' => 'boolean'
```

**After:**
```php
'is_available' => 'sometimes|boolean'
```

- `sometimes`: Field hanya divalidasi jika ada dalam request
- `boolean`: Tetap memvalidasi sebagai boolean jika ada

### 2. ProductController.php - Data Processing  
**Before:**
```php
'is_available' => $request->has('is_available')
```

**After:**
```php
'is_available' => (bool) $request->input('is_available', 0)
```

- Menggunakan `input()` dengan default value `0`
- Explicit cast ke `boolean` untuk memastikan type yang benar

### 3. View Templates - Hidden Input Pattern
**Before:**
```html
<input class="form-check-input" type="checkbox" id="is_available" name="is_available">
```

**After:**
```html
<input type="hidden" name="is_available" value="0">
<input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1">
```

- **Hidden input**: Memastikan value `0` selalu dikirim
- **Checkbox**: Value `1` dikirim ketika dicentang (override hidden input)
- **Result**: Selalu ada value (`0` atau `1`) yang dikirim ke server

## Hasil
- ✅ Checkbox unchecked → sends `"0"` → converts to `false`
- ✅ Checkbox checked → sends `"1"` → converts to `true`  
- ✅ Validation passes untuk kedua kondisi
- ✅ Database menyimpan boolean value yang benar

## Files Changed
1. `/app/Http/Controllers/ProductController.php` - Validation & processing
2. `/resources/views/admin/products/edit.blade.php` - Hidden input pattern  
3. `/resources/views/admin/products/create.blade.php` - Hidden input pattern

Form Edit Product sekarang berfungsi normal tanpa error validation pada field `is_available`.
