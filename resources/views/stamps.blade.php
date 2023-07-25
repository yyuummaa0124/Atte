@extends('layouts.layout')
@section('content')
    <div class="main-content">

      <p class="main-top-comment">{{$user->name}}さんお疲れ様です！</p>
      
      <form id="myForm" action="{{ route('posts.startwork', ['id' => $user->id]) }}" method="POST">
        <div class="stamp-topcard">
          @csrf
          <button id="myButton" class="stamp-card" type="submit" @if($exists && date('H') >= 0) disabled @endif>勤務開始</button>   
      </form> 

      <form action="{{route('posts.endwork')}}" method="POST">
          @csrf
          <button class="stamp-card" type="submit" @if(!$exists || $endtimeRecord->end_time) disabled  @endif>勤務終了</button>
        </div>
      </form>

      <form action="{{route('posts.startrest')}}" method="POST">
        @csrf
      <div class="stamp-undercard">
        @if(!$restRecord)
          <button class="stamp-card" type="submit">休憩開始</button>
        @elseif($restRecord->start_rest && !$restRecord->end_rest)
          <button class="stamp-card" disabled  type="submit">休憩開始</button>
        @elseif($restRecord->start_rest && $restRecord->end_rest)
          <button class="stamp-card" type="submit">休憩開始</button>
        @endif
      </form>

      <form action="{{route('posts.endrest')}}" method="POST">
        @csrf
          @if(!$restRecord)
            <button class="stamp-card" disabled type="submit">休憩終了</button>
          @elseif($restRecord->start_rest && !$restRecord->end_rest)
            <button class="stamp-card" type="submit">休憩終了</button>
          @elseif($restRecord->start_rest && $restRecord->end_rest)
            <button class="stamp-card" disabled  type="submit">休憩終了</button>
          @endif
      </div>
      </form>
    </div>

@endsection
