<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Penerbit Yaguwipa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-slate-200">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-slate-800">Penerbit Yaguwipa</h2>
            <p class="text-gray-500 text-sm mt-1">@lang('admin.login_subtitle')</p>
        </div>

        {{-- Menampilkan pesan error global --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST" class="space-y-4">
            @csrf
            
            {{-- Input Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.login_label_username')</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-slate-500 focus:border-slate-500 outline-none text-sm" 
                       placeholder="@lang('admin.login_username_placeholder')">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.login_label_password')</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-slate-500 focus:border-slate-500 outline-none text-sm" 
                       placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2.5 rounded-lg transition duration-200 text-sm shadow-md">
                @lang('admin.login_button')
            </button>
        </form>
    </div>

</body>
</html>