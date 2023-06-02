<?php

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TicketApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testOpenTicketsList()
    {
        $response = $this->get('/api/tickets/open');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'subject',
                    'content',
                    'user' => [
                        'name',
                        'email',
                    ],
                ],
            ],
        ]);
    }

    public function testClosedTicketsList()
    {
        $response = $this->get('/api/tickets/closed');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'subject',
                    'content',
                    'user' => [
                        'name',
                        'email',
                    ],
                ],
            ],
        ]);
    }
}
