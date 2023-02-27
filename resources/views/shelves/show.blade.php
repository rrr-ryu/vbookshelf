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

    {{-- タイトルクリックで表示するオーバーレイと内容 --}}
    <div id="overlay">
      <div id="modal">
        <div>タイトル</div>
        <div id="hidden"></div>
      </div>
    </div>
    {{-- タイトルクリックで表示するオーバーレイと内容 --}}
    
  {{-- フラッシュメッセージ始まり --}}
  {{-- 失敗の時 --}}
  @if (session('duplicatePlaceMessage'))
    <div class="alert alert-danger text-center text-sm p-1 bg-red-400">
      {{ session('duplicatePlaceMessage') }}
    </div> 
  @endif

  <div class="py-10 px-5 w-full h-screen flex flex-col md:w-1/3 md:m-auto">
    <ul id="forth_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 rounded-t-md pt-1 md:pt-4">
      {{-- 段表示 --}}
      @foreach ($group1 as $book)
        {{-- 本棚登録されている本がある場合 --}}
        @if ($book) 
        <li class="books cursor-pointer element" 
        @switch($book->book_color_id)
        @case(1)
          style="background: white"
          @break
        @case(2)
          style="background: red"
          @break
        @case(3)
          style="background: #4689FF"
          @break
        @case(4)
          style="background: yellow"
          @break
        @case(5)
          style="background: green"
          @break
        @case(6)
          style="background: pink"
          @break
        @case(7)
          style="background: gray"
        @break
        @endswitch
        >
          <span class="h-screen">{{ mb_substr($book->title, 0, 20) }}</span>
        </li>
        {{-- 本詳細表示内容 --}}
          <div class="content" style="display: none">
            <p>{{ $book->title }}</p>
            <p>ジャンル：{{ $book->genre->name}}</p>
            <p>サイト名：{{ $book->site_name->name}}</p>
            <p>ページ数：{{ $book->all_page}}</p>
              <form class="flex" method="POST" action="{{ route('books.color_update', ['book' => $book->id ]) }}">
                @csrf
                @method("PUT")
                <label class="mr-2" for="book_color_id">本の色</label>
                <select name="book_color_id" id="book_color_id" class="w-2/5 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                  @foreach ($book_colors as $book_color )
                  <option value="{{ $book_color->id}}" >
                    {{ $book_color->name }}
                   </option>
                  @endforeach
                </select>
                <button class="border p-1 rounded-md bg-indigo-200" type="submit">変更する</button>
              </form>
              <form class="flex" method="POST" action="{{ route('shelves.place_update', ['shelf' => $shelf ]) }}">
                @csrf
                @method("PUT")
                <label class="mr-2" for="bookshelf_place_num">本の場所</label>
                <select name="bookshelf_place_num" id="bookshelf_place_num" class="w-2/5 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                  @for ($i = 1; $i <= 48; $i++)
                  <option value="{{ $i }}" >{{ $i }}</option>
                  @endfor
                </select>
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button class="border p-1 rounded-md bg-indigo-200" type="submit">変更する</button>
              </form>
            <a class="text-indigo-600" target="_blank" href="{{ $book->url }}">読みに行く</a>
          </div>
        {{-- /本詳細表示内容 --}}
        {{-- /本棚登録されている本がある場合 --}}

        {{-- 本がない場合 --}}
        @else
          <li class="books"></li>
        @endif
        {{-- /本がない場合 --}}

      @endforeach
      {{-- /段表示 --}}

    </ul>
    <ul id="third_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
      @foreach ($group2 as $book)
      @if ($book) 
      <li class="books cursor-pointer element" 
      @switch($book->book_color_id)
      @case(1)
        style="background: white"
        @break
      @case(2)
        style="background: red"
        @break
      @case(3)
        style="background: #4689FF"
        @break
      @case(4)
        style="background: yellow"
        @break
      @case(5)
        style="background: green"
        @break
      @case(6)
        style="background: pink"
        @break
      @case(7)
        style="background: gray"
      @break
      @endswitch
      ><span class="h-screen">{{ mb_substr($book->title, 0, 20) }}</span></li>
        <div class="content" style="display: none">
          <p>{{ $book->title }}</p>
          <p>ジャンル：{{ $book->genre->name}}</p>
          <p>サイト名：{{ $book->site_name->name}}</p>
          <p>ページ数：{{ $book->all_page}}</p>
            <form class="flex" method="POST" action="{{ route('books.color_update', ['book' => $book->id ]) }}">
              @csrf
              @method("PUT")
              <label class="mr-2" for="book_color_id">本の色</label>
              <select name="book_color_id" id="book_color_id" class="w-2/5 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                @foreach ($book_colors as $book_color )
                <option value="{{ $book_color->id}}" >
                  {{ $book_color->name }}
                 </option>
                @endforeach
              </select>
              <button class="border p-1 rounded-md bg-indigo-200" type="submit">変更する</button>
            </form>
          <a class="text-indigo-600" target="_blank" href="{{ $book->url }}">読みに行く</a>
        </div>
      @else
        <li class="books"></li>
      @endif
    @endforeach
    </ul>
    <ul id="second_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
      @foreach ($group3 as $book)
      @if ($book) 
      <li class="books cursor-pointer element" 
      @switch($book->book_color_id)
      @case(1)
        style="background: white"
        @break
      @case(2)
        style="background: red"
        @break
      @case(3)
        style="background: #4689FF"
        @break
      @case(4)
        style="background: yellow"
        @break
      @case(5)
        style="background: green"
        @break
      @case(6)
        style="background: pink"
        @break
      @case(7)
        style="background: gray"
      @break
      @endswitch
      ><span class="h-screen">{{ mb_substr($book->title, 0, 20) }}</span></li>
        <div class="content" style="display: none">
          <p>{{ $book->title }}</p>
          <p>ジャンル：{{ $book->genre->name}}</p>
          <p>サイト名：{{ $book->site_name->name}}</p>
          <p>ページ数：{{ $book->all_page}}</p>
            <form class="flex" method="POST" action="{{ route('books.color_update', ['book' => $book->id ]) }}">
              @csrf
              @method("PUT")
              <label class="mr-2" for="book_color_id">本の色</label>
              <select name="book_color_id" id="book_color_id" class="w-2/5 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                @foreach ($book_colors as $book_color )
                <option value="{{ $book_color->id}}" >
                  {{ $book_color->name }}
                 </option>
                @endforeach
              </select>
              <button class="border p-1 rounded-md bg-indigo-200" type="submit">変更する</button>
            </form>
          <a class="text-indigo-600" target="_blank" href="{{ $book->url }}">読みに行く</a>
        </div>
      @else
        <li class="books"></li>
      @endif
    @endforeach
    </ul>
    <ul id="first_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 rounded-b-md pt-1 md:pt-4">
      @foreach ($group4 as $book)
      @if ($book) 
      <li class="books cursor-pointer element" 
      @switch($book->book_color_id)
      @case(1)
        style="background: white"
        @break
      @case(2)
        style="background: red"
        @break
      @case(3)
        style="background: #4689FF"
        @break
      @case(4)
        style="background: yellow"
        @break
      @case(5)
        style="background: green"
        @break
      @case(6)
        style="background: pink"
        @break
      @case(7)
        style="background: gray"
      @break
      @endswitch
      ><span class="h-screen">{{ mb_substr($book->title, 0, 20) }}</span></li>
        <div class="content" style="display: none">
          <p>{{ $book->title }}</p>
          <p>ジャンル：{{ $book->genre->name}}</p>
          <p>サイト名：{{ $book->site_name->name}}</p>
          <p>ページ数：{{ $book->all_page}}</p>
            <form class="flex" method="POST" action="{{ route('books.color_update', ['book' => $book->id ]) }}">
              @csrf
              @method("PUT")
              <label class="mr-2" for="book_color_id">本の色</label>
              <select name="book_color_id" id="book_color_id" class="w-2/5 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                @foreach ($book_colors as $book_color )
                <option value="{{ $book_color->id}}" >
                  {{ $book_color->name }}
                 </option>
                @endforeach
              </select>
              <button class="border p-1 rounded-md bg-indigo-200" type="submit">変更する</button>
            </form>
          <a class="text-indigo-600" target="_blank" href="{{ $book->url }}">読みに行く</a>
        </div>
      @else
        <li class="books"></li>
      @endif
    @endforeach
     </ul>
  </div>
</x-app-layout>

<script>
  const elements = document.getElementsByClassName('element');
  const overlay = document.querySelector('#overlay');
  const modal = document.querySelector('#modal');
  const hidden = document.querySelector('#hidden');
  const content = document.getElementsByClassName('content');


  for (let i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', function() {
      hidden.innerHTML = content[i].innerHTML;
      overlay.style.display = 'flex';
    });
  }
  
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.style.display = 'none';
    }
  });
</script>