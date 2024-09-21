<?php

namespace App\Livewire;

use App\Exports\StudentsExport;
use App\Models\Student;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Filament\Notifications\Notification;


class ListStudents extends Component
{
    use WithPagination;
    #[Url(history: true)]
    public string $search = '';
    #[Url(history: true)]
    public string $sortColumn = 'name';
     #[Url(history: true)]
    public string $sortDirection = 'asc';

    public array $selectedStudentIds = [];


    public function render()
    {
        $query = Student::query();
        $query = $this->applySearch($query);
        $query = $this->applySort($query);

        return view('livewire.list-students',[
            'students' => $query->paginate(10)
        ]);
    }
    public function sortBy(string $column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }

    protected function applySort(Builder $query): Builder
    {
        return $query->orderBy($this->sortColumn, $this->sortDirection);
    }

    public  function applySearch(Builder $query): Builder
    {
        return $query->where('name','like', '%'.$this->search.'%')
            ->orWhere('email','like', '%'.$this->search.'%')
            ->orWhereHas('class',function($query){
                $query->where('name', 'like', $this->search.'%');
            });
    }

    public function deleteStudent($studentId)
    {
        //Authorization check

        Student::find($studentId)->delete();

        return redirect(route('students.index'));
    }

    public function deleteStudents()
    {
        //Student::destroy($this->selectedStudentIds);
        foreach($this->selectedStudentIds as $id) {
            $this->deleteStudent($id);
        }

        Notification::make()
        ->title('Selected records deleted successfully')
        ->success()
        ->send();
    }

    public function export()
    {
        return (new StudentsExport($this->selectedStudentIds))->download(now().'_students.xlsx');
    }
}
