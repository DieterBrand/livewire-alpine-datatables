<div class="bg-gray-100 py-10">
    <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Students
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the Students.
                    </p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a wire:navigate href="{{route('students.create')}}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                        Add Student
                    </a>
                </div>
            </div>

            <div class="flex flex-col justify-between sm:flex-row mt-6">
                <div class="relative text-sm text-gray-800 col-span-3">
                    <div
                        class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                        <x-icons.magnifying-glass />
                    </div>

                    <input wire:model.live.debounce.500ms="search" type="text" placeholder="Search students data..." id="search" autocomplete="off"
                        class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
                <div x-show="$wire.selectedStudentIds.length > 0"
                    class="flex flex-col sm:flex-row gap-2 sm:justify-end col-span-5">
                    <div class="flex flex-row-reverse justify-end sm:justify-start sm:flex-row gap-2">
                        <div class="flex items-center gap-1 text-md text-gray-600">
                            <span x-text="$wire.selectedStudentIds.length"></span>
                            <span>selected</span>
                        </div>
                        <div class="flex items-center px-3">
                            <div class="h-[75%] w-[1px] bg-gray-300"></div>
                        </div>
                        <x-check-all-button />
                        <form wire:submit="deleteStudents" wire:confirm="Are you sure you want to delete these Records?">
                            <button type="submit"
                                class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-md text-gray-700 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-75">
                                <x-icons.delete />
                                Delete
                            </button>
                        </form>
                    </div>
                    <div class="hidden sm:flex">
                        <form wire:submit="export">
                            <button type="submit"
                                class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-md text-gray-700 hover:bg-gray-200">
                                <x-icons.arrow-down-tray />
                                Export
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            <x-sortable column="id" :$sortColumn :sortDirection="$sortDirection">
                                                ID
                                            </x-sortable>
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            <x-sortable column="name" :$sortColumn :$sortDirection>
                                                Name
                                            </x-sortable>
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Class
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Section
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            <x-sortable column="created_at" :$sortColumn :$sortDirection>
                                                Created At
                                            </x-sortable>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($students as $student)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            <input wire:model="selectedStudentIds" value="{{$student->id}}" type="checkbox" class="rounded border-gray-300 shadow">
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{$student->id}}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{$student->name}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$student->email}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$student->class->name}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$student->section->name}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$student->created_at->toDateString()}}
                                        </td>

                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a wire:navigate href="{{route('students.edit',$student->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
                                            <button wire:confirm="Are you sure you want to delete this record?" wire:click="deleteStudent({{$student->id}})" class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div wire:loading class="absolute inset-0 bg-white opacity-50">
                                {{--  --}}
                            </div>
                            <div wire:loading.flex class="flex justify-center items-center absolute inset-0">
                                <x-icons.spinner class="h-12 w-12 tet-indigio-600" />
                            </div>
                        </div>
                        <div class="mt-5">{{$students->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
