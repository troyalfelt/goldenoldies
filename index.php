<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Home</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
    <div class="sm:text-center lg:text-left">
      <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
        <span class="block xl:line">Welcome to Golden Oldies</span><br>
        <span class="block xl:inline">Please Sign in</span>
        <span class="block text-yellow-400 xl:inline">or Register</span>
      </h1>
      <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:items-center">
        <div class="rounded-md shadow">
          <a href="login.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Login
          </a>
        </div>
        <div class="mt-3 sm:mt-0 sm:ml-3">
          <a href="register.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 md:py-4 md:text-lg md:px-10">
              Register
          </a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>