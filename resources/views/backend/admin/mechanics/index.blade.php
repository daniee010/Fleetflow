@extends('backend.layout.master')
@section('title','Mechanics')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Mechanics</h1>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($mechanics as $m)
            <a href="{{ route('admin.mechanics.show',$m) }}"
               class="block bg-white dark:bg-[#161615] rounded-lg p-5 shadow hover:shadow-md transition">
                <div class="font-semibold text-lg">
                    {{ optional($m->user)->name ?? 'Mechanic #'.$m->id }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ optional($m->user)->email }}
                </div>
                <div class="mt-2">
            <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800">
                Specialization: {{ $m->specialization }}
            </span>
                </div>
                <div class="mt-3 text-sm">
                    Assigned maintenances: <strong>{{ $m->maintenances_count }}</strong>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $mechanics->links() }}
    </div>
@endsection
