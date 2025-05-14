@extends('layouts.main')

@section('section')
    @include('CustomerSupport', ['contacts' => $contacts])
    @include('usermanual', ['manuals'=> $manuals]) 
    @include('watchourvideos' , ['videos'=> $videos])
@endsection
