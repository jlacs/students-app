@extends('master')

@section('title') Student Curriculum @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 card-header text-center font-weight-bold">
                <h2>Student Curriculum!</h2>
            </div>
            <div class="col-md-12 d-flex flex-row-reverse mt-1 mb-1">
                <button type="button" id="add-scientist" class="btn btn-success add-scientist" data-toggle="modal" data-target="#scientistModal">Add Student</button>
            </div>
            <div class="col-md-12 mt-1">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->firstname }}</td>
                            <td>{{ $student->lastname }}</td>
                            <td> 
                                <table class="table table-sm table-borderless">
                                @foreach($student->subjects as $subject)
                                    <tr>
                                        <td>
                                            <a href="#" class="mt-2 col-md-12 text-secondary edit-theory" data-toggle="modal" data-target="#theoryModal" data-id="{{ $subject->id }}">{{ $subject->name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No student in the list... for now!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection