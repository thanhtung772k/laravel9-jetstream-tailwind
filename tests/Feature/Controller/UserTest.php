<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\Department;
use App\Models\Position;
use Mockery;
use Mockery\MockInterface;

class UserTest extends TestCase
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
        $this->user = User::factory()->create(['is_admin'=> 1]);
        // Create role
        $arr = ['Developer', 'Tester'];
        foreach ($arr as $key => $value) {
            Role::factory()->count(1)->create(['name' => $value]);
        }
        // Create Department
        $arr1 = ['D1', 'D2' , 'QA1', 'QA2'];
        foreach ($arr1 as $key => $value) {
            Department::factory()->count(1)->create(['name' => $value]);
        }
        //Create Position
        $arr2 = ['Member', 'Manager', 'COO'];
        foreach ($arr2 as $key => $value) {
            Position::factory()->count(1)->create(['name' => $value]);
        }
    }

    public function test_index_user() 
    {
        $this->actingAs($this->user);

        $response = $this->get('/management-user-index');

        $response->assertStatus(200);
    }

    public function test_get_create_user() 
    {
        $this->actingAs($this->user);

        $response = $this->get('/management-user-create');

        $response->assertStatus(200);
    }

    public function test_post_create_user_to_try() 
    {
        $local_file = __DIR__ . '/test-files/test_image.jpg';
    
        $uploadedFile = new \Symfony\Component\HttpFoundation\File\UploadedFile(
            $local_file,
            'test_image.jpg',
            'image/jpeg',
            null,
            true
        );
        $params = [
            "user_id" => "009",
            "email" => "tungdore@gmail.com",
            "name" => "Nguyen Van User123",
            "date_of_birth" => "2000-07-07",
            "homeTown" => null,
            "currentResidence" => null,
            "university" => null,
            "workForm" => "1",
            "time_start" => "2022-11-07",
            "member_comp" => "1",
            "position" => "1",
            "dept" => "1",
            "location" => "1",
            "japanese" => null,
            "gender" => "0",
            "nationality" => null,
            "ethnic" => null,
            "phone" => "0123456789",
            "relativePhone" => null,
            "passport" => "123456789",
            "dateRange" => null,
            "placeOfIssue" => null,
            "visa" => null,
            "duration" => null,
            "linkFB" => null,
            "evidence_image" => $uploadedFile
        ];
        
        $this->actingAs($this->user);
        
        $response = $this->post('/management-user-create', $params);

        $response->assertStatus(302);
    }

    public function test_post_create_user_to_catch() 
    {    
        $uploadedFile = [1,2,3,4,5];
        $params = [
            "user_id" => "009",
            "email" => "tungdore@gmail.com",
            "name" => "Nguyen Van User123",
            "date_of_birth" => "2000-07-07",
            "homeTown" => null,
            "currentResidence" => null,
            "university" => null,
            "workForm" => "1",
            "time_start" => "2022-11-07",
            "member_comp" => "1",
            "position" => "1",
            "dept" => "1",
            "location" => "1",
            "japanese" => null,
            "gender" => "0",
            "nationality" => null,
            "ethnic" => null,
            "phone" => "0123456789",
            "relativePhone" => null,
            "passport" => "123456789",
            "dateRange" => null,
            "placeOfIssue" => null,
            "visa" => null,
            "duration" => null,
            "linkFB" => null,
            "evidence_image" => []
        ];
        
        $this->actingAs($this->user);
        
        $response = $this->post('/management-user-create', $params);

        $response->assertStatus(302);
    }

    public function test_get_edit_user() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
        });

        $user = User::latest()->first();

        $this->actingAs($this->user);

        $response = $this->get("/management-user-edit/$user->id");

        $response->assertStatus(200);
    }

    public function test_get_detail_user() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
        });

        $user = User::latest()->first();

        $this->actingAs($this->user);

        $response = $this->get("/management-user-detail/$user->id");

        $response->assertStatus(200);
    }

    public function test_get_leave_user() 
    {
        $this->actingAs($this->user);

        $response = $this->get("/management-user-leave");

        $response->assertStatus(200);
    }

    public function test_delete_user_to_try() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
        });

        $user = User::latest()->first();

        $this->actingAs($this->user);

        $response = $this->get("/management-user-delete/$user->id");

        $response->assertStatus(302);
    }

    public function test_delete_user_to_catch() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
        });

        $user = User::latest()->first();

        $id = 'abc';

        $this->mock(\App\Repositories\UserDetail\UserDetailRepositoryEloquent::class)
            ->shouldReceive('delete')->with($id);

        $this->actingAs($this->user);

        $response = $this->get(route('delete_user', $user->id));

        $response->assertStatus(302);
    }

    public function test_post_update_user_to_try() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id, 'avatar' => '1674669173.jpg']);
        });

        $user = User::latest()->first();

        $userDetail = UserDetail::latest()->first();

        $params = [
            "name" => "Nguyen Van User123",
            "date_of_birth" => "2000-07-07",
            "homeTown" => null,
            "currentResidence" => null,
            "university" => null,
            "workForm" => "1",
            "time_start" => "2022-11-07",
            "member_comp" => "1",
            "position" => "1",
            "dept" => "1",
            "location" => "1",
            "japanese" => null,
            "old_evidence_image" => $userDetail->avatar,
            "gender" => "0",
            "nationality" => null,
            "ethnic" => null,
            "phone" => "0123456789",
            "relativePhone" => null,
            "passport" => "123456789",
            "dateRange" => null,
            "placeOfIssue" => null,
            "visa" => null,
            "duration" => null,
            "linkFB" => null
        ];

        $this->actingAs($this->user);

        $response = $this->post(route('update_user', $user->id), $params);

        $response->assertStatus(302);
    }

    public function test_post_update_user_to_catch() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id, 'avatar' => '1674669173.jpg']);
        });

        $user = User::latest()->first();

        $userDetail = UserDetail::latest()->first();

        $params = [
            "name" => "Nguyen Van User123",
            "date_of_birth" => "2000-07-07",
            "homeTown" => null,
            "currentResidence" => null,
            "university" => null,
            "workForm" => "1",
            "time_start" => "2022-11-07",
            "member_comp" => "1",
            "position" => "1",
            "dept" => "1",
            "location" => "1",
            "japanese" => null,
            "old_evidence_image" => $userDetail->avatar,
            "gender" => "0",
            "nationality" => null,
            "ethnic" => null,
            "phone" => "0123456789",
            "relativePhone" => null,
            "passport" => "123456789",
            "dateRange" => null,
            "placeOfIssue" => null,
            "visa" => null,
            "duration" => null,
            "linkFB" => null
        ];

        $id = 'abc';

        $this->mock(\App\Services\UserDetail\UserDetailService::class)
            ->shouldReceive('update')->with($params, $id);

        $this->actingAs($this->user);

        $response = $this->post(route('update_user', $user->id), $params);

        $response->assertStatus(302);
    }
}
