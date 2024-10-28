<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que un usuario puede acceder al índice de usuarios si es admin.
     */
    public function test_index_admin_access()
{
    // Crear un usuario admin
    $admin = User::factory()->create([
        'rol' => 'admin',
        'is_approved' => true,
    ]);

    // Hacer login como admin
    $response = $this->actingAs($admin)->get(route('usuarios.index'));

    // Afirmar que la respuesta fue exitosa
    $response->assertStatus(200);

    // Afirmar que se carga la vista correcta
    $response->assertViewIs('usuario.index');
}

    /**
     * Test para verificar que un usuario no admin no puede acceder al índice de usuarios.
     */
    public function test_index_non_admin_access_denied()
    {
        // Crear un usuario no admin
        $user = User::factory()->create(['rol' => 'postulante', 'is_approved' => true]);

        // Hacer login como usuario no admin
        $response = $this->actingAs($user)->get(route('usuarios.index'));

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error', 'Acceso denegado.');
    }

    /**
     * Test para crear un nuevo usuario.
     */
    public function test_store_user()
    {
        // Crear un usuario admin
        $admin = User::factory()->create(['rol' => 'admin', 'is_approved' => true]);

        // Hacer login como admin
        $this->actingAs($admin);

        // Realizar una solicitud para crear un nuevo usuario
        $response = $this->post(route('usuarios.store'), [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@usuario.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'rol' => 'postulante',
            'dni' => '12345678',
            'ruc' => '12345678912',
            'correo' => 'correo@usuario.com',
            'celular' => '987654321',
        ]);

        // Verificar que el usuario fue creado y redirigir
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@usuario.com',
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success', 'Usuario creado exitosamente.');
    }

    /**
     * Test para actualizar un usuario.
     */
    public function test_update_user()
    {
        // Crear un usuario admin
        $admin = User::factory()->create(['rol' => 'admin', 'is_approved' => true]);
        $user = User::factory()->create(['rol' => 'postulante']);

        // Hacer login como admin
        $this->actingAs($admin);

        // Realizar una solicitud para actualizar el usuario
        $response = $this->patch(route('usuarios.update', $user->id), [
            'name' => 'Usuario Actualizado',
            'email' => 'usuario@actualizado.com',
            'rol' => 'supervisor',
        ]);

        // Verificar que el usuario fue actualizado
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Usuario Actualizado',
            'email' => 'usuario@actualizado.com',
            'rol' => 'supervisor',
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Test para eliminar un usuario.
     */
    public function test_destroy_user()
    {
        // Crear un usuario admin
        $admin = User::factory()->create(['rol' => 'admin', 'is_approved' => true]);
        $user = User::factory()->create(['rol' => 'postulante']);

        // Hacer login como admin
        $this->actingAs($admin);

        // Realizar una solicitud para eliminar el usuario
        $response = $this->delete(route('usuarios.destroy', $user->id));

        // Verificar que el usuario fue eliminado
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Test para aprobar un usuario.
     */
    public function test_approve_user()
    {
        // Crear un usuario admin
        $admin = User::factory()->create(['rol' => 'admin', 'is_approved' => true]);
        
        // Crear un usuario que será aprobado
        $user = User::factory()->create(['is_approved' => false]);

        // Hacer login como admin
        $this->actingAs($admin);

        // Realizar una solicitud para aprobar el usuario
        $response = $this->patch(route('usuarios.approve', $user->id));

        // Refrescar el modelo para obtener el estado actualizado
        $user = User::find($user->id); // Cargar nuevamente desde la BD
        $this->assertTrue((bool) $user->is_approved, 'El usuario no fue aprobado correctamente'); // Verificar que is_approved sea true

        $response->assertRedirect(route('usuarios.pending'));
        $response->assertSessionHas('success', 'Usuario aprobado exitosamente.');
    }

    


    /**
     * Test para ver los detalles de un usuario.
     */
    public function show($id)
    {
        $usuario = User::find($id);
    
        if (!$usuario) {
            abort(404);
        }
    
        return view('usuario.show', compact('usuario'));
    }
    
}
