@extends('layouts.books')
@section('title', 'Book Create')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Yangi Kitob Qo'shish
        <a class="text-danger" href="{{ route('books.index') }}" style="margin-left: 10px;">Ortga</a>
    </h2>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Kitob Nomi</label>
            <input type="text" class="form-control" id="title" name="title"
                placeholder="Kitob nomini kiriting">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Kitob Tavsifi</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                placeholder="Kitob tavsifini kiriting"></textarea>
        </div>

        <div class="mb-3">
            <label for="authors" class="form-label">Mualliflarni Tanlang</label>
            <select name="authors[]" id="authors" class="form-select" multiple>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" 
                            {{ isset($book) && $book->authors->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Bir nechta muallif tanlash uchun <strong>CTRL</strong> tugmasini bosib turib tanlang.</div>
        </div>
        

        <button type="submit" class="btn btn-primary">Saqlash</button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection