<?php

namespace App\Livewire;
use App\Models\Section;
use App\Models\Classes;
use App\Models\Student;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\UpdateStudentForm;


use Livewire\Component;

class EditStudent extends Component
{
    public Student $student;

    public UpdateStudentForm $form;
    #[Validate('required')]
    public $class_id;
    // #[Validate('required|email|unique:students,email,' .  $student->id)]
    public $email;

    public function update()
    {

        $this->validate();
        $this->validate([
            'email'=> 'required|email|unique:students,email,' .  $this->student->id,
        ]);
        $this->form->updateStudent($this->class_id, $this->email);
        
        return $this->redirect(route('students.index'), navigate:true);
    }

    public function mount()
    {
        $this->form->setStudent($this->student);

        $this->fill($this->student->only([
            'class_id',
            'email',
        ]));

    }

    public function updatedClassId($value)
    {
        $this->sections = Section::where('class_id', $value)->get();
    }
    public function render()
    {
        return view('livewire.edit-student',[
            'classes' => Classes::all(),
            ]);
    }
}
