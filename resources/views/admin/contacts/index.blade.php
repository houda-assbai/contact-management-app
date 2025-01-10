@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des utilisateurs</h1>

        <!-- Formulaire de recherche, tri et filtre -->
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou email" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="sortBy" class="form-control">
                        <option value="name" {{ request('sortBy') == 'name' ? 'selected' : '' }}>Nom</option>
                        <option value="email" {{ request('sortBy') == 'email' ? 'selected' : '' }}>Email</option>
                    
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="order" class="form-control">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascendant</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descendant</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <!-- Vérification s'il y a un message de succès dans la session -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table des utilisateurs -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $user->id) }}" class="btn btn-primary btn-sm">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination (si nécessaire) -->
        {{ $users->links() }}
    </div>
@endsection
