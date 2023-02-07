<x-app-layout>
  <x-slot name="header">
    <div class="space-x-8 -my-px ml-10 flex md:hidden">
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

  <div class="py-10 px-5 w-full h-screen flex flex-col md:w-1/3">
    <ul id="forth_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 rounded-t-md pt-1 md:pt-4">
      @foreach ($group1 as $book)
        @if ($book) 
          <li class="books element" style="background: aqua "><span class="h-screen">{{ $book->title }}</span></li>
          <div class="content" style="display: none">
            <p>{{ $book->title }}</p>
            <p>ジャンル：{{ $book->genre->name}}</p>
            <p>サイト名：{{ $book->site_name->name}}</p>
            <p>ページ数：{{ $book->all_page}}</p>
            <a class="text-indigo-600" href="{{ $book->url }}">読みに行く</a>
          </div>
        @else
          <li class="books"></li>
        @endif
      @endforeach
    </ul>
    <ul id="third_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
      @foreach ($group2 as $book)
      @if ($book) 
        <li class="books" style="background: aqua "><span class="h-screen">{{ $book->title }}</span></li>
      @else
        <li class="books"></li>
      @endif
    @endforeach
    </ul>
    <ul id="second_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
      @foreach ($group3 as $book)
      @if ($book) 
        <li class="books" style="background: aqua "><span class="h-screen">{{ $book->title }}</span></li>
      @else
        <li class="books"></li>
      @endif
    @endforeach
    </ul>
    <ul id="first_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 rounded-b-md pt-1 md:pt-4">
      @foreach ($group4 as $book)
      @if ($book) 
        <li class="books" style="background: aqua "><span class="h-screen">{{ $book->title }}</span></li>
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