<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class TimesheetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index_timesheet()
    {
        $this->actingAs($this->user);

        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function test_check_in_timesheet()
    {
        $user = $this->user;
        $this->mock(\App\Services\Timesheet\TimesheetService::class) 
            ->shouldReceive('checkIndateTimesheet')->with("2023-01-24", "07:03:32", $user->id);

        $this->actingAs($this->user);

        $response = $this->post('/home-checkin');

        $response->assertRedirect('/home');
    }
}
