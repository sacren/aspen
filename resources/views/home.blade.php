<x-app-layout>
    <x-slot:title>
        Home Page
    </x-slot">

    <x-slot:header>
        Home Page
    </x-slot">

    <h1>{{ $message ?? 'Hello' }}, world{{ $exclamation }}</h1>
</x-app-layout>
