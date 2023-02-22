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
  {{-- 変更の時 --}}
  @if (session('updateMessage'))
  <div class="alert alert-delete text-center text-sm p-1 bg-green-400">
    {{ session('updateMessage') }}
  </div> 
  @endif
  {{-- 削除の時 --}}
  @if (session('deleteMessage'))
    <div class="alert alert-delete text-center text-sm p-1 bg-red-400">
      {{ session('deleteMessage') }}
    </div> 
  @endif
    {{-- 成功の時 --}}
  @if (session('addShelfMessage'))
  <div class="alert alert-success text-center text-sm p-1 bg-green-200">
    {{ session('addShelfMessage') }}
  </div> 
  @endif

  @if (session('overMessage'))
  <div class="alert alert-success text-center text-sm p-1 bg-red-200">
    {{ session('overMessage') }}
  </div> 
  @endif

  @if (session('duplicateMessage'))
  <div class="alert alert-success text-center text-sm p-1 bg-red-200">
    {{ session('duplicateMessage') }}
  </div> 
  @endif
  {{-- フラッシュメッセージ終わり --}}

  {{-- タイトル検索フォーム --}}
  <form action="{{ route('books.index') }}" method="get">
    <div class="form-group flex justify-center mt-2">
        <x-text-input type="text" class="inline-block md:h-10 md:w-1/2" id="title" name="title" />
        <x-primary-button class="ml-4 py-2 px-2">
          検索
      </x-primary-button>
    </div>
  </form>
  {{-- タイトル検索フォーム --}}

  {{-- 本一覧表示 --}}
  <section class="text-gray-800 bg-white body-font overflow-hidden hidden md:block">
    <div class="container px-5 py-10 mx-auto">
      <div class="-my-8">
        @foreach ( $books as $book )
        <div class="flex mb-2 py-2 border-b-2 z-0">
          <div class="container">
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-around text-base md:text-sm ">
              <div class="element text-indigo-600 flex-auto h-6 overflow-hidden font-semibold text-lg basis-8/12 cursor-pointer">{{ $book->title }}</div>
              <div class="basis-1/12 text-end leading-7">{{ $book->read_page }}</div>
              <div class="leading-7">/</div>
              <div class="basis-1/12 leading-7">{{ $book->all_page }}p</div>
              <div class="basis-1/12 text-center leading-7 border">読む</div>
            </div>
            <div class="flex mb-1 flex-nowrap justify-between text-sm text-center">
              <div class="basis-1/12 border">{{ $book->type->name }}</div>
              <div class="basis-2/12 border">{{ $book->site_name->name }}</div>
              <div class="basis-2/12 border">{{ $book->genre->name }}</div>
              @if ($book->finish === 0)
              <div class="basis-1/12 border">未完</div>
              @elseif ($book->finish === 1)
              <div class="basis-1/12 border">完結</div>
              @endif
              <div class="basis-2/12 border flex text-center">
                <div class="flex-1">評価値:</div>
                <div class="flex-1 flex">
                  @switch($book->assessment)
                    @case(0)
                      <p class="star1">☆</p><p class="star2">☆</p><p class="star3">☆</p><p class="star4">☆</p><p class="star5">☆</p>
                      @break
                    @case(1)
                      <p class="star1 text-yellow-300">★</p><p class="star2">☆</p><p class="star3">☆</p><p id="star4">☆</p><p class="star5">☆</p>
                      @break
                    @case(2)
                      <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3">☆</p><p id="star4">☆</p><p class="star5">☆</p>
                      @break
                    @case(3)
                      <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4">☆</p><p class="star5">☆</p>
                      @break
                    @case(4)
                    <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4" class="text-yellow-300">★</p><p class="star5">☆</p>
                      @break
                    @case(5)
                    <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4" class="text-yellow-300">★</p><p class="star5 text-yellow-300">★</p>
                      @break
                  @endswitch
                </div>
              </div>
              <a class="basis-1/12 border" href="{{ route('books.edit', ['book' => $book->id ])}}">編集</a>
              {{-- 本棚に登録するボタン --}}
              <form class="bookshelf_add_form basis-2/12 border" method="POST" action="{{ route('bookshelves.store')}}">
                @csrf
                <input class="hidden" name="book_id" type="text" value="{{ $book->id }}">
                <button class="shelf_submit" type="submit">本棚に追加</button>
              </form>
              {{-- 本棚に登録するボタン --}}
            </div>
            <div class="flex flex-nowrap justify-around md:hidden text-xs md:text-base text-center">
              <div class="basis-2/6 border">{{ $book->site_name->name }}</div>
              <div class="basis-1/6 text-end">{{ $book->read_page }}</div>
              <div class="md:hidden">/</div>
              <div class="basis-1/6 text-start">{{ $book->all_page }}p</div>
            </div>
          </div>
        </div>
        @endforeach
        {{ $books->links() }}
      </div>
    </div>


  {{-- 本一覧表示 レスポンシブ(min-764px) --}}
  </section>
  <section class="text-gray-800 bg-white body-font overflow-hidden md:hidden">
    <div class="container px-5 py-10 mx-auto">
      <div class="-my-8">
        @foreach ( $books as $book )
        <div class="flex mb-2 py-2 border-b-2 z-0">
          <div class="container">
            <div class="flex flex-wrap mb-1 justify-around text-base">
              <div class="element text-indigo-600 flex-auto h-6 overflow-hidden font-semibold md:text-lg md:basis-8/12 cursor-pointer">{{ $book->title }}</div>
            </div>
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-between text-xs md:text-sm text-center">
              <div class="basis-1/6 border">{{ $book->type->name }}</div>
              <div class="basis-2/6 border">{{ $book->genre->name }}</div>
              @if ($book->finish === 0)
              <div class="basis-1/6 border">未完</div>
              @elseif ($book->finish === 1)
              <div class="basis-1/6 border">完結</div>
              @endif
              <div class="basis-2/6 flex justify-center">
                @switch($book->assessment)
                @case(0)
                  <p class="star1">☆</p><p class="star2">☆</p><p class="star3">☆</p><p class="star4">☆</p><p class="star5">☆</p>
                  @break
                @case(1)
                  <p class="star1 text-yellow-300">★</p><p class="star2">☆</p><p class="star3">☆</p><p id="star4">☆</p><p class="star5">☆</p>
                  @break
                @case(2)
                  <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3">☆</p><p id="star4">☆</p><p class="star5">☆</p>
                  @break
                @case(3)
                  <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4">☆</p><p class="star5">☆</p>
                  @break
                @case(4)
                <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4" class="text-yellow-300">★</p><p class="star5">☆</p>
                  @break
                @case(5)
                <p class="star1 text-yellow-300">★</p><p class="star2 text-yellow-300">★</p><p class="star3 text-yellow-300">★</p><p id="star4" class="text-yellow-300">★</p><p class="star5 text-yellow-300">★</p>
                  @break
              @endswitch
              </div>
            </div>
            <div class="flex flex-nowrap justify-around text-xs text-center">
              <div class="basis-2/6 border">{{ $book->site_name->name }}</div>
              <div class="basis-1/6 text-end">{{ $book->read_page }}</div>
              <div>/</div>
              <div class="basis-1/6 text-start">{{ $book->all_page }}p</div>
              <form class="basis-2/6 border" method="POST" action="{{ route('bookshelves.store')}}">
                @csrf
                <input class="hidden" name="book_id" type="text" value="{{ $book->id }}">
                <button class="shelf_submit" type="submit">本棚に追加</button>
              </form>
            </div>
          </div>
          <div class="text-center text-xs flex flex-col basis-12 ml-2">
            <a class="mb-2 leading-7 border" target="_blank" href="{{ $book->url }}">読む</a>
            <a class="leading-7 border" href="{{ route('books.edit', ['book' => $book->id ])}}">編集</a>
          </div>
        </div>
        @endforeach
        {{ $books->links() }}
      </div>
    </div>
  </section>
</x-app-layout>

<script>
  // ポップアップ動作
  const elements = document.getElementsByClassName('element');
  const overlay = document.querySelector('#overlay');
  const modal = document.querySelector('#modal')
  const hidden = document.querySelector('#hidden')
  
  for (let i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', function() {
      hidden.innerHTML = this.innerHTML;
      overlay.style.display = 'flex';
    });
  }
  
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.style.display = 'none';
    }
  });
</script>
