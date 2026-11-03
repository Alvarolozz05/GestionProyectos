<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // CREACIÓN DE USUARIOS
        $alvaro = User::factory()->create([
            'name' => 'Álvaro Lozano',
            'email' => 'alvaro@example.com',
        ]);

        $carlos = User::factory()->create([
            'name' => 'Carlos Martínez',
            'email' => 'carlos@example.com',
        ]);

        $laura = User::factory()->create([
            'name' => 'Laura García',
            'email' => 'laura@example.com',
        ]);

        $david = User::factory()->create([
            'name' => 'David Sánchez',
            'email' => 'david@example.com',
        ]);

        $maria = User::factory()->create([
            'name' => 'María Fernández',
            'email' => 'maria@example.com',
        ]);

        // CREACIÓN DE PROYECTOS
        $project1 = Project::forceCreate([
            'user_id' => $alvaro->id,
            'title' => 'Gestión de proyectos',
            'description' => 'Aplicación web para gestionar proyectos y equipos de trabajo.',
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'En progreso',
        ]);

        $project2 = Project::forceCreate([
            'user_id' => $carlos->id,
            'title' => 'Tienda online',
            'description' => 'Desarrollo de una plataforma de comercio electrónico.',
            'due_date' => now()->addDays(60)->toDateString(),
            'status' => 'Pendiente',
        ]);

        $project3 = Project::forceCreate([
            'user_id' => $laura->id,
            'title' => 'Portfolio profesional',
            'description' => 'Diseño y desarrollo de un portfolio personal.',
            'due_date' => now()->addDays(15)->toDateString(),
            'status' => 'Completado',
        ]);

        // ASIGNACIÓN DE PARTICIPANTES AL PROYECTO 1
        DB::table('project_user')->insert([
            [
                'project_id' => $project1->id,
                'user_id' => $carlos->id,
                'role' => 'Desarrollador',
                'contribution_hours' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => $project1->id,
                'user_id' => $laura->id,
                'role' => 'Diseñadora',
                'contribution_hours' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => $project1->id,
                'user_id' => $david->id,
                'role' => 'Tester',
                'contribution_hours' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ASIGNACIÓN DE PARTICIPANTES AL PROYECTO 2
        DB::table('project_user')->insert([
            [
                'project_id' => $project2->id,
                'user_id' => $alvaro->id,
                'role' => 'Desarrollador',
                'contribution_hours' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => $project2->id,
                'user_id' => $maria->id,
                'role' => 'Diseñadora',
                'contribution_hours' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ASIGNACIÓN DE PARTICIPANTES AL PROYECTO 3
        DB::table('project_user')->insert([
            [
                'project_id' => $project3->id,
                'user_id' => $david->id,
                'role' => 'Tester',
                'contribution_hours' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}