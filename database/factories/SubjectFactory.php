<?php
namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        $subjects = [
            'Matematika', 'Fisika', 'Kimia', 'Biologi', 'Sejarah', 
            'Bahasa Indonesia', 'Bahasa Inggris', 'Seni Budaya', 
            'Ekonomi', 'Geografi', 'Sosiologi', 'Pendidikan Agama Islam',
            'PKN', 'Teknologi Informasi', 'Olahraga'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($subjects),
        ];
    }
}
