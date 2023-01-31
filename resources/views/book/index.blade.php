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
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-around text-base md:text-sm ">
              <div class="flex-auto h-6 overflow-hidden font-semibold md:text-lg md:basis-8/12">{{ $book->title }}</div>
              <div class="hidden md:basis-1/12 md:block text-end leading-7">{{ $book->read_page }}</div>
              <div class="leading-7 hidden md:block">/</div>
              <div class="hidden md:basis-1/12 md:block leading-7">{{ $book->all_page }}p</div>
              <div class="hidden md:basis-1/12 md:block text-center md:leading-7 border">読む</div>
            </div>
            <div class="flex flex-wrap mb-1 md:flex-nowrap justify-between text-xs md:text-sm text-center">
              <div class="basis-1/6 md:basis-1/12 border">{{ $book->type->name }}</div>
              <div class="hidden md:basis-2/12 md:block border">{{ $book->site_name->name }}</div>
              <div class="basis-2/6 md:basis-2/12 border">{{ $book->genre->name }}</div>
              <div class="basis-1/6 md:basis-1/12 border">完結</div>
              <div class="hidden basis-2/6 md:basis-2/12 border md:flex text-center">
                <div class="flex-1">評価値:</div>
                <div class="flex-1">☆☆☆☆☆</div>
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
              <div class="basis-2/6 border">本棚へ追加</div>
            </div>
          </div>
          <div class="md:hidden text-center text-xs flex flex-col basis-12 ml-2">
            <a class="mb-2 leading-7 border" href="#">読む</a>
            <a class="leading-7 border" href="#">編集</a>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
</x-app-layout>