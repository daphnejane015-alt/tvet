# Database Import Guide

## Option 1: Export from Local and Import to Render

### Step 1: Export Local Database

1. **Using Laravel:**
   ```bash
   php artisan db:dump
   ```
   This creates a SQL dump file in `storage/app/database-backup.sql`

2. **Or using MySQL directly:**
   ```bash
   mysqldump -u root -p laravel > local_database.sql
   ```

### Step 2: Convert to PostgreSQL (if needed)

Since Render uses PostgreSQL and your local is MySQL, you need to convert:

1. **Install conversion tool:**
   ```bash
   npm install -g pgloader
   ```

2. **Convert the dump:**
   ```bash
   pgloader mysql://root:password@localhost/laravel postgresql://user:password@host:port/database
   ```

3. **Or use online converter:**
   - https://www.convert-in.com/convsql.htm
   - Convert MySQL dump to PostgreSQL format

### Step 3: Import to Render

**Option A: Using Render Dashboard**

1. Go to your PostgreSQL database in Render
2. Click "Connect" tab
3. Copy the "External Connection" URL
4. Use psql or pgAdmin to connect and import:
   ```bash
   psql "postgresql://tvet_user:password@dpg-dbg09ol9el5s73bget5g-a/tvet_db_ql71" < database.sql
   ```

**Option B: Using SSH Tunnel**

1. Set up SSH tunnel to Render database
2. Import using psql client

**Option C: Using Render's Shell**

1. Go to your web service in Render
2. Click "Shell" button
3. Run:
   ```bash
   psql $DATABASE_URL < database.sql
   ```

## Option 2: Copy Uploaded Files

If you have user-uploaded files in `storage/app`:

### Using SCP or SFTP

```bash
# Copy from local to Render (requires SSH access)
scp -r storage/app/* user@render-server:/var/www/html/storage/app/
```

### Or Upload via Render Dashboard

1. Download files from local storage
2. Upload to Render service's storage using file manager or Git

## Option 3: Use Seeders (Simplest for Initial Data)

This is already configured. The seeders will populate:
- Categories
- Courses
- Admin user
- News items with images

Run seeding:
```bash
php artisan db:seed
```

Or it runs automatically on deployment (configured in start.sh).

## Recommended Approach

For a new deployment:

1. **Use seeders** for initial structure data (categories, courses, admin user)
2. **Manually add news/articles** through the admin panel in production
3. **For user uploads**, set up cloud storage (S3, R2, etc.) instead of local storage

## For User-Uploaded Images in Production

Local storage (`storage/app`) is not ideal for production. Consider:

1. **Cloud Storage (Recommended):**
   - AWS S3
   - Cloudflare R2 (free tier)
   - DigitalOcean Spaces

2. **Configure in Laravel:**
   ```env
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=your_key
   AWS_SECRET_ACCESS_KEY=your_secret
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=your-bucket
   ```

3. **Update filesytems.php config** to use S3
