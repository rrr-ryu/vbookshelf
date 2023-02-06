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

  <div class="py-10 px-5 w-full h-screen flex flex-col md:w-1/3">
    <ul id="forth_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 rounded-t-md pt-1 md:pt-4">
        <li class="books" style="background: aqua "><span class="h-screen">訳あり伯爵様と契約結婚したら、義娘（６歳）の契約母になってしまいました。　〜契約期間はたったの一年間〜</span></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
    </ul>
    <ul id="third_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
        <li class="books" style="background: aqua "><span class="h-screen">訳あり伯爵様と契約結婚したら、義娘（６歳）の契約母になってしまいました。　〜契約期間はたったの一年間〜</span></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>    </ul>
    <ul id="second_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 pt-1 md:pt-4">
        <li class="books" style="background: aqua "><span class="h-screen">訳あり伯爵様と契約結婚したら、義娘（６歳）の契約母になってしまいました。　〜契約期間はたったの一年間〜</span></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>    </ul>
    <ul id="first_level" class="flex justify-between w-full h-1/4 border-amber-900 border-8 border-t-0 rounded-b-md pt-1 md:pt-4">
        <li class="books" style="background: aqua "><span class="h-screen">訳あり伯爵様と契約結婚したら、義娘（６歳）の契約母になってしまいました。　〜契約期間はたったの一年間〜</span></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>
        <li class="books"></li>    </ul>
  </div>
</x-app-layout>