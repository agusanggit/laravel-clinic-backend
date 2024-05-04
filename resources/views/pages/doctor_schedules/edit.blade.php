@extends('layouts.app')

@section('title', 'Edit Doctor')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Schedule</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Schedule</h2>

                <div class="card">
                    <form action="{{ route('doctor-schedules.update', $doctorSchedule, $doctors) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            {{-- 'doctor_id',
                            'day',
                            'time',
                            'status',
                            'note', --}}
                            <div class="form-group">
                                <label>Doctor</label>
                                <input type="text"
                                class="form-control @error('doctor_id') is-valid @enderror"
                                    name='doctor_id'value="{{$doctorSchedule->doctor_name}}">
                                    @foreach ($doctors as $doctor )
                                    <option value="{{$doctorSchedule->doctor_id}}">{{$doctor->doctor_name}}</option>
                                    @endforeach
                                @error('doctor_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Senin</label>
                                <input type="text"
                                    class="form-control @error('senin')
                                    is-invalid
                                @enderror"
                                    name="senin" value="{{$doctorSchedule->time}}">
                                @error('senin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Selasa</label>
                                <input type="text"
                                    class="form-control @error('selasa')
                                    is-invalid
                                @enderror"
                                    name="selasa" value="{{$doctorSchedule->time}}">
                                @error('selasa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Rabu</label>
                                <input type="text"
                                    class="form-control @error('rabu')
                                    is-invalid
                                @enderror"
                                    name="rabu" value="{{$doctorSchedule->time}}">
                                @error('rabu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Kamis</label>
                                <input type="text"
                                    class="form-control @error('kamis')
                                    is-invalid
                                @enderror"
                                    name="kamis" value="{{$doctorSchedule->time}}">
                                @error('kamis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Jumat</label>
                                <input type="text"
                                    class="form-control @error('jumat')
                                    is-invalid
                                @enderror"
                                    name="jumat" value="{{$doctorSchedule->time}}">
                                @error('jumat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Sabtu</label>
                                <input type="text"
                                    class="form-control @error('sabtu')
                                    is-invalid
                                @enderror"
                                    name="sabtu" value="{{$doctorSchedule->time}}">
                                @error('sabtu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal Minggu</label>
                                <input type="text"
                                    class="form-control @error('minggu')
                                    is-invalid
                                @enderror"
                                    name="minggu" value="{{$doctorSchedule->time}}">
                                @error('minggu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
