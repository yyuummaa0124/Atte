@extends('layouts.layout')


@section('content')
    <div class="main-content">   

            <!-- ページネーションリンク -->
            <div class="top-pagination">
                <form action="{{route('posts.getBeforeMonth' , [ 'id' => $id, 'dates' => $dates])}}" method="GET">
                    @csrf
                    <button class="beforebtn">
                        <span><</span>
                    </button>
                </form> 
                
            <div class="pagination-text">
                <p class="pagination-day">{{$dates}}</p>
            </div>

                <form action="{{route('posts.getNextMonth' , [ 'id' => $id, 'dates' => $dates])}}" method="GET">
                    @csrf
                    <button class="nextbtn">
                        <span>></span>
                    </button>
                </form>
            </div>

            <table class="table-content">  
                <tr>
                    <th class="table-clm">名前</th>
                    <th class="table-clm">勤務開始</th>
                    <th class="table-clm">勤務終了</th>
                    <th class="table-clm">休憩時間</th>
                    <th class="table-clm">勤務時間</th>
                </tr>

                    @foreach ($stampdatas as $stampdata)
                        <tr>
                            <td class="table-row">{{$stampdata->user->name}}</td>
                            <td class="table-row">{{$stampdata -> start_time}}</td>
                            <td class="table-row">{{$stampdata -> end_time}}</td>
                            <td class="table-row">{{$stampdata -> total_rest}}</td>
                            <td class="table-row">{{$stampdata -> total_time}}</td>
                        </tr>
                    @endforeach
            </table>

            <!-- ページネーションリンク -->
            <div class="pagination">
                <ul class="pagination-list">
                    @if ($stampdatas->onFirstPage())
                        <li class="pagelist">
                            <span class="pageitem">&laquo;</span>
                        </li>
                    @else
                        <a class="pagelist" href="{{ $stampdatas->previousPageUrl() }}" rel="prev">
                            <li class="pagination-list">
                                <span class="pageitem">&laquo;</span>
                            </li>
                        </a>
                    @endif

                    @foreach(range(1, $stampdatas->lastPage()) as $page)
                        @if ($page == $stampdatas->currentPage())
                            <div class="pagelist">
                                <li class="active"><span class="pageitem">{{ $page }}</span></li>
                            </div>
                        @else
                            <a class="pagelist" href="{{ $stampdatas->url($page) }}">
                                <li><span class="pageitem">{{ $page }}</span></li>
                            </a>
                        @endif
                    @endforeach

                    @if ($stampdatas->hasMorePages())
                        <a class="pagelist" href="{{ $stampdatas->nextPageUrl() }}" rel="next">
                            <li><span class="pageitem">&raquo;</span></li>
                        </a>
                    @else
                        <div class="pagelist">
                            <li class="disabled"><span class="pageitem">&raquo;</span></li>
                        </div>
                    @endif
                </ul>
            </div>
        </div>
@endsection