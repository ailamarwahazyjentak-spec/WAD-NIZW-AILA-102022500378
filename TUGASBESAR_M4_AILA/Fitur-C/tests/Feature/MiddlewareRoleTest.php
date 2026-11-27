<?php

namespace Tests\Feature;

use App\Models\Kurir;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareRoleTest extends TestCase
{
    use RefreshDatabase;

    private function akun(string $role): User
    {
        $user = User::factory()->create();
        $user->role = $role;
        $user->save();

        return $user;
    }

    private function kurir(): Kurir
    {
        return Kurir::create([
            'kode_kurir'   => 'JNE',
            'nama_kurir'   => 'JNE Express',
            'telepon'      => '0215550000',
            'status_aktif' => true,
        ]);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/kurir')->assertRedirect('/login');
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function test_user_login_tidak_bisa_membuka_form_login_lagi(): void
    {
        $this->actingAs($this->akun('user'))->get('/login')->assertRedirect('/kurir');
        $this->actingAs($this->akun('admin'))->get('/login')->assertRedirect('/admin/dashboard');
    }

    public function test_admin_bisa_mengakses_semua_rute(): void
    {
        $kurir = $this->kurir();
        $this->actingAs($this->akun('admin'));

        $this->get('/admin/dashboard')->assertOk();
        $this->get('/admin/kurir/create')->assertOk();
        $this->get("/admin/kurir/{$kurir->id}/edit")->assertOk();
        $this->get('/kurir')->assertOk();
        $this->get("/kurir/{$kurir->id}")->assertOk();
        $this->delete("/admin/kurir/{$kurir->id}")->assertRedirect('/kurir');
        $this->assertDatabaseMissing('kurir', ['id' => $kurir->id]);
    }

    public function test_user_biasa_hanya_bisa_melihat_katalog_dan_detail(): void
    {
        $kurir = $this->kurir();
        $this->actingAs($this->akun('user'));

        $this->get('/kurir')->assertOk();
        $this->get("/kurir/{$kurir->id}")->assertOk();
    }

    public function test_user_biasa_diblokir_403_di_rute_admin(): void
    {
        $kurir = $this->kurir();
        $this->actingAs($this->akun('user'));

        $this->get('/admin/dashboard')->assertForbidden();
        $this->get('/admin/kurir/create')->assertForbidden();
        $this->get("/admin/kurir/{$kurir->id}/edit")->assertForbidden();
        $this->delete("/admin/kurir/{$kurir->id}")->assertForbidden();
        $this->assertDatabaseHas('kurir', ['id' => $kurir->id]);
    }
}
