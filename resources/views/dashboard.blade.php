<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-4xl mx-auto p-6">
                        <h2 class="text-xl font-bold mb-4">AI Chat</h2>

                        <!-- Display Message -->
                        @if(session('message'))
                        <div class="p-2 bg-green-300 rounded">{{ session('message') }}</div>
                        @endif

                        <!-- AI Input Form -->
                        <form method="POST" action="{{ route('generate.response') }}" class="mb-4">
                            @csrf
                            <textarea name="prompt" class="w-full border rounded p-2" style="color:black" placeholder="Enter your prompt..." required></textarea>
                            <select name="gptOption" style="color: black">
                                <option value="gpt-3.5-turbo">gpt-3.5</option>
                                <option value="gpt-4o-mini">gpt-4</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Generate Response</button>
                        </form>
                        @can('view-results')
                        <!-- Display Responses -->
                        <h3 class="text-lg font-bold mt-6">Query History</h3>
                        @foreach($queries as $query)
                        <div class="p-3 border-b">
                            <p><strong>You:</strong> {{ $query->prompt }}</p>
                            <p><strong>AI:</strong> {{ $query->response }}</p>
                        </div>
                        @endforeach
                        @else
                        <p>You don't have access to view Query History only admins can see the query History.</p>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>