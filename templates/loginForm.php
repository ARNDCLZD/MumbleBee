<div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="border-noir-800">
      <div>
        <div class="text-noir-800"><?php readfile(getcwd().'/templates/header/logo.html'); ?></div>
        <p class="mt-2 text-center text-noir-800">
          Pas encore
          <a href="#" class="font-bold text-noir-800 hover:text-jaune-600">
            enregistré 
          </a>
          ?
        </p>
      </div>
      <form class="mt-8 space-y-6" action="#" method="POST">
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <input id="username" name="email" type="login" required class="appearance-none bg-jaune-300 rounded-none relative block w-full px-3 py-2 border border-noir-800 placeholder-noir-800 text-noir-800 rounded-t-md focus:outline-none focus:ring-jaune-600 focus:border-jaune-600 focus:z-10 sm:text-sm" placeholder="Nom d'utilisateur">
          </div>
          <div>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none bg-jaune-300 rounded-none relative block w-full px-3 py-2 border border-noir-800 placeholder-noir-800 text-noir-800 rounded-b-md focus:outline-none focus:ring-jaune-600 focus:border-jaune-600  focus:z-10 sm:text-sm" placeholder="Mot de passe">
          </div>
        </div> 
        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-jaune-300 font-bold bg-noir-800 transition duration-400 ease-in-out hover:border-noir-800 hover:bg-jaune-300 hover:text-noir-800">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <!-- Heroicon name: lock-closed -->
              <svg class="h-5 w-5 text-jaune-300 transition duration-400 group-hover:text-noir-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </span>
            Connexion
          </button>
        </div>
      </form>
    </div>
  </div>