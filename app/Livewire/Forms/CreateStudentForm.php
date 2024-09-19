<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Student;
use App\Models\Section;

class CreateStudentForm extends Form
{
    #[Validate('required')]
    public $name;
    #[Validate('required|email|unique:students,email')]
    public $email;

    #[Validate('required')]
    public $section_id;

    public $sections = [];

    public function storeStudent($class_id)
    {
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }

    public function setSections($class_id)
    {
        $this->sections = Section::where('class_id', $value)->get();
    }
}
