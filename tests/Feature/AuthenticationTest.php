<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexCompaniesWithoutLogin()
    {
        $response = $this->get('/companies');
        $response->assertRedirect('/login');
    }

    public function testIndexEmployeesWithoutLogin()
    {
        $response = $this->get('/employees');
        $response->assertRedirect('/login');
    }

    public function testCompanyCreatePageWithoutLogin()
    {
        $response = $this->get('/companies/create');
        $response->assertRedirect('/login');
    }

    public function testEmployeeCreatePageWithoutLogin()
    {
        $response = $this->get('/employees/create');
        $response->assertRedirect('/login');
    }

    public function testCreateCompanyWithoutLogin()
    {
        $response = $this->post('/companies');
        $response->assertRedirect('/login');
    }

    public function testCreateEmployeeWithoutLogin()
    {
        $response = $this->post('/employees');
        $response->assertRedirect('/login');
    }

    public function testGetEmployeeWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->get('/employees/'.$employee->id);
        $response->assertRedirect('/login');
    }

    public function testGetCompanyWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->get('/companies/'.$employee->company_id);
        $response->assertRedirect('/login');
    }

    public function testGetEmployeeEditPageWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->get('/employees/'.$employee->id.'/edit/');
        $response->assertRedirect('/login');
    }

    public function testGetCompanyEditPageWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->get('/companies/'.$employee->company_id.'/edit/');
        $response->assertRedirect('/login');
    }

    public function testEditEmployeeWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->patch('/employees/'.$employee->id.'/');
        $response->assertRedirect('/login');
    }

    public function testEditCompanyWithoutLogin()
    {
        $employee = factory(\App\Employee::class)->create();
        $response = $this->patch('/companies/'.$employee->company_id.'/');
        $response->assertRedirect('/login');
    }

    public function testLogin()
    {
        $user = factory(\App\User::class)->create();
        $data = [
            'email'=>$user->email,
            'password'=>'password'
        ];
        $response = $this->post('/login/', $data);
        $response->assertRedirect('/home');

    }

}
