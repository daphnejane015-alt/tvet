# Deployment Checklist for Render

## ✅ Pre-Deployment Verification

### 1. GitHub Repository
- ✅ All changes pushed to GitHub
- ✅ Latest commit: `1981e07` - Major system update
- ✅ No session files committed (excluded by .gitignore)

### 2. Database Migrations
The following migrations will run automatically:
- ✅ Drop deprecated `applications` table
- ✅ Rename `up_tvet_applications` to `acetvet_applications`
- ✅ Remove Google Form integration columns
- ✅ Cleanup duplicate data migration

**Note:** These migrations are safe and won't cause data loss.

### 3. Environment Variables
Ensure these are set in Render Dashboard (Settings → Environment):

Required Variables:
- ✅ `APP_ENV`: `production`
- ✅ `APP_NAME`: `AceTVET`
- ✅ `APP_DEBUG`: `false`
- ✅ `APP_URL`: `https://tvetsystem.onrender.com`
- ✅ `DB_CONNECTION`: `pgsql`
- ✅ `DB_HOST`: `dpg-dbg09ol9el5s73bget5g-a.singapore-postgres.render.com`
- ✅ `DB_PORT`: `5432`
- ✅ `DB_DATABASE`: `tvet_db_ql71`
- ✅ `DB_USERNAME`: `tvet_user`
- ✅ `DB_PASSWORD`: `wKvx736mFmNEhIIGkSl1osyPj8GkQMpX`
- ✅ `CACHE_DRIVER`: `file`
- ✅ `SESSION_DRIVER`: `file`
- ✅ `QUEUE_CONNECTION`: `sync`
- ✅ `LOG_CHANNEL`: `stderr`
- ✅ `LOG_LEVEL`: `error`

### 4. New Features Deployed
- ✅ PWA support (manifest.json, service worker)
- ✅ Contact Us page
- ✅ Partner logos and images
- ✅ Notification system
- ✅ PreventCaching middleware
- ✅ Enhanced UI/UX improvements

## 🚀 Deployment Steps

### Step 1: Update Render Environment Variables
1. Go to Render Dashboard → `tvetSystem` service
2. Click "Settings" → "Environment"
3. Add/Update these variables:
   - `APP_NAME` → `AceTVET`
   - `APP_DEBUG` → `false`
4. Click "Save Changes"

### Step 2: Deploy
1. Go to `tvetSystem` service main page
2. Click "Manual Deploy" → "Clear build cache & deploy"
3. Wait for deployment (5-10 minutes)

### Step 3: Monitor Logs
Watch for these log messages:
- ✅ "Starting Laravel application..."
- ✅ "Database connection set to PostgreSQL"
- ✅ "Database configuration:" (with actual values)
- ✅ "Application key generated"
- ✅ "Packages discovered"
- ✅ "Storage linked"
- ✅ "Running migrations..."
- ✅ "Migrations completed"
- ✅ "Running database seeders..."
- ✅ "Database seeding completed"
- ✅ "Caching completed"
- ✅ "Starting server on port 8080..."

### Step 4: Verify Deployment
1. Visit: https://tvetsystem.onrender.com
2. Check:
   - ✅ Browser tab shows "AceTVET"
   - ✅ Page loads without errors
   - ✅ Navigation works
   - ✅ Courses display correctly
   - ✅ Contact Us page works
   - ✅ PWA install prompt appears (on mobile)

## ⚠️ Potential Issues & Solutions

### Issue: Database migration fails
**Solution:** Check logs for specific error. The new migrations are safe and should run without issues.

### Issue: PWA doesn't work
**Solution:** PWA requires HTTPS (which Render provides). Clear browser cache and reload.

### Issue: Images not loading
**Solution:** Check if `storage:link` ran successfully in logs.

### Issue: 500 error
**Solution:** Temporarily set `APP_DEBUG=true` in Render to see error details, then fix and set back to `false`.

## 📊 Post-Deployment Verification

### Database Verification
Using DBeaver, run:
```sql
-- Check if tables renamed correctly
SELECT table_name FROM information_schema.tables
WHERE table_schema = 'public'
ORDER BY table_name;

-- Should see: acetvet_applications (not up_tvet_applications)
-- Should NOT see: applications (dropped)

-- Check seeders ran
SELECT COUNT(*) FROM categories;
SELECT COUNT(*) FROM courses;
SELECT COUNT(*) FROM news;
```

### UI Verification
- ✅ Logo displays correctly
- ✅ Partner images load
- ✅ Course details page responsive on mobile
- ✅ Contact form works
- ✅ Dashboard statistics display

## 🎉 Success Criteria

Deployment is successful when:
- ✅ Website loads without errors
- ✅ All database migrations completed
- ✅ No duplicate data (seeders use firstOrCreate)
- ✅ Browser tab shows "AceTVET"
- ✅ New features (PWA, Contact Us) work
- ✅ Debug mode is disabled (APP_DEBUG=false)

## 📝 Notes

- The cleanup migration will remove duplicate data from existing tables
- Seeders now use `firstOrCreate()` to prevent future duplicates
- Session files are excluded from git (via .gitignore)
- PWA files are included and will work automatically
- All images and assets are included in the Docker build
