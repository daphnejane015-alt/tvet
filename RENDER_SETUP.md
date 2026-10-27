# Render Deployment Setup

## Database Setup

The application requires a PostgreSQL database to function properly. Follow these steps to set it up in Render:

### 1. Create PostgreSQL Database

1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click "New +" → "PostgreSQL"
3. Configure the database:
   - **Name**: `tvet-db` (must match this exactly)
   - **Database Name**: `tvet_db`
   - **User**: `tvet_user`
   - **Plan**: Free
4. Click "Create Database"

### 2. Configure Database Environment Variables

Since automatic database linking may not work properly, configure the environment variables manually:

1. Go to your `tvetSystem` web service in Render
2. Click "Settings" → "Environment"
3. Add the following environment variables:

   - **DB_CONNECTION**: `pgsql`
   - **DB_HOST**: `dpg-dbg09ol9el5s73bget5g-a` (from your connection string)
   - **DB_PORT**: `5432`
   - **DB_DATABASE**: `tvet_db_ql71` (from your connection string)
   - **DB_USERNAME**: `tvet_user`
   - **DB_PASSWORD**: `wKvx736mFmNEhIIGkSl1osyPj8GkQMpX` (from your connection string)

4. Click "Save Changes"

### 3. Redeploy

After creating and linking the database:
1. Go to your `tvetSystem` web service
2. Click "Manual Deploy" → "Clear build cache & deploy"
3. Wait for deployment to complete

### 4. Verify

Once deployed, check the logs to see:
- "Database configuration set to PostgreSQL"
- Database credentials should be displayed
- "Migrations completed" message

If you see "Skipping migrations - database not configured", the database is not properly linked.

## Troubleshooting

### "Database credentials not fully set" error

This means the PostgreSQL database either:
- Doesn't exist in Render
- Isn't named `tvet-db`
- Isn't linked to the web service

Solution: Create the database with the correct name and ensure it's linked.

### Migration failures

If migrations fail:
1. Check the database credentials in environment variables
2. Verify the database exists and is accessible
3. Check the logs for specific error messages
