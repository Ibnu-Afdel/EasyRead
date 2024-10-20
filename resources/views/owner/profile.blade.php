<x-layout>
    @section('title', 'Owner')
    @section('heading')
        Owner
    @endsection
</x-layout>

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-6">Edit Profile</h1>

    @if (session('status'))
        <div class="bg-green-200 text-green-700 p-4 rounded-md mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('owner.profile.update') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 bg-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">New Password (Leave blank if you don't want to change)</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 bg-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
            <span class="text="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 bg-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded-md hover:bg-blue-600">Update Profile</button>
    </form>
</div>

<table class="w-full border-collapse">
    <thead>
    <tr>
        <th class="border p-2">Name</th>
        <th class="border p-2">Role</th>
        <th class="border p-2">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td class="border p-2">{{ $user->name }}</td>
            <td class="border p-2">{{ $user->role }}</td>
            <td class="border p-2">
                @if ($user->role !== 'admin' && $user->role !== 'librarian')
                    <form action="{{ route('users.promote', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <select name="role" class="border rounded-md px-2 py-1 bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="librarian">Librarian</option>
                        </select>
                        <button type="submit" class="bg-green-500 text-white font-bold px-4 py-2 rounded-md hover:bg-green-600">Promote</button>
                    </form>
                @endif
                @if ($user->role === 'admin' || $user->role === 'librarian')
                    <form action="{{ route('users.demote', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white font-bold px-4 py-2 rounded-md hover:bg-red-600">Demote</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
