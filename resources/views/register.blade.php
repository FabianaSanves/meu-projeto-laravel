@extends('layouts.main_layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <!-- logo -->
                    <div class="text-center p-3">
                        <img src="assets/images/logo.png" alt="Notes logo">
                    </div>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>

<body>
    <h2>Cadastro de novo usuário</h2>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="password_confirmation">Confirme a Senha:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required><br><br>

        <button type="submit">Cadastre-se</button>
    </form>

    <p>Já tem conta? <a href="{{ route('login') }}">Entre</a></p>
</body>

</html>
