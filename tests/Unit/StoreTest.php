<?php

namespace Tests\Unit;


use App\Models\User;
use Tests\TestCase;


class StoreTest extends TestCase
{

    public function test_example()
    {
        $response = $this->get('/main');
        $response->assertOk();
    }

    public function test_auth_user()
    {
        $this->post('/login', [
            'email' => 'user2@user',
            'password' => '123456789',
        ]);
        $response = $this->get('/main/cart');
        $response->assertOk();
    }

    public function test_guest_user()
    {
        $this->post('/login', [
            'email' => 'dfedf@usr',
            'password' => '123456789',
        ]);
        $response = $this->get('/main/cart');
        $response->assertStatus(302);
    }

    public function test_not_admin_role()
    {
        $this->post('/login', [
            'email' => 'user2@user',
            'password' => '123456789',
        ]);
        $response = $this->get('/admin');
        $response->assertForbidden();
    }

    public function test_clear_cart()
    {
        $response = $this->get('/cart/clear');
        $response->assertNotFound();
    }

    public function test_wrong_register_validate()
    {
        $response = $this->post('/register', [
            'name' => 'some name',
            'surname' => 'some surname',
            'address' => 'addres.25',
            'phone' => '0502525454',
            'email' => '1415',
            'password' => '123456789',
        ]);
        $response->assertStatus(302);
    }

}
