<?php

namespace Marqant\GraphQLCustomScalars\GraphQL\Types\Scalars\Tests;

use Tests\TestCase;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

/**
 * Class DateTimeTest
 *
 * @package Marqant\GraphQLCustomScalars\Tests
 */
class DateTimeTest extends TestCase
{
    use UsesTestSchema;
    use MakesGraphQLRequests;

    /**
     * @group ScalarType
     *
     * @test
     */
    public function testDateTimeScalar(): void
    {
        // create one User model instance
        $UserModel = config('auth.providers.users.model');
        // create a User
        $User = $UserModel::factory()->create();

        $this->schema = /** @lang GraphQL */'
            "A datetime string with format `Y-m-dTH:i:s.Z`, e.g. `2020-11-02T15:14:16.559021`."
            scalar DateTime @scalar(class: "Marqant\\\\GraphQLCustomScalars\\\\GraphQL\\\\Types\\\\Scalars\\\\DateTime")
            "User Type"
            type User {
                id: ID
                updatedAt: DateTime @rename(attribute: "updated_at")
                createdAt: DateTime @rename(attribute: "created_at")
            }
            "User query"
            type Query {
                user(id: ID @eq): User @find
            }
        ';

        $this->setUpTestSchema();

        // execute GraphQL query 'getOwnClassifiedAds'
        $userResponse = $this->postGraphQL([
            'query' => /** @lang GraphQL */'
                query User($id: ID) {
                    user(id: $id) {
                        id
                        updatedAt
                        createdAt
                    }
                }',
            'variables' => [
                'id' => $User->id,
            ],
        ]);

        // check response
        $userResponse
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'updatedAt',
                        'createdAt'
                    ],
                ],
            ])->assertJson([
                'data' => [
                    'user' => [
                        'id' => $User->id,
                        'updatedAt' => $User->updated_at->toIso8601String(),
                        'createdAt' => $User->created_at->toIso8601String(),
                    ],
                ],
            ]);
    }
}
