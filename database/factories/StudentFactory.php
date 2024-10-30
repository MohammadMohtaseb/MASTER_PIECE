<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\ParentStudent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name, // اسم الطالب الوهمي
            'email' => $this->faker->unique()->safeEmail, // بريد إلكتروني فريد وهمي
            'password' => Hash::make('password123'), // كلمة مرور مشفرة
            'gender' => $this->faker->boolean, // الجنس (1 أو 0)
            'parent_student_id' => ParentStudent::factory(),  // يقوم بإنشاء أب أو وصي وهمي
            'classroom_id' => Classroom::factory(),           // يقوم بإنشاء غرفة دراسية وهمية
        ];
    }
}
