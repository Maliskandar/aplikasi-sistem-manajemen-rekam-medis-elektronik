@extends('asisten.components.layout')

@section('content')
    <div class="max-w-5xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Inbox</h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            @forelse ($inbox as $item)
                <div class="border-b pb-4">
                    <h2 class="text-lg font-semibold text-pink-600">{{ $item->title }}</h2>
                    <p class="text-sm text-gray-700">{{ $item->message }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $item->created_at->format('d M Y, H:i') }}</p>

                    @if ($item->patient_service_id)
                        @php
                            $ancRecord = \App\Models\AncRecord::where(
                                'patient_service_id',
                                $item->patient_service_id,
                            )->first();
                        @endphp

                        @if ($ancRecord)
                            <div class="mt-2">
                                <a href="{{ route('asisten.resep.anc', $ancRecord->id) }}"
                                    class="inline-block px-4 py-1 text-sm bg-pink-600 hover:bg-pink-700 text-white rounded-lg">
                                    Lihat Resep
                                </a>
                            </div>
                        @endif
                    @endif

                </div>
            @empty
                <p class="text-gray-500 text-center">Inbox kosong.</p>
            @endforelse
        </div>
    </div>
@endsection
