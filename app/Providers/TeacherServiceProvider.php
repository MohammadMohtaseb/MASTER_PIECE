<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class TeacherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('students_count_for_teacher', function () {
            return $this->students_count_for_teacher();
        });
        $this->app->singleton('classrooms_for_teacher', function () {
            return $this->classrooms_for_teacher();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function students_count_for_teacher()
    {
        $Classrooms = Auth::guard('teacher')->user()->classrooms;
        $count = 0;
        foreach ($Classrooms as $item) {
            $count += Student::where('classroom_id', $item->id)->count();
        }
        return $count;
    }
    

    public function classrooms_for_teacher()
    {
        return Auth::guard('teacher')->user()->classrooms->pluck('id','name');
    }
}
