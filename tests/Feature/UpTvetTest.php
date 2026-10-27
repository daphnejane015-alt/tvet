<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UpTvetApplication;
use App\Mail\UpTvetUserConfirmationMail;
use App\Mail\UpTvetAdminNotificationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UpTvetTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_check_up_tvet_status(): void
    {
        $response = $this->getJson(route('up-tvet.status'));

        $response->assertStatus(200)
            ->assertJson([
                'authenticated' => false,
                'completed' => false,
                'google_form_url' => 'https://forms.gle/hk3YdAxCM1PbhnyD7',
            ]);
    }

    public function test_authenticated_user_status_not_completed(): void
    {
        $user = User::factory()->create([
            'role' => 'student',
        ]);

        $response = $this->actingAs($user)->getJson(route('up-tvet.status'));

        $response->assertStatus(200)
            ->assertJson([
                'authenticated' => true,
                'completed' => false,
            ]);
    }

    public function test_user_can_confirm_up_tvet_google_form_completion(): void
    {
        Mail::fake();

        $admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@tvet.test',
            'role' => 'admin',
        ]);

        $user = User::factory()->create([
            'name' => 'Ahmad Pelajar',
            'email' => 'ahmad@example.com',
            'role' => 'student',
        ]);

        $response = $this->actingAs($user)->post(route('up-tvet.confirm'), [
            'ic_number' => '020512015522',
            'phone_number' => '0123456789',
            'notes' => 'Telah selesai mengisi borang google form.',
        ]);

        $response->assertSessionHas('up_tvet_success');

        $this->assertDatabaseHas('up_tvet_applications', [
            'user_id' => $user->id,
            'full_name' => 'Ahmad Pelajar',
            'email' => 'ahmad@example.com',
            'ic_number' => '020512015522',
            'phone_number' => '0123456789',
            'status' => 'completed',
        ]);

        // Verify emails were sent
        Mail::assertSent(UpTvetUserConfirmationMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        Mail::assertSent(UpTvetAdminNotificationMail::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });
    }

    public function test_user_cannot_confirm_twice(): void
    {
        Mail::fake();

        $user = User::factory()->create(['role' => 'student']);

        UpTvetApplication::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($user)->post(route('up-tvet.confirm'), [
            'phone_number' => '0199999999',
        ]);

        $response->assertSessionHas('info');
    }

    public function test_admin_can_view_up_tvet_table_and_update_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create(['role' => 'student']);

        $application = UpTvetApplication::create([
            'user_id' => $student->id,
            'full_name' => $student->name,
            'email' => $student->email,
            'ic_number' => '010101010101',
            'phone_number' => '0111111111',
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.up-tvet.index'));
        $response->assertStatus(200);
        $response->assertSee($student->name);
        $response->assertSee($student->email);
        $response->assertSee('https://forms.gle/hk3YdAxCM1PbhnyD7');

        // Admin updates status
        $updateResponse = $this->actingAs($admin)->patch(route('admin.up-tvet.update-status', $application), [
            'status' => 'verified',
            'notes' => 'Dokumen telah disahkan.',
        ]);

        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('up_tvet_applications', [
            'id' => $application->id,
            'status' => 'verified',
            'notes' => 'Dokumen telah disahkan.',
        ]);
    }

    public function test_non_admin_cannot_access_admin_up_tvet(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($student)->get(route('admin.up-tvet.index'));
        $response->assertStatus(403);
    }
}
