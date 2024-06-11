<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Show Device</h1>

        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Name:</strong>
            <span>{{ $device->name }}</span>
        </div>
        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Model:</strong>
            <span>{{ $device->model }}</span>
        </div>
        <a href="{{ route('devices.index') }}" class="btn btn-primary">Back</a>
    </div>
</x-app-layout>
