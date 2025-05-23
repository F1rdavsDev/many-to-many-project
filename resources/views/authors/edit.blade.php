@extends('layouts.author')
@section('title', 'Author Edit')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Muallifni Tahrirlash: {{ $author->name }}
        <a class="text-danger" href="{{ route('authors.index') }}" style="margin-left: 10px;">Ortga</a>
    </h2>

    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Muallif Nomi</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $author->name) }}" >
        </div>

        <div class="mb-3">
            <label for="biography" class="form-label">Biografiya</label>
            <textarea class="form-control" id="biography" name="biography" rows="4">{{ old('biography', $author->biography) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="books" class="form-label">Kitoblarni Tanlang</label>
            <select name="books[]" id="books" class="form-select" multiple>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" 
                            {{ $author->books->contains($book->id) ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
            
    @error('books')
    <div class="text-danger mt-1">{{ $message }}</div>
@enderror
            <div class="form-text">Bir nechta kitob tanlash uchun <strong>CTRL</strong> (yoki Mac uchun CMD) tugmasini bosib turib tanlang.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>

    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection