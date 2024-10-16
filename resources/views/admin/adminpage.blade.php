@extends('layouts.genericLayout')
@section('content')
<livewire:components.macro.page-specific.admin.generic-navbar :key="'navbar'" />
{{-- sidebar is a chore so I'll add it later on :) --}}
{{-- <livewire:components.macro.page-specific.admin.generic-sidebar :key="'sidebar'" /> --}}
<livewire:components.macro.page-specific.admin.dashboard.feature-cards :key="'feature-cards'" />
@endsection