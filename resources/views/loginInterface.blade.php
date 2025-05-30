<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
     <script src="https://cdn.tailwindcss.com"></script>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .bg-custom {
            background-image: url('../images/pharmloginpic.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        
        .backdrop-blur-custom {
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-custom min-h-screen flex items-center justify-center font-sans">
    
    
    <!-- Error Messages -->
    @if($errors->any())
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50">
            @foreach($errors->all() as $error)
                <div class="text-sm mb-1 last:mb-0">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <!-- Login Form -->
    <div class="bg-transparent border border-stone-800 rounded-3xl p-8 w-80 backdrop-blur-custom shadow-lg">
        <form action="{{ route('login') }}" method="POST">
            <fieldset class="border-0">
                @csrf
                <!-- logo -->
                <img src="{{ asset('images/tiryaqilogo.png') }}" class="w-[170px] mx-auto" alt="Logo">                <!-- Email Input -->
                <div class="relative mb-6">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Enter your Email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full h-12 rounded-full text-sm px-5 pr-12 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-600 @error('email') border-red-500 @enderror"
                    >
                    <i class='bx bxs-user absolute right-4 top-3 text-green-900 text-xl'></i>
                </div>
                
                <!-- Password Input -->
                <div class="relative mb-4">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Enter your Password" 
                        required
                        class="w-full h-12 rounded-full text-sm px-5 pr-12 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-600 @error('password') border-red-500 @enderror"
                    >
                    <i class='bx bxs-lock-alt absolute right-4 top-3 text-green-900 text-xl'></i>
                </div>
                
                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-[50%] h-12 bg-green-900 hover:bg-green-800 text-white font-semibold rounded-full transition-colors duration-200 mx-auto block"
                >
                    Log in
                </button>
                                
            </fieldset>
        </form>
    </div>
</body>
</html>