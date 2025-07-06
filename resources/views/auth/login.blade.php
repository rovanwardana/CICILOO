<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Ciciloo</title>
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
                <h2 class="text-2xl font-bold text-[#071739]">Welcome to Ciciloo<br> <span class="text-3xl">Sign in</span></h2>
                <p class="text-sm text-gray-500">No Account? <a href="{{ route('register') }}" class="text-[#4B6382] font-semibold">Sign up</a></p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]"
                           placeholder="you@example.com" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-[#4B6382]"
                           placeholder="********" required>
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="text-[#4B6382]"> Remember me
                    </label>
                    {{-- <a href="#" class="hover:underline text-[#4B6382]">Forgot password?</a> --}}
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                            class="w-full bg-[#4B6382] text-white py-2 rounded-md shadow hover:bg-[#3a526e] transition">
                        Sign in
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