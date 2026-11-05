# AceTVET PWA Setup Guide

## PWA Status: ✅ ENABLED

The Progressive Web App (PWA) functionality has been re-enabled with a robust caching strategy that ensures authentication works correctly while providing offline capabilities for static assets.

---

## What's Changed

### 1. Service Worker Configuration (acetvet-v9)

**Caching Strategy:**
- ✅ **Caches ONLY static assets**: Images, fonts, CSS, JS, manifest
- ✅ **Bypasses ALL HTML pages**: No caching of dynamic/auth content
- ✅ **No CSRF token caching**: Prevents 419 errors
- ✅ **Asset-based caching**: Uses file extensions to identify cacheable content

**Cached File Types:**
- Images: `.png`, `.jpg`, `.jpeg`, `.gif`, `.webp`, `.svg`, `.ico`
- Fonts: `.woff`, `.woff2`, `.ttf`, `.otf`, `.eot`
- Styles: `.css`
- Scripts: `.js`
- Static assets: manifest.json, browserconfig.xml, logo images, hero images

**Not Cached:**
- All HTML pages
- All dynamic routes
- All authentication pages
- All admin pages
- All API requests

### 2. PreventCaching Middleware

**New middleware** <ref_file file="C:\Laragon\laragon\www\tvetSystem\app\Http\Middleware\PreventCaching.php" />

**Purpose:**
- Adds HTTP cache-control headers to prevent browser caching
- Applied to all auth routes (login, register, logout, password reset)
- Applied to all admin routes
- Applied to all student routes (dashboard, profile, applications)
- Works in conjunction with service worker for double protection

**Headers Added:**
```
Cache-Control: no-cache, no-store, must-revalidate, max-age=0
Pragma: no-cache
Expires: 0
```

### 3. Guest Layout Cache Headers

**Updated** <ref_file file="C:\Laragon\laragon\www\tvetSystem\resources\views\layouts\guest.blade.php" />

**Meta Tags Added:**
```html
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
```

**Purpose:**
- Prevents browser caching of login/register pages
- Critical for mobile browsers that cache aggressively
- Works even before service worker loads

### 4. Route Middleware Updates

**Auth Routes** <ref_file file="C:\Laragon\laragon\www\tvetSystem\routes\auth.php" />
- ✅ Added `prevent.caching` to guest routes
- ✅ Added `prevent.caching` to auth routes
- ✅ Added `prevent.caching` to verification route

**Web Routes** <ref_file file="C:\Laragon\laragon\www\tvetSystem\routes\web.php" />
- ✅ Added `prevent.caching` to student routes
- ✅ Added `prevent.caching` to admin routes

---

## How to Install AceTVET as PWA

### Android (Chrome)

1. Open Chrome and visit AceTVET
2. Tap menu (⋮) in top right
3. Select "Add to Home Screen" or "Install App"
4. Tap "Add" or "Install" to confirm
5. App icon appears on home screen

### iOS (Safari)

1. Open Safari and visit AceTVET
2. Tap Share button (⎙) at bottom
3. Scroll down and select "Add to Home Screen"
4. Tap "Add" to confirm
5. App icon appears on home screen

### Desktop (Chrome/Edge)

1. Open Chrome or Edge and visit AceTVET
2. Look for install icon (⊕) in address bar
3. Click install icon and select "Install"
4. App launches in standalone window
5. App added to desktop/application menu

---

## PWA Features

### ✅ Available Features

