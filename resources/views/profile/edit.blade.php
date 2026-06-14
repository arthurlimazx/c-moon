@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="form-page">

  <div class="page-header animate-up">
    <div class="page-header-text">
      <div class="eyebrow">Conta</div>
      <h1>Meu perfil</h1>
      <p>Gerencie suas informações pessoais e segurança.</p>
    </div>
  </div>

  <div style="display:flex; flex-direction:column; gap:24px;" class="animate-up-delay-1">
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')
  </div>

</div>
@endsection