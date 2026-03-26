<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Organisation>
 */
class OrganisationFactory extends Factory
{
    public function definition(): array
    {
        return [
            "organisation_name" => fake()->company(),
            "created_by" => User::factory(),
        ];
    }

    public function withUsers(array|int $users, ?int $created_by = null): static
    {
        return $this->afterCreating(function (Organisation $organisation) use (
            $users,
            $created_by,
        ) {
            $users = is_array($users)
                ? $users
                : User::factory($users)->create();
            foreach ($users as $user) {
                $organisation
                    ->users()
                    ->attach($user->id, [
                        "created_by" =>
                            $created_by ?? $organisation->created_by,
                    ]);
            }
        });
    }
}
