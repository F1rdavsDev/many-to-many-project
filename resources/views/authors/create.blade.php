@extends('layouts.author')
@section('title', 'Author Create')
@section('content')
    <div class="container mt-5">
        <h2>Muallif Qo'shish</h2>
        <a href="{{ route('authors.index') }}" class="text-danger" style="margin-left: 10px;">Ortga</a>

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf
        
            <div class="mb-3">
                <label for="name" class="form-label">Muallif Nomi</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
        
            <div class="mb-3">
                <label for="biography" class="form-label">Biografiya</label>
                <textarea class="form-control" id="biography" name="biography" rows="4">{{ old('biography') }}</textarea>
            </div>
        
            <div class="mb-3">
                <label for="books" class="form-label">Kitoblar Tanlash</label>
                <select name="books[]" id="books" class="form-select" multiple>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
                <div class="form-text">Bir nechta kitob tanlash uchun <strong>CTRL</strong> tugmasini bosib turib tanlang.</div>
            </div>
        
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </form>
        
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection