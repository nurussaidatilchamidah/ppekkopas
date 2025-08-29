@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between w-full">
        {{-- Dropdown per page --}}
        <div class="mb-4 sm:mb-0">
            <form method="GET">
                <label for="perPage" class="mr-2 text-sm">Tampilkan:</label>
                <select name="perPage" id="perPage"
                    class="w-24 p-2 border rounded-md"
                    onchange="this.form.submit()">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
        </div>

        {{-- Pagination --}}
        <nav role="navigation" class="flex items-center justify-center">
            <ul class="flex items-center space-x-1">
                {{-- Tombol Previous --}}
                @if ($paginator->onFirstPage())
                    <li class="px-3 py-1 text-gray-400">&laquo;</li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border rounded-md">&laquo;</a>
                    </li>
                @endif

                {{-- Halaman angka (desktop) --}}
                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max(1, $current - 1);
                    $end = min($last, $current + 1);
                @endphp

                {{-- Selalu tampilkan halaman 1 --}}
                @if ($start > 1)
                    <li><a href="{{ $paginator->url(1) }}" class="px-3 py-1 border rounded-md">1</a></li>
                @endif

                {{-- Range tengah --}}
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $current)
                        <li><span class="px-3 py-1 border rounded-md bg-blue-500 text-white">{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}" class="px-3 py-1 border rounded-md">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Selalu tampilkan halaman terakhir --}}
                @if ($end < $last)
                    <li><a href="{{ $paginator->url($last) }}" class="px-3 py-1 border rounded-md">{{ $last }}</a></li>
                @endif

                {{-- Tombol Next --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border rounded-md">&raquo;</a>
                    </li>
                @else
                    <li class="px-3 py-1 text-gray-400">&raquo;</li>
                @endif
            </ul>
        </nav>
    </div>
@endif
