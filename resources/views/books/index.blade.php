<x-app-layout>
  <x-slot name="header">
    <div class="space-x-8 -my-px ml-10 flex md:hidden">
      <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
          本一覧
      </x-nav-link>
      <x-nav-link :href="route('books.create')" :active="request()->routeIs('books.create')">
          本を登録
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

  {{-- タイトル検索フォーム --}}
  <form action="{{ route('books.index') }}" method="get">
    <div class="form-group flex justify-center mt-2">
        <x-text-input type="text" class="inline-block" id="title" name="title" />
        <x-primary-button class="ml-4 py-2 px-2">
          検索
      </x-primary-button>
    </div>
  </form>
  {{-- タイトル検索フォーム --}}

  {{-- 本一覧表示 --}}
  <section class="text-gray-800 bg-white body-font overflow-hidden">
    <div class="container px-5 py-10 mx-auto">
      <div class="-my-8">
        @foreach ( $books as $book )
        <div class="flex mb-2 py-2 border-b-2 z-0">
          <div class="container">
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-around text-base md:text-sm ">
              <div class="element text-indigo-600 flex-auto h-6 overflow-hidden font-semibold md:text-lg md:basis-8/12 cursor-pointer">{{ $book->title }}</div>
              <div class="hidden md:basis-1/12 md:block text-end leading-7">{{ $book->read_page }}</div>
              <div class="leading-7 hidden md:block">/</div>
              <div class="hidden md:basis-1/12 md:block leading-7">{{ $book->all_page }}p</div>
              <div class="hidden md:basis-1/12 md:block text-center md:leading-7 border">読む</div>
            </div>
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-between text-xs md:text-sm text-center">
              <div class="basis-1/6 md:basis-1/12 border">{{ $book->type->name }}</div>
              <div class="hidden md:basis-2/12 md:block border">{{ $book->site_name->name }}</div>
              <div class="basis-2/6 md:basis-2/12 border">{{ $book->genre->name }}</div>
              @if ($book->finish === 0)
              <div class="basis-1/6 md:basis-1/12 border">未完</div>
              @elseif ($book->finish === 1)
              <div class="basis-1/6 md:basis-1/12 border">完結</div>
              @endif
              <div class="hidden basis-2/6 md:basis-2/12 border md:flex text-center">
                <div class="flex-1">評価値:</div>
                <div class="flex-1 flex">
                    <p class="star1 cursor-pointer">☆</p><p class="star2 cursor-pointer">☆</p><p class="star3 cursor-pointer">☆</p><p class="star4 cursor-pointer">☆</p><p class="star5 cursor-pointer">☆</p>                
                </div>
              </div>
              <div class="basis-2/6 md:basis-1/12 md:text-start hidden max-sm:block">☆☆☆☆☆</div>
              <div class="hidden md:basis-1/12 md:block border">編集</div>
              <div class="hidden md:basis-2/12 md:block border">本棚へ追加</div>
            </div>
            <div class="flex flex-nowrap justify-around md:hidden text-xs md:text-base text-center">
              <div class="basis-2/6 border">{{ $book->site_name->name }}</div>
              <div class="basis-1/6 text-end">{{ $book->read_page }}</div>
              <div class="md:hidden">/</div>
              <div class="basis-1/6 text-start">{{ $book->all_page }}p</div>
              <a class="basis-2/6 border" href="#">本棚へ追加</a>
            </div>
          </div>
          <div class="md:hidden text-center text-xs flex flex-col basis-12 ml-2">
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