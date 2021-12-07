<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Admin</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
        </div>
      </div>
    </div>
</nav>
<main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
    <div class="sm:text-center lg:text-left">
      <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
        <span class="block xl:line">Welcome Admin</span><br>
      </h1>
      <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:items-center">
        <div class="rounded-md shadow">
          <a href="approval.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Approval
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="employee.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Employees
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="info.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Patient Info
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="new-roster.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            New Roster
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="report.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Reports
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="roles.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Roles
          </a>
        </div>
      </div>
      <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:items-center">
        <div class="rounded-md shadow">
          <a href="../caregiver/home.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Caregiver Home
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../patients.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Patients
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../doctor/home.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Doctor's Home
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../doctor/appt.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Doctor Appointments
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../doctor/appt.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Doctor's Patient
          </a>
        </div>
      </div>
      <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:items-center">
        <div class="rounded-md shadow">
          <a href="../roster.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Roster
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="payment.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Payment
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../family.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Family Member
          </a>
        </div>
        <div class="rounded-md shadow">
          <a href="../patient/home.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-400 bg-gray-900 hover:bg-gray-400 md:py-4 md:text-lg md:px-10">
            Patient Home
          </a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>