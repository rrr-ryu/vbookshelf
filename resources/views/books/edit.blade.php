<x-guest-layout>
  <form method="POST" action="{{ route('books.update', ['book' => $book->id ]) }}">
      @csrf
      @method("PUT")

      <!-- Name -->
      <div>
          <x-input-label for="title" :value="__('Title')"/>
          <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $book->title }}" required autofocus />
          <x-input-error :messages="$errors->get('title')" class="mt-1" />
      </div>

      <!-- Url -->
      <div class="mt-2">
          <x-input-label for="url" :value="__('Url')" />
          <x-text-input id="url" class="block mt-1 w-full" type="url" name="url" value="{{ $book->url }}" required />
          <x-input-error :messages="$errors->get('url')" class="mt-1" />
      </div>

      <!-- Type -->
      <div class="mt-2">
        <x-input-label for="type_id" :value="__('Type')" />
        <select name="type_id" id="type_id" class="w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          @foreach ($types as $type )
          <option value="{{ $type->id}}" @if( $book->type_id === $type->id ) selected @endif >
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
          <option value="{{ $siteName->id}}" @if( $book->site_name_id === $siteName->id ) selected @endif>
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
          <option value="{{ $genre->id}}" @if( $book->genre_id === $genre->id ) selected @endif>
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
          <div><input type="radio" name="finish" value="0" class="mt-1 mr-2" @if( $book->finish === 0 ) checked @endif>未完</div>
          <div><input type="radio" name="finish" value="1" class="mt-1 mr-2" @if( $book->finish === 1 ) checked @endif>完結</div>
        </div>        
        <x-input-error :messages="$errors->get('finish')" class="mt-1" />
      </div>  

      <!-- Page -->
      <div class="flex w-1/2 mt-1">
        <div>
          <x-input-label for="read_page" :value="__('ReadPage')"/>
          <x-text-input id="read_page" class="block mt-1 w-4/5" type="text" name="read_page" value="{{ $book->read_page }}" required/>
          <x-input-error :messages="$errors->get('read_page')" class="mt-1" />
        </div>
        <div class="block font-medium text-xs md:text-sm text-gray-700">
          <p>/</p>
          <p class="text-lg mr-2">/</p>
        </div>
        <div>
            <x-input-label for="all_page" :value="__('AllPage')"/>
            <x-text-input id="all_page" class="block mt-1 w-4/5" type="text" name="all_page" value="{{ $book->all_page }}" required/>
            <x-input-error :messages="$errors->get('all_page')" class="mt-1" />
        </div>
      </div>
      <!-- Genre -->
      <div class="mt-2">
        <x-input-label for="assessment" :value="__('Assessment')" />
        <select name="assessment" id="assessment" class="w-1/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
          <option value="0" @if ($book->assessment === null) selected @endif >未読</option>
          <option value="1" @if ($book->assessment === 1) selected @endif >1</option>
          <option value="2" @if ($book->assessment === 2) selected @endif >2</option>
          <option value="3" @if ($book->assessment === 3) selected @endif >3</option>
          <option value="4" @if ($book->assessment === 4) selected @endif >4</option>
          <option value="5" @if ($book->assessment === 5) selected @endif >5</option>
          </select>
        <x-input-error :messages="$errors->get('assessment')" class="mt-1" />
      </div>
      <div class="flex items-center justify-around mt-4">
        <button type="button" onclick="window.history.back()" class="bg-gray-200 border-0 py-2 px-4 focus:outline-none hover:bg-gray-400 rounded text-xs">戻る</button>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
          @csrf
          @method('PUT')
          <button class="bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-400 rounded text-xs text-white" type="submit">変更</button>
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded text-xs text-white" onclick="deletePost(this)" type="submit">削除</button>
        </form>
      </div>
  </form>
</x-guest-layout>

<script>
  function deletePost(e) {
    'user strict';
    if (confirm('削除しますか？')){
      document.getElementById('delete_'+e.delete.id).submit();
    }
  }
</script>
