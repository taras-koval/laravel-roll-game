@extends('_layouts.app')

@section('content')
    <div class="container">
        <section x-data="rollGame()">
            <header class="mb-8">
                <h1 class="text-2xl font-extrabold">Welcome, {{ $user->username }}!</h1>
            </header>

            <div class="flex flex-wrap justify-between">
                <div>
                    <div class="flex items-center gap-8 mb-8">
                        <button @click="roll()" :disabled="loadingRoll" class="button-primary-component w-48 bg-blue-500 hover:bg-blue-600">
                            <span x-show="!showRollLoader">{{ __('🎲 ImFeelingLucky') }}</span>
                            <span x-show="showRollLoader" x-cloak>
                                @include('_components.loader-indicator')
                            </span>
                        </button>

                        <template x-if="rollResult">
                            <div class="flex font-bold gap-8">
                                <span x-text="rollResult.number"></span>

                                <span class="font-bold"
                                      :class="rollResult.result === 'Win' ? 'text-green-600' : 'text-red-500'"
                                      x-text="rollResult.result"></span>

                                <span x-text="'$' + rollResult.amount"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <button @click="loadHistory()" :disabled="loadingHistory" class="button-primary-component w-48 self-end bg-gray-500 hover:bg-gray-600">
                        <span x-show="!showHistoryLoader">{{ __('📜 Show History') }}</span>
                        <span x-show="showHistoryLoader" x-cloak>
                            @include('_components.loader-indicator')
                        </span>
                    </button>

                    <div class="mt-4" x-show="history.length" x-cloak>
                        <h2 class="text-xl font-semibold mb-2">Last 3 Rolls</h2>

                        <ul class="space-y-2">
                            <template x-for="item in history" :key="item.id">
                                <li class="grid grid-cols-[auto_1fr_auto] gap-2 items-center">
                                    <span class="w-16" x-text="'🎲 ' + item.number"></span>

                                    <span class="w-20 font-bold"
                                          :class="item.result === 'Win' ? 'text-green-600' : 'text-red-500'"
                                          x-text="item.result + ' $' + item.amount"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function rollGame() {
            return {
                loadingRoll: false,
                showRollLoader: false,
                rollResult: null,

                roll() {
                    if (this.loadingRoll) return;
                    this.loadingRoll = true;
                    const loaderTimeout = setTimeout(() => this.showRollLoader = true, 150);

                    axios.post('{{ route('game.roll', $link->uuid) }}')
                        .then(response => {
                            this.rollResult = response.data.data;
                        })
                        .catch(error => {
                            toastError(error.response?.data?.message || error.response?.statusText);
                        })
                        .finally(() => {
                            clearTimeout(loaderTimeout);
                            this.loadingRoll = false;
                            this.showRollLoader = false;
                        });
                },

                loadingHistory: false,
                showHistoryLoader: false,
                history: [],

                loadHistory() {
                    if (this.loadingHistory) return;
                    this.loadingHistory = true;
                    const loaderTimeout = setTimeout(() => this.showHistoryLoader = true, 150);

                    axios.get('{{ route('game.history', $link->uuid) }}')
                        .then(response => {
                            this.history = response.data.data;
                        })
                        .catch(error => {
                            toastError(error.response?.data?.message || error.response?.statusText);
                        })
                        .finally(() => {
                            clearTimeout(loaderTimeout);
                            this.loadingHistory = false;
                            this.showHistoryLoader = false;
                        });
                }
            }
        }
    </script>
@endpush
