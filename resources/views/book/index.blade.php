<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-sm text-gray-800 leading-tight">
        本一覧
    </h2>
  </x-slot>
  <section class="text-gray-800 bg-white body-font overflow-hidden">
    <div class="container px-5 py-10 mx-auto">
      <div class="-my-8">
        @foreach ( $books as $book )
        <div class="flex mb-2 border-b-2">
          <div class="container">
            <div class="flex flex-wrap  md:flex-nowrap justify-around text-xs md:text-base">
              <div class="basis-1/6 md:basis-1/12 border">{{ $book->type->name }}</div>
              <div class="hidden md:basis-2/12 md:block">{{ $book->site_name->name }}</div>
              <div class="basis-2/6 md:basis-2/12">{{ $book->genre->name }}</div>
              <div class="basis-1/6 md:basis-1/12">完結</div>
              <div class="hidden md:basis-1/12 md:block">評価値</div>
              <div class="basis-2/6 md:basis-2/12">☆☆☆☆☆</div>
              <div class="hidden md:basis-1/12 md:block">読む</div>
              <div class="hidden md:basis-1/12 md:block">本棚に追加</div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap justify-around text-base">
              <div class="flex-auto font-semibold md:basis-8/12">{{ $book->title }}</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->read_page }}</div>
              <div class="hidden md:block">/</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->all_page }}p</div>
              <div class="hidden md:basis-1/12 md:block">編集</div>
            </div>
            <div class="flex flex-nowrap justify-around md:hidden text-xs md:text-base">
              <div class="basis-2/6">{{ $book->site_name->name }}</div>
              <div class="basis-1/6">{{ $book->read_page }}</div>
              <div class="md:hidden">/</div>
              <div class="basis-1/6">{{ $book->all_page }}</div>
              <div class="basis-2/6">本棚へ追加</div>
            </div>
          </div>
          <div class="md:hidden">
            <a href="#">読む</a>
          </div>
        </div>
        @endforeach
        @foreach ( $books as $book )
        <div class="flex mb-2 border-b-2">
          <div class="container">
            <div class="flex flex-wrap  md:flex-nowrap justify-around text-xs md:text-base">
              <div class="basis-1/6 md:basis-1/12 border">{{ $book->type->name }}</div>
              <div class="hidden md:basis-2/12 md:block">{{ $book->site_name->name }}</div>
              <div class="basis-2/6 md:basis-2/12">{{ $book->genre->name }}</div>
              <div class="basis-1/6 md:basis-1/12">完結</div>
              <div class="hidden md:basis-1/12 md:block">評価値</div>
              <div class="basis-2/6 md:basis-2/12">☆☆☆☆☆</div>
              <div class="hidden md:basis-1/12 md:block">読む</div>
              <div class="hidden md:basis-1/12 md:block">本棚に追加</div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap justify-around text-base">
              <div class="flex-auto font-semibold md:basis-8/12">{{ $book->title }}</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->read_page }}</div>
              <div class="hidden md:block">/</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->all_page }}p</div>
              <div class="hidden md:basis-1/12 md:block">編集</div>
            </div>
            <div class="flex flex-nowrap justify-around md:hidden text-xs md:text-base">
              <div class="basis-2/6">{{ $book->site_name->name }}</div>
              <div class="basis-1/6">{{ $book->read_page }}</div>
              <div class="md:hidden">/</div>
              <div class="basis-1/6">{{ $book->all_page }}</div>
              <div class="basis-2/6">本棚へ追加</div>
            </div>
          </div>
          <div class="md:hidden">
            <a href="#">読む</a>
          </div>
        </div>
        @endforeach
        @foreach ( $books as $book )
        <div class="flex mb-2 border-b-2">
          <div class="container">
            <div class="flex flex-wrap  md:flex-nowrap justify-around text-xs md:text-base">
              <div class="basis-1/6 md:basis-1/12 border">{{ $book->type->name }}</div>
              <div class="hidden md:basis-2/12 md:block">{{ $book->site_name->name }}</div>
              <div class="basis-2/6 md:basis-2/12">{{ $book->genre->name }}</div>
              <div class="basis-1/6 md:basis-1/12">完結</div>
              <div class="hidden md:basis-1/12 md:block">評価値</div>
              <div class="basis-2/6 md:basis-2/12">☆☆☆☆☆</div>
              <div class="hidden md:basis-1/12 md:block">読む</div>
              <div class="hidden md:basis-1/12 md:block">本棚に追加</div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap justify-around text-base">
              <div class="flex-auto font-semibold md:basis-8/12">{{ $book->title }}</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->read_page }}</div>
              <div class="hidden md:block">/</div>
              <div class="hidden md:basis-1/12 md:block">{{ $book->all_page }}p</div>
              <div class="hidden md:basis-1/12 md:block">編集</div>
            </div>
            <div class="flex flex-nowrap justify-around md:hidden text-xs md:text-base">
              <div class="basis-2/6">{{ $book->site_name->name }}</div>
              <div class="basis-1/6">{{ $book->read_page }}</div>
              <div class="md:hidden">/</div>
              <div class="basis-1/6">{{ $book->all_page }}</div>
              <div class="basis-2/6">本棚へ追加</div>
            </div>
          </div>
          <div class="md:hidden">
            <a href="#">読む</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
</x-app-layout>