<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    /** @test */
    public function it_validates_required_fields()
    {
        $validator = Validator::make([], [
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
            'birthdate' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(8, $validator->errors()->count()); // Adjust the count based on actual validation rules
    }

    /** @test */
    public function it_validates_name_field()
    {
        $validator = Validator::make(['name' => ''], [
            'name' => 'required|string|max:255',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('name'));
    }

    /** @test */
    public function it_validates_user_name_field()
    {
        $validator = Validator::make(['user_name' => ''], [
            'user_name' => 'required|string|max:255|unique:data,user_name',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('user_name'));

        
    }

    /** @test */
    public function it_validates_email_format()
    {
        $validator = Validator::make(['email' => 'invalidemail'], [
            'email' => 'required|email',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('email'));
    }

    /** @test */
    public function it_validates_password_length()
    {
        $validator = Validator::make(['password' => 'short'], [
            'password' => 'required|min:8',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('password'));
    }

    /** @test */
    public function it_validates_confirm_password_match()
    {
        $validator = Validator::make(['password' => 'password', 'confirmPassword' => 'differentpassword'], [
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('confirmPassword'));
    }

    /** @test */
    public function it_validates_birthdate_format()
    {
        $validator = Validator::make(['birthdate' => 'string'], [
            'birthdate' => 'required|date',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('birthdate'));
    }

    /** @test */
    public function it_allows_optional_user_image()
    {
        $validator = Validator::make([], [
            'user_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            
        ]);

        $this->assertFalse($validator->fails());
    }
    /** @test */
    public function it_validates_phone_field()
    {
        $validator = Validator::make(['phone' => ''], [
            'phone' => 'required|string|max:20',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('phone'));
    }

    /** @test */
    public function it_validates_address_field()
    {
        $validator = Validator::make(['address' => ''], [
            'address' => 'required|string|max:255',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(1, $validator->errors()->count());
        $this->assertTrue($validator->errors()->has('address'));
    }
}
