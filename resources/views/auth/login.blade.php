<x-guest-layout>
    <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
        <div class="w-full max-w-md">
          <x-logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
          <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="px-10 py-12">
              <h1 class="text-center text-3xl font-bold">Welcome Back!</h1>
              <div class="mt-6 mx-auto w-24 border-b-2"></div>
              <x-text-input name="email" value="johndoe@example.com" error="email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
              <x-text-input name="password" value="secret" class="mt-6" label="Password" type="password" />
              <label class="flex items-center mt-6 select-none" for="remember">
                <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
                <span class="text-sm">Remember Me</span>
              </label>
            </div>
            <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
              <button class="bg-indigo-600 btn-indigo ml-auto" type="submit">Login</button>
            </div>
          </form>
    </div>
</x-guest-layout>