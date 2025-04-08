@extends('layouts.books')
@section('title', 'Book List')
@section('content')
<div class="container mt-5">
    <a href="{{ route('dashboard') }}" style="font-size: 25px;">Ortga</a>
    <h2 class="mb-4">Kitoblar Ro'yxati
        <a href="{{ route('books.create') }}" class="btn btn-primary">Kitob Yaratish</a>
    </h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kitob Nomi</th>
                <th>Tavsif</th>
                <th>Mualliflar</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->description}}</td>
                    <td>
                        @if ($book->authors->isEmpty())
                            Muallif topilmadi
                        @else
                            {{ $book->authors->pluck('name')->join(', ') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Ko'rish</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Tahrirlash</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">O'chirish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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