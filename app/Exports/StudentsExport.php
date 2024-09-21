<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct(public array $studentIds)
    {
        //
    }
    public function headings(): array
    {
        return [
            'Name',
            'Class',
            'Section',
            'Email',
            'Created At',
        ];
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->class->name,
            $student->section->name,
            $student->email,
            $student->created_at->toDateString(),
        ];
    }

    public function query()
    {
        return Student::query()->whereIn('id', $this->studentIds);
    }
}
