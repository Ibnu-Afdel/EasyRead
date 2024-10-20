{{--<x-layout>--}}
{{--    @section('title', 'Owner')--}}
{{--    @section('heading')--}}
{{--        Owner--}}
{{--    @endsection--}}
{{--</x-layout>--}}

{{--<div class="container mx-auto mt-8">--}}
{{--    <h1 class="text-3xl font-bold text-center mb-6">Edit Profile</h1>--}}

{{--    @if (session('status'))--}}
{{--        <div class="bg-green-200 text-green-700 p-4 rounded-md mb-4">--}}
{{--            {{ session('status') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{ route('owner.profile.update') }}" method="POST" class="max-w-md mx-auto">--}}
{{--        @csrf--}}

{{--        <div class="mb-4">--}}
{{--            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>--}}
{{--            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}
{{--            @error('email')--}}
{{--            <span class="text-red-500 text-sm">{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <div class="mb-4">--}}
{{--            <label for="password" class="block text-gray-700 font-bold mb-2">New Password (Leave blank if you don't want to change)</label>--}}
{{--            <input type="password" id="password" name="password" class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}
{{--            @error('password')--}}
{{--            <span class="text-red-500 text-sm">{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <div class="mb-4">--}}
{{--            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>--}}
{{--            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}
{{--        </div>--}}

{{--        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded-md hover:bg-blue-600">Update Profile</button>--}}
{{--    </form>--}}
{{--</div>--}}






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
