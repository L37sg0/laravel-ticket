<?php

namespace Database\Factories\Helpdesk;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Helpdesk\Department as Model;

class DepartmentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Model::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
//            Model::FIELD_PARENT_ID  => '',  // Will be filled on seed.
            Model::FIELD_TITLE      => ucfirst(fake()->word),
            Model::FIELD_META_TITLE => strtolower(fake()->word),
            Model::FIELD_SLUG       => strtolower(fake()->word),
        ];
    }
}
