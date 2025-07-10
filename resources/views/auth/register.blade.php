<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Ciciloo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #071739 0%, #0f2557 50%, #1a3a6b 100%);
            position: relative;
            overflow: hidden;
        }
        
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(75, 99, 130, 0.3) 0%, transparent 70%),
                        radial-gradient(circle at 70% 80%, rgba(26, 58, 107, 0.4) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float-shapes 15s infinite linear;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            left: 80%;
            animation-delay: -5s;
        }
        
        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 80%;
            left: 20%;
            animation-delay: -10s;
        }
        
        @keyframes float-shapes {
            0% { transform: translateY(0px) rotate(0deg); opacity: 0.7; }
            50% { transform: translateY(-100px) rotate(180deg); opacity: 0.3; }
            100% { transform: translateY(0px) rotate(360deg); opacity: 0.7; }
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        
        .input-field:focus {
            border-color: #4B6382;
            box-shadow: 0 0 0 3px rgba(75, 99, 130, 0.1);
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4B6382 0%, #3a526e 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(75, 99, 130, 0.3);
        }
        
        .logo-container {
            animation: pulse 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .checkbox-custom {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            background: white;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .checkbox-custom:checked {
            background: #4B6382;
            border-color: #4B6382;
        }
        
        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        
        .link-hover {
            position: relative;
            transition: color 0.3s ease;
        }
        
        .link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: #4B6382;
            transition: width 0.3s ease;
        }
        
        .link-hover:hover::after {
            width: 100%;
        }
        
        .logo-img {
            width: 200px;
            height: 200px;
            object-fit: contain;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Left Side -->
    <div class="w-1/2 gradient-bg flex items-center justify-center relative">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="text-center z-10 fade-in">
            <div class="logo-container mb-8">
                <img src="assets/image/logo.svg" alt="Ciciloo Logo" class="logo-img">
                <p class="text-white text-opacity-80 text-lg max-w-md mx-auto leading-relaxed">
                    Split Bills with Friends, Hassle-Free
                </p>
            </div>
        </div>
    </div>

    <!-- Right Side -->
    <div class="w-1/2 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
        <div class="w-full max-w-md form-container rounded-3xl shadow-2xl p-10 slide-in">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#071739] mb-2">Sign up</h1>
                <div class="w-12 h-1 bg-gradient-to-r from-[#4B6382] to-[#071739] rounded-full"></div>
                <p class="text-gray-600 text-sm mt-2">Create your account to get started</p>
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
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Name</label>
                    <div class="relative">
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full input-field rounded-xl px-4 py-3 text-sm bg-white placeholder-gray-400 focus:outline-none"
                               placeholder="Enter your name" required>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full input-field rounded-xl px-4 py-3

 text-sm bg-white placeholder-gray-400 focus:outline-none"
                               placeholder="Enter your email address" required>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="password"
                               class="w-full input-field rounded-xl px-4 py-3 text-sm bg-white placeholder-gray-400 focus:outline-none"
                               placeholder="Enter your password" required>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation"
                               class="w-full input-field rounded-xl px-4 py-3 text-sm bg-white placeholder-gray-400 focus:outline-none"
                               placeholder="Confirm your password" required>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="space-y-6">
                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-xl font-semibold text-sm tracking-wide relative overflow-hidden">
                        <span class="relative z-10">Sign up</span>
                    </button>
                    
                    <div class="text-center">
                        <p class="text-sm text-gray-500">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-[#4B6382] font-semibold link-hover ml-1">Sign in</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>