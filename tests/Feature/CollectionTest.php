<?php

namespace Tests\Feature;

use App\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_collection_can_be_added()
    {
        $this->withoutExceptionHandling();
        $res = $this->post('/admin/collections', [
            'name' => 'iPhone',
            'user_id' => 1
        ]);
        $res->assertOk();
        $this->assertCount(1, Collection::all());
    }

    /** @test */
    public function user_id_required()
    {
        $this->withExceptionHandling();
        $res = $this->post('/admin/collections', [
            'name' => 'shuvo',
            'user_id' => null
        ]);
        $res->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function a_collection_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/admin/collections', [
            'name' => 'iPhone',
            'user_id' => 1
        ]);

        $c = Collection::first();
        $res = $this->patch('/admin/collections/' . $c->id, [
            'name' => 'sam',
            'user_id' => 1
        ]);

        $res->assertStatus(200);
    }
}
