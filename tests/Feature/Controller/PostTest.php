<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\UserDetail;
use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
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

        $arr = ['Business', 'World', 'Design', 'Lifestyle'];
        foreach ($arr as $key => $value) {
            Category::factory()->count(1)->create(['name' => $value, 'slug' => Str::slug($value)]);
        }
    }

    public function test_index_post() 
    {
        $this->actingAs($this->user);

        $response = $this->get('/management-post-index');

        $response->assertStatus(200);
    }

    public function test_get_create_post() 
    {
        User::factory()->count(1)->create()->each(function ($user): void {
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
        });

        $this->actingAs($this->user);

        $response = $this->get(route('create_post'));

        $response->assertStatus(200);
    }

    public function test_get_edit_post() 
    {
        $this->actingAs($this->user);

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $response = $this->get(route('edit_post', $post->id));

        $response->assertStatus(200);
    }

    public function test_get_detail_post() 
    {
        $this->actingAs($this->user);

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $response = $this->get(route('detail_post', $post->id));

        $response->assertStatus(200);
    }

    public function test_delete_post_to_try() 
    {
        $this->actingAs($this->user);

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $response = $this->get(route('delete_post', $post->id));

        $response->assertStatus(302);
    }

    public function test_delete_post_to_catch() 
    {
        $this->actingAs($this->user);

        $id = 'abc';

        $this->mock(\App\Repositories\Post\PostRepositoryEloquent::class)
            ->shouldReceive('delete')->with($id);

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $response = $this->get(route('delete_post', $post->id));

        $response->assertStatus(500);
    }

    public function test_insert_post_to_try() 
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
            "title" => "Hello !!! Tu Hoang Kaido xuat hien",
            "slug" => "hello-tu-hoang-kaido-xuat-hien",
            "category" => "2",
            "toggleBtn" => "on",
            "author" => "Xin chào các bạn tôi là Shin_kun, hãy liên hệ với tôi qua fb: Nguyễn Tùng",
            "description" => "WOW",
            "content" => "<p>Xin chao tat ca moi nguoi</p><p><strong>Wow, lau qua roi ha moi nguoi</strong></p><blockquote><p>That dang buon va that vong</p></blockquote>",
            "evidence_image" => $uploadedFile
        ];

        $this->actingAs($this->user);

        $response = $this->post(route('insert_post'), $params);

        $response->assertStatus(302);
    }

    public function test_insert_post_to_catch() 
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
            "title" => "Hello !!! Tu Hoang Kaido xuat hien",
            "slug" => "hello-tu-hoang-kaido-xuat-hien",
            "category" => "2",
            "toggleBtn" => "on",
            "author" => "Xin chào các bạn tôi là Shin_kun, hãy liên hệ với tôi qua fb: Nguyễn Tùng",
            "description" => "WOW",
            "content" => "<p>Xin chao tat ca moi nguoi</p><p><strong>Wow, lau qua roi ha moi nguoi</strong></p><blockquote><p>That dang buon va that vong</p></blockquote>",
            "evidence_image" => []
        ];

        $this->actingAs($this->user);

        $response = $this->post(route('insert_post'), $params);

        $response->assertStatus(500);
    }

    public function test_update_post_to_try() 
    {
        $local_file = __DIR__ . '/test-files/test_image.jpg';
    
        $uploadedFile = new \Symfony\Component\HttpFoundation\File\UploadedFile(
            $local_file,
            'test_image.jpg',
            'image/jpeg',
            null,
            true
        );

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $params = [
            "title" => "Hello !!! Tu Hoang Kaido xuat hien",
            "slug" => "hello-tu-hoang-kaido-xuat-hien",
            "category" => "2",
            "toggleBtn" => "on",
            "old_evidence_image" => $post->image,
            "author" => "Xin chào các bạn tôi là Shin_kun, hãy liên hệ với tôi qua fb: Nguyễn Tùng",
            "description" => "WOW",
            "content" => "<p>Xin chao tat ca moi nguoi</p><p><strong>Wow, lau qua roi ha moi nguoi</strong></p><blockquote><p>That dang buon va that vong</p></blockquote>",
        ];

        $this->actingAs($this->user);


        $response = $this->post(route('update_post', $post->id), $params);

        $response->assertStatus(302);
    }

    public function test_update_post_to_catch() 
    {
        $local_file = __DIR__ . '/test-files/test_image.jpg';
    
        $uploadedFile = new \Symfony\Component\HttpFoundation\File\UploadedFile(
            $local_file,
            'test_image.jpg',
            'image/jpeg',
            null,
            true
        );

        $post = Post::factory()->create(['author_id' => $this->user->id, 'category_id'=>rand(1,2)]);

        $params = [
            "title" => "Hello !!! Tu Hoang Kaido xuat hien",
            "slug" => "hello-tu-hoang-kaido-xuat-hien",
            "category" => "2",
            "toggleBtn" => "on",
            "old_evidence_image" => $post->image,
            "author" => "Xin chào các bạn tôi là Shin_kun, hãy liên hệ với tôi qua fb: Nguyễn Tùng",
            "description" => "WOW",
            "content" => "<p>Xin chao tat ca moi nguoi</p><p><strong>Wow, lau qua roi ha moi nguoi</strong></p><blockquote><p>That dang buon va that vong</p></blockquote>",
        ];

        $id = 'abc';

        $this->actingAs($this->user);

        $this->mock(\App\Services\Post\PostService::class)
            ->shouldReceive('update')->with($params, $id);

        $response = $this->post(route('update_post', $post->id), $params);

        $response->assertStatus(500);
    }
}
