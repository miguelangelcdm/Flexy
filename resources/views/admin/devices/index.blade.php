<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Devices</h1>
        <a href="{{ route('devices.create') }}" class="btn btn-primary mb-4">Add Device</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Model</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr>
                            <td class="border px-4 py-2">{{ $device->id }}</td>
                            <td class="border px-4 py-2">{{ $device->name }}</td>
                            <td class="border px-4 py-2">{{ $device->model }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info mr-2">Show</a>
                                <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-primary mr-2">Edit</a>
                                <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
