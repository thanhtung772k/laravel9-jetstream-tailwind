<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\UserHasProject;
use Tests\TestCase;
use App\Repositories\Project\ProjectRepositoryEloquent;
use Mockery;
use Mockery\MockInterface;

class ProjectTest extends TestCase
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
        $arr = ['Developer', 'Tester'];
        foreach ($arr as $key => $value) {
            Role::factory()->count(1)->create(['name' => $value]);
        }
    }

    public function test_index_project()
    {
        $this->actingAs($this->user);

        $response = $this->get('/additional-project-list');

        $response->assertStatus(200);
    }

    public function test_get_insert_project()
    {
        $this->actingAs($this->user);

        $response = $this->get('/additional-project-create');

        $response->assertStatus(200);
    }

    public function test_post_create_project_to_catch()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        $this->actingAs($this->user);

        $response = $this->post('/additional-project-add', $params);

        $response->assertStatus(500);
    }

    public function test_post_create_project_to_try()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        // Mockery::mock(\App\Services\Timesheet\ProjectController::class)
        //     ->shouldReceive('create')->with($params);

        $this->actingAs($this->user);

        $response = $this->post('/additional-project-add', $params);

        $response->assertStatus(302);
    }

    public function test_get_edit_project()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }

        $this->actingAs($this->user);

        $response = $this->get("/additional-project-edit/$project->id");

        $response->assertStatus(200);
    }

    public function test_post_edit_project_to_try()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }

        $updateParams = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "900",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain - done",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        $this->actingAs($this->user);

        $response = $this->post("/additional-project-update/$project->id", $updateParams);

        $response->assertStatus(302);
    }

    public function test_post_edit_project_to_catch()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }

        $updateParams = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "900",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain - done",
            "user_id" => [
                0 => "2"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];


        $this->mock(ProjectRepositoryEloquent::class, function(MockInterface $mock) {
            $id = [1,2,3,4];
            $updateParams = [
                "project_name" => "LapoIT",
                "customer" => "EPU software",
                "projectType" => "1",
                "value_contract" => "900",
                "department" => "1",
                "start_date_project" => "2022-08-29",
                "end_date_project" => "2023-04-07",
                "statusProject" => "1",
                "description" => "project maintain - done",
                "user_id" => [
                    0 => "2"
                ],
                "locationID" => [
                    0 => "1"
                ],
                "start_date_user" => [
                    0 => "2022-10-04"
                ],
                "end_date_user" => [
                    0 => "2023-01-20"
                ],
                "effort" => [
                    0 => "100"
                ],
                "user_has_id_old" => [
                    0 => null
                ]
            ];
            $mock->shouldReceive('updateProject')->with($updateParams, $id);
        });

        $this->actingAs($this->user);

        $response = $this->post("/additional-project-update/$project->id", $updateParams);

        $response->assertStatus(302);
    }

    public function test_get_detail_project()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "1"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }
        
        $this->actingAs($this->user);
        
        $response = $this->get("/additional-project-detail/$project->id");

        $response->assertStatus(500);
    }

    public function test_get_chart_project()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "1"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }
        
        $this->actingAs($this->user);
        
        $response = $this->get("/management-user-chart");

        $response->assertStatus(200);
    }

    public function test_delete_project_to_try()
    {
        $params = [
            "project_name" => "LapoIT",
            "customer" => "EPU software",
            "projectType" => "1",
            "value_contract" => "1000",
            "department" => "1",
            "start_date_project" => "2022-08-29",
            "end_date_project" => "2023-04-07",
            "statusProject" => "1",
            "description" => "project maintain",
            "user_id" => [
                0 => "1"
            ],
            "locationID" => [
                0 => "1"
            ],
            "start_date_user" => [
                0 => "2022-10-04"
            ],
            "end_date_user" => [
                0 => "2023-01-20"
            ],
            "effort" => [
                0 => "100"
            ],
            "user_has_id_old" => [
                0 => null
            ]
        ];

        Project::create([
            'name' => $params['project_name'],
            'customer' => $params['customer'],
            'project_type_id' => $params['projectType'],
            'department_id' => $params['department'],
            'value_contract' => $params['value_contract'],
            'start_date' => $params['start_date_project'],
            'end_date' => $params['end_date_project'],
            'status' => $params['statusProject'],
            'description' => $params['description'],
        ]);
        $project = Project::latest()->first();

        foreach ($params['user_id'] as $key => $value) {
            UserHasProject::create([
                'user_id' => $params['user_id'][$key],
                'project_id' => $project->id,
                'role_id' => $params['locationID'][$key],
                'start_date' => $params['start_date_user'][$key],
                'end_date' => $params['end_date_user'][$key],
                'effort' => $params['effort'][$key]
            ]);
        }

        $paramRequests = [];

        $this->actingAs($this->user);
        
        $response = $this->get("/additional-project-delete/$project->id");

        $response->assertStatus(500);
    }
}