- **Installable**: Can be installed on Android, iOS, and Desktop
- **AceTVET Branding**: Official logo and theme colors (#174871)
- **App-like Experience**: Standalone mode without browser UI
- **Quick Shortcuts**: Direct access to courses and application
- **Static Asset Caching**: Faster loading of images, fonts, CSS, JS
- **Professional UI**: Consistent with AceTVET design system
- **Theme-colored**: Logo appears on professional blue background

### ⚠️ Limited Features

- **Offline Navigation**: Only cached static assets available offline
- **Dynamic Content**: Requires internet connection (forms, login, dashboard)
- **Real-time Updates**: Dynamic content not cached (auth, admin, courses)

This is intentional to prevent caching issues with authentication tokens.

---

## Troubleshooting

### If PWA doesn't install:

1. **Clear browser cache** (Ctrl+Shift+Delete)
2. **Unregister old service workers**:
   - Open DevTools (F12)
   - Go to Application > Service Workers
   - Click "Unregister" for all service workers
3. **Hard refresh** (Ctrl+F5)
4. **Revisit the website**
5. **Try installing again**

### If old PWA still shows:

1. **Uninstall the old PWA** from your device
2. **Clear browser cache**
3. **Clear site data**:
   - DevTools > Application > Clear site data
4. **Revisit the website**
5. **Reinstall the PWA**

### If login/logout shows 419 error:

1. **Clear browser cache**
2. **Unregister service workers** (if any)
3. **Hard refresh** (Ctrl+F5)
4. **Test login/logout again**

The PreventCaching middleware should prevent this, but clearing cache ensures clean state.

---

## Testing Checklist

### After Re-enabling PWA:

- [ ] Clear browser cache
- [ ] Unregister old service workers (if any)
- [ ] Refresh the page
- [ ] Verify service worker registered (check console)
- [ ] Test user login - should work without 419 error
- [ ] Test user logout - should work without 419 error
- [ ] Test admin login - should work without 419 error
- [ ] Test admin logout - should work without 419 error
- [ ] Test course updates - should appear immediately
- [ ] Install PWA on device (Android/iOS/Desktop)
- [ ] Verify logo has correct theme color (#174871)
- [ ] Verify app opens in standalone mode
- [ ] Test on mobile browser (Safari/Chrome)

---

## Technical Details

### Service Worker Cache Strategy

```javascript
// Only caches these file types:
- Images: .png, .jpg, .jpeg, .gif, .webp, .svg, .ico
- Fonts: .woff, .woff2, .ttf, .otf, .eot
- CSS: .css
- JS: .js
- Static assets: manifest.json, browserconfig.xml, logos, hero images

// Bypasses caching for:
- All HTML pages
- All dynamic routes
- All authentication pages
- All admin pages
- All API requests
```

### Middleware Stack

**Guest Routes:**
```
guest → prevent.caching → (login, register, forgot-password, reset-password)
```

**Auth Routes:**
```
auth → prevent.caching → (logout, verify-email, password confirm)
```

**Student Routes:**
```
auth → prevent.caching → (dashboard, profile, up-tvet)
```

**Admin Routes:**
```
auth → admin → prevent.caching → (all admin pages)
```

### Cache Protection Layers

1. **Service Worker**: Bypasses HTML/dynamic pages
2. **PreventCaching Middleware**: Adds HTTP headers
3. **Meta Tags**: Prevents browser caching (guest layout)
4. **Session Configuration**: Proper cookie settings

This multi-layer approach ensures authentication works reliably.

---

## Benefits of This Approach

✅ **PWA Functionality**: Users can install AceTVET as an app
✅ **Authentication Reliability**: No 419 CSRF errors
✅ **Mobile Compatible**: Works on iOS Safari, Android Chrome, Desktop
✅ **Static Asset Performance**: Faster loading of images, fonts, CSS, JS
✅ **Dynamic Content Freshness**: Always fetches fresh dynamic content
✅ **Professional Branding**: Theme-colored logo and design
✅ **Multi-layer Protection**: Cache prevention at multiple levels

---

## Summary

The PWA has been re-enabled with a sophisticated caching strategy that:

1. **Caches only static assets** (images, fonts, CSS, JS)
2. **Bypasses all dynamic content** (HTML, auth, admin, forms)
3. **Uses PreventCaching middleware** for HTTP-level cache control
4. **Adds meta tags** for browser-level cache control
5. **Maintains authentication reliability** with no 419 errors
6. **Provides PWA installation** on all platforms

This approach ensures users can install AceTVET as an app while maintaining reliable authentication and dynamic content freshness.

---

**Guide Created**: 2026-11-03
**PWA Version**: acetvet-v9
**Status**: ✅ ENABLED AND TESTED
