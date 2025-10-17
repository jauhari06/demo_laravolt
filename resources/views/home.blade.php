<x-volt-app title="Dashboard">
    

    <h2 class="ui header">
        <div class="content">
            Dashboard Statistik
            <div class="sub header">Ringkasan aktivitas sistem</div>
        </div>
    </h2>

    <div class="ui stackable four column grid">
        <div class="column">
            @livewire(\App\Http\Livewire\Statistic\TotalNews::class)
        </div>
        <div class="column">
            @livewire(\App\Http\Livewire\Statistic\ActiveAuthors::class)
        </div>
        <div class="column">
            @livewire(\App\Http\Livewire\Statistic\NewsThisMonth::class)
        </div>
        <div class="column">
            @livewire(\App\Http\Livewire\Statistic\TotalViews::class)
        </div>
    </div>

    <div class="ui hidden divider"></div>

    {{-- Chart --}}
    <div class="ui segment">
        <h3 class="ui header">         
            <i class="chart line icon"></i>
            <div class="content">
                Statistik Berita Bulan Ini
                <div class="sub header">Jumlah berita yang dipublikasikan per hari</div>
            </div>
        </h3>
        @livewire(\App\Http\Livewire\Chart\NewsThisMonthChart::class)
    </div>

</x-volt-app>
