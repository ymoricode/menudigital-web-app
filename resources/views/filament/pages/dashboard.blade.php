<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Welcome Banner - Clean & Modern -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 dark:from-orange-600 dark:to-orange-700 p-6 lg:p-7 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <!-- Orange Icon - Adaptive to Theme -->
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
                                Dashboard Admin
                            </h1>
                            <p class="text-gray-800 dark:text-white/90 text-sm mt-0.5 font-medium">
                                Halo, <span class="font-semibold">{{ auth()->user()->name }}</span> 👋
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-gray-900 dark:text-white/95 bg-white/15 dark:bg-white/15 backdrop-blur-sm px-4 py-2 rounded-lg">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium">{{ now()->locale('id')->isoFormat('dddd, D MMM Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        @livewire(\App\Filament\Widgets\A_TodayRevenueCard::class)

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Daily Sales Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md dark:shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center gap-3 mb-5">
                    <!-- Orange Icon - Adaptive -->
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Penjualan Harian</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Grafik penjualan per hari</p>
                    </div>
                </div>
                @livewire(\App\Filament\Widgets\DailySalesCount::class)
            </div>

            <!-- Monthly Revenue Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md dark:shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center gap-3 mb-5">
                    <!-- Orange Icon - Adaptive -->
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pendapatan Bulanan</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Grafik revenue per bulan</p>
                    </div>
                </div>
                @livewire(\App\Filament\Widgets\MonthlyRevenueChart::class)
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md dark:shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-5">
                <!-- Orange Icon - Adaptive -->
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Produk Terlaris</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Top selling products</p>
                </div>
            </div>
            @livewire(\App\Filament\Widgets\TopSellingProductsChart::class)
        </div>
    </div>
</x-filament-panels::page>
