<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Models\Student;
use App\Models\Section;
use Livewire\Form;

class UpdateStudentForm extends Form
{
    public Student $student;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $section_id;

    public $sections = [];

    public function setStudent(Student $student)
    {
        $this->student = $student;

        $this->fill($student->only([
            'name',
            'email',
            'section_id',
        ]));

        $this->sections = Section::where('class_id', $student->class_id)->get();
    }


    public function updateStudent($class_id, $email)
    {
        $this->student->update([
            'name' => $this->name,
            'email' => $email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }

    public function setSections($class_id)
    {
        $this->sections = Section::where('class_id', $class_id)->get();
    }
}
