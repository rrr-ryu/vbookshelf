<x-app-layout>
  <x-slot name="header">
    <div class="space-x-8 -my-px ml-10 flex">
      <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
          本一覧
      </x-nav-link>
      <x-nav-link :href="route('books.create')" :active="request()->routeIs('books.create')">
          本を登録
      </x-nav-link>
      <x-nav-link :href="route('shelves.show', ['shelf' => $shelf->id ])" :active="request()->routeIs('shelves.show')">
          本棚を見る
      </x-nav-link>
    </div>
  </x-slot>
    {{-- フラッシュメッセージ始まり --}}
  {{-- 成功の時 --}}
  @if (session('successMessage'))
    <div class="alert alert-success text-center text-sm p-1 bg-green-200">
      {{ session('successMessage') }}
    </div> 
  @endif
  {{-- 失敗の時 --}}
  @if (session('errorMessage'))
    <div class="alert alert-danger text-center text-sm p-1 bg-red-400">
      {{ session('errorMessage') }}
    </div> 
  @endif
  <div class="min-h-screen flex flex-col p-6 sm:justify-center items-center pt-6 sm:pt-0">
  <form method="POST" action="{{ route('books.store') }}">
      @csrf

      <!-- Name -->
      <div>
          <x-input-label for="title" :value="__('Title')"/>
          <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
          <x-input-error :messages="$errors->get('title')" class="mt-1" />
      </div>

      <!-- Url -->
      <div class="mt-2">
          <x-input-label for="url" :value="__('Url')" />
          <x-text-input id="url" class="block mt-1 w-full" type="url" name="url" :value="old('url')" required />
          <x-input-error :messages="$errors->get('url')" class="mt-1" />
      </div>

      <!-- Type -->
      <div class="mt-2">
        <x-input-label for="type_id" :value="__('Type')" />
        <select name="type_id" id="type_id" class="w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          @foreach ($types as $type )
          <option value="{{ $type->id}}" >
            {{ $type->name }}
           </option>
          @endforeach
          </select>
        <x-input-error :messages="$errors->get('type')" class="mt-1" />
      </div>

      <!-- SiteName -->
      <div class="mt-2">
        <x-input-label for="site_name_id" :value="__('SiteName')" />
        <select name="site_name_id" id="site_name_id" class="w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          @foreach ($siteNames as $siteName )
          <option value="{{ $siteName->id}}" >
            {{ $siteName->name }}
           </option>
          @endforeach
          </select>
        <x-input-error :messages="$errors->get('siteName')" class="mt-1" />
      </div>

      <!-- Genre -->
      <div class="mt-2">
        <x-input-label for="genre_id" :value="__('Genre')" />
        <select name="genre_id" id="genre_id" class="w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          @foreach ($genres as $genre )
          <option value="{{ $genre->id}}" >
            {{ $genre->name }}
           </option>
          @endforeach
          </select>
        <x-input-error :messages="$errors->get('genre')" class="mt-1" />
      </div>

      <!-- Finish -->
      <div class="mt-2">
        <x-input-label for="finish" :value="__('Finish')" />
        <div class="w-1/2 flex justify-around text-xs">
          <div><input type="radio" name="finish" value="0" class="mt-1 mr-2" checked>未完</div>
          <div><input type="radio" name="finish" value="1" class="mt-1 mr-2" >完結</div>
        </div>        
        <x-input-error :messages="$errors->get('finish')" class="mt-1" />
      </div>  

      <!-- Page -->
      <div class="flex w-2/3 mt-1">
        <div>
          <x-input-label for="read_page" :value="__('ReadPage')"/>
          <x-text-input id="read_page" class="block mt-1 w-full" type="text" name="read_page" :value="old('read_page')" required/>
          <x-input-error :messages="$errors->get('read_page')" class="mt-1" />
        </div>
        <div class="block font-medium text-xs md:text-sm text-gray-700">
          <p>/</p>
          <p class="leading-10 text-lg mx-2">/</p>
        </div>
        <div>
            <x-input-label for="all_page" :value="__('AllPage')"/>
            <x-text-input id="all_page" class="block mt-1 w-full" type="text" name="all_page" :value="old('all_page')" required/>
            <x-input-error :messages="$errors->get('all_page')" class="mt-1" />
        </div>
      </div>
      <!-- Genre -->
      <div class="mt-2">
        <x-input-label for="assessment" :value="__('Assessment')" />
        <select name="assessment" id="assessment" class="w-1/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          <option value="0" >未読</option>
          <option value="1" >1</option>
          <option value="2" >2</option>
          <option value="3" >3</option>
          <option value="4" >4</option>
          <option value="5" >5</option>
          </select>
        <x-input-error :messages="$errors->get('assessment')" class="mt-1" />
      </div>
      <div class="flex items-center justify-around mt-4">
        <button type="button" onclick="location.href='{{ route('books.index')}}'" class="bg-gray-200 border-0 py-2 px-4 focus:outline-none hover:bg-gray-400 rounded text-xs">戻る</button>
        <x-primary-button class="ml-4">
            {{ __('Register') }}
        </x-primary-button>
        <div class="flex">
          <label for="continue_param" class="text-xs mr-1">続けて登録する</label>
          <input id="continue_param" type="checkbox" name="continue_param" value="1" checked></div>
        </div>
      </div>
  </form>
  </div>
</x-app-layout>