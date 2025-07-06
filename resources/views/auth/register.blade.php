<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Ciciloo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex min-h-screen">
    <!-- Kiri -->
    <div class="w-1/2 bg-[#071739] flex items-center justify-center">
        <div class="text-center">
            <img src="/assets/image/logo.svg" alt="Ciciloo Logo" class="h-30 mb-4 mx-auto">
        </div>
    </div>

    <!-- Kanan -->
    <div class="w-1/2 bg-[#fdfcf9] flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-[#071739]">Create Account<br> <span class="text-3xl">Sign up</span></h2>
                <p class="text-sm text-gray-500">Already have an account? <a href="{{ route('login') }}" class="text-[#4B6382] font-semibold">Sign in</a></p>
            </div>

            @if ($errors->any())
                <div class="text-red-500 text-sm mb-3">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]" required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]" required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]" required>
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-[#4B6382] text-white py-2 rounded-md shadow hover:bg-[#3a526e] transition">
                        Sign up
                    </button>
                </div>
            </form>

            <div class="text-center my-4 text-sm text-gray-500">OR</div>

            <!-- Social -->
            <div class="flex justify-center gap-4">
                <button class="flex items-center gap-2 border rounded-md px-4 py-2 text-sm hover:bg-gray-100">
                    <img src="/assets/icons/google.svg" class="w-5 h-5"> Google
                </button>
                <button class="w-9 h-9 flex items-center justify-center border rounded-md hover:bg-gray-100">
                    <img src="/assets/icons/facebook.svg" class="w-5 h-5">
                </button>
                <button class="w-9 h-9 flex items-center justify-center border rounded-md hover:bg-gray-100">
                    <img src="/assets/icons/apple.svg" class="w-5 h-5">
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
