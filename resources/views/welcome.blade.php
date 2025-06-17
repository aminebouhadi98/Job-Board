<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobBoard - Trova e pubblica offerte di lavoro</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 50%, #bae6fd 100%);
            transition: background 0.7s;
        }

        .welcome-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem 2rem;
            max-width: 480px;
            margin: 0 auto;
            margin-top: 4rem;
            animation: fade-in 1s;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .welcome-desc {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .welcome-btn {
            background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 8px 0 rgba(37, 99, 235, 0.10);
            transition: background 0.3s, transform 0.2s;
        }

        .welcome-btn:hover {
            background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
            transform: translateY(-2px) scale(1.03);
        }

        @media (max-width: 600px) {
            .welcome-card {
                padding: 2rem 1rem;
            }

            .welcome-title {
                font-size: 2rem;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal">Dashboard</a>
            @else
            <a href="{{ route('login') }}"
                class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal">Log
                in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
            <div
                class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <div class="welcome-card">
                    <h1 class="welcome-title">Benvenuto su JobBoard!</h1>
                    <p class="welcome-desc">Trova e pubblica offerte di lavoro in modo semplice e veloce.<br>Inizia subito
                        la tua ricerca o pubblica un annuncio!</p>
                    <div class="flex gap-4 mt-8 justify-center">
                        <a href="{{ route('public.jobs.index') }}" class="welcome-btn">Cerca offerte</a>
                        @if (!auth()->user())
                        <a href="{{ route('register') }}"
                            class="welcome-btn bg-gradient-to-r from-gray-200 to-blue-100 text-blue-700 border border-blue-200">Registrati</a>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
