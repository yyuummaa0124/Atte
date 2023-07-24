@extends('layouts.layout')
@section('content')

    <div class="main-userlist">
        <table class="table-content-userlist">  
            <tr>
                <th class="table-clm-id">ユーザID</th>
                <th class="table-clm">ユーザ名</th>
                <th class="table-clm">メールアドレス</th>
            </tr>
                @foreach ($users as $user)
                    <tr>
                        <td class="table-row-id"><a href="{{ route('posts.getUserDate', $user->id) }}">{{ $user->id }}</a></td>
                        <td class="table-row"><a href="{{ route('posts.getUserDate', $user->id) }}">{{ $user->name }}</a></td>
                        <td class="table-row">{{ $user->email }}</a></td>
                    </tr>
                @endforeach
        </table>
    </div>

    <!-- ページネーションリンク -->
    <div class="pagination">
        <ul class="pagination-list">
            @if ($users->onFirstPage())
                <li class="pagelist">
                    <span class="pageitem">&laquo;</span>
                </li>
            @else
                <a class="pagelist" href="{{ $users->previousPageUrl() }}" rel="prev">
                    <li class="pagination-list">
                        <span class="pageitem">&laquo;</span>
                    </li>
                </a>
            @endif

            @foreach(range(1, $users->lastPage()) as $page)
                @if ($page == $users->currentPage())
                    <div class="pagelist">
                        <li class="active"><span class="pageitem">{{ $page }}</span></li>
                    </div>
                @else
                    <a class="pagelist" href="{{ $users->url($page) }}">
                        <li><span class="pageitem">{{ $page }}</span></li>
                    </a>
                @endif
            @endforeach

            @if ($users->hasMorePages())
                <a class="pagelist" href="{{ $users->nextPageUrl() }}" rel="next">
                    <li><span class="pageitem">&raquo;</span></li>
                </a>
            @else
                <div class="pagelist">
                    <li class="disabled"><span class="pageitem">&raquo;</span></li>
                </div>
            @endif
        </ul>
    </div>


@endsection