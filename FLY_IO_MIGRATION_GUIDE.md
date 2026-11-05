# Fly.io Migration Guide for AceTVET

This guide will help you migrate your Laravel application from Render to Fly.io.

## Why Fly.io?

- ✅ Free tier with generous limits (3 apps, 256MB RAM each)
- ✅ **Email sending works** (no SMTP blocking)
- ✅ PostgreSQL database included
- ✅ Global edge network
- ✅ Docker-based deployment (compatible with your current setup)

## Prerequisites

1. Fly.io account (free)
2. Fly CLI installed
3. Git repository with your code

## Step-by-Step Migration

### Step 1: Install Fly CLI

**Windows (PowerShell as Administrator):**
```powershell
pwsh -ExecutionPolicy Bypass -c "iwr https://fly.io/install.ps1 -useb | iex"
```

**Verify installation:**
```bash
flyctl version
```

### Step 2: Login to Fly.io

```bash
flyctl auth login
```

This will open your browser to authenticate with GitHub.

### Step 3: Navigate to Your Project

```bash
cd C:\Laragon\laragon\www\tvetSystem
```

### Step 4: Create Fly.io App

```bash
flyctl launch
```

When prompted:
- **App Name:** `tvet-system` (or press Enter for default)
- **Region:** `sin` (Singapore - closest to Malaysia)
- **Dockerfile:** Select the existing Dockerfile
- **PostgreSQL:** Say "No" (we'll add it separately)

### Step 5: Add PostgreSQL Database

```bash
flyctl postgres create
```

When prompted:
- **Name:** `tvet-db` (or press Enter for default)
- **Region:** `sin` (same as your app)
- **VM Size:** `Shared CPU - 1x - 256MB` (free tier)
- **Volume Size:** `1GB` (free tier)

Fly.io will create a PostgreSQL database and provide connection details.

### Step 6: Attach Database to App

```bash
flyctl postgres attach --app tvet-system
```

This will automatically set the `DATABASE_URL` environment variable.

### Step 7: Configure Environment Variables

```bash
flyctl secrets set APP_KEY=$(php artisan key:generate --show)
```

Set additional environment variables:

```bash
flyctl secrets set APP_NAME=AceTVET
flyctl secrets set APP_DEBUG=false
flyctl secrets set APP_URL=https://tvet-system.fly.dev
flyctl secrets set LOG_LEVEL=error
```

### Step 8: Configure Email (Optional but Recommended)

**Using Gmail:**
```bash
flyctl secrets set MAIL_MAILER=smtp
flyctl secrets set MAIL_HOST=smtp.gmail.com
flyctl secrets set MAIL_PORT=587
flyctl secrets set MAIL_USERNAME=your-email@gmail.com
flyctl secrets set MAIL_PASSWORD=your-app-password
flyctl secrets set MAIL_ENCRYPTION=tls
flyctl secrets set MAIL_FROM_ADDRESS=your-email@gmail.com
flyctl secrets set MAIL_FROM_NAME=AceTVET
```

**Using Resend (Free tier - 3000 emails/month):**
```bash
flyctl secrets set MAIL_MAILER=resend
flyctl secrets set MAIL_RESEND_API_KEY=your-resend-api-key
```

### Step 9: Deploy Your App

```bash
flyctl deploy
```

This will:
- Build your Docker image
- Push to Fly.io registry
- Deploy to the Singapore region
- Run migrations and seeders

### Step 10: Check Deployment Status

```bash
flyctl status
```

### Step 11: View Logs

```bash
flyctl logs
```

### Step 12: Open Your App

```bash
flyctl open
```

This will open https://tvet-system.fly.dev in your browser.

## Re-enable Email Verification

Since Fly.io supports email, let's re-enable it:

### Step 1: Update User Model

Edit `app/Models/User.php`:
```php
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
```

### Step 2: Update RegisteredUserController

Edit `app/Http/Controllers/Auth/RegisteredUserController.php`:
```php
$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => 'student',
    // Remove: 'email_verified_at' => now(),
]);

event(new Registered($user));

// Add back: $user->sendEmailVerificationNotification();

return redirect()->route('login')
    ->with('status', 'Pendaftaran berjaya! Sila semak emel anda untuk pautan pengesahan.');
```

### Step 3: Re-enable Verification Routes

Edit `routes/auth.php`:
```php
Route::middleware(['auth', 'prevent.caching'])->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // ... other routes
});

Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['throttle:6,1', 'prevent.caching'])
            ->name('verification.verify');
```

### Step 4: Update Profile Form

Edit `resources/views/profile/partials/update-profile-information-form.blade.php`:
```php
<p class="mt-1 text-sm text-gray-500">
    Kemaskini maklumat akaun dan alamat emel anda.
</p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <!-- ... form fields ... -->

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div>
            <p class="text-sm mt-2 text-gray-800">
                Alamat emel anda belum disahkan.

                <button form="send-verification" class="underline text-sm text-theme-purple hover:text-theme-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-theme-accent">
                    Klik di sini untuk hantar semula emel pengesahan.
                </button>
            </p>

            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    Pautan pengesahan baharu telah dihantar ke alamat emel anda.
                </p>
            @endif
        </div>
    @endif
</form>
```

### Step 5: Re-enable Password Reset

Edit `app/Http/Controllers/Auth/PasswordResetLinkController.php`:
```php
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
}
```

### Step 6: Deploy Changes

```bash
git add .
git commit -m "Re-enable email verification for Fly.io"
git push
flyctl deploy
```

## Managing Your Fly.io App

### View Logs
```bash
flyctl logs
```

### SSH into App
```bash
flyctl ssh console
```

### Scale Up (if needed)
```bash
flyctl scale count 2
```

### View Database
```bash
flyctl postgres connect
```

### Restart App
```bash
flyctl apps restart
```

## Troubleshooting

### Database Connection Issues

Check your database environment variables:
```bash
flyctl secrets list
```

The `DATABASE_URL` should be set automatically by Fly.io.

### Email Not Sending

1. Check logs for email errors:
   ```bash
   flyctl logs
   ```

2. Verify SMTP credentials:
   ```bash
   flyctl secrets list
   ```

3. Test email manually:
   ```bash
   flyctl ssh console
   php artisan tinker
   Mail::raw('Test email', function($message) {
       $message->to('your-email@example.com')->subject('Test');
   });
   ```

### App Not Starting

Check the startup logs:
```bash
flyctl logs
```

Look for errors in the startup script.

## Cost Comparison

| Feature | Render (Free) | Fly.io (Free) |
|---------|---------------|---------------|
| Apps | 1 unlimited | 3 (256MB each) |
| Database | 1 PostgreSQL | 1 PostgreSQL (1GB) |
| Email | ❌ Blocked | ✅ Works |
| Bandwidth | 100GB/month | 160GB/outbound |
| Build minutes | 750/month | Unlimited |

## Migration Checklist

- [ ] Install Fly CLI
- [ ] Login to Fly.io
- [ ] Create Fly.io app
- [ ] Create PostgreSQL database
- [ ] Attach database to app
- [ ] Set environment variables
- [ ] Configure email (Gmail or Resend)
- [ ] Deploy app
- [ ] Test registration
- [ ] Test email verification
- [ ] Test password reset
- [ ] Re-enable email verification in code
- [ ] Deploy email verification changes
- [ ] Delete Render app (after confirming Fly.io works)

## After Migration

Once you've confirmed everything works on Fly.io:

1. **Update your domain DNS** (if using custom domain)
2. **Delete Render app** to avoid charges
3. **Update any hardcoded URLs** in your code
4. **Monitor free tier usage**:
   ```bash
   flyctl orgs personal
   ```

## Support

- Fly.io Docs: https://fly.io/docs/
- Fly.io Community: https://community.fly.io/
- Laravel on Fly.io: https://fly.io/docs/laravel/the_basics/

Good luck with your migration! 🚀
