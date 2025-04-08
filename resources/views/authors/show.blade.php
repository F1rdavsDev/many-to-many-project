@extends('layouts.author')
@section('title', 'Author Details')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Muallif: {{ $author->name }}
        <a class="text-danger" href="{{ route('authors.index') }}" style="margin-left: 10px;">Ortga</a>
    </h2>

    <div class="mb-3">
        <h5>Biografiya:</h5>
        <p>{{ $author->biography ?? 'Biografiya mavjud emas.' }}</p>

    </div>

    <div class="mb-3">
        <h5>Yozgan Kitoblar:</h5>
        <ul>
            @forelse($author->books as $book)
                <li>{{ $book->title }}</li>
            @empty
                <li>Muallif hech qanday kitob yozmagan.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning">Muallifni Tahrirlash</a>
        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Muallifni O'chirish</button>
        </form>
    </div>
</div>
@endsection